<?php
	class DbFacturiProduse extends DbBase
	{ 

		/**
		 * @var int Id
		 */
		public $Id; 

		/**
		 * @var int IdFactura
		 */
		public $IdFactura; 

		/**
		 * @var int IdProdus
		 */
		public $IdProdus; 

		/**
		 * @var int Cantitate
		 */
		public $Cantitate; 

		/**
		 * @var double Pret
		 */
		public $Pret; 

		/**
		 * @var double Valoare
		 */
		public $Valoare; 

		/**
		 * @return String numele tabelului din db
		 */
		public static function _getTableName()
		{
			return 'facturi_produse';
		}
		
		/**
		 * @return string[] intoarce lista de coloane
		 */
		public function _getColumns()
		{
			return array('Id','IdFactura','IdProdus','Cantitate','Pret','Valoare');
		}
		

		/* @return DbFacturiProduseModel OR null */
		public static function QueryRow()
		{
			return parent::QueryRow();
		}

		/* @return DbFacturiProduseModel[] */
		public static function QueryResult()
		{
			return parent::QueryResult();
		}

		/* @return DbFacturiProduseModel[] */
		public static function QuerySql($sql)
		{
			return parent::QuerySql( $sql);
		}

		public static function query()
		{
			return new DbFacturiProduse_Queryable( static::_getTableName() );
		}

		
		public static function constructModel( $id=null)
		{
			return new DbFacturiProduse( $id);
		}
	}
	class DbFacturiProduse_Queryable extends DbQueryableBase
	{
		/* @return DbFacturiProduseModel[] */
		public function get()
		{
			return DbFacturiProduseModel::QueryResult();
		}

		/* @return DbFacturiProduseModel[] */
		public function get_row()
		{
			return DbFacturiProduseModel::QueryRow();
		}
	}
		