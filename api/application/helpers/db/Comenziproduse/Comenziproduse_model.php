<?php
	class DbComenziproduseModel extends DbComenziproduse
	{ 

		public static function constructModel($id=null)
		{
			return new DbComenziproduseModel($id);
		}
	}