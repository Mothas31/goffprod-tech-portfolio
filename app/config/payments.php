<?php
declare(strict_types=1);

return [
    'default' => [
        'name' => Env::get('STRIPE_PRODUCT_NAME', 'Paiement Goffprod'),
        'price_id' => Env::get('STRIPE_PRICE_ID'),
        'mode' => 'payment',
    ],
];
