<?php
	class DbComenziproduse extends DbBase
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
			return 'comenziProduse';
		}
		
		/**
		 * @return string[] intoarce lista de coloane
		 */
		public function _getColumns()
		{
			return array('id','IdProduse','IdFactura');
		}
		

		/* @return DbComenziproduseModel OR null */
		public static function QueryRow()
		{
			return parent::QueryRow();
		}

		/* @return DbComenziproduseModel[] */
		public static function QueryResult()
		{
			return parent::QueryResult();
		}

		/* @return DbComenziproduseModel[] */
		public static function QuerySql($sql)
		{
			return parent::QuerySql( $sql);
		}

		public static function query()
		{
			return new DbComenziproduse_Queryable( static::_getTableName() );
		}

		
		public static function constructModel( $id=null)
		{
			return new DbComenziproduse( $id);
		}
	}
	class DbComenziproduse_Queryable extends DbQueryableBase
	{
		/* @return DbComenziproduseModel[] */
		public function get()
		{
			return DbComenziproduseModel::QueryResult();
		}

		/* @return DbComenziproduseModel[] */
		public function get_row()
		{
			return DbComenziproduseModel::QueryRow();
		}
	}
		