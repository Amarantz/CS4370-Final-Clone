<?php
namespace App\Storage;

class UserRepository implements RepositoryInterface
{

    /** @var \App\Storage\AdapterInterface $adapter */
    protected $adapter;

    /**
     * UserRepository constructor.
     * @param \App\Storage\AdapterInterface $adapter
     */
    public function __construct(\App\Storage\AdapterInterface $adapter)
    {
        $this->setAdapter($adapter);
    }

    /**
     * @param AdapterInterface $adapter
     * @return $this
     */
    public function setAdapter(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * @param $item
     */
    public function Add($item)
    {
        $this->adapter->Insert($item);
    }

    /**
     * @param $id
     */
    public function Delete($id)
    {
        $this->Remove($id);
    }

    /**
     *
     */
    public function DeleteAll()
    {
        $this->adapter->RemoveAll();
    }

    /**
     * @param $id
     */
    public function Find($id)
    {
        $this->adapter->Get($id);
    }

    /**
     * Function finds all the records
     */
    public function FindAll()
    {
        // TODO: Implement FindAll() method.
    }


    /**
     * Function that update Items at ID
     * @param $id
     * @param $item
     */
    public function Update($id, $item)
    {
        // TODO: Implement Update() method.
    }
}
