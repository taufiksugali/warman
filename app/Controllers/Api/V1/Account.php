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

class Account extends BaseController {
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

    public function get_account() {
        $getallheaders = getallheaders();
		$authHeader = explode(" ", @$getallheaders['Authorization']);
		$token = @$authHeader[1];
        // $authHeader = explode(" ", $this->input->server('HTTP_AUTHORIZATION'));
        $validate = $this->apiv1model->getUserByUserId($token);
        if ($this->request->getServer('REQUEST_METHOD') != 'GET') {
            $response = array(
				'status' => 405,
				'message' => 'Request method not allowed.'
			);
        }elseif ($validate == NULL) {
            $response = array(
				'status' => 401,
				'message' => 'Invalid authentication token.'
			);
        }else{
            $data = array(
                'owners_id' => $validate->owners_id,
                'owners_name' => $validate->owners_name,
                'owners_balance_coma' => number_format($validate->owners_balance),
                'owners_balance' => $validate->owners_balance,
                'owners_account' => $validate->owners_account,
                'bank_id' => $validate->bank_id,
                'bank_name' => $validate->bank_name,
                'zip_code' => $validate->zip_code,
                'sub_district' => $validate->sdistrict_name,
                'district' => $validate->district_name,
                'city' => $validate->city_name,
                'state' => $validate->state_name,
                'fullname' => $validate->fullname,
                'company' => $validate->company,
                'email' => $validate->email
            );

            $response = array(
                'status' => 200,
                'message' => 'Data available.',
                'data' => $data
            );
        }
        echo json_encode($response);
	}

    public function get_bank_account() {
        $getallheaders = getallheaders();
		$authHeader = explode(" ", @$getallheaders['Authorization']);
		$token = @$authHeader[1];
        // $authHeader = explode(" ", $this->input->server('HTTP_AUTHORIZATION'));
        $validate = $this->apiv1model->getUserByUserId($token);
        if ($this->request->getServer('REQUEST_METHOD') != 'GET') {
            $response = array(
				'status' => 405,
				'message' => 'Request method not allowed.'
			);
        }elseif ($validate == NULL) {
            $response = array(
				'status' => 401,
				'message' => 'Invalid authentication token.'
			);
        }else{
            $data = array(
                'bank_account' => '12121212121'
            );

            $response = array(
                'status' => 200,
                'message' => 'Data available.',
                'data' => $data
            );
        }
        echo json_encode($response);
	}

    public function get_bill_record() {
        $getallheaders = getallheaders();
		$authHeader = explode(" ", @$getallheaders['Authorization']);
		$token = @$authHeader[1];
        // $authHeader = explode(" ", $this->input->server('HTTP_AUTHORIZATION'));
        $validate = $this->apiv1model->getUserByUserId($token);
        if ($this->request->getServer('REQUEST_METHOD') != 'GET') {
            $response = array(
				'status' => 405,
				'message' => 'Request method not allowed.'
			);
        }elseif ($validate == NULL) {
            $response = array(
				'status' => 401,
				'message' => 'Invalid authentication token.'
			);
        }else{
            $total_admin_fee = $this->apiv1model->total_admin_fee($validate->owners_id);
            $total_biaya_kurir = $this->apiv1model->total_biaya_kurir($validate->owners_id);
            $total_biaya_packing = $this->apiv1model->total_biaya_packing($validate->owners_id);
            
            $data = array(
                'warehouse_fee' => '-',
                'admin_fee' => (@$total_admin_fee[0]->admin_fee == null ? '0' : number_format($total_admin_fee[0]->admin_fee)),
                'biaya_kurir' => (@$total_biaya_kurir[0]->kurir == null ? '0' : number_format($total_biaya_kurir[0]->kurir)),
                'biaya_packing' => (@$total_biaya_packing[0]->packing == null ? '0' : number_format($total_biaya_packing[0]->packing))
            );

            $response = array(
                'status' => 200,
                'message' => 'Data available.',
                'data' => $data
            );
        }
        echo json_encode($response);
	}

    public function get_appversion() {
        $getallheaders = getallheaders();
		$authHeader = explode(" ", @$getallheaders['Authorization']);
		$token = @$authHeader[1];
        // $authHeader = explode(" ", $this->input->server('HTTP_AUTHORIZATION'));
        $validate_token = $this->apiv1model->getUserByUserId($token);
        $validate = $this->validate([
            'version' => ['label' => 'Version', 'rules' => 'required'],
            'devices' => ['label' => 'Devices', 'rules' => 'required']
        ]);
        if ($this->request->getServer('REQUEST_METHOD') != 'POST') {
            $response = array(
				'status' => 405,
				'message' => 'Request method not allowed.'
			);
        }elseif ($validate_token == NULL) {
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
            if (@$this->request->getPost('devices') == 'android') {
                if (@$this->request->getPost('version') < '1.0.2') {
                    $response = array(
                        'status' => 200,
                        'message' => 'Update your application now.'
                    );
                }else{
                    $response = array(
                        'status' => 204,
                        'message' => ''
                    );
                }
            }elseif(@$this->request->getPost('devices') == 'ios') {
                if (@$this->request->getPost('version') < '1.0.0') {
                    $response = array(
                        'status' => 200,
                        'message' => 'Update your application now.'
                    );
                }else{
                    $response = array(
                        'status' => 204,
                        'message' => ''
                    );
                }
            }else{
                $response = array(
                    'status' => 204,
                    'message' => 'Device not found.'
                );
            }
        }
        echo json_encode($response);
	}
}
?>
