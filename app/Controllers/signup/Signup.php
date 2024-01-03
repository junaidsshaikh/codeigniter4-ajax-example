<?php
namespace App\Controllers\signup;

use App\Controllers\BaseController;

use App\Models\login\LoginModel;

class Signup extends BaseController {

    public function __construct() {
	    $db                 = db_connect();
        $this->login        = new LoginModel($db);

        $this->ip_address   = $_SERVER['REMOTE_ADDR'];
        $this->datetime     = date("Y-m-d H:i:s");
        
    }

    public function index() {
        $this->signup();
    }
    
    public function signup() {
        $data                   = [];
        $data ['content_title'] = 'Sign Up';
        echo view('signup/signup', $data);
    }

    public function create() {
        $name               = $this->request->getPost('name');
        $email              = $this->request->getPost('email');
        $password           = $this->request->getPost('password');
        $mobile_number      = $this->request->getPost('mobile_number'); 

        $where      = [
            'email'  => $email,
        ];
        $has_account = $this->login->getEntry($where);
        if($has_account) {
            $json = [
                'status'    => false,
                'message'   => showDangerMessage("Entered email address is already registered"),
            ];
        } else {
            $data = [
                'name'              => $name,
                'email'             => $email,
                'password'          => md5($password),
                'mobile_number'     => $mobile_number,
                'ip_address'        => $this->ip_address,
                'created_at'        => $this->datetime,
                'status'            => "1",
            ];
            $result = $this->login->addEntry($data);
            if($result) {
                $json = [
                    'status'    => true,
                    'message'   => showSuccessMessage("Your account has been created successfully"),
                    'location'  => base_url('login'),
                ];
            } else {
                $json = [
                    'status'    => false,
                    'message'   => showDangerMessage("Something went wrong. Please try again!"),
                ];
            }
        }
        echo json_encode($json);
    }
}
