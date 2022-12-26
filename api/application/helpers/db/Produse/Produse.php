<?php
	class DbProduse extends DbBase
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
		 * @var string Pret
		 */
		public $Pret; 

		/**
		 * @return String numele tabelului din db
		 */
		public static function _getTableName()
		{
			return 'produse';
		}
		
		/**
		 * @return string[] intoarce lista de coloane
		 */
		public function _getColumns()
		{
			return array('Id','Nume','Pret');
		}
		

		/* @return DbProduseModel OR null */
		public static function QueryRow()
		{
			return parent::QueryRow();
		}

		/* @return DbProduseModel[] */
		public static function QueryResult()
		{
			return parent::QueryResult();
		}

		/* @return DbProduseModel[] */
		public static function QuerySql($sql)
		{
			return parent::QuerySql( $sql);
		}

		public static function query()
		{
			return new DbProduse_Queryable( static::_getTableName() );
		}

		
		public static function constructModel( $id=null)
		{
			return new DbProduse( $id);
		}
	}
	class DbProduse_Queryable extends DbQueryableBase
	{
		/* @return DbProduseModel[] */
		public function get()
		{
			return DbProduseModel::QueryResult();
		}

		/* @return DbProduseModel[] */
		public function get_row()
		{
			return DbProduseModel::QueryRow();
		}
	}
		