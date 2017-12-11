<?php
/**
 * Created by PhpStorm.
 * User: Blaine
 * Date: 12/10/2017
 * Time: 12:00 AM
 */

namespace App\Controller;


class QuestionController extends Controller
{
    public function getForm($request,$response){
        return $this->container->view->render($response,'/Questions/questionform.twig');
    }

    public function postForm($request, $response){
        //TODO: Need to create function to build question and send it to the database to store.
        return;
    }

    public function index($request,$response) {
        //TODO: Need to create index page to display questions to the users
        return;
    }

}