<?php

namespace App\Controllers;

use App\Models\BillModel;
use App\Models\MaterialModel;
use App\Models\OwnersModel;
use App\Models\SupplierModel;
use App\Models\WarehouseModel;
use App\Models\PurchaseOrderModel;
use App\Models\PoDetailModel;
use Config\Services;
use PHPExcel;
use PHPExcel_IOFactory;

class Purchaseorder extends BaseController
{
    public function __construct()
    {
        $this->material = new MaterialModel();
        $this->supplier = new SupplierModel();
        $this->purchase_order = new PurchaseOrderModel();
        $this->po_detail = new PoDetailModel();
        $this->warehouse = new WarehouseModel();
        $this->owner = new OwnersModel();
        $this->bill = new BillModel();

        helper(['form', 'url', 'my']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index(){
        $data = [
            'title' => 'Purchaseorder',
            'title_menu' => 'Purchase Order',
            'sidebar' => 'Purchase Order'
        ];	

		echo view('layout/header', $data);
		echo view('purchase_order/po_data', $data);
		echo view('layout/footer');
    }

    public function getData(){

        $columns = array( 
            0 => 'po_id',
            1 => 'supplier.supplier_name',
            2 => 'material.description',
            3 => 'purchase_order.po_number',
            4 => 'purchase_order.po_date',
            5 => 'purchase_order.po_date',
            6 => 'purchase_order.description'
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        $totalData = $this->purchase_order->all_po_count();
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $purchase_order = $this->purchase_order->all_po($limit, $start, $order, $dir);
        } else {
            $search = $this->request->getPost('search')['value']; 
            $purchase_order = $this->purchase_order->search_po($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->purchase_order->search_po_count($search);
        }

        $data = array();
        if(@$purchase_order) {
            foreach ($purchase_order as $row) {
                $start++;

                if(@$row->po_status == 1) {
                    $po_status = '<span class="label label-light-danger label-pill label-inline mr-2">New</span>';
                    $actions = '<a href="'. base_url('purchaseorder/detail/'.$row->po_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                        <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                    </g>
                    </svg></span></a>
                    <button class="btn btn-sm btn-clean btn-icon mr-1" id="delete" data-id="'.@$row->po_id.'" title="Delete"><span class="svg-icon svg-icon-danger svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                        <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                    </g>
                    </svg></span></button>';
                } else if(@$row->po_status == 2){ 
                    $po_status = '<span class="label label-light-danger label-pill label-inline mr-2">Partial</span>';
                    $actions = '<a href="'. base_url('purchaseorder/detail/'.$row->po_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                        <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                    </g>
                    </svg></span></a>';
                } else if(@$row->po_status == 3){
                    $po_status = '<span class="label label-light-dark label-pill label-inline mr-2">Close</span>';
                    $actions = '<a href="'. base_url('purchaseorder/detail/'.$row->po_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                        <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                    </g>
                    </svg></span></a>';
                } else if(@$row->po_status == 0){
                    $po_status = '<span class="label label-light-danger label-pill label-inline mr-2">Rejected</span>';
                    $actions = '<a href="'. base_url('purchaseorder/detail/'.$row->po_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                        <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                    </g>
                    </svg></span></a>';
                }

                $material_detail = $this->purchase_order->get_po_detail($row->po_id);
                $arrayMaterial = [];

                foreach($material_detail as $mat){
                    $dataMat = '<li>' . $mat->material_name . ', '.$mat->qty.' ' . $mat->uom_name . '</li>';
                    array_push($arrayMaterial, $dataMat);
                }
                $po_mat = join("", $arrayMaterial);

                $nestedData['number'] = $start;
                $nestedData['po_number'] = @$row->po_number;
                $nestedData['po_date'] = date('d-m-Y', strtotime(@$row->po_date));
                $nestedData['material_name'] = $po_mat;
                $nestedData['description'] = @$row->description;
                $nestedData['status'] = $po_status;
                $nestedData['action'] = $actions;
                
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
		$fields = array('po_number', 'po_date', 'material_name');
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
        $columns[]['data'] = 'description';
		echo json_encode($columns); 
	}

    public function add()
	{
		$data = [
            'title' => 'Purchaseorder',
            'title_menu' => 'Purchase Order',
            'sidebar' => 'Purchase Order'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'material' => $this->material->get_all_material(),
            'supplier' => $this->supplier->get_all_supplier(),
            'warehouse' => $this->warehouse->get_all_warehouse()
		];
        $material = $this->material->get_all_material();

        if($material == null){
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-warning fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Product data is empty. Click <a href="'.base_url('/material').'">Here</a> to add new Product</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
        }

		echo view('layout/header', $data);
		echo view('purchase_order/add_po', $dataObject);
		echo view('layout/footer');
	}

    public function bulk_upload(){
        $file = $this->request->getFile('fileexcel');
        
		if($file){
            $data_po = array();
            $data_po_detail = array();
			$excelReader  = new PHPExcel();
			//mengambil lokasi temp file
			$fileLocation = $file->getTempName(); // edit disini biar hilang
			//baca file
			$objPHPExcel = PHPExcel_IOFactory::load($fileLocation);
            // unlink($fileLocation);
			//ambil sheet active
			$sheet	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			//looping untuk mengambil data
			foreach ($sheet as $idx => $data) {
				//skip index 1 karena title excel
                if($idx<=10){
                    continue;
                }
                
                if(!empty($data['A'])){
                    $warehouse = @$this->warehouse->get_warehouse_bycode($data['A'])->warehouse_id;
                    $po_id = $this->purchase_order->generate_id();
                    if($data['F'] == 'YES'){
                        $qc_status = 1;
                    } else {
                        $qc_status = 0;
                    }
                    $data_po[] = array(
                        'po_id' => $po_id,
                        'warehouse_code' => $data['A'],
                        'warehouse_id' => $warehouse,
                        'po_number' => $data['B'],
                        'po_date' => date_format(date_create($data['C']), 'Y-m-d'),
                        'due_date' => date_format(date_create($data['D']), 'Y-m-d'),
                        'description' => $data['E'],
                        'qc_status' => $qc_status,
                        'create_date' => date('Y-m-d H:i:s'),
                        'create_by' => session()->get('fullname')
                    );
    
                    // $this->purchase_order->insert_data($data_po);
                } else {
                    $data_po[] = array(
                        'po_id' => 'PO_DETAIL',
                        'warehouse_code' => 'PO_DETAIL',
                        'warehouse_id' => 'PO_DETAIL',
                        'po_number' => 'PO_DETAIL',
                        'po_date' => 'PO_DETAIL',
                        'due_date' => 'PO_DETAIL',
                        'description' => 'PO_DETAIL',
                        'qc_status' => 'PO_DETAIL',
                        'create_date' => 'PO_DETAIL',
                        'create_by' => 'PO_DETAIL'
                    );
                }
    
                $detil_id = $this->po_detail->generate_id();
                $price = str_replace(",", "", $data['H']);
                $qty = str_replace(",", "", $data['I']);
                $data_po_detail[] = array(
                    'po_detail_id' => $detil_id,
                    'po_id' => $po_id,
                    'material_id' => $data['G'],
                    'material_price' => $price,
                    'status' => 1,
                    'qty' => $qty
                );
			}
            $data = [
                'title' => 'Inbound Request',
                'title_menu' => 'Bulk Add Inbound Request',
                'sidebar' => 'Inbound Request'
            ];
            $dataObject = [
                'validation' => \Config\Services::validation(),
                'data_po' => $data_po,
                'data_po_detail' => $data_po_detail,
                'import' => 1
            ];
            clearstatcache();
            echo view('layout/header', $data);
            echo view('purchase_order/bulk_upload', $dataObject);
            echo view('layout/footer');
		} else {
            $data = [
                'title' => 'Inbound Request',
                'title_menu' => 'Bulk Add Inbound Request',
                'sidebar' => 'Inbound Request'
            ];	

            $dataObject = [
                'validation' => \Config\Services::validation(),
                'import' => 0
            ];
            echo view('layout/header', $data);
            echo view('purchase_order/bulk_upload', $dataObject);
            echo view('layout/footer');
        }
    }

    public function bulk_create(){
        
        $validation = $this->validate([
            'po.*.warehouse_id'     => ['label' => 'Warehouse Code', 'rules' => 'required'],
            'po.*.po_number'        => ['label' => 'PO Number', 'rules' => 'required'],
            'po.*.po_date'          => ['label' => 'PO Date', 'rules' => 'required'],
            'po.*.due_date'         => ['label' => 'Due Date', 'rules' => 'required'],
            // 'po.*.description'      => ['label' => 'Description', 'rules' => 'required'],
            'po.*.qc_status'        => ['label' => 'QC', 'rules' => 'required']
        ]);
        if(!$validation){
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-warning fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">The Excel file you uploaded contains some errors.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
            return redirect()->to(base_url('purchaseorder/bulk_upload'));
        }else{
            $po_id ="";
            $po_id2 = "";
            $i=0;
            // var_dump($this->request->getPost('po')); die;
            $po_detail = $this->request->getPost('po_detail');
            foreach ($this->request->getPost('po') as $row) {
                if($row['warehouse_id'] != 'PO_DETAIL'){
                    if($i == 0){
                        $po_id2 = $po_id2;
                    } elseif($po_id2 != $po_id){
                        
                    }
                    $po_id = $this->purchase_order->generate_id();
                    $data_po = [
                        'po_id' => $po_id,
                        'owners_id' => session()->get('owners_id'),
                        'warehouse_id' => $row['warehouse_id'],
                        'user_id' => session()->get('user_id'),
                        'po_number' => $row['po_number'],
                        'po_date' => date_format(date_create($row['po_date']), 'Y-m-d'),
                        'due_date' => date_format(date_create($row['due_date']), 'Y-m-d'),
                        'description' => $row['description'],
                        'po_status' => 1,
                        'qc_status' => $row['qc_status'],
                        'create_date' => date('Y-m-d H:i:s'),
                        'create_by' => session()->get('fullname')
                    ];
    
                    $this->purchase_order->insert_data($data_po);
                }
    
                $detil_id = $this->po_detail->generate_id();
                $price = str_replace(",", "", $po_detail[$i]['material_price']);
                $qty = str_replace(",", "", $po_detail[$i]['qty']);
                $data_po_detail = [
                    'po_detail_id' => $detil_id,
                    'po_id' => $po_id,
                    'material_id' => $po_detail[$i]['material_id'],
                    'material_price' => $price,
                    'status' => 1,
                    'qty' => $qty
                ];
    
                $this->po_detail->insert_data($data_po_detail);
                $i++;
            }
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Inbound Requests successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
            return redirect()->to(base_url('purchaseorder'));
        }
    }

    public function create(){
        $data = [
            'title' => 'Purchaseorder',
            'sidebar' => 'Purchase Order'
        ];

        $validate = $this->validate([
            'po_date' => ['label' => 'PO Date', 'rules' => 'required'],
            'po_number' => ['label' => 'PO Number', 'rules' => 'required|alpha_numeric_punct'],
            'warehouse_id' => ['label' => 'Warehouse', 'rules' => 'required']
        ]);

        if (!$validate) {
            return redirect()->to(base_url('/purchaseorder/add'))->withInput();
        } else{
            $confirm_qc = $this->request->getPost('qc_status');
            $id = $this->purchase_order->generate_id();

            $owners_id = session()->get('owners_id');

            $data_po = [
                'po_id' => $id,
                'owners_id' => $this->request->getPost('owners_id'),
                'warehouse_id' => $this->request->getPost('warehouse_id'),
                'user_id' => session()->get('user_id'),
                'po_number' => $this->request->getPost('po_number'),
                'po_date' => date_format(date_create($this->request->getPost('po_date')), 'Y-m-d'),
                'due_date' => date_format(date_create($this->request->getPost('due_date')), 'Y-m-d'),
                'description' => $this->request->getPost('description'),
                'po_status' => 1,
                'qc_status' => $this->request->getPost('qc_status'),
                'create_date' => date('Y-m-d H:i:s'),
                'create_by' => session()->get('fullname')
            ];

            $this->purchase_order->insert_data($data_po);

            $i=0;
            foreach($this->request->getPost('material_id') as $row){
                $detil_id = $this->po_detail->generate_id();
                $price = str_replace(",", "", $this->request->getPost('material_price['.$i.']'));
                $qty = str_replace(",", "", $this->request->getPost('quantity['.$i.']'));
                $data_po_detail = [
                    'po_detail_id' => $detil_id,
                    'po_id' => $data_po['po_id'],
                    'material_id' => $row,
                    'material_price' => $price,
                    'status' => 1,
                    'qty' => $qty
                ];
                $i++;
                $this->po_detail->insert_data($data_po_detail);
            }
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Inbound Request successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('purchaseorder'));
        }
    }

    public function delete(){
        $id = $this->request->getGet('id');

        $owners_id = session()->get('owners_id');
        /* $get_bill = $this->bill->get_bill_byRefid($id);
        if(@$get_bill != null){
            $amount = intval($this->purchase_order->get_bill_byPo($id)->amount);
            $owners_balance = intval($this->owner->get_owner_byid(session()->get('owners_id'))->owners_balance);
    
            $reverse = $owners_balance + $amount;
    
            $data = [
                'owners_balance' => $reverse
            ];
    
            $this->owner->update_data($owners_id, $data);
        } */
        
        $result = $this->po_detail->delete_data($id);

        $result1 = $this->purchase_order->delete_data($id);

        /* $result2 = $this->bill->delete_by_ref_id($id); */

        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Inbound successfully inactivated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('purchaseorder'));
    }

    public function detail($id)
	{
		$data = [
            'title' => 'Purchaseorder',
            'title_menu' => 'Purchase Order',
            'sidebar' => 'Purchase Order'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'data_po' => $this->purchase_order->get_po_byid($id),
            'po_detail' => $this->po_detail->get_po_detail($id)
		];

		echo view('layout/header', $data);
		echo view('purchase_order/detail', $dataObject);
		echo view('layout/footer');
	}

    public function reject(){
        $id = $this->request->getGet('id');

        $data = [
            'po_status' => 0
        ];

        $data_detail = [
            'status' => 0
        ];

        $result = $this->po_detail->update_data($id, $data_detail);

        $result1 = $this->purchase_order->update_data($id, $data);

        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Inbound Request rejected.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('inbound'));
    }

    public function get_price(){
        $post = $this->request->getPost('material_id[]');

        $get_price = intVal($this->material->get_material_byid($post)->material_price);
        
        $arr_data = array(
            'price' => $get_price
        );

        echo json_encode($arr_data, TRUE);
    }
}
?>