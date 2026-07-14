<?php
declare(strict_types=1);

/**
 * Sortie de chaque univers au bout du questionnaire d'alignement
 * (cf. doc/design-site.md §3 et §8).
 *
 * outcome :
 *  - 'service'  : offre d'accompagnement active -> CTA contact (mailto)
 *  - 'book'     : produit (livre) -> lien localise dans 'urls'
 *  - 'waitlist' : branche pas encore ouverte -> capture d'email
 *
 * Une branche 'book' sans URL retombe volontairement sur la liste d'attente.
 */
return [
    'universe-health' => ['outcome' => 'waitlist'],
    'universe-finance' => ['outcome' => 'service'],
    'universe-dev' => ['outcome' => 'service'],
    'universe-mobility' => ['outcome' => 'waitlist'],
    'universe-quality' => ['outcome' => 'waitlist'],
    'universe-formation' => ['outcome' => 'waitlist'],
    'universe-ai' => ['outcome' => 'waitlist'],
];
