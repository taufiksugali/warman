<?php namespace App\Models;

use CodeIgniter\Model;

class OutbounddoModel extends Model
{
    protected $table = "outbound_do";
    protected $primaryKey = 'do_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(do_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(do_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "ODO".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    // Serverside
    public function all_outbound($limit, $start, $col, $dir)
    {
      if(session()->get('warehouse_id') == 'POSLOG'){
        $query = $this->db->table($this->table)
                ->select('outbound_do.do_id
                        , outbound_do.do_trans_resi
                        , outbound_do.do_status
                        , outbound_do.do_process_stt
                        , outbound_do.do_date
                        , outbound_do.do_created_date
                        , outbound_do.do_created_by')
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
      } else {
        $query = $this->db->table($this->table)
                ->select('outbound_do.do_id
                        , outbound_do.do_trans_resi
                        , outbound_do.do_status
                        , outbound_do.do_process_stt
                        , outbound_do.do_date
                        , outbound_do.do_created_date
                        , outbound_do.do_created_by')
                ->join('outbound_do_detail', 'outbound_do.do_id=outbound_do_detail.do_id')
                ->join('outbound', 'outbound_do_detail.outbound_id=outbound.outbound_id')
                ->where('outbound.outbound_wh_asal', @session()->get('warehouse_id'))
                ->groupBy('outbound_do.do_id')
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
      }
    }

    public function all_outbound_count()
    {
      if(session()->get('warehouse_id') == 'POSLOG'){
        $query = $this->db->table($this->table)
                ->select('outbound_do.do_id
                    , outbound_do.do_status
                    , outbound_do.do_process_stt
                    , outbound_do.do_date
                    , outbound_do.do_created_date
                    , outbound_do.do_created_by');
        return $query->countAllResults();
      } else {
        $query = $this->db->table($this->table)
                ->select('outbound_do.do_id
                    , outbound_do.do_status
                    , outbound_do.do_process_stt
                    , outbound_do.do_date
                    , outbound_do.do_created_date
                    , outbound_do.do_created_by')
                ->join('outbound_do_detail', 'outbound_do.do_id=outbound_do_detail.do_id')
                ->join('outbound', 'outbound_do_detail.outbound_id=outbound.outbound_id')
                ->where('outbound.outbound_wh_asal', @session()->get('warehouse_id'))
                ->groupBy('outbound_do.do_id');
        return $query->countAllResults();
      }
    }

    public function search_outbound($limit, $start, $search, $col, $dir)
    {
      if(session()->get('warehouse_id') == 'POSLOG'){
        $query = $this->db->table($this->table)
                ->select('outbound_do.do_id
                    , outbound_do.do_status
                    , outbound_do.do_process_stt
                    , outbound_do.do_date
                    , outbound_do.do_created_date
                    , outbound_do.do_created_by')
                ->like('outbound_do.do_id', $search)
                ->orLike('outbound_do.do_date', $search)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
      } else {
        $query = $this->db->table($this->table)
                ->select('outbound_do.do_id
                    , outbound_do.do_status
                    , outbound_do.do_process_stt
                    , outbound_do.do_date
                    , outbound_do.do_created_date
                    , outbound_do.do_created_by')
                ->join('outbound_do_detail', 'outbound_do.do_id=outbound_do_detail.do_id')
                ->join('outbound', 'outbound_do_detail.outbound_id=outbound.outbound_id')
                ->where('outbound.outbound_wh_asal', @session()->get('warehouse_id'))
                ->groupStart()
                  ->like('outbound_do.do_id', $search)
                  ->orLike('outbound_do.do_date', $search)
                ->groupEnd()
                ->groupBy('outbound_do.do_id')
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
      }
    }

    public function search_outbound_count($search)
    {
      if(session()->get('warehouse_id') == 'POSLOG'){
        $query = $this->db->table($this->table)
                ->selectCount($this->primaryKey, 'total')
                ->select('outbound_do.do_id
                    , outbound_do.do_status
                    , outbound_do.do_process_stt
                    , outbound_do.do_date
                    , outbound_do.do_created_date
                    , outbound_do.do_created_by')
                ->like('outbound_do.do_id', $search)
                ->orLike('outbound_do.do_date', $search)
                ->get();
        return $query->getRow()->total;
      } else {
        $query = $this->db->table($this->table)
                ->selectCount($this->primaryKey, 'total')
                ->select('outbound_do.do_id
                    , outbound_do.do_status
                    , outbound_do.do_process_stt
                    , outbound_do.do_date
                    , outbound_do.do_created_date
                    , outbound_do.do_created_by')
                ->join('outbound_do_detail', 'outbound_do.do_id=outbound_do_detail.do_id')
                ->join('outbound', 'outbound_do_detail.outbound_id=outbound.outbound_id')
                ->where('outbound.outbound_wh_asal', @session()->get('warehouse_id'))
                ->groupStart()
                  ->like('outbound_do.do_id', $search)
                  ->orLike('outbound_do.do_date', $search)
                ->groupEnd()
                ->groupBy('outbound_do.do_id')
                ->get();
        return $query->getRow()->total;
      }
    }
    // End Serverside

    // Serverside
    public function all_outbound_bystatus($limit, $start, $col, $dir, $status)
    {
        $query = $this->db->table($this->table)
                ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                ->join('customer', 'outbound.penerima=customer.customer_id')
                ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                ->where('outbound.status', $status)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function all_outbound_count_bystatus($status)
    {
        $query = $this->db->table($this->table)
                ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                ->join('customer', 'outbound.penerima=customer.customer_id')
                ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                ->where('outbound.status', $status);
        return $query->countAllResults();
    }

    public function search_outbound_bystatus($limit, $start, $search, $col, $dir, $status)
    {
        $query = $this->db->table($this->table)
                ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                ->join('customer', 'outbound.penerima=customer.customer_id')
                ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                ->groupStart()
                    ->like('customer.customer_name', $search)
                    ->orLike('warehouse.wh_name', $search)
                    ->orLike('trans_type.trans_type_name', $search)
                    ->orLike('outbound.outbound_doc', $search)
                    ->orLike('outbound.outbound_doc_date', $search)
                    ->orLike('outbound.create_date', $search)
                ->groupEnd()
                ->where('outbound.status', $status)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function search_outbound_count_bystatus($search, $status)
    {
        $query = $this->db->table($this->table)
                ->selectCount($this->primaryKey, 'total')
                ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                ->join('customer', 'outbound.penerima=customer.customer_id')
                ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                ->groupStart()
                    ->like('customer.customer_name', $search)
                    ->orLike('warehouse.wh_name', $search)
                    ->orLike('trans_type.trans_type_name', $search)
                    ->orLike('outbound.outbound_doc', $search)
                    ->orLike('outbound.outbound_doc_date', $search)
                    ->orLike('outbound.create_date', $search)
                ->groupEnd()
                ->where('outbound.status', $status)
                ->get();
        return $query->getRow()->total;
    }
    // End Serverside

    public function insert_data($data)
    {
        return $this->db->table($this->table)
                ->insert($data);
    }

    public function update_data($id, $data)
    {
        $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->update($data);
    }

    public function delete_data($id)
    {
        $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->delete();
    }

    public function get_transporter()
    {
        $query = $this->db->table('transporter')
                ->select('transporter.transporter_id
                        , transporter.transporter_name
                        , transporter.transporter_alias
                        , transporter.transporter_photo
                        , transporter.transporter_status')
                ->where('transporter_status', 1)
                ->get();
        return $query->getResult();
    }

    
    public function get_outbound_detail_v2($id){
        $query = $this->db->table('outbound_detail')
        ->join('outbound', 'outbound_detail.outbound_id = outbound.outbound_id')
        ->join('material_detail', 'outbound_detail.material_detail_id = material_detail.mat_detail_id', 'left')
        ->join('material', 'outbound_detail.material_id = material.material_id', 'left')
        ->join('owners', 'outbound.owners_id = owners.owners_id', 'left')
        ->join('material_location', 'material_location.material_detail_id=material_detail.mat_detail_id', 'left')
        ->join('shelf', 'material_location.shelf_id=shelf.shelf_id', 'left')
        ->join('uom', 'material.mat_uom=uom.uom_id')
        ->where('outbound_detail.outbound_id', $id)   
        ->get();
        return $query->getResult();
    }
    
    public function get_outbounddo_byid($id){
        $query = $this->db->table($this->table)
        ->select('outbound_do.do_id
        , outbound_do.do_status
        , outbound_do.do_process_stt
        , outbound_do.do_date
        , outbound_do.do_created_date
        , outbound_do.do_created_by')
        ->where('outbound_do.do_id', $id)
        ->limit(1)
        ->get();
        return $query->getRow(); 
    }
    
    public function get_outbounddo_detail($id){
        $query = $this->db->table('outbound_do_detail')
                ->join('outbound_do', 'outbound_do_detail.do_id = outbound_do.do_id')
                ->join('outbound', 'outbound_do_detail.outbound_id = outbound.outbound_id')
                ->join('po_outbound', 'outbound.po_outbound_id = po_outbound.po_outbound_id')
                ->join('customer', 'po_outbound.po_penerima = customer.customer_id')
                ->join('transporter', 'outbound_do_detail.transporter_id = transporter.transporter_id', 'LEFT')
                ->where('outbound_do_detail.do_id', $id)   
                ->get();
        return $query->getResult();
    }

    public function get_awbNumber($po_id){
        $query = $this->db->table('outbound_do_detail')
                ->join('outbound', 'outbound_do_detail.outbound_id = outbound.outbound_id')
                ->where('outbound.po_outbound_id', $po_id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function print_history($cond){
        // $query = $this->db->query("SELECT ob.`outbound_id` AS nomor
        //             , ob.`out_date` AS tgl_penyerahan
        //             , ob.`outbound_wh_asal`
        //             , wh.`wh_name` AS gd_pengirim
        //             , ob.`penerima`
        //             , cs.`customer_name`
        //             FROM outbound ob 
        //             JOIN `warehouse` wh ON ob.`outbound_wh_asal` = wh.`warehouse_id`
        //             JOIN customer cs ON ob.`penerima` = cs.`customer_id`
        //     $cond");
        $query = $this->db->table('outbound ob')
                ->select('ob.outbound_id AS nomor
                        , ob.out_date AS tgl_penyerahan
                        , ob.outbound_wh_asal
                        , wh.wh_name AS gd_pengirim
                        , ob.penerima
                        , cs.customer_name')
                ->join('customer cs', 'ob.penerima = cs.customer_id')
                ->join('warehouse wh', 'ob.outbound_wh_asal = wh.warehouse_id')
                ->where($cond)
                ->limit(1)
                ->get();
        return $query->getRow(); 
    }

    public function print_history_detail($cond){
        // $query = $this->db->query("SELECT
        // m.`material_name` AS nama_produk
        // , obd.`qty_realization` AS total_keluar
        // FROM outbound_detail obd 
        // JOIN `material_detail` md ON obd.`material_detail_id` = md.`mat_detail_id`
        // JOIN material m ON md.`material_id` = m.`material_id`
        //     $cond");
        $query = $this->db->table('outbound_detail obd')
                ->select('m.`material_name`
                            , md.`material_id`
                            , obd.`qty_realization` AS total_keluar
                            , obd.koli')
                ->join('material_detail md', 'obd.material_detail_id = md.mat_detail_id')
                ->join('material m', 'md.material_id = m.material_id')
                ->where($cond)
                ->get();
        return $query->getResult();
    }

    public function api_pos_addposting($senderlocation, $receiverlocation, $pickuplocation, $itemproperties, $paymentvalues, $taxes, $outboundpo_id, $access_token) {
        $curl = curl_init();
        
        // LIVE
        // https://api.posindonesia.co.id:8245/webhook/1.0/AddPostingDoc
        // "LOGPOSLOG02170A"
        // $access_token
        // 57

        // DEVELOPMENT
        // https://sandbox.posindonesia.co.id:8245/webhookpos/1.0.1/AddPostingDoc
        // "DUMMY05400A"
        // c77b8601-fffd-32d2-ab4a-fd133beb0a65
        // 1
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sandbox.posindonesia.co.id:8245/webhookpos/1.0.1/AddPostingDoc',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "userid": 1,
                "memberid": "DUMMY05400A",
                "orderid": "'.$outboundpo_id.'",
                "addresses": [
                  {
                    "addresstype": "senderlocation",
                    "customertype": 1,
                    "name": "'.@$senderlocation['name'].'",
                    "phone": "'.@$senderlocation['phone'].'",
                    "email": "'.@$senderlocation['email'].'",
                    "address": "'.@$senderlocation['address'].'",
                    "subdistrict": "'.@$senderlocation['subdistrict'].'",
                    "city": "'.@$senderlocation['city'].'",
                    "province": "'.@$senderlocation['province'].'",
                    "zipcode": "'.@$senderlocation['zipcode'].'",
                    "country": "Indonesia",
                    "geolang": "",
                    "geolat": "",
                    "description": ""
                  },
                  {
                    "addresstype": "receiverlocation",
                    "customertype": 1,
                    "name": "'.@$receiverlocation['name'].'",
                    "phone": "'.@$receiverlocation['phone'].'",
                    "email": "'.@$receiverlocation['email'].'",
                    "address": "'.@$receiverlocation['address'].'",
                    "subdistrict": "'.@$receiverlocation['subdistrict'].'",
                    "city": "'.@$receiverlocation['city'].'",
                    "province": "'.@$receiverlocation['province'].'",
                    "zipcode": "'.@$receiverlocation['zipcode'].'",
                    "country": "Indonesia",
                    "geolang": "",
                    "geolat": "",
                    "description": ""
                  },
                  {
                    "addresstype": "pickuplocation",
                    "customertype": 1,
                    "name": "'.@$pickuplocation['name'].'",
                    "phone": "'.@$pickuplocation['phone'].'",
                    "email": "'.@$pickuplocation['email'].'",
                    "address": "'.@$pickuplocation['address'].'",
                    "subdistrict": "'.@$pickuplocation['subdistrict'].'",
                    "city": "'.@$pickuplocation['city'].'",
                    "province": "'.@$pickuplocation['province'].'",
                    "zipcode": "'.@$pickuplocation['zipcode'].'",
                    "country": "Indonesia",
                    "geolang": "'.@$pickuplocation['geolang'].'",
                    "geolat": "'.@$pickuplocation['geolat'].'",
                    "description": ""
                  },
                  {
                    "addresstype": "deliverylocation",
                    "customertype": 1,
                    "name": "'.@$receiverlocation['name'].'",
                    "phone": "'.@$receiverlocation['phone'].'",
                    "email": "'.@$receiverlocation['email'].'",
                    "address": "'.@$receiverlocation['address'].'",
                    "subdistrict": "'.@$receiverlocation['subdistrict'].'",
                    "city": "'.@$receiverlocation['city'].'",
                    "province": "'.@$receiverlocation['province'].'",
                    "zipcode": "'.@$receiverlocation['zipcode'].'",
                    "country": "Indonesia",
                    "geolang": "",
                    "geolat": "",
                    "description": ""
                  }
                ],
                "itemdetils": [
                  {
                    "hscode": "",
                    "origincountry": "",
                    "description": "",
                    "quantity": "",
                    "value": ""
                  }
                ],
                "itemproperties": {
                  "itemtypeid": 1,
                  "productid": "'.@$itemproperties['productid'].'",
                  "valuegoods": '.@$itemproperties['valuegoods'].',
                  "weight": '.@$itemproperties['weight'].',
                  "length": '.@$itemproperties['length'].',
                  "width": '.@$itemproperties['width'].',
                  "height": '.@$itemproperties['height'].',
                  "codvalue": '.@$itemproperties['codvalue'].',
                  "pin": '.@$itemproperties['pin'].',
                  "itemdesc": "'.@$itemproperties['itemdesc'].'"
                },
                "paymentvalues": [
                  {
                    "name": "fee",
                    "value": '.@$paymentvalues['fee'].'
                  },
                  {
                    "name": "insurance",
                    "value": '.@$paymentvalues['insurance'].'
                  }
                ],
                "taxes": [
                  {
                    "name": "fee",
                    "value": '.@$taxes['fee'].'
                  },
                  {
                    "name": "insurance",
                    "value": '.@$taxes['insurance'].'
                  }
                ],
                "services": [
                  {
                    "name": "insurance",
                    "value": 1
                  },
                  {
                    "name": "genreceipt",
                    "value": 1
                  },
                  {
                    "name": "printreceipt",
                    "value": 1
                  },
                  {
                    "name": "cod",
                    "value": 0
                  },
                  {
                    "name": "pickup",
                    "value": 1
                  },
                  {
                    "name": "delivery",
                    "value": 0
                  },
                  {
                    "name": "notiftosender",
                    "value": 0
                  },
                  {
                    "name": "notiftoreceiver",
                    "value": 0
                  }
                ]
              }',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Bearer c77b8601-fffd-32d2-ab4a-fd133beb0a65'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $data_log = [
          'log_desc' => $response,
          'user_id' => session()->get('user_id'),
          'log_date' => date('Y-m-d H:i:d'),
        ];
        $this->insert_data_log_respon($data_log);
        
        return json_decode($response);
    }

    public function api_pos_token() {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.posindonesia.co.id:8245/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Accept: application/json',
                'Authorization: Basic NXVnX1RIblczVDdEbmtHTno2SDliaFJqTFRZYTpXZjBxZnljWWFmSDduekxoZzhXa0dtb3lmVWth'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

    public function api_sicepat_requestpickuppackage($data_body) {
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://pickup.sicepat.com:8087/api/partner/requestpickuppackage',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
          "auth_key": "'.$data_body['auth_key'].'",
          "reference_number": "'.$data_body['reference_number'].'",
          "pickup_request_date": "'.$data_body['pickup_request_date'].'",
          "pickup_method": "'.$data_body['pickup_method'].'",
          "pickup_merchant_code": "'.$data_body['pickup_merchant_code'].'",
          "pickup_merchant_name": "'.$data_body['pickup_merchant_name'].'",
          "sicepat_account_code": "'.$data_body['sicepat_account_code'].'",
          "pickup_address": "'.$data_body['pickup_address'].'",
          "pickup_city": "'.$data_body['pickup_city'].'",
          "pickup_merchant_phone": "'.$data_body['pickup_merchant_phone'].'",
          "pickup_merchant_email": "'.$data_body['pickup_merchant_email'].'",
          "voucher_code": "'.$data_body['voucher_code'].'", 
          "PackageList": [ 
              { 
              "receipt_number": "'.$data_body['receipt_number'].'",
              "origin_code": "'.$data_body['origin_code'].'", 
              "delivery_type": "'.$data_body['delivery_type'].'", 
              "parcel_category": "'.$data_body['parcel_category'].'", 
              "parcel_content": "'.$data_body['parcel_content'].'", 
              "parcel_qty": '.$data_body['parcel_qty'].', 
              "parcel_uom": "'.$data_body['parcel_uom'].'", 
              "parcel_value": '.$data_body['parcel_value'].', 
              "total_weight": '.$data_body['total_weight'].', 
              "shipper_name": "'.$data_body['shipper_name'].'", 
              "shipper_address": "'.$data_body['shipper_address'].'", 
              "shipper_province": "'.$data_body['shipper_province'].'", 
              "shipper_city": "'.$data_body['shipper_city'].'", 
              "shipper_district": "'.$data_body['shipper_district'].'", 
              "shipper_zip": "'.$data_body['shipper_zip'].'", 
              "shipper_phone": "'.$data_body['shipper_phone'].'", 
              "shipper_longitude": "'.$data_body['shipper_longitude'].'", 
              "shipper_latitude": "'.$data_body['shipper_latitude'].'", 
              "recipient_title": "'.$data_body['recipient_title'].'", 
              "recipient_name": "'.$data_body['recipient_name'].'", 
              "recipient_address": "'.$data_body['recipient_address'].'",
              "recipient_province": "'.$data_body['recipient_province'].'", 
              "recipient_city": "'.$data_body['recipient_city'].'", 
              "recipient_district": "'.$data_body['recipient_district'].'", 
              "recipient_zip": "'.$data_body['recipient_zip'].'",
              "recipient_phone": "'.$data_body['recipient_phone'].'", 
              "recipient_longitude": "'.$data_body['recipient_longitude'].'",
              "recipient_latitude": "'.$data_body['recipient_latitude'].'", 
              "destination_code": "'.$data_body['destination_code'].'" 
              } 
          ] 
      }',
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json'
        ),
      ));

      $response = curl_exec($curl);
      curl_close($curl);

      $data_log = [
        'log_desc' => $response,
        'user_id' => session()->get('user_id'),
        'log_date' => date('Y-m-d H:i:d'),
      ];
      $this->insert_data_log_respon($data_log);

      return json_decode($response);
    }

    public function insert_data_log_respon($data) {
        return $this->db->table('log_respon_api')->insert($data);
    }
}
?>