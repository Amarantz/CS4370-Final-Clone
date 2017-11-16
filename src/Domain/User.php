<?php
/**
 * 20171011User class
 */

namespace App\Domain;

class User
{

    protected $id;
    protected $email;
    protected $fullName;

    public function __construct($email, $name)
    {
        $this->setEmail($email)
           ->setFullname($name);
        $this->id = uniqid('USR_', true);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getFullname()
    {
        return $this->fullname;
    }

    public function getID()
    {
        return $this->id;
    }

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
