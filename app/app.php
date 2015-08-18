<?php

use Silex\Application;
use Silex\Provider\ServiceControllerServiceProvider;
use InstagramRest\Repository\InstagramRepository;
use InstagramRest\Repository\GooglePlaceRepository;
use InstagramRest\Controller\InstagramController;

$app = new Application();
$app->register(new ServiceControllerServiceProvider());

// Register repositories.
$app['instagram.repository'] = $app->share(function() use ($app) {
    return new InstagramRepository($app['instagram.client_id']);
});
$app['google-place.repository'] = $app->share(function() use ($app) {
    return new GooglePlaceRepository(
        $app['google.url'], $app['google.key']
    );
});

// Register controller.
$app['instagram.controller'] = $app->share(function() use ($app) {
    return new InstagramController(
        $app['instagram.repository'], $app['google-place.repository']
    );
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
