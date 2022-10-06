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

class Picking extends BaseController {
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

    public function get_package_material() {
        $getallheaders = getallheaders();
		$authHeader = explode(" ", @$getallheaders['Authorization']);
		$token = @$authHeader[1];
        // $authHeader = explode(" ", $this->input->server('HTTP_AUTHORIZATION'));
        if ($this->request->getServer('REQUEST_METHOD') != 'GET') {
            $response = array(
				'status' => 405,
				'message' => 'Request method not allowed.'
			);
        }elseif ($token != 'a9f29dd50156bb6a50cfe35967fec722') {
            $response = array(
				'status' => 401,
				'message' => 'Invalid authentication token.'
			);
        }else{
            $getdatapackagematerial = $this->apiv1model->get_package_material();
            if ($getdatapackagematerial != NULL) {
                foreach ($getdatapackagematerial as $value) {
                    $data[] = array(
                        'id' => $value->id,
                        'pm_name' => $value->pm_name,
                        'pm_rate' => $value->pm_rate,
                        'pm_photo' => $value->pm_photo,
                        'pm_status' => $value->pm_status
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

    public function scan_so() {
        $getallheaders = getallheaders();
		$authHeader = explode(" ", @$getallheaders['Authorization']);
		$token = @$authHeader[1];
        // $authHeader = explode(" ", $this->input->server('HTTP_AUTHORIZATION'));

        $validate = $this->validate([
            'po_outbound_id' => ['label' => 'Barcode', 'rules' => 'required']
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
            $po_outbound_id = @$this->request->getPost('po_outbound_id');

            $getdatapooutbound = $this->apiv1model->get_outbound_byid($po_outbound_id);
            if ($getdatapooutbound != NULL) {
                if ($getdatapooutbound->po_out_status == '1') {
                    $data1 = array(
                        'po_outbound_id' => $getdatapooutbound->po_outbound_id,
                        'po_outbound_type' => $getdatapooutbound->po_outbound_type,
                        'po_penerima' => $getdatapooutbound->po_penerima,
                        'customer_id' => $getdatapooutbound->customer_id,
                        'customer_name' => $getdatapooutbound->customer_name,
                        'po_outbound_doc' => $getdatapooutbound->po_outbound_doc,
                        'po_outbound_doc_date' => $getdatapooutbound->po_outbound_doc_date,
                        'po_create_date' => $getdatapooutbound->po_create_date,
                        'warehouse_id' => $getdatapooutbound->warehouse_id,
                        'wh_name' => $getdatapooutbound->wh_name,
                        'po_out_status' => $getdatapooutbound->po_out_status,
                        'po_out_date' => $getdatapooutbound->po_out_date,
                        'po_create_by' => $getdatapooutbound->po_create_by,
                        'po_description' => $getdatapooutbound->po_description,
                        'owners_id' => $getdatapooutbound->owners_id,
                        'owners_name' => $getdatapooutbound->owners_name,
                        'trans_type_name' => $getdatapooutbound->trans_type_name,
                    );
                    $data2['getallmaterialbyowner'] = $this->apiv1model->get_all_material_byowner($getdatapooutbound->owners_id, $getdatapooutbound->warehouse_id);
                    $data3['getoutbounddetail'] = $this->apiv1model->get_outbound_detail($getdatapooutbound->po_outbound_id);
                    $response = array(
                        'status' => 200,
                        'message' => 'Data available.',
                        'data1' => $data1,
                        'data2' => $data2['getallmaterialbyowner'],
                        'data3' => $data3['getoutbounddetail']
                    );
                }else{
                    $response = array(
                        'status' => 204,
                        'message' => 'Data not available.'
                    );
                }
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
            'owner_id' => ['label' => 'Owner', 'rules' => 'required'],
            'shelf_id' => ['label' => 'Barcode', 'rules' => 'required'],
            'material_id' => ['label' => 'Material', 'rules' => 'required'],
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
            $owner_id = @$this->request->getPost('owner_id');
            $warehouse_id = @$this->request->getPost('warehouse_id');
            $material_id = @$this->request->getPost('material_id');
            $shelf_id = $this->request->getPost('shelf_id');
            $getlocationbymaterial = $this->apiv1model->get_location_bymaterial($owner_id, $warehouse_id, $material_id, $shelf_id);
            
            if ($getlocationbymaterial != NULL) {
                $data = array(
                    'mat_detail_id' => @$getlocationbymaterial->mat_detail_id,
                    'material_name' => @$getlocationbymaterial->material_name,
                    'owner_id' => @$getlocationbymaterial->owner_id,
                    'owners_status' => @$getlocationbymaterial->owners_status,
                    'expired_date' => @$getlocationbymaterial->expired_date,
                    'batch_no' => @$getlocationbymaterial->batch_no,
                    'shelf_id' => @$getlocationbymaterial->shelf_id,
                    'location_id' => @$getlocationbymaterial->location_id,
                    'shelf_name' => @$getlocationbymaterial->shelf_name,
                    'rak_name' => @$getlocationbymaterial->rak_name,
                    'blok_name' => @$getlocationbymaterial->blok_name,
                    'wh_area_name' => @$getlocationbymaterial->wh_area_name,
                    'warehouse_id' => @$getlocationbymaterial->warehouse_id,
                    'wh_name' => @$getlocationbymaterial->wh_name,
                    'qty' => @$getlocationbymaterial->qty
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

    public function create_outbound_plan() {
        $getallheaders = getallheaders();
		$authHeader = explode(" ", @$getallheaders['Authorization']);
		$token = @$authHeader[1];
        // $authHeader = explode(" ", $this->input->server('HTTP_AUTHORIZATION'));

        $validate = $this->validate([
            'warehouse_id' => ['label' => 'Warehouse Origin', 'rules' => 'required'],
            'customer_id' => ['label' => 'Customer Name', 'rules' => 'required'],
            'out_date' => ['label' => 'Out Date', 'rules' => 'required'],
            'description' => ['label' => 'Description', 'rules' => 'required'],
            'packing_cost' => ['label' => 'Packing Cost', 'rules' => 'required'],
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
            $data_outbound = [
                'outbound_id' => $this->apiv1model->generate_outbound_id(),
                'po_outbound_id' => $this->request->getPost('po_outbound_id'),
                // 'outbound_doc_date' => date_format(date_create($this->request->getPost('doc_date')), 'Y-m-d'),
                'out_date' => date_format(date_create($this->request->getPost('out_date')), 'Y-m-d'),
                // 'outbound_doc' => $this->request->getPost('doc_number'),
                'description' => $this->request->getPost('description'),
                'penerima' => $this->request->getPost('customer_id'),
                'outbound_wh_asal' => $this->request->getPost('warehouse_id'),
                'outbound_type' => 'TY003',
                'status' => 2,
                'create_date' => date('Y-m-d H:i:s'),
                'create_by' => $this->request->getPost('fullname')
            ];
            $this->apiv1model->insert_data_outbound($data_outbound);

            // update po outbound
            $id_po = $this->request->getPost('po_outbound_id');
            $data_po = [
                'po_out_status' => 2
            ];
            $this->apiv1model->update_data_po_outbound($id_po, $data_po);

            // insert bill
            $bill_id = $this->apiv1model->generate_owners_bill_id();
            $data_bill = [
                'bill_id' => $bill_id,
                'ref_id' => $data_outbound['outbound_id'],
                'po_id' => $this->request->getPost('po_outbound_id'),
                'owners_id' => $this->request->getPost('owner_id'),
                'description' => 'BIAYA PACKING',
                'amount' => $this->request->getPost('packing_cost'),
                'created_date' => date('Y-m-d H:i:s'),
                'bill_status' => 0
            ];
            $this->apiv1model->insert_data_owners_bill($data_bill);
            
            $material_data = json_decode(@$this->request->getPost('material_data'));

            $getoutbounddetail = $this->apiv1model->get_outbound_detail($id_po);
            $jumlah_pesanan = 0;
            foreach ($getoutbounddetail as $key => $value) {
                $jumlah_pesanan += $value->outbound_qty;
            }
            $jumlah_picking = 0;
            for ($u=0; $u < count($material_data); $u++) {
                $jumlah_picking += $material_data[$u]->picking_qty;
            }

            if ($jumlah_pesanan == $jumlah_picking) {
                // insert material detail
                for ($i=0; $i < count($material_data); $i++) {
                    $data_outbound_detail = [
                        'det_outbound_id' => $this->apiv1model->generate_det_outbound_id(),
                        'outbound_id' => $data_outbound['outbound_id'],
                        'material_detail_id' => $material_data[$i]->mat_detail_id,
                        'outbound_qty' => $material_data[$i]->picking_qty,
                        'qty_realization' => $material_data[$i]->picking_qty,
                        'location_id' => $material_data[$i]->location_id,
                        'status' => 1
                    ];
                    $this->apiv1model->insert_data_outbound_detail($data_outbound_detail);

                    $current_stock = $this->apiv1model->get_currrent_stock($data_outbound_detail['material_detail_id'])->stock_ok; //perlu diperiksa.
                    $new_stock = $current_stock - $data_outbound_detail['qty_realization']; //sepertinya perlu diganti
                    $mat_soh = [
                        'stock_ok' => $new_stock,
                        'status' => 1
                    ];
                    $this->apiv1model->update_data_warehouse_soh($data_outbound_detail['material_detail_id'], $mat_soh);

                    $location_id = $data_outbound_detail['location_id'];
                    $current_qty = $this->apiv1model->get_location_byid($location_id)->qty;
                    $new_qty = $current_qty - $data_outbound_detail['qty_realization'];
                    $mat_location = [
                        'qty' => $new_qty
                    ];
                    $this->apiv1model->update_data_material_location($location_id, $mat_location);

                    $shelf_avail = $this->apiv1model->check_material_detail_on_shelfv2($location_id)->shelf_availability;
                    $shelf_id = $this->apiv1model->check_material_detail_on_shelfv2($location_id)->shelf_id;
                    $cur_avail = $shelf_avail + $data_outbound_detail['qty_realization'];
                    $data_shelf_tujuan = [
                        'shelf_availability' => $cur_avail
                    ];
                    $this->apiv1model->update_data_shelf($shelf_id, $data_shelf_tujuan);
                }

                $outbound_package = json_decode(@$this->request->getPost('outbound_package'));
                for ($i=0; $i < count($outbound_package); $i++) {
                    $data_packaging_detail = [
                        'pm_detil_id' => $this->apiv1model->generate_pm_detil_id(),
                        'outbound_id' => $data_outbound['outbound_id'],
                        'pm_id' => $outbound_package[$i]->pm_id,
                        'pm_qty' => $outbound_package[$i]->pm_qty,
                        'pm_cost' => $outbound_package[$i]->pm_cost
                    ];
                    $this->apiv1model->insert_data_outbound_package($data_packaging_detail);
                }
                
                $response = array(
                    'status' => 200,
                    'message' => 'Material Location successfully added.'
                );
            }else{
                $response = array(
                    'status' => 204,
                    'message' => 'Material quantity doesnt match.'
                );
            }
        }
        echo json_encode($response);
	}
}
?>