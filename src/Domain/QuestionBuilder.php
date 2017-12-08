<?php
/**
 * Created by PhpStorm.
 * User: Blaine
 * Date: 12/7/2017
 * Time: 6:48 PM
 */

namespace App\Domain;


class QuestionBuilder extends Question
{
//    protected $ID;
//    protected $question;
//    protected $details;
//    protected $user;
//    protected $updatedDate;
//    protected $creationDate;

    public function setID($uuid)
    {
        //TODO:
        return $this;
    }

    /**
    * This allow for the change of the question
    * @param string $s with a limitation of 256 characters
    * @return self
    */
    public function setQuestion($question)
    {
        if (empty($question)) {
            throw new \InvalidArgumentException("Not a valid Argument");
        }

        if (!is_string($question)) {
            throw new \InvalidArgumentException("Argument is not a string");
        }

        if (strlen($question) > 256) {
            throw new \InvalidArgumentException("Question length is to long");
        }
        $this->question = $question;
        return $this;
    }

    /**
     * @param $details
     * @return $this
     */
    public function setDetails($details){

            if (empty($details)) {
                throw new \InvalidArgumentException("Not a valid Argument");
            }
            if (!is_string($details)) {
                throw new \InvalidArgumentException("Argument is not a string");
            }

            if (strlen($details) > 1000) {
                throw new \InvalidArgumentException("Question body is to long");
            }

            $this->details = $details;
            return $this;
    }

    public function setUser(\App\Domain\User $user){
        if(empty($user))
        {
            throw new \InvalidArgumentException('$user is empty');
        }
        $this->userID = $user;
        return $this;
    }

    public function setUpdated($date){
        if(empty($date)){
            throw new \InvalidArgumentException('$date is empty');
        }

        if(!is_string($date)){
            throw new \InvalidArgumentException('$date is not string');
        }
        $this->updatedDate = $date;
        return $this;
    }

    public function setCreated($date){
        if(empty($date)){
            throw new \InvalidArgumentException('$date is empty');
        }

        if(!is_string($date)){
            throw new \InvalidArgumentException('$date is not string');
        }
        $this->updatedDate = $date;
        return $this;
    }

    public function build(){
        if(empty($this->ID)){
            $this->ID = GENERATE_QUESTION_UUID;
        }
        return new \App\Domain\Question($this);
    }
}