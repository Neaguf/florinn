<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grupuri_utilizatori extends BP_Controller
{

    public function index()
    {
        $ret            = $this->verify_login();
        if(!$ret->NotLogged)
        {
            $filters      = $this->input->post("Filters");
            $order_by     = $this->input->post("OrderBy");
            $pg_info      = new PaginationInfo( $this->input->post("PaginationInfo") );


            $sql          = new TableSql( "SELECT t1.* FROM rights_groups t1 WHERE 1=1  " );


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


        }

        echo json_encode($ret);
    }


    public function get_info_for_dialog()
    {
        $ret            = $this->verify_login();
        if(!$ret->NotLogged)
        {
            $categorii      = DbRightsCategoryModel::query()->get();

            foreach($categorii as $categorie)
            {
                $categorie->Drepturi        = DbRightsModel::query()->where("CategoryId", $categorie->Id)->get();

                foreach($categorie->Drepturi as $drept)
                {
                    $drept->Bifat = false;
                }
            }

            $ret->CategoriiDrepturi = $categorii;
        }

        echo json_encode($ret);
    }

    public function get_info_item_dialog()
    {
        $ret            = $this->verify_login();
        if(!$ret->NotLogged)
        {
            $id                  = $this->input->post("id");
            $grup                = new DbRightsGroupsModel($id);
            $ret->Item           = $grup;

            $sql                 = "SELECT * FROM rights_groups_link WHERE IdGroup={$grup->Id}";
            $links               = $this->db->query($sql)->result();
            $ret->Bifate         = [];
            foreach($links as $link)
            {
                $ret->Bifate[] = $link->IdRight;
            }
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
            $obj    = new DbRightsGroupsModel();

            $drepturi = $this->input->post("drepturi");

            if( $mode == "add" ){
                if( array_key_exists('Id', $object) ) unset( $object['Id'] );
                $obj->constructFromArray($object);
                $obj->Insert(false, true);
            }else{
                $obj->constructFromArray($object);
                $obj->Update();
            }

            $this->db->query("DELETE FROM rights_groups_link WHERE IdGroup={$obj->Id}");

            foreach($drepturi as $id_right){
                $dl = new DbRightsGroupsLink();
                $dl->IdGroup = $obj->Id;
                $dl->IdRight = $id_right;
                $dl->Insert();
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
            $a  = new DbRightsGroupsModel($id);
            $a->Delete();
        }

        echo  json_encode($ret);
    }

}
