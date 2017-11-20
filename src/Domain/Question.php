<?php
/**
 * Created by Blaine Callahan
 * CS4350 - WSU
 * Fall 2017
 */
namespace App\Domain;

/**
 * Question Concrete class. This is how a question is created when generate in the system. Question Summry or statement has limitation 256 car
 * cahrectors.  and the details of teh question are limited to 1000 carectors. 
 *
 */

class Question
{
	/*
	 * @var $ID - This is the uninque ID that is generated when the class is created. 
	 */
	protected $ID;
	/*
	 * @var $question - this is the statment or question being asked.
	 */
	protected $question;
	/*
	 * @var $details  - This is the complete details or description of the question;
	 */
	protected $details;
	/*
		* @var User - @link \App\Domain\User  This is the user associated with the message
	 */
	protected $user;
	/*
		* @var $updateDate - This is the modified date of the quetion if it has been editied. 
	 */
	protected $updatedDate;
	/*
		* @var createionDate - This is the date the question was created;
	 */
    protected $creationDate;

	/**
	 * Constructor for the Question class. Which generates a UUID Creation date and last modified dates with 
	 * the reqirements of user $question and details 
	 *
	 * @param \App\Domain\User $user
	 * @param string $question
	 * @param string $details
	 */
    public function __construct(\App\Domain\User $user, $question, $details)
    {
        $this->ID = uniqid("QUE_");
        $this->setQuestion($question);
        $this->setDetails($details);
        $this->setUser($user);
        $this->creationDate = date('Y-m-d H:i:s');
        $this->modifiedDate = date('Y-m-d H:i:s');
    }

    /*
     * This allow for the change of the question
     * @param string $s with a limitation of 256 characters
     * @return self
     */
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

    /*
     * Sets the details of the object
     * @param string $s
     *
     * @return self
     */
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

    /*
     * @param \App\Domain\User $u
     * @return this
     */
    protected function setUser(\App\Domain\user $u)
    {
        $this->user = $u;
        return $this;
    }

    /*
     * @return \App\Domain\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /*
     * @return $questioin
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /*
     * @returns $ID
     */
    public function getID()
    {
        return $this->ID;
    }

    /*
     * @return $details
     */
    public function getDetails()
    {
        return $this->details;
    }
}
