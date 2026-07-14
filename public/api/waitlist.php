<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/../../app/bootstrap.php';

header('Content-Type: application/json; charset=UTF-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    echo json_encode(['ok' => false, 'error' => 'method']);
    exit;
}

// Anti-abus leger : 5 inscriptions max par session.
$_SESSION['waitlist_count'] = (int) ($_SESSION['waitlist_count'] ?? 0);
if ($_SESSION['waitlist_count'] >= 5) {
    http_response_code(429);
    echo json_encode(['ok' => false, 'error' => 'rate']);
    exit;
}

$payload = json_decode((string) file_get_contents('php://input'), true);
if (!is_array($payload)) {
    $payload = $_POST;
}

$email = trim((string) ($payload['email'] ?? ''));
$universe = (string) ($payload['universe'] ?? '');
$lang = (string) ($payload['lang'] ?? 'fr');

$universes = require __DIR__ . '/../../app/config/universes.php';
$supportedLangs = ['fr', 'en', 'es', 'pt'];

if (
    filter_var($email, FILTER_VALIDATE_EMAIL) === false
    || mb_strlen($email) > 254
    || !array_key_exists($universe, $universes)
    || ($universes[$universe]['outcome'] ?? null) !== 'waitlist'
) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'error' => 'invalid']);
    exit;
}

if (!in_array($lang, $supportedLangs, true)) {
    $lang = 'fr';
}

try {
    (new WaitlistRepository())->add($email, $universe, $lang);
    $_SESSION['waitlist_count']++;
    echo json_encode(['ok' => true]);
} catch (Throwable $e) {
    Logger::error('Waitlist error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'server']);
}
