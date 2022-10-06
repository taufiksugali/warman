<?php

namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\DashboardModel;
use App\Models\TopupModel;
use App\Models\OwnersModel;
use App\Models\BankModel;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Topup extends BaseController
{
	public function __construct()
    {
        $this->dashboard = new DashboardModel();
        $this->topup = new TopupModel();
        $this->owners = new OwnersModel();
        $this->bank = new BankModel();

        helper(['form', 'url', 'my']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index()
	{
        $data = [
            'title' => 'Top Up',
			'title_menu' => 'topup',
            'sidebar' => 'Top Up'
        ];	

		echo view('layout/header', $data);
		echo view('topup/topup_data', $data);
		echo view('layout/footer');
	}

	public function getData(){

        $columns = array( // ini adalah column ordernya, pake nama kolom yang di database
            0 => 'topup_id',
            1 => 'topup_name',
            2 => 'owners_id',
            3 => 'bank_id',
            4 => 'topup_date',
            5 => 'payment_method',
            6 => 'topup_amount',
            7 => 'dest_name',
			8 => 'topup_proof'
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        $totalData = $this->topup->all_topup_count();
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $topup = $this->topup->all_topup($limit, $start, $order, $dir);
        } else {
            $search = $this->request->getPost('search')['value']; 
            $topup = $this->topup->search_topup($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->topup->search_topup_count($search);
        }

        $data = array();
        $i = 0;
        if(@$topup) {
            foreach ($topup as $row) {
                $start++;
                if(@$row->topup_status == 1) {
                    $topup_status = '<span class="label label-light-success label-pill label-inline mr-2">Approved</span>';
                } elseif(@$row->topup_status == 2) {
                    $topup_status = '<span class="label label-light-danger label-pill label-inline mr-2">Rejected</span>';
                } elseif (@$row->topup_status == 3) {
                    $topup_status = '<span class="label label-light-danger label-pill label-inline mr-2">Expired</span>';
                } elseif(@$row->topup_status == 5) {
                    $topup_status = '<span class="label label-light-info label-pill label-inline mr-2">Paid</span>';
                } elseif(@$row->topup_status == 6) {
                    $topup_status = '<span class="label label-light-danger label-pill label-inline mr-2">Rejected</span>';
                } else { 
                    $topup_status = '<span class="label label-light-warning label-pill label-inline mr-2">Waiting</span>';
                }

                if(@$row->topup_proof){
                    $proof = '<a href="'.base_url('../images/topup-proof/'.@$row->owners_id.'/'.$row->topup_proof).'" target="_blank" class="btn btn-sm btn-clean btn-icon mr-1" title="View Proof"><span class="svg-icon svg-icon-primary svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <rect fill="#000000" opacity="0.3" x="2" y="4" width="20" height="16" rx="2"/>
                            <polygon fill="#000000" opacity="0.3" points="4 20 10.5 11 17 20"/>
                            <polygon fill="#000000" points="11 20 15.5 14 20 20"/>
                            <circle fill="#000000" opacity="0.3" cx="18.5" cy="8.5" r="1.5"/>
                        </g>
                    </svg></span></a>';
                }else {
                    $proof = '';
                }

                $owners_account = "";
                if($row->topup_va != null and $row->topup_va != ""){
                    $owners_account = @$row->topup_va . " (Virtual Account)";
                } else {
                    $owners_account = @$this->bank->get_bank_byid(@$row->bank_id)->account_number;
                }
                $nestedData['number'] = $start;
                $nestedData['owners_id'] = @$row->owners_name;
                $nestedData['topup_name'] = @$row->topup_name;
                $nestedData['bank_id'] = @$row->bank_name.' - '.$owners_account;
                $nestedData['topup_amount'] = number_format(@$row->topup_amount);
                if(@$row->topup_status > 3){
                    $dest = $this->bank->get_bank_byid(@$row->dest_id);
                    $dest_account = $dest->account_number;
                    $dest_name = $dest->account_name;
                    $nestedData['dest_name'] = @$dest_name.' - '.@$dest_account;
                } else {
                    $nestedData['dest_name'] = @$row->dest_name.' - '.@$row->dest_account;
                }
                $nestedData['topup_date'] = date_format(date_create(@$row->topup_date), 'd-m-Y');
                $nestedData['payment_method'] = (@$row->topup_va != NULL ? 'Virtual Account' : 'Bank Transfer');
                $nestedData['topup_proof'] = $proof;
                $nestedData['status'] = $topup_status;
                if(@$row->topup_status < 4) {
                    $nestedData['category'] = '<span class="label label-light-primary label-pill label-inline mr-2">Top Up</span>';
                } else {
                    $nestedData['category'] = '<span class="label label-default label-pill label-inline mr-2">Withdraw</span>';
                }
                if(@$row->topup_status == 0 && @$row->topup_va == NULL) {
                    $nestedData['action'] = '
                    <button class="btn btn-sm btn-clean btn-icon mr-1" id="approve_topup" data-id="'.@$row->topup_id.'" title="Approve"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                    <path d="M16.7689447,7.81768175 C17.1457787,7.41393107 17.7785676,7.39211077 18.1823183,7.76894473 C18.5860689,8.1457787 18.6078892,8.77856757 18.2310553,9.18231825 L11.2310553,16.6823183 C10.8654446,17.0740439 10.2560456,17.107974 9.84920863,16.7592566 L6.34920863,13.7592566 C5.92988278,13.3998345 5.88132125,12.7685345 6.2407434,12.3492086 C6.60016555,11.9298828 7.23146553,11.8813212 7.65079137,12.2407434 L10.4229928,14.616916 L16.7689447,7.81768175 Z" fill="#000000" fill-rule="nonzero"/>
                    </g>
                    </svg></span></button>
                    <a onclick="modal_reject('.$i.')"  class="btn btn-sm btn-clean btn-icon mr-1" title="Edit"><span class="svg-icon svg-icon-danger svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                    <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                    </g>
                    </svg></span></a><input type="text" hidden="true" id="topupReject'.@$i.'" value="'.@$row->topup_id.'"/>';

                } elseif(@$row->topup_status == 4 && @$row->topup_va == NULL) {
                    $nestedData['action'] = '
                    <button class="btn btn-sm btn-clean btn-icon mr-1" id="approve_topup" data-id="'.@$row->topup_id.'" title="Approve"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                    <path d="M16.7689447,7.81768175 C17.1457787,7.41393107 17.7785676,7.39211077 18.1823183,7.76894473 C18.5860689,8.1457787 18.6078892,8.77856757 18.2310553,9.18231825 L11.2310553,16.6823183 C10.8654446,17.0740439 10.2560456,17.107974 9.84920863,16.7592566 L6.34920863,13.7592566 C5.92988278,13.3998345 5.88132125,12.7685345 6.2407434,12.3492086 C6.60016555,11.9298828 7.23146553,11.8813212 7.65079137,12.2407434 L10.4229928,14.616916 L16.7689447,7.81768175 Z" fill="#000000" fill-rule="nonzero"/>
                    </g>
                    </svg></span></button>
                    <button class="btn btn-sm btn-clean btn-icon mr-1" id="reject_topup" data-id="'.@$row->topup_id.'" title="Reject"><span class="svg-icon svg-icon-danger svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                    <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                    </g>
                    </svg></span></button>';
                } else { 
                    $nestedData['action'] = '';
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
		$fields = array('owners_id', 'topup_name', 'bank_id', 'topup_amount', 'dest_name', 'topup_date', 'payment_method', 'topup_proof');
		$columns[] = array(
			'data' => 'number',
			'className' => 'text-center'
		);
        $columns[] = array(
            'data' => 'action',
            'className' => 'text-center text-nowrap'
        );
        $columns[] = array(
            'data' => 'category',
            'className' => 'text-center'
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
            'title' => 'Top Up',
			'title_menu' => 'topup',
            'sidebar' => 'Top Up'
        ];

        $this->update_va();
        $dataObject = [
            'bank' => $this->topup->get_all_bank(),
            'owners_bank' => $this->topup->get_bank_byOwner(session()->get('owners_id')),
            'bank_dest' => $this->topup->get_bank_dest(),
            'topup' => $this->topup->get_topup_byownersid(session()->get('owners_id')),
            'get_topup_byid2' => $this->topup->get_topup_byid2(@$this->request->getGet('idva')),
			'validation' => \Config\Services::validation()
		];
		echo view('layout/header', $data);
		echo view('topup/add_topup', $dataObject);
		echo view('layout/footer');
	}

    public function invoice() {
        $data = [
            'title' => 'Top Up',
			'title_menu' => 'topup',
            'sidebar' => 'Top Up'
        ];
        $get_topup_byid2 = $this->topup->get_topup_byid2(@$this->request->getGet('idva'));
        if ($get_topup_byid2 != NULL) {
            $dataObject = [
                'bank' => $this->topup->get_all_bank(),
                'bank_dest' => $this->topup->get_bank_dest(),
                'topup' => $this->topup->get_topup_byownersid(session()->get('owners_id')),
                'get_topup_byid2' => $get_topup_byid2,
                'validation' => \Config\Services::validation()
            ];
            echo view('layout/header', $data);
            echo view('topup/invoice_topup', $dataObject);
            echo view('layout/footer');
        }else{
            return redirect()->to(base_url('dashboard_seller'));
        }
	}

    public function add_withdraw()
	{
        $data = [
            'title' => 'Withdraw',
			'title_menu' => 'withdraw',
            'sidebar' => 'Withdraw'
        ];

        $dataObject = [
            'bank' => $this->topup->get_all_bank(),
            'owners_bank' => $this->topup->get_bank_byOwner(session()->get('owners_id')),
            'topup' => $this->topup->get_topup_byownersid_withdraw(session()->get('owners_id')),
			'validation' => \Config\Services::validation()
		];
		echo view('layout/header', $data);
		echo view('topup/add_withdraw', $dataObject);
		echo view('layout/footer');
	}

    public function create(){
        $data = [
            'title' => 'Topup',
            'sidebar' => 'Topup'
        ];
        
        $validate = $this->validate([
            'bank_id' => ['label' => 'From Account', 'rules' => 'required'],
            'dest_account' => ['label' => 'To Account', 'rules' => 'required'],
            'topup_name' => ['label' => 'From Account', 'rules' => 'required'],
            'topup_date' => ['label' => 'Date', 'rules' => 'required'],
            'topup_amount' => ['label' => 'Amount', 'rules' => 'required'],
            'topup_proof' =>  ['label' => 'File', 'rules' => 'permit_empty|ext_in[file,png,jpg]|max_size[file,10000]'],                
        ]);

        if (!$validate) {
            return redirect()->to(base_url('/topup/add'))->withInput();
        } else{
            $id = $this->topup->generate_id();
            
            $owners_account = $this->topup->get_bank_byOwner(session()->get('owners_id'));
            if($owners_account == null || $owners_account ==""){
                session()->setFlashdata('message', '<div class="alert alert-custom alert-light-warning fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Your bank account is not yet available, please complete it in <a href="'.base_url('owners/editSeller/'.session()->get('owners_id')).'">your profile</a> first.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
                return redirect()->to(base_url('/topup/add'))->withInput();
            }

            $topup_photo = $this->request->getFile('topup_proof');
            if($topup_photo != '') {
                if(is_dir('../public/images/topup-proof/'.session()->get('owners_id')) == false){
                    mkdir('../public/images/topup-proof/'.session()->get('owners_id'));
                }
                $topup_photo_name = $topup_photo->getRandomName();
                $topup_photo->move('../public/images/topup-proof/'.session()->get('owners_id'), $topup_photo_name);
            } else {
                $topup_photo_name = NULL;
            }

            $data_owner = [
                'topup_id' => $id,
                'topup_name' => $this->request->getPost('topup_name'),
                'bank_id' => $this->request->getPost('bank_id'),
                'dest_id' => str_replace(",", "",$this->request->getPost('dest_account')),
                'owners_id' => session()->get('owners_id'),
                'topup_date' => date_format(date_create($this->request->getPost('topup_date')), 'Y-m-d'),
                'topup_amount' => str_replace(",", "",$this->request->getPost('topup_amount')),
                'topup_proof' => $topup_photo_name,
                'topup_status' => 0,
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => session()->get('fullname')
            ];

            $this->topup->insert_data($data_owner);
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Topup success.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
            return redirect()->to(base_url('dashboard_seller'));
        }
    }

    public function create_withdraw(){
        $data = [
            'title' => 'Topup',
            'sidebar' => 'Topup'
        ];

        $validate = $this->validate([
            // 'topup_name' => ['label' => 'Topup Name', 'rules' => 'required'],
            'topup_amount' => ['label' => 'Topup Amount', 'rules' => 'required'],
            // 'topup_proof' =>  ['label' => 'File', 'rules' => 'permit_empty|ext_in[file,png,jpg]|max_size[file,10000]'],
            'owners_bank_id' => ['label' => 'Bank', 'rules' => 'required'],
            // 'topup_date' => ['label' => 'Topup Date', 'rules' => 'required']
        ]);

        if (!$validate) {
            return redirect()->to(base_url('/topup/add_withdraw'))->withInput();
        } else{
            $id = $this->topup->generate_id();
            
            // $topup_photo = $this->request->getFile('topup_proof');
            // if($topup_photo != '') {
            //     if(is_dir('../public/images/topup-proof/'.session()->get('owners_id')) == false){
            //         mkdir('../public/images/topup-proof/'.session()->get('owners_id'));
            //     }
            //     $topup_photo_name = $topup_photo->getRandomName();
            //     $topup_photo->move('../public/images/topup-proof/'.session()->get('owners_id'), $topup_photo_name);
            // } else {
                $topup_photo_name = NULL;
            // }
            // print_r($topup_photo);
            // die;
            $topup_amount = str_replace(",", "",$this->request->getPost('topup_amount'));
            $owners_balance = str_replace(",", "",$this->request->getPost('owners_balance'));
            $min_result = $owners_balance - $topup_amount;
            
            $owners_account = $this->owners->get_owner_byid($this->request->getPost('owners_id'))->owners_account;
            // $bank_id = $this->bank->get_bank_byid($this->request->getPost('owners_bank_id'))->bank_id;

            // $bank_id = $this->owners->get_owner_byid($this->request->getPost('owners_id'))->bank_id;
            if($topup_amount > $owners_balance || $min_result < 100000){
                session()->setFlashdata('message', '<div class="alert alert-custom alert-light-warning fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Your Balance is not enough to do this transaction.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
                return redirect()->to(base_url('/topup/add_withdraw'))->withInput();
            }
            // if($owners_account == null || $owners_account ==""){
            //     session()->setFlashdata('message', '<div class="alert alert-custom alert-light-warning fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Your Account has not been registerd yet. Please Register your Bank Account at Edit Seller Data.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
            //     return redirect()->to(base_url('/topup/add_withdraw'))->withInput();
            // }
            
            $withdraw_status = $this->topup->check_withdraw($this->request->getPost('owners_id'));
            
            if($withdraw_status > 0){
                session()->setFlashdata('message', '<div class="alert alert-custom alert-light-warning fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Your Previous Withdraw is has not been approved yet.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
                return redirect()->to(base_url('/topup/add_withdraw'))->withInput(); 
            }


            $poslog_bank = 5;
            
            $data_owner = [
                'topup_id' => $id,
                'topup_name' => session()->get('fullname'),
                'bank_id' => $poslog_bank,
                'owners_id' => $this->request->getPost('owners_id'),
                'topup_date' => date('Y-m-d'),
                'topup_amount' => $topup_amount,
                'dest_id' => $this->request->getPost('owners_bank_id'),
                'topup_status' => 4,
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => session()->get('fullname')
            ];

            $this->topup->insert_data($data_owner);
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Withdraw has been requested.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('dashboard_seller'));
        }
    }

    public function approve(){
        $id = $this->request->getGet('topup_id');
        // var_dump($id);
        // exit;
        $topup_status = $this->topup->get_topup_byid($id)->topup_status;
        if($topup_status == 4){
            $data = [
                'topup_status' => 5
            ];
        }else {
            $data = [
                'topup_status' => 1
            ];
        }

        $owners_id = $this->topup->get_topup_byid($id)->owners_id;
        $topup_amount = $this->topup->get_topup_byid($id)->topup_amount;
        $owners_balance = $this->owners->get_owner_byid($owners_id)->owners_balance;
        
        if($topup_status == 4){
            $balance_updated = $owners_balance - $topup_amount;
        } else {
            $balance_updated = $topup_amount + $owners_balance;
        }

        $data_owner = [
            'owners_balance' => $balance_updated
        ];

        $result = $this->topup->update_data($id, $data);
        
        $resultOwners = $this->owners->update_data($owners_id, $data_owner);
        // $session->push('owners_balance', $balance_updated);

        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Owner successfully inactivated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('topup'));
    }

    public function reject(){
        $id = $this->request->getGet('topup_id');
        // var_dump($id);
        // exit;
        $topup_status = $this->topup->get_topup_byid($id)->topup_status;
        if($topup_status == 4){
            $data = [
                'topup_status' => 6
            ];
        }else {
            $data = [
                'topup_status' => 2
            ];
        }

        $result = $this->topup->update_data($id, $data);
        $topup_amount = $this->topup->get_topup_byid($id)->topup_amount;

        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Owner successfully inactivated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('topup'));
    }

    public function get_information_bank() {
        $owners_account_bank = $this->request->getGet('bank_id');
        $dataObject = [
            'owners_account_bank' => $this->topup->get_account_byOwner($owners_account_bank), 
			'validation' => \Config\Services::validation()
		];
		
        echo view('topup/information_bank_topup', $dataObject);
    } 

    public function test() {
        echo $this->topup->generate_va_number()->VA_NUMBER;
    }

    public function bank_transaction() {
        $id = @$this->request->getGet('id');
        $data = [
            'bank_dest_account' => $this->topup->get_byid_bank_dest($id)
        ];
        echo view('topup/informastion_transaction', $data);
    }

    public function get_topup_byId(){
        $post = $this->request->getPost('topup_id[]');

        $data = [
            'topup' => $this->topup->get_topup_byId($post)
        ];

        echo view('topup/topup_reject', $data);
    }

    public function rejectTopup(){
        $id = $this->request->getPost('id_topup_reject');
        // var_dump($id);
        // exit;
        $data = [
            'topup_status' => 2,
            'topup_remark' => $this->request->getPost('topup_remark')
        ];
        //var_dump($data); die();
        $result = $this->topup->update_data($id, $data);
        $topup_amount = $this->topup->get_topup_byid($id)->topup_amount;

        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Top up has been successfully rejected.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('topup'));
    }

    public function update_va() {
        $topup = $this->topup->get_topup_byownersid(session()->get('owners_id'));
        foreach ($topup as $key => $value) {
            $waktu_proses1 = date_create($value->created_date);
            $waktu_proses2 = date_create(date("Y-m-d H:i:s"));
            $diff_date = date_diff($waktu_proses1, $waktu_proses2);
            if($value->topup_status == 0 && @$diff_date->h >= 1 && $value->topup_va != NULL) {
                $id = $value->topup_id;
                $data = [
                    'topup_status' => 3
                ];
                $this->topup->update_data($id, $data);
            }
        }
    }

}
?>