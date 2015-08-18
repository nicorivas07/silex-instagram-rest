<?php

// Register routes.
$app->get(
    '/locations/instagram/{media_id}', "instagram.controller:indexAction"
);

