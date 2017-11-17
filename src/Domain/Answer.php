<?php

namespace App\Domain;

class Answer
{

    protected $ID;
    protected $user;
    protected $answer;
    protected $upvote;
    protected $questionID;
    protected $createdDate;
    protected $modifiedDate;

    public function __construct(\App\Domain\User $user, $answer, $questionID)
    {
        $this->ID = uniqid("anw_");
        $this->questionID = $questionID;
        $this->createdDate = date('Y-m-d H:i:s');
        $this->modifiedDate = date('Y-m-d H:i:s');
        $this->upvote = 0;
        $this->user = $user;
        $this->setAnswer($answer);
    }

    public function getUser()
    {
        return $this->user;
    }

    protected function setAnswer($string)
    {

        if (empty($string)) {
            throw new \InvalidArgumentException("Argument is empty");
        }

        if (!is_string($string)) {
            throw new \InvalidArgumentException("Argument is not a string");
        }

        if (strlen($string) > 2000) {
            throw new \InvalidArgumentException("The Argument is to long");
        }

        $this->answer = $string;
        return $this;
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function upvote()
    {
        $this->upvote++;
    }

    protected function setUpvote($int)
    {
        $this->upvote = $int;
        return $this;
    }

    public function getUpvote()
    {
        return $this->upvote;
    }

    public function getCreationDate()
    {
        return $this->createdDate;
    }

    public function getModifiedDate()
    {
        return $this->modifiedDate;
    }
}
