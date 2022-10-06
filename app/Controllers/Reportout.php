<?php

namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\OutModel;
use App\Models\WarehouseModel;
use App\Models\OutboundModel;
use App\Models\BillModel;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Reportout extends BaseController
{
	public function __construct()
    {
        $this->reports = new OutModel();
        $this->outbound = new OutboundModel();
        $this->warehouse = new WarehouseModel();
        $this->bill = new BillModel();
        
        helper(['form', 'url', 'my']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index()
	{
		$data = [
            'title' => 'Outbound Report',
			'title_menu' => 'Outbound Report',
            'sidebar' => 'Outbound Report',
            'warehouse' => $this->warehouse->get_all_warehouse()
        ];

		echo view('layout/header', $data);
		echo view('reportout/reportout_data', $data);
		echo view('layout/footer');
	}

	// public function getData(){

    //     $columns = array( // ini adalah column ordernya, pake nama kolom yang di database
    //         0 => 'det_outbound_id',
    //         1 => 'out_date',
    //         2 => 'po_outbound_id',
    //         3 => 'wh_name',
    //         4 => 'material_name',
    //         5 => 'qty_realization',
    //         6 => 'customer_name'
    //     );

    //     $limit = $this->request->getPost('length');
    //     $start = $this->request->getPost('start');
    //     $order = $columns[$this->request->getPost('order')[0]['column']];
    //     $dir = $this->request->getPost('order')[0]['dir']; 

    //     if(@$this->request->getPost('filter_start')){
    //         $start_date = date_format(date_create(@$this->request->getPost('filter_start')), 'Y-m-d');
    //     } else {
    //         $start_date = null;
    //     }

    //     if(@$this->request->getPost('filter_end')){
    //         $end_date = date_format(date_create(@$this->request->getPost('filter_end')), 'Y-m-d');
    //     } else {
    //         $end_date = null;
    //     }

    //     if(@$this->request->getPost('filter_wh')){
    //         $wh = @$this->request->getPost('filter_wh');
    //     } else {
    //         $wh = null;
    //     }
        
    //     $totalData = $this->reports->all_laporan_out_count($start_date, $end_date, $wh);
    //     $totalFiltered = $totalData;

    //     if(empty($this->request->getPost('search')['value'])) { 
    //         $rep = $this->reports->all_laporan_out($start_date, $end_date, $wh, $limit, $start, $order, $dir);
    //     } else {
    //         $search = $this->request->getPost('search')['value']; 
    //         $rep = $this->reports->search_laporan_out($start_date, $end_date, $wh, $limit, $start, $search, $order, $dir);
    //         $totalFiltered = $this->reports->search_laporan_out_count($start_date, $end_date, $wh, $search);
    //     }

    //     $data = array();
    //     if(@$rep) {
    //         foreach ($rep as $row) {
    //             $start++;
    //             // var_dump()
    //             // if(@$row->status == 1) {
    //             //     $blok_status = '<span class="label label-light-success label-pill label-inline mr-2">Active</span>';
    //             // } else { 
    //             //     $blok_status = '<span class="label label-light-danger label-pill label-inline mr-2">Inactive</span>';
    //             // }

    //             $nestedData['number'] = $start;
    //             $nestedData['out_date'] = date('d-m-Y', strtotime(@$row->out_date));
    //             $nestedData['po_outbound_id'] = @$row->po_outbound_id;
    //             $nestedData['wh_name'] = @$row->wh_name;
    //             $nestedData['material_name'] = @$row->material_name;
	// 			$nestedData['qty_realization'] = @$row->qty_realization;
    //             $nestedData['customer_name'] = $row->customer_name;
                
    //             // <button class="btn btn-sm btn-clean btn-icon mr-1" id="delete" data-id="'.@$row->blok_id.'" title="Delete"><span class="svg-icon svg-icon-danger svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    //             // <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
    //             //     <rect x="0" y="0" width="24" height="24"/>
    //             //     <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
    //             //     <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
    //             // </g>
    //             // </svg></span></button>
                
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
	// 	$fields = array('out_date', 'po_outbound_id', 'wh_name', 'material_name', 'qty_realization', 'customer_name');
	// 	$columns[] = array(
	// 		'data' => 'number',
	// 		'className' => 'text-center'
	// 	);
	// 	foreach ($fields as $field) {
	// 		$columns[] = array(
	// 			'data' => $field,
    //             'className' => 'text-nowrap'
	// 		);
	// 	}
    //     // $columns[] = array(
	// 	// 	'data' => 'status',
	// 	// 	'className' => 'text-center'
	// 	// );
	// 	// $columns[] = array(
	// 	// 	'data' => 'action',
	// 	// 	'className' => 'text-center text-nowrap'
	// 	// );
	// 	echo json_encode($columns); 
	// }

    public function getData(){

        $columns = array( // ini adalah column ordernya, pake nama kolom yang di database
            0 => 'det_outbound_id',
            1 => 'out_date',
            2 => 'po_outbound_id',
            3 => 'wh_name',
            4 => 'material_name',
            5 => 'customer_name',
            6 => 'admin_fee',
            7 => 'packing_fee',
            8 => 'custom_fee',
            9 => 'shipping_fee'
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        if(@$this->request->getPost('filter_start')){
            $start_date = date_format(date_create(@$this->request->getPost('filter_start')), 'Y-m-d');
        } else {
            $start_date = null;
        }

        if(@$this->request->getPost('filter_end')){
            $end_date = date_format(date_create(@$this->request->getPost('filter_end')), 'Y-m-d');
        } else {
            $end_date = null;
        }

        if(@$this->request->getPost('filter_wh')){
            $wh = @$this->request->getPost('filter_wh');
        } else {
            $wh = null;
        }
        
        $totalData = $this->reports->all_laporan_out_count($start_date, $end_date, $wh);
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $rep = $this->reports->all_laporan_out($start_date, $end_date, $wh, $limit, $start, $order, $dir);
        } else {
            $search = $this->request->getPost('search')['value']; 
            $rep = $this->reports->search_laporan_out($start_date, $end_date, $wh, $limit, $start, $search, $order, $dir);
            $totalFiltered = $this->reports->search_laporan_out_count($start_date, $end_date, $wh, $search);
        }

        $data = array();
        if(@$rep) {
            foreach ($rep as $row) {
                $start++;
                $material_detail = $this->outbound->get_outbound_detail($row->outbound_id);
                $bill_detail = $this->bill->get_bill_bypo_id_report($row->po_outbound_id);
                // var_dump($bill_detail);
                $admin_fee = 0;
                $shipping_fee = 0;
                $packing_fee = 0;
                $custom_service_fee = 0;

                $arrayDetail = [];

                foreach($material_detail as $det){
                    $dataDet = '<li>' . $det->material_name . ', '.$det->qty_realization.' ' . $det->uom_name . '</li>';
                    array_push($arrayDetail, $dataDet);
                }

                foreach($bill_detail as $det){
                    if($det->description == "ADMIN FEE"){
                        $admin_fee = $det->amount;
                    }elseif($det->description == "BIAYA PACKING"){
                        $packing_fee = $det->amount;
                    }elseif($det->description == "CUSTOM SERVICE FEE"){
                        $custom_service_fee = $det->amount;
                    }elseif($det->description == "BIAYA ONGKIR"){
                        $shipping_fee = $det->amount;
                    }
                }

                $outbound_det = join("", $arrayDetail);
                $nestedData['number'] = $start;
                $nestedData['out_date'] = date('d-m-Y', strtotime(@$row->out_date));
                $nestedData['po_outbound_id'] = @$row->po_outbound_id;
                $nestedData['wh_name'] = @$row->wh_name;
                $nestedData['material_name'] = @$outbound_det;
                $nestedData['customer_name'] = $row->customer_name;
				$nestedData['admin_fee'] = "Rp. " . number_format(@$admin_fee);
				$nestedData['packing_fee'] = "Rp. " . number_format(@$packing_fee);
				$nestedData['custom_fee'] = "Rp. " . number_format(@$custom_service_fee);
				$nestedData['shipping_fee'] = "Rp. " . number_format(@$shipping_fee);
                
                // <button class="btn btn-sm btn-clean btn-icon mr-1" id="delete" data-id="'.@$row->blok_id.'" title="Delete"><span class="svg-icon svg-icon-danger svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                // <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                //     <rect x="0" y="0" width="24" height="24"/>
                //     <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                //     <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                // </g>
                // </svg></span></button>
                
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
		$fields = array('out_date', 'po_outbound_id', 'wh_name', 'material_name', 'customer_name', 'admin_fee', 'packing_fee','custom_fee','shipping_fee');
		$columns[] = array(
			'data' => 'number',
			'className' => 'text-center'
		);
		foreach ($fields as $field) {
			$columns[] = array(
				'data' => $field,
                'className' => 'text-nowrap'
			);
		}
        // $columns[] = array(
		// 	'data' => 'status',
		// 	'className' => 'text-center'
		// );
		// $columns[] = array(
		// 	'data' => 'action',
		// 	'className' => 'text-center text-nowrap'
		// );
		echo json_encode($columns); 
	}


}
?>