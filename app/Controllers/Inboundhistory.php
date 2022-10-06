<?php

namespace App\Controllers;
use App\Models\MaterialModel;
use App\Models\SupplierModel;
use App\Models\OwnersModel;
use App\Models\WarehouseModel;
use App\Models\InboundModel;
use App\Models\InboundDetailModel;
use App\Models\MaterialDetailModel;
use App\Models\PurchaseOrderModel;
use App\Models\PoDetailModel;
use Config\Services;

class Inboundhistory extends BaseController
{
    public function __construct()
    {
        $this->material = new MaterialModel();
        $this->supplier = new SupplierModel();
        $this->owner = new OwnersModel();
        $this->warehouse = new WarehouseModel();
        $this->purchase_order = new PurchaseOrderModel();
        $this->po_detail = new PoDetailModel();
        $this->inbound = new InboundModel();
        $this->inbound_detail = new InboundDetailModel();
        $this->material_detail = new MaterialDetailModel();

        helper(['form', 'url', 'my']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index(){
        $data = [
            'title' => 'Inboundhistory',
            'title_menu' => 'Inbound History',
            'sidebar' => 'Inbound'
        ];	

		echo view('layout/header', $data);
		echo view('inbound/history_data', $data);
		echo view('layout/footer');
    }

    public function getData(){

        $columns = array( 
            0 => 'inbound.inbound_id',
            1 => 'inbound.inbound_id',
            2 => 'inbound.create_date',
            3 => 'supplier.supplier_name',
            4 => 'warehouse.wh_name',
            5 => 'inbound.inbound_id',
            6 => 'inbound.inbound_id',
            7 => 'purchase_order.due_date',
            8 => 'inbound.status'
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        $totalData = $this->inbound->all_inbound_count_bystatus("2", "3");
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $inbound = $this->inbound->all_inbound_bystatus($limit, $start, $order, $dir, "2", "3");
        } else {
            $search = $this->request->getPost('search')['value']; 
            $inbound = $this->inbound->search_inbound_bystatus($limit, $start, $search, $order, $dir, "2", "3");
            $totalFiltered = $this->inbound->search_inbound_count_bystatus($search, "2", "3");
        }

        $data = array();
        if(@$inbound) {
            foreach ($inbound as $row) {
                $start++;

                if(@$row->status == 1) {
                    $inbound_status = '<span class="label label-light-success label-pill label-inline mr-2">Plan</span>';
                } else if(@$row->status == 2)  { 
                    $inbound_status = '<span class="label label-light-danger label-pill label-inline mr-2">Staging</span>';
                } else if(@$row->status == 3)  { 
                    $inbound_status = '<span class="label label-light-danger label-pill label-inline mr-2">Put Away</span>';
                }

                $material_detail = $this->inbound->get_inbound_detail($row->inbound_id);
                $poIdDet = array();
                foreach($material_detail as $mat){
                    if(!isset($poIdDet[$mat->po_detail_id])) {
                        $poIdDet[$mat->po_detail_id] = array(
                                                            "name"=>$mat->material_name, 
                                                            "qty"=>$mat->qty, 
                                                            "uom"=>$mat->uom_name
                                                        );
                    }
                }

                $arrayMaterial = [];
                foreach ($poIdDet as $value) {
                    $dataMat = '<li>' . $value['name'] . ', '.$value['qty'].' ' . $value['uom'] . '</li>';
                    array_push($arrayMaterial, $dataMat);
                }
                $inbound_mat = join("", $arrayMaterial);

                // $arrayMaterial = [];

                // foreach($material_detail as $mat){
                //     $dataMat = '<li>' . $mat->material_name . ', '.$mat->qty.' ' . $mat->uom_name . '</li>';
                //     array_push($arrayMaterial, $dataMat);
                // }
                // $inbound_mat = join("", $arrayMaterial);
                $arrayDetail = [];

                foreach($material_detail as $det){
                    $dataDet = '<li>' . $det->material_name . ', '.$det->qty_realization.' ' . $det->uom_name . '</li>';
                    // $dataDet = '<li>' . $det->material_name . ', '.$det->qty_realization.' ' . $det->uom_name . '<br/>(Batch: '. $det->batch_no.' - Exp. '.date("d-m-Y",strtotime($det->expired_date)).'), </li>';
                    array_push($arrayDetail, $dataDet);
                }
                $inbound_det = join("", $arrayDetail);


                $nestedData['number'] = $start;
                $nestedData['action'] = '<a href="'. base_url('inboundhistory/detail_v2/'.$row->inbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<rect x="0" y="0" width="24" height="24"/>
					<path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
					<path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
				</g>
				</svg></span>
                </a>
                <a href="'. base_url('inboundhistory/print_inbound_bast_v2/'.$row->inbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Print"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <path d="M16,17 L16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 L8,17 L5,17 C3.8954305,17 3,16.1045695 3,15 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,15 C21,16.1045695 20.1045695,17 19,17 L16,17 Z M17.5,11 C18.3284271,11 19,10.3284271 19,9.5 C19,8.67157288 18.3284271,8 17.5,8 C16.6715729,8 16,8.67157288 16,9.5 C16,10.3284271 16.6715729,11 17.5,11 Z M10,14 L10,20 L14,20 L14,14 L10,14 Z" fill="#000000"/>
                    <rect fill="#000000" opacity="0.3" x="8" y="2" width="8" height="2" rx="1"/>
                </g>
				</svg></span>
                </a>';
                $nestedData['status'] = $inbound_status;
                $nestedData['inbound_id'] = @$row->inbound_id;
                $nestedData['inbound_date'] = date('d-m-Y', strtotime(@$row->create_date));
                $nestedData['warehouse_name'] = @$row->wh_name;
                $nestedData['material_name'] = $inbound_mat;
                $nestedData['realization'] = @$inbound_det;
                $nestedData['due_date'] = date('d-m-Y', strtotime(@$row->due_date));
                
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
		$fields = array('inbound_id', 'inbound_date', 'warehouse_name', 'material_name', 'realization', 'due_date');
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
			'className' => 'text-center text-nowrap'
		);
       
		foreach ($fields as $field) {
			$columns[] = array(
				'data' => $field,
                'className' => 'text-nowrap'
			);
		}
		echo json_encode($columns); 
	}

    public function detail($id)
	{
		$data = [
            'title' => 'Inboundhistory',
            'title_menu' => 'Inbound',
            'sidebar' => 'Inbound'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'data_inbound' => $this->inbound->get_inbound_byid($id),
            'inbound_detail' => $this->inbound->get_inbound_detail($id)
		];

		echo view('layout/header', $data);
		echo view('inbound/detail_history', $dataObject);
		echo view('layout/footer');
	}

    public function detail_v2($id)
	{
		$data = [
            'title' => 'Inboundhistory',
            'title_menu' => 'Inbound',
            'sidebar' => 'Inbound'
        ];	

        // group By PO_DETAIL
        $inbound_detail = $this->inbound->get_inbound_detail($id);
        $inDet = array();
        foreach ($inbound_detail as $value) {
            if(!isset($inDet[$value->po_detail_id])) {
                $inDet[$value->po_detail_id] = array(
                    "name"=>$value->material_name,
                    "qty"=>$value->qty,
                    "qty_real"=>0,
                    "qty_good"=>0,
                    "qty_not_good"=>0,
                    "uom"=>$value->uom_name,
                    "detail"=>array()
                );
            } 
            $inDet[$value->po_detail_id]["qty_real"] += $value->qty_realization;
            $inDet[$value->po_detail_id]["qty_good"] += $value->qty_good_in;
            $inDet[$value->po_detail_id]["qty_not_good"] += $value->qty_notgood_in;
            array_push($inDet[$value->po_detail_id]['detail'],$value);
        }


		$dataObject = [
			'validation' => \Config\Services::validation(),
            'data_inbound' => $this->inbound->get_inbound_byid($id),
            'inbound_detail' => $inDet
		];

		echo view('layout/header', $data);
		echo view('inbound/detail_history_v2', $dataObject);
		echo view('layout/footer_v2');
	}

    public function print_inbound_bast_v2($id)
    {
        $data = [
            'title' => 'Inboundhistory',
            'title_menu' => 'Inbound',
            'sidebar' => 'Inbound'
        ];	

        $cond = "WHERE ib.inbound_id = '$id'";
        $cond2 = "WHERE ibd.inbound_id = '$id'";

        $detailIn = $this->inbound->print_history_detail($cond2);
        $inDet = array();
        foreach ($detailIn as $value) {
            if(!isset($inDet[$value->po_detail_id])) {
                $inDet[$value->po_detail_id] = array(
                    "name"=>$value->nama_produk,
                    "detail"=>array(),
                    "location" => $this->inbound->get_shelf_byid($value->shelf_id)
                );
            } 
            array_push($inDet[$value->po_detail_id]['detail'],$value);
        }

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'data_inbound' => $this->inbound->print_history($cond),
            'inbound_detail' => $inDet
		];

		echo view('inbound/print_bast_v2', $dataObject);
    }

    public function print_inbound_bast($id)
    {
        $data = [
            'title' => 'Inboundhistory',
            'title_menu' => 'Inbound',
            'sidebar' => 'Inbound'
        ];	

        $cond = "WHERE ib.inbound_id = '$id'";
        $cond2 = "WHERE ibd.inbound_id = '$id'";
		$dataObject = [
			'validation' => \Config\Services::validation(),
            'data_inbound' => $this->inbound->print_history($cond),
            'inbound_detail' => $this->inbound->print_history_detail($cond2)
		];
        // print_r($this->inbound->print_history($cond));
        // die;
		echo view('inbound/print_bast', $dataObject);
    }

    public function print_inbound_manifest($id)
    {
        $data = [
            'title' => 'Inboundhistory',
            'title_menu' => 'Inbound',
            'sidebar' => 'Inbound'
        ];	

        $cond = "WHERE ib.inbound_id = '$id'";
        $cond2 = "WHERE ibd.inbound_id = '$id'";
		$dataObject = [
			'validation' => \Config\Services::validation(),
            'data_inbound' => $this->inbound->print_history($cond),
            'inbound_detail' => $this->inbound->print_inbound_detail($cond2)
		];
        // print_r($this->inbound->print_history($cond));
        // die;
		echo view('inbound/print_manifest', $dataObject);
    }
    
    public function print_inbound_barcode($id){
        $data = [
            'title' => 'Inboundhistory',
            'title_menu' => 'Inbound',
            'sidebar' => 'Inbound'
        ];

        $dataObject = [
			'validation' => \Config\Services::validation(),    
            'inbound_detail' => $this->inbound->get_inbound_detail($id)
		];

        echo view('inbound/print_barcode', $dataObject);
    }
}
?>