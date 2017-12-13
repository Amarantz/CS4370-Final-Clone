<?php
/**
 * Created by PhpStorm.
 * User: Blaine
 * Date: 12/10/2017
 * Time: 12:00 AM
 */

namespace App\Controller;
use Respect\Validation\Validator as v;

class QuestionController extends Controller
{
    public function getForm($request,$response){
        $this->logger->info("Dispage Question Form Page");
        return $this->container->view->render($response,'/Questions/questionform.twig');
    }

    public function postForm($request, $response){
        $validation = $this->validator->validate($request,[
            'f_question' => v::notEmpty(),
            'f_detail' => v::notEmpty(),
        ]);

        if($validation->failed()) {
            $this->logger->info("we are returning back to the Question Form page because we have a blank field");
            return $response->withRedirect($this->router->pathFor('question.form'));
        }

        if(!$this->auth->check()){
            $this->logger->info("user is not logged in.  Redirecting to the login page");
            return $response->withRedirect($this->router->pathFor('auth.login'));
        }

        if(!empty($request->getParam('f_question')) && !empty($request->getParam('f_detail'))){
            $this->logger->info('We are now creating a question and posting to the database');
            $question = $this->QuestionBuilder->setQuestion($request->getParam('f_question'))
                ->setDetails($request->getParam('f_detail'))
                ->setUser($_SESSION['user'])
                ->build();
            //var_dump($question);
            /** @var \App\Storage\QuestionRepository $repo */
            $repo = $this->QuestionRepositoryEloquent;
            $repo->Add($question);
            $this->logger->info("Question Created");
            return $response->withRedirect($this->router->pathFor('home'));
        }
    }

    public function index($request,$response) {
        //TODO: Need to create index page to display questions to the users
        return;
    }

    public function getAll(){
        $this->logger->debug('We are getting questions');
        /** @var \App\Storage\QuestionRepository $repo */
        $repo = $this->QuestionRepositoryEloquent;
        $this->logger->debug('Repo is setup now trying to get all Questions');
        $questions = $repo->FindAll();
        $this->logger->debug('We have data in the repo');
        return $questions;
    }

}