<?php
/**
 * Created by PhpStorm.
 * User: danadrianlutescu
 * Date: 06/11/2019
 * Time: 09:18
 */
class Linq
{
    public static function sum( $list, $column ){
        $ret = 0;
        foreach($list as $item){
            $ret += doubleval(  $item->$column );
        }
        return $ret;
    }

    public static function for_each($list, $func )
    {
        foreach($list as $item){
            $func($item);
        }
    }

    public static function where( $list, $func_filter ){
        $ret = array();

        foreach($list as $item)
        {
            if( $func_filter($item) )
                $ret[] = $item;
        }

        return $ret;
    }

    public static function group_by($list, $column)
    {
        $ret = array();
        if( count($list) > 0 )
        {
            foreach($list as $item)
            {
                $new_key = $item->$column;
                if( !array_key_exists($new_key, $ret) )
                {
                    $ret[$new_key] = array();
                }
                $ret[$new_key][] = $item;
            }
        }

        return $ret;
    }
}