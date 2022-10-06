<?php

namespace App\Controllers;
use App\Models\MaterialModel;
use App\Models\MaterialDetailModel;
use App\Models\CustomerModel;
use App\Models\WarehouseModel;
use App\Models\OwnersModel;
use App\Models\OutboundModel;
use App\Models\OutboundDetailModel;
use App\Models\LocationModel;
use App\Models\MaterialSohModel;
use Config\Services;

class OutboundHistory extends BaseController
{
    public function __construct()
    {
        $this->material = new MaterialModel();
        $this->material_detail = new MaterialDetailModel();
        $this->customer = new CustomerModel();
        $this->warehouse = new WarehouseModel();
        $this->outbound = new OutboundModel();
        $this->owner = new OwnersModel();
        $this->outbound_detail = new OutboundDetailModel();
        $this->location = new LocationModel();
        $this->material_soh = new MaterialSohModel();

        helper(['form', 'url', 'my']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index(){
        $data = [
            'title' => 'Outboundhistory',
            'title_menu' => 'Outbound',
            'sidebar' => 'Outbound History'
        ];	

		echo view('layout/header', $data);
		echo view('outbound/outbound_history', $data);
		echo view('layout/footer');
    }

    public function getData(){

        $columns = array( 
            0 => 'outbound.outbound_id',
            1 => 'outbound.create_date',
            2 => 'outbound.outbound_doc',
            3 => 'outbound.outbound_doc_date',
            4 => 'customer.customer_name',
            5 => 'warehouse.wh_name'
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        $totalData = $this->outbound->all_outbound_count();
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $outbound = $this->outbound->all_outbound($limit, $start, $order, $dir);
        } else {
            $search = $this->request->getPost('search')['value']; 
            $outbound = $this->outbound->search_outbound($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->outbound->search_outbound_count($search);
        }

        $data = array();
        if(@$outbound) {
            foreach ($outbound as $row) {
                $start++;

                if(@$row->status == 1) {
                    $outbound_status = '<span class="label label-light-success label-pill label-inline mr-2">New</span>';
                } else if(@$row->status == 2)  { 
                    $outbound_status = '<span class="label label-light-warning label-pill label-inline mr-2">Packing</span>';
                } else if(@$row->status == 3)  { 
                    $outbound_status = '<span class="label label-light-primary label-pill label-inline mr-2">Shipping</span>';
                } else if(@$row->status == 4)  { 
                    $outbound_status = '<span class="label label-light-info label-pill label-inline mr-2">Sent</span>';
                } else if(@$row->status == 5)  { 
                    $outbound_status = '<span class="label label-light-info label-pill label-inline mr-2">Approved</span>';
                } else if(@$row->status == 6)  { 
                    $outbound_status = '<span class="label label-light-danger label-pill label-inline mr-2">AWB Rejected</span>';
                } else if(@$row->status == 7)  { 
                    $outbound_status = '<span class="label label-light-success label-pill label-inline mr-2">Done</span>';
                } 

                $material_detail = $this->outbound->get_outbound_detail($row->outbound_id);
                $arrayMaterial = [];

                foreach($material_detail as $mat){
                    $dataMat = '<li>' . $mat->material_name . ', '.$mat->outbound_qty.' ' . $mat->uom_name . '</li>';
                    array_push($arrayMaterial, $dataMat);
                }
                $outbound_mat = join("", $arrayMaterial);

                $arrayDetail = [];

                foreach($material_detail as $det){
                    $dataDet = '<li>' . $det->material_name . ', '.$det->qty_realization.' ' . $det->uom_name . '</li>';
                    array_push($arrayDetail, $dataDet);
                }
                $outbound_det = join("", $arrayDetail);

                $nestedData['number'] = $start;
                $nestedData['outbound_id'] = @$row->outbound_id;
                $nestedData['outbound_doc'] = @$row->outbound_doc;
                $nestedData['outbound_date'] = date('d-m-Y', strtotime(@$row->create_date));
                $nestedData['customer_name'] = @$row->customer_name;
                $nestedData['warehouse_name'] = @$row->wh_name;
                $nestedData['material_name'] = $outbound_mat;
                $nestedData['realization'] = @$outbound_det;
                $nestedData['status'] = $outbound_status;
                $nestedData['action'] = '<a href="'. base_url('outboundhistory/detail/'.$row->outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<rect x="0" y="0" width="24" height="24"/>
					<path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
					<path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
				</g>
				</svg></span></a>
                <a href="'. base_url('outboundhistory/print_outbound_bast/'.$row->outbound_id).'" target="_blank" class="btn btn-sm btn-clean btn-icon mr-1" title="Print"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <path d="M16,17 L16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 L8,17 L5,17 C3.8954305,17 3,16.1045695 3,15 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,15 C21,16.1045695 20.1045695,17 19,17 L16,17 Z M17.5,11 C18.3284271,11 19,10.3284271 19,9.5 C19,8.67157288 18.3284271,8 17.5,8 C16.6715729,8 16,8.67157288 16,9.5 C16,10.3284271 16.6715729,11 17.5,11 Z M10,14 L10,20 L14,20 L14,14 L10,14 Z" fill="#000000"/>
                    <rect fill="#000000" opacity="0.3" x="8" y="2" width="8" height="2" rx="1"/>
                </g>
				</svg></span>
                </a>';
                
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
		$fields = array('outbound_id', 'outbound_date', 'customer_name', 'warehouse_name', 'material_name', 'realization');
		
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

    public function detail($id)
	{
		$data = [
            'title' => 'Outboundhistory',
            'title_menu' => 'Outbound',
            'sidebar' => 'Outbound'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'data_outbound' => $this->outbound->get_outbound_byid($id),
            'outbound_detail' => $this->outbound->get_outbound_detail($id)
		];

		echo view('layout/header', $data);
		echo view('outbound/detail_history', $dataObject);
		echo view('layout/footer');
	}

    public function print_outbound_bast($id)
    {
        $data = [
            'title' => 'Outboundhistory',
            'title_menu' => 'Outbound',
            'sidebar' => 'Outbound'
        ];	

        $cond = "ob.outbound_id = '$id'";
        $cond2 = "obd.outbound_id = '$id'";
		$dataObject = [
			'validation' => \Config\Services::validation(),
            'data_outbound' => $this->outbound->print_history_v3($cond),
            'outbound_detail' => $this->outbound->print_history_detail_v2($cond2)
		];

        echo view('outbound/print_bast_ver3', $dataObject);
		
    }
}
?>