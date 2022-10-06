<?php

namespace App\Controllers;
use App\Models\PickingModel;
use App\Models\MaterialDetailModel;
use App\Models\OutboundpoModel;
use App\Models\ResourceController;
use Config\Services;

class Picking extends BaseController
{
    public function __construct()
    {
        $this->picking = new PickingModel();
        $this->material_detail = new MaterialDetailModel();
        $this->outboundpo = new OutboundpoModel();

        helper(['form', 'url', 'my']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';

        // special module for warehouse
        if(session()->get('user_type')==1) return redirect()->to(base_url('cannot_access'));

    }

    public function index(){
        $data = [
            'title' => 'Picking',
            'title_menu' => 'Picking',
            'sidebar' => 'Picking plan'
        ];	

        // custom JS
        $data["js"] = "picking_list.js";

		echo view('layout/header', $data);
		echo view('outbound/picking_list', $data);
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

        $totalData = $this->picking->all_po_outbound_count_bystatus("1");
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $picking = $this->picking->all_po_outbound_bystatus($limit, $start, $order, $dir, "1");
        } else {
            $search = $this->request->getPost('search')['value']; 
            $picking = $this->picking->search_po_outbound_bystatus($limit, $start, $search, $order, $dir, "1");
            $totalFiltered = $this->picking->search_po_outbound_count_bystatus($search, "1");
        }

        $data = array();
        if(@$picking) {
            foreach ($picking as $row) {
                $start++;
       
                $outbound_status = '<span class="label label-light-success label-pill label-inline mr-2">New</span>';
                $outbound_action = '<a href="'. base_url('picking/addedit/'.$row->po_outbound_id).'" title="Add/Edit picking" class="btn btn-sm btn-clean btn-icon mr-1" title="Edit"><span class="svg-icon svg-icon-warning svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"></rect>
                    <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>
                    <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                </g>
                </svg></span></a>';

                if ($row->picking_status=='1') {
                    $outbound_action .= ' | <a href="'. base_url('picking/print/'.$row->po_outbound_id).'" target="_blank" title="Print picking" class="btn btn-sm btn-clean btn-icon mr-1" title="Print"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M16,17 L16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 L8,17 L5,17 C3.8954305,17 3,16.1045695 3,15 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,15 C21,16.1045695 20.1045695,17 19,17 L16,17 Z M17.5,11 C18.3284271,11 19,10.3284271 19,9.5 C19,8.67157288 18.3284271,8 17.5,8 C16.6715729,8 16,8.67157288 16,9.5 C16,10.3284271 16.6715729,11 17.5,11 Z M10,14 L10,20 L14,20 L14,14 L10,14 Z" fill="#000000"></path>
                        <rect fill="#000000" opacity="0.3" x="8" y="2" width="8" height="2" rx="1"></rect>
                    </g>
                    </svg></span>
                    </a>';

                    $outbound_action .= ' | <a class="complete-picking" onclick="initBtnCompletePicking(this);" data-id_po="'.$row->po_outbound_id.'" title="Complete picking" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"></path>
                        <path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" fill="#000000"></path>
                        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"></path>
                    </g>
                    </svg></span></a>';

                    $outbound_status = '<span class="label label-light-warning label-pill label-inline mr-2">In Progress</span>';
                }


    

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

    public function addedit($po_id="")
	{
		$data = [
            'title' => 'Picking',
            'title_menu' => 'Picking',
            'sidebar' => 'Picking'
        ];	
        $outboundpo = $this->outboundpo->get_outbound_byid_v2($po_id);
        if(empty($outboundpo)) return redirect()->to(base_url('picking'));

        $material_ref = $this->picking->referensi_matrial_location( $outboundpo->owners_id, $outboundpo->warehouse_id, $po_id);
        if ( $outboundpo->picking_status=="1")
            $material_ref = $this->picking->get_data_detail_picking( $outboundpo->owners_id, $outboundpo->warehouse_id, $po_id);
        $data_ref = array();
        $reqQty = array();
        foreach ($material_ref as $key => $value) {
            if(!isset($reqQty[$value->material_id])) $reqQty[$value->material_id] = $value->qty_request;
            if($reqQty[$value->material_id]>0) {
                if($value->stock<=$reqQty[$value->material_id]) {
                    $value->qty_realisasi = $value->stock;
                    $reqQty[$value->material_id] = $reqQty[$value->material_id] - $value->qty_realisasi;
                } else {
                    $value->qty_realisasi = $reqQty[$value->material_id];
                    $reqQty[$value->material_id] = $reqQty[$value->material_id] - $value->qty_realisasi;
                }
                if ( $outboundpo->picking_status=="1") {
                    $value->qty_realisasi = $value->qty;
                }
                array_push($data_ref, $value);
            }
            
        }

        // pake data lama
        $detail_po = $this->outboundpo->get_outbound_detail($po_id);
        $allow_mat = array();
        foreach ($detail_po as $key => $value) {
            array_push($allow_mat, $value->material_id);
        }
        $material = $this->material_detail->get_all_material_byowner_v2($outboundpo->owners_id, $outboundpo->warehouse_id, $allow_mat);

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'outboundpo' => $outboundpo,
            'material' => $material,
            'material_ref' => $data_ref,
            'detail_po' => $detail_po,
		];

        // custom JS
        $data["js"] = "picking.js";

		echo view('layout/header', $data);
		echo view('outbound/addedit_picking', $dataObject);
		echo view('layout/footer_v2', $data);
	}

    function get_qty_bylocation(){
        $owner_id = $this->request->getPost('owner_id');
        $warehouse_id = $this->request->getPost('warehouse_id');
        $material_id = $this->request->getPost('material_id');
        $location_id = $this->request->getPost('location_id');
        $po_id = $this->request->getPost('po_id');
        $data = $this->picking->referensi_matrial_by_location($owner_id, $warehouse_id, $po_id, $material_id, $location_id);
        echo json_encode($data);
    }

    public function save() {
        if (!$this->request->isAJAX()) {
            exit('No direct script access allowed');
        } else {
            $err_msg    = '';
            $post       = array('po_id','po_outbound_id','po_det_outbound_id','location_id','mat_detail_id','material_id','shelf_id','qty_request','stock','qty');
            $data = array();
            foreach($post as $key=>$val) {
                $$val       = $this->request->getPost($val) == false ? '' : $this->request->getPost($val);
                $data[$val] = $$val;
            }

            $data['picking_status'] = 1; // 1. inprogress, 2 Done

            // check POI
            $outboundpo = $this->outboundpo->get_outbound_byid_v2($data['po_id']);
            if(empty($outboundpo)) $err_msg =  "Outbound ID not found.<br/>";

            // get Data detail 
            $dataDetail = array();
            for($i=0; $i<sizeof($data['location_id']); $i++) {
                if(!isset($dataDetail[$data['material_id'][$i]])) {
                    $dataDetail[$data['material_id'][$i]] = array();
                    $dataDetail[$data['material_id'][$i]]['qty'] = intval($data['qty'][$i]);
                } else {
                    $qty = $dataDetail[$data['material_id'][$i]]['qty'];
                    $dataDetail[$data['material_id'][$i]]['qty'] = intval($qty) + intval($data['qty'][$i]);
                }
            }

            // check PO detail VS data detail 
            $detail_po = $this->outboundpo->get_outbound_detail($po_id);
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

            $result = $this->picking->save_data($data, $data['po_id']);
            if($result) {
                if(empty($idEdit)){
                    $msg = 'Insert success';
                }else{
                    $msg = 'Update success';
                }
                return $this->response->setJSON([
                    'code'  => 200,
                    'msg'   => $msg,
                    'data'  => ""
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

    public function print($po_id="") {
        $data = [
            'title' => 'Picking',
            'title_menu' => 'Picking',
            'sidebar' => 'Picking'
        ];	
        $outboundpo = $this->outboundpo->get_outbound_byid_v2($po_id);
        if(empty($outboundpo)) return redirect()->to(base_url('picking'));

        $material_ref = $this->picking->get_data_detail_picking( $outboundpo->owners_id, $outboundpo->warehouse_id, $po_id);
        $data_ref = array();
        $reqQty = array();
        foreach ($material_ref as $key => $value) {
            if(!isset($reqQty[$value->material_id])) $reqQty[$value->material_id] = $value->qty_request;
            if($reqQty[$value->material_id]>0) {
                if($value->stock<=$reqQty[$value->material_id]) {
                    $value->qty_realisasi = $value->stock;
                    $reqQty[$value->material_id] = $reqQty[$value->material_id] - $value->qty_realisasi;
                } else {
                    $value->qty_realisasi = $reqQty[$value->material_id];
                    $reqQty[$value->material_id] = $reqQty[$value->material_id] - $value->qty_realisasi;
                }
                if ( $outboundpo->picking_status=="1") {
                    $value->qty_realisasi = $value->qty;
                }
                array_push($data_ref, $value);
            }
            
        }

		$dataObject = [
            'outboundpo' => $outboundpo,
            'material_ref' => $data_ref
        ];
       
        echo view('outbound/picking_print', $dataObject);
    }

    public function completed() {
        if (!$this->request->isAJAX()) {
            exit('No direct script access allowed');
        } else {
            $err_msg    = '';
            $post       = array('po_id');
            $data = array();
            foreach($post as $key=>$val) {
                $$val       = $this->request->getPost($val) == false ? '' : $this->request->getPost($val);
                $data[$val] = $$val;
            }

            $data['picking_status'] = 2; // 1. inprogress, 2 Done

            // check POI
            $outboundpo = $this->outboundpo->get_outbound_byid_v2($data['po_id']);
            if(empty($outboundpo)) $err_msg =  "Outbound ID not found.<br/>";

            if (!empty($err_msg)) {
                return $this->response->setJSON([
                    'code'  => 204,
                    'msg'   => $err_msg,
                    'data'  => ""
                ]);
            }

            $result = $this->picking->complete_data($data, $data['po_id']);
            if($result) {
                $msg = 'Completed picking success';
                return $this->response->setJSON([
                    'code'  => 200,
                    'msg'   => $msg,
                    'data'  => ""
                ]);

            }else{
                $msg = 'Completed picking failed';
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