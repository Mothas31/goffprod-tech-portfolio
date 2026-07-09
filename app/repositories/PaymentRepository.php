<?php
declare(strict_types=1);

class PaymentRepository
{
    private PDO $pdo;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? self::connect();
        $this->migrate();
    }

    public static function connect(): PDO
    {
        if (!extension_loaded('pdo_sqlite')) {
            throw new RuntimeException('PHP extension pdo_sqlite is required for local payment storage.');
        }

        $databaseDir = __DIR__ . '/../../storage/database';
        if (!is_dir($databaseDir)) {
            mkdir($databaseDir, 0755, true);
        }

        $pdo = new PDO('sqlite:' . $databaseDir . '/payments.sqlite');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    }

    public function createCheckoutSession(array $data): void
    {
        $statement = $this->pdo->prepare(
            'INSERT INTO payments (
                checkout_session_id,
                status,
                product_key,
                product_name,
                metadata,
                created_at,
                updated_at
            ) VALUES (
                :checkout_session_id,
                :status,
                :product_key,
                :product_name,
                :metadata,
                :created_at,
                :updated_at
            )'
        );

        $now = date(DATE_ATOM);
        $statement->execute([
            ':checkout_session_id' => $data['checkout_session_id'],
            ':status' => $data['status'],
            ':product_key' => $data['product_key'],
            ':product_name' => $data['product_name'],
            ':metadata' => json_encode($data['metadata'] ?? [], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            ':created_at' => $now,
            ':updated_at' => $now,
        ]);
    }

    public function updateFromCheckoutSession(array $session, string $eventType): void
    {
        $status = (string) ($session['payment_status'] ?? $session['status'] ?? 'unknown');
        $paidAt = $status === 'paid' ? date(DATE_ATOM) : null;
        $canceledAt = in_array($status, ['expired', 'canceled', 'unpaid', 'failed'], true) ? date(DATE_ATOM) : null;

        $statement = $this->pdo->prepare(
            'UPDATE payments
                SET status = :status,
                    payment_intent_id = :payment_intent_id,
                    amount_total = :amount_total,
                    currency = :currency,
                    customer_email = :customer_email,
                    raw_event_type = :raw_event_type,
                    paid_at = COALESCE(paid_at, :paid_at),
                    canceled_at = COALESCE(canceled_at, :canceled_at),
                    updated_at = :updated_at
              WHERE checkout_session_id = :checkout_session_id'
        );

        $statement->execute([
            ':checkout_session_id' => (string) $session['id'],
            ':status' => $status,
            ':payment_intent_id' => isset($session['payment_intent']) ? (string) $session['payment_intent'] : null,
            ':amount_total' => isset($session['amount_total']) ? (int) $session['amount_total'] : null,
            ':currency' => isset($session['currency']) ? (string) $session['currency'] : null,
            ':customer_email' => $this->resolveCustomerEmail($session),
            ':raw_event_type' => $eventType,
            ':paid_at' => $paidAt,
            ':canceled_at' => $canceledAt,
            ':updated_at' => date(DATE_ATOM),
        ]);
    }

    public function findByCheckoutSessionId(string $checkoutSessionId): ?array
    {
        $statement = $this->pdo->prepare('SELECT * FROM payments WHERE checkout_session_id = :id LIMIT 1');
        $statement->execute([':id' => $checkoutSessionId]);
        $payment = $statement->fetch();

        return is_array($payment) ? $payment : null;
    }

    private function migrate(): void
    {
        $this->pdo->exec(
            'CREATE TABLE IF NOT EXISTS payments (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                checkout_session_id TEXT NOT NULL UNIQUE,
                payment_intent_id TEXT,
                status TEXT NOT NULL,
                amount_total INTEGER,
                currency TEXT,
                customer_email TEXT,
                product_key TEXT NOT NULL,
                product_name TEXT NOT NULL,
                metadata TEXT,
                raw_event_type TEXT,
                created_at TEXT NOT NULL,
                updated_at TEXT NOT NULL,
                paid_at TEXT,
                canceled_at TEXT
            )'
        );

        $this->pdo->exec('CREATE INDEX IF NOT EXISTS idx_payments_status ON payments(status)');
        $this->pdo->exec('CREATE INDEX IF NOT EXISTS idx_payments_created_at ON payments(created_at)');
    }

    private function resolveCustomerEmail(array $session): ?string
    {
        if (isset($session['customer_details']['email'])) {
            return (string) $session['customer_details']['email'];
        }

        if (isset($session['customer_email'])) {
            return (string) $session['customer_email'];
        }

        return null;
    }
}
