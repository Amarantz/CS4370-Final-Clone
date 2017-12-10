<?php
/**
 * Created by PhpStorm.
 * User: Blaine
 * Date: 12/9/2017
 * Time: 7:58 PM
 */

namespace App\Controller;


use phpDocumentor\Reflection\DocBlock\Tags\Param;
use Interop\Container\ContainerInterface;

abstract class Controller
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function __get($property){
        if($this->container->{$property}){
            return $this->container->$property;
        }
    }
}