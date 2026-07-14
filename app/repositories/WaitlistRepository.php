<?php
declare(strict_types=1);

/**
 * Emails laisses au bout du questionnaire pour les univers en attente
 * d'offre (outcome 'waitlist' dans app/config/universes.php).
 * Meme base SQLite que les paiements.
 */
class WaitlistRepository
{
    private PDO $pdo;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? PaymentRepository::connect();
        $this->migrate();
    }

    public function add(string $email, string $universe, string $lang): void
    {
        $statement = $this->pdo->prepare(
            'INSERT OR IGNORE INTO waitlist (email, universe, lang, created_at)
             VALUES (:email, :universe, :lang, :created_at)'
        );
        $statement->execute([
            ':email' => mb_strtolower(trim($email)),
            ':universe' => $universe,
            ':lang' => $lang,
            ':created_at' => date(DATE_ATOM),
        ]);
    }

    private function migrate(): void
    {
        $this->pdo->exec(
            'CREATE TABLE IF NOT EXISTS waitlist (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                email TEXT NOT NULL,
                universe TEXT NOT NULL,
                lang TEXT NOT NULL,
                created_at TEXT NOT NULL,
                UNIQUE (email, universe)
            )'
        );
    }
}
