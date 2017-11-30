<?php
namespace App\Storage;
use App\Storage\AdapterInterface;
include('RespositoryInterface.php');

class UserRepository implements RepositoryInterface
{

    /** @var AdapterInterface $adapter */
    protected $adapter;

    /**
     * UserRepository constructor.
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
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
        $this->adapter->Remove($id);
    }

    /**
     * delete all items from the repo.
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
        $this->adapter->GetAll();
    }


    /**
     * Function that update Items at ID
     * @param $id
     * @param $item
     */
    public function Update($id, $item)
    {
        $this->adapter->Modify($id,$item);
    }

    public function FindByUsername($string)
    {
        if($this->adapter->type() === \App\Storage\EloquentPlugin::class) {
            $this->adapter->SetGetByStringColumn('email');
        }
        return $this->adapter->GetByString($string);
    }

    public function FindByString($string)
    {
        // TODO: Implement FindByString() method.
    }
}
