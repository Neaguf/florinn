<?php
	class DbMasiniModel extends DbMasini
	{ 

		public static function constructModel($id=null)
		{
			return new DbMasiniModel($id);
		}
	}