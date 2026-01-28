<?php
declare(strict_types=1);

// Sécurité basique
ini_set('display_errors', '0');
error_reporting(E_ALL);

// Autoload ultra simple
require_once __DIR__ . '/../app/core/Lang.php';
require_once __DIR__ . '/../app/core/View.php';
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/core/Helper.php';
require_once __DIR__ . '/../app/controllers/PageController.php';


// Router
Router::dispatch();