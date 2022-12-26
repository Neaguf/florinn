<?php
class SettingsHelper
{

	public static function Get($key, $default='')
	{
		$ret = $default;
		$ci  = & get_instance();

		$ci->db->where('Key', $key);
		$query = $ci->db->get('settings');

		if( $query->num_rows() > 0 )
		{
			$ret = $query->row()->Value;
		}
		else
		{
			static::Set($key, $default );
		}

		return $ret;
	}

	public static function Set($key, $value)
	{
		$ci  = & get_instance();

		$ci->db->where ('Key', $key);
		$ci->db->delete('settings');

		$ci->db->set('Key'  , $key);
		$ci->db->set('Value', $value);
		$ci->db->insert('settings');
	}
}