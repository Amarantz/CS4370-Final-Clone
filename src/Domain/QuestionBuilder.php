<?php
/**
 * Created by PhpStorm.
 * User: Blaine
 * Date: 12/7/2017
 * Time: 6:48 PM
 */

namespace App\Domain;

require_once __DIR__ . '/../constants.php';
class QuestionBuilder extends Question
{
//    protected $ID;
//    protected $question;
//    protected $details;
//    protected $user;
//    protected $updatedDate;
//    protected $creationDate;

    protected $questions;

    public function __construct()
    {
        $this->questions = new \App\Domain\Question();
    }

    public function setID($uuid)
    {
        if(empty($uuid))
        {
            throw new \InvalidArgumentException('$uuid is empty');
        }
        if(!is_string($uuid))
        {
            throw new \InvalidArgumentException('$uuid is not a string');
        }
        $this->questions->ID = $uuid;
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
        $this->questions->question = $question;
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

            $this->questions->details = $details;
            return $this;
    }

    public function setUser($userID){
        if(empty($userID))
        {
            throw new \InvalidArgumentException('$user is empty');
        }
        if(!is_string($userID))
        {
            throw new \InvalidArgumentException('$user is not a string');
        }
        $this->questions->userID = $userID;
        return $this;
    }

    public function setUpdated($date){
        if(empty($date)){
            throw new \InvalidArgumentException('$date is empty');
        }

        if(!is_string($date)){
            throw new \InvalidArgumentException('$date is not string');
        }
        $this->questions->updatedDate = $date;
        return $this;
    }

    public function setCreated($date){
        if(empty($date)){
            throw new \InvalidArgumentException('$date is empty');
        }

        if(!is_string($date)){
            throw new \InvalidArgumentException('$date is not string');
        }
        $this->questions->updatedDate = $date;
        return $this;
    }

    public function build(){
        if(empty($this->questions->ID)){
            $this->questions->ID = GENERATE_QUESTION_UUID;
        }
        if(empty($this->questions->created)){
            $this->questions->created = NOW;
        }
        if(empty($this->questions->updated)){
            $this->questions->updated = NOW;
        }
        return $this->questions;
    }
}