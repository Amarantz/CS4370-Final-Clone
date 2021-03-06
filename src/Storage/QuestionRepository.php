<?php
/**
 * Created by PhpStorm.
 * User: Blaine
 * Date: 12/1/2017
 * Time: 10:29 AM
 */

namespace App\Storage;
use App\Storage\AdapterInterface;
use Psr\Log\InvalidArgumentException;
/**
 * Creates an repository for questions that can be store data to different data adapters.
 * Class QuestionRepository
 * @package App\Storage
 */
require_once('RepositoryInterface.php');

class QuestionRepository implements RepositoryInterface
{
    /** @var AdapterInterface $adapter */
    protected $adapter;

    /**
     * QuestionRepository constructor.
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->setAdapter($adapter);
    }

    /**
     * Adds Item to adapter
     * @param $item
     * @return mixed
     */
    public function Add($item)
    {
         return $this->adapter->Insert($item);
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
        if($this->adapter->type() === \App\Storage\EloquentPlugin::class) {
            return $this->build($this->adapter->Get($ID));
        }
        return $this->adapter->Get($ID);
    }

    /**
     * Returns all objects
     * @return mixed
     */
    public function FindAll()
    {
       //var_dump($this->adapter->type());
        if($this->adapter->type() === \App\Storage\EloquentPlugin::class){
            $results = $this->adapter->getAll();
            //var_dump($results);
            $questions = $this->buildArray($results);
            //var_dump($questions);
            return $questions;
        }
        return $this->adapter->GetAll();
    }

    /**
     * Finds an object by string or data
     * @param $mixed
     * @return mixed
     */
    public function FindByString($string)
    {
        if($this->adapter->type() === \App\Storage\EloquentPlugin::class) {
            $this->adapter->SetGetByStringColumn('questionTitle');
        }
        return $this->adapter->GetByString($string);
    }

    /**
     * Updates an object to adapter
     * @param $ID
     * @param $item
     */
    public function Update($ID, $item)    {
        $this->adapter->Modify($ID, $item);
    }

    public function setAdapter(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    protected function buildArray($results){
        $questions = [];
        foreach($results as $question){
            $questions[] = $this->build($question);
        }
        return $questions;
    }

    protected function build($question){
        $qbuilder = new \App\Domain\QuestionBuilder();
        return $qbuilder->setID($question->uuid)
            ->setQuestion($question->questionTitle)
            ->setDetails($question->questionDetails)
            ->setCreated($question->created)
            ->setUpdated($question->updated)
            ->setUser($question->userID)
            ->build();
    }

    public function FindByStringAll($string)
    {
        // TODO: Implement FindByStringAll() method.
    }
}