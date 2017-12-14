<?php
/**
 * Created by PhpStorm.
 * User: Blaine
 * Date: 12/10/2017
 * Time: 12:01 AM
 */

namespace App\Controller;


class AnswerController extends Controller
{
    public function getForm($request,$response,$args){
        if(!$this->auth->check()){
            return $response->withRedirect($this->router->pathFor('auth.login'));
        }
        $id = str_replace('-','.',$args['id']);
        $hidden = '<input type="hidden" id="f_questionID" name="f_questionID" value="' . $id . '">';
        return $this->view->render($response, 'Answers/answersForm.twig', ['hidden'=> $hidden,
            'id' => $id]);
    }

    public function postForm($request,$response,$args){

    }
}