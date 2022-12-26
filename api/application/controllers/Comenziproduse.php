<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comenziproduse extends BP_Controller
{

    public function index()
    {
        $ret            = $this->verify_login();
        if(!$ret->NotLogged)
        {
            $filters      = $this->input->post("Filters");
            $order_by     = $this->input->post("OrderBy");
            $pg_info      = new PaginationInfo( $this->input->post("PaginationInfo") );


            $sql          = new TableSql( "SELECT t1.* FROM comenziProduse t1 WHERE 1=1  " );

            
            $sql->addIfNeeded( $filters['Id'], '', " AND t1.Id LIKE '%%%s%%' ");
        


            $sql->addLimitFromPagination($pg_info);


            $result = $sql->getResult();
            $rows   = $result->Rows;

            //
            $pg_info->RowCount = $result->FullRowsCount;
            //
            $ret->Results        = $rows;
            $ret->PaginationInfo = $pg_info;
        }

        echo  json_encode($ret);
    }

    public function get_info()
    {
        $ret            = $this->verify_login();
        if(!$ret->NotLogged)
        {
            

        }

        echo json_encode($ret);
    }


    public function get_info_for_dialog()
    {
        $ret            = $this->verify_login();
        if(!$ret->NotLogged)
        {
            



        }

        echo json_encode($ret);
    }

    public function get_info_item_dialog()
    {
        $ret            = $this->verify_login();
        if(!$ret->NotLogged)
        {
            $id                  = $this->input->post("id");
            $ret->Item           = new DbComenziporduseModel($id);
            



        }

        echo json_encode($ret);
    }


    public function save()
    {
        $ret            = $this->verify_login();

        if(!$ret->NotLogged)
        {
            $mode   = $this->input->post( "mode"   );
            $object = $this->input->post( "object" );
            $obj    = new DbComenziporduseModel();

            if( $mode == "add" ){
                if( array_key_exists('Id', $object) ) unset( $object['Id'] );
                $obj->constructFromArray($object);
                $obj->Insert(false, true);
            }else{
                $obj->constructFromArray($object);
                $obj->Update();
            }
        }

        echo  json_encode($ret);

    }

    




    public function delete_item()
    {
        $ret            = $this->verify_login();

        if(!$ret->NotLogged)
        {
            $id = $this->input->post( "id" );
            $a  = new DbComenziporduseModel($id);
            $a->Delete();
        }

        echo  json_encode($ret);
    }

}