<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

//Password authentication

$app->add(App\Middleware\PasswordAuthentication::class);


//cookie auth
//$app->add();