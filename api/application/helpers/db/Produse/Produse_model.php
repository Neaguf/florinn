<?php
	class DbProduseModel extends DbProduse
	{ 

		public static function constructModel($id=null)
		{
			return new DbProduseModel($id);
		}
	}