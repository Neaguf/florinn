<?php
	class DbRightsGroups extends DbBase
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
			return 'rights_groups';
		}
		
		/**
		 * @return string[] intoarce lista de coloane
		 */
		public function _getColumns()
		{
			return array('Id','Name');
		}
		

		/* @return DbRightsGroupsModel OR null */
		public static function QueryRow()
		{
			return parent::QueryRow();
		}

		/* @return DbRightsGroupsModel[] */
		public static function QueryResult()
		{
			return parent::QueryResult();
		}

		/* @return DbRightsGroupsModel[] */
		public static function QuerySql($sql)
		{
			return parent::QuerySql( $sql);
		}

		public static function query()
		{
			return new DbRightsGroups_Queryable( static::_getTableName() );
		}

		
		public static function constructModel( $id=null)
		{
			return new DbRightsGroups( $id);
		}
	}
	class DbRightsGroups_Queryable extends DbQueryableBase
	{
		/* @return DbRightsGroupsModel[] */
		public function get()
		{
			return DbRightsGroupsModel::QueryResult();
		}

		/* @return DbRightsGroupsModel[] */
		public function get_row()
		{
			return DbRightsGroupsModel::QueryRow();
		}
	}
		