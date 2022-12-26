<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilizatori extends BP_Controller
{

    public function index()
    {
        $ret            = $this->verify_login();
        if(!$ret->NotLogged)
        {
            $filters      = $this->input->post("Filters");
            $order_by     = $this->input->post("OrderBy");
            $pg_info      = new PaginationInfo( $this->input->post("PaginationInfo") );


            $sql          = new TableSql( "SELECT t1.* FROM utilizatori t1 WHERE 1=1  " );


            $sql->addIfNeeded( $filters['Nume'], '', " AND t1.Nume LIKE '%%%s%%' ");
            $sql->addIfNeeded( $filters['Email'], '', " AND t1.Email LIKE '%%%s%%' ");



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



            $ret->rights_groups = $this->db->query('SELECT Id, Name FROM rights_groups')->result();


        }

        echo json_encode($ret);
    }

    public function get_info_item_dialog()
    {
        $ret            = $this->verify_login();
        if(!$ret->NotLogged)
        {
            $id                  = $this->input->post("id");
            $ret->Item           = new DbUtilizatori($id);
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
            $obj    = new DbUtilizatori();

            if( $mode == "add" ){
                if( array_key_exists('Id', $object) ) unset( $object['Id'] );
                $obj->constructFromArray($object);
                $obj->Parola = md5($obj->Parola);
                $obj->Insert(false, true);
            }else{
                $obj->constructFromArray($object);
                $obj->Parola = null;
                $obj->Update(true);
            }
        }

        echo  json_encode($ret);

    }

    public function change_password()
    {
        $ret            = $this->verify_login();

        if(!$ret->NotLogged)
        {
            $info = $this->input->post( "info" );
            $user = $this->getUserFromToken();

            $old_password  = $info['OldPassword' ];
            $new_password  = $info['NewPassword' ];
            $new_password2 = $info['NewPassword2'];

            $old_password_md5  = md5($old_password);


            if( strtolower( $old_password_md5 ) != strtolower( $user->Parola ))
            {
                $ret->HasError = true;
                $ret->Error   = 'Parola veche este incorecta!';
            }
            else if( $new_password != $new_password2 )
            {
                $ret->HasError = true;
                $ret->Error   = 'Parola noua nu este introdus corect!';
            }
            else
            {
                $ret->HasError  = false;
                $user->Parola   = md5($new_password);
                $user->Update();
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
            $a  = new DbUtilizatori($id);
            $a->Delete();
        }

        echo  json_encode($ret);
    }

}
