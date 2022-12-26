<?php
	class DbRightsCategory extends DbBase
	{ 

		/**
		 * @var int Id
		 */
		public $Id; 

		/**
		 * @var string Name
		 */
		public $Name; 

		/**
		 * @return String numele tabelului din db
		 */
		public static function _getTableName()
		{
			return 'rights_category';
		}
		
		/**
		 * @return string[] intoarce lista de coloane
		 */
		public function _getColumns()
		{
			return array('Id','Name');
		}
		

		/* @return DbRightsCategoryModel OR null */
		public static function QueryRow()
		{
			return parent::QueryRow();
		}

		/* @return DbRightsCategoryModel[] */
		public static function QueryResult()
		{
			return parent::QueryResult();
		}

		/* @return DbRightsCategoryModel[] */
		public static function QuerySql($sql)
		{
			return parent::QuerySql( $sql);
		}

		public static function query()
		{
			return new DbRightsCategory_Queryable( static::_getTableName() );
		}

		
		public static function constructModel( $id=null)
		{
			return new DbRightsCategory( $id);
		}
	}
	class DbRightsCategory_Queryable extends DbQueryableBase
	{
		/* @return DbRightsCategoryModel[] */
		public function get()
		{
			return DbRightsCategoryModel::QueryResult();
		}

		/* @return DbRightsCategoryModel[] */
		public function get_row()
		{
			return DbRightsCategoryModel::QueryRow();
		}
	}
		