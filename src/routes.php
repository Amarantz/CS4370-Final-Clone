<?php
/**
 * HTTP Routes defined here
 */
use Slim\Http\Request;
use Slim\Http\Response;

// Get Routes
$app->get('/', App\Actions\HomeAction::class)->setName('homepage');
$app->get('/registration', App\Actions\RegisterAction::class)->setName('RegistrationPage');
$app->get('/questions', App\Actions\QuestionActions::class)->setName('QuestionsPage');
$app->get('/questions/{id}', App\Actions\QuestionActions::class)->setName('QuestionsPage');
$app->get('/question/ask', App\Actions\QuestionActions::class)->setName('QuestionsPage');

// Post Routes
$app->post('/profile', App\Actions\ProfileAction::class)->setName('ProfilePage');
$app->post('/registration', App\Actions\ReisterAction::class)->setName('PostRegistrationPage');
$app->post('/question', App\Actions\QuestionsActions::class)->setName('QuestionsPage');



