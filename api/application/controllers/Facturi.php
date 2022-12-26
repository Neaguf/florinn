<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facturi extends BP_Controller
{

    public function index()
    {
        $ret            = $this->verify_login();
        if(!$ret->NotLogged)
        {
            $filters      = $this->input->post("Filters");
            $order_by     = $this->input->post("OrderBy");
            $pg_info      = new PaginationInfo( $this->input->post("PaginationInfo") );


            $sql          = new TableSql( "SELECT t1.* FROM facturi t1 WHERE 1=1  " );

            
            $sql->addIfNeeded( $filters['Serie'], '', " AND t1.Serie LIKE '%%%s%%' ");
        

            $sql->addIfNeeded( $filters['Numar'], '', " AND t1.Numar LIKE '%%%s%%' ");
        

            $sql->addIfNeeded( $filters['Data'], '', " AND t1.Data LIKE '%%%s%%' ");
        

            $sql->addIfNeeded( $filters['Nume'], '', " AND t1.Nume LIKE '%%%s%%' ");
        

            $sql->addIfNeeded( $filters['Prenume'], '', " AND t1.Prenume LIKE '%%%s%%' ");
        

            $sql->addIfNeeded( $filters['Cnp'], '', " AND t1.Cnp LIKE '%%%s%%' ");
        


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
            
        //luam din baza de date produse

        $query = "SELECT * FROM produse";

        $ret->produse = $this->db->query($query)->result();






        }

        echo json_encode($ret);
    }

    public function get_info_item_dialog()
    {
        $ret            = $this->verify_login();
        if(!$ret->NotLogged)
        {
            $id                  = $this->input->post("id");
            $ret->Item           = new DbFacturiModel($id);
            $query = "SELECT fp.*, p.Nume as NumeProdus FROM facturi_produse fp
                LEFT JOIN produse p ON p.Id = fp.IdProdus 
            WHERE fp.IdFactura = $id";

            $produse = $this->db->query($query)->result();
            $ret->Produse = $produse;




        }

        echo json_encode($ret);
    }


    public function get_factura($id) {
        // echo $id;
        $factura_query = "SELECT * FROM facturi WHERE id = ".$id;
        $result = $this->db ->query($factura_query)->result();
        $produse_query = "SELECT fp.*, p.Nume as NumeProdus FROM facturi_produse fp
                            LEFT JOIN produse p ON p.Id = fp.IdProdus
                          WHERE fp.IdFactura = $id";

        $produse = $this->db->query($produse_query)->result();

        $data = [];
        $data['Factura'] = $result[0];
        $data['Produse'] = $produse;

        return $this->load->view('factura/factura_template', $data);
    }

    public function save()
    {
        $ret            = $this->verify_login();

        if(!$ret->NotLogged)
        {
            $mode   = $this->input->post( "mode"   );
            $object = $this->input->post( "object" );
            $produse = $this->input->post( "produse" );
            $obj    = new DbFacturiModel();

            if( $mode == "add" ){
                if( array_key_exists('Id', $object) ) unset( $object['Id'] );
                if( array_key_exists('Data', $object) ) unset( $object['Data'] );
                $obj->constructFromArray($object);
                $obj->Data = date('Y-m-d H:i:s');
                $obj->Insert(false, true);

                foreach ($produse as $produs) {
                    // print_r($produs->pretProdus);

                    //pentru fiecare produs adus din front se face cate un camp nou in tabela produse factura.
                    $produsModel = new DbFacturiProduseModel();
                    $produsModel->IdProdus = $produs['idProdus'];
                    $produsModel->IdFactura = $obj->Id;
                    $produsModel->Cantitate = $produs['cantitateProdus'];
                    $produsModel->Pret = $produs['pretProdus'];
                    $produsModel->Valoare = $produsModel->Cantitate * $produsModel->Pret;
                    $produsModel->Insert(false, true);

                }
            }else{
                $obj->constructFromArray($object);
                $obj->Update();
                DbFacturiProduseModel::query()->where('IdFactura', $obj->Id)->delete();

                foreach ($produse as $produs) {
                    // print_r($produs->pretProdus);

                    //pentru fiecare produs adus din front se face cate un camp nou in tabela produse factura.
                    $produsModel = new DbFacturiProduseModel();
                    $produsModel->IdProdus = $produs['idProdus'];
                    $produsModel->IdFactura = $obj->Id;
                    $produsModel->Cantitate = $produs['cantitateProdus'];
                    $produsModel->Pret = $produs['pretProdus'];
                    $produsModel->Valoare = $produsModel->Cantitate * $produsModel->Pret;
                    $produsModel->Insert(false, true);

                }
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
            $a  = new DbFacturiModel($id);
            $a->Delete();
        }

        echo  json_encode($ret);
    }

}
