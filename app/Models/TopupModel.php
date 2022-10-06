<?php namespace App\Models;

use CodeIgniter\Model;

class TopupModel extends Model
{
    protected $table = "owners_topup";
    protected $primaryKey = 'topup_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(topup_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
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

    public function generate_va_number()
    {
        $query = $this->db->query("SELECT concat('69',LPAD(FLOOR(RAND() * 1000000000), 6, '0')) As VA_NUMBER");
        return $query->getRow();
    }

    // Serverside
    public function all_topup($limit, $start, $col, $dir) {
        $query = $this->db->table($this->table)
                ->select('owners_topup.*, owners.owners_balance, owners.owners_id, owners.owners_name, owners.owners_account, bank.bank_name, bank_dest.dest_name, bank_dest.dest_account')
                ->join('owners', 'owners_topup.owners_id=owners.owners_id', 'left')
                ->join('owners_bank', 'owners_topup.bank_id=owners_bank.owners_bank_id', 'left')
                ->join('bank', 'owners_bank.bank_id=bank.bank_id', 'left')
                ->join('bank_dest', 'owners_topup.dest_id=bank_dest.dest_id', 'left')
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function all_topup_count() {
        $query = $this->db->table($this->table)
                ->select('owners_topup.*, owners.owners_balance, owners.owners_id, owners.owners_name, owners.owners_account, bank.bank_name, bank_dest.dest_name, bank_dest.dest_account')
                ->join('owners', 'owners_topup.owners_id=owners.owners_id', 'left')
                ->join('owners_bank', 'owners_topup.bank_id=owners_bank.owners_bank_id', 'left')
                ->join('bank', 'owners_bank.bank_id=bank.bank_id', 'left')
                ->join('bank_dest', 'owners_topup.dest_id=bank_dest.dest_id', 'left');
        return $query->countAllResults();
    }

    public function search_topup($limit, $start, $search, $col, $dir) {
        $query = $this->db->table($this->table)
                ->select('owners_topup.*, owners.owners_balance, owners.owners_id, owners.owners_name, owners.owners_account, bank.bank_name, bank_dest.dest_name, bank_dest.dest_account')
                ->join('owners', 'owners_topup.owners_id=owners.owners_id', 'left')
                ->join('owners_bank', 'owners_topup.bank_id=owners_bank.owners_bank_id', 'left')
                ->join('bank', 'owners_bank.bank_id=bank.bank_id', 'left')
                ->join('bank_dest', 'owners_topup.dest_id=bank_dest.dest_id', 'left')
                ->like('owners.owners_name', $search)
                ->orLike('owners_topup.description', $search)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function search_topup_count($search) {
        $query = $this->db->table($this->table)
                ->select('owners_topup.*, owners.owners_balance, owners.owners_id, owners.owners_name, owners.owners_account, bank.bank_name, bank_dest.dest_name, bank_dest.dest_account')
                ->join('owners', 'owners_topup.owners_id=owners.owners_id', 'left')
                ->join('owners_bank', 'owners_topup.bank_id=owners_bank.owners_bank_id', 'left')
                ->join('bank', 'owners_bank.bank_id=bank.bank_id', 'left')
                ->join('bank_dest', 'owners_topup.dest_id=bank_dest.dest_id', 'left')
                ->selectCount($this->primaryKey, 'total')
                ->like('owners.owners_name', $search)
                ->orLike('owners_topup.description', $search)
                ->get();
        return $query->getRow()->total;
    }
    // End Serverside

    public function get_all_topup(){
        $query = $this->db->table($this->table)
                ->where('topup_status', 1)
                ->get();
        return $query->getResult();
    }

    public function get_all_bank(){
        $query = $this->db->table('bank')
                ->where('bank_status', 1)
                ->get();
        return $query->getResult();
    }

    public function get_bank_byOwner($id){
        $query = $this->db->table('owners_bank')
                ->select('owners_bank.*, bank.bank_name')
                ->join('bank', 'owners_bank.bank_id  = bank.bank_id')
                ->where('owners_id', $id)
                ->get();
        return $query->getResult();
    }

    public function get_account_byOwner($id){
        $query = $this->db->table('owners_bank')
                ->select('owners_bank.*, bank.bank_name')
                ->join('bank', 'owners_bank.bank_id  = bank.bank_id')
                ->where('owners_bank_id', $id)
                ->get();
        return $query->getRow();
    }
    
    public function get_byid_bank($id){
        $query = $this->db->table('bank')
                ->where('bank_id', $id)
                ->get();
        return $query->getRow();
    }

    public function get_byid_bank_dest($id){
        $query = $this->db->table('bank_dest')
                ->where('dest_status', 1)
                ->where('dest_id', $id)
                ->get();
        return $query->getRow();
    }

    public function get_bank_dest(){
        $query = $this->db->table('bank_dest')
                ->where('dest_status', 1)
                ->get();
        return $query->getResult();
    }

    public function get_owners_bank_byid($owners_id){
        $query = $this->db->table('owners_bank')
                ->where('status', 1)
                ->where('owners_id', $owners_id)
                ->get();
        return $query->getResult();
    }

    public function insert_data($data)
    {
        return $this->db->table($this->table)
                ->insert($data);
    }

    public function update_data($id, $data)
    {
        return $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->update($data);
    }

    public function delete_data($id)
    {
        $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->delete();
    }

    public function get_topup_byid($id)
    {
        $query = $this->db->table($this->table)
                ->select('owners_topup.*, owners.owners_balance, owners.owners_id')
                ->join('owners', 'owners_topup.owners_id=owners.owners_id')
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_topup_byid2($id)
    {
        $query = $this->db->table($this->table)
                ->select('owners_topup.*, owners.owners_balance, owners.owners_id, owners.owners_name, owners.owners_address, bank.bank_name, bank.bank_admin, bank.bank_prefix')
                ->join('owners', 'owners_topup.owners_id=owners.owners_id')
                ->join('bank', 'owners_topup.bank_id=bank.bank_id')
                ->where($this->primaryKey, $id)
                ->where('topup_status', '0')
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_topup_byownersid($id)
    {
        $query = $this->db->table($this->table)
                ->select('owners_topup.*, owners.owners_balance, owners.owners_id, owners.owners_name, owners.owners_account, bank.bank_name, bank_dest.dest_name, bank_dest.dest_account')
                ->join('owners', 'owners_topup.owners_id=owners.owners_id')
                ->join('bank', 'owners_topup.bank_id=bank.bank_id')
                ->join('bank_dest', 'owners_topup.dest_id=bank_dest.dest_id')
                ->where('owners_topup.owners_id', $id)
                ->where('owners_topup.topup_status < 4')
                ->get();
        return $query->getResult();
    }

    public function get_topup_byownersid_withdraw($id)
    {
        $query = $this->db->table($this->table)
                ->select('owners_topup.*, owners.owners_balance, owners.owners_id, owners.owners_name, bank.bank_name')
                ->join('owners', 'owners_topup.owners_id=owners.owners_id')
                ->join('bank', 'owners_topup.bank_id=bank.bank_id')
                ->where('owners_topup.owners_id', $id)
                ->where('owners_topup.topup_status > 3')
                ->get();
        return $query->getResult();
    }

    public function check_withdraw($id)
    {
        $query = $this->db->table($this->table)
                ->select('owners_topup.*, owners.owners_balance, owners.owners_id, owners.owners_name, bank.bank_name')
                ->join('owners', 'owners_topup.owners_id=owners.owners_id')
                ->join('bank', 'owners_topup.bank_id=bank.bank_id')
                ->where('owners_topup.topup_status = 4')
                ->where('owners_topup.owners_id', $id);
        return $query->countAllResults();
    }
}
?>