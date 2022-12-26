<?php
	class DbFacturiModel extends DbFacturi
	{ 

		public static function constructModel($id=null)
		{
			return new DbFacturiModel($id);
		}
	}