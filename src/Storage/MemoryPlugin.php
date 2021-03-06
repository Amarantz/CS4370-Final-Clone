<?php

namespace App\Storage;

class MemoryPlugin implements AdapterInterface
{
    protected $array;

    public function __construct()
    {
        $this->RemoveAll();
    }

    public function Insert($item)
    {
	if (!is_object($item)) {
	    throw new \UnexpectedValueException('$item is not a object');
	}else if(!method_exists($item,'getID')) {
	    throw new \UnexpectedValueException('$item does not have a getID() method');
	}
	$this->array[] = $item;
	return $this;
    }

    public function Remove($id)
    {
        $offset = $this->iterate($id);
        if ($offset === -1) {
            return;
        }
        unset($this->array[$offset]);
    }

    public function RemoveAll()
    {
        $this->array = [];
    }

    public function GetAll()
    {
        return $this->array;
    }

    public function Get($id)
    {
        $offset = $this->iterate($id);
        if ($offset === -1) {
            return null;
        }
        return $this->array[$offset];
    }

    public function Modify($id, $item)
    {
	if (!is_object($item)) {
	    throw new \UnexpectedValueException('$item is not a object');
	}else if(!method_exist($item,'getID')) {
	    throw new \UnexpectedValueException('$item does not have a getID() method');
	}

        $offset = $this->iterate($id);
	$this->array[$offset] = $item;
	return $this;
    }

    protected function iterate($id)
    {
        $len = $this->count();
        for ($i = 0; $i < $len; $i++) {
            if ($this->array[$i]->getID() === $id) {
                return $i;
            }
        }
        return -1;
    }

    public function count()
    {
        return count($this->array);
    }

    public function GetByString($string)
    {
        $len = count($this->array);

        for($i=0; $i < $len; $i++){
            $reflection = new \ReflectionClass($this->array[$i]);
            $props = $reflection->getProperties();
            foreach($props as $prop) {
                $value = $prop->getvalue();
                if($value === $string){
                    return $this->array[$i];
                }
            }
        }
        return -1;
    }

    public function Type()
    {
        return get_class($this);
    }
}
