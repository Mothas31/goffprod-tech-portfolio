<?php
declare(strict_types=1);

ini_set('display_errors', '0');
error_reporting(E_ALL);
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/../storage/logs/error.log');

$autoloadPath = __DIR__ . '/../vendor/autoload.php';
if (is_file($autoloadPath)) {
    require_once $autoloadPath;
}

require_once __DIR__ . '/core/Env.php';
require_once __DIR__ . '/core/Security.php';
require_once __DIR__ . '/core/Logger.php';
require_once __DIR__ . '/core/Lang.php';
require_once __DIR__ . '/core/Seo.php';
require_once __DIR__ . '/core/Blog.php';
require_once __DIR__ . '/core/View.php';
require_once __DIR__ . '/core/Router.php';
require_once __DIR__ . '/core/Helper.php';
require_once __DIR__ . '/repositories/PaymentRepository.php';
require_once __DIR__ . '/services/StripePaymentService.php';
require_once __DIR__ . '/controllers/PageController.php';

Env::load(__DIR__ . '/../.env');
