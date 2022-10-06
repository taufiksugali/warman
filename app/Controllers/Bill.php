<?php

namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\DashboardModel;
use App\Models\TopupModel;
use App\Models\BillModel;
use App\Models\OwnersModel;
use App\Models\OutboundpoModel;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Bill extends BaseController
{
	public function __construct()
    {
        $this->dashboard = new DashboardModel();
        $this->topup = new TopupModel();
        $this->bill = new BillModel();
        $this->owners = new OwnersModel();
        $this->outbound = new OutboundpoModel();

        helper(['form', 'url', 'my']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index()
	{
        $data = [
            'title' => 'Bill',
			'title_menu' => 'bill',
            'sidebar' => 'Bill'
        ];	

		echo view('layout/header', $data);
		echo view('bill/bill_data', $data);
		echo view('layout/footer');
	}

	public function getData(){

        $columns = array( // ini adalah column ordernya, pake nama kolom yang di database
            0 => 'bill_id',
            1 => 'owners_id',
            2 => 'description',
            3 => 'amount',
            4 => 'created_date',
            5 => 'bill_status',
			6 => 'ref_id',
			7 => 'po_id'
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        $totalData = $this->bill->all_bill_count();
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $bill = $this->bill->all_bill($limit, $start, $order, $dir);
        } else {
            $search = $this->request->getPost('search')['value']; 
            $bill = $this->bill->search_bill($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->bill->search_bill_count($search);
        }

        $data = array();
        if(@$bill) {
            foreach ($bill as $row) {
                $start++;
                if(@$row->bill_status == 1) {
                    $bill_status = '<span class="label label-light-success label-pill label-inline mr-2">Approved</span>';
                } elseif(@$row->bill_status == 2) {
                    $bill_status = '<span class="label label-light-danger label-pill label-inline mr-2">Rejected</span>';
                } else { 
                    $bill_status = '<span class="label label-light-warning label-pill label-inline mr-2">Waiting</span>';
                }
                
                $nestedData['number'] = $start;
                $nestedData['owners_id'] = @$row->owners_name;
                $nestedData['description'] = @$row->description;
                $nestedData['amount'] = number_format(@$row->amount);
                $nestedData['created_date'] = date_format(date_create(@$row->created_date), 'd-m-Y');
                $nestedData['ref_id'] = @$row->ref_id;
                $nestedData['po_id']= $row->po_id;
                $nestedData['status'] = $bill_status;
                if(@$row->bill_status == 2) {
                    $nestedData['action'] = '
                    <a href="'.base_url('bill/edit/'.@$row->bill_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Edit"><span class="svg-icon svg-icon-warning svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                    </g>
                    </svg></span></a>';
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
		$fields = array('owners_id', 'description', 'amount', 'created_date', 'ref_id', 'po_id');
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

    public function edit($id)
	{
        $data = [
            'title' => 'Top Up',
			'title_menu' => 'topup',
            'sidebar' => 'Top Up'
        ];

        $dataObject = [
            'bill' => $this->bill->get_bill_byid($id),
			'validation' => \Config\Services::validation()
		];

		echo view('layout/header', $data);
		echo view('bill/edit_bill', $dataObject);
		echo view('layout/footer');
	}

    public function update(){
        $data = [
            'title' => 'Topup',
            'sidebar' => 'Topup'
        ];

        $validate = $this->validate([
            'amount' => ['label' => 'Bill Amount', 'rules' => 'required']
        ]);

        if (!$validate) {
            return redirect()->to(base_url('/bill/edit'))->withInput();
        } else{
            $id = $this->request->getPost('bill_id');
            
            // print_r($topup_photo);
            // die;
            $bill_amount = str_replace(",", "",$this->request->getPost('amount'));
            $data_owner = [
                'amount' => $bill_amount,
                'bill_status' => 0,
                'updated_date' => date('Y-m-d H:i:s'),
                'updated_by' => session()->get('fullname')
            ];

            // menghitung jumlah bill dengan id terlampir, apabila sudah < 1, update status po jadi sent lagi.
            $total_bill_id = $this->bill->bill_count_bystatus($this->request->getPost('po_id'));
            if($total_bill_id == 1){
                $data_outbound = [
                    'po_out_status' => 4
                ];
                $result_outbound = $this->outbound->update_data($this->request->getPost('po_id'), $data_outbound);
            }
            $this->bill->update_data($id, $data_owner);
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Bill updated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('bill'));
        }
    }



}
?>