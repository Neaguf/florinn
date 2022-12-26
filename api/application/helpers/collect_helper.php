<?php
/**
 * Created by PhpStorm.
 * User: danadrianlutescu
 * Date: 29/01/2019
 * Time: 19:41
 */

class CollectClass
{
    private $inner_list = array();

    public function __construct( $inner_list )
    {
        $this->inner_list = $inner_list;
    }

    public function getList(){
        return $this->inner_list;
    }

    /* @return boolean */
    public function contains( $column, $value)
    {
        $first = $this->firstWhere($column, '=', $value );
        return $first != null;
    }

    public function firstWhere( $column, $equation, $value ){
        $ret = null;

        if($equation == '=') {
            foreach ($this->inner_list as $item)
            {
                if ( $item->$column == $value )
                {
                    $ret = $item;
                    break;
                }
            }
        }

        return $ret;
    }
}

function collect($list){
    return new CollectClass($list);
}