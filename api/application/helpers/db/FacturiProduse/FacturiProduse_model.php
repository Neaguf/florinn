<?php
	class DbFacturiProduseModel extends DbFacturiProduse
	{ 

		public static function constructModel($id=null)
		{
			return new DbFacturiProduseModel($id);
		}
	}