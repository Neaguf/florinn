<?php

abstract class DbBase
{
	private $db;
    private $ci;

	public function __construct( $id=null, $dbConnection=null )
	{
		$ci = & get_instance();
		//
		if( $dbConnection == null )
			$this->db = $ci->db;
		else
			$this->db = $dbConnection;

		$this->ci = $ci;

		if( $id != null )
		{
			$this->db->where( $this->_getPrimaryKeyColumn(), $id);
			$query = $this->db->get( static::_getTableName() );

			if( $query->num_rows() > 0 )
			{
				$this->constructFromRow( $query->row() );
			}
			else
			{
				$me = get_class($this);
				throw new Exception("[{$me}]: ID inexistent:".$id);
			}
		}
	}

    public function __debugInfo()
    {
        return json_decode(json_encode($this), true);
    }

	public function changeDbConnection($dbConnection)
	{
		$this->db = $dbConnection;
	}

	/**
	 * @return String numele tabelului din db
	 */
	public static function _getTableName() { return ""; }
	public static function constructModel($id=null){ return null; }

	/**
	 * @return string numele coloanei primare. poate fi suprascris la nevoie
	 */
	public function _getPrimaryKeyColumn()
	{
		return "Id";
	}

	/**
	 * @return int intoarce valoarea cheiei primare
	 */
	public function _getPrimaryKeyValue()
	{
		$data = $this->_getData();
		return $data[ $this->_getPrimaryKeyColumn() ];
	}


	/**
	 * @return string[] intoarce lista de coloane
	 */
	abstract public function _getColumns();

	/**
	 * @param bool $includeIdColumn includem in rezultat si coloana primara
	 * @return array[key=>value] intoarce elementele pt db sub forma key=>value
	 */
	private function _getData($includeIdColumn=true, $withoutNulls=false)
	{
		$ret      = array();
		//
		$columns  = $this->_getColumns();
		$idColumn = $this->_getPrimaryKeyColumn();

		if(!$includeIdColumn)
		{
			$key  = array_search($idColumn,$columns);
			unset( $columns[ $key ] );
		}

		foreach($columns as $columnName )
		{
			if( $this->$columnName == null && $withoutNulls)
			{
				continue;
			}
			$ret[$columnName] = $this->$columnName;
		}
		return $ret;
	}

	/**
	 * insereaza in tabel modelul curent
	 *
	 * @param bool $includeIdColumn
	 *
	 * @return integer new id
	 */
	public function Insert($includeIdColumn=false, $withoutNulls=false)
	{
		$this->beforeInsert();

		$data = $this->_getData($includeIdColumn, $withoutNulls);

		$this->db->insert( static::_getTableName(), $data);

		$idColumn        = $this->_getPrimaryKeyColumn();
		$this->$idColumn = $this->db->insert_id();

		$this->afterInsert();
		//
		//
		return $this->$idColumn;
	}

	/**
	 * updatam in tabel modelul curent
	 */
	public function Update($withoutNulls=false)
	{
		$this->beforeUpdate();
		$data = $this->_getData(false, $withoutNulls);
		$this->db->where    ( $this->_getPrimaryKeyColumn(), $this->_getPrimaryKeyValue() );
		$this->db->update   ( static::_getTableName()       , $data );
		$this->afterUpdate();

	}

   //you can override this anywhere
	public function afterInsert (){}
	public function afterUpdate (){}
	public function afterDelete (){}

	public function beforeInsert(){}
	public function beforeUpdate(){}
	public function beforeDelete(){}

	/**
	 * stergem din tabel modelul curent
	 */
	public function Delete()
	{
		$this->beforeDelete();
		$this->db->where    ( $this->_getPrimaryKeyColumn(), $this->_getPrimaryKeyValue() );
		$this->db->delete   ( static::_getTableName() );
		$this->afterDelete();

	}

	/**
	 * @param $row Object construim modelul dintr-un row CI din baza de date
	 */
	public function constructFromRow($row)
	{
		$data = $this->_getColumns();
		foreach( $data as $columnName)
		{
			$this->$columnName = $row->$columnName;
		}
	}

	public function SendToSync($action)
	{
		if($this->_getTableName() != "last_modified" )
		{
			$m               = new DbLastModifiedModel();
			$m->Action       = $action;
			$m->RowId        = $this->_getPrimaryKeyValue();
			$m->TableName    = $this->_getTableName();
			$m->ModifiedDate = date( "Y-m-d H:i:s" );
			$m->Insert();
		}
	}

	/**
	 * @param $row Object construim modelul dintr-un obiect json
	 */
	public function constructFromJson($json)
	{
		$data = $this->_getColumns();
		foreach( $data as $columnName)
		{
			$this->$columnName = $json->$columnName;
		}
	}

