<?php

namespace App\Controllers;
use App\Models\MaterialModel;
use App\Models\MaterialDetailModel;
use App\Models\MaterialGroupModel;
use App\Models\OwnersMarketModel;
use App\Models\UomModel;
use Config\Services;
use PHPExcel;
use PHPExcel_IOFactory;

class Materialapproval extends BaseController
{
    public function __construct()
    {
        if (session()->get('logged_in') == null) {
			session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Sorry, Your session has been ended.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
            return redirect()->to(base_url('auth'));
		}
		date_default_timezone_set('Asia/Jakarta');
        $this->material = new MaterialModel();
        $this->material_detail = new MaterialDetailModel();
        $this->material_group = new MaterialGroupModel();
        $this->market = new OwnersMarketModel(); 
        $this->uom = new UomModel();

        helper(['form', 'url', 'my']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index(){
        $data = [
            'title' => 'Material',
            'title_menu' => 'Material',
            'sidebar' => 'Material'
        ];	

		echo view('layout/header', $data);
		echo view('material/material_approval_data', $data);
		echo view('layout/footer');
    }

    public function getData(){

        $columns = array( 
            0 => 'material_id',
            1 => 'material_id',
            2 => 'material_id',
            3 => 'material_id',
            4 => 'material_code',
            5 => 'material_name',
            6 => 'description',
            7 => 'mat_group_name',
            8 => 'uom_name',
            9 => 'material_price',
            10 => 'owners_name'
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        $totalData = $this->material->all_material_count_audit();
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $material = $this->material->all_material_audit($limit, $start, $order, $dir);
        } else {
            $search = $this->request->getPost('search')['value']; 
            $material = $this->material->search_material_audit($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->material->search_material_count_audit($search);
        }

        $data = array();
        if(@$material) {
            foreach ($material as $row) {
                $start++;

                if(@$row->approval_status == 0) {
                    $material_status = '<span class="label label-light-success label-pill label-inline mr-2">Active</span>';
                        
                        $nestedData['action'] = '<button class="btn btn-sm btn-clean btn-icon mr-1" id="material_approve" data-id="'.@$row->material_id.'" title="Approve"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                            <path d="M16.7689447,7.81768175 C17.1457787,7.41393107 17.7785676,7.39211077 18.1823183,7.76894473 C18.5860689,8.1457787 18.6078892,8.77856757 18.2310553,9.18231825 L11.2310553,16.6823183 C10.8654446,17.0740439 10.2560456,17.107974 9.84920863,16.7592566 L6.34920863,13.7592566 C5.92988278,13.3998345 5.88132125,12.7685345 6.2407434,12.3492086 C6.60016555,11.9298828 7.23146553,11.8813212 7.65079137,12.2407434 L10.4229928,14.616916 L16.7689447,7.81768175 Z" fill="#000000" fill-rule="nonzero"/>
                        </g>
                        </svg></span></buttom>
                        <button class="btn btn-sm btn-clean btn-icon mr-1" id="material_reject" data-id="'.@$row->material_id.'" title="Reject"><span class="svg-icon svg-icon-danger svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                            <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                        </g>
                        </svg></span></button>
                        <a href="'. base_url('materialapproval/detail/'.$row->material_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                        </g>
                        </svg></span></a>
                        ';
                        
                } else { 
                    $material_status = '<span class="label label-light-danger label-pill label-inline mr-2">Inactive</span>';
                    if(session()->get('user_type')==1){
                        $nestedData['action'] = '<a href="'.base_url('material/edit/'.@$row->material_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Edit"><span class="svg-icon svg-icon-warning svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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

                if(@$row->material_weight != @$row->weight_comparison or @$row->material_height != @$row->height_comparison 
                    or @$row->material_width != @$row->width_comparison or @$row->material_length != @$row->length_comparison){
                    $class = 'text-danger';
                }else {
                    $class = '';
                }

                $nestedData['number'] = $start;
                $nestedData['material_id'] = '<span class="'.$class.'">'.@$row->material_id.'</span>';
                $nestedData['material_code'] = '<span class="'.$class.'">'.@$row->material_code.'</span>';
                $nestedData['material_name'] = '<span class="'.$class.'">'.@$row->material_name.'</span>';
                $nestedData['description'] = '<span class="'.$class.'">'.@$row->description.'</span>';
                $nestedData['mat_group'] = '<span class="'.$class.'">'.@$row->mat_group_name.'</span>';
                $nestedData['mat_uom'] = '<span class="'.$class.'">'.@$row->uom_name.'</span>';
                $nestedData['material_price'] = '<span class="'.$class.'">'.number_format(@$row->material_price).'</span>';
                $nestedData['owners_name'] = '<span class="'.$class.'">'.@$row->owners_name.'</span>';
                $nestedData['status'] = $material_status;
                
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
		$fields = array('material_id', 'material_code', 'material_name', 'description', 'mat_group', 'mat_uom', 'material_price', 'owners_name');
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

    public function approve(){
        $id = $this->request->getPost('id');
        
        $data = [
            'approval_status' => 1
        ];

        $this->material->update_data($id, $data);

        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Product successfully approved.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('materialapproval'));
    }

    public function reject(){
        $id = $this->request->getPost('id');
        
        $data = [
            'approval_status' => 2
        ];

        $this->material->update_data($id, $data);

        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Product successfully rejected.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('materialapproval'));
    }

    public function detail($id)
	{
		$data = [
            'title' => 'Product',
            'title_menu' => 'Product Detail',
            'sidebar' => 'Product'
        ];	

        $owners_id = @$this->material->get_material_byid($id)->owners_id;
        
		$dataObject = [
			'validation' => \Config\Services::validation(),
            'details' => $this->material->get_material_byid($id),
            'market' => @$this->market->get_owner_markets($owners_id),
		];
		echo view('layout/header', $data);
		echo view('material/material_details', $dataObject);
		echo view('layout/footer');
	}
}