<?php
	class DbRights extends DbBase
	{ 

		/**
		 * @var int Id
		 */
		public $Id; 

		/**
		 * @var string Key
		 */
		public $Key; 

		/**
		 * @var string Name
		 */
		public $Name; 

		/**
		 * @var int CategoryId
		 */
		public $CategoryId; 

		/**
		 * @return String numele tabelului din db
		 */
		public static function _getTableName()
		{
			return 'rights';
		}
		
		/**
		 * @return string[] intoarce lista de coloane
		 */
		public function _getColumns()
		{
			return array('Id','Key','Name','CategoryId');
		}
		

		/* @return DbRightsModel OR null */
		public static function QueryRow()
		{
			return parent::QueryRow();
		}

		/* @return DbRightsModel[] */
		public static function QueryResult()
		{
			return parent::QueryResult();
		}

		/* @return DbRightsModel[] */
		public static function QuerySql($sql)
		{
			return parent::QuerySql( $sql);
		}

		public static function query()
		{
			return new DbRights_Queryable( static::_getTableName() );
		}

		
		public static function constructModel( $id=null)
		{
			return new DbRights( $id);
		}
	}
	class DbRights_Queryable extends DbQueryableBase
	{
		/* @return DbRightsModel[] */
		public function get()
		{
			return DbRightsModel::QueryResult();
		}

		/* @return DbRightsModel[] */
		public function get_row()
		{
			return DbRightsModel::QueryRow();
		}
	}
		