<?php
declare(strict_types=1);

use Stripe\Checkout\Session;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Stripe;
use Stripe\Webhook;

class StripePaymentService
{
    public function __construct(private readonly PaymentRepository $payments)
    {
        if (!class_exists(Stripe::class)) {
            throw new RuntimeException('Stripe SDK is not installed. Run composer install.');
        }

        Stripe::setApiKey(Env::require('STRIPE_SECRET_KEY'));
    }

    public function createCheckoutSession(string $productKey): Session
    {
        $products = require __DIR__ . '/../config/payments.php';
        if (!isset($products[$productKey])) {
            throw new InvalidArgumentException('Unknown payment product.');
        }

        $product = $products[$productKey];
        if (empty($product['price_id'])) {
            throw new RuntimeException('Missing Stripe price ID for product: ' . $productKey);
        }

        $appUrl = rtrim(Env::require('APP_URL'), '/');

        $session = Session::create([
            'mode' => $product['mode'] ?? 'payment',
            'line_items' => [[
                'price' => $product['price_id'],
                'quantity' => 1,
            ]],
            'success_url' => $appUrl . '/paiement-succes.html?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $appUrl . '/paiement-annule.html',
            'metadata' => [
                'product_key' => $productKey,
            ],
        ]);

        $this->payments->createCheckoutSession([
            'checkout_session_id' => $session->id,
            'status' => $session->status ?? 'created',
            'product_key' => $productKey,
            'product_name' => $product['name'],
            'metadata' => ['stripe_price_id' => $product['price_id']],
        ]);

        return $session;
    }

    public function handleWebhook(string $payload, string $signature): void
    {
        try {
            $event = Webhook::constructEvent($payload, $signature, Env::require('STRIPE_WEBHOOK_SECRET'));
        } catch (UnexpectedValueException | SignatureVerificationException $e) {
            throw new RuntimeException('Invalid Stripe webhook payload or signature.', 0, $e);
        }

        $eventType = (string) $event->type;
        if (!str_starts_with($eventType, 'checkout.session.')) {
            return;
        }

        $session = $event->data->object;
        $this->payments->updateFromCheckoutSession($session->toArray(), $eventType);
    }
}
