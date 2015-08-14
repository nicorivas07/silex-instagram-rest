<?php

// Register routes.
$app->get('/{name}', 'AppName\Controller\DefaultController::indexAction');

$app->get('/', 'AppName\Controller\DefaultController::indexAction');

