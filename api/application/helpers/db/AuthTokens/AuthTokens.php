<?php
	class DbAuthTokens extends DbBase
	{ 

		/**
		 * @var int Id
		 */
		public $Id; 

		/**
		 * @var int IdUtilizator
		 */
		public $IdUtilizator; 

		/**
		 * @var string Token
		 */
		public $Token; 

		/**
		 * @return String numele tabelului din db
		 */
		public static function _getTableName()
		{
			return 'auth_tokens';
		}
		
		/**
		 * @return string[] intoarce lista de coloane
		 */
		public function _getColumns()
		{
			return array('Id','IdUtilizator','Token');
		}
		

		/* @return DbAuthTokensModel OR null */
		public static function QueryRow()
		{
			return parent::QueryRow();
		}

		/* @return DbAuthTokensModel[] */
		public static function QueryResult()
		{
			return parent::QueryResult();
		}

		/* @return DbAuthTokensModel[] */
		public static function QuerySql($sql)
		{
			return parent::QuerySql( $sql);
		}

		public static function query()
		{
			return new DbAuthTokens_Queryable( static::_getTableName() );
		}

		
		public static function constructModel( $id=null)
		{
			return new DbAuthTokens( $id);
		}
	}
	class DbAuthTokens_Queryable extends DbQueryableBase
	{
		/* @return DbAuthTokensModel[] */
		public function get()
		{
			return DbAuthTokensModel::QueryResult();
		}

		/* @return DbAuthTokensModel[] */
		public function get_row()
		{
			return DbAuthTokensModel::QueryRow();
		}
	}
		