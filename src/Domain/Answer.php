<?php

namespace App\Domain;


/*
 * This is the Answer class
 * has automaticly generated ID
 * Associates to the user\
 * Has Modified Date 
 * Has creation Date
 * Has upvote
 */
class Answer
{
	/*
	 * @var string $ID
	 * @var \App\Domain\User $user
	 * @var int $upvote
	 * @var string $questionID
	 * @var datetime $createdDate
	 * @var datetiem @modiifiedDate
	 */
    protected $ID;
    protected $user;
    protected $answer;
    protected $upvote;
    protected $questionID;
    protected $createdDate;
    protected $modifiedDate;

    /*
     * Constructor for the class 
     * @param \App\Domain\User $user
     * @param string $answer
     * @param string $questionID
     */
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

    /*
     * @return $user;
     */
    public function getUser()
    {
        return $this->user;
    }

    /*
     * @param string $string
     *
     * @return self
     */
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

    /*
     * @return $answer
     */
    public function getAnswer()
    {
        return $this->answer;
    }
	/*
	 * This incurments the upvote value
	 */
    public function upvote()
    {
        $this->upvote++;
    }

    /*
     * @param int $int
     */
    protected function setUpvote($int)
    {
        $this->upvote = $int;
        return $this;
    }

    /*
     * @return $upvote 
     */
    public function getUpvote()
    {
        return $this->upvote;
    }

    /*
     * @return $createdDate;
     */
    public function getCreationDate()
    {
        return $this->createdDate;
    }

    /*
     * @return $modifiedDate
     */
    public function getModifiedDate()
    {
        return $this->modifiedDate;
    }
}
