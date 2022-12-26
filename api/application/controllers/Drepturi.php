<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drepturi extends BP_Controller
{

    public function index()
    {
        $ret            = $this->verify_login();
        if(!$ret->NotLogged)
        {
            $filters      = $this->input->post("Filters");
            $order_by     = $this->input->post("OrderBy");
            $pg_info      = new PaginationInfo( $this->input->post("PaginationInfo") );


            $sql          = new TableSql( "SELECT t1.* FROM rights t1 WHERE 1=1  " );


            $sql->addIfNeeded( $filters['CategoryId'], '-1', " AND t1.CategoryId = '%s' ");


            $sql->addIfNeeded( $filters['Name'], '', " AND t1.Name LIKE '%%%s%%' ");



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
            $ret->rights_category = $this->db->query('SELECT Id, Name FROM rights_category')->result();



        }

        echo json_encode($ret);
    }


    public function get_info_for_dialog()
    {
        $ret            = $this->verify_login();
        if(!$ret->NotLogged)
        {


            $ret->rights_category = $this->db->query('SELECT Id, Name FROM rights_category')->result();


        }

        echo json_encode($ret);
    }

    public function get_info_item_dialog()
    {
        $ret            = $this->verify_login();
        if(!$ret->NotLogged)
        {
            $id                  = $this->input->post("id");
            $ret->Item           = new DbRightsModel($id);
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
            $obj    = new DbRightsModel();

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
            $a  = new DbRightsModel($id);
            $a->Delete();
        }

        echo  json_encode($ret);
    }

}
