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

class History extends BaseController {
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

    public function get_topup() {
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
            $dataTopupByOwnersId = $this->apiv1model->get_topup_byownersid($validate->owners_id);
            if ($dataTopupByOwnersId != NULL) {
                foreach ($dataTopupByOwnersId as $value) {
                    $status_topup = ($value->topup_status == '1' ? 'Approved' : '').($value->topup_status == '2' ? 'Rejected' : '').($value->topup_status == '0' ? 'Waiting for approval' : '');
                    $data[] = array(
                        'topup_id' => $value->topup_id,
                        'topup_name' => $value->topup_name,
                        'bank_name' => $value->bank_name,
                        'owners_name' => $value->owners_name,
                        'topup_date' => $value->topup_date,
                        'topup_amount' => number_format($value->topup_amount),
                        'topup_proof' => base_url('../images/topup-proof/'.$validate->owners_id.'/'.$value->topup_proof),
                        'status_topup' => $status_topup
                    );
                }
    
                $response = array(
                    'status' => 200,
                    'message' => 'Data available.',
                    'data' => $data
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

    public function get_bill_data() {
        $getallheaders = getallheaders();
		$authHeader = explode(" ", @$getallheaders['Authorization']);
		$token = @$authHeader[1];
        // $authHeader = explode(" ", $this->input->server('HTTP_AUTHORIZATION'));
        $validate_token = $this->apiv1model->getUserByUserId($token);
        $validate = $this->validate([
            'date_start' => ['label' => 'Start Date', 'rules' => 'required'],
            'date_end' => ['label' => 'End Date', 'rules' => 'required']
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
            $date_start = $this->request->getPost('date_start');
            $date_end = $this->request->getPost('date_end');
            $dataoutboundbyowners = $this->apiv1model->get_outbound_by_owners_date($validate_token->owners_id, $date_start, $date_end);
            if ($dataoutboundbyowners != NULL) {
                foreach ($dataoutboundbyowners as $value) {
                    $material_detail = $this->apiv1model->get_outbound_detail($value->po_outbound_id);
                    $arrayMaterial = [];
                    foreach($material_detail as $mat){
                        $dataMat = $mat->material_name . ', '.$mat->outbound_qty.' ' . $mat->uom_name;
                        array_push($arrayMaterial, $dataMat);
                    }
                    $outbound_mat = join("", $arrayMaterial);
                    $status_po = ($value->po_out_status == '4' ? 'Sent' : '').($value->po_out_status == '5' ? 'Approved' : '').($value->po_out_status == '6' ? 'Rejected' : '').($value->po_out_status == '7' ? 'Done' : '');
                    $data[] = array(
                        'po_outbound_id' => $value->po_outbound_id,
                        'customer_name' => $value->customer_name,
                        'po_out_status' => $status_po,
                        'outbound_mat' => $outbound_mat
                    );
                }
    
                $response = array(
                    'status' => 200,
                    'message' => 'Data available.',
                    'data' => $data
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

    public function get_invoice() {
        $getallheaders = getallheaders();
		$authHeader = explode(" ", @$getallheaders['Authorization']);
		$token = @$authHeader[1];
        // $authHeader = explode(" ", $this->input->server('HTTP_AUTHORIZATION'));
        $validate_token = $this->apiv1model->getUserByUserId($token);
        $validate = $this->validate([
            'po_outbound_id' => ['label' => 'ID', 'rules' => 'required']
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
            $dataoutboundbyid = $this->apiv1model->get_outbound_byid($this->request->getPost('po_outbound_id'));
            if ($dataoutboundbyid != NULL) {
                $databillbypoid = $this->apiv1model->get_bill_bypo_id($this->request->getPost('po_outbound_id'));
                $total_amount = 0;
                foreach ($databillbypoid as $value) {
                    $total_amount = $total_amount + $value->amount;
                    $data_bill[] = array(
                        'description' => $value->description,
                        'ref_id' => $value->ref_id,
                        'amount' => number_format($value->amount)
                    );
                }
                $due_date = strtotime($dataoutboundbyid->po_create_date);
                
                $status_po = ($dataoutboundbyid->po_out_status == '4' ? 'Sent' : '').($dataoutboundbyid->po_out_status == '5' ? 'Approved' : '');
                $data = array(
                    'po_outbound_id' => $dataoutboundbyid->po_outbound_id,
                    'po_create_date' => $dataoutboundbyid->po_create_date,
                    'owners_name' => $dataoutboundbyid->owners_name,
                    'owners_address' => $dataoutboundbyid->owners_address,
                    'wh_address' => $dataoutboundbyid->wh_address,
                    'due_date' => date('d M Y', strtotime("+1 month", $due_date)),
                    'total_amount' => number_format($total_amount),
                    'po_out_status' => $status_po,
                    'data_bill' => $data_bill
                );
    
                $response = array(
                    'status' => 200,
                    'message' => 'Data available.',
                    'data' => $data
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
}
?>
