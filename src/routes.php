<?php
/**
 * HTTP Routes defined here
 */
use Slim\Http\Request;
use Slim\Http\Response;

// Get Routes
$app->get('/', App\Controller\HomeController::class.':index')->setName('home');

$app->group('/auth', function(){
    $this->get('/register', App\Controller\Auth\AuthController::class.':getRegistration')->setName('auth.register');
    $this->post('/register', App\Controller\Auth\AuthController::class.':postRegistration');
    $this->get('/login', App\Controller\Auth\AuthController::class.':getLogin')->setName('auth.login');
    $this->post('/login', App\Controller\Auth\AuthController::class.':postLogin');
    $this->get('/logout', App\Controller\Auth\AuthController::class.':getLogout')->setName('auth.logout');
});

$app->group('/question', function(){
    $this->get('', App\Controller\QuestionController::class.':index')->setName('question.index');
    $this->get('/form', App\Controller\QuestionController::class.':getForm')->setName('question.form');
    $this->post('/form', App\Controller\QuestionController::class.':postForm');
    $this->get('/form/{id}/edit', App\Controller\QuestionController::class.':editForm')->setName('question.edit');
    $this->post('/form/{id}/edit', App\Controller\QuestionController::class.':postEditForm');
    $this->get('/{id}', App\Controller\QuestionController::class.':getQuestion');
});