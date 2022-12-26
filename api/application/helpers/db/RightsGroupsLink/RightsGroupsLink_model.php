<?php
	class DbRightsGroupsLinkModel extends DbRightsGroupsLink
	{ 

		public static function constructModel($id=null)
		{
			return new DbRightsGroupsLinkModel($id);
		}
	}