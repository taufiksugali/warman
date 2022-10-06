<?php

namespace App\Controllers;
use App\Models\MaterialModel;
use App\Models\MaterialDetailModel;
use App\Models\CustomerModel;
use App\Models\WarehouseModel;
use App\Models\OwnersModel;
use App\Models\OutboundModel;
use App\Models\OutboundpoModel;
use App\Models\OutbounddoModel;
use App\Models\OutboundDetailModel;
use App\Models\OutbounddoDetailModel;
use App\Models\BillModel;
use Config\Services;

class Outbounddo extends BaseController
{
    public function __construct()
    {
        $this->material = new MaterialModel();
        $this->material_detail = new MaterialDetailModel();
        $this->customer = new CustomerModel();
        $this->warehouse = new WarehouseModel();
        $this->outbound = new OutboundModel();
        $this->outbounddo = new OutbounddoModel();
        $this->outboundpo = new OutboundpoModel();
        $this->owner = new OwnersModel();
        $this->bill = new BillModel();
        $this->outbound_detail = new OutboundDetailModel();
        $this->outbounddo_detail = new OutbounddoDetailModel();

        helper(['form', 'url', 'my']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index(){
        $data = [
            'title' => 'Outbound',
            'title_menu' => 'Outbound',
            'sidebar' => 'Outbound Plan'
        ];	

		echo view('layout/header', $data);
		echo view('outbound/outbound_do_data', $data);
		echo view('layout/footer');
    }

    public function getData(){

        $columns = array( 
            0 => 'outbound_do.do_id',
            1 => 'outbound_do.do_id',
            2 => 'outbound_do.do_id',
            3 => 'outbound_do.do_id',
            4 => 'outbound_do.do_id',
            5 => 'outbound_do.do_date'
        );

        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        $totalData = $this->outbounddo->all_outbound_count();
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $outbound = $this->outbounddo->all_outbound($limit, $start, $order, $dir, "1");
        } else {
            $search = $this->request->getPost('search')['value']; 
            $outbound = $this->outbounddo->search_outbound($limit, $start, $search, $order, $dir, "1");
            $totalFiltered = $this->outbounddo->search_outbound_count($search, "1");
        }

        $data = array();
        if(@$outbound) {
            $i = 0;
            foreach ($outbound as $row) {
                $start++;
                
                if(@$row->do_status == 1) {
                    $outbound_status = '<span class="label label-light-primary label-pill label-inline mr-2">New</span>';
                } else if(@$row->do_status == 2)  { 
                    $outbound_status = '<span class="label label-light-info label-pill label-inline mr-2">In Progress</span>';
                } else if(@$row->do_status == 3)  { 
                    $outbound_status = '<span class="label label-light-danger label-pill label-inline mr-2">Rejected</span>';
                } else if(@$row->do_status == 4)  { 
                    $outbound_status = '<span class="label label-light-info label-pill label-inline mr-2">Approved</span>';
                } else if(@$row->do_status == 5)  { 
                    $outbound_status = '<span class="label label-light-success label-pill label-inline mr-2">Done</span>';
                } 

                $do_detail = $this->outbounddo_detail->get_outbounddo_detail($row->do_id);
                $arrayMaterial = [];

                foreach($do_detail as $mat){
                    if($mat->transporter_alias != null){
                        $dataMat = '<li>' . $mat->transporter_alias . '</li>';
                    } else {
                        $dataMat = '<li>' . 'MARKETPLACE' . '</li>';
                    }
                    array_push($arrayMaterial, $dataMat);
                }
                $transporter = join("", $arrayMaterial);

                // $arrayDetail = [];

                // foreach($material_detail as $det){
                //     $dataDet = '<li>' . $det->material_name . ', '.$det->qty_realization.' ' . $det->uom_name . '</li>';
                //     array_push($arrayDetail, $dataDet);
                // }
                // $outbound_det = join("", $arrayDetail);

                $nestedData['number'] = $start;
                $nestedData['do_id'] = @$row->do_id;
                $nestedData['transporter_id'] = @$transporter;
                // $nestedData['do_created_date'] = date('d-m-Y', strtotime(@$row->do_created_date));
                // $nestedData['do_trans_resi'] = @$row->do_trans_resi;
                $nestedData['do_date'] = date('d-m-Y', strtotime(@$row->do_date));
                // $nestedData['do_process_stt'] = @$row->do_process_stt;
                $nestedData['status'] = @$outbound_status;
                if(@$row->do_status == 1)  {
                    $nestedData['action'] = '
                    <a href="#" data-toggle="modal" onclick="get_shipping_detail('.$i.');" class="btn btn-sm btn-clean btn-icon mr-1"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                        </g>
                    </svg></span</a>
                    <input type="hidden" value="'. $row->do_id .'" id="do_id_'. $i .'" name="do_id['. $i .']">
                    <a href="'. base_url('outbounddo/edit/'.$row->do_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                        <path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" fill="#000000"/>
                        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                    </g>
                    </svg></span></a>';
                } else {
                    $nestedData['action'] ='<a href="#" data-toggle="modal" onclick="get_shipping_detail('.$i.');" class="btn btn-sm btn-clean btn-icon mr-1"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                        </g>
                    </svg></span</a>
                    <input type="hidden" value="'. $row->do_id .'" id="do_id_'. $i .'" name="do_id['. $i .']">';
                }
                $data[] = $nestedData;
                $i++;
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
	{ // sampe sini.
		$fields = array('do_id', 'transporter_id', 'do_date');
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
            'title' => 'Outbound',
            'title_menu' => 'Outbound',
            'sidebar' => 'Outbound'
        ];	

        if($this->request->getPost('po_id')){
            $outbound = $this->outbound->get_outbound($this->request->getPost('po_id'));
        }else{
            $purchase_order = '';
        }

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'warehouse' => $this->warehouse->get_all_warehouse(),
            'transporter' => $this->outbounddo->get_transporter(),
            'outbound' => $this->outbound->get_outbound()
		];

		echo view('layout/header', $data);
		echo view('outbound/add_outbound_do', $dataObject);
		echo view('layout/footer');
	}

    public function get_package()
	{
        $outbound_data = json_decode($this->request->getPost('json'), true);
		// $outbound_data = $this->outbound->get_outbound($this->request->getPost('po_id'));
        $f = $this->request->getPost('indicator');
		$do_list = "";
        if (count($outbound_data) > 0) {
			# show table in modal	
			if ($f == '0') {
				$no = 1;
				if (!isset($outbound_data['pesan'])) {
					for ($i = 0; $i < count($outbound_data); $i++) {
						if ($outbound_data[$i]['status'] == 2) {
                            $outbound_id = $outbound_data[$i]['outbound_id'];

                            $material_detail = $this->outbound->get_outbound_detail($outbound_data[$i]['outbound_id']);
                            $arrayMaterial = [];
            
                            foreach($material_detail as $mat){
                                $dataMat = '<li>' . $mat->material_name . ', '.$mat->outbound_qty.' ' . $mat->uom_name . '</li>';
                                array_push($arrayMaterial, $dataMat);
                            }
                            $outbound_mat = join("", $arrayMaterial);
							echo "<tr>";
							echo "<td align='center'><input type='checkbox' id='pid' name='pid' value='" . $i . "'/></td>";
							echo "<td>" . $no . "</td>";
							echo "<td>" . $outbound_data[$i]['outbound_id'] . "</td>";
							echo "<td>" . $outbound_data[$i]['wh_name'] . "</td>";
							echo "<td>" . $outbound_data[$i]['transporter_alias'] . "</td>";
                            echo "<td>" . $outbound_data[$i]['customer_name'] . "</td>";
                            echo "<td>" . $outbound_mat . "</td>";
							echo "</tr>";
							$no++;
						}
					}
				}

				# show table in do_form	
			} else if ($f == '1') {
				$no = 0;
				$btn_closed_DO = 'false';
				$rcv = 0;
				for ($i = 0; $i < count($outbound_data); $i++) {
					if ($outbound_data[$i]['status'] == 3) {
						$ison = json_encode($i);
						$outbound_id = $outbound_data[$i]['outbound_id'];
						$transporter_id = $outbound_data[$i]['transporter_id'];

                        $material_detail = $this->outbound->get_outbound_detail($outbound_data[$i]['outbound_id']);
                        $arrayMaterial = [];
        
                        foreach($material_detail as $mat){
                            $dataMat = '<li>' . $mat->material_name . ', '.$mat->outbound_qty.' ' . $mat->uom_name . '</li>';
                            array_push($arrayMaterial, $dataMat);
                        }
                        $outbound_mat = join("", $arrayMaterial);
        
						$x = json_encode($no);
						echo "<tr>";
						if (isset($outbound_data[$i]['lo_proses_stt'])) { // belom kepake 
							/* if($outbound_data[$i]['lo_proses_stt']=='INTRANSIT'){
									echo "<td align='center'><button type='button' class='btn bg-orange btn-xs' onclick='rcvLO(".$ison.",".$outbound_data_son.")'>Receive</button></td>";
								}else{
									echo "<td></td>";
								} */

							echo "<td>" . $outbound_data[$i]['lo_proses_stt'] . "</td>";
							if ($outbound_data[$i]['lo_proses_stt'] == 'RECEIVE') {
								$rcv++;
							}
						} else {
							echo "<td align='center'>
								<a href='#'  onclick='del_arr_DO(" . $ison . "," . $x . ");return false;'>
									<i class='fa fa-trash fa-lg' aria-hidden='true' data-toggle='tooltip' data-placement='top' title='Delete'></i>
								</a></td>";
						}
						echo "<td>" . $outbound_id . "</td>";
						echo "<td>" . $outbound_data[$i]['wh_name'] . "</td>";
						echo "<td>" . $outbound_data[$i]['transporter_alias'] . "</td>";
                        echo '<td hidden="true"><input type="text" style="width: 55px;" name="outbound_id[]" value="'.$outbound_id.'"/><input type="text" style="width: 55px;" name="transporter_id[]" value="'.$transporter_id.'"/></td>';
						echo "<td>" . $outbound_data[$i]['customer_name'] . "</td>";
						echo "<td>" . $outbound_mat . "</td>";
						echo "</tr>";
						$no++;
					}
				}

				// if ($rcv == count($outbound_data)) {
	
				// }
			}
		}
		
	}

    public function create(){
        $data = [
            'title' => 'Outbound',
            'sidebar' => 'Outbound'
        ];

        if(!@$this->request->getPost('outbound_id')){
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-warning fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Package list is empty!</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
            return redirect()->to(base_url('/outbounddo/add'));
        }
        $id = $this->outbounddo->generate_id();
        
        // insert outbound do dan update outbound status
        $data_outbound = [
            'do_id' => $id,
            // 'transporter_id' => $this->request->getPost('transporter_id'),
            'do_date' => date_format(date_create($this->request->getPost('do_date')), 'Y-m-d'),
            // 'do_trans_resi' => $this->request->getPost('do_trans_resi'),
            'do_created_date' => date('Y-m-d H:i:s'),
            'do_created_by' => session()->get('fullname'),
            'do_process_stt' => 1,
            'do_status' => 1
        ];
        // print_r($data_outbound);
        // die;
        $this->outbounddo->insert_data($data_outbound);
        
        if(@$this->request->getPost('outbound_id')){
            $i=0;
            foreach($this->request->getPost('outbound_id') as $row){
                // mengambil id po nya dulu dari outbound id, lalu cek semua po detail nya buat dptin material price nya,  baru 
                // hitung outbound charge nya. 
                // menghitung 3.5 persen dari tiap barang yang ada di packaging, dikali (*) dengan qty nya.
                $id_outbound = $this->request->getPost('outbound_id['.$i.']');
                $outboundpo_id = $this->outbound->get_outbound_byid($id_outbound)->po_outbound_id;
                $owners_id = $this->outboundpo->get_outbound_byid($outboundpo_id)->owners_id;

                $outbound_charge = 0;
                $outboundpo_detail = $this->outboundpo->get_outbound_detail($outboundpo_id);

                $outbound_qty_tot = 0;
                $weight_tot = 0;
                $height_tot = 0;
                $length_tot = 0;
                $width_tot = 0;
                $price_tot = 0;
                foreach($outboundpo_detail as $row_po){
                    $outbound_qty = $row_po->outbound_qty;
                    $weight = $row_po->material_weight * $row_po->outbound_qty;
                    $height = $row_po->material_height * $row_po->outbound_qty;
                    $length = $row_po->material_length * $row_po->outbound_qty;
                    $width = $row_po->material_width * $row_po->outbound_qty;
                    $price = $row_po->material_price * $row_po->outbound_qty;

                    $outbound_qty_tot += $outbound_qty;
                    $weight_tot += $weight;
                    $height_tot += $height;
                    $length_tot += $length;
                    $width_tot += $width;
                    $price_tot += $price;

                    $material_price = $row_po->material_price;
                    $charge_per_material = 0.035 * $material_price;
                    $outbound_charge = ($outbound_charge + $charge_per_material) * $row_po->outbound_qty;
                }

                $bclajg = $this->outboundpo->get_outbound_byid($outboundpo_id);
                    
                $get_byid_owners = $this->outboundpo->get_byid_owners($owners_id);
                $get_byid_usersowners = $this->outboundpo->get_byid_usersowners($owners_id);
                $get_byid_customer = $this->outboundpo->get_byid_customer($bclajg->po_penerima, $owners_id);
                $get_byid_warehouse = $this->outboundpo->get_byid_warehouse($bclajg->warehouse_id);
                $get_byid_po_service = $this->outboundpo->get_byid_po_service($outboundpo_id);

                // API POS
                if (@$bclajg->transporter_id == '1') {
                    $senderlocation = [
                        "name" => @$get_byid_owners->owners_name,
                        "phone" => @$get_byid_usersowners->phone,
                        "email"=> @$get_byid_usersowners->email,
                        "address"=> @$get_byid_owners->owners_address,
                        "subdistrict"=> @$get_byid_owners->sdistrict_name,
                        "city"=> @$get_byid_owners->city_name,
                        "province"=> @$get_byid_owners->state_name,
                        "zipcode"=> @$get_byid_owners->zip_code
                    ];

                    $receiverlocation = [
                        "name" => @$get_byid_customer->customer_name,
                        "phone" => @$get_byid_customer->customer_phone,
                        "email"=> @$get_byid_customer->customer_email,
                        "address"=> @$get_byid_customer->customer_address,
                        "subdistrict"=> @$get_byid_customer->sdistrict_name,
                        "city"=> @$get_byid_customer->city_name,
                        "province"=> @$get_byid_customer->state_name,
                        "zipcode"=> @$get_byid_customer->zip_code
                    ];

                    $pickuplocation = [
                        "name" => @$get_byid_warehouse->wh_name,
                        "phone" => @$get_byid_warehouse->wh_pic_phone,
                        "email"=> @$get_byid_warehouse->wh_pic_email,
                        "address"=> @$get_byid_warehouse->wh_address,
                        "subdistrict"=> @$get_byid_warehouse->sdistrict_name,
                        "city"=> @$get_byid_warehouse->city_name,
                        "province"=> @$get_byid_warehouse->state_name,
                        "zipcode"=> @$get_byid_warehouse->zip_code,
                        "geolang" => @$get_byid_warehouse->wh_latitude,
                        "geolat" => @$get_byid_warehouse->wh_longitude,
                    ];

                    $itemproperties = [
                        "productid" => $get_byid_po_service->serviceCode,
                        "valuegoods" => $price_tot,
                        "weight" => $weight_tot,
                        "length" => $length_tot,
                        "width" => $width_tot,
                        "height" => $height_tot,
                        "codvalue" => 0,
                        "pin" => 123456,
                        "itemdesc" => "PAKET BOX"
                    ];

                    $paymentvalues = [
                        "fee" => $get_byid_po_service->fee,
                        "insurance" => $get_byid_po_service->insurance
                    ];

                    $taxes = [
                        "fee" => $get_byid_po_service->feeTax,
                        "insurance" => $get_byid_po_service->insuranceTax
                    ];
                    
                    $api_pos_token = $this->outbounddo->api_pos_token();

                    $anjgbgtbcl = $this->outbounddo->api_pos_addposting($senderlocation, $receiverlocation, $pickuplocation, $itemproperties, $paymentvalues, $taxes, $outboundpo_id, @$api_pos_token->access_token);
                    $resiorawb_number = @$anjgbgtbcl->transref;
                }

                // API SICEPAT
                if (@$bclajg->transporter_id == '4') {
                    // @$bclajg->po_out_date
                    $data_body = [
                        "auth_key" => '40C31BD3264F49168981B907ABB0781C',
                        "reference_number" => $outboundpo_id,
                        "pickup_request_date"=> date("Y-m-d H:i", strtotime(date('Y-m-d H:i') . '+ 2 hours')),
                        "pickup_method"=> 'PICKUP',
                        "pickup_merchant_code"=> '',
                        "pickup_merchant_name"=> @$get_byid_owners->owners_name,
                        "sicepat_account_code"=> null,
                        "pickup_address"=> @$get_byid_warehouse->wh_address.', '.@$get_byid_warehouse->district_name.', '.@$get_byid_warehouse->city_name.', '.@$get_byid_warehouse->state_name.', '.@$get_byid_warehouse->zip_code,
                        "pickup_city"=> @$get_byid_warehouse->city_name,
                        "pickup_merchant_phone" => @$get_byid_warehouse->wh_pic_phone,
                        "pickup_merchant_email"=> @$get_byid_warehouse->wh_pic_email,
                        "voucher_code"=> '',
                        "receipt_number"=> '69'.date("ymdHs"),
                        "origin_code"=> @$get_byid_warehouse->origin_code_sicepat,
                        "delivery_type"=> @$get_byid_po_service->serviceCode,
                        "parcel_category"=> 'PAKET',
                        "parcel_content"=> 'PAKET BOX',
                        "parcel_qty"=> $outbound_qty_tot,
                        "parcel_uom"=> 'Pcs',
                        "parcel_value"=> $price_tot,
                        "total_weight"=> $weight_tot,
                        "shipper_name"=> @$get_byid_owners->owners_name,
                        "shipper_address"=> @$get_byid_owners->owners_address,
                        "shipper_province"=> @$get_byid_owners->state_name,
                        "shipper_city"=> @$get_byid_owners->city_name,
                        "shipper_district"=> @$get_byid_owners->district_name,
                        "shipper_zip"=> @$get_byid_owners->zip_code,
                        "shipper_phone"=> @$get_byid_usersowners->phone,
                        "shipper_longitude"=> '',
                        "shipper_latitude"=> '',
                        "recipient_title"=> 'Mr',
                        "recipient_name"=> @$get_byid_customer->customer_name,
                        "recipient_address"=> @$get_byid_customer->customer_address,
                        "recipient_province"=> @$get_byid_customer->state_name,
                        "recipient_city"=> @$get_byid_customer->city_name,
                        "recipient_district"=> @$get_byid_customer->district_name,
                        "recipient_zip"=> @$get_byid_customer->zip_code,
                        "recipient_phone"=> @$get_byid_customer->customer_phone,
                        "recipient_longitude"=> '',
                        "recipient_latitude"=> '',
                        "destination_code"=> @$get_byid_customer->destination_code_sicepat,
                    ];
                    $anjgbgtbcl = $this->outbounddo->api_sicepat_requestpickuppackage($data_body);
                    $resiorawb_number = @$anjgbgtbcl->datas[0]->receipt_number;
                }

                if (@$bclajg->transporter_id == NULL) {
                    $resiorawb_number = @$bclajg->po_resi_number;
                }

                // // contoh insert bill
                // $bill_id = $this->bill->generate_id();
                // $data_bill = [
                //     'bill_id' => $bill_id,
                //     'owners_id' => $owners_id,
                //     'ref_id' => $id,
                //     'po_id' => $outboundpo_id,
                //     'description' => 'ADMIN FEE',
                //     'amount' => $outbound_charge,
                //     'created_date' => date('Y-m-d H:i:s'),
                //     'bill_status' => 0
                // ];

                // $this->bill->insert_data($data_bill);

                $detil_id = $this->outbounddo_detail->generate_id();
                $data_outbound_detail = [
                    'do_detail_id' => $detil_id,
                    'do_id' => $id,
                    'do_out_resi' => $resiorawb_number,
                    'do_ongkir' => @$get_byid_po_service->totalFee,
                    'outbound_id' => $this->request->getPost('outbound_id['.$i.']'),
                    'transporter_id' => $this->request->getPost('transporter_id['.$i.']'),
                    'status' => 1
                ];
                
                $data_po = [
                    'status' => 3
                ];
                $data_po_outbound = [
                    'po_out_status' => 3
                ];
                $this->outbound->update_data($id_outbound, $data_po);
                $this->outboundpo->update_data($outboundpo_id, $data_po_outbound);
                $i++;
                $this->outbounddo_detail->insert_data($data_outbound_detail);
                // harus update status outbound po juga. besok aja.
            }
        }
        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Outbound successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('outbounddo'));

        
    }

    public function edit($id)
	{
		$data = [
            'title' => 'Outbound Process',
            'title_menu' => 'Outbound',
            'sidebar' => 'Outbound Process'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'outbound_do' => $this->outbounddo->get_outbounddo_byid($id),
            'transporter' => $this->outbounddo->get_transporter(),
            'outbound_do_detail' => $this->outbounddo->get_outbounddo_detail($id)
		];

		echo view('layout/header', $data);
		echo view('outbound/do_realization', $dataObject);
		echo view('layout/footer');
	}

    public function update(){
        $validate = $this->validate([
            'do_id' => ['label' => 'Shipping ID', 'rules' => 'required']
        ]);

        if (!$validate) {
            return redirect()->to(base_url('/outbounddo/edit'))->withInput();
        } else { 
            $id = $this->request->getPost('do_id');
            $data_inbound = [
                'do_status' => 2,
                'updated_date' => date('Y-m-d H:i:s'),
                'updated_by' => session()->get('fullname')
            ];

            $this->outbounddo->update_data($id, $data_inbound);

            if(@$this->request->getPost('do_detail_id')){
                $i=0;
                foreach($this->request->getPost('do_detail_id') as $row){
                    $id = $this->request->getPost('do_detail_id['.$i.']');
                    $outbound_id = $this->request->getPost('outbound_id['.$i.']');
                    $do_ongkir = str_replace(",", "", $this->request->getPost('do_ongkir['.$i.']'));
                    $outboundpo_id = $this->outbound->get_outbound_byid($outbound_id)->po_outbound_id;
                    $owners_id = $this->outboundpo->get_outbound_byid($outboundpo_id)->owners_id;

                    $data_do_detail = [
                        'do_ongkir' => $do_ongkir,
                        'do_out_resi' => $this->request->getPost('do_out_resi['.$i.']'),
                        'status' => 2
                    ];

                    $bill_id = $this->bill->generate_id();
                    $data_bill = [
                        'bill_id' => $bill_id,
                        'owners_id' => $owners_id,
                        'ref_id' => $id,
                        'po_id' => $outboundpo_id,
                        'description' => 'BIAYA ONGKIR',
                        'amount' => $do_ongkir,
                        'created_date' => date('Y-m-d H:i:s'),
                        'bill_status' => 0
                    ];

                    $this->bill->insert_data($data_bill);

                    // start of: proses pemotongan saldo
                    $admin_fee_data = $this->bill->get_bill_by_desc($outboundpo_id, 'ADMIN FEE');
                    $admin_fee_amount = $admin_fee_data[0]->amount;
                    $packing_fee_data = $this->bill->get_bill_by_desc($outboundpo_id, 'BIAYA PACKING');
                    $packing_fee_amount = $packing_fee_data[0]->amount;
                    $shipping_fee_data = $this->bill->get_bill_by_desc($outboundpo_id, 'BIAYA ONGKIR');
                    $shipping_fee_amount = $shipping_fee_data[0]->amount;

                    $po_data = $this->outbound->get_outbound_byid($outboundpo_id); // ini pake model outbound po
                    $owners_balance = $this->owner->get_owner_byid($owners_id)->owners_balance;
                    // $total_amount = 0;

                    $balance_updated = $owners_balance - ($admin_fee_amount + $packing_fee_amount + $shipping_fee_amount);
                    $data = [
                        'bill_status' => 1
                    ];
                    
                    $data_owner = [
                        'owners_balance' => $balance_updated
                    ];

                    $result = $this->bill->update_data_byPO($outboundpo_id, $data);   
                    $resultOwners = $this->owner->update_data($owners_id, $data_owner);

                    // end of: pemotongan saldo

                    $data_outbound = [
                        'status' => 4
                    ];

                    $data_po_outbound = [
                        'po_out_status' => 4
                    ];

                    $this->outbounddo_detail->update_data($id, $data_do_detail);

                    $this->outbound->update_data($outbound_id, $data_outbound);
                    $this->outboundpo->update_data($outboundpo_id, $data_po_outbound);
                    $i++;
                }
            }
        }

        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Shipping successfully updated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('outbounddo'));
    }

