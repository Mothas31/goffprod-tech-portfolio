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

    public function ai(): void
    {
        $this->professionalPage('ai');
    }

    public function nodus(): void
    {
        $this->professionalPage('nodus');
    }

    private function professionalPage(string $page): void
    {
        if (Lang::locale() !== 'fr') {
            $this->notFound();
            return;
        }
        View::render('pages/professional', [
            'page' => $page,
            'title' => Lang::get('seo.' . $page . '.title'),
            'metaDescription' => Lang::get('seo.' . $page . '.description'),
            'professional' => Lang::getData('professional.' . $page),
        ]);
    }

    public function performance(): void
    {
        $this->offerPage('performance');
    }

    public function sobriety(): void
    {
        $this->offerPage('sobriety');
    }

    private function offerPage(string $offerId): void
    {
        $offer = Lang::getData('offers.' . $offerId);
        if (!is_array($offer)) {
            $this->notFound();
            return;
        }

        View::render('pages/offer', [
            'title' => Lang::get('seo.' . $offerId . '.title'),
            'metaDescription' => Lang::get('seo.' . $offerId . '.description'),
            'page' => $offerId,
            'offerId' => $offerId,
            'offer' => $offer,
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

    public function blog(): void
    {
        View::render('pages/blog', [
            'title' => Lang::get('seo.blog.title'),
            'metaDescription' => Lang::get('seo.blog.description'),
            'page' => 'blog',
            'articles' => Blog::all(),
        ]);
    }

    public function blogArticle(array $article): void
    {
        $content = Blog::content($article, Lang::locale());
        View::render('pages/blog_article', [
            'title' => ($content['title'] ?? '') . ' | MinusVortex',
            'metaDescription' => $content['description'] ?? '',
            'page' => 'blogArticle',
            'article' => $article,
            'content' => $content,
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

    public function legal(): void
    {
        $this->informationPage('legal');
    }

    public function privacy(): void
    {
        $this->informationPage('privacy');
    }

    public function terms(): void
    {
        $this->informationPage('terms');
    }

    private function informationPage(string $page): void
    {
        View::render('pages/information', [
            'title' => Lang::get('seo.' . $page . '.title'),
            'page' => $page,
            'informationPage' => $page,
            'noindex' => true,
        ]);
    }
}
