<?php
/**
 * Created by PhpStorm.
 * User: Blaine
 * Date: 12/10/2017
 * Time: 1:43 PM
 */

namespace App\Controller\Auth;
use App\Controller\Controller;
use Respect\Validation\Validator as v;

class AuthController extends Controller
{
    public function getRegistration($request, $response){
        //var_dump($request);
        //$response = $response->withStatus(200);
        $this->logger->info('Dispatch registration page');
        return $this->container->view->render($response, 'auth/register.twig');
    }

    public function postRegistration($request, $response){
        //var_dump($request->getParams());
        /** @var App\Validation\Validator $validation */
        $validation = $this->validator->validate($request,[
            'f_username' => v::noWhitespace()->notEmpty(),
            'f_password' => v::noWhitespace()->notEmpty(),
            'f_confirmPassword' => v::noWhitespace()->notEmpty(),
            'f_firstname' => v::noWhitespace()->notEmpty()->alpha(),
            'f_lastname' => v::noWhitespace()->notEmpty()->alpha(),
        ]);

        if($validation->failed()){
            $this->logger->info('We are returing to the regisration page due to missing or invalid info');
            return $response->withRedirect($this->router->pathFor('auth.register'));
        }

        $this->logger->debug('We are now signing up a user');
        /** App\Domain\UserBuilder $user */
        //$user = $this->UserBuilder;
        //var_dump($this->UserBuilder);
        if($request->getParam('f_password') === $request->getParam('f_confirmPassword')) {
            $this->logger->debug('Passwords are matching');
            //var_dump($request->getParams());
            $user = $this->UserBuilder->setFirstname($request->getParam('f_firstname'))
                ->setLastname($request->getParam('f_lastname'))
                ->setEmail($request->getParam('f_username'))
                ->setPassword(password_hash($request->getParam('f_password'), PASSWORD_BCRYPT, ['cost' => 13]))
                ->build();
            //var_dump($user);
            /** @var \App\Storage\UserRepository $repo */
            $repo = $this->UserRepositoryEloquent;
            $repo->Add($user);
            $this->logger->info('User created');
            $this->auth->attempt($request->getParam('f_username'),$request->getParam('f_password'));
            return $response->withRedirect($this->router->pathFor('home'));
        }
        else{
            $this->logger->debug('passwords do not match');
            return $response->withRedirect($this->router->pathFor('auth.register'));
        }
    }

    public function getLogin($request,$response){
        $return = $this->view->render($response, 'auth/login.twig');
    }

    public function postLogin($request, $response){
            $this->logger->debug('We are posting user Login');
            $auth = $this->auth->attempt($request->getParam('f_username'),$request->getParam('f_password'));
            if(!$auth){
                $this->logger->debug("Invalid loggin");
                return $response->withRedirect($this->router->pathFor('auth.login'));
            } else {
                $this->logger->debug("User has logged in");
                return $response->withRedirect($this->router->pathFor('home'));
            }
    }

    public function getLogout($request, $response){
        $this->auth->logout();
        return $response->withRedirect($this->router->pathFor('home'));
    }

}