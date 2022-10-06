<?php

namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\DashboardModel;
use App\Models\OwnersMarketModel;
use App\Models\OwnersModel;
use App\Models\BankModel;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Dashboard extends BaseController
{
	public function __construct()
    {
        $this->dashboard = new DashboardModel();
        $this->market = new OwnersMarketModel();
        $this->owners = new OwnersModel();
        $this->bank = new BankModel(); 
        
        helper(['form', 'url', 'my']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index()
	{
        if(@$this->request->getGet('owners_id')){
            $owners = @$this->request->getGet('owners_id');
        } else {
            $owners = null;
        }

        $soh = $this->dashboard->total_soh();
        $admin_fee = $this->dashboard->total_admin_fee();
        $ongkir = $this->dashboard->total_biaya_kurir();
        $packing = $this->dashboard->total_biaya_packing();
        $wh_fee = $this->dashboard->total_warehouse_fee();

        $data_chart_inbound = $this->dashboard->inbound_data_chart();
        $tanggal_inbound = array();
        $jml_inbound = array();
        foreach($data_chart_inbound as $row){
            $tanggal_inbound[] = $row->inbound_doc_date;
            $jml_inbound[] = $row->jml_inbound;
        }

        $today = date("Y-m-d");
        $inbound_today = $this->dashboard->count_inbound_chart($owners, $today);
        $outbound_today = $this->dashboard->count_shipping_chart($owners, $today);
        // var_dump($soh[0]->warehouse_id);
        // die;
        // JS dari data table ada di basic.js
        $stok_good_data = $this->dashboard->stok_good_detail();
        $stok_notgood_data = $this->dashboard->stok_notgood_detail();
        if($soh[0]->stock_ok == null){
            $stock_ok = 0 ;
        } else {
            $stock_ok = $soh[0]->stock_ok;
        }

        if($soh[0]->stock_nok == null){
            $stock_nok = 0 ;
        } else {
            $stock_nok = $soh[0]->stock_nok;
        }
		$data = [
            'title' => 'Dashboard',
			'title_menu' => 'Dashboard',
            'sidebar' => 'Dashboard',
            'stock_ok' => $stock_ok,
            'stock_nok' => $stock_nok,
            'admin_fee' => $admin_fee[0]->admin_fee,
            'biaya_ongkir' => $ongkir[0]->kurir,
            'biaya_packing' => $packing[0]->packing,
            'wh_fee' => $wh_fee[0]->wh_fee,
            'stok_good_data' => $stok_good_data,
            'stok_notgood_data' => $stok_notgood_data,
            'inbound_chart_date' => $tanggal_inbound,
            'inbound_chart_jml' => $jml_inbound,
            'inbound_today' => $inbound_today,
            'outbound_today' => $outbound_today,
            'owners_data' => $this->owners->get_all_owner()
        ];

		echo view('layout/header', $data);
		echo view('dashboard/dashboard', $data);
		echo view('layout/footer');
	}

    public function daily()
	{
        $data = [
            'title' => 'Dashboard',
			'title_menu' => 'Dashboard',
            'sidebar' => 'Dashboard'
        ];

		echo view('layout/header', $data);
		echo view('dashboard/dashboard_daily_data', $data);
		echo view('layout/footer');
	}

    public function monthly()
	{
        $data = [
            'title' => 'Dashboard',
			'title_menu' => 'Dashboard',
            'sidebar' => 'Dashboard'
        ];

		echo view('layout/header', $data);
		echo view('dashboard/dashboard_monthly_data', $data);
		echo view('layout/footer');
	}

    public function get_inboundChartData()
    {     
        if(@$this->request->getGet('owners_id')){
            $owners = @$this->request->getGet('owners_id');
        } else {
            $owners = null;
        }
        $start_date = new \DateTime(date('Y-m-d', strtotime('-31 days')));
        $end_date = new \DateTime(date('Y-m-d', strtotime('-1 days')));
        $dataweight = array();
        do{
            $doc_date = $start_date->format('Y-m-d');
            $jml_inbound = $this->dashboard->count_inbound_chart($owners, $doc_date);
            $array_label[] = date('d M Y', strtotime($doc_date));
            $array_datasets[] = $jml_inbound;
            $start_date->modify('+1 day');
        } while ($end_date >= $start_date);
        
		$outpt = array(
			'labels' => $array_label,
			'datasets' => $array_datasets
		);
        echo json_encode($outpt, JSON_NUMERIC_CHECK);
        // echo json_encode($outpt);
    }

    public function get_inboundLastWeek()
    {     
        if(@$this->request->getGet('owners_id')){
            $owners = @$this->request->getGet('owners_id');
        } else {
            $owners = null;
        }
        $start_date = new \DateTime(date('Y-m-d', strtotime('-7 days')));
        $end_date = new \DateTime(date('Y-m-d', strtotime('-1 days')));
        $dataweight = array();
        do{
            $doc_date = $start_date->format('Y-m-d');
            $jml_inbound = $this->dashboard->count_inbound_chart($owners, $doc_date);
            $array_label[] = date('d M Y', strtotime($doc_date));
            $array_datasets[] = $jml_inbound;
            $start_date->modify('+1 day');
        } while ($end_date >= $start_date);
        
		$outpt = array(
			'labels' => $array_label,
			'datasets' => $array_datasets
		);
        echo json_encode($outpt, JSON_NUMERIC_CHECK);
        // echo json_encode($outpt);
    }

    public function get_inboundBarChartData(){
        if(@$this->request->getGet('owners_id')){
            $owners = @$this->request->getGet('owners_id');
        } else {
            $owners = null;
        }
        $start_date = new \DateTime(date('Y-m-d', strtotime($this->request->getGet('start_date'))));
		$until_date = new \DateTime(date('Y-m-d', strtotime($this->request->getGet('until_date'))));
        
        $dataweight = array();
        do{
            $doc_date = $start_date->format('Y-m-d');
            $jml_inbound = $this->dashboard->count_inbound_chart($owners, $doc_date);
            $array_label[] = date('d M Y', strtotime($doc_date));
            $array_datasets[] = $jml_inbound;
            $start_date->modify('+1 day');
        } while ($until_date >= $start_date);
        
		$outpt = array(
			'labels' => $array_label,
			'datasets' => $array_datasets
		);
        echo json_encode($outpt, JSON_NUMERIC_CHECK);
        //echo view('dashboard/dashboard', $dataDashboard);
    }

    public function get_shippingChartData()
    {     
        if(@$this->request->getGet('owners_id')){
            $owners = @$this->request->getGet('owners_id');
        } else {
            $owners = null;
        }
        $start_date = new \DateTime(date('Y-m-d', strtotime('-31 days')));
        $end_date = new \DateTime(date('Y-m-d', strtotime('-1 days')));
        $dataweight = array();
        do{
            $doc_date = $start_date->format('Y-m-d');
            $jml_inbound = $this->dashboard->count_shipping_chart($owners, $doc_date);
            $array_label[] = date('d M Y', strtotime($doc_date));
            $array_datasets[] = $jml_inbound;
            $start_date->modify('+1 day');
        } while ($end_date >= $start_date);
        
		$outpt = array(
			'labels' => $array_label,
			'datasets' => $array_datasets
		);
        echo json_encode($outpt, JSON_NUMERIC_CHECK);
        // echo json_encode($outpt);
    }

    public function get_outboundLastWeek()
    {    
        if(@$this->request->getGet('owners_id')){
            $owners = @$this->request->getGet('owners_id');
        } else {
            $owners = null;
        }
        $start_date = new \DateTime(date('Y-m-d', strtotime('-7 days')));
        $end_date = new \DateTime(date('Y-m-d', strtotime('-1 days')));
        $dataweight = array();
        do{
            $doc_date = $start_date->format('Y-m-d');
            $jml_inbound = $this->dashboard->count_shipping_chart($owners, $doc_date);
            $array_label[] = date('d M Y', strtotime($doc_date));
            $array_datasets[] = $jml_inbound;
            $start_date->modify('+1 day');
        } while ($end_date >= $start_date);
        
		$outpt = array(
			'labels' => $array_label,
			'datasets' => $array_datasets
		);
        echo json_encode($outpt, JSON_NUMERIC_CHECK);
        // echo json_encode($outpt);
    }

    public function get_outboundBarChartData(){
        if(@$this->request->getGet('owners_id')){
            $owners = @$this->request->getGet('owners_id');
        } else {
            $owners = null;
        }
        $start_date = new \DateTime(date('Y-m-d', strtotime($this->request->getGet('start_date'))));
		$until_date = new \DateTime(date('Y-m-d', strtotime($this->request->getGet('until_date'))));
        
        $dataweight = array();
        do{
            $doc_date = $start_date->format('Y-m-d');
            $jml_outbound = $this->dashboard->count_shipping_chart($owners, $doc_date);
            $array_label[] = date('d M Y', strtotime($doc_date));
            $array_datasets[] = $jml_outbound;
            $start_date->modify('+1 day');
        } while ($until_date >= $start_date);
        
		$outpt = array(
			'labels' => $array_label,
			'datasets' => $array_datasets
		);
        echo json_encode($outpt, JSON_NUMERIC_CHECK);
        //echo view('dashboard/dashboard', $dataDashboard);
    }

    public function update_stok_dashboard(){
        $owners_id = $this->request->getPost('owners_id');
        $soh = $this->dashboard->total_soh_f($owners_id);

        $stok_good_data = $this->dashboard->stok_good_detail_f($owners_id);
        $stok_notgood_data = $this->dashboard->stok_notgood_detail_f($owners_id);

        $today = date("Y-m-d");
        $inbound_today = $this->dashboard->count_inbound_chart($owners_id, $today);
        $outbound_today = $this->dashboard->count_shipping_chart($owners_id, $today);

        if($soh[0]->stock_ok == null){
            $stock_ok = 0 ;
        } else {
            $stock_ok = $soh[0]->stock_ok;
        }

        if($soh[0]->stock_nok == null){
            $stock_nok = 0 ;
        } else {
            $stock_nok = $soh[0]->stock_nok;
        }
        $good_list = '<table class="table display table-separate table-bordered-scroll-x" id="stock_good">
        <thead>
            <tr>
                <th th width="3%">No.</th>
                <th>Warehouse ID</th>
                <th>Warehouse Name</th>
                <th>Material ID</th>
                <th>Material Name</th>
                <th>Location</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>';
        if(@$stok_good_data){
			if(@$stok_good_data){
                $i=0;
                $j=0;
				foreach ($stok_good_data as $row) {
                    $j++;
                    $good_list .= '<tr>
                            <td scope="row" th width="3%">'. $j .'</td>
                            <td> ' .@$row->warehouse_id . '</td>
                            <td> ' .@$row->wh_name . '</td>
                            <td> ' .@$row->material_id . '</td>
                            <td> ' .@$row->material_name . '</td>
                            <td> ' .@$row->mat_loc . '</td>
                            <td> ' .@$row->qty . '</td>
                        </tr>';
                    $i++;
				}
			}
		}else{
			$good_list .= '<tr class="text-center">
                <td colspan="11">No data available in table</td>
            </tr>';
		}

        $good_list .= '</tbody>
        </table>';

        // -- start of table not good
        $notgood_list = '<table class="table display table-separate table-bordered-scroll-x" id="stock_notgood">
        <thead>
            <tr>
                <th th width="3%">No.</th>
                <th>Warehouse ID</th>
                <th>Warehouse Name</th>
                <th>Material ID</th>
                <th>Material Name</th>
                <th>Location</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>';
        if(@$stok_notgood_data){
			if(@$stok_notgood_data){
                $i=0;
                $j=0;
				foreach ($stok_notgood_data as $row) {
                    $j++;
                    $notgood_list .= '<tr>
                            <td scope="row" th width="3%">'. $j .'</td>
                            <td> ' .@$row->warehouse_id . '</td>
                            <td> ' .@$row->wh_name . '</td>
                            <td> ' .@$row->material_id . '</td>
                            <td> ' .@$row->material_name . '</td>
                            <td> ' .@$row->mat_loc . '</td>
                            <td> ' .@$row->qty . '</td>
                        </tr>';
                    $i++;
				}
			}
		}else{
			$notgood_list .= '<tr class="text-center">
                <td colspan="11">No data available in table</td>
            </tr>';
		}

        $notgood_list .= '</tbody>
        </table>';

        // -- end of table not good

        $data = [
            'stock_ok' => $stock_ok,
            'stock_nok' => $stock_nok,
            'stok_good_data' => $good_list,
            'stok_notgood_data' => $notgood_list,
            'inbound_today' => $inbound_today,
            'outbound_today' => $outbound_today,
        ];
        echo json_encode($data);
    }

    //--------------- dashboard monthly
    public function get_inboundMonthly(){
        
        if(@$this->request->getGet('owners_id')){
            $owners = @$this->request->getGet('owners_id');
        } else {
            $owners = null;
        }

        $year = date('Y');
        $month = $this->request->getGet('month');
        if(intVal($month) < 10 )
        {
            $month = '0'.$month;
        }
        $days = cal_days_in_month(CAL_GREGORIAN, intVal($month), intval($year));
        $start = $year . '-' . $month . '-01';
        $end = $year . '-' . $month . '-' . $days;
        // var_dump($end);
        // die;
        $start_date = new \DateTime(date('Y-m-d', strtotime($start)));
		$until_date = new \DateTime(date('Y-m-d', strtotime($end)));
        
        $dataweight = array();
        do{
            $doc_date = $start_date->format('Y-m-d');
            $jml_outbound = $this->dashboard->count_inbound_chart($owners, $doc_date);
            $array_label[] = date('d M Y', strtotime($doc_date));
            $array_datasets[] = $jml_outbound;
            $start_date->modify('+1 day');
        } while ($until_date >= $start_date);
        
		$outpt = array(
			'labels' => $array_label,
			'datasets' => $array_datasets
		);
        echo json_encode($outpt, JSON_NUMERIC_CHECK);
        //echo view('dashboard/dashboard', $dataDashboard);
    }

    public function get_outboundMonthly(){

        if(@$this->request->getGet('owners_id')){
            $owners = @$this->request->getGet('owners_id');
        } else {
            $owners = null;
        }

        $year = date('Y');
        $month = $this->request->getGet('month');
        if(intVal($month) < 10 )
        {
            $month = '0'.$month;
        }
        $days = cal_days_in_month(CAL_GREGORIAN, intVal($month), intval($year));
        $start = $year . '-' . $month . '-01';
        $end = $year . '-' . $month . '-' . $days;
        // var_dump($end);
        // die;
        $start_date = new \DateTime(date('Y-m-d', strtotime($start)));
		$until_date = new \DateTime(date('Y-m-d', strtotime($end)));
        
        $dataweight = array();
        do{
            $doc_date = $start_date->format('Y-m-d');
            $jml_outbound = $this->dashboard->count_shipping_chart($owners, $doc_date);
            $array_label[] = date('d M Y', strtotime($doc_date));
            $array_datasets[] = $jml_outbound;
            $start_date->modify('+1 day');
        } while ($until_date >= $start_date);
        
		$outpt = array(
			'labels' => $array_label,
			'datasets' => $array_datasets
		);
        echo json_encode($outpt, JSON_NUMERIC_CHECK);
        //echo view('dashboard/dashboard', $dataDashboard);
    }
    //----------------- end of dashboard monthly
    public function seller()
	{
        $soh = $this->dashboard->total_soh();
        $admin_fee = $this->dashboard->total_admin_fee();
        $ongkir = $this->dashboard->total_biaya_kurir();
        $packing = $this->dashboard->total_biaya_packing();
        $wh_fee = $this->dashboard->total_warehouse_fee();
        // var_dump($soh[0]->warehouse_id);
        // die;
        // JS dari data table ada di basic.js
        
        $bank = $this->bank->get_accountByOwner(session()->get('owners_id'));
        $market = $this->market->get_owner_markets(session()->get('owners_id'));
        if(@$market == null or @$bank == null){
            session()->setFlashdata('message_market', '<div class="alert alert-custom alert-light-warning fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Your profile data is not complete, please complete it in <a href="'.base_url('owners/editSeller/'. session()->get('owners_id')).'">your profile</a> first.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
        }

        $stok_good_data = $this->dashboard->stok_good_detail();
        $stok_notgood_data = $this->dashboard->stok_notgood_detail();
        if($soh[0]->stock_ok == null){
            $stock_ok = 0 ;
        } else {
            $stock_ok = $soh[0]->stock_ok - $soh[0]->reserved_qty;
        }

        if($soh[0]->stock_nok == null){
            $stock_nok = 0 ;
        } else {
            $stock_nok = $soh[0]->stock_nok;
        }
		$data = [
            'title' => 'Dashboard',
			'title_menu' => 'Dashboard',
            'sidebar' => 'Dashboard',
            'stock_ok' => $stock_ok,
            'stock_nok' => $stock_nok,
            'admin_fee' => $admin_fee[0]->admin_fee,
            'biaya_ongkir' => $ongkir[0]->kurir,
            'biaya_packing' => $packing[0]->packing,
            'wh_fee' => $wh_fee[0]->wh_fee,
            'stok_good_data' => $stok_good_data,
            'stok_notgood_data' => $stok_notgood_data
        ];


        // get list warehouse by owner
        $data["warehouse_list"] = json_encode($this->dashboard->get_warehouse_by_owner());

        // cuctome JS
        $data["js"] = "dashboard_owner.js";
    
		echo view('layout/header', $data);
		echo view('dashboard/dashboard_owner', $data);
		echo view('layout/footer', $data);
	}

    public function getDataByOwner(){

        $columns = array( // ini adalah column ordernya, pake nama kolom yang di database
            0 => 'warehouse_id',
            1 => 'warehouse_id',
            2 => 'wh_name',
            3 => 'material_id',
            4 => 'material_name',
            5 => 'stock_ok',
			6 => 'stock_nok',
			7 => 'reserved_qty'
        );


        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir'];
        $search = $this->request->getPost('search')['value']; 
        $filter_wh = $this->request->getPost('filter_wh');


        $totalData = @$this->dashboard->all_soh_count($owner);
        $totalFiltered = $totalData;

        $soh = $this->dashboard->get_data_by_owner($limit, $start, $search, $order, $dir, $filter_wh);
        $totalData = $this->dashboard->get_data_by_owner_count($search, $filter_wh);
        $totalFiltered = $totalData;
        // if(empty($this->request->getPost('search')['value'])) { 
        //     $soh = $this->dashboard->all_soh($owner, $limit, $start, $order, $dir);
        // } else {
        //     $search = $this->request->getPost('search')['value']; 
        //     $soh = $this->dashboard->search_soh($owner, $limit, $start, $search, $order, $dir);
        //     $totalFiltered = @$this->dashboard->search_soh_count($owner, $search);
        // }

        $data = array();
        if(@$soh) {
            foreach ($soh as $row) {
                $start++;
                

                $nestedData['number'] = $start;
                $nestedData['warehouse_id'] = @$row->warehouse_id;
                $nestedData['wh_name'] = @$row->wh_name;
                $nestedData['material_id'] = @$row->material_id;
				$nestedData['material_name'] = @$row->material_name;
                $nestedData['stock_nok'] = $row->stock_nok;
                
                $reserved_qty = 0;
                if($row->reserved_qty != null){
                    $reserved_qty = $row->reserved_qty;
                }
                $nestedData['reserved_qty'] = $reserved_qty;
                if(session()->get('user_type') == 1){
                    $nestedData['stock_ok'] = $row->stock_ok - $reserved_qty;
                } else {
                    $nestedData['stock_ok'] = $row->stock_ok;
                }
                
                
                
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

	public function getData(){

        $columns = array( // ini adalah column ordernya, pake nama kolom yang di database
            0 => 'warehouse_id',
            1 => 'warehouse_id',
            2 => 'wh_name',
            3 => 'material_id',
            4 => 'material_name',
            5 => 'stock_ok',
			6 => 'stock_nok',
			7 => 'reserved_qty'
        );
        // $columns = array( // ini adalah column ordernya, pake nama kolom yang di database
        //     0 => 'warehouse_id',
        //     1 => 'warehouse_id',
        //     2 => 'material_id',
        //     3 => 'material_id',
		// 	4 => 'material_id'
        // );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        if(@$this->request->getPost('f_dash_owner')){
            $owner = @$this->request->getPost('f_dash_owner'); //didapat dari serverside-datatables.js
        } else {
            $owner = null;
        }

        $totalData = @$this->dashboard->all_soh_count($owner);
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $soh = $this->dashboard->all_soh($owner, $limit, $start, $order, $dir);
        } else {
            $search = $this->request->getPost('search')['value']; 
            $soh = $this->dashboard->search_soh($owner, $limit, $start, $search, $order, $dir);
            $totalFiltered = @$this->dashboard->search_soh_count($owner, $search);
        }

        $data = array();
        if(@$soh) {
            foreach ($soh as $row) {
                $start++;
                

                $nestedData['number'] = $start;
                $nestedData['warehouse_id'] = @$row->warehouse_id;
                $nestedData['wh_name'] = @$row->wh_name;
                $nestedData['material_id'] = @$row->material_id;
				$nestedData['material_name'] = @$row->material_name;
                $nestedData['stock_nok'] = $row->stock_nok;
                
                $reserved_qty = 0;
                if($row->reserved_qty != null){
                    $reserved_qty = $row->reserved_qty;
                }
                $nestedData['reserved_qty'] = $reserved_qty;
                if(session()->get('user_type') == 1){
                    $nestedData['stock_ok'] = $row->stock_ok - $reserved_qty;
                } else {
                    $nestedData['stock_ok'] = $row->stock_ok;
                }
                
                
                
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
		$fields = array('warehouse_id', 'wh_name', 'material_id', 'material_name', 'stock_ok', 'stock_nok', 'reserved_qty');
		// $fields = array('warehouse_id', 'material_id', 'stock_ok', 'stock_nok');
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

    public function topup()
    {
        $data = [
            'title' => 'Top Up',
			'title_menu' => 'topup',
            'sidebar' => 'Top Up'
        ];

		echo view('layout/header', $data);
		echo view('topup/add_top', $data);
		echo view('layout/footer');
    }

    public function inventory(){
        $data = [
            'title' => 'Inventory',
            'title_menu' => 'inventory',
            'sidebar' => 'Inventory',
            'warehouse_marker' => $this->dashboard->get_warehouse()
        ];
        echo view('layout/header', $data);
        echo view('dashboard/dashboard_inventory', $data);
        echo view('layout/footer');
    }

    public function inventory_data(){
        $wh_id = $this->request->getGet('wh_id');
        $warehouse = $this->dashboard->find_warehouse($wh_id);
        if(@$warehouse){
            $data = [
                'warehouse' => $warehouse
            ];
            echo view('dashboard/dashboard_panel', $data);
        }else{
            echo '<strong>No data available</strong>';
        }
    }
}
?>