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
        /** @var \Slim\Container $container */

        $this->container = $container;
        $this->log = $this->container->get('logger');
        $this->repo = $container->get('UserRepositoryEloquent');
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
        if(!$request->isPost()) {
            $this->log->critical('$request is NOT a POST');
            $response = $next($request, $response);
            return $response;
        }
        $this->log->info("Attempting to verify user password: Parsing the body");
        $body = $request->getParsedBody();
        //var_dump($body);
        //$this->log->info("print of the $body");
        $this->log->critical("settting form Password");
        $formPassword = $body['f_passwore;d'];
        //$this->log->info("Printing the username $formPassword");
        $this->log->critical("settting form Username/Email");
        $formUser = $body['f_username'];
        $this->log->info("Printing the username $formUser");
        $this->log->critical("loading the user Respository");
        $this->log->critical("Getting the user date from the database if exit.");
        $user = $this->repo->FindByUsername($formUser);
        if(empty($user))
        {
            $this->log->critical("Inavlide user name");
            $response = $response->withStatus(401);
            $response = $response->withRedirect('/invalidusernamepassword');
            return $response = $next($request,$response);
        }

        if(!password_verify($formPassword,$user[0]['password'])){
            $this->log->critical("Invalid Password");
            $response = $response->withStatus(401);
            $response = $response->withRedirect('/invalidusernamepassword');
            return $response = $next($request,$response);
        }
        $this->log->info("user has authenticated");
        session_start(['cookie_lifetime' => 900]);
        $_SESSION['userID'] = $user[0]['uuid'];
        $_SESSION['firstname'] = $user[0]['firstname'];
        $_SESSION['lastname'] = $user[0]['lastname'];
        //TODO: Create session data and cookie.
        return $response = $next($request,$response);
    }
}