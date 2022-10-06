<?php

namespace App\Controllers;
use App\Models\MaterialModel;
use App\Models\SupplierModel;
use App\Models\OwnersModel;
use App\Models\WarehouseModel;
use App\Models\InboundModel;
use App\Models\InboundDetailModel;
use App\Models\MaterialDetailModel;
use App\Models\MaterialSohModel;
use App\Models\PurchaseOrderModel;
use App\Models\PoDetailModel;
use Config\Services;

class Realization extends BaseController
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
        $this->material_soh = new MaterialSohModel();

        helper(['form', 'url', 'my']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index(){
        $data = [
            'title' => 'Inboundrealization',
            'title_menu' => 'Inbound Realization',
            'sidebar' => 'Inbound'
        ];	

		echo view('layout/header', $data);
		echo view('inbound/inbound_realization', $data);
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

        $totalData = $this->inbound->all_inbound_count_bystatus("1", "1");
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $inbound = $this->inbound->all_inbound_bystatus($limit, $start, $order, $dir, "1", "1");
        } else {
            $search = $this->request->getPost('search')['value']; 
            $inbound = $this->inbound->search_inbound_bystatus($limit, $start, $search, $order, $dir, "1", "1");
            $totalFiltered = $this->inbound->search_inbound_count_bystatus($search, "1", "1");
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
                $arrayMaterial = [];

                foreach($material_detail as $mat){
                    $dataMat = '<li>' . $mat->material_name . ', '.$mat->qty.' ' . $mat->uom_name . '</li>';
                    array_push($arrayMaterial, $dataMat);
                }
                $inbound_mat = join("", $arrayMaterial);

                $arrayDetail = [];

                foreach($material_detail as $det){
                    if($det->qty_realization == null){
                        $realization = 0;
                    } else{
                        $realization = $det->qty_realization;
                    }
                    $dataDet = '<li>' . $det->material_name . ', '.$realization.' ' . $det->uom_name . '</li>';
                    array_push($arrayDetail, $dataDet);
                }
                $inbound_det = join("", $arrayDetail);


                $nestedData['number'] = $start;
                $nestedData['inbound_id'] = @$row->inbound_id;
                $nestedData['inbound_date'] = date('d-m-Y', strtotime(@$row->create_date));
                $nestedData['warehouse_name'] = @$row->wh_name;
                $nestedData['material_name'] = $inbound_mat;
                $nestedData['realization'] = @$inbound_det;
                $nestedData['due_date'] = date('d-m-Y', strtotime(@$row->due_date));
                $nestedData['status'] = $inbound_status;
                $nestedData['action'] = '<a href="'. base_url('realization/add/'.$row->inbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Recieve"><span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Check.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24"/>
                    <path d="M6.26193932,17.6476484 C5.90425297,18.0684559 5.27315905,18.1196257 4.85235158,17.7619393 C4.43154411,17.404253 4.38037434,16.773159 4.73806068,16.3523516 L13.2380607,6.35235158 C13.6013618,5.92493855 14.2451015,5.87991302 14.6643638,6.25259068 L19.1643638,10.2525907 C19.5771466,10.6195087 19.6143273,11.2515811 19.2474093,11.6643638 C18.8804913,12.0771466 18.2484189,12.1143273 17.8356362,11.7474093 L14.0997854,8.42665306 L6.26193932,17.6476484 Z" fill="#000000" fill-rule="nonzero" transform="translate(11.999995, 12.000002) rotate(-180.000000) translate(-11.999995, -12.000002) "/>
                </g>
                </svg></span></a>';
                
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

    public function add($id)
	{
		$data = [
            'title' => 'Inboundrealization',
            'title_menu' => 'Inbound',
            'sidebar' => 'Inbound'
        ];	
        $inbound_data = $this->inbound->get_inbound_byid($id);
        $po_id = $inbound_data->inbound_po;
        $owner_id = $this->purchase_order->get_po_byid($po_id)->owners_id;
		$dataObject = [
			'validation' => \Config\Services::validation(),
            'inbound_data' => $this->inbound->get_inbound_byid($id),
            'inbound_detail' => $this->inbound->get_inbound_detail($id),
            'owner' => $this->owner->get_owner_byid($owner_id)
		];

		echo view('layout/header', $data);
		echo view('inbound/add_realization', $dataObject);
		echo view('layout/footer');
	}

    public function create(){
        $data = [
            'title' => 'Inboundrealization',
            'sidebar' => 'Inbound'
        ];

        $validate = $this->validate([
            'rec_by' => ['label' => 'Recieve By', 'rules' => 'required'],
            'rec_date' => ['label' => 'Recieve Date', 'rules' => 'required'],
            'owner_id' => ['label' => 'Owner Name', 'rules' => 'required']
        ]);

        if (!$validate) {
            return redirect()->to(base_url('/realization/add'))->withInput();
        } else{
            $id = $this->request->getPost('inbound_id');
            $data_inbound = [
                'inbound_rcv_date' => date_format(date_create($this->request->getPost('rec_date')), 'Y-m-d H:i:s'),
                'inbound_rcv_by' => $this->request->getPost('rec_by'),
                'status' => 2,
                'update_date' => date('Y-m-d H:i:s'),
                'update_by' => session()->get('fullname')
            ];

            $this->inbound->update_data($id, $data_inbound);

            if(@$this->request->getPost('material')){
                $i=0;
                foreach($this->request->getPost('material') as $row){
                    $id = $this->request->getPost('det_inbound['.$i.']');
                    $good = str_replace(",", "",$this->request->getPost('good['.$i.']'));
                    $not_good = str_replace(",", "",$this->request->getPost('not_good['.$i.']'));
                    $data_inbound_detail = [
                        'qty_good_in' => $good,
                        'qty_notgood_in' => $not_good,
                        'qty_realization' => intval($good) + intval($not_good),
                        'cek' => $this->request->getPost('check['.$i.']'),
                        'status' => 2
                    ];

                    $this->inbound_detail->update_data($id, $data_inbound_detail);

                    $mat_detail_id = $this->material_detail->check_material($this->request->getPost('owner_id'), $row, $this->request->getPost('batch['.$i.']'), $this->request->getPost('exp['.$i.']'));
                    if($mat_detail_id == 0){ //nanti ubah disini untuk penambahan
                        $material_detail_id_ins = $this->material_detail->generate_id();
                        $material_detail = [
                            'mat_detail_id' => $material_detail_id_ins,
                            'owner_id' => $this->request->getPost('owner_id'),
                            'batch_no' => $this->request->getPost('batch['.$i.']'),
                            'expired_date' => date_format(date_create($this->request->getPost('exp['.$i.']')), 'Y-m-d'),
                            'material_id' => $row,
                            'material_price' => $this->request->getPost('material_price['.$i.']'),
                            'create_date' => date('Y-m-d H:i:s'),
                            'status' => 1,
                            'create_by' => session()->get('fullname')
                        ];
                        $this->material_detail->insert_data($material_detail);
                        
                        $update_inbound_detail = [
                            'material_detail_id' => $material_detail['mat_detail_id']
                        ];

                        $this->inbound_detail->update_data($id, $update_inbound_detail);

                        $mat_soh = [
                            'soh_id' => $this->material_soh->generate_id(),
                            'mat_detail_id' => $material_detail['mat_detail_id'],
                            'stock_ok' => $data_inbound_detail['qty_good_in'],
                            'stock_nok' => $data_inbound_detail['qty_notgood_in'],
                            'status' => 1
                        ];

                        $this->material_soh->insert_data($mat_soh);
                    } else {
                        $stock_ok = $this->material_soh->get_currrent_stock($mat_detail_id)->stock_ok;
                        $stock_nok = $this->material_soh->get_currrent_stock($mat_detail_id)->stock_nok;
                        $mat_soh = [
                            'stock_ok' => intval($data_inbound_detail['qty_good_in']) + intval($stock_ok),
                            'stock_nok' => intval($data_inbound_detail['qty_notgood_in']) + intval($stock_nok),
                            'status' => 1
                        ];
                        $this->material_soh->update_data($mat_detail_id, $mat_soh);
                    }
                    $i++;
                }
            }
            
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Inbound Realization successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('inboundhistory'));
        }
    }

    public function detail($id)
	{
		$data = [
            'title' => 'Inboundrealization',
            'title_menu' => 'Inbound',
            'sidebar' => 'Inbound'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation()
		];

		echo view('layout/header', $data);
		echo view('purchase_order/detail', $dataObject);
		echo view('layout/footer');
	}
}
?>