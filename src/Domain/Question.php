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
    protected $updated;
    /*
		* @var createionDate - This is the date the question was created;
	 */
    protected $creation;

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
