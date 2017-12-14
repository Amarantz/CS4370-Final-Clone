<?php
/**
 * Created by PhpStorm.
 * User: Blaine
 * Date: 12/1/2017
 * Time: 11:22 AM
 */

namespace App\Storage;


use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class AnswersRepository implements RepositoryInterface
{

    protected $adapter;

    /**
     * AnswersRepository constructor.
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->setAdapter($adapter);
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

    /**
     * @param $results
     * @return array
     */
    protected function buildArray($results){
        $anwsers = [];
        foreach($results as $anwser){
            $r = $this->build($anwser);
            //var_dump($r);
            $anwsers[] = $r;
        }
        return $anwsers;
    }

    /**
     * @param $answer
     * @return \App\Domain\Answer
     */
    protected function build($answer){
        $aBuilder = new \App\Domain\AnswerBuilder();
        return $aBuilder->setID($answer->uuid)
            ->setQuestionID($answer->questionID)
            ->setAnswer($answer->answer)
            ->setCreated($answer->created)
            ->setUpdated($answer->updated)
            ->setUserID($answer->userID)
            ->setUpvote($answer->upvote)
            ->build();
    }

    /**
     * @param $questionID
     * @return array
     */
    public function FindAnswersByQuestionID($questionID){
        if($this->adapter->type() === \App\Storage\EloquentPlugin::class) {
            $this->adapter->SetGetByStringColumn('questionID');
            $results = $this->adapter->GetByStringAll($questionID);
            //var_dump($results);
            return $this->buildArray($results);

        }
        return $this->adapter->GetByStringAll($questionID);
    }

    public function setAdapter(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function FindByStringAll($string)
    {
        // TODO: Implement FindByStringAll() method.
    }
}