<?php
	class DbApartamente extends DbBase
	{ 

		/**
		 * @var int Id
		 */
		public $Id; 

		/**
		 * @var int Numar
		 */
		public $Numar; 

		/**
		 * @var string Strada
		 */
		public $Strada; 

		/**
		 * @var string Oras
		 */
		public $Oras; 

		/**
		 * @var string Judet
		 */
		public $Judet; 

		/**
		 * @var int NumarCamere
		 */
		public $NumarCamere; 

		/**
		 * @var int Disponibil
		 */
		public $Disponibil; 

		/**
		 * @return String numele tabelului din db
		 */
		public static function _getTableName()
		{
			return 'apartamente';
		}
		
		/**
		 * @return string[] intoarce lista de coloane
		 */
		public function _getColumns()
		{
			return array('Id','Numar','Strada','Oras','Judet','NumarCamere','Disponibil');
		}
		

		/* @return DbApartamenteModel OR null */
		public static function QueryRow()
		{
			return parent::QueryRow();
		}

		/* @return DbApartamenteModel[] */
		public static function QueryResult()
		{
			return parent::QueryResult();
		}

		/* @return DbApartamenteModel[] */
		public static function QuerySql($sql)
		{
			return parent::QuerySql( $sql);
		}

		public static function query()
		{
			return new DbApartamente_Queryable( static::_getTableName() );
		}

		
		public static function constructModel( $id=null)
		{
			return new DbApartamente( $id);
		}
	}
	class DbApartamente_Queryable extends DbQueryableBase
	{
		/* @return DbApartamenteModel[] */
		public function get()
		{
			return DbApartamenteModel::QueryResult();
		}

		/* @return DbApartamenteModel[] */
		public function get_row()
		{
			return DbApartamenteModel::QueryRow();
		}
	}
		