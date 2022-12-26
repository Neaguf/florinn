<?php
	class DbAuthTokensModel extends DbAuthTokens
	{ 

		public static function constructModel($id=null)
		{
			return new DbAuthTokensModel($id);
		}
	}