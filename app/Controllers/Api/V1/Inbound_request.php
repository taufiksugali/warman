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

class Inbound_request extends BaseController {
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

    public function get_warehouse() {
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
            $getdatawarehouse = $this->apiv1model->get_warehouse();
            if ($getdatawarehouse != NULL) {
                foreach ($getdatawarehouse as $value) {
                    $data[] = array(
                        'warehouse_id' => $value->warehouse_id,
                        'wh_extid' => $value->wh_extid,
                        'wh_code' => $value->wh_code,
                        'wh_name' => $value->wh_name,
                        'wh_city' => $value->wh_city,
                        'wh_address' => $value->wh_address,
                        'wh_pic' => $value->wh_pic,
                        'wh_pic_phone' => $value->wh_pic_phone,
                        'status' => $value->status,
                        'wh_pic_email' => $value->wh_pic_email,
                        'wh_latitude' => $value->wh_latitude,
                        'wh_longitude' => $value->wh_longitude
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

    public function get_supplier() {
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
            $getdatasupplier = $this->apiv1model->get_supplier();
            if ($getdatasupplier != NULL) {
                foreach ($getdatasupplier as $value) {
                    $data[] = array(
                        'supplier_id' => $value->supplier_id,
                        'supplier_extid' => $value->supplier_extid,
                        'supplier_name' => $value->supplier_name,
                        'supplier_address' => $value->supplier_address,
                        'supplier_city' => $value->supplier_city,
                        'supplier_pic' => $value->supplier_pic,
                        'supplier_phone' => $value->supplier_phone,
                        'status' => $value->status,
                        'supplier_email' => $value->supplier_email
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
            $getdataproduct = $this->apiv1model->get_product();
            if ($getdataproduct != NULL) {
                foreach ($getdataproduct as $value) {
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
                        'material_width' => $value->material_width
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

    public function get_purchase_order() {
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
            $getdatapurchaseorder = $this->apiv1model->get_purchase_order(@$validate->owners_id);
            if ($getdatapurchaseorder != NULL) {
                foreach ($getdatapurchaseorder as $value) {
                    $getdatapurchaseorderdetail = $this->apiv1model->get_purchase_order_detail($value->po_id);

                    $arrayMaterial = [];
                    foreach ($getdatapurchaseorderdetail as $value2) {
                        $dataMat = $value2->material_name . ', '.$value2->qty.' ' . $value2->uom_name . " ";
                        array_push($arrayMaterial, $dataMat);
                    }
                    $inbound_mat = join("", $arrayMaterial);

                    $status_po = ($value->po_status == '1' ? 'New' : '').($value->po_status == '2' ? 'Partial' : '').($value->po_status == '3' ? 'Close' : '').($value->po_status == '0' ? 'Rejected' : '');
                    $data[] = array(
                        'po_id' => $value->po_id,
                        'po_number' => $value->po_number,
                        'po_date' => $value->po_date,
                        'po_status' => $status_po,
                        'description' => $value->description,
                        'create_by' => $value->create_by,
                        'create_date' => $value->create_date,
                        'due_date' => $value->due_date,
                        'product' => $inbound_mat
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

    public function submit_inbound() {
        $getallheaders = getallheaders();
		$authHeader = explode(" ", @$getallheaders['Authorization']);
		$token = @$authHeader[1];
        // $authHeader = explode(" ", $this->input->server('HTTP_AUTHORIZATION'));
        $validate_token = $this->apiv1model->getUserByUserId($token);
        $validate = $this->validate([
            // 'supplier_id' => ['label' => 'Supplier', 'rules' => 'required'],
            'quality_control' => ['label' => 'Quality Control', 'rules' => 'required'],
            'owners_id' => ['label' => 'Seller', 'rules' => 'required'],
            'warehouse_id' => ['label' => 'Warehouse', 'rules' => 'required'],            
            'po_number' => ['label' => 'PO Number', 'rules' => 'required'],
            'po_date' => ['label' => 'Date PO', 'rules' => 'required'],
            'due_date' => ['label' => 'Due Date', 'rules' => 'required'],
            'description' => ['label' => 'Description', 'rules' => 'required'],
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
            $id = $this->apiv1model->generate_purchase_order_id();

            $data_po = [
                'po_id' => $id,
                // 'supplier_id' => $this->request->getPost('supplier_id'),
                'owners_id' => $this->request->getPost('owners_id'),
                'warehouse_id' => $this->request->getPost('warehouse_id'),
                'user_id' => $validate_token->user_id,
                'po_number' => $this->request->getPost('po_number'),
                'qc_status' => $this->request->getPost('quality_control'),
                'po_date' => date_format(date_create($this->request->getPost('po_date')), 'Y-m-d'),
                'due_date' => date_format(date_create($this->request->getPost('due_date')), 'Y-m-d'),
                'description' => $this->request->getPost('description'),
                'po_status' => 1,
                'create_date' => date('Y-m-d H:i:s'),
                'create_by' => $validate_token->fullname
            ];

            $result = $this->apiv1model->insert_data_purchase_order($data_po);

            $material_data = json_decode(@$this->request->getPost('material_data'));
            for ($i=0; $i < count($material_data); $i++) {
                $detil_id = $this->apiv1model->generate_po_detail_id();
                $data_po_detail = [
                    'po_detail_id' => $detil_id,
                    'po_id' => $data_po['po_id'],
                    'material_id' => $material_data[$i]->product,
                    'material_price' => $material_data[$i]->product_price,
                    'status' => 1,
                    'qty' => $material_data[$i]->qty
                ];
                $this->apiv1model->insert_data_po_detail($data_po_detail);
            }
            if ($result == TRUE) {
                $response = array(
                    'status' => 200,
                    'message' => 'Purchase Order successfully added.'
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
}
?>
