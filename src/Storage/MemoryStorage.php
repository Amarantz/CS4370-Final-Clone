<?php

namespace App\Storage;

class MemoryStorage implements AdapterInterface
{
    protected $array;

    public function __construct()
    {
        $this->RemoveAll();
    }

    public function Insert($item)
    {
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
        return $this->array[$offset];
    }

    public function Modify($id, $item)
    {
        $offset = $this->iterate($id);
        $this->array[$offset] = $item;
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
}
