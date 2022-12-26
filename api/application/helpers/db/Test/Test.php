<?php
	class DbTest extends DbBase
	{ 

		/**
		 * @var int Id
		 */
		public $Id; 

		/**
		 * @var string Test
		 */
		public $Test; 

		/**
		 * @var string Test1
		 */
		public $Test1; 

		/**
		 * @var string Test2
		 */
		public $Test2; 

		/**
		 * @return String numele tabelului din db
		 */
		public static function _getTableName()
		{
			return 'test';
		}
		
		/**
		 * @return string[] intoarce lista de coloane
		 */
		public function _getColumns()
		{
			return array('Id','Test','Test1','Test2');
		}
		

		/* @return DbTestModel OR null */
		public static function QueryRow()
		{
			return parent::QueryRow();
		}

		/* @return DbTestModel[] */
		public static function QueryResult()
		{
			return parent::QueryResult();
		}

		/* @return DbTestModel[] */
		public static function QuerySql($sql)
		{
			return parent::QuerySql( $sql);
		}

		public static function query()
		{
			return new DbTest_Queryable( static::_getTableName() );
		}

		
		public static function constructModel( $id=null)
		{
			return new DbTest( $id);
		}
	}
	class DbTest_Queryable extends DbQueryableBase
	{
		/* @return DbTestModel[] */
		public function get()
		{
			return DbTestModel::QueryResult();
		}

		/* @return DbTestModel[] */
		public function get_row()
		{
			return DbTestModel::QueryRow();
		}
	}
		