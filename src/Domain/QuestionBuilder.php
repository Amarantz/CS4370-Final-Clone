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
        $this->ID = $uuid;
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

    public function setUser($userID){
        if(empty($userID))
        {
            throw new \InvalidArgumentException('$user is empty');
        }
        if(!is_string($userID))
        {
            throw new \InvalidArgumentException('$user is not a string');
        }
        $this->userID = $userID;
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
        if(empty($this->created)){
            $this->created = NOW;
        }
        if(empty($this->updated)){
            $this->updated = NOW;
        }
        $q = new \App\Domain\Question();
        $q->question = $this->question;
        $q->ID = $this->ID;
        $q->userID = $this->userID;
        $q->updated = $this->updated;
        $q->created = $this->created;
        $q->details = $this->details;
        return $q;
    }
}