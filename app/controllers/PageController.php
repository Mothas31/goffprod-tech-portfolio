<?php
declare(strict_types=1);

class PageController
{
    public function home(): void
    {
        View::render('pages/home', [
            'title' => Lang::get('seo.home.title'),
            'metaDescription' => Lang::get('seo.home.description'),
            'page'  => 'home',
        ]);
    }

    public function portfolio(): void
    {
        View::render('pages/portfolio', [
            'title' => Lang::get('seo.portfolio.title'),
            'metaDescription' => Lang::get('seo.portfolio.description'),
            'page'  => 'portfolio',
        ]);
    }

    public function alignment(string $themeId): void
    {
        View::render('pages/alignment', [
            'title' => Lang::get('seo.alignment.' . $themeId . '.title'),
            'metaDescription' => Lang::get('seo.alignment.' . $themeId . '.description'),
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
            'title' => Lang::get('seo.payment.title'),
            'page' => 'payment',
            'noindex' => true,
        ]);
    }

    public function paymentSuccess(): void
    {
        View::render('pages/payment_success', [
            'title' => Lang::get('seo.payment_success.title'),
            'page' => 'paymentSuccess',
            'noindex' => true,
        ]);
    }

    public function notFound(): void
    {
        http_response_code(404);
        View::render('pages/404', [
            'title' => Lang::get('seo.not_found.title'),
            'page'  => '404',
            'noindex' => true,
        ]);
    }

    public function paymentCancel(): void
    {
        View::render('pages/payment_cancel', [
            'title' => Lang::get('seo.payment_cancel.title'),
            'page' => 'paymentCancel',
            'noindex' => true,
        ]);
    }
}
