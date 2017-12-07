<?php
/**
 * Created by PhpStorm.
 * User: Blaine
 * Date: 12/7/2017
 * Time: 7:45 AM
 */

namespace App\Domain;


class UserBuilder extends User
{
    /**
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
        $this->password = $password;
        return $this;
    }

    /**
     * @param \DateTime $date
     * @return $this
     */
    public function setUpdated(\DateTime $date) {
        if(empty($date)) {
            throw new \InvalidArgumentException('Updated date is empty');
        }
        $this->updated = $date;
        return $this;
    }

    /**
     * @param \DateTime $date
     */
    public function setCreated(\DateTime $date){
        if(empty($date)){
            throw new \InvalidArgumentException('Created date is empty');
        }
        $this->created = $date;
    }

    /**
     * @param String $lastname
     * @return $this
     */
    public function setLastname ( $lastname) {
        if(empty($lastname)) {
            throw new \InvalidArgumentException('Lastname is empty');

        }

        if(!is_string($lastname)){
            throw new \InvalidArgumentException('Password is not a string');
        }

        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @param String $firstname
     * @return $this
     */
    public function setFirstname( $firstname){
        if(empty($lastname)) {
            throw new \InvalidArgumentException('Lastname is empty');

        }

        if(!is_string($lastname)){
            throw new \InvalidArgumentException('Password is not a string');
        }

        $this->firstname = $firstname;
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
            throw new \InvalidArgumentException("arguments are not strings");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("email is not valid");
        }
        $this->email = $email;
        return $this;
    }

    public function build(){
        return new \App\Domain\User($this);

    }
}