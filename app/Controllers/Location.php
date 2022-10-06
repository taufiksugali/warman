<?php

namespace App\Controllers;
use App\Models\MaterialModel;
use App\Models\LocationModel;
use App\Models\WarehouseModel;
use App\Models\WhAreaModel;
use App\Models\BlokModel;
use App\Models\RakModel;
use App\Models\ShelfModel;
use App\Models\InboundDetailModel;
use App\Models\InboundModel;
use App\Models\PurchaseOrderModel;
use App\Models\PoDetailModel;
use Config\Services;

class Location extends BaseController
{
    public function __construct()
    {
        $this->material         = new MaterialModel();
        $this->location         = new LocationModel();
        $this->warehouse        = new WarehouseModel();
        $this->area             = new WhAreaModel();
        $this->blok             = new BlokModel();
        $this->rak              = new RakModel();
        $this->shelf            = new ShelfModel();
        $this->po_detail        = new PoDetailModel();
        $this->inbound_detail   = new InboundDetailModel();
        $this->inbound          = new InboundModel();

        helper(['form', 'url', 'my']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index(){
        $data = [
            'title' => 'Materiallocation',
            'title_menu' => 'Material Location',
            'sidebar' => 'Location'
        ];	

		echo view('layout/header', $data);
		echo view('location/material_data', $data);
		echo view('layout/footer');
    }

    public function getData(){

        $columns = array( 
            0 => 'inbound.inbound_id',
            1 => 'inbound.inbound_id',
            2 => 'inbound.inbound_id',
            3 => 'inbound.create_date',
            4 => 'inbound.inbound_doc',
            5 => 'supplier.supplier_name',
            6 => 'warehouse.warehouse_name'
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        $totalData = $this->location->all_material_count();
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $location = $this->location->all_material($limit, $start, $order, $dir);
        } else {
            $search = $this->request->getPost('search')['value']; 
            $location = $this->location->search_material($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->location->search_material_count($search);
        }

        $data = array();
        if(@$location) {
            foreach ($location as $row) {
                $start++;

                if(@$row->status == 1) {
                    $inbound_status = '<span class="label label-light-success label-pill label-inline mr-2">'.$row->status.'</span>';
                } else if(@$row->status == 2)  { 
                    $inbound_status = '<span class="label label-light-danger label-pill label-inline mr-2">'.$row->status.'</span>';
                }

                $nestedData['number'] = $start;
                // $nestedData['barcode'] = "<img alt='Barcode' src=". base_url('/barcode.php?codetype=code128&size=40&text='.@$row->material_detail_id.'&print=true').">";
                $nestedData['barcode'] = @$row->material_detail_id;
                // $nestedData['barcode'] = "<img alt='Barcode' src=". base_url('/qr.php?id='.@$row->det_inbound_id).">";
                $nestedData['inbound_id'] = @$row->inbound_id;
                $nestedData['recieve_date'] = date('d-m-Y', strtotime(@$row->inbound_rcv_date));
                $nestedData['material_name'] = @$row->material_name;
                $nestedData['warehouse_name'] = @$row->wh_name;
                $nestedData['qty_good'] = @$row->qty_good_in;
                $nestedData['qty_not_good'] = @$row->qty_notgood_in;
                $nestedData['qty_total'] = @$row->qty_realization;
                $nestedData['action'] = '<a href="'. base_url('location/add_v2/'.$row->det_inbound_id.'/'.$row->material_detail_id.'/'.$row->inbound_location).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Map\Marker2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M9.82829464,16.6565893 C7.02541569,15.7427556 5,13.1079084 5,10 C5,6.13400675 8.13400675,3 12,3 C15.8659932,3 19,6.13400675 19,10 C19,13.1079084 16.9745843,15.7427556 14.1717054,16.6565893 L12,21 L9.82829464,16.6565893 Z M12,12 C13.1045695,12 14,11.1045695 14,10 C14,8.8954305 13.1045695,8 12,8 C10.8954305,8 10,8.8954305 10,10 C10,11.1045695 10.8954305,12 12,12 Z" fill="#000000"/>
                    </g>
                </svg><!--end::Svg Icon--></span></a>';
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
		$fields = array('barcode', 'inbound_id', 'recieve_date', 'material_name', 'warehouse_name', 'qty_good', 'qty_not_good', 'qty_total');
		$columns[] = array(
			'data' => 'number',
			'className' => 'text-center'
		);
        $columns[] = array(
            'data' => 'action',
            'className' => 'text-center text-nowrap'
        );
		foreach ($fields as $field) {
			$columns[] = array(
				'data' => $field,
                'className' => 'text-nowrap'
			);
		}
		echo json_encode($columns); 
	}

    public function add($id, $material_detail_id, $warehouse)
	{
		$data = [
            'title' => 'Materiallocation',
            'title_menu' => 'Location',
            'sidebar' => 'Material Location' 
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'warehouse_area' => $this->area->get_good_wharea_bywhid($warehouse),
            'warehouse_area_ng' => $this->area->get_ng_wharea_bywhid($warehouse),
            'blok' => $this->blok->get_all_blok(),
            'rak' => $this->rak->get_all_rak(),
            'shelf' => $this->shelf->get_all_shelf(),
            'detail_material' => $this->location->get_detail_material($id, $material_detail_id)
		];

		echo view('layout/header', $data);
		echo view('location/set_location', $dataObject);
		echo view('layout/footer');
	}

    public function add_v2($id, $material_detail_id, $warehouse)
	{
		$data = [
            'title' => 'Materiallocation',
            'title_menu' => 'Location',
            'sidebar' => 'Material Location' 
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'warehouse_area' => $this->area->get_good_wharea_bywhid($warehouse),
            'warehouse_area_ng' => $this->area->get_ng_wharea_bywhid($warehouse),
            'blok' => $this->blok->get_all_blok(),
            'rak' => $this->rak->get_all_rak(),
            'shelf' => $this->shelf->get_all_shelf(),
            'detail_material' => $this->location->get_detail_material($id, $material_detail_id)
		];

         // custom JS
         $data["js"] = "set_location.js";

		echo view('layout/header', $data);
		echo view('location/set_location_v2', $dataObject);
		echo view('layout/footer_v2');
	}

    public function get_material_byshelf()
    {
        $post = $this->request->getPost('shelf_id[]');
        
        // $get_materials = ;
        // var_dump($post);
        //exit;
       
        $data = array(
            'materials' => $this->location->get_materials_byshelf($post)
        );

        echo view('location/shelf_material_data', $data);
    }

    public function edit($location_id){
        $data = [
            'title' => 'Moving',
            'title_menu' => 'Location',
            'sidebar' => 'Material Moving' 
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'warehouse_area' => $this->area->get_wharea_bywhid(session()->get('warehouse_id')),
            'warehouse_area_ng' => $this->area->get_ng_wharea_bywhid(session()->get('warehouse_id')),
            'blok' => $this->blok->get_all_blok(),
            'rak' => $this->rak->get_all_rak(),
            'shelf' => $this->shelf->get_all_shelf(),
            'detail_material' => $this->location->get_detail_material_move($location_id)
		];

		echo view('layout/header', $data);
		echo view('location/edit_location', $dataObject);
		echo view('layout/footer');
    }


    public function get_blok()
    {
        $post = $this->request->getPost('area_id[]');

        $get_block = $this->blok->get_blok_byarea($post);
        // var_dump($post);exit;
        $result_blok = "";
        $result_blok .= '<option value=""></option>';
        foreach ($get_block as $row) {
            $result_blok .= '<option value=' . $row->blok_id . '>' . $row->blok_name . '</option>';
        }

        $arr_data = array(
            'blok' => $result_blok
        );

        echo json_encode($arr_data, TRUE);
    }

    public function get_rak()
    {
        $post = $this->request->getPost('blok_id[]');

        $get_rak = $this->rak->get_rak_byblok($post);
        // var_dump($post);exit;
        $result_rak = "";
        $result_rak .= '<option value=""></option>';
        foreach ($get_rak as $row) {
            $result_rak .= '<option value=' . $row->rak_id . '>' . $row->rak_name . '</option>';
        }

        $arr_data = array(
            'rak' => $result_rak
        );

        echo json_encode($arr_data, TRUE);
    }

    public function get_shelf()
    {
        $post = $this->request->getPost('rak_id[]');

        $get_shelf = $this->shelf->get_shelf_byrak($post);
        // var_dump($post);exit;
        $result_shelf = "";
        $result_shelf .= '<option value=""></option>';
        foreach ($get_shelf as $row) {
            $result_shelf .= '<option value=' . $row->shelf_id . '>' . $row->shelf_name . '</option>';
        }

        $arr_data = array(
            'shelf' => $result_shelf
        );

        echo json_encode($arr_data, TRUE);
    }

    public function get_availability()
    {
        $post = $this->request->getPost('shelf_id[]');

        $get_avail = $this->shelf->get_shelf_byid($post);
        // var_dump($post);exit;
        
        $result_shelf =  $get_avail->shelf_availability;

        $arr_data = array(
            'avail' => intVal($result_shelf)
        );

        echo json_encode($arr_data, TRUE);
    }

    public function create_v2(){
        // print_rr($this->request->getPost());
        // exit();
        $data = [
            'title' => 'Materiallocation',
            'sidebar' => 'Inbound'
        ];



            $i = 0;
            $good = $this->request->getPost('qty_good');
            $not_good = $this->request->getPost('qty_not_good');
            $total = $good + $not_good;
            
            if(@$good > 0){
                foreach($this->request->getPost('area_id') as $row){ // validasi shelf availability
                    $sisa_kosong = intval($this->request->getPost('sisa_kosong['.$i.']'));
                    $jumlah_masuk = intval($this->request->getPost('quantity['.$i.']'));
                    $shelf_availability_update = $sisa_kosong - $jumlah_masuk;
                    if($jumlah_masuk > $sisa_kosong){
                        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-warning fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Shelf has not enough capacity.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
                        return redirect()->to(base_url('/location/add_v2/'.$this->request->getPost('detail_id').'/'.$this->request->getPost('mat_detail_id').'/'.$this->request->getPost('inbound_location')));
                    } 
                    $i++;
                }
            }
            
            if(@$not_good > 0){
                $i = 0;
                foreach($this->request->getPost('area_id_ng') as $row){
                    
                    $sisa_kosong = intval($this->request->getPost('sisa_kosong_ng['.$i.']'));
                    $jumlah_masuk = intval($this->request->getPost('quantity_ng['.$i.']'));
                    $shelf_availability_update = $sisa_kosong - $jumlah_masuk;
                    if($jumlah_masuk > $sisa_kosong){
                        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-warning fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Shelf has not enough capacity.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
                        return redirect()->to(base_url('/location/add_v2/'.$this->request->getPost('detail_id').'/'.$this->request->getPost('mat_detail_id').'/'.$this->request->getPost('inbound_location')));
                    } 
                    $i++;
                }
            }

            $qty_all = 0;
            if(@$good > 0){
                $i = 0;
                foreach($this->request->getPost('area_id') as $row){ //bikin validasi terkait availability dari shelf disini
                    $id = $this->location->generate_id();
                    $data_location = [ // sediain api set lokasi ID disini. untuk bang chandra.
                        'location_id' => $id,
                        'material_detail_id' => $this->request->getPost('mat_detail_id'),
                        'shelf_id' => $this->request->getPost('shelf_id['.$i.']'),
                        'qty' => $this->request->getPost('quantity['.$i.']'),
                        'status' => 1,
                        'create_date' => date('Y-m-d H:i:s'),
                        'create_by' => session()->get('fullname')
                    ];
                    $id_shelf = $this->request->getPost('shelf_id['.$i.']');
                    
                    $sisa_kosong = intval($this->request->getPost('sisa_kosong['.$i.']'));
                    $jumlah_masuk = intval($this->request->getPost('quantity['.$i.']'));
                    $shelf_availability_update = $sisa_kosong - $jumlah_masuk;
                    if($jumlah_masuk <= $sisa_kosong){
                        $data_shelf = [
                            'shelf_availability' => intVal($shelf_availability_update)
                        ];
                        $this->shelf->update_data($id_shelf, $data_shelf);
                        $this->location->insert_data($data_location);
                    } // nanti harus dibuat lagi validasinya.
                    $i++;
                }
            }
            $i = 0;
            if(@$not_good > 0){
                foreach($this->request->getPost('area_id_ng') as $row){ //bikin validasi terkait availability dari shelf disini
                    $id = $this->location->generate_id();
                    $data_location = [ // sediain api set lokasi ID disini. untuk bang chandra.
                        'location_id' => $id,
                        'material_detail_id' => $this->request->getPost('mat_detail_id'),
                        'shelf_id' => $this->request->getPost('shelf_id_ng['.$i.']'),
                        'qty' => $this->request->getPost('quantity_ng['.$i.']'),
                        'status' => 1,
                        'create_date' => date('Y-m-d H:i:s'),
                        'create_by' => session()->get('fullname')
                    ];
                    $id_shelf = $this->request->getPost('shelf_id_ng['.$i.']');
                    
                    $sisa_kosong = intval($this->request->getPost('sisa_kosong_ng['.$i.']'));
                    $jumlah_masuk = intval($this->request->getPost('quantity_ng['.$i.']'));
                    $shelf_availability_update = $sisa_kosong - $jumlah_masuk;
                    if($jumlah_masuk <= $sisa_kosong){
                        $data_shelf = [
                            'shelf_availability' => intVal($shelf_availability_update)
                        ];
                        $this->shelf->update_data($id_shelf, $data_shelf);
                        $this->location->insert_data($data_location);
                    } // nanti harus dibuat lagi validasinya.
                    $i++;
                }
            }

            $inbound_detail_id = $this->request->getPost('detail_id');
            $data_inbound_detail = [
                'status' => 3
            ];
            $this->inbound_detail->update_data($inbound_detail_id, $data_inbound_detail);

            $cek = 0;
            $detail_status = $this->inbound_detail->check_status($this->request->getPost('inbound_id'));
            foreach($detail_status as $ds){
                if($ds->status == 2){
                    $cek++;
                }
            }
            if($cek == 0){
                $inbound_status = [
                    'status' => 3
                ];
                $this->inbound->update_data($this->request->getPost('inbound_id'), $inbound_status);
            }
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Material Location successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('location'));

        // }
    }

    public function create(){
        $data = [
            'title' => 'Materiallocation',
            'sidebar' => 'Inbound'
        ];

        // $validate = $this->validate([
        //     'area_id[]' => ['label' => 'Warehouse', 'rules' => 'required']
        // ]);

        // if (!$validate) {
        //     return redirect()->to(base_url('/location/add'))->withInput();
        // } else{

            $i = 0;
            $good = $this->request->getPost('qty_good');
            $not_good = $this->request->getPost('qty_not_good');
            $total = $good + $not_good;
            
            foreach($this->request->getPost('area_id') as $row){ // validasi shelf availability
                $sisa_kosong = intval($this->request->getPost('sisa_kosong['.$i.']'));
                $jumlah_masuk = intval($this->request->getPost('quantity['.$i.']'));
                $shelf_availability_update = $sisa_kosong - $jumlah_masuk;
                if($jumlah_masuk > $sisa_kosong){
                    session()->setFlashdata('message', '<div class="alert alert-custom alert-light-warning fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Shelf has not enough capacity.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
                    return redirect()->to(base_url('/location/add/'.$this->request->getPost('detail_id').'/'.$this->request->getPost('mat_detail_id').'/'.$this->request->getPost('inbound_location')));
                } 
                $i++;
            }
            
            if(@$not_good > 0){
                $i = 0;
                foreach($this->request->getPost('area_id_ng') as $row){
                    
                    $sisa_kosong = intval($this->request->getPost('sisa_kosong_ng['.$i.']'));
                    $jumlah_masuk = intval($this->request->getPost('quantity_ng['.$i.']'));
                    $shelf_availability_update = $sisa_kosong - $jumlah_masuk;
                    if($jumlah_masuk > $sisa_kosong){
                        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-warning fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Shelf has not enough capacity.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
                        return redirect()->to(base_url('/location/add/'.$this->request->getPost('detail_id').'/'.$this->request->getPost('mat_detail_id').'/'.$this->request->getPost('inbound_location')));
                    } 
                    $i++;
                }
            }

            $qty_all = 0;
            
            $i = 0;
            foreach($this->request->getPost('area_id') as $row){ //bikin validasi terkait availability dari shelf disini
                $id = $this->location->generate_id();
                $data_location = [ // sediain api set lokasi ID disini. untuk bang chandra.
                    'location_id' => $id,
                    'material_detail_id' => $this->request->getPost('mat_detail_id'),
                    'shelf_id' => $this->request->getPost('shelf_id['.$i.']'),
                    'qty' => $this->request->getPost('quantity['.$i.']'),
                    'status' => 1,
                    'create_date' => date('Y-m-d H:i:s'),
                    'create_by' => session()->get('fullname')
                ];
                $id_shelf = $this->request->getPost('shelf_id['.$i.']');
                
                $sisa_kosong = intval($this->request->getPost('sisa_kosong['.$i.']'));
                $jumlah_masuk = intval($this->request->getPost('quantity['.$i.']'));
                $shelf_availability_update = $sisa_kosong - $jumlah_masuk;
                if($jumlah_masuk <= $sisa_kosong){
                    $data_shelf = [
                        'shelf_availability' => intVal($shelf_availability_update)
                    ];
                    $this->shelf->update_data($id_shelf, $data_shelf);
                    $this->location->insert_data($data_location);
                } // nanti harus dibuat lagi validasinya.
                $i++;
            }
            $i = 0;
            if(@$not_good > 0){
                foreach($this->request->getPost('area_id_ng') as $row){ //bikin validasi terkait availability dari shelf disini
                    $id = $this->location->generate_id();
                    $data_location = [ // sediain api set lokasi ID disini. untuk bang chandra.
                        'location_id' => $id,
                        'material_detail_id' => $this->request->getPost('mat_detail_id'),
                        'shelf_id' => $this->request->getPost('shelf_id_ng['.$i.']'),
                        'qty' => $this->request->getPost('quantity_ng['.$i.']'),
                        'status' => 1,
                        'create_date' => date('Y-m-d H:i:s'),
                        'create_by' => session()->get('fullname')
                    ];
                    $id_shelf = $this->request->getPost('shelf_id_ng['.$i.']');
                    
                    $sisa_kosong = intval($this->request->getPost('sisa_kosong_ng['.$i.']'));
                    $jumlah_masuk = intval($this->request->getPost('quantity_ng['.$i.']'));
                    $shelf_availability_update = $sisa_kosong - $jumlah_masuk;
                    if($jumlah_masuk <= $sisa_kosong){
                        $data_shelf = [
                            'shelf_availability' => intVal($shelf_availability_update)
                        ];
                        $this->shelf->update_data($id_shelf, $data_shelf);
                        $this->location->insert_data($data_location);
                    } // nanti harus dibuat lagi validasinya.
                    $i++;
                }
            }

            $inbound_detail_id = $this->request->getPost('detail_id');
            $data_inbound_detail = [
                'status' => 3
            ];
            $this->inbound_detail->update_data($inbound_detail_id, $data_inbound_detail);

            $cek = 0;
            $detail_status = $this->inbound_detail->check_status($this->request->getPost('inbound_id'));
            foreach($detail_status as $ds){
                if($ds->status == 2){
                    $cek++;
                }
            }
            if($cek == 0){
                $inbound_status = [
                    'status' => 3
                ];
                $this->inbound->update_data($this->request->getPost('inbound_id'), $inbound_status);
            }
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Material Location successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('location'));

        // }
    }

    public function update(){
        $data = [
            'title' => 'Materiallocation',
            'sidebar' => 'Inbound'
        ];

        // $validate = $this->validate([
        //     'area_id[]' => ['label' => 'Warehouse', 'rules' => 'required']
        // ]);

        // if (!$validate) {
        //     return redirect()->to(base_url('/location/add'))->withInput();
        // } else{

            $i = 0;
            $good = $this->request->getPost('qty');
            $not_good = 0;
            $total = $good + $not_good;

            // algoritma moving
            // mengubah id shelf di table material location jika tidak ada material detail id yang shelfnya sama.
            // bersamaan dengan mengurangi shelf availability shelf tujuan. dan menambahkan shelf availability shelf asal.
            // jika shelf id di tujuannya sama, maka hapus data asal, dan update qty di id material location tujuan.
            $qty_all = 0;
            $loc_id = $this->request->getPost('location_id');

            foreach($this->request->getPost('area_id') as $row){ //bikin validasi terkait availability dari shelf disini
                $id = $this->location->generate_id();
                
                // buat query yang memeriksa apakah ada material detail id yang sama di shelf id tujuan.
                $check_shelf = $this->location->check_material_detail_on_shelf($this->request->getPost('mat_detail_id'), $this->request->getPost('shelf_id['.$i.']'), 'count');
                
                if($check_shelf > 0){ // jika ada material detail id yang sama di shelf tujuan, maka lakukan update data tujuan dan hapus yang lama (jika gaada sisa).
                    $tujuan_data = $this->location->check_material_detail_on_shelf($this->request->getPost('mat_detail_id'), $this->request->getPost('shelf_id['.$i.']'), 'row');
                    
                    $id_tujuan = $tujuan_data->location_id;
                    $qty_to_move = intVal($this->request->getPost('quantity['.$i.']'));
                    $qty_total = $qty_to_move + $tujuan_data->qty; // 
                                    
                    // print_r($tujuan_data);
                    // print_r($qty_total);
                    // die;
                    $data_location = [
                        'qty' => $qty_total
                    ];
                    $this->location->update_data($id_tujuan, $data_location); // menambahkan qty material location yang id material detailnya sama.

                    $shelf_tujuan_avail = intval($tujuan_data->shelf_availability) - $qty_to_move;
                    $data_shelf_tujuan = [
                        'shelf_availability' => $shelf_tujuan_avail
                    ];
                    
                    $this->shelf->update_data($tujuan_data->shelf_id, $data_shelf_tujuan); // mengurangi ketersidiaan tempat di shelf yang menjadi tujuan pindah barang.

                    //menambahkan availability shelf asal.
                    $shelf_asal_avail = intVal($this->request->getPost('shelf_from_avail')) + $qty_to_move;
                    
                    $data_shelf_asal = [
                        'shelf_availability' => $shelf_asal_avail
                    ];

                    $this->shelf->update_data($this->request->getPost('shelf_from'), $data_shelf_asal); // menambahkan availability dari shelf yang tadinya ditempati.
                    // kalo quantity di material location id nya belom habis, jangan dihapus.
                    $this->location->delete_data($loc_id);
                    $i++;
                } else {
                    $tujuan_data = $this->location->check_material_detail_on_shelf($this->request->getPost('mat_detail_id'), $this->request->getPost('shelf_id['.$i.']'), 'row');

                    $id_shelf = $this->request->getPost('shelf_id['.$i.']');
                    $sisa_kosong = intval($this->request->getPost('sisa_kosong['.$i.']'));
                    $jumlah_masuk = intval($this->request->getPost('quantity['.$i.']'));
                    $shelf_availability_update = $sisa_kosong - $jumlah_masuk;
                    
                    $shelf_asal_avail = intVal($this->request->getPost('shelf_from_avail')) + $jumlah_masuk;
                    
                    $data_shelf_asal = [
                        'shelf_availability' => $shelf_asal_avail
                    ];
                    
                    $data_location = [ // sediain api set lokasi ID disini. untuk bang chandra.
                        'shelf_id' => $this->request->getPost('shelf_id['.$i.']'),
                        'update_date' => date('Y-m-d H:i:s'),
                        'update_by' => session()->get('fullname')
                    ];

                    // print_r($data_location);
                    // print_r($loc_id);
                    // die;
                    if($jumlah_masuk < $sisa_kosong){
                        $data_shelf = [
                            'shelf_availability' => intVal($shelf_availability_update)
                        ];
                        $this->shelf->update_data($id_shelf, $data_shelf);
                        $this->shelf->update_data($this->request->getPost('shelf_from'), $data_shelf_asal); // menambahkan availability dari shelf yang tadinya ditempati.
                        $this->location->update_data($loc_id, $data_location);
                    } // nanti harus dibuat lagi validasinya.
                    $i++;
                }
                // die;
            }

            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Material Location successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('location/view_location'));
    }

    public function view_location(){
        $data = [
            'title' => 'Materiallocation',
            'title_menu' => 'Location',
            'sidebar' => 'Material Location' 
        ];	

        $warehouse = null;
        if(session()->get('warehouse_id') == "POSLOG"){
            $warehouse = $this->warehouse->get_all_warehouse();
        } else {
            $warehouse = $this->warehouse->get_warehouse_view_loc(session()->get('warehouse_id'));
        }

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'warehouse' => $warehouse,
		];

		echo view('layout/header', $data);
		echo view('location/view_location', $dataObject);
		echo view('layout/footer');
    }

    public function view_layout(){
        $post = $this->request->getPost('warehouse_id');

        $dataObject = [
			'validation' => \Config\Services::validation(),
            'warehouse_area' => $this->area->get_wharea_bywhid($post),
		];

        echo view('location/warehouse_layout', $dataObject);
    }
    
}
?>