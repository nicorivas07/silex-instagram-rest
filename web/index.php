<?php
define('INSTAGRAMREST_PUBLIC_ROOT', __DIR__);
ini_set('display_errors', 0);
require_once __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../app/app.php';
require __DIR__.'/../app/config/dev.php';
require __DIR__.'/../app/routes.php';
$app->run();