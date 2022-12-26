<?php
	class DbUtilizatoriModel extends DbUtilizatori
	{ 

		public static function constructModel($id=null)
		{
			return new DbUtilizatoriModel($id);
		}
	}