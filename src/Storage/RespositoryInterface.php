<?php
namespace App\Storage;

interface RepositoryInterface
{
    public function Add($item);
    public function Delete($id);
    public function DeleteAll();
    public function Find($string);
    public function FindAll();
    public function Update($id, $item);
}