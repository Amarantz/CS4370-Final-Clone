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
            $_SESSION['vError'] = ['Signin' => ' User is not signed'];
            return $response->withRedirect($this->router->pathFor('auth.login'));
        }
        $id = str_replace('-','.',$args['id']);
        $hidden = '<input type="hidden" id="f_questionID" name="f_questionID" value="' . $id . '">';
        return $this->view->render($response, 'Answers/answersForm.twig', ['hidden'=> $hidden,
            'id' => $id]);
    }

    public function postForm($request,$response,$args) {
        //var_dump($request->getParams());
        if(!$this->auth->check()){
            $_SESSION['vError'] = ['Signin' => ' User is not signed'];
            return $response->withRedirect($this->router->pathFor('auth.login'));
        }

        $user = $this->auth->user();
        /** @var \App\Domain\AnswerBuilder $abuilder */
        $abuilder = $this->AnswerBuilder;
        //var_dump($abuilder);
        //print($user->getID());
        $answer = $abuilder->setQuestionID($request->getParam('f_questionID'))
            ->setUserID($user->getID())
            ->setAnswer($request->getParam('f_answer'))
            ->build();
        /** @var \App\Storage\AnswersRepository $repo */
        $repo = $this->AnswersRepositoryEloquent;
        $repo->Add($answer);
        return $response->withRedirect($this->router->pathFor(
            'question.id', [
                'id' => str_replace('.','-',$request->getParam('f_questionID'))
            ]));
    }
}