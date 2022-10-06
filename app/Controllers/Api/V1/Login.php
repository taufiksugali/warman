<?php

namespace App\Controllers\Api\V1;
use App\Models\Apiv1Model;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use Config\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Login extends BaseController {
    use ResponseTrait;
    public function __construct() {
        $this->apiv1model = new Apiv1Model();

        helper(['form', 'url']);
        header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Method: PUT, GET, POST, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token');
        header('Content-type: application/json; charset=utf-8');
        // Poslog Celalu Dihati is : a9f29dd50156bb6a50cfe35967fec722
    } 

    public function index() {
        $getallheaders = getallheaders();
		$authHeader = explode(" ", @$getallheaders['Authorization']);
		$token = @$authHeader[1];
        // $authHeader = explode(" ", $this->input->server('HTTP_AUTHORIZATION'));

        $validate = $this->validate([
            'username' => ['label' => 'Username', 'rules' => 'required'],
            'password' => ['label' => 'Password', 'rules' => 'required'],
            'source' => ['label' => 'Source', 'rules' => 'required'],
        ]);

        if ($this->request->getServer('REQUEST_METHOD') != 'POST') {
            $response = array(
				'status' => 405,
				'message' => 'Request method not allowed.'
			);
        }elseif ($token != 'a9f29dd50156bb6a50cfe35967fec722') {
            $response = array(
				'status' => 401,
				'message' => 'Invalid authentication token.'
			);
        }elseif ($validate == FALSE) {
            $response = array(
				'status' => 400,
				'message' => \Config\Services::validation()->listErrors()
			);
        }else{
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $source = $this->request->getPost('source');
            $password2 = hash('sha256', $this->request->getPost('password'));

            $getalldatauser = $this->apiv1model->api_login_hris($username, $password);
            $getalldatauser2 = $this->apiv1model->login($username, $password2);
            if (@$getalldatauser2->status == 1 && $source == 'Seller') {
                if (hash('sha256', $password2, $getalldatauser2->password)) {
                    if($getalldatauser2->user_type == 1){
                        $office = $getalldatauser2->owners_id;
                    }else {
                        $office = $getalldatauser2->warehouse_id;
                    }
                    $data = array(
                        'user_id' => $getalldatauser2->user_id,
                        'email' => $getalldatauser2->email,
                        'level_id' => $getalldatauser2->level_id,
                        'warehouse_id' => @$getalldatauser2->warehouse_id, // nanti ini disesuaikan
                        'owners_id' => @$getalldatauser2->owners_id, // nanti ini disesuaikan
                        'fullname' => $getalldatauser2->fullname,
                        'phone' => $getalldatauser2->phone,
                        'company' => $getalldatauser2->company,
                        'user_type' => $getalldatauser2->user_type,
                        'user_src' => 'LOCAL',
                        'token' => md5($getalldatauser2->user_id),
                        'logged_in' => TRUE
                    );
                    $response = array(
                        'status' => 200,
                        'message' => "Login Success",
                        'data' => $data
                    );
                }else{
                    $response = array(
                        'status' => 203,
                        'message' => 'Wrong Email or HRIS NIK; or Password! Please try again.'
                    );
                }
            }else{
                if ($source == 'Seller') {
                    $response = array(
                        'status' => 203,
                        'message' => 'User has not been activated.'
                    );
                }
            }
            

            if ($getalldatauser->code == '200' && $source == 'Admin') {
                $getuserbynik = $this->apiv1model->getUserByNik($getalldatauser->data->employee_number);
                
                if (!empty($getuserbynik->hris_nik) and !empty($getuserbynik->user_level)) {
                    $data = array(
                        'user_id' => $getuserbynik->hris_nik,
                        'email' => $getuserbynik->hris_email,
                        'fullname' => $getuserbynik->hris_name,
                        'level_id' => $getuserbynik->user_level,
                        'warehouse_id' => $getuserbynik->warehouse_id,
                        'division_id' => $getalldatauser->data->division_id,
                        'division_name' => $getalldatauser->data->division_name,
                        'employee_photo' => $getalldatauser->data->employee_photo,
                        'level_name' => $getalldatauser->data->level_name,
                        'job_title' => $getalldatauser->data->job_title,
                        'office_name' => $getalldatauser->data->office_name,
                        'user_type' => 0,
                        'user_src' => 'HRIS',
                        'token' => md5($getuserbynik->hris_nik),
                        'logged_in' => TRUE
                    );

                    $response = array(
                        'status' => 200,
                        'message' => "Login Success",
                        'data' => $data
                    );
                }else{
                    if(!empty($getuserbynik->hris_nik)) {
                        $response = array(
                            'status' => 203,
                            'message' => 'Contact your Admin to Register your account.'
                        );
                    }else{
                        $data_hris = array(
                            'hris_nik' => $getalldatauser->data->employee_number,
                            'hris_name' => $getalldatauser->data->full_name,
                            'hris_email' => $getalldatauser->data->official_email,
                            'hris_status' => 1
                        );
                        $this->hris->insert_user_hris($data_hris);
                        $response = array(
                            'status' => 203,
                            'message' => 'Contact your Admin to Register your account.'
                        );
                    }
                }
            }else{
                if ($source == 'Admin') {
                    $response = array(
                        'status' => 204,
                        'message' => 'User does not exist.'
                    );
                }
            }
        }
        echo json_encode($response);
	}
}
?>
