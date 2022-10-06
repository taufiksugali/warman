<?php

namespace App\Controllers;
use App\Models\MaterialModel;
use App\Models\MaterialDetailModel;
use App\Models\CustomerModel;
use App\Models\WarehouseModel;
use App\Models\OwnersModel;
use App\Models\OutboundModel;
use App\Models\OutboundDetailModel;
use App\Models\LocationModel;
use App\Models\ShelfModel;
use App\Models\MaterialSohModel;
use Config\Services;

class Out_realization extends BaseController
{
    public function __construct()
    {
        $this->material = new MaterialModel();
        $this->material_detail = new MaterialDetailModel();
        $this->customer = new CustomerModel();
        $this->warehouse = new WarehouseModel();
        $this->outbound = new OutboundModel();
        $this->owner = new OwnersModel();
        $this->outbound_detail = new OutboundDetailModel();
        $this->location = new LocationModel();
        $this->shelf = new ShelfModel();
        $this->material_soh = new MaterialSohModel();

        helper(['form', 'url', 'my']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index(){
        $data = [
            'title' => 'Outboundrealization',
            'title_menu' => 'Outbound',
            'sidebar' => 'Outbound Realization'
        ];	

		echo view('layout/header', $data);
		echo view('outbound/realization_data', $data);
		echo view('layout/footer');
    }

    public function getData(){

        $columns = array( 
            0 => 'outbound.outbound_id',
            1 => 'outbound.create_date',
            2 => 'outbound.outbound_doc',
            3 => 'outbound.outbound_doc_date',
            4 => 'customer.customer_name',
            5 => 'warehouse.wh_name'
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        $totalData = $this->outbound->all_outbound_count_bystatus("1");
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $outbound = $this->outbound->all_outbound_bystatus($limit, $start, $order, $dir, "1");
        } else {
            $search = $this->request->getPost('search')['value']; 
            $outbound = $this->outbound->search_outbound_bystatus($limit, $start, $search, $order, $dir, "1");
            $totalFiltered = $this->outbound->search_outbound_count_bystatus($search, "1");
        }

        $data = array();
        if(@$outbound) {
            foreach ($outbound as $row) {
                $start++;

                if(@$row->status == 1) {
                    $outbound_status = '<span class="label label-light-success label-pill label-inline mr-2">New</span>';
                } else if(@$row->status == 2)  { 
                    $outbound_status = '<span class="label label-light-danger label-pill label-inline mr-2">Realization</span>';
                }

                $material_detail = $this->outbound->get_outbound_detail($row->outbound_id);
                $arrayMaterial = [];

                foreach($material_detail as $mat){
                    $dataMat = '<li>' . $mat->material_name . ', '.$mat->outbound_qty.' ' . $mat->uom_name . '</li>';
                    array_push($arrayMaterial, $dataMat);
                }
                $outbound_mat = join("", $arrayMaterial);

                $arrayDetail = [];

                foreach($material_detail as $det){
                    $dataDet = '<li>' . $det->material_name . ', '.$det->qty_realization.' ' . $det->uom_name . '</li>';
                    array_push($arrayDetail, $dataDet);
                }
                $outbound_det = join("", $arrayDetail);

                $nestedData['number'] = $start;
                $nestedData['outbound_id'] = @$row->outbound_id;
                $nestedData['outbound_doc'] = @$row->outbound_doc;
                $nestedData['outbound_date'] = date('d-m-Y', strtotime(@$row->create_date));
                $nestedData['customer_name'] = @$row->customer_name;
                $nestedData['warehouse_name'] = @$row->wh_name;
                $nestedData['material_name'] = $outbound_mat;
                $nestedData['realization'] = @$outbound_det;
                $nestedData['status'] = $outbound_status;
                $nestedData['action'] = '<a href="'. base_url('out_realization/add/'.$row->outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Recieve"><span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Check.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24"/>
                    <path d="M6.26193932,17.6476484 C5.90425297,18.0684559 5.27315905,18.1196257 4.85235158,17.7619393 C4.43154411,17.404253 4.38037434,16.773159 4.73806068,16.3523516 L13.2380607,6.35235158 C13.6013618,5.92493855 14.2451015,5.87991302 14.6643638,6.25259068 L19.1643638,10.2525907 C19.5771466,10.6195087 19.6143273,11.2515811 19.2474093,11.6643638 C18.8804913,12.0771466 18.2484189,12.1143273 17.8356362,11.7474093 L14.0997854,8.42665306 L6.26193932,17.6476484 Z" fill="#000000" fill-rule="nonzero" transform="translate(11.999995, 12.000002) rotate(-180.000000) translate(-11.999995, -12.000002) "/>
                </g>
                </svg></span></a>';
                
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
		$fields = array('outbound_id', 'outbound_date', 'customer_name', 'warehouse_name', 'material_name', 'realization');
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

    public function add($id)
	{
		$data = [
            'title' => 'Outboundrealization',
            'title_menu' => 'Outbound',
            'sidebar' => 'Outbound Realization'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'outbound_data' => $this->outbound->get_outbound_byid($id),
            'outbound_detail' => $this->outbound->get_outbound_detail($id)
		];

		echo view('layout/header', $data);
		echo view('outbound/outbound_realization', $dataObject);
		echo view('layout/footer');
	}

    public function create(){
        $data = [
            'title' => 'Outboundrealization',
            'sidebar' => 'Outbound'
        ];

        // $validate = $this->validate([
        //     'rec_by' => ['label' => 'Recieve By', 'rules' => 'required'],
        //     'rec_date' => ['label' => 'Recieve Date', 'rules' => 'required'],
        //     'owner_id' => ['label' => 'Owner Name', 'rules' => 'required']
        // ]);

        // if (!$validate) {
        //     return redirect()->to(base_url('/realization/add'))->withInput();
        // } else{
            $id = $this->request->getPost('outbound_id');
            $data_outbound = [
                'status' => 2,
                'update_date' => date('Y-m-d H:i:s'),
                'update_by' => session()->get('fullname')
            ];

            $this->outbound->update_data($id, $data_outbound);

            if(@$this->request->getPost('material_detail')){
                $i=0;
                foreach($this->request->getPost('material_detail') as $row){
                    $id = $this->request->getPost('det_outbound['.$i.']');
                    $data_outbound_detail = [
                        'qty_realization' => str_replace(",", "",$this->request->getPost('good_out['.$i.']')),
                        'cek' => $this->request->getPost('check['.$i.']'),
                        'status' => 2
                    ];

                    $this->outbound_detail->update_data($id, $data_outbound_detail);
                    $current_stock = $this->material_soh->get_currrent_stock($row)->stock_ok; //perlu diperiksa.
                    $new_stock = $current_stock - $data_outbound_detail['qty_realization']; //sepertinya perlu diganti
                    $mat_soh = [
                        'stock_ok' => $new_stock,
                        'status' => 1
                    ];

                    $this->material_soh->update_byid($row, $mat_soh);

                    $location_id = $this->request->getPost('location['.$i.']');
                    $current_qty = $this->location->get_location_byid($location_id)->qty;
                    $new_qty = $current_qty - $data_outbound_detail['qty_realization'];
                    $mat_location = [
                        'qty' => $new_qty
                    ];
                    $this->location->update_data($location_id, $mat_location);

                    $shelf_avail = $this->location->check_material_detail_on_shelfv2($location_id)->shelf_availability;
                    $shelf_id = $this->location->check_material_detail_on_shelfv2($location_id)->shelf_id;
                    $cur_avail = $shelf_avail + $data_outbound_detail['qty_realization'];
                    
                    $data_shelf_tujuan = [
                        'shelf_availability' => $cur_avail
                    ];
                    
                    $this->shelf->update_data($shelf_id, $data_shelf_tujuan);
                    $i++;
                // }
            }
            
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Inbound Realization successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('outboundhistory'));
        }
    }
}
?>