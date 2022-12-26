<?php

class PaginationInfo
{
	public $Page      = 0;
	public $PerPage   = 10;
	public $RowCount  = 0;
	public $PageSizes = [10, 100, 200, 500];

	public function __construct( $fromArray=null )
	{
		if (!empty($fromArray))
		{
			$this->Page      = intval( $fromArray['Page'     ]);
			$this->PerPage   = intval( $fromArray['PerPage'  ]);
			$this->RowCount  = intval( $fromArray['RowCount' ]);
			$this->PageSizes = [];
			foreach($fromArray["PageSizes"] as $page_size){
				$this->PageSizes[] = intval( $page_size );
			}
		}
	}
}

class TableSqlResult
{
	/* @var array $Rows */
	public $Rows          = [];

	/* @var integer $Rows */
	public $FullRowsCount = 0;

	public $Sql_Count  = "";
	public $Sql_Select = "";

}

class TableSql
{
	private $sql = "";
	private $db;

	public function __construct($sql="")
	{
		$ci         = &get_instance();
		$this->db   = $ci->db;
		$this->sql  = $sql;
	}


	/**
	 * @param $sql sqlul normal, dar poate contine [LIMIT offset, count] pe care stie clasa sa il inlocuiasca la nevoie
	 */
	public function add($sql)
	{
		$this->sql .= $sql;
	}

	/* @param PaginationInfo $pg_info */
	public function addLimitFromPagination($pg_info)
	{
		$offset = ( $pg_info->Page - 1 ) * $pg_info->PerPage;
		$count  = $pg_info->PerPage;

		$this->add("[LIMIT {$offset}, {$count}]");
	}

	/**
	 * @param $query string query-ul ca string unde adaug $sql parsuit
	 * @param $filterValue string valoarea pe care am primit-o pt filtru
	 * @param $ignoreFilterValue string valoarea pe care trebuie sa o ignoram ( ex: -1 sau "" )
	 * @param $sql ce sql adaugam la $query - string unde vrem valoarea se pune %s
	 */
	public function addIfNeeded( $filterValue, $ignoreFilterValue, $sql)
	{
		if ( $filterValue != $ignoreFilterValue )
		{
			$this->sql .= sprintf( $sql, $filterValue );
		}
	}


	public function addOrderBy($column,$direction='ASC')
	{
		$this->sql .= " ORDER BY ".$column." ".$direction." ";
	}

    public function addOrderByRaw($sql)
    {
        $this->sql .= " ORDER BY {$sql} ";
    }

	public function getParsedSql( $withLimit = true )
	{
		$ret = $this->sql;


		if( strstr($ret, "[LIMIT") != FALSE )
		{
			//inlocuim cu limit real
			$str_to_replace = $this->get_string_between($ret,"[LIMIT ", "]");
			$parts          = explode(",", $str_to_replace);
			$offset         = $parts[0];
			$count          = $parts[1];
			if( $withLimit )
			{

				$ret = str_replace(  "[LIMIT {$str_to_replace}]", "LIMIT $offset, $count", $ret);
			}
			else
			{
				$ret = str_replace(  "[LIMIT {$str_to_replace}]", " ", $ret);
			}
		}


		return $ret;
	}

	private function get_string_between ($str,$from,$to) {

		$string = substr($str, strpos($str, $from) + strlen($from));

		if (strstr ($string,$to,TRUE) != FALSE) {

			$string = strstr ($string,$to,TRUE);
		}
		return $string;
	}


	/* @return TableSqlResult */
	public function getResult()
	{
		$ret = new TableSqlResult();
		//calculam mai intai count-ul

		$ret->Sql_Count     = $this->getParsedSql( false );
		$ret->FullRowsCount = $this->db->query($ret->Sql_Count)->num_rows();

		//calculam si results-ul
		$ret->Sql_Select    = $this->getParsedSql( true );
		$ret->Rows          = $this->db->query($ret->Sql_Select)->result();

		return $ret;
	}
}