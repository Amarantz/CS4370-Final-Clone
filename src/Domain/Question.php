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
		* @var $userID has the Assocated USER ID
	 */
    protected $userID;
    /*
		* @var $updateDate - This is the modified date of the quetion if it has been editied. 
	 */
    protected $updated;
    /*
		* @var createionDate - This is the date the question was created;
	 */
    protected $created;


    /**
     * Returns the the userID
     * @return $userID
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /*
     * Returns the question
     * @return $question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Returns the UUID for the question
     * @returns $ID
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * Get the details of the question
     * @return $details
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Generates an Array to use with the database.
     * @return array
     */
    public function toArray() {
        return array(
            'uuid' => $this->ID,
            'userID' => $this->userID,
            'questionTitle' => $this->question,
            'created' => $this->created,
            'updated' => $this->updated,
            'questionDetails' => $this->details,
        );
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}
