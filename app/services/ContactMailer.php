<?php
declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;

/**
 * Notification par SMTP (PHPMailer) d'une nouvelle demande de contact.
 * Configuration dans .env : MAIL_HOST, MAIL_PORT, MAIL_USERNAME,
 * MAIL_PASSWORD, MAIL_TO (MAIL_FROM et MAIL_ENCRYPTION facultatifs).
 */
class ContactMailer
{
    public static function isConfigured(): bool
    {
        return class_exists(PHPMailer::class)
            && Env::get('MAIL_HOST') !== null
            && Env::get('MAIL_USERNAME') !== null
            && Env::get('MAIL_PASSWORD') !== null
            && Env::get('MAIL_TO') !== null;
    }

    /**
     * @param array{email: string, message: string, topic: string, answers: list<string>, lang: string, page: string} $request
     */
    public static function send(string $id, array $request): void
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = Env::require('MAIL_HOST');
        $mail->Port = (int) Env::get('MAIL_PORT', '587');
        $mail->SMTPAuth = true;
        $mail->Username = Env::require('MAIL_USERNAME');
        $mail->Password = Env::require('MAIL_PASSWORD');
        // MAIL_ENCRYPTION : tls (défaut, port 587), ssl (port 465) ou none (tests locaux).
        $encryption = Env::get('MAIL_ENCRYPTION', $mail->Port === 465 ? 'ssl' : 'tls');
        if ($encryption === 'none') {
            $mail->SMTPSecure = '';
            $mail->SMTPAutoTLS = false;
        } else {
            $mail->SMTPSecure = $encryption === 'ssl' ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
        }
        $mail->CharSet = PHPMailer::CHARSET_UTF8;
        $mail->Timeout = 15;

        $mail->setFrom(Env::get('MAIL_FROM', Env::require('MAIL_USERNAME')), 'Site MinusVortex');
        $mail->addAddress(Env::require('MAIL_TO'));
        // Répondre au mail répond directement au prospect.
        $mail->addReplyTo($request['email']);

        $mail->Subject = 'Nouveau contact MinusVortex — ' . $request['topic'];
        $mail->Body = self::body($id, $request);
        $mail->send();
    }

    /**
     * @param array{email: string, message: string, topic: string, answers: list<string>, lang: string, page: string} $request
     */
    private static function body(string $id, array $request): string
    {
        $lines = [
            'Sujet : ' . $request['topic'],
            'E-mail : ' . $request['email'],
            'Langue : ' . $request['lang'],
            '',
            'Message :',
            $request['message'] !== '' ? $request['message'] : '(aucun message)',
        ];

        if ($request['answers'] !== []) {
            $lines[] = '';
            $lines[] = 'Réponses au questionnaire :';
            foreach ($request['answers'] as $answer) {
                $lines[] = '- ' . $answer;
            }
        }

        $lines[] = '';
        $lines[] = 'Page : ' . ($request['page'] !== '' ? $request['page'] : '-');
        $lines[] = 'Demande ' . $id . ' — ' . date('d/m/Y H:i');

        return implode("\n", $lines);
    }
}
