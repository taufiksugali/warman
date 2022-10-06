<?php

namespace App\Controllers;

use App\Models\AgreementModel;
use App\Models\OwnersModel;
use App\Models\StateModel;
use App\Models\BankModel;
use App\Models\OwnersMarketModel;
use App\Models\UsersModel;
use Config\Services;

class Owners extends BaseController
{
    public function __construct()
    {
        $this->users = new UsersModel();
        $this->owners = new OwnersModel();
        $this->state = new StateModel();
        $this->bank = new BankModel(); 
        $this->market = new OwnersMarketModel(); 
        $this->agreement = new AgreementModel();


        helper(['form', 'url', 'my']);
    }

	public function index()
	{
		$data = [
            'title' => 'Owner',
            'title_menu' => 'Owner',
            'sidebar' => 'Owner'
        ];	

		echo view('layout/header', $data);
		echo view('owner/owner_data', $data);
		echo view('layout/footer');
    }

    public function getData(){

        $columns = array( 
            0 => 'owners_id',
            1 => 'owners_name',
            2 => 'state_id'
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        $totalData = $this->owners->all_owner_count();
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $owners = $this->owners->all_owner($limit, $start, $order, $dir);
        } else {
            $search = $this->request->getPost('search')['value']; 
            $owners = $this->owners->search_owner($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->owners->search_owner_count($search);
        }

        $data = array();
        if(@$owners) {
            foreach ($owners as $row) {
                $start++;

                if(@$row->owners_status == 1) {
                    $owners_status = '<span class="label label-light-success label-pill label-inline mr-2">Active</span>';
                } else { 
                    $owners_status = '<span class="label label-light-danger label-pill label-inline mr-2">Inactive</span>';
                }

                $prov = @$row->state_name;
                $city = @$row->city_name;
                
                $owners_city = $prov . ', '. $city;
                $nestedData['number'] = $start;
                $nestedData['owners_name'] = @$row->owners_name;
                $nestedData['state_id'] = $owners_city;
                $nestedData['owners_status'] = $owners_status;
                $nestedData['action'] = '<a href="'.base_url('owners/edit/'.@$row->owners_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Edit"><span class="svg-icon svg-icon-warning svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                    <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                </g>
                </svg></span></a>
                <button class="btn btn-sm btn-clean btn-icon mr-1" id="delete" data-id="'.@$row->owners_id.'" title="Delete"><span class="svg-icon svg-icon-danger svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
		$fields = array('owners_name', 'state_id');
		$columns[] = array(
			'data' => 'number',
			'className' => 'text-center'
		);
        $columns[] = array(
            'data' => 'action',
            'className' => 'text-center text-nowrap'
        );
        $columns[] = array(
            'data' => 'owners_status',
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
            'title' => 'Owner',
            'title_menu' => 'Add Owner',
            'sidebar' => 'Owner'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'state' => $this->state->getState()
		];
		echo view('layout/header', $data);
		echo view('owner/add_owner', $dataObject);
		echo view('layout/footer');
	}

    public function create(){
        $data = [
            'title' => 'Owner',
            'sidebar' => 'Owner'
        ];

        $validate = $this->validate([
            'owners_name' => ['label' => 'Owner Name', 'rules' => 'required'],
            'owners_address' => ['label' => 'Address', 'rules' => 'required'],
            'owners_latitude' => ['label' => 'Latitude', 'rules' => 'required'],
            'owners_longitude' => ['label' => 'Longitude', 'rules' => 'required'],
            'state_id' => ['label' => 'State', 'rules' => 'required'],
            'city_id' => ['label' => 'City', 'rules' => 'required'],
            'district_id' => ['label' => 'District', 'rules' => 'required'],
            'sdistrict_id' => ['label' => 'Sub District', 'rules' => 'required']
        ]);

        if (!$validate) {
            return redirect()->to(base_url('/owners/add'))->withInput();
        } else{
            $id = $this->owners->generate_id();

            $data_owner = [
                'owners_id' => $id,
                'owners_name' => $this->request->getPost('owners_name'),
                'owners_status' => 1,
                'create_date' => date('Y-m-d H:i:s'),
                'create_by' => session()->get('fullname'),
                'owners_address' => $this->request->getPost('owners_address'),
                'owners_latitude' => $this->request->getPost('owners_latitude'),
                'owners_longitude' => $this->request->getPost('owners_longitude'),
                'state_id' => $this->request->getPost('state_id'),
                'city_id' => $this->request->getPost('city_id'),
                'district_id' => $this->request->getPost('district_id'),
                'sdistrict_id' => $this->request->getPost('sdistrict_id')
            ];

            $this->owners->insert_data($data_owner);
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Seller successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('owners'));
        }
    }

    public function edit($id)
	{
		$data = [
            'title' => 'Owner',
            'title_menu' => 'Edit Owner',
            'sidebar' => 'Owner'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'owner' => $this->owners->get_owner_byid($id),
            'state' => $this->state->getState()
		];
		echo view('layout/header', $data);
		echo view('owner/edit_owner', $dataObject);
		echo view('layout/footer');
	}

    public function update(){
        $data = [
            'title' => 'Edit Owner',
            'sidebar' => 'Owner'
        ];

        $validate = $this->validate([
            'owners_name' => ['label' => 'Owner Name', 'rules' => 'required'],
            'status' => ['label' => 'Status', 'rules' => 'required'],
            'owners_address' => ['label' => 'Address', 'rules' => 'required'],
            'owners_latitude' => ['label' => 'Latitude', 'rules' => 'required'],
            'owners_longitude' => ['label' => 'Longitude', 'rules' => 'required'],
            'state_id' => ['label' => 'State', 'rules' => 'required'],
            'city_id' => ['label' => 'City', 'rules' => 'required'],
            'district_id' => ['label' => 'District', 'rules' => 'required'],
            'sdistrict_id' => ['label' => 'Sub District', 'rules' => 'required']
        ]);

        $id = $this->request->getPost('owners_id');

        if (!$validate) {
            return redirect()->to(base_url('/owner/edit/'. $id))->withInput();
        } else{

            $data_owner = [
                'owners_name' => $this->request->getPost('owners_name'),
                'owners_status' => $this->request->getPost('status'),
                'update_date' => date('Y-m-d H:i:s'),
                'update_by' => session()->get('fullname'),
                'owners_address' => $this->request->getPost('owners_address'),
                'owners_latitude' => $this->request->getPost('owners_latitude'),
                'owners_longitude' => $this->request->getPost('owners_longitude'),
                'state_id' => $this->request->getPost('state_id'),
                'city_id' => $this->request->getPost('city_id'),
                'district_id' => $this->request->getPost('district_id'),
                'sdistrict_id' => $this->request->getPost('sdistrict_id')
            ];

            $this->owners->update_data($id, $data_owner);
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Seller successfully updated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('owners'));
        }
    }

    public function delete(){
        $id = $this->request->getGet('owners_id');
        // var_dump($id);
        // exit;
        $data = [
            'owners_status' => 0
        ];

        $result = $this->owners->update_data($id, $data);
        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Seller successfully inactivated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('owners'));
    }

    /* Seller Edit */
    public function editSeller($id){
        $data = [
            'title' => 'Owner',
            'title_menu' => 'Edit Owner',
            'sidebar' => 'Owner'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'owner' => $this->owners->get_owner_byid($id),
            'users' => $this->users->get_users_byid(session()->get('user_id')),
            'state' => $this->state->getState(),
            'bank' => $this->owners->get_all_bank(),
            'bank_account' => $this->bank->get_accountByOwner(session()->get('owners_id')),
            'market' => $this->market->get_owner_markets(session()->get('owners_id')),
            'agreement' => $this->agreement->get_all_agreement(session()->get('owners_id'))
		];
		echo view('layout/header', $data);
		echo view('owner/edit_seller', $dataObject);
		echo view('layout/footer');
    }

    public function updateSeller(){
        $data = [
            'title' => 'Edit Owner',
            'sidebar' => 'Owner'
        ];

        $validate = $this->validate([
            'owners_name' => ['label' => 'Owner Name', 'rules' => 'required'],
            'status' => ['label' => 'Status', 'rules' => 'required'],
            'owners_address' => ['label' => 'Address', 'rules' => 'required'],
            'owners_latitude' => ['label' => 'Latitude', 'rules' => 'required'],
            'owners_longitude' => ['label' => 'Longitude', 'rules' => 'required'],
            'state_id' => ['label' => 'State', 'rules' => 'required'],
            'city_id' => ['label' => 'City', 'rules' => 'required'],
            'district_id' => ['label' => 'District', 'rules' => 'required'],
            'sdistrict_id' => ['label' => 'Sub District', 'rules' => 'required']
        ]);

        $id = $this->request->getPost('owners_id');

        if (!$validate) {
            return redirect()->to(base_url('/owners/editSeller/'. $id))->withInput();
        } else{

            $data_owner = [
                'owners_name' => $this->request->getPost('owners_name'),
                'owners_status' => $this->request->getPost('status'),
                'update_date' => date('Y-m-d H:i:s'),
                'update_by' => session()->get('fullname'),
                'owners_address' => $this->request->getPost('owners_address'),
                'owners_latitude' => $this->request->getPost('owners_latitude'),
                'owners_longitude' => $this->request->getPost('owners_longitude'),
                'state_id' => $this->request->getPost('state_id'),
                'city_id' => $this->request->getPost('city_id'),
                'district_id' => $this->request->getPost('district_id'),
                'sdistrict_id' => $this->request->getPost('sdistrict_id')
            ];

            $this->owners->update_data($id, $data_owner);
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Seller successfully updated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('owners/editSeller/'. $id))->withInput();
        }
    }

