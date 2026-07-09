<?php
declare(strict_types=1);

class PageController
{
    public function home(): void
    {
        View::render('pages/home', [
            'title' => Lang::get('home.title'),
            'page'  => 'home',
        ]);
    }

    public function portfolio(): void
    {
        View::render('pages/portfolio', [
            'title' => Lang::get('portfolio.title'),
            'page'  => 'portfolio',
        ]);
    }

    public function alignment(string $themeId): void
    {
        View::render('pages/alignment', [
            'title' => 'Alignement',
            'page' => 'alignment',
            'alignmentTheme' => $themeId,
        ]);
    }

    public function vision(): void
    {
        View::render('pages/vision', [
            'title' => Lang::get('vision.title')
        ]);
    }

    public function contact(): void
    {
        View::render('pages/contact', [
            'title' => Lang::get('contact.title'),
            'page'  => 'contact',
        ]);
    }

    public function payment(): void
    {
        View::render('pages/payment', [
            'title' => 'Paiement',
            'page' => 'payment',
        ]);
    }

    public function paymentSuccess(): void
    {
        View::render('pages/payment_success', [
            'title' => 'Paiement confirme',
            'page' => 'payment',
        ]);
    }

    public function notFound(): void
    {
        http_response_code(404);
        View::render('pages/404', [
            'title' => '404',
            'page'  => 'home',
        ]);
    }

    public function paymentCancel(): void
    {
        View::render('pages/payment_cancel', [
            'title' => 'Paiement annule',
            'page' => 'payment',
        ]);
    }
}
