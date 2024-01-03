<?php
namespace App\Controllers\login;

use App\Controllers\BaseController;

use App\Models\login\LoginModel;

class Login extends BaseController {

    public function __construct() {
	    $db                 = db_connect();
        $this->session      = \Config\Services::session();
        $this->login        = new LoginModel($db);

        $this->ip_address   = $_SERVER['REMOTE_ADDR'];
        $this->datetime     = date("Y-m-d H:i:s");
        
    }

    public function index() {
        $this->login();
    }
    
    public function login() {
        $data                   = [];
        $data ['content_title'] = 'Login';
        echo view('login/login', $data);
    }

    public function authenticate() {
        $email              = $this->request->getPost('email');
        $password           = $this->request->getPost('password');

        $where      = [
            'email'         => $email,
            'password'      => md5($password),
        ];
        $result = $this->login->getEntry($where);
        if($result) {
            $data = [
                'login_id'              => $result->id,
                'login_email'           => $result->email,
                'login_name'            => $result->name,
                'login_mobile_number'   => $result->mobile_number,
                'user_status'           => $result->status,
                'login_status'          => TRUE,
            ];
            $this->session->set($data);
            $json = [
                'status'    => true,
                'message'   => showSuccessMessage("Logged in successfully"),
                'location'  => base_url('myaccount'),
            ];
        } else {
            $json = [
                'status'    => false,
                'message'   => showDangerMessage("Entered email address does not exists. Please try again"),
            ];
        }
        echo json_encode($json);
    }
}
