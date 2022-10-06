<?php namespace App\Models;

use CodeIgniter\Model;

class OutboundpoModel extends Model
{
    protected $table = "po_outbound";
    protected $primaryKey = 'po_outbound_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(po_outbound_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(po_outbound_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "POT".$midId;
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
        if(session()->get('user_type')==1){
                $query = $this->db->table($this->table)
                        ->select('po_outbound.po_outbound_id
                                , po_outbound.po_outbound_doc
                                , po_outbound.po_out_status
                                , po_outbound.po_outbound_doc_date
                                , po_outbound.po_create_date
                                , customer.customer_name
                                , owners.owners_name
                                , warehouse.wh_name
                                , po_outbound.transporter_id
                                , po_outbound.po_resi_number')
                        ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                        ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                        ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                        ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
                        ->where('po_outbound.owners_id', session()->get('owners_id'))
                        ->limit($limit, $start)
                        ->orderBy('po_create_date', 'DESC')
                        ->orderBy($col, $dir)
                        ->get();
        } else {
                if(session()->get('warehouse_id') == 'POSLOG'){
                        $query = $this->db->table($this->table)
                                ->select('po_outbound.po_outbound_id
                                        , po_outbound.po_outbound_doc
                                        , po_outbound.po_out_status
                                        , po_outbound.po_outbound_doc_date
                                        , po_outbound.po_create_date
                                        , customer.customer_name
                                        , owners.owners_name
                                        , warehouse.wh_name
                                        , po_outbound.transporter_id
                                        , po_outbound.po_resi_number')
                                ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                                ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                                ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                                ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
                                ->limit($limit, $start)
                                ->orderBy($col, $dir)
                                ->get();
                } else {
                        $query = $this->db->table($this->table)
                                ->select('po_outbound.po_outbound_id
                                        , po_outbound.po_outbound_doc
                                        , po_outbound.po_out_status
                                        , po_outbound.po_outbound_doc_date
                                        , po_outbound.po_create_date
                                        , customer.customer_name
                                        , owners.owners_name
                                        , warehouse.wh_name
                                        , po_outbound.transporter_id
                                        , po_outbound.po_resi_number')
                                ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                                ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                                ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                                ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
                                ->where('po_outbound.warehouse_id', @session()->get('warehouse_id'))
                                ->limit($limit, $start)
                                ->orderBy($col, $dir)
                                ->get();
                }
        }
        return $query->getResult();
    }

    public function all_outbound_count()
    {
        if(session()->get('user_type')==1){
                $query = $this->db->table($this->table)
                        ->select('po_outbound.po_outbound_id
                                , po_outbound.po_outbound_doc
                                , po_outbound.po_out_status
                                , po_outbound.po_outbound_doc_date
                                , po_outbound.po_create_date
                                , customer.customer_name
                                , owners.owners_name
                                , warehouse.wh_name
                                , po_outbound.transporter_id
                                , po_outbound.po_resi_number')
                        ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                        ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                        ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                        ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
                        ->where('po_outbound.owners_id', session()->get('owners_id'));
        } else {
                if(session()->get('warehouse_id') == 'POSLOG'){
                        $query = $this->db->table($this->table)
                                ->select('po_outbound.po_outbound_id
                                        , po_outbound.po_outbound_doc
                                        , po_outbound.po_out_status
                                        , po_outbound.po_outbound_doc_date
                                        , po_outbound.po_create_date
                                        , customer.customer_name
                                        , owners.owners_name
                                        , warehouse.wh_name
                                        , po_outbound.transporter_id
                                        , po_outbound.po_resi_number')
                                ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                                ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                                ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                                ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id');
                } else {
                        $query = $this->db->table($this->table)
                                ->select('po_outbound.po_outbound_id
                                        , po_outbound.po_outbound_doc
                                        , po_outbound.po_out_status
                                        , po_outbound.po_outbound_doc_date
                                        , po_outbound.po_create_date
                                        , customer.customer_name
                                        , owners.owners_name
                                        , warehouse.wh_name
                                        , po_outbound.transporter_id
                                        , po_outbound.po_resi_number')
                                ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                                ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                                ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                                ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
                                ->where('po_outbound.warehouse_id', @session()->get('warehouse_id'));
                }
        }
        return $query->countAllResults();
    }

    public function search_outbound($limit, $start, $search, $col, $dir)
    {  
        if(session()->get('user_type')==1){
                $query = $this->db->table($this->table)
                        ->select('po_outbound.po_outbound_id
                                , po_outbound.po_outbound_doc
                                , po_outbound.po_out_status
                                , po_outbound.po_outbound_doc_date
                                , po_outbound.po_create_date
                                , customer.customer_name
                                , owners.owners_name
                                , warehouse.wh_name
                                , po_outbound.transporter_id
                                , po_outbound.po_resi_number')
                        ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                        ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                        ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                        ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
                        ->where('po_outbound.owners_id', session()->get('owners_id'))
                        ->groupStart()
                                ->like('customer.customer_name', $search)
                                ->orLike('warehouse.wh_name', $search)
                                ->orLike('po_outbound.po_outbound_id', $search)
                                ->orLike('trans_type.trans_type_name', $search)
                                ->orLike('po_outbound.po_outbound_doc', $search)
                                ->orLike('po_outbound.po_outbound_doc_date', $search)
                                ->orLike('po_outbound.po_create_date', $search)
                        ->groupEnd()
                        ->limit($limit, $start)
                        ->orderBy('po_create_date', 'DESC')
                        ->orderBy($col, $dir)
                        ->get();
        } else {
                if(session()->get('warehouse_id') == 'POSLOG'){
                        $query = $this->db->table($this->table)
                                ->select('po_outbound.po_outbound_id
                                        , po_outbound.po_outbound_doc
                                        , po_outbound.po_out_status
                                        , po_outbound.po_outbound_doc_date
                                        , po_outbound.po_create_date
                                        , customer.customer_name
                                        , owners.owners_name
                                        , warehouse.wh_name
                                        , po_outbound.transporter_id
                                        , po_outbound.po_resi_number')
                                ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                                ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                                ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                                ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
                                ->groupStart()
                                        ->like('customer.customer_name', $search)
                                        ->orLike('warehouse.wh_name', $search)
                                        ->orLike('owners.owners_name', $search)
                                        ->orLike('po_outbound.po_outbound_id', $search)
                                        ->orLike('trans_type.trans_type_name', $search)
                                        ->orLike('po_outbound.po_outbound_doc', $search)
                                        ->orLike('po_outbound.po_outbound_doc_date', $search)
                                        ->orLike('po_outbound.po_create_date', $search)
                                ->groupEnd()
                                ->limit($limit, $start)
                                ->orderBy('po_create_date', 'DESC')
                                ->orderBy($col, $dir)
                                ->get();
                } else {
                        $query = $this->db->table($this->table)
                                ->select('po_outbound.po_outbound_id
                                        , po_outbound.po_outbound_doc
                                        , po_outbound.po_out_status
                                        , po_outbound.po_outbound_doc_date
                                        , po_outbound.po_create_date
                                        , customer.customer_name
                                        , owners.owners_name
                                        , warehouse.wh_name
                                        , po_outbound.transporter_id
                                        , po_outbound.po_resi_number')
                                ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                                ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                                ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                                ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
                                ->where('po_outbound.warehouse_id', @session()->get('warehouse_id'))
                                ->groupStart()
                                        ->like('customer.customer_name', $search)
                                        ->orLike('warehouse.wh_name', $search)
                                        ->orLike('owners.owners_name', $search)
                                        ->orLike('po_outbound.po_outbound_id', $search)
                                        ->orLike('trans_type.trans_type_name', $search)
                                        ->orLike('po_outbound.po_outbound_doc', $search)
                                        ->orLike('po_outbound.po_outbound_doc_date', $search)
                                        ->orLike('po_outbound.po_create_date', $search)
                                ->groupEnd()
                                ->limit($limit, $start)
                                ->orderBy('po_create_date', 'DESC')
                                ->orderBy($col, $dir)
                                ->get();
                }
        }
        return $query->getResult();
    }

    public function search_outbound_count($search)
    {
        if(session()->get('user_type')==1){
        $query = $this->db->table($this->table)
                ->selectCount($this->primaryKey, 'total')
                ->select('po_outbound.po_outbound_id
                        , po_outbound.po_outbound_doc
                        , po_outbound.po_out_status
                        , po_outbound.po_outbound_doc_date
                        , po_outbound.po_create_date
                        , customer.customer_name
                        , owners.owners_name
                        , warehouse.wh_name
                        , po_outbound.transporter_id
                        , po_outbound.po_resi_number')
                ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
                ->where('po_outbound.owners_id', session()->get('owners_id'))
                ->groupStart()
                        ->like('customer.customer_name', $search)
                        ->orLike('warehouse.wh_name', $search)
                        ->orLike('trans_type.trans_type_name', $search)
                        ->orLike('po_outbound.po_outbound_id', $search)
                        ->orLike('po_outbound.po_outbound_doc', $search)
                        ->orLike('po_outbound.po_outbound_doc_date', $search)
                        ->orLike('po_outbound.po_create_date', $search)
                ->groupEnd()
                ->get();
        } else {
                if(session()->get('warehouse_id') == 'POSLOG'){
                        $query = $this->db->table($this->table)
                                ->selectCount($this->primaryKey, 'total')
                                ->select('po_outbound.po_outbound_id
                                        , po_outbound.po_outbound_doc
                                        , po_outbound.po_out_status
                                        , po_outbound.po_outbound_doc_date
                                        , po_outbound.po_create_date
                                        , customer.customer_name
                                        , owners.owners_name
                                        , warehouse.wh_name
                                        , po_outbound.transporter_id
                                        , po_outbound.po_resi_number')
                                ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                                ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                                ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                                ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
                                ->like('customer.customer_name', $search)
                                ->orLike('warehouse.wh_name', $search)
                                ->orLike('owners.owners_name', $search)
                                ->orLike('trans_type.trans_type_name', $search)
                                ->orLike('po_outbound.po_outbound_id', $search)
                                ->orLike('po_outbound.po_outbound_doc', $search)
                                ->orLike('po_outbound.po_outbound_doc_date', $search)
                                ->orLike('po_outbound.po_create_date', $search)
                                ->get();
                } else {
                        $query = $this->db->table($this->table)
                                ->selectCount($this->primaryKey, 'total')
                                ->select('po_outbound.po_outbound_id
                                        , po_outbound.po_outbound_doc
                                        , po_outbound.po_out_status
                                        , po_outbound.po_outbound_doc_date
                                        , po_outbound.po_create_date
                                        , customer.customer_name
                                        , owners.owners_name
                                        , warehouse.wh_name
                                        , po_outbound.transporter_id
                                        , po_outbound.po_resi_number')
                                ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                                ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                                ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                                ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
                                ->where('po_outbound.warehouse_id', @session()->get('warehouse_id'))
                                ->groupStart()
                                        ->like('customer.customer_name', $search)
                                        ->orLike('warehouse.wh_name', $search)
                                        ->orLike('owners.owners_name', $search)
                                        ->orLike('trans_type.trans_type_name', $search)
                                        ->orLike('po_outbound.po_outbound_id', $search)
                                        ->orLike('po_outbound.po_outbound_doc', $search)
                                        ->orLike('po_outbound.po_outbound_doc_date', $search)
                                        ->orLike('po_outbound.po_create_date', $search)
                                ->groupEnd()
                                ->get();

                }
        }
        return $query->getRow()->total;
    }
    // End Serverside

    public function insert_data($data)
    {
        return $this->db->table($this->table)
                ->insert($data);
    }

    public function insert_data_po_service($data)
    {
        return $this->db->table('po_service')
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

    public function delete_data_po_service($id){
        $this->db->table('po_service')->where('po_outbound_id', $id)->delete();
    }

    public function get_byid_customer($id, $owners_id) {
        $query = $this->db->table('customer a')
                ->select('a.*, b.state_iso_code, b.state_ref_code, b.state_name, c.city_code, c.city_name, d.district_code, d.district_name, d.destination_code_sicepat, e.sdistrict_code, e.sdistrict_name, e.zip_code')
                ->join('state b', 'a.state_id = b.state_id')
                ->join('city c', 'a.city_id = c.city_id')
                ->join('district d', 'a.district_id = d.district_id')
                ->join('sub_district e', 'a.sdistrict_id = e.sdistrict_id')
                ->where('a.status', 1)
                ->where('a.owners_id', $owners_id)
                ->where('a.customer_id', $id)
                ->get();
        return $query->getRow();
    }

    public function get_byid_warehouse($id) {
        $query = $this->db->table('warehouse a')
                ->select('a.*, b.state_iso_code, b.state_ref_code, b.state_name, c.city_code, c.city_name, c.origin_code_sicepat, d.district_code, d.district_name, e.sdistrict_code, e.sdistrict_name, e.zip_code')
                ->join('state b', 'a.state_id = b.state_id')
                ->join('city c', 'a.city_id = c.city_id')
                ->join('district d', 'a.district_id = d.district_id')
                ->join('sub_district e', 'a.sdistrict_id = e.sdistrict_id')
                ->where('a.status', 1)
                ->where('a.warehouse_id', $id)
                ->get();
        return $query->getRow();
    }

    public function get_byid_owners($id) {
        $query = $this->db->table('owners a')
                ->select('a.*, b.state_iso_code, b.state_ref_code, b.state_name, c.city_code, c.city_name, d.district_code, d.district_name, e.sdistrict_code, e.sdistrict_name, e.zip_code')
                ->join('state b', 'a.state_id = b.state_id')
                ->join('city c', 'a.city_id = c.city_id')
                ->join('district d', 'a.district_id = d.district_id')
                ->join('sub_district e', 'a.sdistrict_id = e.sdistrict_id')
                ->where('a.owners_id', $id)
                ->get();
        return $query->getRow();
    }

    public function get_byid_usersowners($id) {
        $query = $this->db->table('users a')
                ->select('a.*')
                ->where('a.level_id', 'LV006')
                ->where('a.owners_id', $id)
                ->get();
        return $query->getRow();
    }

    public function get_byid_po_service($id) {
        $query = $this->db->table('po_service a')
                ->select('*')
                ->where('a.po_outbound_id', $id)
                ->get();
        return $query->getRow();
    }

    public function get_byid_transporter($id) {
        $query = $this->db->table('transporter a')
                ->select('*')
                ->where('a.transporter_id', $id)
                ->get();
        return $query->getRow();
    }

    public function get_byid_product($id) {
        $query = $this->db->table('material a')
                ->select('a.*')
                ->where('a.status', 1)
                ->where('a.material_id', $id)
                ->get();
        return $query->getRow();
    }

    
    public function get_fulfillment_time_record($outboundpo_id){
        $query = $this->db->table('outbound ob')
                        ->select('
                        po.`po_create_date` AS po_create_date
                        , po.`po_out_date`
                        , ob.`create_date` AS ob_create_date
                        , obd.`do_created_date` AS obd_create_date
                        , obd.`updated_date` AS obd_update_date')
                        ->join('po_outbound po', 'po.po_outbound_id = ob.po_outbound_id')
                        ->join('outbound_do_detail dod', 'dod.outbound_id = ob.outbound_id')
                        ->join('outbound_do obd', 'obd.do_id = dod.do_id')
                        ->where('ob.po_outbound_id', $outboundpo_id)
                        ->get();
        return $query->getRow();           
    }

    public function get_outbound_detail($id){
        $query = $this->db->table('po_out_detail')
                ->join('po_outbound', 'po_out_detail.po_outbound_id = po_outbound.po_outbound_id')
                ->join('material', 'po_out_detail.material_id = material.material_id', 'left')
                ->join('owners', 'po_outbound.owners_id = owners.owners_id', 'left')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->where('po_out_detail.po_outbound_id', $id)   
                ->get();
        return $query->getResult();
    }

    public function get_outbound_byid($id){
        $query = $this->db->table($this->table)
                ->select('`po_outbound`.`po_outbound_id`
                , `po_outbound`.`po_outbound_type`
                , `po_outbound`.`po_penerima`
                , `customer`.`customer_name`
                , `customer`.`customer_phone`
                , `customer`.`customer_email`
                , `customer`.`customer_address`
                , `po_outbound`.`po_outbound_doc`
                , `po_outbound`.`po_outbound_doc_date`
                , `po_outbound`.`po_create_date`
                , `po_outbound`.`warehouse_id`
                , `warehouse`.`wh_name`
                , `warehouse`.`wh_address`
                , `po_outbound`.`po_out_status`
                , `po_outbound`.`po_out_date`
                , `po_outbound`.`po_create_by`
                , `po_outbound`.`po_description`
                , `po_outbound`.`owners_id`
                , `po_outbound`.`transporter_id`
                , `po_outbound`.`transporter_marketplace`
                , `po_outbound`.`po_resi_number`
                , `po_outbound`.`use_box`
                , `transporter`.`transporter_link`
                , `transporter`.`transporter_alias`
                , `owners`.`owners_name`
                , `owners`.`owners_address`
                , `owners`.`owners_balance`
                , `trans_type`.`trans_type_name`')
                ->join('customer', 'po_outbound.po_penerima = customer.customer_id')
                ->join('owners', 'po_outbound.owners_id = owners.owners_id')
                ->join('transporter', 'po_outbound.transporter_id = transporter.transporter_id', 'left')
                ->join('warehouse', 'po_outbound.warehouse_id = warehouse.warehouse_id')
                ->join('trans_type', 'po_outbound.po_outbound_type = trans_type.trans_type_id')
                ->where('po_outbound.po_outbound_id', $id)
                ->limit(1)
                ->get();
        return $query->getRow();        
    }

    public function get_outbound_byid_v2($id){
        $query = $this->db->table($this->table)
                ->select('`po_outbound`.`po_outbound_id`
                , `po_outbound`.`po_outbound_type`
                , `po_outbound`.`po_penerima`
                , `customer`.`customer_name`
                , `customer`.`customer_phone`
                , `customer`.`customer_email`
                , `customer`.`customer_address`
                , `po_outbound`.`po_outbound_doc`
                , `po_outbound`.`po_outbound_doc_date`
                , `po_outbound`.`po_create_date`
                , `po_outbound`.`warehouse_id`
                , `warehouse`.`wh_name`
                , `warehouse`.`wh_address`
                , `po_outbound`.`po_out_status`
                , `po_outbound`.`picking_status`
                , `po_outbound`.`picking_done`
                , `po_outbound`.`po_out_date`
                , `po_outbound`.`po_create_by`
                , `po_outbound`.`po_description`
                , `po_outbound`.`owners_id`
                , `po_outbound`.`transporter_id`
                , `po_outbound`.`transporter_marketplace`
                , `po_outbound`.`po_resi_number`
                , `po_outbound`.`use_box`
                , `transporter`.`transporter_link`
                , `transporter`.`transporter_alias`
                , `owners`.`owners_name`
                , `owners`.`owners_address`
                , `owners`.`owners_balance`
                , `trans_type`.`trans_type_name`')
                ->join('customer', 'po_outbound.po_penerima = customer.customer_id')
                ->join('owners', 'po_outbound.owners_id = owners.owners_id')
                ->join('transporter', 'po_outbound.transporter_id = transporter.transporter_id', 'left')
                ->join('warehouse', 'po_outbound.warehouse_id = warehouse.warehouse_id')
                ->join('trans_type', 'po_outbound.po_outbound_type = trans_type.trans_type_id')
                ->where('po_outbound.po_out_status','1')
                ->where('po_outbound.po_outbound_id', $id)
                ->limit(1)
                ->get();
        return $query->getRow();        
    }

    public function get_all_po(){
        $query = $this->db->table($this->table)
                ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                ->where('po_outbound.po_out_status', 1)
                ->where('po_outbound.transporter_id !=', NULL)
                ->orWhere('po_outbound.po_resi_number !=', NULL)
                ->where('po_outbound.po_out_status', 1)
                ->get();
        return $query->getResult();
    }

    public function print_history($cond){
        // $query = $this->db->query("SELECT ob.`outbound_id` AS nomor
        //             , ob.`out_date` AS tgl_penyerahan
        //             , ob.`warehouse_id`
        //             , wh.`wh_name` AS gd_pengirim
        //             , ob.`po_penerima`
        //             , cs.`customer_name`
        //             FROM outbound ob 
        //             JOIN `warehouse` wh ON ob.`warehouse_id` = wh.`warehouse_id`
        //             JOIN customer cs ON ob.`po_penerima` = cs.`customer_id`
        //     $cond");
        $query = $this->db->table('outbound ob')
                ->select('ob.outbound_id AS nomor
                        , ob.out_date AS tgl_penyerahan
                        , ob.warehouse_id
                        , wh.wh_name AS gd_pengirim
                        , ob.po_penerima
                        , cs.customer_name')
                ->join('customer cs', 'ob.penerima = cs.customer_id')
                ->join('warehouse wh', 'ob.warehouse_id = wh.warehouse_id')
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

    public function get_transporter_byalias($alias)
    {
        $query = $this->db->table('transporter')
                ->select('transporter.transporter_id
                        , transporter.transporter_name
                        , transporter.transporter_alias
                        , transporter.transporter_photo
                        , transporter.transporter_status')
                ->where('transporter_status', 1)
                ->where('transporter_alias', $alias)
                ->limit(1)
                ->get();
        return $query->getRow();;
    }

    public function api_pos_kurir($customer, $warehouse, $outbound_qty_tot, $weight_tot, $height_tot, $length_tot,  $width_tot, $price_tot, $customer_id, $access_token) {        
        $curl = curl_init();

        curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.posindonesia.co.id:8245/utility/1.0.0/getFee',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                        "customerid": "",
                        "desttypeid": "1",
                        "itemtypeid": "1",
                        "shipperzipcode": "'.@$warehouse->zip_code.'",
                        "receiverzipcode": "'.@$customer->zip_code.'",
                        "weight": '.$weight_tot.',
                        "length": '.$length_tot.',
                        "width": '.$width_tot.',
                        "height": '.$height_tot.',
                        "diameter": 0,
                        "valuegoods": '.$price_tot.'
                }',
        CURLOPT_HTTPHEADER => array(
                        'Accept: application/json',
                        'Content-Type: application/json',
                        'Authorization: Bearer f7e79643-79fe-34e3-a799-0e5599790a0c',
                        'X-POS-USER: poslogjkt',
                        'X-POS-PASSWORD: P@slo6Jak4rtaUtilitie'
                ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

    public function api_pos_trackandtrace($resi, $access_token) {        
        $curl = curl_init();

        curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.posindonesia.co.id:8245/utilitas/1.0.1/getTrackAndTrace',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                        "resi": "'.$resi.'"
                }',
                CURLOPT_HTTPHEADER => array(
                        'Accept: application/json',
                        'Content-Type: application/json',
                        'Authorization: Bearer '.$access_token
                ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
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

    public function api_sicepat_kurir($origin, $destination, $weight) {
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://apitrek.sicepat.com/customer/tariff?origin='.$origin.'&destination='.$destination.'&weight='.$weight,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'api-key: 61ab20b44f37164d1686e57eceb4227e',
            'Authorization: Bearer P0SLOG_H3B@T'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return json_decode($response);  
    }

    public function api_jne_kurir($origin, $destination, $weight) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://apiv2.jne.co.id:10102/tracing/api/pricedev',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'username=TESTAPI&api_key=25c898a9faea1a100859ecd9ef674548&from=CGK10000&thru=BDO10000&weight=1',
                // CURLOPT_POSTFIELDS => 'username=TESTAPI&api_key=25c898a9faea1a100859ecd9ef674548&from='.$origin.'&thru='.$destination.'&weight='.$weight,
                CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/x-www-form-urlencoded'
                ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);  
    }
}
?>