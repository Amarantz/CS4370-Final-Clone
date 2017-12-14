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
    protected $userID;
    protected $answer;
    protected $upvote;
    protected $questionID;
    protected $created;
    protected $updated;

    /*
     * @return $user;
     */
    public function getUserID()
    {
        return $this->userID;
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
     * @return $upvote 
     */
    public function getUpvote()
    {
        return $this->upvote;
    }

    /*
     * @return $createdDate;
     */
    public function getCreated()
    {
        return $this->created;
    }

    /*
     * @return $modifiedDate
     */
    public function getUpdated()
    {
        return $this->updated;
    }
    public function getID(){
        return $this->ID;
    }

    public function toArray(){
        return array(
            'uuid' => $this->ID,
            'answer' => $this->answer,
            'created' => $this->created,
            'userID' => $this->userID,
            'updated' => $this->updated,
            'questionID'=> $this->questionID,
            'upvote' => $this->upvote,
        );
    }
}
