<?php

namespace App\Controllers;
use App\Models\SohTotalModel;
use Config\Services;

class Soh_owner extends BaseController
{
    public function __construct()
    {
        $this->sohtotal = new SohTotalModel();
        helper(['form', 'url', 'my']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index(){
        $data = [
            'title' => 'Inventory Seller',
            'title_menu' => 'Inventory Seller',
            'sidebar' => 'Manual Update Stock Seller'
        ];	

		echo view('layout/header', $data);
		echo view('soh_total/soh_owner', $data);
		echo view('layout/footer');
    }

    public function getData(){

        $columns = array( 
            0 => 'soh_total.warehouse_id',
            1 => 'soh_total.owner_id',
            2 => 'soh_total.material_id',
            3 => 'soh_total.stock_good_seller',
            4 => 'soh_total.stock_ngood_seller',
            5 => 'soh_total.stock_good_warehouse',
            6 => 'soh_total.stock_ngood_warehouse',
            7 => 'soh_total.updated_date'
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        $id_owners = session()->get('owners_id');
        

        $totalData = $this->sohtotal->soh_owner_count($id_owners);
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $soh = $this->sohtotal->soh_owner($limit, $start, $order, $dir, $id_owners);
        } else {
            $search = $this->request->getPost('search')['value']; 
            $soh = $this->sohtotal->search_soh_owner($limit, $start, $search, $order, $dir, $id_owners);
            $totalFiltered = $this->sohtotal->search_soh_owner_count($search, $id_owners);
        }

        $data = array();
        $i = 0;
        if(@$soh) {
            foreach ($soh as $row) {
                $start++;

                /* if(@$row->status == 1) {
                    $inbound_status = '<span class="label label-light-success label-pill label-inline mr-2">Plan</span>';
                } else if(@$row->status == 2)  { 
                    $inbound_status = '<span class="label label-light-danger label-pill label-inline mr-2">Staging</span>';
                } else if(@$row->status == 3)  { 
                    $inbound_status = '<span class="label label-light-danger label-pill label-inline mr-2">Put Away</span>';
                }

                $material_detail = $this->inbound->get_inbound_detail($row->inbound_id);
                $arrayMaterial = [];

                foreach($material_detail as $mat){
                    $dataMat = '<li>' . $mat->material_name . ', '.$mat->qty.' ' . $mat->uom_name . '</li>';
                    array_push($arrayMaterial, $dataMat);
                }
                $inbound_mat = join("", $arrayMaterial);

                $arrayDetail = [];

                foreach($material_detail as $det){
                    $dataDet = '<li>' . $det->material_name . ', '.$det->qty_realization.' ' . $det->uom_name . '</li>';
                    array_push($arrayDetail, $dataDet);
                }
                $inbound_det = join("", $arrayDetail); */

                $total_soh_seller = intval(@$row->stock_good_seller) + intval(@$row->stock_ngood_seller);
                $total_soh_warehouse = intval(@$row->stock_good_warehouse) + intval(@$row->stock_ngood_warehouse);
                if($total_soh_seller != $total_soh_warehouse || @$row->stock_good_seller != @$row->stock_good_warehouse || @$row->stock_ngood_seller != @$row->stock_ngood_warehouse){
                    $nestedData['number'] = $start;
                    $nestedData['warehouse_name'] = '<span class="text-danger">'.@$row->wh_name.'</span>';
                    $nestedData['owner_name'] = '<span class="text-danger">'.@$row->owners_name.'</span>';
                    $nestedData['material_name'] = '<span class="text-danger">'.@$row->material_name.'</span>';
                    $nestedData['stock_good_seller'] = '<span class="text-danger">'.@$row->stock_good_seller.'</span>';
                    $nestedData['stock_ngood_seller'] = '<span class="text-danger">'.@$row->stock_ngood_seller.'</span>';
                    $nestedData['stock_good_warehouse'] = '<span class="text-danger">'.@$row->stock_good_warehouse.'</span>';
                    $nestedData['stock_ngood_warehouse'] = '<span class="text-danger">'.@$row->stock_ngood_warehouse.'</span>';
                    $nestedData['updated_date'] = '<span class="text-danger">'.date('d-m-Y', strtotime(@$row->updated_date)).'</span>';
                    $nestedData['action'] = '<a onclick="get_soh_owner('.$i.')"  class="btn btn-sm btn-clean btn-icon mr-1" title="Edit"><span class="svg-icon svg-icon-warning svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                    </g>
                    </svg></span></a><input type="text" hidden="true" id="sohowner'.@$i.'" value="'.@$row->sot_id.'"/>';
                    
                    $data[] = $nestedData;
                    $i++;
                }else{
                    $nestedData['number'] = $start;
                    $nestedData['warehouse_name'] = @$row->wh_name;
                    $nestedData['owner_name'] = @$row->owners_name;
                    $nestedData['material_name'] = @$row->material_name;
                    $nestedData['stock_good_seller'] = @$row->stock_good_seller;
                    $nestedData['stock_ngood_seller'] = @$row->stock_ngood_seller;
                    $nestedData['stock_good_warehouse'] = @$row->stock_good_warehouse;
                    $nestedData['stock_ngood_warehouse'] = @$row->stock_ngood_warehouse;
                    $nestedData['updated_date'] = date('d-m-Y', strtotime(@$row->updated_date));
                    $nestedData['action'] = '<a onclick="get_soh_owner('.$i.')"  class="btn btn-sm btn-clean btn-icon mr-1" title="Edit"><span class="svg-icon svg-icon-warning svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                    </g>
                    </svg></span></a><input type="text" hidden="true" id="sohowner'.@$i.'" value="'.@$row->sot_id.'"/>';
                    
                    $data[] = $nestedData;
                    $i++;
                }
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
		$fields = array('warehouse_name', 'owner_name', 'material_name', 'stock_good_seller', 'stock_ngood_seller', 'stock_good_warehouse', 'stock_ngood_warehouse', 'updated_date');
		$columns[] = array(
			'data' => 'number',
			'className' => 'text-center'
		);
        $columns[] = array(
            'data' => 'action',
            'className' => 'text-center text-nowrap'
        );
        /* $columns[] = array(
            'data' => 'status',
            'className' => 'text-center'
        ); */
		foreach ($fields as $field) {
			$columns[] = array(
				'data' => $field,
                'className' => 'text-nowrap'
			);
		}
		echo json_encode($columns); 
	}

    public function get_soh_byId(){
        $post = $this->request->getPost('sot_id[]');

        $data = [
            'soh' => $this->sohtotal->get_soh_byId($post)
        ];

        echo view('soh_total/soh_update_owner', $data);
    }

    public function update(){
        $data = [
            'title' => 'Inventory Seller',
            'sidebar' => 'Manual Update Stock Seller'
        ];

        $validate = $this->validate([
            'stock_good_seller' => ['label' => 'Stock Good Seller', 'rules' => 'required'],
            'stock_ngood_seller' => ['label' => 'Stock Not Good Seller', 'rules' => 'required'],
            'stock_good_warehouse' => ['label' => 'Stock Good Warehouse', 'rules' => 'required'],
            'stock_ngood_warehouse' => ['label' => 'Stock Not Good Warehouse', 'rules' => 'required'],
        ]);

        $id = $this->request->getPost('sot_id');

        if (!$validate) {
            return redirect()->to(base_url('/soh_owner'))->withInput();
        }else{
            $data_stock =[
                'stock_good_seller' => $this->request->getPost('stock_good_seller'),
                'stock_ngood_seller' => $this->request->getPost('stock_ngood_seller'),
                'stock_good_warehouse' => $this->request->getPost('stock_good_warehouse'),
                'stock_ngood_warehouse' => $this->request->getPost('stock_ngood_warehouse')
            ];

            $this->sohtotal->update_data($id, $data_stock);

            $data_hist = [
                'sohhist_id' => $this->sohtotal->generate_soh_hist_id(),
                'sot_id' => $id,
                'update_by' => session()->get('owners_id'),
                'update_date' => date('Y-m-d H:i:s'),
                'stock_good_seller' => $this->request->getPost('stock_good_seller'),
                'stock_ngood_seller' => $this->request->getPost('stock_ngood_seller'),
                'stock_good_warehouse' => $this->request->getPost('stock_good_warehouse'),
                'stock_ngood_warehouse' => $this->request->getPost('stock_ngood_warehouse'),
                'remark' => $this->request->getPost('remark2')
            ];

            $this->sohtotal->insert_hist($data_hist);

            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Seller successfully updated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('soh_owner'));
        }

    }
}