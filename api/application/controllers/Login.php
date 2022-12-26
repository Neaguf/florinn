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
                $grup_drepturi      = new DbRightsGroupsModel($user->IdGrupDrepturi );
                $t                  = new DbAuthTokensModel();
                $t->IdUtilizator    = $user->Id;
                $t->Token           = $this->createNewToken( $user->Id );
                $t->Insert(false,true);
                $ret->Token         = $t->Token;
                $ret->UserType      = $grup_drepturi->Name;
                $ret->Rights        = [];
                $sql                = "SELECT r.* FROM rights r, rights_groups_link rl WHERE r.Id=rl.IdRight AND rl.IdGroup={$grup_drepturi->Id}";
                $rights             = DbRightsModel::QuerySql($sql);
                foreach($rights as $r)
                {
                    $ret->Rights[] = $r->Key;
                }
                $randomNumber 		= count($ret->Rights) * (458 + 73 - 23);
                $crc 				= md5('nimic'.$randomNumber);
                $ret->Rights[] 	    = $crc;
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