    public function updateAccount(){
        $data = [
            'title' => 'Edit Owner',
            'sidebar' => 'Owner'
        ];

        $validate = $this->validate([
            'email' => ['label' => 'Email', 'rules' => 'required'],
            'phone' => ['label' => 'Phone', 'rules' => 'required']
        ]);

        $id = $this->request->getPost('owners_id');
        $user_id = $this->request->getPost('user_id');

        if (!$validate) {
            return redirect()->to(base_url('/owners/editSeller/'. $id))->withInput();
        } else{

            $data_owner = [
                'email' => $this->request->getPost('email'),
                'phone' => $this->request->getPost('phone'),
            ];

            $this->users->update_data($user_id, $data_owner);
            session()->setFlashdata('message_profile', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Seller successfully updated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('owners/editSeller/'. $id))->withInput();
        }
    }

    public function addOwnersBank(){
        $data = [
            'title' => 'Bank Account',
            'title_menu' => 'Bank Account',
            'sidebar' => 'bank Account'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'bank' => $this->bank->get_bank(),
		];
		echo view('layout/header', $data);
		echo view('bank_account/add_bank', $dataObject);
		echo view('layout/footer');
    }

    public function createOwnersBank(){
        $data = [
            'title' => 'Bank Account',
            'sidebar' => 'Bank Account'
        ];

        $validate = $this->validate([
            'bank_id' => ['label' => 'Bank Account', 'rules' => 'required'],
            'account_name' => ['label' => 'Account Name', 'rules' => 'required'],
            'account_number' => ['label' => 'Account Number', 'rules' => 'required'],
            'status_bank' => ['label' => 'Status', 'rules' => 'required']
        ]);

        if (!$validate) {
            return redirect()->to(base_url('/owners/addOwnersBank'))->withInput();
        } else{

            $data_bank_owner = [
                'bank_id' => $this->request->getPost('bank_id'),
                'account_name' => $this->request->getPost('account_name'),
                'account_number' =>  $this->request->getPost('account_number'),
                'account_remark' => $this->request->getPost('account_remark'),
                'owners_id' => session()->get('owners_id'),
                'status' => $this->request->getPost('status_bank')
            ];

            $this->bank->insert_data($data_bank_owner);
            session()->setFlashdata('message_bank', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Bank account successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('owners/editSeller/'. session()->get('owners_id')));
        }
    }

