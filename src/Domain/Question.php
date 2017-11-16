<?php
/**
 * Created by PhpStorm.
 * UserEloquentModel: Blaine
 * Date: 11/12/2017
 * Time: 10:06 AM
 */

namespace App\Domain;

class Question
{
    protected $ID;
    protected $question;
    protected $details;
    protected $user;
    protected $updatedDate;
    protected $creationDate;

    public function __construct(\App\Domain\User $user, $question, $details)
    {
        $this->ID = uniqid("QUE_");
        $this->setQuestion($question);
        $this->setDetails($details);
        $this->setUser($user);
        $this->creationDate = date('Y-m-d H:i:s');
        $this->modifiedDate = date('Y-m-d H:i:s');
    }

    protected function setQuestion($s)
    {
        if (empty($s)) {
            throw new \InvalidArgumentException("Not a valid Argument");
        }
        
        if (!is_string($s)) {
            throw new \InvalidArgumentException("Argument is not a string");
        }

        if (strlen($s) > 256) {
            throw new \InvalidArgumentException("Question length is to long");
        }

        $this->question = $s;
        return $this;
    }

    protected function setDetails($s)
    {
        if (empty($s)) {
            throw new \InvalidArgumentException("Not a valid Argument");
        }
        if (!is_string($s)) {
            throw new \InvalidArgumentException("Argument is not a string");
        }

        if (strlen($s) > 1000) {
            throw new \InvalidArgumentException("Question body is to long");
        }

        $this->details = $s;
        return $this;
    }

    protected function setUser(\App\Domain\user $u)
    {
        $this->user = $u;
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function getID()
    {
        return $this->ID;
    }

    public function getDetails()
    {
        return $this->details;
    }
}
