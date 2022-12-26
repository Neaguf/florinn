<?php
	class DbTestModel extends DbTest
	{ 

		public static function constructModel($id=null)
		{
			return new DbTestModel($id);
		}
	}