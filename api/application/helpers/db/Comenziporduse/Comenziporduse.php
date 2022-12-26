<?php
	class DbComenziporduse extends DbBase
	{ 

		/**
		 * @var int id
		 */
		public $id; 

		/**
		 * @var string IdProduse
		 */
		public $IdProduse; 

		/**
		 * @var string IdFactura
		 */
		public $IdFactura; 

		/**
		 * @return String numele tabelului din db
		 */
		public static function _getTableName()
		{
			return 'comenziPorduse';
		}
		
		/**
		 * @return string[] intoarce lista de coloane
		 */
		public function _getColumns()
		{
			return array('id','IdProduse','IdFactura');
		}
		

		/* @return DbComenziporduseModel OR null */
		public static function QueryRow()
		{
			return parent::QueryRow();
		}

		/* @return DbComenziporduseModel[] */
		public static function QueryResult()
		{
			return parent::QueryResult();
		}

		/* @return DbComenziporduseModel[] */
		public static function QuerySql($sql)
		{
			return parent::QuerySql( $sql);
		}

		public static function query()
		{
			return new DbComenziporduse_Queryable( static::_getTableName() );
		}

		
		public static function constructModel( $id=null)
		{
			return new DbComenziporduse( $id);
		}
	}
	class DbComenziporduse_Queryable extends DbQueryableBase
	{
		/* @return DbComenziporduseModel[] */
		public function get()
		{
			return DbComenziporduseModel::QueryResult();
		}

		/* @return DbComenziporduseModel[] */
		public function get_row()
		{
			return DbComenziporduseModel::QueryRow();
		}
	}
		