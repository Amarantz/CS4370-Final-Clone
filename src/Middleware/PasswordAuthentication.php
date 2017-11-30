<?php
/**
 * Created by PhpStorm.
 * User: Blaine
 * Date: 11/27/2017
 * Time: 6:23 PM
 */

namespace App\Middleware;

use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;
use App\Domain\User;

class PasswordAuthentication
{
    /** @var \Slim\Container $container */
    protected $container;

    /** @var \Monolog\Logger $log */
    protected $log;

    /** @var \App\Storage\UserRepository */
    protected $repo;

    /**
     * PasswordAuthentication constructor.
     * @param $container
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function __construct($container)
    {

        $this->container = $container;
        $this->log = $this->container->get('logger');
        $this->repo = $this->container->get(App\Storage\UserRepository::class);
    }


    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request PSR7 request
     * @param \Psr\Http\Message\ResponseInterface $response PSR7 response
     * @param callable $next                    Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function  __invoke (Request $request, Response $response, $next){


        //$response->getBody()->write('BEFORE');


        //TODO: VALIDATE that $request is a POST
        if($request->getMethod() !=='POST') {
            $this->log->critical('$request is NOT a POST');
            $response = $next($request, $response);
        }
        $this->log->info("Attempting to verify user password: Parsing the body");
        $body = $request->getParsedBody();
        $this->log->critical("settting form Password");
        $formPassword = $body['f_password'];
        $this->log->info("Printing the username $formPassword");
        $this->log->critical("settting form Username/Email");
        $formUser = $body['f_username'];
        $this->log->info("Printing the username $formUser");
        $this->log->critical("loading the user Respository");
        /** @var \App\Storage\UserRepository $repo*/
        $this->log-info("print everything from the $repo");
        var_dump($repo);
        $this->log->critical("Getting the user date from the database if exit.");
        $user = $repo->Find($formUser);
        var_dump($user);
        if(empty($user))
        {
            $this->log->critical("We Didn't receive any user data");
            //TODO; Display message to User invalid user name password
        }

        if(password_verify($formPassword,$user['password'])){
            //TODO; Display message to User invalid user name password
        }


        //TODO: Create session data and cookie.
        //
        $response = $next($request,$response);
    }
}