    public function deleteOwnersBank(){
        $id = $this->request->getGet('id');

        $result1 = $this->bank->delete_data($id);

        session()->setFlashdata('message_bank', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Inbound successfully inactivated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('owners/editSeller/'. session()->get('owners_id')));
    
    }

    public function add_marketplace(){
        $data = [
            'title' => 'Marketplace Data',
            'title_menu' => 'Marketplace Data',
            'sidebar' => 'Marketplace Data'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'market' => $this->market->get_all_marketplace(),
		];
		echo view('layout/header', $data);
		echo view('marketplace/add_marketplace', $dataObject);
		echo view('layout/footer');
    }

    public function create_marketplace(){
        $data = [
            'title' => 'Marketplace',
            'sidebar' => 'Marketplace'
        ];

        $validate = $this->validate([
            'market_id' => ['label' => 'Marketplace', 'rules' => 'required'],
            'market_url' => ['label' => 'Market Url', 'rules' => 'required|valid_url']
        ]);

        if (!$validate) {
            return redirect()->to(base_url('/owners/add_marketplace'))->withInput();
        } else{

            $data_marketplace = [
                'market_id' => $this->request->getPost('market_id'),
                'market_url' => $this->request->getPost('market_url'),
                'market_remark' =>  $this->request->getPost('market_remark'),
                'owners_id' => session()->get('owners_id'),
                'status' => 1
            ];

            $this->market->insert_data($data_marketplace);
            session()->setFlashdata('message_market', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Marketplace successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('owners/editSeller/'. session()->get('owners_id')));
        }
    }

