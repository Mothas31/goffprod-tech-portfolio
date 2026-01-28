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
}
