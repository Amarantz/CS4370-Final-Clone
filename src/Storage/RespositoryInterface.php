<?php
/**
 * Created by PhpStorm.
 * User: Blaine
 * Date: 11/30/2017
 * Time: 9:13 AM
 */

namespace App\Storage;

interface RepositoryInterface{
    public function Add($item);
    public function Delete($ID);
    public function DeleteAll();
    public function Find($ID);
    public function FindAll();
    public function FindByString($string);
    public function Update($ID, $item);
}
