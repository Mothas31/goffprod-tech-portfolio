<?php
declare(strict_types=1);

/**
 * Demandes de contact (formulaire services et fin de questionnaire).
 * Une ligne JSON par demande dans storage/contact/requests.jsonl :
 * pas de base de données, lisible avec `tail` ou `jq`.
 */
class ContactRepository
{
    private string $file;

    public function __construct(?string $file = null)
    {
        $this->file = $file ?? __DIR__ . '/../../storage/contact/requests.jsonl';
    }

    public static function newId(): string
    {
        return date('Ymd-His') . '-' . bin2hex(random_bytes(3));
    }

    /**
     * @param array<string, mixed> $record
     */
    public function append(array $record): void
    {
        $directory = dirname($this->file);
        if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
            throw new RuntimeException('Cannot create ' . $directory);
        }

        $line = json_encode($record, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR) . PHP_EOL;
        // Verrou exclusif : deux envois simultanés ne se mélangent pas.
        if (file_put_contents($this->file, $line, FILE_APPEND | LOCK_EX) === false) {
            throw new RuntimeException('Cannot write ' . $this->file);
        }
    }
}
