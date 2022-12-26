<?php
	class DbRightsModel extends DbRights
	{ 

		public static function constructModel($id=null)
		{
			return new DbRightsModel($id);
		}
	}