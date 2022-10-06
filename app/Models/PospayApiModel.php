<?php namespace App\Models;

use CodeIgniter\Model;

class PospayApiModel extends Model
{
    protected $inquiry = "vasbupos_inquiry";
    protected $payment = "vasbupos_payment";

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_inquiry_id(){
        $lastId = $this->db->table($this->inquiry)
                ->select('MAX(RIGHT(inquiry_id, 7)) AS last_id')
                ->get();
        $lastMidId = $this->db->table($this->inquiry)
                ->select('MAX(MID(inquiry_id, 4, 6)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
        $midId = date('ymd');
        $char = "INQ".$midId;
        if($lastMidId == $midId){
                $tmp = ($lastId->getRow()->last_id)+1;
                $id = substr($tmp, -5);
        }else{
                $id = "00001";
        }
        return $char.$id;
    }

    public function generate_payment_id(){
        $lastId = $this->db->table($this->payment)
                ->select('MAX(RIGHT(payment_id, 7)) AS last_id')
                ->get();
        $lastMidId = $this->db->table($this->payment)
                ->select('MAX(MID(payment_id, 4, 6)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
        $midId = date('ymd');
        $char = "PMT".$midId;
        if($lastMidId == $midId){
                $tmp = ($lastId->getRow()->last_id)+1;
                $id = substr($tmp, -5);
        }else{
                $id = "00001";
        }
        return $char.$id;
    }

    public function generate_topup_id() {
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

    public function get_vasbupos_inquiry($id){
        $query = $this->db->table($this->inquiry)
                ->where('inquiry_id', $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_vasbupos_payment($nomor_va, $channel_id, $kode_inst){
        $query = $this->db->table($this->payment)
                // ->select('*')
                ->where('va_number', $nomor_va)
                ->where('channel_id', $channel_id)
                ->where('institution_code', $kode_inst)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_topup_byid($id) {
        $query = $this->db->table('owners_topup')
                ->select('owners_topup.*, owners.owners_balance, owners.owners_id, owners.owners_name, owners.owners_address, bank.bank_name, bank.bank_channel, bank.bank_admin')
                ->join('owners', 'owners_topup.owners_id=owners.owners_id')
                ->join('bank', 'owners_topup.bank_id=bank.bank_id')
                ->where('topup_va', $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_owner_byid($id) {
        $query = $this->db->table('owners')
                ->where('owners_id', $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_owner_byva($owners_va_number) {
        $query = $this->db->table('owners')
                ->where('owners_va_number', $owners_va_number)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_setting_pospay() {
        $query = $this->db->table('setting_pospay')
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_bank_bychannel($bank_channel){
        $query = $this->db->table('bank')
                ->select('*')
                ->where('bank_status', '1')
                ->where('bank_channel', $bank_channel)
                ->get();
        return $query->getRow();
    }

    public function insert_inquiry($data) {
        return $this->db->table($this->inquiry)
                ->insert($data);
    }

    public function insert_payment($data) {
        return $this->db->table($this->payment)
                ->insert($data);
    }

    public function insert_owners_topup($data) {
        return $this->db->table('owners_topup')
                ->insert($data);
    }

    public function update_data_owners_topup($id, $data) {
        return $this->db->table('owners_topup')
                ->where('topup_va', $id)
                ->update($data);
    }

    public function update_data_owners($id, $data) {
        return $this->db->table('owners')
                ->where('owners_id', $id)
                ->update($data);
    }
}
?>