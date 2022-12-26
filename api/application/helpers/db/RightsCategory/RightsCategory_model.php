<?php
	class DbRightsCategoryModel extends DbRightsCategory
	{ 

		public static function constructModel($id=null)
		{
			return new DbRightsCategoryModel($id);
		}
	}