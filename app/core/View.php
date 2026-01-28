<?php
declare(strict_types=1);

class View
{
    public static function render(string $view, array $data = []): void
    {
        extract($data);
        
        require __DIR__ . '/../views/layout.php';
    }
}
