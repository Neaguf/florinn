<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tunnel extends BP_Controller
{

    public function index() 
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if( $method == "OPTIONS" ) die("ok");
        
        
        $table  = $this->input->post("table");
        $db     = $this->db->conn_id;
        $table  = mysqli_real_escape_string($db, $table);
        $sql    = "SHOW COLUMNS FROM $table";
        
        
        $result = $this->db->query($sql)->result();
    
        $ret = new stdClass();
        $ret->Listare  = [];
        $ret->Filtrare = [];
        $ret->Editare  = [];
        
        foreach($result as $row){
            
            $fieldName          = $row->Field;
            $dbFieldType        = $row->Type;
            $defaultValue       = $row->Default;

            if( $fieldName == "Id" ) continue;
            $fieldType          = $this->get_listare_type($dbFieldType);
            $ret->Listare[]     = $this->get_listare_json_default( $fieldName, $fieldType );

            $fieldType          = $this->get_filtrare_type($dbFieldType);
            $ret->Filtrare[]    = $this->get_filtrare_json_default( $fieldName, $fieldType );

            $fieldType          = $this->get_editare_type         ( $dbFieldType );
            $ret->Editare[]     = $this->get_editare_json_default ( $fieldName, $fieldType );
        }

        echo json_encode($ret);
    }

    private function get_listare_json_default( $fieldName, $type ) {
        $ret = [];
        if($type == "text") {
            $ret["Label"        ] = $fieldName;
            $ret["NumeColoanaDb"] = $fieldName;
            $ret["Tip"          ] = $type;
        }
        if($type == "data" ) {
            $ret["Label"        ] = $fieldName;
            $ret["NumeColoanaDb"] = $fieldName;
            $ret["Tip"          ] = $type;
            $ret["Format"       ] = "dd.MM.YYYY";
        }
        if($type == "ora" ) {
            $ret["Label"        ] = $fieldName;
            $ret["NumeColoanaDb"] = $fieldName;
            $ret["Tip"          ] = $type;
            $ret["Format"       ] = "HH:mm";
        }
        if($type == "dataora" ) {
            $ret["Label"        ] = $fieldName;
            $ret["NumeColoanaDb"] = $fieldName;
            $ret["Tip"          ] = $type;
            $ret["Format"       ] = "dd.MM.YYYY HH:mm";
        }

        return $ret;
    }

    private function get_listare_type( $dbType ) {
        $ret = "text";
        //listare -> text, currency, data, ora, dataora
        $links = [
            "data"    => ["date"],
            "time"    => ["time"],
            "dataora" => ["datetime"]
        ];

        foreach($links as $k=>$values){
            foreach($values as $v){
                if( strpos(strtolower($dbType), $v) !== FALSE ) {
                    $ret = $k;
                    break;
                }
            }
        }

        return $ret;
    }

    private function get_filtrare_type( $dbType ) {
        $ret = "text";
        //listare -> text, numeric, numeric-perioada, select-enum, checkbox, data, ora, dataora, dataora-perioada
        $links = [
            "data"              => ["date"],
            "checkbox"          => ["tinyint"],
            "numeric-perioada"  => ["int", "double", "float", "decimal"],
            "time"              => ["time"],
            "dataora-perioada"  => ["datetime"]
        ];

        foreach($links as $k=>$values){
            foreach($values as $v){
                if( strpos(strtolower($dbType), $v) !== FALSE ) {
                    $ret = $k;
                    break;
                }
            }
        }

        return $ret;
    }

    private function get_filtrare_json_default( $fieldName, $type ) {
        $ret = [];
        $ret["Label"        ] = $fieldName;
        $ret["NumeColoanaDb"] = $fieldName;
        $ret["Tip"          ] = $type;
        $ret["DefaultValue" ] = "";
        $ret["IgnoreValue"  ] = "";

        if($type == "text") {
            $ret["DefaultValue" ] = "";
            $ret["IgnoreValue"  ] = "";    
        }
        if($type == "checkbox" ) {
            $ret["FalseValue"   ] = "0";
            $ret["TrueValue"    ] = "1";
            
        }
        if($type == "numeric-perioada" ) {
            $ret["IgnoreValue"  ] = "0";
            $ret["Precizie"     ] = "0";
        }
        if($type == "time" ) {
            $ret["Format"] = "HH:mm";
        }
        if($type == "dataora-perioada" ) {
            $ret["Format"] = "dd.MM.yyyy HH:mm";
        }

        return $ret;
    }

    private function get_editare_type( $dbType ) {
        $ret = "text";
        //listare -> text, wysiwyg, numeric, select-enum, checkbox, data, ora, dataora
        $links = [
            "data"              => ["date"],
            "wysiwyg"           => ["text"],
            "checkbox"          => ["tinyint"],
            "numeric"           => ["int", "double", "float", "decimal"],
            "time"              => ["time"],
            "dataora-perioada"  => ["datetime"]
        ];

        foreach($links as $k=>$values){
            foreach($values as $v){
                if( strpos(strtolower($dbType), $v) !== FALSE ) {
                    $ret = $k;
                    break;
                }
            }
        }

        return $ret;
    }

    private function get_editare_json_default( $fieldName, $type ) {
        $ret = [];
        // listare -> text, wysiwyg, numeric, select-enum, checkbox, data, ora, dataora
        $ret["Label"        ] = $fieldName;
        $ret["NumeColoanaDb"] = $fieldName;
        $ret["Tip"          ] = $type;
        $ret["DefaultValue" ] = "";
        $ret["IgnoreValue"  ] = "";
        $ret["Required"     ] = true;

       
        if($type == "wysiwyg" ) {
            $ret["Extensii"     ] = "jpg|png|jpeg|gif";
            $ret["TinyMceApiKey"] = "p6c4zd25tao155ex1uk6z3x2vms9tkqdcri5jmg7g6obrqow";
            $ret["UploadFolder" ] = "./assets/imagini";
        }
        if($type == "numeric" ) {
            $ret["Precizie"] = "0";
        }
        if($type == "checkbox" ){
            $ret["FalseValue"] = "0";
            $ret["TrueValue" ] = "1";
        }
        if($type == "data" ) {
            $ret["Format"] = "HH:mm";
        }
        if($type == "ora" ) {
            $ret["Format"] = "HH:mm";
        }
        if($type == "dataora" ) {
            $ret["Format"] = "dd.MM.yyyy HH:mm";
        }

        return $ret;
    }

    public function download(){
        //download me
        die("aici");
        $file=  "./application/controllers/Tunnel.php";
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    }
}

