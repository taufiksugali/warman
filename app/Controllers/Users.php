<?php

namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\WarehouseModel;
use App\Models\LevelModel;
use Config\Services;

class Users extends BaseController
{
    public function __construct()
    {
        $this->users = new UsersModel();
        $this->warehouse = new WarehouseModel();
        $this->level = new LevelModel();

        helper(['form', 'url', 'my']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index(){
        $data = [
            'title' => 'Users',
            'title_menu' => 'Users',
            'sidebar' => 'Users'
        ];	

		echo view('layout/header', $data);
		echo view('users/users', $data);
		echo view('layout/footer');
    }

    public function getData(){
        if(session()->get('user_type') == 1){ 
            $columns = array( 
                0 => 'user_id',
                1 => 'user_id',
                2 => 'user_id',
                3 => 'fullname',
                4 => 'email',
                5 => 'level_id'
            );
        }else {
            $columns = array( 
                0 => 'user_id',
                1 => 'user_id',
                2 => 'user_id',
                3 => 'fullname',
                4 => 'company',
                5 => 'email',
                6 => 'phone',
                7 => 'level_id',
                8 => 'warehouse_id'
            );
        }

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        $totalData = $this->users->all_users_count();
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $users = $this->users->all_users($limit, $start, $order, $dir);
        } else {
            $search = $this->request->getPost('search')['value']; 
            $users = $this->users->search_users($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->users->search_users_count($search);
        }

        $data = array();
        if(@$users) {
            foreach ($users as $row) {
                $start++;

                if(@$row->status == 1) {
                    $users_status = '<span class="label label-light-success label-pill label-inline mr-2">Active</span>';
                    if(session()->get('user_type') == 1) {
                        $nestedData['action'] = '<a href="'.base_url('users/edit/'.@$row->user_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Edit"><span class="svg-icon svg-icon-warning svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                        </g>
                        </svg></span></a>
                        <button class="btn btn-sm btn-clean btn-icon mr-1" id="delete" data-id="'.@$row->user_id.'" title="Deactivate"><span class="svg-icon svg-icon-danger svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                            <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                        </g>
                        </svg></span></button>';
                    } else {
                        if(session()->get('level_id') == 'LV001') {
                            $nestedData['action'] = '<a href="'.base_url('users/edit/'.@$row->user_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Edit"><span class="svg-icon svg-icon-warning svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                                <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            </g>
                            </svg></span></a>
                            <button class="btn btn-sm btn-clean btn-icon mr-1" id="delete" data-id="'.@$row->user_id.'" title="Deactivate"><span class="svg-icon svg-icon-danger svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                            </g>
                            </svg></span></button>';
                        } else {
                            $nestedData['action'] = '';
                        }
                    }
                } else { 
                    $users_status = '<span class="label label-light-danger label-pill label-inline mr-2">Inactive</span>';
                    $nestedData['action'] = '<a href="'.base_url('users/edit/'.@$row->user_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Edit"><span class="svg-icon svg-icon-warning svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                    </g>
                    </svg></span></a>';
                    if(session()->get('user_type') == 1) {
                        $nestedData['action'] = '<a href="'.base_url('users/edit/'.@$row->user_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Edit"><span class="svg-icon svg-icon-warning svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                        </g>
                        </svg></span></a>';
                    } else {
                        if(session()->get('level_id') == 'LV001') {
                            $nestedData['action'] = '<a href="'.base_url('users/edit/'.@$row->user_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Edit"><span class="svg-icon svg-icon-warning svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                                <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            </g>
                            </svg></span></a>';
                        } else {
                            $nestedData['action'] = '';
                        }
                    }
                }

                // $city_name = $this->users->get_city_name(@$row->company);
                if(!empty(@$row->wh_name)){
                    $wh_name = @$row->wh_name;
                }else {
                    $wh_name = "-";
                }
                $nestedData['number'] = $start;
                $nestedData['fullname'] = @$row->fullname;
                if(session()->get('user_type') != 1){ 
                    $nestedData['warehouse_id'] = $wh_name;
                    $nestedData['company'] = @$row->owners_name;
                    $nestedData['phone'] = @$row->phone;
                }
                $nestedData['email'] = @$row->email;
                $nestedData['level_id'] = @$row->level_name;
                $nestedData['status'] = $users_status;
               
                
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
        if(session()->get('user_type') == 0){ 
		    $fields = array('fullname', 'company', 'email', 'phone', 'level_id', 'warehouse_id');
        } else {
		    $fields = array('fullname', 'email', 'level_id');
        }
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
            'title' => 'users',
            'title_menu' => 'Add users',
            'sidebar' => 'users'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'warehouse' => $this->warehouse->get_all_warehouse(),
            'level' => $this->level->get_all_level(),
		];
		echo view('layout/header', $data);
		echo view('users/add_users', $dataObject);
		echo view('layout/footer');
	}

    public function create(){
        $data = [
            'title' => 'Add users',
            'sidebar' => 'users'
        ];

        if(session()->get('user_type') == 1){ 
            $validate = $this->validate([
                'fullname' => ['label' => 'Full Name', 'rules' => 'required'],
                // 'company' => ['label' => 'Company', 'rules' => 'required'],
                'email' => ['label' => 'Email', 'rules' => 'required'], // bikin unique
                'level_id' => ['label' => 'Level', 'rules' => 'required']
                // 'warehouse_id' => ['label' => 'Warehouse', 'rules' => 'required']
            ]);
        } else {
            $validate = $this->validate([
                'fullname' => ['label' => 'Full Name', 'rules' => 'required'],
                'company' => ['label' => 'Company', 'rules' => 'required'],
                'email' => ['label' => 'Email', 'rules' => 'required'],
                'level_id' => ['label' => 'Level', 'rules' => 'required'],
                'warehouse_id' => ['label' => 'Warehouse', 'rules' => 'required']
            ]);   
        }

        if (!$validate) {
            return redirect()->to(base_url('/users/add'))->withInput();
        } else{
            $id = $this->users->generate_id();
            if(session()->get('user_type') == 1){ 
                $user_type = 1;
                $data_users = [
                    'user_id' => $id,
                    'fullname' => $this->request->getPost('fullname'),
                    'email' => $this->request->getPost('email'),
                    'level_id' => $this->request->getPost('level_id'),
                    'phone' => $this->request->getPost('phone'),
                    'password' => hash('sha256', $this->request->getPost('password')),
                    'email_verification' => 1,
                    'status' => $this->request->getPost('status'),
                    'req_reset_pass' => 0,
                    'created_time' => date('Y-m-d H:i:s'),
                    'owners_id' => session()->get('owners_id'),
                    'user_type' => $user_type
                ];
            } else {
                $user_type = 0;
                $data_users = [
                    'user_id' => $id,
                    'fullname' => $this->request->getPost('fullname'),
                    'company' => $this->request->getPost('company'),
                    'email' => $this->request->getPost('email'),
                    'level_id' => $this->request->getPost('level_id'),
                    'phone' => $this->request->getPost('phone'),
                    'password' => hash('sha256', $this->request->getPost('password')),
                    'email_verification' => 1,
                    'status' => $this->request->getPost('status'),
                    'req_reset_pass' => 0,
                    'created_time' => date('Y-m-d H:i:s'),
                    'warehouse_id' => $this->request->getPost('warehouse_id'),
                    'user_type' => $user_type
                ];
            }
            

            $this->users->insert_data($data_users);
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">User successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('users'));
        }
    }

    public function edit($id)
	{
		$data = [
            'title' => 'users',
            'title_menu' => 'Edit users',
            'sidebar' => 'users'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'warehouse' => $this->warehouse->get_all_warehouse(),
            'level' => $this->level->get_all_level(),
            'users' => $this->users->get_users_byid($id)
		];
		echo view('layout/header', $data);
		echo view('users/edit_users', $dataObject);
		echo view('layout/footer');
	}

    public function update(){
        $data = [
            'title' => 'Edit users',
            'sidebar' => 'users'
        ];

        if(session()->get('user_type') == 1){ 
        $validate = $this->validate([
            'fullname' => ['label' => 'Full Name', 'rules' => 'required'],
            // 'company' => ['label' => 'Company', 'rules' => 'required'],
            'email' => ['label' => 'Email', 'rules' => 'required'],
            'level_id' => ['label' => 'Level', 'rules' => 'required'],
            // 'warehouse_id' => ['label' => 'Warehouse', 'rules' => 'required'],
            'status' => ['label' => 'Status', 'rules' => 'required']
        ]);
        } else {
            $validate = $this->validate([
                'fullname' => ['label' => 'Full Name', 'rules' => 'required'],
                'company' => ['label' => 'Company', 'rules' => 'required'],
                'email' => ['label' => 'Email', 'rules' => 'required'],
                'level_id' => ['label' => 'Level', 'rules' => 'required'],
                'warehouse_id' => ['label' => 'Warehouse', 'rules' => 'required'],
                'status' => ['label' => 'Status', 'rules' => 'required']
            ]);
        }
        $id = $this->request->getPost('user_id');

        if (!$validate) {
            return redirect()->to(base_url('/users/edit'. $id))->withInput();
        } else{
            if(session()->get('user_type') == 1){ 
                $data_users = [
                    'fullname' => $this->request->getPost('fullname'),
                    // 'company' => $this->request->getPost('company'),
                    'email' => $this->request->getPost('email'),
                    'level_id' => $this->request->getPost('level_id'),
                    'phone' => $this->request->getPost('phone'),
                    'password' => hash('sha256', $this->request->getPost('password')),
                    'status' => $this->request->getPost('status'),
                    'updated_time' => date('Y-m-d H:i:s')
                ];
            } else {
                $data_users = [
                    'fullname' => $this->request->getPost('fullname'),
                    'company' => $this->request->getPost('company'),
                    'email' => $this->request->getPost('email'),
                    'level_id' => $this->request->getPost('level_id'),
                    'phone' => $this->request->getPost('phone'),
                    'password' => hash('sha256', $this->request->getPost('password')),
                    'status' => $this->request->getPost('status'),
                    'updated_time' => date('Y-m-d H:i:s'),
                    'warehouse_id' => $this->request->getPost('warehouse_id')
                ];
            }

            $this->users->update_data($id, $data_users);
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">users successfully updated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('users'));
        }
    }

    public function get_regency()
	{
		$ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $GLOBALS['hris'] . 'api/Hris_Api/getAllRegency?token=0a05252241f3bc45ffc4abaeca369963');
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result     = curl_exec ($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $dataObject = json_decode($result);

		return @$dataObject->data;
	}

    public function delete(){
        $id = $this->request->getGet('id');
        // var_dump($id);
        // exit;
        $data = [
            'status' => 0
        ];

        $result = $this->users->update_data($id, $data);
        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Owner successfully inactivated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('blok'));
    }
}
?>