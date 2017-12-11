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
    * @var $firstname first name of the users
    */
    protected $firstname;

    /**
     * @var $lastname Last name of the user
     */
    protected $lastname;

    /**
     * @var $password
     */
    protected $password;

    protected $created;
    protected $updated;

    /**
     * Class Constructor takes in the email address and full name
     * generantes Uuid related with the user once creating the user.
     * @var id is prefix with USR_ and is legnth of 23 charectors
     *
     * @param $email string of email address
     * @param $name String of full name
     */
    public function __construct()
    {

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
        return $this->firstname . ' ' . $this->lastname;
    }
/**
 *@return string ID returns the id back
 */
    public function getID()
    {
        return $this->id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
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
    public function getPassword()
    {
        return $this->password;
    }

    public function toArray()
    {
        return array(
            'uuid' => $this->id,
            'email' => $this->email,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'password' => $this->password,
            'created' => $this->created,
            'updated' => $this->updated,
            );
    }

    protected function getParent(){
        return $this;
    }

}
