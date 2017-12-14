<?php
/**
 * DIC configuration
 */

$container = $app->getContainer();

$container['auth'] = function($c){
    return new \App\Auth\Auth($c);
};

// view
$container['view'] = function ($c) {
    $settings = $c->get('settings');
    $view = new \Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);
    // Add extensions
    $view->addExtension(new \Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
    $view->addExtension(new \Twig_Extension_Debug());

    $view->getEnvironment()->addGlobal('auth',[
        'check' => $c->auth->check(),
        'user' => $c->auth->user(),
        ]);
    return $view;
};

// flash messages
$container['flash'] = function ($c) {
    return new \Slim\Flash\Messages;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new \Monolog\Logger($settings['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));

    return $logger;
};

// database
$container['db'] = function ($c) {
    $capsule = new \Illuminate\Database\Capsule\Manager;

    $capsule->addConnection($c->get('settings')['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};

// error handlers
$container['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        $c->get('logger')->error($exception->getMessage());
        $response->getBody()->rewind();
        return $response->withStatus(500)
                        ->withHeader('Content-Type', 'text/html')
                        ->write("<hr>Oops, something's gone wrong!<hr>");
    };
};

/**
 * @param $c
 * @return Closure
 */
$container['phpErrorHandler'] = function ($c) {
    /**
     * @param $request
     * @param $response
     * @param $error
     * @return mixed
     */
    return function ($request, $response, $error) use ($c) {
        $c->get('logger')->error($error->getMessage());
        $response->getBody()->rewind();
        return $response->withStatus(500)
                        ->withHeader('Content-Type', 'text/html')
                        ->write("Oops, something's gone wrong!");
    };
};

// classes/objects
/**
 * @param $c
 * @return \App\Controller\HomeController
 */
$container[App\Controller\HomeController::class] = function ($c) {
    return new \App\Controller\HomeController($c);
};


/**
 * @param $c
 * @param $table_name
 * @return \App\Storage\EloquentPlugin
 */
$container['EloquentPlugin'] = function ($c, $table_name){
    $c->get('logger')->info("We are getting the plugin for Eloquent");
    $table = $c->get('db')->table($table_name);
    return new \App\Storage\EloquentPlugin($table);
};

/**
 * @param $c
 * @return \App\Storage\UserRepository
 * @throws \Interop\Container\Exception\ContainerException
 */
$container['UserRepositoryEloquent'] = function ($c) {
    /* @var \Slim\Container $c **/
    //$c->get('logger')->info("We are setting the user Repository should be working");
    //var_dump($c->get('EloquentPlugin')($c,'users'));
    $builder = $c->get('db')->table('users');
    $adapter = new \App\Storage\EloquentPlugin($builder);
   // $c->get('logger')->info("we are have plugin to work with");
    return new \App\Storage\UserRepository($adapter);
};

$container['QuestionRepositoryEloquent'] = function ($c) {
    /* @var \Slim\Container $c **/
    //$c->get('logger')->info("We are setting the user Repository should be working");
    //var_dump($c->get('EloquentPlugin')($c,'users'));
    $builder = $c->get('db')->table('questions');
    $adapter = new \App\Storage\EloquentPlugin($builder);
    $c->get('logger')->info("we are have plugin to work with");
    return new \App\Storage\QuestionRepository($adapter);
};

$container['AnswersRepositoryEloquent'] = function ($c) {
    /* @var \Slim\Container $c **/
    //$c->get('logger')->info("We are setting the user Repository should be working");
    //var_dump($c->get('EloquentPlugin')($c,'users'));
    $builder = $c->get('db')->table('answer');
    $adapter = new \App\Storage\EloquentPlugin($builder);
     $c->get('logger')->info("we are have plugin for answers to work with");
    return new \App\Storage\AnswersRepository($adapter);
};

/**
 * @param $c
 * @return \App\Middleware\PasswordAuthentication
 */
$container[App\Middleware\PasswordAuthentication::class] = function($c) {
    return new \App\Middleware\PasswordAuthentication($c);
};

$container[App\Domain\User::class] = function ()
{
    return new \App\Domain\User();
};

$container[App\Domain\Question::class] = function () {
    return new \App\Domain\Question();
};

$container[App\Domain\Answer::class] = function() {
    return new \App\Domain\Answer();
};

$container['UserBuilder'] = function () {
    return new \App\Domain\UserBuilder();
};

$container['QuestionBuilder'] = function() {
    return new \App\Domain\QuestionBuilder();
};

$container['AnswerBuilder'] = function() {
    return new \App\Domain\AnswerBuilder();
};

$container[App\Controller\Auth\AuthController::class] = function($c) {
    return new \App\Controller\Auth\AuthController($c);
};

$container['validator'] = function($c) {
    return new \App\Validation\Validator;
};

$container[App\Middleware\ValidationErrorMiddleware::class] = function($c){
    return new \App\Middleware\ValidationErrorMiddleware($c);
};

$container['csrf'] = function ($c){
    return new \Slim\Csrf\Guard;
};

$container[App\Middleware\CsrfViewMiddleware::class] = function ($c){
    return new \App\Middleware\CsrfViewMiddleware($c);
};

$container[App\Controller\QuestionController::class] = function ($c) {
    return new \App\Controller\QuestionController($c);
};

$container['QuestionController'] = function ($c) {
    return new \App\Controller\QuestionController($c);
};