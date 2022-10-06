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

class Putaway extends BaseController {
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

    public function scan_shelf() {
        $getallheaders = getallheaders();
		$authHeader = explode(" ", @$getallheaders['Authorization']);
		$token = @$authHeader[1];
        // $authHeader = explode(" ", $this->input->server('HTTP_AUTHORIZATION'));

        $validate = $this->validate([
            'shelf_id' => ['label' => 'Barcode', 'rules' => 'required'],
            'warehouse_id' => ['label' => 'Warehouse', 'rules' => 'required']
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
            $shelf_id = @$this->request->getPost('shelf_id');
            $warehouse_id = @$this->request->getPost('warehouse_id');

            $getdatarak = $this->apiv1model->get_shelf_byid($shelf_id, $warehouse_id);
            if ($getdatarak != NULL) {
                $data = array(
                    'shelf_id' => $getdatarak->shelf_id,
                    'shelf_name' => $getdatarak->shelf_name,
                    'shelf_max' => $getdatarak->shelf_max,
                    'shelf_availability' => $getdatarak->shelf_availability,
                    'rak_id' => $getdatarak->rak_id,
                    'rak_code' => $getdatarak->rak_code,
                    'rak_name' => $getdatarak->rak_name,
                    'warehouse_id' => $getdatarak->warehouse_id,
                    'wh_name' => $getdatarak->wh_name,
                    'wh_area_id' => $getdatarak->wh_area_id,
                    'wh_area_name' => $getdatarak->wh_area_name,
                    'blok_id' => $getdatarak->blok_id,
                    'blok_name' => $getdatarak->blok_name
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

    public function scan_material() {
        $getallheaders = getallheaders();
		$authHeader = explode(" ", @$getallheaders['Authorization']);
		$token = @$authHeader[1];
        // $authHeader = explode(" ", $this->input->server('HTTP_AUTHORIZATION'));

        $validate = $this->validate([
            'det_inbound_id' => ['label' => 'Barcode', 'rules' => 'required'],
            'warehouse_id' => ['label' => 'Warehouse', 'rules' => 'required']
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
            $det_inbound_id = @$this->request->getPost('det_inbound_id');
            $warehouse_id = @$this->request->getPost('warehouse_id');

            $getdatainbounddetail = $this->apiv1model->get_detail_material($det_inbound_id, $warehouse_id);
            if ($getdatainbounddetail != NULL) {
                $data = array(
                    'det_inbound_id' => @$getdatainbounddetail->det_inbound_id,
                    'inbound_id' => @$getdatainbounddetail->inbound_id,
                    'material_detail_id' => @$getdatainbounddetail->material_detail_id,
                    'material_name' => @$getdatainbounddetail->material_name,
                    'qty_good_in' => @$getdatainbounddetail->qty_good_in,
                    'qty_notgood_in' => @$getdatainbounddetail->qty_notgood_in
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

    public function set_location() {
        $getallheaders = getallheaders();
		$authHeader = explode(" ", @$getallheaders['Authorization']);
		$token = @$authHeader[1];
        // $authHeader = explode(" ", $this->input->server('HTTP_AUTHORIZATION'));

        $validate = $this->validate([
            'material_detail_id' => ['label' => 'Material Detail Id', 'rules' => 'required'],            
            'fullname' => ['label' => 'Full Name', 'rules' => 'required'],
            'det_inbound_id' => ['label' => 'Inbound Detail Id', 'rules' => 'required'],
            'inbound_id' => ['label' => 'Inbound Id', 'rules' => 'required'],
            'qty_good_in' => ['label' => 'Qty Good In', 'rules' => 'required'],
            'qty_notgood_in' => ['label' => 'Qty Not Good In', 'rules' => 'required'],
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
            $qty_good_in = intval($this->request->getPost('qty_good_in'));
            $qty_notgood_in = intval($this->request->getPost('qty_notgood_in'));
            $total_good = $qty_good_in + $qty_notgood_in;            
            
            
            $location_data = json_decode(@$this->request->getPost('location_data'));
            $total_masuk = 0;
            for ($u=0; $u < count($location_data); $u++) {
                $total_masuk += intval($location_data[$u]->putaway_qty);
            }

            if ($total_good == $total_masuk) {
                for ($i=0; $i < count($location_data); $i++) {
                    $shelf_availability = intval($location_data[$i]->shelf_availability);
                    $jumlah_masuk = intval($location_data[$i]->putaway_qty);
                    $shelf_availability_update = $shelf_availability - $jumlah_masuk;
                    $data_location = array(
                        'location_id' => $this->apiv1model->generate_location_id(),
                        'material_detail_id' => $this->request->getPost('material_detail_id'),
                        'shelf_id' => $location_data[$i]->shelf_id,
                        'qty' => $location_data[$i]->putaway_qty,
                        'status' => 1,
                        'create_date' => date('Y-m-d H:i:s'),
                        'create_by' => $this->request->getPost('fullname')
                    );
                    if($jumlah_masuk <= $shelf_availability) {
                        $data_shelf = [
                            'shelf_availability' => intVal($shelf_availability_update)
                        ];
                        $this->apiv1model->update_data_shelf($location_data[$i]->shelf_id, $data_shelf);
                        $this->apiv1model->insert_data_material_location($data_location);
                    }else{
                        $response = array(
                            'status' => 204,
                            'message' => 'Shelf availability overload.'
                        );
                        echo json_encode($response);
                        die();
                    }
                }

                $det_inbound_id = $this->request->getPost('det_inbound_id');
                $data_inbound_detail = [
                    'status' => 3
                ];
                $result_inbound_detail = $this->apiv1model->update_data_inbound_detail($det_inbound_id, $data_inbound_detail);
                
                $cek = 0;
                $detail_status = $this->apiv1model->check_status($this->request->getPost('inbound_id'));
                foreach($detail_status as $ds){
                    if($ds->status == 2){
                        $cek++;
                    }
                }
                if($cek == 0){
                    $inbound_status = [
                        'status' => 3
                    ];
                    $this->apiv1model->update_data_inbound($this->request->getPost('inbound_id'), $inbound_status);
                }
                if ($result_inbound_detail != NULL) {
                    $response = array(
                        'status' => 200,
                        'message' => 'Material Location successfully added.'
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
                    'message' => 'Material quantity doesnt match.'
                );
            }
        }
        echo json_encode($response);
	}

    public function view_material() {
        $getallheaders = getallheaders();
		$authHeader = explode(" ", @$getallheaders['Authorization']);
		$token = @$authHeader[1];
        // $authHeader = explode(" ", $this->input->server('HTTP_AUTHORIZATION'));

        $validate = $this->validate([
            'shelf_id' => ['label' => 'Shelf', 'rules' => 'required'],
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
            $shelf_id = @$this->request->getPost('shelf_id');

            $getdatamaterialbyshelf = $this->apiv1model->get_materials_byshelf($shelf_id);
            if ($getdatamaterialbyshelf != NULL) {
                foreach ($getdatamaterialbyshelf as $key => $value) {
                    $data[] = array(
                        'material_id' => @$value->material_id,
                        'material_name' => @$value->material_name,
                        'qty' => @$value->qty
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
}
?>
