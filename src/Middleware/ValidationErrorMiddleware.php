<?php
/**
 * Created by PhpStorm.
 * User: Blaine
 * Date: 12/10/2017
 * Time: 4:12 PM
 */

namespace App\Middleware;


class ValidationErrorMiddleware extends Middleware
{

    public function __invoke($request,$response,$next){
        if(isset($_SESSION['vErrors'])) {
            $this->container->view->getEnvironment()->addGlobal('errors', $_SESSION['vErrors']);
            unset($_SESSION['vErrors']);
        }
        $response = $next($request,$response);
        return $response;
    }
}