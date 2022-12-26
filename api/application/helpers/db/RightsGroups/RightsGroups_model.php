<?php
	class DbRightsGroupsModel extends DbRightsGroups
	{ 

		public static function constructModel($id=null)
		{
			return new DbRightsGroupsModel($id);
		}
	}