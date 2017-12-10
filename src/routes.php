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
});

//$app->group('/users', function () {
//    $this->get('/{id}', 'UserController:profile')->setName('ProfilePage');
//    $this->post('', 'UserController:create');
//    $this->patch('/{id}', 'UserController:update');
//});
//
//$app->group('/questions', function(){
//    $this->get('', App\Controller\QuestionController::class.':index')->set('QuestionsPage');
//    $this->post('', App\Controller\QuestionController::class.':create');
//    $this->patch('/{id}', App\Controller\QuestionController::class.':modify');
//});
//
//$app->group('/answers', function(){
//    $this->get('', App\Controller\AnswersController::class.':index')->set('QuestionsPage');
//    $this->post('', App\Controller\AnswersController::class.':create');
//    $this->patch('/{id}', App\Controller\AnswersController::class.':modify');
//});
//
