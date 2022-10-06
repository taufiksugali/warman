<?php

namespace App\Controllers;
use App\Models\MaterialGroupModel;
use App\Models\JenisModel;
use Config\Services;

class Materialgroup extends BaseController
{
    public function __construct()
    {
        $this->matgroup = new MaterialGroupModel();
        $this->jenis = new JenisModel();

        helper(['form', 'url', 'my']);
    }

	public function index()
	{
		$data = [
            'title' => 'Material Group',
            'title_menu' => 'Material Group',
            'sidebar' => 'Material Group'
        ];	

		echo view('layout/header', $data);
		echo view('matgroup/matgroup_data', $data);
		echo view('layout/footer');
    }

    public function getData(){

        $columns = array( 
            0 => 'mat_group_id',
            1 => 'jenis_name',
            2 => 'uom_name'
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        $totalData = $this->matgroup->all_matgroup_count();
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $matgroup = $this->matgroup->all_matgroup($limit, $start, $order, $dir);
        } else {
            $search = $this->request->getPost('search')['value']; 
            $matgroup = $this->matgroup->search_matgroup($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->matgroup->search_matgroup_count($search);
        }

        $data = array();
        if(@$matgroup) {
            foreach ($matgroup as $row) {
                $start++;

                if(@$row->status == 1) {
                    $status = '<span class="label label-light-success label-pill label-inline mr-2">Active</span>';
                } else { 
                    $status = '<span class="label label-light-danger label-pill label-inline mr-2">Inactive</span>';
                }

                $nestedData['number'] = $start;
                $nestedData['jenis_name'] = @$row->jenis_name;
                $nestedData['mat_group_name'] = @$row->mat_group_name;
                $nestedData['status'] = $status;
                $nestedData['action'] = '<a href="'.base_url('Materialgroup/edit/'.@$row->mat_group_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Edit"><span class="svg-icon svg-icon-warning svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                    <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                </g>
                </svg></span></a>
                <button class="btn btn-sm btn-clean btn-icon mr-1" id="delete" data-id="'.@$row->mat_group_id.'" title="Delete"><span class="svg-icon svg-icon-danger svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
		$fields = array('jenis_name', 'mat_group_name');
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
            'title' => 'Material Group',
            'title_menu' => 'Material Group',
            'sidebar' => 'Material Group'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'jenis' => $this->jenis->get_all_jenis()
		];
		echo view('layout/header', $data);
		echo view('matgroup/add_matgroup', $dataObject);
		echo view('layout/footer');
	}

    public function create(){
        $data = [
            'title' => 'Material Group',
            'sidebar' => 'Material Group'
        ];

        $validate = $this->validate([
            'jenis_id' => ['label' => 'Jenis', 'rules' => 'required'],
            'mat_group_name' => ['label' => 'Name', 'rules' => 'required']
        ]);

        if (!$validate) {
            return redirect()->to(base_url('/matgroup/add'))->withInput();
        } else{
            // $id = $this->uom->generate_id();

            $data = [
                'mat_group_name' => $this->request->getPost('mat_group_name'),
                'jenis_id' => $this->request->getPost('jenis_id'),
                'status' => 1
            ];

            $this->matgroup->insert_data($data);
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Material Group successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('materialgroup'));
        }
    }

    public function edit($id)
	{
		$data = [
            'title' => 'Material Group',
            'title_menu' => 'Material Group',
            'sidebar' => 'Material Group'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'matgroup' => $this->matgroup->get_matgroup_byid($id),
            'jenis' => $this->jenis->get_all_jenis()
		];
		echo view('layout/header', $data);
		echo view('matgroup/edit_matgroup', $dataObject);
		echo view('layout/footer');
	}

    public function update(){
        $data = [
            'title' => 'Material Group',
            'sidebar' => 'Material Group'
        ];

        $validate = $this->validate([
            'jenis_id' => ['label' => 'Jenis', 'rules' => 'required'],
            'mat_group_name' => ['label' => 'Name', 'rules' => 'required'],
            'status' => ['label' => 'Status', 'rules' => 'required']
        ]);

        $id = $this->request->getPost('mat_group_id');

        if (!$validate) {
            return redirect()->to(base_url('/matgroup/edit'. $id))->withInput();
        } else{

            $data = [
                'mat_group_name' => $this->request->getPost('mat_group_name'),
                'jenis_id' => $this->request->getPost('jenis_id'),
                'status' => $this->request->getPost('status')
            ];
            // print_r($data);
            // die;

            $this->matgroup->update_data($id, $data);
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Material Group successfully updated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('materialgroup'));
        }
    }

    public function delete(){
        $id = $this->request->getGet('mat_group_id');
        // var_dump($id);
        // exit;
        $data = [
            'status' => 0
        ];

        $result = $this->matgroup->update_data($id, $data);
        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">UoM successfully inactivated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('uom'));
    }

}

?>