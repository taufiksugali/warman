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

class Outbound_request extends BaseController {
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

    public function get_customer() {
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
            $getdatacustomer = $this->apiv1model->get_customer();
            if ($getdatacustomer != NULL) {
                foreach ($getdatacustomer as $value) {
                    $data[] = array(
                        'customer_id' => $value->customer_id,
                        'customer_extid' => $value->customer_extid,
                        'customer_name' => $value->customer_name,
                        'customer_cluster' => $value->customer_cluster,
                        'customer_area' => $value->customer_area,
                        'customer_city' => $value->customer_city,
                        'customer_pic' => $value->customer_pic,
                        'status' => $value->status,
                        'customer_phone' => $value->customer_phone,
                        'customer_address' => $value->customer_address,
                        'customer_email' => $value->customer_email
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

    public function get_transporter() {
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
            $getdatatransporter = $this->apiv1model->get_transporter();
            if ($getdatatransporter != NULL) {
                foreach ($getdatatransporter as $value) {
                    $data[] = array(
                        'transporter_id' => $value->transporter_id,
                        'transporter_name' => $value->transporter_name,
                        'transporter_alias' => $value->transporter_alias,
                        'transporter_photo' => $value->transporter_photo,
                        'transporter_status' => $value->transporter_status
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

    public function get_product() {
        $getallheaders = getallheaders();
		$authHeader = explode(" ", @$getallheaders['Authorization']);
		$token = @$authHeader[1];
        // $authHeader = explode(" ", $this->input->server('HTTP_AUTHORIZATION'));
        $validate_token = $this->apiv1model->getUserByUserId($token);
        $validate = $this->validate([
            'owners_id' => ['label' => 'Owners', 'rules' => 'required'],
            'warehouse_id' => ['label' => 'Warehouse', 'rules' => 'required']
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
            $owner_id = $this->request->getPost('owners_id');
            $warehouse_id = $this->request->getPost('warehouse_id');
            $getdataproduct = $this->apiv1model->get_all_material_byowner($owner_id, $warehouse_id);
            if ($getdataproduct != NULL) {
                foreach ($getdataproduct as $value) {
                    $getdataqtybylocationpo = $this->apiv1model->get_qty_bylocation_po($owner_id, $warehouse_id, $value->material_id);
                    $getdataqtybylocationpong = $this->apiv1model->get_qty_bylocation_po_ng($owner_id, $warehouse_id, $value->material_id);

                    $data[] = array(
                        'material_id' => $value->material_id,
                        'material_extid' => $value->material_extid,
                        'material_name' => $value->material_name,
                        'description' => $value->description,
                        'mat_group_id' => $value->mat_group_id,
                        'mat_uom' => $value->mat_uom,
                        'material_code' => $value->material_code,
                        'status' => $value->status,
                        'material_weight' => $value->material_weight,
                        'material_height' => $value->material_height,
                        'material_length' => $value->material_length,
                        'material_width' => $value->material_width,
                        'stock_ok' => $getdataqtybylocationpo->qty,
                        'stock_nok' => $getdataqtybylocationpong->qty,
                        'material_price' => $value->material_price
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

    public function get_outbound() {
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
            $dataoutboundbyowners = $this->apiv1model->get_outbound_by_owners($validate->owners_id, 'History');
            if ($dataoutboundbyowners != NULL) {
                foreach ($dataoutboundbyowners as $value) {
                    $material_detail = $this->apiv1model->get_outbound_detail($value->po_outbound_id);
                    $arrayMaterial = [];
                    foreach($material_detail as $mat){
                        $dataMat = $mat->material_name . ', '.$mat->outbound_qty.' ' . $mat->uom_name;
                        array_push($arrayMaterial, $dataMat);
                    }
                    $outbound_mat = join("", $arrayMaterial);
                    $status_po = ($value->po_out_status == '1' ? 'New' : '').($value->po_out_status == '2' ? 'Packing' : '').($value->po_out_status == '3' ? 'Shipping' : '').($value->po_out_status == '4' ? 'Sent' : '').($value->po_out_status == '5' ? 'Approved' : '').($value->po_out_status == '6' ? 'AWB Rejected' : '').($value->po_out_status == '7' ? 'Done' : '');
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

    public function submit_outbound() {
        $getallheaders = getallheaders();
		$authHeader = explode(" ", @$getallheaders['Authorization']);
		$token = @$authHeader[1];
        // $authHeader = explode(" ", $this->input->server('HTTP_AUTHORIZATION'));
        $validate_token = $this->apiv1model->getUserByUserId($token);
        $validate = $this->validate([
            'customer_id' => ['label' => 'Customer', 'rules' => 'required'],            
            'owners_id' => ['label' => 'Seller', 'rules' => 'required'],
            'warehouse_id' => ['label' => 'Warehouse', 'rules' => 'required'],
            'out_date' => ['label' => 'Outbound Date', 'rules' => 'required'],
            'doc_date' => ['label' => 'Doc Date', 'rules' => 'required'],
            'description' => ['label' => 'Description', 'rules' => 'required'],
            'transporter_id' => ['label' => 'Transporter', 'rules' => 'required'],
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
            $material_data = json_decode(@$this->request->getPost('material_data'));            
            $outbound_charge=0;
            if($material_data != NULL) {
                for ($i=0; $i < count($material_data); $i++) {
                    if (@$material_data[$i]->qty != '' && @$material_data[$i]->qty != NULL) {
                        $material_price = $material_data[$i]->material_price;
                        $charge_per_material = 0.035 * $material_price;
                        $outbound_charge = ($outbound_charge + $charge_per_material) * $material_data[$i]->qty;
                    }
                }
                $balance = intVal($validate_token->owners_balance) - 100000;
                if($outbound_charge > $balance) {
                    $response = array(
                        'status' => 204,
                        'message' => 'Not enough balance.'
                    );
                    echo json_encode($response);
                    exit();
                }

                $id = $this->apiv1model->generate_po_outbound_id();
            
                $data_outbound = [
                    'po_outbound_id' => $id,
                    'po_outbound_doc_date' => date_format(date_create($this->request->getPost('doc_date')), 'Y-m-d'),
                    'po_out_date' => date_format(date_create($this->request->getPost('out_date')), 'Y-m-d'),
                    // 'po_outbound_doc' => $this->request->getPost('doc_number'),
                    'po_description' => $this->request->getPost('description'),
                    'po_penerima' => $this->request->getPost('customer_id'),
                    'warehouse_id' => $this->request->getPost('warehouse_id'),
                    'owners_id' => $this->request->getPost('owners_id'),
                    'transporter_id' => $this->request->getPost('transporter_id'),
                    'po_outbound_type' => 'TY003',
                    'po_out_status' => 1,
                    'po_create_date' => date('Y-m-d H:i:s'),
                    'po_create_by' => $validate_token->fullname
                ];

                $this->apiv1model->insert_data_po_outbound($data_outbound);

                $bill_id = $this->apiv1model->generate_owners_bill_id();
                $data_bill = [
                    'bill_id' => $bill_id,
                    'owners_id' => $this->request->getPost('owners_id'),
                    'description' => 'BIAYA OUTBOUND',
                    'amount' => $outbound_charge,
                    'created_date' => date('Y-m-d H:i:s'),
                    'bill_status' => 0
                ];

                $this->apiv1model->insert_data_owners_bill($data_bill);            

                for ($i=0; $i < count($material_data); $i++) {
                    if (@$material_data[$i]->qty != '' && @$material_data[$i]->qty != NULL) {
                        $detil_id = $this->apiv1model->generate_po_out_detail_id();
                        $data_outbound_detail = [
                            'po_det_outbound_id' => $detil_id,
                            'po_outbound_id' => $data_outbound['po_outbound_id'],
                            'material_id' => $material_data[$i]->material_id,
                            'outbound_qty' => $material_data[$i]->qty,
                            'qty_good' => $material_data[$i]->qty,
                            // 'location_id' => $this->request->getPost('location['.$i.']'),
                            'status' => 1
                        ];
                        $this->apiv1model->insert_data_po_out_detail($data_outbound_detail);
                    }
                }
                $response = array(
                    'status' => 200,
                    'message' => 'Outbound successfully added.'
                );
            }else{
                $response = array(
                    'status' => 204,
                    'message' => 'Product data not available .'
                );
            }
        }
        echo json_encode($response);
	}
}
?>
