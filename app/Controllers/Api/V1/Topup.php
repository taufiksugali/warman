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

class Topup extends BaseController {
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

    public function get_bank() {
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
            $getdatabank = $this->apiv1model->get_bank();
            $getdatabankdest = $this->apiv1model->get_bank_dest();
            if ($getdatabank != NULL && $getdatabankdest != NULL) {
                foreach ($getdatabank as $value) {
                    $data[] = array(
                        'bank_id' => $value->bank_id,
                        'bank_name' => $value->bank_name,
                        'bank_code' => $value->bank_code,
                        'bank_status' => $value->bank_status
                    );
                }

                foreach ($getdatabankdest as $value) {
                    $data2[] = array(
                        'dest_id' => $value->dest_id,
                        'dest_name' => $value->dest_name,
                        'dest_code' => $value->dest_code,
                        'dest_account' => $value->dest_account
                    );
                }
                $response = array(
					'status' => 200,
					'message' => 'Data available.',
					'data' => $data,
                    'data2' => $data2
				);
            }else{
                $response = array(
                    'status' => 204,
					'message' => 'Data not available.'
                );
            }
        }
        echo json_encode($response);
	}

    public function submit_topup() {
        $getallheaders = getallheaders();
		$authHeader = explode(" ", @$getallheaders['Authorization']);
		$token = @$authHeader[1];
        // $authHeader = explode(" ", $this->input->server('HTTP_AUTHORIZATION'));
        $validate_token = $this->apiv1model->getUserByUserId($token);
        $validate = $this->validate([
            'bank_id' => ['label' => 'Bank', 'rules' => 'required'],
            'owners_id' => ['label' => 'Owners', 'rules' => 'required'],            
            'topup_amount' => ['label' => 'Top Up Amount', 'rules' => 'required'],
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
            $id = $this->apiv1model->generate_owners_topup_id();
            $data_owner = [
                'topup_id' => $id,
                'bank_id' => $this->request->getPost('bank_id'),
                'owners_id' => $this->request->getPost('owners_id'),
                'topup_amount' => $this->request->getPost('topup_amount'),
                'topup_status' => 0,
                'topup_va' => $this->apiv1model->generate_va_number()->VA_NUMBER,
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => $validate_token->fullname,
            ];

            $result = $this->apiv1model->insert_data_owners_topup($data_owner);
            if ($result == TRUE) {
                $response = array(
                    'status' => 200,
                    'message' => 'Topup successfully added.'
                );
            }else{
                $response = array(
                    'status' => 500,
                    'message' => 'Connection problems.'
                );
            }
        }
        echo json_encode($response);
	}

    public function upload_proof() {
        $getallheaders = getallheaders();
		$authHeader = explode(" ", @$getallheaders['Authorization']);
		$token = @$authHeader[1];
        // $authHeader = explode(" ", $this->input->server('HTTP_AUTHORIZATION'));
        $validate_token = $this->apiv1model->getUserByUserId($token);

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
        }else{
            // $topup_photo = $_FILES['file']['name'];
            $topup_photo = $this->request->getFile('file');
            if($topup_photo != '') {
                if(is_dir('../public/images/topup-proof/'.@$getallheaders['create_folder']) == false){
                    mkdir('../public/images/topup-proof/'.@$getallheaders['create_folder']);
                }
                $topup_photo_name = $topup_photo->getRandomName();
                $topup_photo->move('../public/images/topup-proof/'.@$getallheaders['create_folder'], $topup_photo_name);
    
                $response = array(
                    'status' => 200,
                    'message' => 'Proof uploaded.',
                    'data' => $topup_photo_name
                );
            }else{
                $response = array(
                    'status' => 500,
                    'message' => 'Connection problems.',
                    'data' => NULL
                );
            }
        }
        echo json_encode($response);
	}

    public function submit_withdraw() {
        $getallheaders = getallheaders();
		$authHeader = explode(" ", @$getallheaders['Authorization']);
		$token = @$authHeader[1];
        // $authHeader = explode(" ", $this->input->server('HTTP_AUTHORIZATION'));
        $validate_token = $this->apiv1model->getUserByUserId($token);
        $validate = $this->validate([
            'withdraw_amount' => ['label' => 'Withdraw Amount', 'rules' => 'required'],
            'bank_id' => ['label' => 'Bank Name', 'rules' => 'required'],
            'owners_id' => ['label' => 'Owners', 'rules' => 'required']
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
            $id = $this->apiv1model->generate_owners_topup_id();
            
            $withdraw_amount = $this->request->getPost('withdraw_amount');
            $owners_balance = $validate_token->owners_balance;
            $min_result = $owners_balance - $withdraw_amount;
            if($withdraw_amount < $owners_balance && $min_result > 100000) {
                $data_owner = [
                    'topup_id' => $id,
                    'topup_name' => $validate_token->fullname,
                    'bank_id' => $this->request->getPost('bank_id'),
                    'owners_id' => $this->request->getPost('owners_id'),
                    'topup_date' => date('Y-m-d'),
                    'topup_amount' => $withdraw_amount,
                    'topup_proof' => NULL,
                    'topup_status' => 4,
                    'created_date' => date('Y-m-d H:i:s'),
                    'created_by' => $validate_token->fullname,
                    'topup_account' => $validate_token->owners_account,
                ];
    
                $result = $this->apiv1model->insert_data_owners_topup($data_owner);
                if ($result == TRUE) {
                    $response = array(
                        'status' => 200,
                        'message' => 'Withdraw has been requested.'
                    );
                }else{
                    $response = array(
                        'status' => 500,
                        'message' => 'Connection problems.'
                    );
                }
            }else{
                $response = array(
                    'status' => 204,
                    'message' => 'Your Balance is not enough to do this transaction.'
                );
            }
        }
        echo json_encode($response);
	}
}
?>