    public function edit_marketplace($id)
	{
		$data = [
            'title' => 'Marketplace Data',
            'title_menu' => 'Marketplace Data',
            'sidebar' => 'Marketplace Data'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'owners_market' => $this->market->get_market_byid($id),
            'market' => $this->market->get_all_marketplace(),
		];
		echo view('layout/header', $data);
		echo view('marketplace/edit_marketplace', $dataObject);
		echo view('layout/footer');
	}

    public function update_marketplace(){
        $data = [
            'title' => 'Edit Owner',
            'sidebar' => 'Owner'
        ];

        $validate = $this->validate([
            'owners_market_id' => ['label' => 'Marketplace', 'rules' => 'required'],
            'market_id' => ['label' => 'Marketplace', 'rules' => 'required'],
            'market_url' => ['label' => 'Market Url', 'rules' => 'required|valid_url']
        ]);

        

        $id = $this->request->getPost('owners_market_id');

        if (!$validate) {
            $data['validation'] = $this->validator;
            $dataObject = [
                'validation' => \Config\Services::validation(),
                'owners_market' => $this->market->get_market_byid($id),
                'market' => $this->market->get_all_marketplace(),
            ];
            echo view('layout/header', $data);
            echo view('marketplace/edit_marketplace', $dataObject);
            echo view('layout/footer');
        } else{

            $data_owner = [
                'market_id' => $this->request->getPost('market_id'),
                'market_url' => $this->request->getPost('market_url'),
                'market_remark' =>  $this->request->getPost('market_remark'),
                'owners_id' => session()->get('owners_id'),
                'status' => 1
            ];

            $this->market->update_data($id, $data_owner);
            session()->setFlashdata('message_market', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Marketplace successfully updated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('owners/editSeller/'. session()->get('owners_id')));
        }
    }

    public function delete_marketplace(){
        $id = $this->request->getGet('id');

        $result = $this->market->delete_data($id);

        session()->setFlashdata('message_market', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Marketplace successfully deleted.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('owners/editSeller/'. session()->get('owners_id')));
    
    }

    public function add_agreement(){
        $data = [
            'title' => 'Agreement Data',
            'title_menu' => 'Agreement Data',
            'sidebar' => 'Agreement Data'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation()
		];
		echo view('layout/header', $data);
		echo view('agreement/add_agreement', $dataObject);
		echo view('layout/footer');
    }

