<?php
	class DbRightsGroupsLink extends DbBase
	{ 

		/**
		 * @var int Id
		 */
		public $Id; 

		/**
		 * @var int IdGroup
		 */
		public $IdGroup; 

		/**
		 * @var int IdRight
		 */
		public $IdRight; 

		/**
		 * @return String numele tabelului din db
		 */
		public static function _getTableName()
		{
			return 'rights_groups_link';
		}
		
		/**
		 * @return string[] intoarce lista de coloane
		 */
		public function _getColumns()
		{
			return array('Id','IdGroup','IdRight');
		}
		

		/* @return DbRightsGroupsLinkModel OR null */
		public static function QueryRow()
		{
			return parent::QueryRow();
		}

		/* @return DbRightsGroupsLinkModel[] */
		public static function QueryResult()
		{
			return parent::QueryResult();
		}

		/* @return DbRightsGroupsLinkModel[] */
		public static function QuerySql($sql)
		{
			return parent::QuerySql( $sql);
		}

		public static function query()
		{
			return new DbRightsGroupsLink_Queryable( static::_getTableName() );
		}

		
		public static function constructModel( $id=null)
		{
			return new DbRightsGroupsLink( $id);
		}
	}
	class DbRightsGroupsLink_Queryable extends DbQueryableBase
	{
		/* @return DbRightsGroupsLinkModel[] */
		public function get()
		{
			return DbRightsGroupsLinkModel::QueryResult();
		}

		/* @return DbRightsGroupsLinkModel[] */
		public function get_row()
		{
			return DbRightsGroupsLinkModel::QueryRow();
		}
	}
		