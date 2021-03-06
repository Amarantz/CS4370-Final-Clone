<?php

/**
 * 
 * date: 11/21/2017
 */

namespace App\Storage;

use Doctrine\Instantiator\Exception\UnexpectedValueException;
use Illuminate\Database\Query\Builder;
class EloquentPlugin implements AdapterInterface 
{
	/**
	 * @var $query Builder
	 **/
	protected $query;
	protected $columnName;

    /**
     * EloquentPlugin constructor.
     * @param Builder $query
     */
    public function __construct(Builder $query)
	{
		if(empty($query)) {
			throw new UnexpectedValueException('$query cannot be empty');
		}

		$this->query = $query;
		$this->columnName = '';
	}

    /**
     * Inserts an item item in to the table.
     * @param $item
     * @return int
     */
    public function Insert($item) {

	    if(!is_object($item)) {
	        throw new UnexpectedValueException('$item is not an object');
        }

        if(!method_exists($item, 'getID')) {
	        throw new UnexpectedValueException('$item does not have getID() function');
        }

        if(!method_exists($item, 'toArray')) {
	        throw new UnexpectedValueException('$item does not have toArray() function');

	    }

        return $this->query->insertGetId($item->toArray());
		
	}

    /**
     * Require the ID of the object
     * @param $ID
     */
    public function Remove($ID) {
	    if(empty($ID))
        {
            throw new UnexpectedValueException('$ID does not exist');
        }
        if(!is_string($ID)){
	        throw new UnexpectedValueException('$ID is not a string');
        }

        $this->query->where('uuid','=',$ID)->update(['inactive' => -1]);
	}

    /**
     * This removes all items from the database.
     */
    public function RemoveAll() {
	    return $this->query->truncate();
		
	}


    /**
     * Gets the row at $ID
     * @param $ID
     * @return \Illuminate\Support\Collection
     */
    public function Get($ID) {
        if(empty($ID))
        {
            throw new UnexpectedValueException('$ID does not exist');
        }
        return $this->query->where('uuid','=' ,$ID)->first();

	}


    /**
     *  Returns all rows from table.
     * @return \Illuminate\Support\Collection
     */
    public function GetAll() {
        	return $this->query->where('inactive','=',0)->get();
	}


    /**
     * Modifies a record in the database.
     * @param $ID
     * @param $item
     *
     */
    public function Modify($ID, $item) {
		if(empty($ID)){
			throw new UnexpectedValueException('$ID does not exist');
		}

		if(empty($item)){
			throw new UnexpectedValueException('$item does not exist');
		}
		if(!is_object($item)){
			throw new UnexpectedValueException('$item is not a object');
		}
		if(!method_exists($item,'toArray')){
		    throw new UnexpectedValueException('$item does not have a toArray() method');
        }

		$this->query->where('uuid','=',$ID)->update($item->toArray());
	}


    /**
     * This requires that the column name is set on the  This should Also work with using numbers if need to pass to the database for querying
     * @param $searchValue
     * @return $mixed
     */
    public function GetByString($searchValue)
    {
        if($this->columnName === ''){
           throw new UnexpectedValueException('$columnName is not set');
        }

        if(empty($searchValue)){
            throw new UnexpectedValueException('$String is empty');
        }

        return $this->query->where($this->columnName,$searchValue)->first();

    }

    /**
     * Gets the type of adapter
     * @return string
     */
    public function Type()
    {
        return get_class($this);
    }


    /**
     * Sets the column name to search on when doing a string search.
     * @param $column_name
     * @return $this
     */
    public function SetGetByStringColumn($column_name){
        if(empty($column_name)){
            throw new \UnexpectedValueException('$column_name is empty');
        }


         $this->columnName = $column_name;
         return $this;
    }

    public function GetByStringAll($string)
    {
        if($this->columnName === ''){
            throw new UnexpectedValueException('$columnName is not set');
        }

        if(empty($string)){
            throw new UnexpectedValueException('$String is empty');
        }

        return $this->query->where($this->columnName,$string)->get();
    }
}
