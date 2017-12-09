<?php
/**
 * Created by PhpStorm.
 * User: Blaine
 * Date: 12/9/2017
 * Time: 11:10 AM
 */

namespace App\Domain;

class AnswerBuilder extends Answer
{

    protected $answers;

    public function __construct()
    {
        $this->answers = new Answer();
    }

    public function setID($uuid) {
        if(empty($uuid)){
            throw new \InvalidArgumentException('$uuid is empty');
        }

        if(!is_string($uuid)){
            throw new \InvalidArgumentException('$uuid is not a string');
        }
        $this->ID = $uuid;
        return $this;
    }

    public function setQuestionID($questionID){
        if(empty($questionID)){
            throw new \InvalidArgumentException('$questionID is empty');
        }

        if(!is_string($questionID)){
            throw new \InvalidArgumentException('$questionID is not a String');
        }
        $this->questionID = $questionID;
        return $this;
    }

    public function setUpdated($date){
        if(empty($date)){
            throw new \InvalidArgumentException('$date is empty');
        }

        if(!is_string($date)){
            throw new \InvalidArgumentException('$date is not a String');
        }

        $this->updated = $date;
        return $this;
    }

    public function setCreated($date) {
        if(empty($date)){
            throw new \InvalidArgumentException('$date is empty');
        }

        if(!is_string($date)){
            throw new \InvalidArgumentException('$date is not a String');
        }

        $this->created = $date;
        return $this;
    }


    public function setUserID($userID) {
        if(empty($userID)){
            throw new \InvalidArgumentException('$userId is empty');
        }
        if(!is_string($userID)){
            throw new \InvalidArgumentException('$userID is not a string');
        }
        $this->userID = $userID;
        return $this;
    }

    public function setAnswer($answer) {
        if(empty($answer)) {
            throw new \InvalidArgumentException('$string is empty');
        }

        if(!is_string($answer)){
            throw new \InvalidArgumentException('$string is not a string');
        }
        $this->answer = $answer;
        return $this;
    }

    public function setUpvote($upvote) {
        if(empty($upvote)){
            throw new \InvalidArgumentException('$upvote is empty');
        }
        if(!is_numeric($upvote)){
            throw new \InvalidArgumentException('$upvote is not a number');
        }
        $this->upvote = $upvote;
        return $this;
    }


    public function build(){
        if(empty($this->ID)){
            $this->ID = GENERATE_ANSWER_UUID;
        }
        $this->answers->ID= $this->ID;
        $this->answers->created = $this->created;
        $this->answers->updated = $this->updated;
        $this->answers->userID = $this->userID;
        $this->answers->questionID = $this->questionID;
        $this->answers->answer = $this->answer;
        $this->answers->upvote = $this->upvote;

        return $this->answers;
    }

}