<?php
namespace App\Storage;

interface AdapterInterface
{
    public function Insert($item);
    public function Remove($id);
    public function RemoveAll();
    public function Get($id);
    public function GetAll();
    public function Modify($id, $item);
    public function GetByString($string);
    public function Type();
}
