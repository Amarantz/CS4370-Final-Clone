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

require_once __DIR__ . '/../constants.php';
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
        if(session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['user'])){
            $result = $this->repo->Find($_SESSION['user']);
            if(count($result) > 0){
                return $response = $next($request,$response);
            } else {
                session_destroy();
                $response = $response->withStatus(405);
                return $response = $next($request,$response);
            }
        }

        //TODO: VALIDATE that $request is a POST
        if(!$request->isPost()) {
            $this->log->critical('$request is NOT a POST');
            $response = $next($request, $response);
            return $response;
        }
        $this->log->info("Attempting to verify user password: Parsing the body");
        $body = $request->getParsedBody();
        if(!empty($body['f_password']) && !empty($body['f_username'])) {
            $this->log->critical("settting form Password");
            $formPassword = $body['f_password'];
            //$this->log->info("Printing the username $formPassword");
            $this->log->critical("settting form Username/Email");
            $formUser = $body['f_username'];
            $this->log->info("Printing the username $formUser");
            $this->log->critical("loading the user Respository");
            $this->log->critical("Getting the user date from the database if exit.");

            /** @var \App\Domain\User $users */
            $users = $this->repo->FindByUsername($formUser);
            //var_dump($users);
            if (password_verify($formPassword, $users[0]->getPassword())) {
                $this->log->debug("we are logged in");
                session_destroy();
                session_start(['cookie_lifetime' => SESSION_TIMEOUT]);
                $this->log->debug("setting the session user");
                $_SESSION['user'] = $users[0]->getID();
                $this->log->debug($_SESSION['user']. " we should have userID");
                $response = $response->withStatus(202);
                return $response = $next($request,$response);
            }

            $response = $response->withStatus(401);
        }

        return $response = $next($request,$response);
    }
}