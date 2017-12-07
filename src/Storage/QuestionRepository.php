<?php
/**
 * Created by PhpStorm.
 * User: Blaine
 * Date: 12/1/2017
 * Time: 10:29 AM
 */

namespace App\Storage;

/**
 * Creates an repository for questions that can be store data to different data adapters.
 * Class QuestionRepository
 * @package App\Storage
 */
class QuestionRepository implements RepositoryInterface
{
    protected $adapter;

    /**
     * QuestionRepository constructor.
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Adds Item to adapter
     * @param $item
     * @return mixed
     */
    public function Add($item)
    {
         return $this->adapter->insert($item);
    }

    /**
     * Deletes Object
     * @param $ID
     */
    public function Delete($ID)
    {
        $this->adapter->Remove($ID);
    }

    /**
     * Delete all items.
     */
    public function DeleteAll()
    {
        $this->adapter->RemoveAll();
    }

    /**
     * Returns Object with ID
     * @param $ID
     * @return mixed
     */
    public function Find($ID)
    {
         return $this->adapter->Get($ID);
    }

    /**
     * Returns all objects
     * @return mixed
     */
    public function FindAll()
    {
         return $this->adapter->GetAll();
    }

    /**
     * Finds an object by string or data
     * @param $mixed
     * @return mixed
     */
    public function FindByString($mixed)
    {
        if($this->adapter->type() === \App\Storage\EloquentPlugin::class) {
            $this->adapter->SetGetByStringColumn('questions');
        }
        return $this->adapter->GetByString($mixed);
    }

    /**
     * Updates an object to adapter
     * @param $ID
     * @param $item
     */
    public function Update($ID, $item)
    {
        $this->adapter->Modify($ID, $item);
    }
}