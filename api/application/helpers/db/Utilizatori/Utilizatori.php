<?php
	class DbUtilizatori extends DbBase
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
		 * @var string Email
		 */
		public $Email; 

		/**
		 * @var string Parola
		 */
		public $Parola; 

		/**
		 * @var int IdGrupDrepturi
		 */
		public $IdGrupDrepturi; 

		/**
		 * @return String numele tabelului din db
		 */
		public static function _getTableName()
		{
			return 'utilizatori';
		}
		
		/**
		 * @return string[] intoarce lista de coloane
		 */
		public function _getColumns()
		{
			return array('Id','Nume','Email','Parola','IdGrupDrepturi');
		}
		

		/* @return DbUtilizatoriModel OR null */
		public static function QueryRow()
		{
			return parent::QueryRow();
		}

		/* @return DbUtilizatoriModel[] */
		public static function QueryResult()
		{
			return parent::QueryResult();
		}

		/* @return DbUtilizatoriModel[] */
		public static function QuerySql($sql)
		{
			return parent::QuerySql( $sql);
		}

		public static function query()
		{
			return new DbUtilizatori_Queryable( static::_getTableName() );
		}

		
		public static function constructModel( $id=null)
		{
			return new DbUtilizatori( $id);
		}
	}
	class DbUtilizatori_Queryable extends DbQueryableBase
	{
		/* @return DbUtilizatoriModel[] */
		public function get()
		{
			return DbUtilizatoriModel::QueryResult();
		}

		/* @return DbUtilizatoriModel[] */
		public function get_row()
		{
			return DbUtilizatoriModel::QueryRow();
		}
	}
		