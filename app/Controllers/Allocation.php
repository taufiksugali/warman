<?php

namespace App\Controllers;
use App\Models\AllocationModel;
use App\Models\WarehouseModel;
use App\Models\MaterialModel;
use App\Models\CustomerModel;
use Config\Services;

class Allocation extends BaseController
{
    public function __construct()
    {
        $this->allocation = new AllocationModel();
        $this->warehouse = new WarehouseModel();
        $this->material = new MaterialModel();
        $this->customer = new CustomerModel();

        helper(['form', 'url', 'my']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index(){
        $data = [
            'title' => 'Allocation Plan',
            'title_menu' => 'Allocation Plan',
            'sidebar' => 'Allocation Plan'
        ];	

		echo view('layout/header', $data);
		echo view('allocation/allocation_data', $data);
		echo view('layout/footer');
    }

    public function getData(){

        $columns = array( 
            0 => 'plan_id',
            1 => 'customer.customer_name',
            2 => 'warehouse.warehouse_name',
            3 => 'material.material_name',
            4 => 'allocation_plan.plan_qty',
            5 => 'uom.uom_name',
            6 => 'allocation_plan.plan_date'
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        $totalData = $this->allocation->all_allocation_count();
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $allocation = $this->allocation->all_allocation($limit, $start, $order, $dir);
        } else {
            $search = $this->request->getPost('search')['value']; 
            $allocation = $this->allocation->search_allocation($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->allocation->search_allocation_count($search);
        }

        $data = array();
        if(@$allocation) {
            foreach ($allocation as $row) {
                $start++;

                if(@$row->status == 1) {
                    $plan_status = '<span class="label label-light-success label-pill label-inline mr-2">Active</span>';
                } else { 
                    $plan_status = '<span class="label label-light-danger label-pill label-inline mr-2">Inactive</span>';
                }

                $nestedData['number'] = $start;
                $nestedData['customer_name'] = @$row->customer_name;
                $nestedData['wh_name'] = @$row->wh_name;
                $nestedData['material_name'] = @$row->material_name;
                $nestedData['plan_qty'] = @$row->plan_qty;
                $nestedData['uom_name'] = @$row->uom_name;
                $nestedData['plan_date'] = date('d-m-Y', strtotime(@$row->plan_date));
                $nestedData['status'] = $plan_status;
                $nestedData['action'] = '<a href="'.base_url('blok/edit/'.@$row->plan_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Edit"><span class="svg-icon svg-icon-warning svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                    <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                </g>
                </svg></span></a>
                <button class="btn btn-sm btn-clean btn-icon mr-1" id="delete_blok" data-id="'.@$row->plan_id.'" title="Delete"><span class="svg-icon svg-icon-danger svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                    <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                </g>
                </svg></span></button>';
                
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
		$fields = array('customer_name', 'material_name', 'plan_qty', 'uom_name', 'wh_name',  'plan_date');
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
        $columns[] = array(
			'data' => 'status',
			'className' => 'text-center'
		);
		$columns[] = array(
			'data' => 'action',
			'className' => 'text-center text-nowrap'
		);
		echo json_encode($columns); 
	}

    public function add()
	{
		$data = [
            'title' => 'Add Allocation Plan',
            'title_menu' => 'Allocation Plan',
            'sidebar' => 'Allocation Plan'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'warehouse' => $this->warehouse->get_all_warehouse(),
            'material' => $this->material->get_all_material(),
            'customer' => $this->customer->get_all_customer()
		];
		echo view('layout/header', $data);
		echo view('allocation/add_allocation', $dataObject);
		echo view('layout/footer');
	}

    public function create(){
        $data = [
            'title' => 'Add Allocation Plan',
            'sidebar' => 'Allocation Plan'
        ];

        $validate = $this->validate([
            'warehouse_id' => ['label' => 'Warehouse Name', 'rules' => 'required'],
            'customer_id' => ['label' => 'Customer Name', 'rules' => 'required'],
            'material_id' => ['label' => 'Material Name', 'rules' => 'required'],
            'plan_qty' => ['label' => 'Plan Qty', 'rules' => 'required'],
            'plan_date' => ['label' => 'Plan Date', 'rules' => 'required'],
        ]);

        if (!$validate) {
            return redirect()->to(base_url('/allocation/add'))->withInput();
        } else{
            $id = $this->allocation->generate_id();

            $data_allocation = [
                'plan_id' => $id,
                'wh_tujuan' => $this->request->getPost('warehouse_id'),
                'customer_id' => $this->request->getPost('customer_id'),
                'material_id' => $this->request->getPost('material_id'),
                'plan_qty' => $this->request->getPost('plan_qty'),
                'plan_date' => date_format(date_create($this->request->getPost('plan_date')), 'Y-m-d'),
                'status' => 1,
                'create_date' => date('Y-m-d H:i:s'),
                'create_by' => session()->get('fullname')
            ];

            $this->allocation->insert_data($data_allocation);
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Allocation successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('allocation'));
        }
    }
}
?>