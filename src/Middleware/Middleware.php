<?php
/**
 * Created by PhpStorm.
 * User: Blaine
 * Date: 12/10/2017
 * Time: 4:10 PM
 */

namespace App\Middleware;


class Middleware
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }



}