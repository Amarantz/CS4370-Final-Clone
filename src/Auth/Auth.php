<?php
/**
 * Created by PhpStorm.
 * User: Blaine
 * Date: 12/10/2017
 * Time: 7:19 PM
 */

namespace App\Auth;


class Auth
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function attempt($username, $password){
        $user = $this->container->UserRepositoryEloquent->FindByUsername($username);
        //var_dump($user);
        if(!$user){
            return false;
        }

        if(password_verify($password,$user->getPassword()))
        {
            $_SESSION['user'] = $user->getID();
            return true;
        }

    }

    public function check() {
        //var_dump($_SESSION['user']);
        return isset($_SESSION['user']);
    }

    public function user() {
        if($this->check()) {
            $this->container->logger->debug("We are getting user for data at userID:" . $_SESSION['user']);
            $user = $this->container->UserRepositoryEloquent->Find($_SESSION['user']);
            //var_dump($user);
            return $user;
        }
        return null;
    }

    public function logout() {
        unset($_SESSION['user']);
    }
}