    public function get_shipping_detail(){
        $post = $this->request->getPost('do_id');
        
        $data = array(
            'do_detail' => $this->outbounddo_detail->get_outbounddo_detail($post)
        );

        echo view('outbound/detail_do', $data);
    }

    public function detail($id)
	{
		$data = [
            'title' => 'Outbound',
            'title_menu' => 'Outbound',
            'sidebar' => 'Outbound'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'data_outbound' => $this->outbound->get_outbound_byid($id),
            'outbound_detail' => $this->outbound->get_outbound_detail($id)
		];

		echo view('layout/header', $data);
		echo view('outbound/detail', $dataObject);
		echo view('layout/footer');
	}

    public function delete(){
        $id = $this->request->getGet('id');

        $result = $this->outbound_detail->delete_data($id);

        $result1 = $this->outbound->delete_data($id);

        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Outbound successfully inactivated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('outbound'));
    }

    function get_material_byowner(){
        $owner_id = $this->request->getPost('owner_id');
        $warehouse_id = $this->request->getPost('warehouse_id');
        $data = $this->material_detail->get_material_byowner($owner_id, $warehouse_id);
        echo json_encode($data);
    }

    function get_location_bymaterial(){
        $owner_id = $this->request->getPost('owner_id');
        $warehouse_id = $this->request->getPost('warehouse_id');
        $material_id = $this->request->getPost('material_id');
        $data = $this->material_detail->get_location_bymaterial($owner_id, $warehouse_id, $material_id);
        echo json_encode($data);
    }

    function get_qty_bylocation(){
        $owner_id = $this->request->getPost('owner_id');
        $warehouse_id = $this->request->getPost('warehouse_id');
        $material_id = $this->request->getPost('material_id');
        $location_id = $this->request->getPost('location_id');
        $data = $this->material_detail->get_qty_bylocation($owner_id, $warehouse_id, $material_id, $location_id);
        echo json_encode($data);
    }

    function testaja() {
        $api_pos_token = $this->outbounddo->api_pos_token();
        var_dump($api_pos_token->access_token);
    }
}
?>