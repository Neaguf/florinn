<?php
/**
 * Created by PhpStorm.
 * User: danadrian
 * Date: 18/02/18
 * Time: 14:26
 */

class BP_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Token, Origin, X-Requested-With, Content-Type, Accept');
        header('Access-Control-Allow-Methods: GET, POST, PUT');

        $this->load->helper('auth');
    }


    public function index()
    {
        echo "working...";
    }

    private $token = "";

    public function getToken(){
        return $this->token;
    }

    public function getUserFromToken(){
        $auth_tokens = DbAuthTokensModel::query()->where("Token", $this->getToken())->get();
        $auth_token  = $auth_tokens[0];
        return new DbUtilizatoriModel( $auth_token->IdUtilizator );
    }

    /* @return AuthHelper raspunsul */
    public function verify_login()
    {
        $this->token    = $this->input->server('HTTP_TOKEN' );
        $ret            = new AuthHelper();
        $ret->NotLogged = true;
        $tokens = DbAuthTokensModel::query()->where('Token', $this->token )->get();
        if( count($tokens) > 0 )
        {
            $ret->NotLogged = false;
        }

        return $ret;
    }

}