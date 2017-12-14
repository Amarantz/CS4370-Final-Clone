<?php
/**
 * HTTP Routes defined here
 */
use Slim\Http\Request;
use Slim\Http\Response;

// Get Routes
$app->get('/', App\Controller\HomeController::class.':index')->setName('home');

$app->get('/auth/register', App\Controller\Auth\AuthController::class.':getRegistration')->setName('auth.register');
$app->post('/auth/register', App\Controller\Auth\AuthController::class.':postRegistration');
$app->get('/auth/login', App\Controller\Auth\AuthController::class.':getLogin')->setName('auth.login');
$app->post('/auth/login', App\Controller\Auth\AuthController::class.':postLogin');
$app->get('/auth/logout', App\Controller\Auth\AuthController::class.':getLogout')->setName('auth.logout');

// I had ungroup my routes as I was having issues with the question id as it slim doesn't support '.' well.
// so after finding this out i used a string replace and now it able to handle the . in the id field.
$app->get('/question', App\Controller\QuestionController::class.':index')->setName('question.index');
$app->get('/question/q/{id}', App\Controller\QuestionController::class.':getQuestion')->setName('question.id');
$app->get('/question/form', App\Controller\QuestionController::class.':getForm')->setName('question.form');
$app->post('/question/form', App\Controller\QuestionController::class.':postForm');
$app->get('/question/form/{id}/edit', App\Controller\QuestionController::class.':editForm')->setName('question.edit');
$app->post('/question/form/{id}/edit', App\Controller\QuestionController::class.':postEditForm');
//$app->get('/question/{id}', App\Controller\QuestionController::class.':getQuestion');

$app->get('/answer/{id}', App\Controller\AnswerController::class.':getForm')->setName('answer.form');
$app->post('/answer', App\Controller\AnswerController::class.':postForm');