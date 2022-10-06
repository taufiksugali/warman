<?php

namespace App\Controllers;
use App\Models\MaterialModel;
use App\Models\MaterialDetailModel;
use App\Models\CustomerModel;
use App\Models\WarehouseModel;
use App\Models\OwnersModel;
use App\Models\BillModel;
use App\Models\OutboundModel;
use App\Models\OutboundpoModel;
use App\Models\OutboundDetailModel;
use App\Models\LocationModel;
use App\Models\ShelfModel;
use App\Models\MaterialSohModel;
use App\Models\PackagingMaterialModel;
use App\Models\OutboundPackageModel;
use App\Models\SohTotalModel;
use Config\Services;

class Outbound extends BaseController
{
    public function __construct()
    {
        $this->material = new MaterialModel();
        $this->material_detail = new MaterialDetailModel();
        $this->customer = new CustomerModel();
        $this->warehouse = new WarehouseModel();
        $this->outbound = new OutboundModel();
        $this->outboundpo = new OutboundpoModel();
        $this->owner = new OwnersModel();
        $this->bill = new BillModel();
        $this->outbound_detail = new OutboundDetailModel();
        $this->location = new LocationModel();
        $this->shelf = new ShelfModel();
        $this->material_soh = new MaterialSohModel();
        $this->pm = new PackagingMaterialModel();
        $this->packaging = new OutboundPackageModel();
        $this->soh = new SohTotalModel();

        helper(['form', 'url', 'my']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index(){
        $data = [
            'title' => 'Outbound',
            'title_menu' => 'Outbound',
            'sidebar' => 'Outbound Plan'
        ];	

		echo view('layout/header', $data);
		echo view('outbound/outbound_data', $data);
		echo view('layout/footer');
    }

    // public function getData(){

    //     $columns = array( 
    //         0 => 'outbound.outbound_id',
    //         1 => 'outbound.create_date',
    //         2 => 'outbound.outbound_doc',
    //         3 => 'outbound.outbound_doc_date',
    //         4 => 'customer.customer_name',
    //         5 => 'warehouse.wh_name'
    //     );

    //     $limit = $this->request->getPost('length');
    //     $start = $this->request->getPost('start');
    //     $order = $columns[$this->request->getPost('order')[0]['column']];
    //     $dir = $this->request->getPost('order')[0]['dir']; 

    //     $totalData = $this->outbound->all_outbound_count_bystatus("2");
    //     $totalFiltered = $totalData;

    //     if(empty($this->request->getPost('search')['value'])) { 
    //         $outbound = $this->outbound->all_outbound_bystatus($limit, $start, $order, $dir, "2");
    //     } else {
    //         $search = $this->request->getPost('search')['value']; 
    //         $outbound = $this->outbound->search_outbound_bystatus($limit, $start, $search, $order, $dir, "2");
    //         $totalFiltered = $this->outbound->search_outbound_count_bystatus($search, "2");
    //     }

    //     $data = array();
    //     if(@$outbound) {
    //         foreach ($outbound as $row) {
    //             $start++;

    //             if(@$row->status == 1) {
    //                 $outbound_status = '<span class="label label-light-success label-pill label-inline mr-2">New</span>';
    //             } else if(@$row->status == 2)  { 
    //                 $outbound_status = '<span class="label label-light-danger label-pill label-inline mr-2">Packing</span>';
    //             } else if(@$row->status == 3)  { 
    //                 $outbound_status = '<span class="label label-light-danger label-pill label-inline mr-2">Outbound</span>';
    //             }

    //             $material_detail = $this->outbound->get_outbound_detail($row->outbound_id);
    //             $arrayMaterial = [];

    //             foreach($material_detail as $mat){
    //                 $dataMat = '<li>' . $mat->material_name . ', '.$mat->outbound_qty.' ' . $mat->uom_name . '</li>';
    //                 array_push($arrayMaterial, $dataMat);
    //             }
    //             $outbound_mat = join("", $arrayMaterial);

    //             $arrayDetail = [];

    //             foreach($material_detail as $det){
    //                 $dataDet = '<li>' . $det->material_name . ', '.$det->qty_realization.' ' . $det->uom_name . '</li>';
    //                 array_push($arrayDetail, $dataDet);
    //             }
    //             $outbound_det = join("", $arrayDetail);

    //             $nestedData['number'] = $start;
    //             $nestedData['outbound_id'] = @$row->outbound_id;
    //             $nestedData['outbound_doc'] = @$row->outbound_doc;
    //             $nestedData['outbound_date'] = date('d-m-Y', strtotime(@$row->create_date));
    //             $nestedData['customer_name'] = @$row->customer_name;
    //             $nestedData['warehouse_name'] = @$row->wh_name;
    //             $nestedData['material_name'] = $outbound_mat;
    //             // $nestedData['realization'] = @$outbound_det;
    //             $nestedData['status'] = $outbound_status;
    //             $nestedData['action'] = '<a href="'. base_url('outbound/detail/'.$row->outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
	// 			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
	// 				<rect x="0" y="0" width="24" height="24"/>
	// 				<path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
	// 				<path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
	// 			</g>
	// 			</svg></span></a>';
    //             // <button class="btn btn-sm btn-clean btn-icon mr-1" id="delete_outbound" data-id="'.@$row->outbound_id.'" title="Delete"><span class="svg-icon svg-icon-danger svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    //             // <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
    //             //     <rect x="0" y="0" width="24" height="24"/>
    //             //     <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
    //             //     <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
    //             // </g>
    //             // </svg></span></button>';
                
    //             $data[] = $nestedData;
    //         }
    //     }
          
    //     $json_data = array(
    //                 "draw"            => intval($this->request->getPost('draw')),  
    //                 "recordsTotal"    => intval($totalData),  
    //                 "recordsFiltered" => intval($totalFiltered), 
    //                 "data"            => $data
    //             );
            
    //     echo json_encode($json_data);
    // }

    // public function getColumns()
	// {
	// 	$fields = array('outbound_id', 'outbound_date', 'customer_name', 'warehouse_name', 'material_name');
	// 	$columns[] = array(
	// 		'data' => 'number',
	// 		'className' => 'text-center'
	// 	);
    //     $columns[] = array(
    //         'data' => 'action',
    //         'className' => 'text-center text-nowrap'
    //     );
    //     $columns[] = array(
    //         'data' => 'status',
    //         'className' => 'text-center'
    //     );
	// 	foreach ($fields as $field) {
	// 		$columns[] = array(
	// 			'data' => $field,
    //             'className' => 'text-nowrap'
	// 		);
	// 	}
	// 	echo json_encode($columns); 
	// }

    public function getData(){

        $columns = array( 
            0 => 'po_outbound.po_outbound_id',
            1 => 'po_outbound.po_outbound_id',
            2 => 'po_outbound.po_outbound_id',
            3 => 'po_outbound.po_outbound_id',
            4 => 'po_outbound.po_create_date',
            5 => 'customer.customer_name',
            6 => 'warehouse.wh_name'
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        $totalData = $this->outbound->all_po_outbound_count_bystatus("1");
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $outbound = $this->outbound->all_po_outbound_bystatus($limit, $start, $order, $dir, "1");
        } else {
            $search = $this->request->getPost('search')['value']; 
            $outbound = $this->outbound->search_po_outbound_bystatus($limit, $start, $search, $order, $dir, "1");
            $totalFiltered = $this->outbound->search_po_outbound_count_bystatus($search, "1");
        }

        $data = array();
        if(@$outbound) {
            foreach ($outbound as $row) {
                $start++;
                if(session()->get('user_type')==1){
                    if(@$row->po_out_status == 1) {
                        $outbound_status = '<span class="label label-light-danger label-pill label-inline mr-2">New</span>';
                        $outbound_action = '<a href="'. base_url('outboundpo/detail/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                        </g>
                        </svg></span></a>
                        <button class="btn btn-sm btn-clean btn-icon mr-1" id="delete_outboundpo" data-id="'.@$row->po_outbound_id.'" title="Delete"><span class="svg-icon svg-icon-danger svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                            <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                        </g>
                        </svg></span></button>';
                    } 
                } else {
                    if(@$row->po_out_status == 1) {
                        $outbound_status = '<span class="label label-light-success label-pill label-inline mr-2">New</span>';
                        $outbound_action = '<a href="'. base_url('outbound/add_ver2/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M20.4061385,6.73606154 C20.7672665,6.89656288 21,7.25468437 21,7.64987309 L21,16.4115967 C21,16.7747638 20.8031081,17.1093844 20.4856429,17.2857539 L12.4856429,21.7301984 C12.1836204,21.8979887 11.8163796,21.8979887 11.5143571,21.7301984 L3.51435707,17.2857539 C3.19689188,17.1093844 3,16.7747638 3,16.4115967 L3,7.64987309 C3,7.25468437 3.23273352,6.89656288 3.59386153,6.73606154 L11.5938615,3.18050598 C11.8524269,3.06558805 12.1475731,3.06558805 12.4061385,3.18050598 L20.4061385,6.73606154 Z" fill="#000000" opacity="0.3"/>
                            <polygon fill="#000000" points="14.9671522 4.22441676 7.5999999 8.31727912 7.5999999 12.9056825 9.5999999 13.9056825 9.5999999 9.49408582 17.25507 5.24126912"/>
                        </g>
                        </svg></span></a>';
                    } 
                }

                $material_detail = $this->outbound->get_po_outbound_detail($row->po_outbound_id);
                $arrayMaterial = [];

                foreach($material_detail as $mat){
                    $dataMat = '<li>' . $mat->material_name . ', '.$mat->outbound_qty.' ' . $mat->uom_name . '</li>';
                    array_push($arrayMaterial, $dataMat);
                }
                $outbound_mat = join("", $arrayMaterial);

                $arrayDetail = [];

                // foreach($material_detail as $det){
                //     $dataDet = '<li>' . $det->material_name . ', '.$det->qty_realization.' ' . $det->uom_name . '</li>';
                //     array_push($arrayDetail, $dataDet);
                // }
                // $outbound_det = join("", $arrayDetail);

                $nestedData['number'] = $start;
                $nestedData['po_outbound_id'] = @$row->po_outbound_id;
                // $nestedData['po_outbound_doc'] = @$row->po_outbound_doc;
                $nestedData['po_create_date'] = date('d-m-Y', strtotime(@$row->po_create_date));
                $nestedData['customer_name'] = @$row->customer_name;
                // $nestedData['warehouse_name'] = @$row->wh_name;
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
                        // , 'warehouse_name'
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

    public function add()
	{
		$data = [
            'title' => 'Outbound',
            'title_menu' => 'Outbound',
            'sidebar' => 'Outbound'
        ];	

        if($this->request->getPost('po_id')){
            $outbound = $this->outbound->get_outbound($this->request->getPost('po_id'));
        }else{
            $purchase_order = '';
        }

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'warehouse' => $this->warehouse->get_all_warehouse(),
            'outboundpo' => $this->outboundpo->get_all_po(),
            'customer' => $this->customer->get_all_customer(),
            'pm' => $this->pm->get_all_pm(),
            'owner' => $this->owner->get_all_owner()
		];

		echo view('layout/header', $data);
		echo view('outbound/add_outbound_ver2', $dataObject);
		echo view('layout/footer');
	}

    public function add_ver2($po_id)
	{
		$data = [
            'title' => 'Outbound',
            'title_menu' => 'Outbound',
            'sidebar' => 'Outbound'
        ];	
        $outboundpo = $this->outboundpo->get_outbound_byid($po_id);
        $owner_id = $outboundpo->owners_id;
        $warehouse_id = $outboundpo->warehouse_id;
        $detail_po = $this->outboundpo->get_outbound_detail($po_id);
        $allow_mat = array();
        foreach ($detail_po as $key => $value) {
            array_push($allow_mat, $value->material_id);
        }
        $material = $this->material_detail->get_all_material_byowner_v2($owner_id, $warehouse_id, $allow_mat);
        $packing_cost = 0;
        $outbound_package = $this->pm->get_outbound_package($po_id);
        foreach($outbound_package as $op){
            // $charged_rate = $op->pm_rate * $op->pm_qty;
            $packing_cost = $packing_cost + $op->pm_cost;
        }

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'outboundpo' => $this->outboundpo->get_outbound_byid($po_id),
            'outboundpo_detail' => $this->outboundpo->get_outbound_detail($po_id),
            'material' => $material,
            'pm' => $this->pm->get_all_pm(),
            'outbound_package' => $this->pm->get_outbound_package($po_id),
            'packing_cost' => $packing_cost
		];

		echo view('layout/header', $data);
		echo view('outbound/add_outbound_ver3', $dataObject);
		echo view('layout/footer');
	}

    public function create(){
        $data = [
            'title' => 'Outbound',
            'sidebar' => 'Outbound'
        ];

        $validate = $this->validate([
            'po_outbound_id'    => ['label' => 'Request ID', 'rules' => 'required'],
            'warehouse_id'      => ['label' => 'Warehouse', 'rules' => 'required'],
            'customer_id'       => ['label' => 'Customer Name', 'rules' => 'required'],
            'owner_id'          => ['label' => 'Owner Name', 'rules' => 'required'],
            'material_id.*'     => ['label' => 'Product', 'rules' => 'required'],
            'location.*'        => ['label' => 'Product', 'rules' => 'required'],
            'quantity.*'        => ['label' => 'Quantity', 'rules' => 'required']
        ]);

        if (!$validate) {
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Something is missing. Please complete the data</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
            return redirect()->to(base_url('/outbound/add'))->withInput();
        } else{
            $dataPODetail_ = $this->outboundpo->get_outbound_detail($this->request->getPost('po_outbound_id'));
            $dataPODetArray = array();
            foreach ($dataPODetail_ as $key => $value) {
                if (!isset($dataPODetArray[$value->material_id])) {
                    $dataPODetArray[$value->material_id] = intval($value->outbound_qty);
                } else {
                    $dataPODetArray[$value->material_id] = $dataPODetArray[$value->material_id] + intval($value->outbound_qty);
                }
            }
            $dataOutDetArray = array();
            for ($i=0; $i < count($this->request->getPost('material_id')); $i++) { 
                $id_ = $this->request->getPost('material_id_master['.$i.']');
                $qty_ = $this->request->getPost('quantity['.$i.']');
                if (!isset($dataOutDetArray[$id_])) {
                    $dataOutDetArray[$id_] = intval($qty_);
                } else {
                    $dataOutDetArray[$id_] = $dataOutDetArray[$id_] + intval($qty_);
                }
            }
            foreach ($dataPODetArray as $key => $value) {
                if(!isset($dataOutDetArray[$key]) || (isset($dataOutDetArray[$key]) && $dataPODetArray[$key]!=$dataOutDetArray[$key])) {
                    session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">The quantity requested is not appropriate</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
                    return redirect()->to(base_url('/outbound/add'))->withInput();
                } 

            }

            $id = $this->outbound->generate_id();

            $data_outbound = [
                'outbound_id' => $id,
                'po_outbound_id' => $this->request->getPost('po_outbound_id'),
                // 'outbound_doc_date' => date_format(date_create($this->request->getPost('doc_date')), 'Y-m-d'),
                'out_date' => date_format(date_create($this->request->getPost('out_date')), 'Y-m-d'),
                // 'outbound_doc' => $this->request->getPost('doc_number'),
                'description' => $this->request->getPost('description'),
                'penerima' => $this->request->getPost('customer_id'),
                'outbound_wh_asal' => $this->request->getPost('warehouse_id'),
                'outbound_type' => 'TY003',
                'status' => 7,
                'create_date' => date('Y-m-d H:i:s'),
                'create_by' => session()->get('fullname'),
                'outbound_transpoter' => $this->request->getPost('outbound_transpoter'),
                'license_plate' => $this->request->getPost('lic_plate'),
                'outbound_driver' => $this->request->getPost('outbound_driver'),
            ];
            $this->outbound->insert_data($data_outbound);

            $id_po = $this->request->getPost('po_outbound_id');
            $data_po = [
                'po_out_status' => 2
            ];

            $this->outboundpo->update_data($id_po, $data_po);

            if(@$this->request->getPost('material_id')){
                $i=0;
                foreach($this->request->getPost('material_id') as $row){
                    $detil_id = $this->outbound_detail->generate_id();
                    $data_outbound_detail = [
                        'det_outbound_id' => $detil_id,
                        'outbound_id' => $data_outbound['outbound_id'],
                        'material_detail_id' => $row,
                        'outbound_qty' => $this->request->getPost('quantity['.$i.']'),
                        'qty_realization' => $this->request->getPost('quantity['.$i.']'),
                        'location_id' => $this->request->getPost('location['.$i.']'),
                        'status' => 2
                    ];


                    $this->outbound_detail->insert_data($data_outbound_detail);

                    $current_stock = $this->material_soh->get_currrent_stock($row)->stock_ok; //perlu diperiksa.
                    $new_stock = $current_stock - $data_outbound_detail['qty_realization']; //sepertinya perlu diganti
                    $mat_soh = [
                        'stock_ok' => $new_stock,
                        'status' => 1
                    ];

                    $this->material_soh->update_byid($row, $mat_soh);

                    $location_id = $this->request->getPost('location['.$i.']');
                    $current_qty = $this->location->get_location_byid($location_id)->qty;
                    $new_qty = $current_qty - $data_outbound_detail['qty_realization'];
                    $mat_location = [
                        'qty' => $new_qty
                    ];
                    $this->location->update_data($location_id, $mat_location);

                    $shelf_avail = $this->location->check_material_detail_on_shelfv2($location_id)->shelf_availability;
                    $shelf_id = $this->location->check_material_detail_on_shelfv2($location_id)->shelf_id;
                    $cur_avail = $shelf_avail + $data_outbound_detail['qty_realization'];
                    
                    $data_shelf_tujuan = [
                        'shelf_availability' => $cur_avail
                    ];
                    
                    $this->shelf->update_data($shelf_id, $data_shelf_tujuan);

                    $warehouse_id = $this->request->getPost('warehouse_id');
                    $owner_id = $this->request->getPost('owner_id');
                    $material_id = $this->soh->get_material_id($row)->material_id;
                    
                    $data_soh = $this->soh->get_stock_good_v2($warehouse_id, $owner_id, $material_id);
                    $qty_out = $data_outbound_detail['qty_realization'];
                    foreach ($data_soh as $key_soh => $val_soh) {
                        if ($qty_out>0) {
                            if ($qty_out>$val_soh->stock_good_warehouse) {
                                $qty_out_row = $val_soh->stock_good_warehouse;
                                $soh_tot = [
                                    'stock_good_seller' => $val_soh->stock_good_seller - $qty_out_row,
                                    'stock_good_warehouse' => $val_soh->stock_good_warehouse - $qty_out_row
                                ];
                                $this->soh->update_data($val_soh->sot_id, $soh_tot);
                                $qty_out = $qty_out - $qty_out_row;
                            } else {
                                $qty_out_row = $qty_out;
                                $soh_tot = [
                                    'stock_good_seller' => $val_soh->stock_good_seller - $qty_out_row,
                                    'stock_good_warehouse' => $val_soh->stock_good_warehouse - $qty_out_row
                                ];
                                $this->soh->update_data($val_soh->sot_id, $soh_tot);
                                $qty_out = $qty_out - $qty_out_row;
                            }
                        }
                    }

                    $i++;
                }
            }

            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Outbound successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('outboundhistory'));

        }
    }

    public function detail($id)
	{
		$data = [
            'title' => 'Outbound',
            'title_menu' => 'Outbound',
            'sidebar' => 'Outbound'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'data_outbound' => $this->outbound->get_outbound_byid($id),
            'outbound_detail' => $this->outbound->get_outbound_detail($id)
		];

		echo view('layout/header', $data);
		echo view('outbound/detail', $dataObject);
		echo view('layout/footer');
	}

    public function delete(){
        $id = $this->request->getGet('id');

        $this->bill->delete_by_ref_id($id);
        
        $id_po = $this->outbound->get_outbound_byid($id)->po_outbound_id;
        $data_po = [
            'po_out_status' => 1
        ];

        $this->outboundpo->update_data($id_po, $data_po);

        $result = $this->outbound_detail->delete_data($id);

        $result1 = $this->outbound->delete_data($id);

        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Outbound successfully inactivated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('outbound'));
    }

    function get_material_byowner(){
        $owner_id = $this->request->getPost('owner_id');
        $warehouse_id = $this->request->getPost('warehouse_id');
        $data = $this->material_detail->get_material_byowner($owner_id, $warehouse_id);
        echo json_encode($data);
    }

    function get_location_bymaterial(){
        $owner_id = $this->request->getPost('owner_id');
        $warehouse_id = $this->request->getPost('warehouse_id');
        $material_id = $this->request->getPost('material_id');
        $data = $this->material_detail->get_location_bymaterial($owner_id, $warehouse_id, $material_id);
        echo json_encode($data);
    }

    function get_qty_bylocation(){
        $owner_id = $this->request->getPost('owner_id');
        $warehouse_id = $this->request->getPost('warehouse_id');
        $material_id = $this->request->getPost('material_id');
        $location_id = $this->request->getPost('location_id');
        $data = $this->material_detail->get_qty_bylocation($owner_id, $warehouse_id, $material_id, $location_id);
        echo json_encode($data);
    }
}
?>