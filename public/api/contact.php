<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/../../app/bootstrap.php';

header('Content-Type: application/json; charset=UTF-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

function contactResponse(int $status, array $body): never
{
    http_response_code($status);
    echo json_encode($body);
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    header('Allow: POST');
    contactResponse(405, ['ok' => false, 'error' => 'method']);
}

// Anti-abus léger : 5 demandes max par session.
$_SESSION['contact_count'] = (int) ($_SESSION['contact_count'] ?? 0);
if ($_SESSION['contact_count'] >= 5) {
    contactResponse(429, ['ok' => false, 'error' => 'rate']);
}

$payload = json_decode((string) file_get_contents('php://input'), true);
if (!is_array($payload)) {
    contactResponse(400, ['ok' => false, 'error' => 'invalid']);
}

// Champ piège invisible : un humain le laisse vide. On répond "ok" au robot
// sans rien enregistrer.
if (trim((string) ($payload['website'] ?? '')) !== '') {
    contactResponse(200, ['ok' => true]);
}

$email = trim((string) ($payload['email'] ?? ''));
$message = trim(str_replace("\r\n", "\n", (string) ($payload['message'] ?? '')));
$topic = trim((string) ($payload['topic'] ?? ''));
$lang = (string) ($payload['lang'] ?? 'fr');
$answers = is_array($payload['answers'] ?? null) ? $payload['answers'] : [];
$answers = array_values(array_filter(array_map(
    static fn ($answer): string => trim(mb_substr((string) $answer, 0, 200)),
    array_slice($answers, 0, 12)
)));

if (!in_array($lang, ['fr', 'en', 'es', 'pt'], true)) {
    $lang = 'fr';
}

// Sans réponses de questionnaire, le message est le seul contenu : il est obligatoire.
if (
    filter_var($email, FILTER_VALIDATE_EMAIL) === false
    || mb_strlen($email) > 254
    || mb_strlen($message) > 3000
    || ($answers === [] && mb_strlen($message) < 10)
    || $topic === ''
    || mb_strlen($topic) > 150
) {
    contactResponse(422, ['ok' => false, 'error' => 'invalid']);
}

$referer = (string) ($_SERVER['HTTP_REFERER'] ?? '');
$request = [
    'email' => $email,
    'message' => $message,
    'topic' => $topic,
    'answers' => $answers,
    'lang' => $lang,
    'page' => mb_substr((string) parse_url($referer, PHP_URL_PATH) . (($query = parse_url($referer, PHP_URL_QUERY)) ? '?' . $query : ''), 0, 300),
];

// Deux canaux indépendants : notification par mail et trace dans
// storage/contact/requests.jsonl. La demande est acceptée dès que l'un des
// deux a réussi.
$id = ContactRepository::newId();

$mailError = null;
if (!ContactMailer::isConfigured()) {
    $mailError = 'not configured';
} else {
    try {
        ContactMailer::send($id, $request);
    } catch (Throwable $e) {
        $mailError = mb_substr($e->getMessage(), 0, 500);
    }
}

if ($mailError !== null) {
    Logger::error('Contact mail error (' . $id . '): ' . $mailError);
}

$stored = false;
try {
    (new ContactRepository())->append([
        'id' => $id,
        'created_at' => date(DATE_ATOM),
        'mail_sent' => $mailError === null,
        'mail_error' => $mailError,
    ] + $request);
    $stored = true;
} catch (Throwable $e) {
    Logger::error('Contact storage error (' . $id . '): ' . $e->getMessage());
}

if (!$stored && $mailError !== null) {
    contactResponse(500, ['ok' => false, 'error' => 'server']);
}

$_SESSION['contact_count']++;
contactResponse(200, ['ok' => true]);
