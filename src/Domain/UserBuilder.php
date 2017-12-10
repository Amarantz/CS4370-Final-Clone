<?php
/**
 * Created by PhpStorm.
 * User: Blaine
 * Date: 12/7/2017
 * Time: 7:45 AM
 */

namespace App\Domain;
require_once __DIR__ . '/../constants.php';


class UserBuilder extends User
{
    protected $user;

    public function __construct()
    {
        $this->user = new \App\Domain\User();
    }

    /**
     * Set the password
     * @param String $password
     * @return $this
     */
    public function setPassword($password) {
        if(empty($password)) {
            throw new \InvalidArgumentException('Password is empty');
        }
        if(!is_string($password)){
            throw new \InvalidArgumentException('Password is not a string');
        }
        $this->user->password = $password;
        return $this;
    }

    /**
     * Set the updated date
     * @param \DateTime $date
     * @return $this
     */
    public function setUpdated($date) {
        if(empty($date)) {
            throw new \InvalidArgumentException('$date is empty');
        }
        if(!is_string($date)){
            throw new \InvalidArgumentException('$date is not a string');
        }
        $this->user->updated = $date;
        return $this;
    }

    /**
     * Set the created date
     * @param \DateTime $date
     */
    public function setCreated($date){
        if(empty($date)) {
            throw new \InvalidArgumentException('$date is empty');
        }
        if(!is_string($date)){
            throw new \InvalidArgumentException('$date is not a string');
        }
        $this->user->created = $date;
        return $this;
    }

    /**
     * set the last name of the profile
     * @param String $lastname
     * @return $this
     */
    public function setLastname ( $lastname) {
        if(empty($lastname)) {
            throw new \InvalidArgumentException('$lastname is empty');

        }

        if(!is_string($lastname)){
            throw new \InvalidArgumentException('$lastname is not a string');
        }

        $this->user->lastname = $lastname;
        return $this;
    }

    /**
     * Set the first name on the user object
     * @param String $firstname
     * @return $this
     */
    public function setFirstname($firstname){
        if(empty($firstname)) {
            throw new \InvalidArgumentException('$firstname is empty');

        }
        if(!is_string($firstname)){
            throw new \InvalidArgumentException('$firstname is not a string');
        }
        $this->user->firstname = $firstname;
        return $this;
    }

    /**
     * Set the UUID for the profile.
     *
     * @param $uuid
     * @return $this
     */
    public function setID($uuid){
        if(empty($uuid)){
            throw new \InvalidArgumentException('$uuid is empty');
        }
        if(!is_string($uuid))
        {
            throw new \InvalidArgumentException('$uuid is not a string');
        }
        $this->user->id = $uuid;
        return $this;
    }


    /**
     * set the new updated date if there is profile update.
     * @return $this
     */
    public function modify(){
        $this->user->updated = NOW;
        return $this;
    }

    /**
     *@param $e is string of email address
     *
     * @returns self
     */
    public function setEmail($email)
    {
        if (empty($email)) {
            throw new \InvalidArgumentException("empty arguments");
        }

        if (!is_string($email)) {
            throw new \InvalidArgumentException('$email is not a string');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("email is not valid");
        }
        $this->user->email = $email;
        return $this;
    }

    /**
     * @return User
     */
    public function build(){
        if(empty($this->id) || $this->id === ''){
            $this->user->id = GENERATE_USER_UUID;
        }
        if(empty($this->created) || $this->created ===''){
            $this->user->created = NOW;
        }
        if(empty($this->updated) || $this->updated ===''){
            $this->user->updated = NOW;
        }
        return $this->user;

    }
}