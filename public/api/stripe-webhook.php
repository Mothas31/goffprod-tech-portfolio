<?php
declare(strict_types=1);

require_once __DIR__ . '/../../app/bootstrap.php';

$payload = file_get_contents('php://input');
$signature = (string) ($_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '');

if ($payload === false || $signature === '') {
    http_response_code(400);
    exit('Invalid webhook request');
}

try {
    $service = new StripePaymentService(new PaymentRepository());
    $service->handleWebhook($payload, $signature);

    http_response_code(200);
    echo 'ok';
} catch (Throwable $e) {
    Logger::error('Stripe webhook error: ' . $e->getMessage());
    http_response_code(400);
    exit('Webhook failed');
}
