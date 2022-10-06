<?php

namespace App\Controllers;
use App\Models\PrivilegeModel;
use App\Models\LevelModel;
use Config\Services;

class Privilege extends BaseController
{
    public function __construct()
    {
        $this->level = new LevelModel();
        $this->privilege = new PrivilegeModel();

        helper(['form', 'url', 'my']);
    }

	public function index()
	{
		$data = [
            'title' => 'Privilege',
            'title_menu' => 'Privilege',
            'sidebar' => 'Privilege'
        ];	
        // nampilin semua level yang ada di wms. terus di dalam tabelnya ada link buat buka modal buat edit privilege
		echo view('layout/header', $data);
		echo view('privilege/privilege_data', $data);
		echo view('layout/footer');
    }

    public function getData(){

        $columns = array( 
            0 => 'level_id',
            1 => 'level_name'
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        $totalData = $this->level->all_level_count();
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $level = $this->level->all_level($limit, $start, $order, $dir);
        } else {
            $search = $this->request->getPost('search')['value']; 
            $level = $this->level->search_level($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->level->search_level_count($search);
        }

        $data = array();
        $index = 0;
        if(@$level) {
            foreach ($level as $row) {
                $start++;

                if(@$row->level_status == 1) {
                    $level_status = '<span class="label label-light-success label-pill label-inline mr-2">Active</span>';
                } else { 
                    $level_status = '<span class="label label-light-danger label-pill label-inline mr-2">Inactive</span>';
                }

                $nestedData['number'] = $start;
                $nestedData['level_name'] = @$row->level_name;
                $nestedData['status'] = $level_status;
                $nestedData['action'] = '<a href="'.base_url('privilege/edit/'.@$row->level_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Edit"><span class="svg-icon svg-icon-warning svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                    <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                </g>
                </svg></span></a>
                <input type="hidden" value="'.@$row->level_id.'" id="user_level'.$index.'" name="level_id['.$index.']">
                <a href="#" data-toggle="modal" onclick="view_privilege('.$index.');" class="btn btn-sm btn-clean btn-icon mr-1" title="View"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<rect x="0" y="0" width="24" height="24"/>
					<path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
					<path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
				</g>
                </svg></span></a>';
                
                $data[] = $nestedData;
                $index++;
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
		$fields = array('level_name');
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

    public function getLevelAccess(){
        $post = $this->request->getPost('level_id[]');
        // var_dump($post);
        // die;
        $data = array(
            'menu' => $this->privilege->get_all_menu(),
            'level' => $this->level->get_level_byid($post)
        );
        // var_dump($this->level->get_level_byid($post));
        // die;
        echo view('privilege/privilege_level', $data);
    }

    // public function add()
	// {
	// 	$data = [
    //         'title' => 'menu',
    //         'title_menu' => 'menu',
    //         'sidebar' => 'menu'
    //     ];	

	// 	$dataObject = [
	// 		'validation' => \Config\Services::validation()
	// 	];
	// 	echo view('layout/header', $data);
	// 	echo view('menu/add_menu', $dataObject);
	// 	echo view('layout/footer');
	// }

    // public function create(){
    //     $data = [
    //         'title' => 'menu',
    //         'sidebar' => 'menu'
    //     ];

    //     $validate = $this->validate([
    //         'menu_name' => ['label' => 'menu Name', 'rules' => 'required']
    //     ]);

    //     if (!$validate) {
    //         return redirect()->to(base_url('/menu/add'))->withInput();
    //     } else{
    //         // $id = $this->menu->generate_id();

    //         $data_owner = [
    //             'menu_name' => $this->request->getPost('menu_name'),
    //             'icon' => $this->request->getPost('icon'),
    //             'controller' => $this->request->getPost('controller'),
    //             'is_parent' => $this->request->getPost('is_parent'),
    //             'is_active' => 1
    //         ];

    //         $this->menu->insert_data($data_owner);
    //         session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">menu successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

    //         return redirect()->to(base_url('menu'));
    //     }
    // }

    public function edit($id)
	{
		$data = [
            'title' => 'Privilege',
            'title_menu' => 'Privilege',
            'sidebar' => 'Privilege'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'level' => $this->level->get_level_byid($id),
            'menu' => $this->privilege->get_all_menu(),
            'getMenuByPrivilege' => $this->privilege->get_menu_all_by_privilege($id)
		];
		echo view('layout/header', $data);
		echo view('privilege/edit_privilege_copy', $dataObject);
		echo view('layout/footer');
	}

    public function update(){
        $data = [
            'title' => 'menu',
            'sidebar' => 'menu'
        ];

        $validate = $this->validate([
            'level_id' => ['label' => 'Level ID', 'rules' => 'required']
        ]);

        $id = $this->request->getPost('level_id');

        if (!$validate) {
            return redirect()->to(base_url('/privilege/edit/'. $id))->withInput();
        } else{
            $data_user_access = array();
            if(@$this->request->getPost('user_privilege')){
                $i=0;
                // print_r($this->request->getPost('menu_id[]'));
                // die;
                $this->privilege->delete_by_levelID($this->request->getPost('level_id'));
                
                foreach($this->request->getPost('user_privilege') as $row){
                    $check_value = intVal($this->request->getPost('check['.$i.']'));
                    if($check_value == 0){
                        
                    } else {
                        $data_user_access = array(
                            'level_id' => $this->request->getPost('level_id'), // nilai ID Detil yang didapat dari generate_ids
                            'menu_id' => $this->request->getPost('menu_id['.$i.']'),
                            'sub_menu_id' => $this->request->getPost('submenu_id['.$i.']')
                        );
                        $this->privilege->insert_data($data_user_access);
                    }
                    $i++;
                }
                // print_r($data);
                // die;
            }
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">menu successfully updated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('privilege'));
        }
    }

    public function delete(){
        $id = $this->request->getGet('id');
        // var_dump($id);
        // exit;
        $data = [
            'is_active' => 0
        ];

        $result = $this->menu->update_data($id, $data);
        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">menu successfully inactivated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('menu'));
    }
    
    
}

?>