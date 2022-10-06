<?php

namespace App\Controllers;
use App\Models\PackingModel;
use App\Models\MaterialDetailModel;
use App\Models\OutboundpoModel;
use App\Models\ResourceController;
use App\Models\PackagingMaterialModel;
use App\Models\OutboundModel;
use App\Models\BillModel;
use App\Models\OutboundDetailModel;
use App\Models\MaterialSohModel;
use App\Models\LocationModel;
use App\Models\SohTotalModel;
use Config\Services;

class Packing extends BaseController
{
    public function __construct()
    {
        $this->packing = new PackingModel();
        $this->material_detail = new MaterialDetailModel();
        $this->outboundpo = new OutboundpoModel();
        $this->pm = new PackagingMaterialModel();
        $this->outbound = new OutboundModel();
        $this->bill = new BillModel();
        $this->outbound_detail = new OutboundDetailModel();
        $this->material_soh = new MaterialSohModel();
        $this->location = new LocationModel();
        $this->soh = new SohTotalModel();

        helper(['form', 'url', 'my']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';

        // special module for warehouse
        if(session()->get('user_type')==1) return redirect()->to(base_url('cannot_access'));

    }

    public function index(){
        $data = [
            'title' => 'Packing',
            'title_menu' => 'Packing',
            'sidebar' => 'Packing plan'
        ];	

        // custom JS
        $data["js"] = "packing_list.js";

		echo view('layout/header', $data);
		echo view('outbound/packing_list', $data);
		echo view('layout/footer_v2', $data);
    }

    public function getData(){

        $columns = array( 
            0 => 'po_outbound.po_outbound_id',
            1 => 'po_outbound.po_outbound_id',
            2 => 'po_outbound.po_outbound_id',
            3 => 'po_outbound.po_outbound_id',
            4 => 'po_outbound.po_create_date',
            5 => 'customer.customer_name',
            6 => 'po_outbound.po_outbound_id',
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        $totalData = $this->packing->all_po_outbound_count_bystatus("1");
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $packing = $this->packing->all_po_outbound_bystatus($limit, $start, $order, $dir, "1");
        } else {
            $search = $this->request->getPost('search')['value']; 
            $packing = $this->packing->search_po_outbound_bystatus($limit, $start, $search, $order, $dir, "1");
            $totalFiltered = $this->packing->search_po_outbound_count_bystatus($search, "1");
        }

        $data = array();
        if(@$packing) {
            foreach ($packing as $row) {
                $start++;
       
                $outbound_status = '<span class="label label-light-success label-pill label-inline mr-2">New</span>';
                $outbound_action = '<a href="'. base_url('packing/addedit/'.$row->po_outbound_id).'" title="Add/edit packing" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"></rect>
                    <path d="M20.4061385,6.73606154 C20.7672665,6.89656288 21,7.25468437 21,7.64987309 L21,16.4115967 C21,16.7747638 20.8031081,17.1093844 20.4856429,17.2857539 L12.4856429,21.7301984 C12.1836204,21.8979887 11.8163796,21.8979887 11.5143571,21.7301984 L3.51435707,17.2857539 C3.19689188,17.1093844 3,16.7747638 3,16.4115967 L3,7.64987309 C3,7.25468437 3.23273352,6.89656288 3.59386153,6.73606154 L11.5938615,3.18050598 C11.8524269,3.06558805 12.1475731,3.06558805 12.4061385,3.18050598 L20.4061385,6.73606154 Z" fill="#000000" opacity="0.3"></path>
                    <polygon fill="#000000" points="14.9671522 4.22441676 7.5999999 8.31727912 7.5999999 12.9056825 9.5999999 13.9056825 9.5999999 9.49408582 17.25507 5.24126912"></polygon>
                </g>
                </svg></span></a>';

                // $material_detail = $this->picking->get_po_outbound_detail($row->po_outbound_id); // data lama
                $material_detail = $this->outboundpo->get_outbound_detail($row->po_outbound_id);
                $arrayMaterial = [];

                foreach($material_detail as $mat){
                    $dataMat = '<li>' . $mat->material_name . ', '.$mat->outbound_qty.' ' . $mat->uom_name . '</li>';
                    array_push($arrayMaterial, $dataMat);
                }
                $outbound_mat = join("", $arrayMaterial);

                $arrayDetail = [];

                $nestedData['number'] = $start;
                $nestedData['po_outbound_id'] = @$row->po_outbound_id;
                $nestedData['po_create_date'] = date('d-m-Y', strtotime(@$row->po_create_date));
                $nestedData['customer_name'] = @$row->customer_name;
                $nestedData['material_name'] = $outbound_mat;
                $nestedData['status'] = $outbound_status;
                $nestedData['action'] = $outbound_action;
                
                $data[] = $nestedData;
            }
        }
          
        $json_data = array(
                    "draw"            => intval($this->request->getPost('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data
                );
            
        echo json_encode($json_data);
    }

    public function getColumns()
	{
		$fields = array('po_outbound_id'
                        , 'po_create_date'
                        , 'customer_name'
                        , 'material_name');
		$columns[] = array(
			'data' => 'number',
			'className' => 'text-center'
		);
        $columns[] = array(
            'data' => 'action',
            'className' => 'text-center text-nowrap'
        );
        $columns[] = array(
            'data' => 'status',
            'className' => 'text-center'
        );
		foreach ($fields as $field) {
			$columns[] = array(
				'data' => $field,
                'className' => 'text-nowrap'
			);
		}
		echo json_encode($columns); 
	}

    public function getPickingNo() {
        $key     = $this->request->getPost('barcode');
		$result = $this->packing->getPickingNo($key);
        
        if (empty($result)){
            $jsonOut = array(
                "code"=>"204",
                "msg"=>"Barcode not found, please check product packing list",
                "data"=>""          
            );
            echo json_encode($jsonOut);
        }
        else{
            $jsonOut = array(
                "code"=>"200",
                "msg"=>"",
                "data"=>$result         
            );
            echo json_encode($jsonOut);
        }
    }

    public function addedit($po_id="")
	{
		$data = [
            'title' => 'Packing',
            'title_menu' => 'Packing',
            'sidebar' => 'Packing'
        ];	
        $outboundpo = $this->packing->get_outbound_byid_after_picking($po_id);
        if(empty($outboundpo)) return redirect()->to(base_url('packing'));

        // pake data lama
        $detail_po = $this->outboundpo->get_outbound_detail($po_id);
        $packing_fee = 0;
        $outbound_package = $this->pm->get_outbound_package($outboundpo->po_outbound_id);
        foreach($outbound_package as $op){
            $packing_fee = $packing_fee + $op->pm_cost;
        }

        $outbound_charge    = 0;
        foreach($detail_po as $row_po){
            $outbound_qty = $row_po->outbound_qty;
            $material_price = $row_po->material_price;
            $charge_per_material = 0.035 * ($material_price * intVal($row_po->outbound_qty));
    
            $outbound_charge = $outbound_charge + $charge_per_material;
        }

        if($outbound_charge < 2500){
            $outbound_charge = 2500;
        }elseif($outbound_charge > 15000){
            $outbound_charge = 15000;
        }

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'outboundpo' => $outboundpo,
            'detail_po' => $detail_po,
            'outbound_package' => $this->pm->get_outbound_package($po_id),
            'packing_fee' => $packing_fee,
            'admin_fee' => $outbound_charge,
            'custom_service_fee' => 0,
		];

        // custom JS
        $data["js"] = "packing_addedit.js";

		echo view('layout/header', $data);
		echo view('outbound/addedit_packing', $dataObject);
		echo view('layout/footer_v2', $data);
	}

    public function getProductItem($idPO=""){
        $key     = $this->request->getGet('q');
        $data = $this->packing->getProductItem($idPO, $key);
        echo json_encode($data);     
    }

    public function getProductByBarcode($idPO="") {
        $key     = $this->request->getPost('barcode');
		$result = $this->packing->getProductByBarcode($idPO, $key);
        
        if (empty($result)){
            $jsonOut = array(
                "code"=>"204",
                "msg"=>"Barcode not found, please check item outbound request",
                "data"=>""          
            );
            echo json_encode($jsonOut);
        }
        else{
            $jsonOut = array(
                "code"=>"200",
                "msg"=>"",
                "data"=>$result         
            );
            echo json_encode($jsonOut);
        }
    }

    public function save() {
        if (!$this->request->isAJAX()) {
            exit('No direct script access allowed');
        } else {
            $err_msg    = '';
            $post       = array('po_id','description','material_id','qty','packing_fee','admin_fee','custom_service_fee','custom_fee');
            $data = array();
            foreach($post as $key=>$val) {
                $$val       = $this->request->getPost($val) == false ? '' : $this->request->getPost($val);
                $data[$val] = $$val;
            }

            $data['custom_fee']        = intval($data['custom_fee']);
            $data['packing_fee']        = intval($data['packing_fee']);
            $data['admin_fee']          = intval($data['admin_fee']);
            $data['custom_service_fee'] = intval($data['custom_service_fee']);

            // check POI
            $outboundpo = $this->packing->get_outbound_byid_after_picking($data['po_id']);
            if(empty($outboundpo)) $err_msg =  "Outbound ID not found.<br/>";

            // get Data detail 
            $dataDetail = array();
            for($i=0; $i<sizeof($data['material_id']); $i++) {
                if(!isset($dataDetail[$data['material_id'][$i]])) {
                    $dataDetail[$data['material_id'][$i]] = array();
                    $dataDetail[$data['material_id'][$i]]['qty'] = intval($data['qty'][$i]);
                } else {
                    $qty = $dataDetail[$data['material_id'][$i]]['qty'];
                    $dataDetail[$data['material_id'][$i]]['qty'] = intval($qty) + intval($data['qty'][$i]);
                }
            }

            // check PO detail VS data detail 
            $detail_po = $this->outboundpo->get_outbound_detail($data['po_id']);
            $error2 = false;
            $varTab = "<table id='tbl-error'>";
            $header = true;
            foreach ($detail_po as $key => $value) {
                $errorDet = false;
                $real = 0;
                if(!isset($dataDetail[$value->material_id])) {
                    $error2 = true;
                    $errorDet = true;
                } else {
                    if(intval($dataDetail[$value->material_id]['qty'])!=intval($value->outbound_qty)) {
                        $error2 = true;
                        $errorDet = true;
                        $real = intval($dataDetail[$value->material_id]['qty']);
                    }
                }
                if ($errorDet) {
                    if ($header) {
                        $varTab .= "<tr>\
                                    <th>Product Code</th>\
                                    <th>Product Name</th>\
                                    <th>Unit</th>\
                                    <th>Qty Request</th>\
                                    <th>Qty Realization</th>\
                                </tr>";
                        $header = false;
                    }
                    $varTab .= "<tr>\
                                    <td>".$value->material_code."</td>\
                                    <td>".$value->material_name."</td>\
                                    <td>".$value->uom_name."</td>\
                                    <td>".$value->outbound_qty."</td>\
                                    <td>".$real."</td>\
                                </tr>";
                }
            }
            $varTab .= "</table>";
            if($error2) { 
                $err_msg .= $varTab;
            }
            if (!empty($err_msg)) {
                return $this->response->setJSON([
                    'code'  => 204,
                    'msg'   => $err_msg,
                    'data'  => ""
                ]);
            }

            $result = $this->packing->save_data($data, $data['po_id']);
            if($result) {
                $dataOutbound = $this->packing->getOutboundByPO($data['po_id']);
                if(empty($idEdit)){
                    $msg = 'Insert success';
                }else{
                    $msg = 'Update success';
                }
                return $this->response->setJSON([
                    'code'  => 200,
                    'msg'   => $msg,
                    'data'  => $dataOutbound->outbound_id
                ]);

            }else{
                if(empty($idEdit)){
                   $msg = 'Insert failed';
                }else{
                   $msg = 'Update failed';
                }
                return $this->response->setJSON([
                    'code'  => 204,
                    'msg'   => $msg,
                    'data'  => ""
                ]);
            }
        }
    }

}
?>