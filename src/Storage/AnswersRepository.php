<?php
/**
 * Created by PhpStorm.
 * User: Blaine
 * Date: 12/1/2017
 * Time: 11:22 AM
 */

namespace App\Storage;


class AnswersRepository implements RepositoryInterface
{

    protected $adapter;

    /**
     * AnswersRepository constructor.
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param $item
     * @return mixed
     */
    public function Add($item)
    {
         return $this->adapter->insert($item);
    }

    /**
     * @param $ID
     */
    public function Delete($ID)
    {
        $this->adapter->Remove($ID);
    }

    /**
     *
     */
    public function DeleteAll()
    {
        $this->adapter->RemoveAll();
    }

    /**
     * @param $ID
     * @return mixed
     */
    public function Find($ID)
    {
        return $this->adapter->GET($ID);
    }

    /**
     * @return mixed
     */
    public function FindAll()
    {
        return $this->adapter->getAll();
    }

    /**
     * @param $string
     * @return mixed
     */
    public function FindByString($string)
    {
        if($this->adapter->type() === \App\Storage\EloquentPlugin::class) {
            $this->adapter->SetGetByStringColumn('answer');
        }
        return $this->adapter->GetByString($string);
    }

    /**
     * @param $ID
     * @param $item
     */
    public function Update($ID, $item)
    {
        $this->adapter->Modify($ID, $item);
    }
}