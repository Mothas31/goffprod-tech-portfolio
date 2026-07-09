<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/../../app/bootstrap.php';

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('Method Not Allowed');
}

$csrfToken = (string) ($_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
if (!Security::validateCsrfToken($csrfToken)) {
    http_response_code(403);
    exit('Invalid CSRF token');
}

$productKey = Security::sanitizeInput((string) ($_POST['product'] ?? 'default'));

try {
    $service = new StripePaymentService(new PaymentRepository());
    $session = $service->createCheckoutSession($productKey);

    header('Location: ' . $session->url, true, 303);
    exit;
} catch (Throwable $e) {
    Logger::error('Stripe checkout error: ' . $e->getMessage());
    http_response_code(500);
    exit('Payment initialization failed');
}
