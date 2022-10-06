<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class Apiv1Model extends Model
{
    protected $table = "users";
    protected $primaryKey = 'user_id';
 
    public function __construct()
    {
        parent::__construct();
    }

    public function api_login_hris($username, $password) {
        $ArrayParse = array(
            'username' => $username,
            'password' => $password,
            'appid_key' => "posloghris-v1",
            'your_apps_id' => "APPS-009"
        );

        $signature = hash_hmac('sha256', json_encode($ArrayParse), "0a05252241f3bc45ffc4abaeca369963");
        
        $JsonFormatParse = json_encode($ArrayParse);

        $ch = curl_init();
        
        $headers  = array(
            'Content-Type: text/plain',
            'Cookie: ci_session=3v1e45vqid18dcrtiuqahh882siltv7l',
            'signature:' . $signature . ''
        );
        curl_setopt($ch, CURLOPT_URL, 'https://hris.poslogistics.co.id/api/Hris_Api/loginWeb');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $JsonFormatParse);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result     = curl_exec ($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $dataObject = json_decode($result);
        return $dataObject;
    }

    public function login($user_email, $user_password) {
		$query = $this->db->table('users')
		->where('email', $user_email)
		->where('password', $user_password)
		->limit(1)
		->get();
		return $query->getRow();
	}

    public function getUserByNik($id) {
		$query = $this->db->table('user_hris_role hris')
                 ->select("hris.hris_nik, hris.hris_name, hris.hris_email, hris.user_level, hris.warehouse_id, hris.hris_status, lvl.level_name, wh.wh_name")
                 ->join('warehouse wh', 'hris.warehouse_id = wh.warehouse_id', 'left')
                 ->join('user_level lvl', 'hris.user_level = lvl.level_id', 'left')
                ->where('hris_nik', $id)
                ->limit(1)
                ->get();
		return $query->getRow();
	}

    public function getUserByUserId($id) {
		$query = $this->db->table('users')
                ->select("*")
                ->join('owners', 'users.owners_id = owners.owners_id', 'left')
                ->join('state', 'owners.state_id = state.state_id', 'left')
                ->join('city', 'owners.city_id = city.city_id', 'left')
                ->join('district', 'owners.district_id = district.district_id', 'left')
                ->join('sub_district', 'owners.sdistrict_id = sub_district.sdistrict_id', 'left')
                ->join('bank', 'owners.bank_id = bank.bank_id', 'left')
                ->where('MD5(`user_id`)', $id)
                ->limit(1)
                ->get();
		return $query->getRow();
	}

    public function get_shelf_byid($id, $warehouse_id) {
        $query = $this->db->table('shelf')
                ->join('rak', 'shelf.rak_id=rak.rak_id')
                ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                ->where('shelf.shelf_id', $id)
                ->where('warehouse.warehouse_id', $warehouse_id)
                ->where('shelf.status', '1')
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_detail_material($det_inbound_id, $warehouse_id){
        $query = $this->db->table('inbound_detail')
                ->select('inbound_detail.det_inbound_id, material.material_name, inbound_detail.material_detail_id, 
                inbound_detail.qty_good_in, inbound_detail.qty_notgood_in, inbound_detail.qty_realization, inbound.inbound_id')
                ->join('inbound', 'inbound_detail.inbound_id = inbound.inbound_id')
                ->join('po_detail', 'inbound_detail.po_detail_id=po_detail.po_detail_id')
                ->join('material', 'po_detail.material_id=material.material_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->where('inbound_detail.status', 2)
                ->where('inbound_detail.det_inbound_id', $det_inbound_id)
                ->where('inbound.inbound_location', $warehouse_id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_materials_byshelf($shelf_id){
        $query = $this->db->table('material_location')
                ->select('material_location.`shelf_id`
                            , material_detail.`material_id`
                            , material.`material_name`
                            , material_location.`qty`')
                ->join('material_detail', 'material_location.`material_detail_id` = material_detail.`mat_detail_id`')
                ->join('material', 'material_detail.`material_id` = material.`material_id`')
                ->where('material_location.`shelf_id`', $shelf_id)
                ->get();
        return $query->getResult();
    }

    public function get_outbound_byid($id){
        $query = $this->db->table('po_outbound')
                ->select('`po_outbound`.`po_outbound_id`
                , `po_outbound`.`po_outbound_type`
                , `po_outbound`.`po_penerima`
                , `customer`.`customer_name`
                , `customer`.`customer_id`
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
                , `owners`.`owners_name`
                , `owners`.`owners_address`
                , `trans_type`.`trans_type_name`')
                ->join('customer', 'po_outbound.po_penerima = customer.customer_id')
                ->join('owners', 'po_outbound.owners_id = owners.owners_id')
                ->join('warehouse', 'po_outbound.warehouse_id = warehouse.warehouse_id')
                ->join('trans_type', 'po_outbound.po_outbound_type = trans_type.trans_type_id')
                ->where('po_outbound.po_outbound_id', $id)
                ->limit(1)
                ->get();
        return $query->getRow();        
    }

    public function get_all_material_byowner($owner_id, $warehouse_id) {
        $query = $this->db->table('material_detail')
                ->select('`material_detail`.`mat_detail_id`
                , `material`.`material_name`
                , `material_detail`.`owner_id`
                , `material_detail`.`material_id`
                , `owners`.`owners_status`
                , `material_detail`.`expired_date`
                , `material_detail`.`batch_no`
                , `material_location`.`shelf_id`
                , `material_location`.`location_id`
                , `shelf`.`shelf_name`
                , `rak`.`rak_name`
                , `area_blok`.`blok_name`
                , `wh_area`.`wh_area_name`
                , `warehouse`.`warehouse_id`
                , `warehouse`.`wh_name`
                , `material_location`.`qty`')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->join('material_location', 'material_location.material_detail_id=material_detail.mat_detail_id')
                ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                ->join('owners', 'material_detail.owner_id=owners.owners_id')
                ->join('rak', 'shelf.rak_id = rak.rak_id')
                ->join('area_blok', 'rak.blok_id = area_blok.blok_id')
                ->join('wh_area', 'area_blok.wh_area_id = wh_area.area_id')
                ->join('warehouse', 'wh_area.wh_id = warehouse.warehouse_id')
                ->where('material_location.qty > 0')
                ->where('owners.owners_id', $owner_id)
                ->where('warehouse.warehouse_id', $warehouse_id)
                ->groupBy('`material_detail`.`mat_detail_id`')
                ->get();
        return $query->getResult();
    }

    public function get_qty_bylocation_po($owner_id, $warehouse_id, $material_id) {
        $query = $this->db->table('material_detail')
                ->select('
                    SUM(`material_location`.`qty`) AS qty
                    , material_detail.material_price')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->join('material_location', 'material_location.material_detail_id=material_detail.mat_detail_id')
                ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                ->join('owners', 'material_detail.owner_id=owners.owners_id')
                ->join('rak', 'shelf.rak_id = rak.rak_id')
                ->join('area_blok', 'rak.blok_id = area_blok.blok_id')
                ->join('wh_area', 'area_blok.wh_area_id = wh_area.area_id')
                ->join('warehouse', 'wh_area.wh_id = warehouse.warehouse_id') 
                ->where('material_location.qty > 0')
                ->where('wh_area.area_mat_st', 1)
                ->where('owners.owners_id', $owner_id)
                ->where('warehouse.warehouse_id', $warehouse_id)
                ->where('material_detail.material_id', $material_id)
                ->get();
        return $query->getRow();
    }

    public function get_qty_bylocation_po_ng($owner_id, $warehouse_id, $material_id) {
        $query = $this->db->table('material_detail')
                ->select('
                SUM(`material_location`.`qty`) AS qty')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->join('material_location', 'material_location.material_detail_id=material_detail.mat_detail_id')
                ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                ->join('owners', 'material_detail.owner_id=owners.owners_id')
                ->join('rak', 'shelf.rak_id = rak.rak_id')
                ->join('area_blok', 'rak.blok_id = area_blok.blok_id')
                ->join('wh_area', 'area_blok.wh_area_id = wh_area.area_id')
                ->join('warehouse', 'wh_area.wh_id = warehouse.warehouse_id') 
                ->where('material_location.qty > 0')
                ->where('wh_area.area_mat_st', 0)
                ->where('owners.owners_id', $owner_id)
                ->where('warehouse.warehouse_id', $warehouse_id)
                ->where('material_detail.material_id', $material_id)
                ->get();
        return $query->getRow();
    }

    public function get_outbound_detail($id) {
        $query = $this->db->table('po_out_detail')
                ->join('po_outbound', 'po_out_detail.po_outbound_id = po_outbound.po_outbound_id')
                ->join('material', 'po_out_detail.material_id = material.material_id', 'left')
                ->join('owners', 'po_outbound.owners_id = owners.owners_id', 'left')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->where('po_out_detail.po_outbound_id', $id)   
                ->get();
        return $query->getResult();
    }

    public function get_bill_bypo_id($id) {
        $query = $this->db->table('owners_bill')
                ->select('owners_bill.*, owners.owners_balance')
                ->join('owners', 'owners_bill.owners_id=owners.owners_id')
                ->where('po_id', $id)
                ->get();
        return $query->getResult();
    }

    public function get_location_bymaterial($owner_id, $warehouse_id, $mat_detail_id, $shelf_id) {
        $query = $this->db->table('material_detail')
                ->select('`material_detail`.`mat_detail_id`
                , `material`.`material_name`
                , `material_detail`.`owner_id`
                , `owners`.`owners_status`
                , `material_detail`.`expired_date`
                , `material_detail`.`batch_no`
                , `material_location`.`shelf_id`
                , `material_location`.`location_id`
                , `shelf`.`shelf_name`
                , `rak`.`rak_name`
                , `area_blok`.`blok_name`
                , `wh_area`.`wh_area_name`
                , `warehouse`.`warehouse_id`
                , `warehouse`.`wh_name`
                , `material_location`.`qty`')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->join('material_location', 'material_location.material_detail_id=material_detail.mat_detail_id')
                ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                ->join('owners', 'material_detail.owner_id=owners.owners_id')
                ->join('rak', 'shelf.rak_id = rak.rak_id')
                ->join('area_blok', 'rak.blok_id = area_blok.blok_id')
                ->join('wh_area', 'area_blok.wh_area_id = wh_area.area_id')
                ->join('warehouse', 'wh_area.wh_id = warehouse.warehouse_id')
                ->where('material_location.qty > 0')
                ->where('owners.owners_id', $owner_id)
                ->where('warehouse.warehouse_id', $warehouse_id)
                ->where('material_detail.mat_detail_id', $mat_detail_id)
                ->where('shelf.shelf_id', $shelf_id)
                ->get();
                // echo $this->db->getLastQuery(); die();
        return $query->getRow();
    }

    public function get_qty_bylocation($owner_id, $warehouse_id, $mat_detail_id, $location_id){
        $query = $this->db->table('material_detail')
                ->select('`material_detail`.`mat_detail_id`
                , `material`.`material_name`
                , `material_detail`.`owner_id`
                , `owners`.`owners_status`
                , `material_detail`.`expired_date`
                , `material_detail`.`batch_no`
                , `material_location`.`shelf_id`
                , `material_location`.`location_id`
                , `shelf`.`shelf_name`
                , `rak`.`rak_name`
                , `area_blok`.`blok_name`
                , `wh_area`.`wh_area_name`
                , `warehouse`.`warehouse_id`
                , `warehouse`.`wh_name`
                , `material_location`.`qty`')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->join('material_location', 'material_location.material_detail_id=material_detail.mat_detail_id')
                ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                ->join('owners', 'material_detail.owner_id=owners.owners_id')
                ->join('rak', 'shelf.rak_id = rak.rak_id')
                ->join('area_blok', 'rak.blok_id = area_blok.blok_id')
                ->join('wh_area', 'area_blok.wh_area_id = wh_area.area_id')
                ->join('warehouse', 'wh_area.wh_id = warehouse.warehouse_id') 
                ->where('material_location.qty > 0')
                ->where('owners.owners_id', $owner_id)
                ->where('warehouse.warehouse_id', $warehouse_id)
                ->where('material_detail.mat_detail_id', $mat_detail_id)
                ->where('material_location.location_id', $location_id)
                ->get();
        return $query->getResult();
    }

    public function get_outbound_by_owners($id, $param) {
        if ($param == 'Airwaybill') {
            $status = ['4', '5'];
        }

        if ($param == 'History') {
            $status = ['1', '2', '3', '4', '5', '6', '7'];
        }
        $query = $this->db->table('po_outbound')
                ->select('po_outbound.po_outbound_id
                , po_outbound.po_outbound_doc
                , po_outbound.po_out_status
                , po_outbound.po_outbound_doc_date
                , po_outbound.po_create_date
                , customer.customer_name
                , warehouse.wh_name')
                ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
                ->where('po_outbound.owners_id', $id)
                ->whereIn('po_outbound.po_out_status', $status)
                ->orderBy('po_outbound.po_create_date', 'DESC')
                ->get();
        return $query->getResult();
    }

    public function get_outbound_by_owners_date($id, $date_start, $date_end) {
        $status = ['4', '5', '6', '7'];
        $query = $this->db->table('po_outbound')
                ->select('po_outbound.po_outbound_id
                , po_outbound.po_outbound_doc
                , po_outbound.po_out_status
                , po_outbound.po_outbound_doc_date
                , po_outbound.po_create_date
                , customer.customer_name
                , warehouse.wh_name')
                ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
                ->where('po_outbound.owners_id', $id)
                ->where("po_outbound.po_out_date BETWEEN '$date_start' AND '$date_end'")
                ->whereIn('po_outbound.po_out_status', $status)
                ->orderBy('po_outbound.po_create_date', 'DESC')
                ->get();
        return $query->getResult();
    }

    public function get_topup_byownersid($id) {
        $query = $this->db->table('owners_topup')
                ->select('owners_topup.*, owners.owners_balance, owners.owners_id, owners.owners_name, bank.bank_name')
                ->join('owners', 'owners_topup.owners_id=owners.owners_id')
                ->join('bank', 'owners_topup.bank_id=bank.bank_id')
                ->where('owners_topup.owners_id', $id)
                ->orderBy('owners_topup.topup_id', 'DESC')
                ->get();
        return $query->getResult();
    }

    public function get_purchase_order($owners_id){
        $query = $this->db->table('purchase_order a')
                ->select('a.*')
                ->where('a.owners_id', $owners_id)
                ->get();
        return $query->getResult();
    }

    public function get_purchase_order_detail($po_id){
        $query = $this->db->table('po_detail a')
                ->select('a.*, b.*, c.*')
                ->join('material b', 'a.material_id = b.material_id')
                ->join('uom c', 'b.mat_uom = c.uom_id')
                ->where('a.po_id', $po_id)
                ->get();
        return $query->getResult();
    }

    public function get_supplier(){
        $query = $this->db->table('supplier')
                ->select('*')
                ->where('status', '1')
                ->get();
        return $query->getResult();
    }

    public function get_supplier_byid($supplier_id){
        $query = $this->db->table('supplier')
                ->select('*')
                ->where('status', '1')
                ->where('supplier_id', $supplier_id)
                ->get();
        return $query->getRow();
    }

    public function get_warehouse(){
        $query = $this->db->table('warehouse')
                ->select('*')
                ->where('status', '1')
                ->get();
        return $query->getResult();
    }

    public function get_warehouse_byid($warehouse_id){
        $query = $this->db->table('warehouse')
                ->select('*')
                ->where('status', '1')
                ->where('warehouse_id', $warehouse_id)
                ->get();
        return $query->getRow();
    }

    public function get_product(){
        $query = $this->db->table('material')
                ->select('*')
                ->where('status', '1')
                ->get();
        return $query->getResult();
    }

    public function get_product_byid($material_id){
        $query = $this->db->table('material')
                ->select('*')
                ->where('status', '1')
                ->where('material_id', $material_id)
                ->get();
        return $query->getRow();
    }

    public function get_product_byowner($param, $value){
        $query = $this->db->table('material')
                ->select('*')
                ->where('status', '1')
                ->where($param, $value)
                ->get();
        return $query->getResult();
    }

    public function get_customer(){
        $query = $this->db->table('customer')
                ->where('status', 1)
                ->get();
        return $query->getResult();
    }

    public function get_customer_byid($customer_id){
        $query = $this->db->table('customer')
                ->where('status', 1)
                ->where('customer_id', $customer_id)
                ->get();
        return $query->getRow();
    }

    public function get_bank_dest(){
        $query = $this->db->table('bank_dest')
                ->select('*')
                ->where('dest_status', '1')
                ->get();
        return $query->getResult();
    }

    public function get_bank_dest_byid($bank_id){
        $query = $this->db->table('bank_dest')
                ->select('*')
                ->where('dest_status', '1')
                ->where('dest_id', $bank_id)
                ->get();
        return $query->getRow();
    }
    
    public function get_bank(){
        $query = $this->db->table('bank')
                ->select('*')
                ->where('bank_status', '1')
                ->get();
        return $query->getResult();
    }

    public function get_bank_byid($bank_id){
        $query = $this->db->table('bank')
                ->select('*')
                ->where('bank_status', '1')
                ->where('bank_id', $bank_id)
                ->get();
        return $query->getRow();
    }

    public function get_transporter() {
        $query = $this->db->table('transporter')
                ->select('*')
                ->where('transporter_status', '1')
                ->get();
        return $query->getResult();
    }

    public function get_transporter_byid($transporter_id){
        $query = $this->db->table('transporter')
                ->select('*')
                ->where('transporter_status', '1')
                ->where('transporter_id', $transporter_id)
                ->get();
        return $query->getRow();
    }

    public function get_package_material() {
        $query = $this->db->table('package_material')
                ->select('*')
                ->where('pm_status', '1')
                ->get();
        return $query->getResult();
    }

    public function get_package_material_byid($id){
        $query = $this->db->table('package_material')
                ->select('*')
                ->where('pm_status', '1')
                ->where('id', $id)
                ->get();
        return $query->getRow();
    }

    public function get_material_group(){
        $query = $this->db->table('material_group')
                ->select('*')
                ->where('status', '1')
                ->get();
        return $query->getResult();
    }

    public function get_material_group_byid($mat_group_id){
        $query = $this->db->table('material_group')
                ->select('*')
                ->where('status', '1')
                ->where('mat_group_id', $mat_group_id)
                ->get();
        return $query->getRow();
    }

    public function get_uom(){
        $query = $this->db->table('uom')
                ->select('*')
                ->where('status', '1')
                ->get();
        return $query->getResult();
    }

    public function get_uom_byid($uom_id){
        $query = $this->db->table('uom')
                ->select('*')
                ->where('status', '1')
                ->where('uom_id', $uom_id)
                ->get();
        return $query->getRow();
    }

    public function total_admin_fee($owners_id) {
        $query = $this->db->table('owners_bill')
                ->select('SUM(`amount`) AS admin_fee')
                ->where('description', 'ADMIN FEE')
                ->where('owners_id', $owners_id)
                ->where('bill_status', 0)
                ->get();
        return $query->getResult();
    }

    public function total_biaya_kurir($owners_id) {
        $query = $this->db->table('owners_bill')
                ->select('SUM(`amount`) AS kurir')
                ->where('description', 'BIAYA ONGKIR')
                ->where('owners_id', $owners_id)
                ->where('bill_status', 0) 
                ->get();
        return $query->getResult();
    }

    public function total_biaya_packing($owners_id) {
        $query = $this->db->table('owners_bill')
                ->select('SUM(`amount`) AS packing')
                ->where('description', 'BIAYA PACKING')
                ->where('owners_id', $owners_id)
                ->where('bill_status', 0)
                ->get();
        return $query->getResult();
    }

    public function check_status($id){
        $query = $this->db->table('inbound_detail')
        ->select('status')
        ->where('inbound_detail.inbound_id', $id)
        ->get();
        return $query->getResult();
    }

    public function get_currrent_stock($mat_detail_id) {
        $query = $this->db->table('warehouse_soh')
                ->select('warehouse_soh.stock_ok, warehouse_soh.stock_ok')
                ->where('warehouse_soh.mat_detail_id', $mat_detail_id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_location_byid($id){
        $query = $this->db->table('material_location')
                ->where('location_id', $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function check_material_detail_on_shelfv2($location_id){
        $query = $this->db->table('material_location')
                ->selectCount('location_id', 'total')
                ->select('`location_id`
                    , `material_detail_id`
                    , material_location.`shelf_id`
                    , material_location.status
                    , shelf.shelf_availability
                    , qty')
                ->join('shelf', 'material_location.shelf_id = shelf.shelf_id')
                ->where('location_id', $location_id)
                ->get();
        return $query->getRow();
    }

    public function generate_va_number() {
        $query = $this->db->query("SELECT concat('69',LPAD(FLOOR(RAND() * 1000000000), 6, '0')) As VA_NUMBER");
        return $query->getRow();
    }

    public function generate_location_id(){
        $lastId = $this->db->table('material_location')
                ->select('MAX(RIGHT(location_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table('material_location')
                ->select('MAX(MID(location_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "LOC".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    public function generate_outbound_id(){
        $lastId = $this->db->table('outbound')
                ->select('MAX(RIGHT(outbound_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table('outbound')
                ->select('MAX(MID(outbound_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "OTB".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    public function generate_det_outbound_id() {
        $lastId = $this->db->table('outbound_detail')
                ->select('MAX(RIGHT(det_outbound_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table('outbound_detail')
                ->select('MAX(MID(det_outbound_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "OBD".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    public function generate_purchase_order_id(){
        $lastId = $this->db->table('purchase_order')
                ->select('MAX(RIGHT(po_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table('purchase_order')
                ->select('MAX(MID(po_id, 3, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "PO".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    public function generate_po_detail_id(){
        $lastId = $this->db->table('po_detail')
                ->select('MAX(RIGHT(po_detail_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table('po_detail')
                ->select('MAX(MID(po_detail_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "POD".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    public function generate_po_outbound_id(){
        $lastId = $this->db->table('po_outbound')
                ->select('MAX(RIGHT(po_outbound_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table('po_outbound')
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

    public function generate_po_out_detail_id(){
        $lastId = $this->db->table('po_out_detail')
                ->select('MAX(RIGHT(po_det_outbound_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table('po_out_detail')
                ->select('MAX(MID(po_det_outbound_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "PTD".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    public function generate_owners_bill_id(){
        $lastId = $this->db->table('owners_bill')
                ->select('MAX(RIGHT(bill_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table('owners_bill')
                ->select('MAX(MID(bill_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "OWB".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    public function generate_owners_topup_id(){
        $lastId = $this->db->table('owners_topup')
                ->select('MAX(RIGHT(topup_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table('owners_topup')
                ->select('MAX(MID(topup_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "OWT".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    public function generate_pm_detil_id(){
        $lastId = $this->db->table('outbound_package')
                ->select('MAX(RIGHT(pm_detil_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table('outbound_package')
                ->select('MAX(MID(pm_detil_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "PMD".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    public function insert_data_material_location($data) {
        return $this->db->table('material_location')->insert($data);
    }

    public function insert_data_outbound($data) {
        return $this->db->table('outbound')->insert($data);
    }

    public function insert_data_outbound_detail($data) {
        return $this->db->table('outbound_detail')->insert($data);
    }

    public function insert_data_purchase_order($data) {
        return $this->db->table('purchase_order')->insert($data);
    }

    public function insert_data_po_detail($data) {
        return $this->db->table('po_detail')->insert($data);
    }

    public function insert_data_po_outbound($data) {
        return $this->db->table('po_outbound')->insert($data);
    }

    public function insert_data_owners_bill($data) {
        return $this->db->table('owners_bill')->insert($data);
    }

    public function insert_data_po_out_detail($data) {
        return $this->db->table('po_out_detail')->insert($data);
    }

    public function insert_data_owners_topup($data) {
        return $this->db->table('owners_topup')->insert($data);
    }

    public function insert_data_outbound_package($data) {
        return $this->db->table('outbound_package')->insert($data);
    }

    public function update_data_po_outbound($id, $data) {
        return $this->db->table('po_outbound')
                ->where('po_outbound_id', $id)
                ->update($data);
    }

    public function update_data_shelf($id, $data) {
        return $this->db->table('shelf')
                ->where('shelf_id', $id)
                ->update($data);
    }

    public function update_data_inbound_detail($id, $data) {
        return $this->db->table('inbound_detail')
                ->where('det_inbound_id', $id)
                ->update($data);
    }
    public function update_data_inbound($id, $data) {
        $this->db->table('inbound')
                ->where('inbound_id', $id)
                ->update($data);
    }

    public function update_data_owners_bill($id, $data) {
        return $this->db->table('owners_bill')
                ->where('po_id', $id)
                ->update($data);
    }

    public function update_data_owners($id, $data) {
		$this->db->table('owners')
                ->where('owners_id', $id)
                ->update($data);
	}

    public function update_data_warehouse_soh($id, $data) {
		$this->db->table('warehouse_soh')
                ->where('mat_detail_id', $id)
                ->update($data);
	}

    public function update_data_material_location($id, $data) {
		$this->db->table('material_location')
                ->where('location_id', $id)
                ->update($data);
	}
}