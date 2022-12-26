<?php
	class DbComenziporduseModel extends DbComenziporduse
	{ 

		public static function constructModel($id=null)
		{
			return new DbComenziporduseModel($id);
		}
	}