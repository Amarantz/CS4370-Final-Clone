<?php
/**
 * 20171011User class
 */

namespace App\Domain;

/**
 * This is the domain model for the users class
 *
 *
 */
class User
{
    /**
     * @var $id This is the Unique Id for this class when
     */
    protected $id;
    /**
     *@var $email  Email address of the user
     */
    protected $email;
    
    /**
    * @var $fullname Full name of the users
    */
    protected $fullName;

    /**
     * Class Constructor takes in the email address and full name
     * generantes Uuid related with the user once creating the user.
     * @var id is prefix with USR_ and is legnth of 23 charectors
     *
     * @param $email string of email address
     * @param $name String of full name
     */
    public function __construct($email, $name)
    {
        $this->setEmail($email)
           ->setFullname($name);
        $this->id = uniqid('USR_', true);
    }
/**
 *@return string email address
 */
    public function getEmail()
    {
        return $this->email;
    }
/**
 * @return string returns the full name
 */
    public function getFullname()
    {
        return $this->fullname;
    }
/**
 *@return string ID returns the id back
 */
    public function getID()
    {
        return $this->id;
    }
/**
 *@param $e is string of email address
 *
 * @returns self
 */
    protected function setEmail($e)
    {
        if (empty($e)) {
            throw new \InvalidArgumentException("empty arguments");
        }

        if (!is_string($e)) {
            throw new \InvalidArgumentException("arguments are not strings");
        }
        if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("email is not valid");
        }
        $this->email = $e;
        return $this;
    }

    /**
     * @param $n string to set the fulll name
     *
     * @returns self
     */
    protected function setFullname($n)
    {
        if (empty($n)) {
            throw new \InvalidArgumentException("empty arguments");
        }
        if (!is_string($n)) {
            throw new \InvalidArgumentException("arguments are not string");
        }
        $this->fullname = $n;
        return $this;
    }
}
