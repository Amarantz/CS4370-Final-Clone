<?php
/**
 * 20171011User class
 */

namespace App\Domain;

class User
{
    protected $email;
    protected $name;

    public function __construct($email, $name)
    {
	   $this->setEmail($email)
	    	->setName($name);
    }

    public function getEmail() {
	    return $this->email;
    }

    public function getName()
    {
	    return $this->name;
    }

    public function setEmail($e)
    {
	    if(empty($e)){
		    throw new \InvalidArgumentException("empty arguments");
	    }

	    if(!is_string($e)){
		    throw new \InvalidArgumentException("arguments are not strings");
	    }
	    if (!filter_var($e,FILTER_VALIDATE_EMAIL)) {
		    throw new \InvalidArgumentException("email is not valid");
	    }
	    $this->email = $e;
	    return $this;
    }

    public function setName($n)
    {
	    if(empty($n)) {
		    throw new \InvalidArgumentException("empty arguments");
	    }
	    if(!is_string($n)) {
		throw new \InvalidArgumentException("arguments are not string");
	    }
	    $this->name = $n;
	    return $this;
    }
}
