<?php

$app->add(App\Middleware\ValidationErrorMiddleware::class);
$app->add(App\Middleware\CsrfViewMiddleware::class);
//$app->add($container->get('csrf'));