	/**
	 * @param $row Array construim modelul dintr-un obiect json
	 */
	public function constructFromArray($array)
	{
		$data = $this->_getColumns();
		foreach( $data as $columnName)
		{
			if( array_key_exists($columnName, $array) )
				$this->$columnName = $array[$columnName];
		}
	}

    /**
     * @param $row Array construim modelul dintr-un obiect json
     */
    public function constructFromObject($obj)
    {
        $data = $this->_getColumns();
        foreach( $data as $columnName)
        {
            if( isset($obj->$columnName) )
                $this->$columnName = $obj->$columnName;
        }
    }

	/**
	 * @return DbBase[] array de obiecte de tipul extins din DbBase
	 */
	public static function QueryResult()
	{
		$ci     = & get_instance();

		$ret    = [];

		$result = $ci->db->get( static::_getTableName() )->result();


		foreach($result as $row)
		{
			$newModel = static::constructModel();
			$newModel->constructFromRow( $row );
			$ret[] = $newModel;
		}
		return $ret;
	}

	/**
	 * @param $ci CodeIgniter construim lista dintr-un query
	 * @return DbBase[] array de obiecte de tipul extins din DbBase
	 */
	public static function QuerySql($sql)
	{
		$ci = & get_instance();

		$ret    = [];
		$result = $ci->db->query( $sql )->result();

		//daca vreau sa fac un query compus, cum imi mai returneaza obiectul?
		//daca modific numele tabelului in db, la regenerare clase nu o sa se modifice si
		foreach($result as $row)
		{
			$newModel = static::constructModel();
			$newModel->constructFromRow( $row );
			$ret[] = $newModel;
		}
		return $ret;
	}

	/**
	 * @return DbBase obiectul de tipul extins din DbBase
	 */
	public static function QueryRow()
	{
		$ci = & get_instance();
		//cum iau aici un rand daca nu am query dupa id?
		$ret    = null;
		$result = $ci->db->get(static::_getTableName());

		if($result->num_rows()>0)
		{
			$ret = static::constructModel();
			$ret->constructFromRow($result->row());
		}

		return $ret;
	}
}


abstract class DbQueryableBase
{
	private $ci;
    private $db;
	protected $dbTableName;

	/* @param DbBase $dbBase */
	public function __construct(  $dbTableName )
	{
		$this->ci           = & get_instance();
		$this->db           = $this->ci->db;
		$this->dbTableName  = $dbTableName;
	}

	/* @return array id->text pentru form_dropdown */
	public function dropdown_get($valueColumn, $textColumn)
	{
		$ret    = [];
		$result = $this->db->get( $this->dbTableName )->result();
		foreach($result as $row)
		{
			$ret[ $row->$valueColumn ] = $row->$textColumn;
		}
		return $ret;
	}

	public function where($column, $value, $protectFields=TRUE)
	{
		$this->db->where($column, $value, $protectFields);
		return $this;
	}

	public function whereRaw( $sql )
    {
	    return $this->where( $sql, '', FALSE );
    }

	public function limit($count, $offset=0)
	{
		$this->db->limit($count, $offset);
		return $this;
	}

	public function group_by($column)
	{
		$this->db->group_by($column);
		return $this;
	}

	public function order_by($column, $order='ASC')
	{
		$this->db->order_by($column, $order);
		return $this;
	}

	public function set($column, $value, $escape=TRUE)
	{
		$this->db->set($column, $value, $escape);
		return $this;
	}

    public function where_in($column, $values)
    {
        $this->db->where_in($column, $values);
        return $this;
    }

	public function or_where($column, $value)
	{
		$this->db->or_where($column, $value);
		return $this;
	}

    public function where_not_in($column, $values)
    {
        $this->db->where_not_in($column, $values);
        return $this;
    }

    /* @return DbBase obiectele generate de query */
	public abstract function get();

	public function count()
	{
		$this->db->from( $this->dbTableName );
		return $this->db->count_all_results();
	}

	public function update()
	{
		$this->db->update( $this->dbTableName );
	}

	public function delete()
	{
		$this->db->delete( $this->dbTableName );
	}




}

//include all files
$directory          = "./application/helpers/db";
$scanned_directory  = array_diff(scandir($directory), array('..', '.'));

foreach($scanned_directory  as $dir)
{
	$fullDir = "{$directory}/{$dir}";
	if( is_dir($fullDir) ) 
	{
		foreach (glob("{$directory}/{$dir}/*.php") as $filename)
		{
			require_once( $filename );
		}
	}
}

?>