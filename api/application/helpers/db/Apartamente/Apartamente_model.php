<?php
	class DbApartamenteModel extends DbApartamente
	{ 

		public static function constructModel($id=null)
		{
			return new DbApartamenteModel($id);
		}
	}