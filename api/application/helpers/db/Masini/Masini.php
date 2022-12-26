<?php
	class DbMasini extends DbBase
	{ 

		/**
		 * @var int Id
		 */
		public $Id; 

		/**
		 * @var string Marca
		 */
		public $Marca; 

		/**
		 * @var string Model
		 */
		public $Model; 

		/**
		 * @var string Motor
		 */
		public $Motor; 

		/**
		 * @var string Culoare
		 */
		public $Culoare; 

		/**
		 * @var string Disponibil
		 */
		public $Disponibil; 

		/**
		 * @return String numele tabelului din db
		 */
		public static function _getTableName()
		{
			return 'Masini';
		}
		
		/**
		 * @return string[] intoarce lista de coloane
		 */
		public function _getColumns()
		{
			return array('Id','Marca','Model','Motor','Culoare','Disponibil');
		}
		

		/* @return DbMasiniModel OR null */
		public static function QueryRow()
		{
			return parent::QueryRow();
		}

		/* @return DbMasiniModel[] */
		public static function QueryResult()
		{
			return parent::QueryResult();
		}

		/* @return DbMasiniModel[] */
		public static function QuerySql($sql)
		{
			return parent::QuerySql( $sql);
		}

		public static function query()
		{
			return new DbMasini_Queryable( static::_getTableName() );
		}

		
		public static function constructModel( $id=null)
		{
			return new DbMasini( $id);
		}
	}
	class DbMasini_Queryable extends DbQueryableBase
	{
		/* @return DbMasiniModel[] */
		public function get()
		{
			return DbMasiniModel::QueryResult();
		}

		/* @return DbMasiniModel[] */
		public function get_row()
		{
			return DbMasiniModel::QueryRow();
		}
	}
		