<?php

class Generator_modele extends CI_Controller
{
	public function index()
	{
		$sql    = "SHOW TABLES";
		$tables = $this->db->query($sql)->result();

		foreach($tables as $tableRow)
		{
			$columns            = array_keys( get_object_vars($tableRow) );
			$firstColumn        = $columns[0];
			$tableName          = $tableRow->$firstColumn;

			$sql                = "SHOW COLUMNS IN `{$tableName}`";
			$columnDefinitions  = $this->db->query( $sql )->result();

			$modified_name      = strtolower ( str_replace(" ","_",$tableName) );
			$modified_name      = str_replace( "-", "_",$modified_name );
			$parts              = explode("_", $modified_name);
			foreach($parts as $i => $part)
			{
				$parts[$i] = ucfirst($part);
			}
			$modified_name = implode("", $parts);

			$folderName         = $modified_name;
			$baseFileName       = "{$modified_name}.php";
			$modelFileName      = "{$modified_name}_model.php";

			$baseClassName      = "Db".ucfirst( $modified_name );
			$modelClassName     = "Db".ucfirst( $modified_name )."Model";


			$baseClassContent   = $this->getBaseClassContent ( $baseClassName , $modelClassName, $tableName, $columnDefinitions );
			$modelClassContent  = $this->getModelClassContent( $modelClassName, $baseClassName  );

			//verificam daca exista folderul, daca nu exista il cream
			$base_path = "./application/helpers/db/";
			$path = "{$base_path}{$folderName}";
			if( !file_exists($path) ) mkdir($path, 0777, true);

			//scriem/re-scriem modelul de baza
			$basefilepath = "{$path}/{$baseFileName}";
			file_put_contents( $basefilepath, $baseClassContent );

			//daca nu exista deja fisierul cu modelul, il cream
			$modelfilepath = "{$path}/{$modelFileName}";
			if( !file_exists( $modelfilepath ) )
			{
				file_put_contents( $modelfilepath, $modelClassContent );
			}
		}
		echo "gata!";

	}

	private function getBaseClassContent($baseClassName, $modelClassName, $tableName, $columnDefinitions)
	{
		$ret ='<?php';
		$ret .= "
	class {$baseClassName} extends DbBase
	{ \n";

		$columnNames = [];

		foreach($columnDefinitions as $cd )
		{
			$tip    = 'string';
			$nume   = $cd->Field;

			if (strpos($cd->Type, 'int'     ) !== false)  $tip = 'int';
			if (strpos($cd->Type, 'date'    ) !== false)  $tip = '\DateTime';
			if (strpos($cd->Type, 'datetime') !== false)  $tip = '\DateTime';
			if (strpos($cd->Type, 'double'  ) !== false)  $tip = 'double';

			$ret .="
		/**
		 * @var {$tip} {$nume}
		 */
		public ".'$'."{$nume}; \n";

			$columnNames[] = "'".$nume."'";
		}

		$ret .="
		/**
		 * @return String numele tabelului din db
		 */
		public static function _getTableName()
		{
			return '{$tableName}';
		}
		";

		$ret .= "
		/**
		 * @return string[] intoarce lista de coloane
		 */
		public function _getColumns()
		{
			return array(";
			$ret .= implode(",", $columnNames);
			$ret .=");";
			$ret .= "
		}
		";

		$ret .= "

		/* @return {$modelClassName} OR null */
		public static function QueryRow()
		{
			return parent::QueryRow();
		}

		/* @return {$modelClassName}[] */
		public static function QueryResult()
		{
			return parent::QueryResult();
		}

		/* @return {$modelClassName}[] */
		public static function QuerySql(\$sql)
		{
			return parent::QuerySql( \$sql);
		}

		public static function query()
		{
			return new {$baseClassName}_Queryable( static::_getTableName() );
		}

		";

		$ret .= '
		public static function constructModel( $id=null)
		{
			return new '.$baseClassName.'( $id);
		}
	}';

		$ret .= "
	class {$baseClassName}_Queryable extends DbQueryableBase
	{
		/* @return {$modelClassName}[] */
		public function get()
		{
			return {$modelClassName}::QueryResult();
		}

		/* @return {$modelClassName}[] */
		public function get_row()
		{
			return {$modelClassName}::QueryRow();
		}
	}
		";



		return $ret;
	}

	private function getModelClassContent($modelClassName, $baseClassName ) {
		$ret  = '<?php';
		$ret .= "
	class {$modelClassName} extends {$baseClassName}
	{ \n";

		$ret .= '
		public static function constructModel($id=null)
		{
			return new '.$modelClassName.'($id);
		}';

		$ret .= "
	}";
		return $ret;

	}
}