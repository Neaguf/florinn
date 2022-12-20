<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends BP_Controller
{

    public function index()
    {
        $ret          = new stdClass();

        $email 		  = $this->input->post('email');
        $password 	  = $this->input->post('password');

        if( !empty($email) )
        {
            $users = DbUtilizatoriModel::query()->where("Parola", md5($password))->where("Email", $email)->get();
            $ret->Token = '';

            if( count($users) > 0 )
            {
                $user              = $users[0];

                $t                  = new DbAuthTokensModel();
                $t->IdUtilizator    = $user->Id;
                $t->Token           = $this->createNewToken( $user->Id );
                $t->Insert(false,true);

                $ret->Token         = $t->Token;
                $ret->UserType      = $user->Tip;
            }
        }

        echo json_encode($ret);
    }

    private function createNewToken( $id_user )
    {
        $now = date("Y-m-d H:i:s");
        return md5( $id_user."-".date("Y-m-d H:i:s") );
    }
}
