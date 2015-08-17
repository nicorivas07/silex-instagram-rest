<?php

// Register routes.
$app->get(
    '/locations/instagram/{media_id}',
    'InstagramRest\Controller\InstagramController::indexAction'
);

