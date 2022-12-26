<?php
	class DbFacturi extends DbBase
	{ 

		/**
		 * @var int Id
		 */
		public $Id; 

		/**
		 * @var string Nume
		 */
		public $Nume; 

		/**
		 * @var string Prenume
		 */
		public $Prenume; 

		/**
		 * @var \DateTime Data
		 */
		public $Data; 

		/**
		 * @var int Cnp
		 */
		public $Cnp; 

		/**
		 * @var string Serie
		 */
		public $Serie; 

		/**
		 * @return String numele tabelului din db
		 */
		public static function _getTableName()
		{
			return 'facturi';
		}
		
		/**
		 * @return string[] intoarce lista de coloane
		 */
		public function _getColumns()
		{
			return array('Id','Nume','Prenume','Data','Cnp','Serie');
		}
		

		/* @return DbFacturiModel OR null */
		public static function QueryRow()
		{
			return parent::QueryRow();
		}

		/* @return DbFacturiModel[] */
		public static function QueryResult()
		{
			return parent::QueryResult();
		}

		/* @return DbFacturiModel[] */
		public static function QuerySql($sql)
		{
			return parent::QuerySql( $sql);
		}

		public static function query()
		{
			return new DbFacturi_Queryable( static::_getTableName() );
		}

		
		public static function constructModel( $id=null)
		{
			return new DbFacturi( $id);
		}
	}
	class DbFacturi_Queryable extends DbQueryableBase
	{
		/* @return DbFacturiModel[] */
		public function get()
		{
			return DbFacturiModel::QueryResult();
		}

		/* @return DbFacturiModel[] */
		public function get_row()
		{
			return DbFacturiModel::QueryRow();
		}
	}
		