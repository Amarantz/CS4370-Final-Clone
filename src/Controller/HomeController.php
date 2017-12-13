<?php
/**
 * Created by PhpStorm.
 * User: Blaine
 * Date: 12/9/2017
 * Time: 7:57 PM
 */

namespace App\Controller;


class HomeController extends Controller
{
    protected $logger;
    protected $view;
    public function __invoke(){
        $this->loggers = $this->container->get('logger');
        $this->view = $this->container->get('view');
    }

    public function index($request, $response){
        $questionController = $this->QuestionController->getAll();
        //var_dump($questionController);
        return $this->container->view->render($response, 'home.twig', [ 'questions' => $questionController ]);
    }
}