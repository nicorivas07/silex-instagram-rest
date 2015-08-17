<?php

use Silex\Application;
use Silex\Provider\ServiceControllerServiceProvider;

$app = new Application();
$app->register(new ServiceControllerServiceProvider());

// Register repositories.
$app['instagram.repository'] = $app->share(function ($app) {
    return new InstagramRest\Repository\InstagramRepository($app);
});

// Register the error handler.
$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
            break;
        default:
            $message = 'We are sorry, but something went terribly wrong.';
    }

    return new Response($message, $code);
});

return $app;