    public function insert_agreement(){
        $validate = $this->validate([
            'agreement_file' =>  ['label' => 'Upload File Agreement', 'rules' => 'permit_empty|ext_in[file,pdf]|max_size[file,10000]'],
            'agreement_remark' => ['label' => 'Remark', 'rules' => 'required'],
            'agreement_status' => ['label' => 'Status', 'rules' => 'required'],
        ]);

        if (!$validate) {
            return redirect()->to(base_url('owners/add_agreement/'))->withInput();
        } else{
            $agreement_file = $this->request->getFile('agreement_file');
            if($agreement_file != '') {
                if(is_dir('../public/file/special-agreement/'.session()->get('owners_id')) == false){
                    mkdir('../public/file/special-agreement/'.session()->get('owners_id'));
                }
                $agreement_file_name = $agreement_file->getRandomName();
                $agreement_file->move('../public/file/special-agreement/'.session()->get('owners_id'), $agreement_file_name);
            } else {
                $agreement_file_name = NULL;
            }

            $data_agreement = [
                'owners_id' => session()->get('owners_id'),
                'agreement_file' => $agreement_file_name,
                'agreement_remark' =>  $this->request->getPost('agreement_remark'),
                'agreement_status' => $this->request->getPost('agreement_status')
            ];

            $this->agreement->insert_data($data_agreement);
            session()->setFlashdata('message_agreement', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Agreement successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('owners/editSeller/'. session()->get('owners_id')));
        }
    }

    public function delete_agreement(){
        $id = $this->request->getGet('id');

        $result = $this->agreement->delete_data($id);

        session()->setFlashdata('message_agreement', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Agreement successfully deleted.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('owners/editSeller/'. session()->get('owners_id')));
    }

    public function edit_agreement($id){
        $data = [
            'title' => 'Agreement Data',
            'title_menu' => 'Agreement Data',
            'sidebar' => 'Agreement Data'
        ];	
        /* $agreement = $this->agreement->get_agreement_byId($id);
        var_dump($agreement);die(); */

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'agreement' => $this->agreement->get_agreement_byId($id),
		];
		echo view('layout/header', $data);
		echo view('agreement/edit_agreement', $dataObject);
		echo view('layout/footer');
    }

    public function update_agreement(){

        $validate = $this->validate([
            'agreement_file' =>  ['label' => 'Upload File Agreement', 'rules' => 'permit_empty|ext_in[file,pdf]|max_size[file,10000]'],
            'agreement_remark' => ['label' => 'Remark', 'rules' => 'required'],
            'agreement_status' => ['label' => 'Status', 'rules' => 'required'],
        ]);

        $id = $this->request->getPost('agreement_id');
        $file = $this->agreement->get_agreement_byId($id)->agreement_file;

        if (!$validate) {
            $data['validation'] = $this->validator;
            $dataObject = [
                'validation' => \Config\Services::validation(),
                'agreement' => $this->agreement->get_agreement_byId($id),
            ];
            echo view('layout/header', $data);
            echo view('agreement/edit_agreement', $dataObject);
            echo view('layout/footer');
        } else{
            $agreement_file = $this->request->getFile('agreement_file');
            if($agreement_file != '') {
                if(is_dir('../public/file/special-agreement/'.session()->get('owners_id')) == false){
                    mkdir('../public/file/special-agreement/'.session()->get('owners_id'));
                }
                $agreement_file_name = $agreement_file->getRandomName();
                $agreement_file->move('../public/file/special-agreement/'.session()->get('owners_id'), $agreement_file_name);
            } else {
                $agreement_file_name = $file;
            }

            $data_agreement = [
                'owners_id' => session()->get('owners_id'),
                'agreement_file' => $agreement_file_name,
                'agreement_remark' =>  $this->request->getPost('agreement_remark'),
                'agreement_status' => $this->request->getPost('agreement_status')
            ];

            $this->agreement->update_data($id, $data_agreement);
            session()->setFlashdata('message_market', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Marketplace successfully updated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('owners/editSeller/'. session()->get('owners_id')));
        }
    }

}

?>