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
    protected $uuid;
    protected $id;
    protected $question;
    protected $body;
    protected $user;
    protected $updatedDate;
    protected $creationDate;

    public function __construct() {
        $this->uuid = uniqid("que_");
    }

    public function setQuestion($s) {
	if(empty($s)) {
	    throw new \InvalidArgumentException("Not a valid Argument");
	}
	    
        if(!is_string($s)) {
            throw new \InvalidArgumentException("Argument is not a string");
        }

        if(strlen($s) > 256) {
            throw new \InvalidArgumentException("QuestionEloquentModel length is to long");
        }

	$this->question = $s;
	return $this;
    }

    public function setBody($s) {
        if(empty($s)){
	    throw new \InvalidArgumentException("Not a valid Argument");
	}
        if(!is_string($s)) {
            throw new \InvalidArgumentException("Argument is not a string");
        }

        if (strlen($s) > 1000 ) {
            throw new \InvalidArgumentException("QuestionEloquentModel body is to long");
        }

	$this->body = $s;
	return $this;

    }

    public function setCreationDate(\Date $d) {
	$this->creationDate = $d;
	return $this;
    }

    public function getCreationDate() {
	return $this->creationDate;
    }

    public function setUpdateDate(\Date $d) {
	$this->updatedDate = $d ;

	return $this;
    }

    public function setUser(\App\Domain\user $u) {
	$this->user = $u;
	return $this;
    }

    public function getUser() {
        return $this->user;
    }

    public function getQuestion() {
        return $this->question;
    }

    public function getUuid() {
        return $this->uuid;
    }

    public function getBody() {
        return $this->body;
    }
}
