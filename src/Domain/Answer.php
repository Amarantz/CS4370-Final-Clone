<?php

namespace App\Domain;

class Answer {

	protected $ID;
	protected $user;
	protected $answer;
	protected $upvote;
	protected $questionID;
	protected $createdDate;
	protected $modifiedDate;
	protected $uuid;

	public function __construct(){
		$this->uuid = uniqid("anw_");
		$this->createdDate = date('Y-m-d H:i:s');
		$this->upvote = 0;
	}

	public function setUser(\App\Domain\User $u){
		$this->user = $u;
		return $this;
	}

	public function getUser(){
		return $this->user;
	}

	public function setAnswer($string){

		if(empty($string)){
			throw new \InvalidArgumentException("Argument is empty");
		}

		if(!is_string($string)){
			throw new \InvalidArgumentException("Argument is not a string");
		}

		if(strlen($string) > 2000)
		{
			throw new \InvalidArgumentException("The Argument is to long");
		}

		$this->answer = $string;
		return $this;
	}

	public function getAnswer()
	{
		return $this->answer;
	}

	public function upvote(){
		$this->upvote++;
	}

	public function setUpvote($int)
	{
		$this->upvote = $int;
		return $this;
	}

	public function getUpvote(){
		return $this->upvote;
	}

	public function getCreationDate()
	{
		return $this->createdDate;
	}

}
