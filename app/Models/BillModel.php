<?php namespace App\Models;

use CodeIgniter\Model;

class BillModel extends Model
{
    protected $table = "owners_bill";
    protected $primaryKey = 'bill_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(bill_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
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

    // Serverside
    public function all_bill($limit, $start, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->select('owners_bill.*, owners.owners_balance, owners.owners_name')
                ->join('owners', 'owners_bill.owners_id=owners.owners_id')
                ->limit($limit, $start)
                ->orderBy('created_date', 'DESC')
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function all_bill_count()
    {
        $query = $this->db->table($this->table)
                ->select('owners_bill.*, owners.owners_balance, owners.owners_name')
                ->join('owners', 'owners_bill.owners_id=owners.owners_id');
        return $query->countAllResults();
    }

    public function search_bill($limit, $start, $search, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->select('owners_bill.*, owners.owners_balance, owners.owners_name')
                ->join('owners', 'owners_bill.owners_id=owners.owners_id')
                ->like('owners.owners_name', $search)
                ->orLike('owners_bill.description', $search)
                ->orLike('owners_bill.ref_id', $search)
                ->orLike('owners_bill.po_id', $search)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function search_bill_count($search)
    {
        $query = $this->db->table($this->table)
                ->select('owners_bill.*, owners.owners_balance, owners.owners_name')
                ->join('owners', 'owners_bill.owners_id=owners.owners_id')
                ->selectCount($this->primaryKey, 'total')
                ->like('owners.owners_name', $search)
                ->orLike('owners_bill.description', $search)
                ->orLike('owners_bill.ref_id', $search)
                ->orLike('owners_bill.po_id', $search)
                ->get();
        return $query->getRow()->total;
    }
    // End Serverside

    public function get_all_bill(){
        $query = $this->db->table($this->table)
                ->where('bill_status', 1)
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

    public function update_data_byPO($id, $data)
    {
        return $this->db->table($this->table)
                ->where('po_id', $id)
                ->update($data);
    }

    public function update_admin_fee_byPO($id, $data)
    {
        return $this->db->table($this->table)
                ->where('po_id', $id)
                ->where('description', 'ADMIN FEE')
                ->update($data);
    }

    public function delete_data($id)
    {
        $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->delete();
    }

    public function delete_by_ref_id($id)
    {
        $this->db->table($this->table)
                ->where('ref_id', $id)
                ->delete();
    }

    public function get_bill_byid($id)
    {
        $query = $this->db->table($this->table)
                ->select('owners_bill.*, owners.owners_balance, owners.owners_name')
                ->join('owners', 'owners_bill.owners_id=owners.owners_id')
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_bill_byRefid($id)
    {
        $query = $this->db->table($this->table)
                ->select('owners_bill.*, owners.owners_balance, owners.owners_name')
                ->join('owners', 'owners_bill.owners_id=owners.owners_id')
                ->where('ref_id', $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function bill_count_bystatus($search)
    {
        $query = $this->db->table($this->table)
                ->select('owners_bill.*, owners.owners_balance, owners.owners_name')
                ->join('owners', 'owners_bill.owners_id=owners.owners_id')
                ->selectCount($this->primaryKey, 'total')
                ->where('owners_bill.po_id', $search)
                ->where('owners_bill.bill_status', 2)
                ->get();
        return $query->getRow()->total;
    }

    public function get_bill_bypo_id($id)
    {
        $query = $this->db->table($this->table)
                ->select('owners_bill.*, owners.owners_balance')
                ->join('owners', 'owners_bill.owners_id=owners.owners_id')
                ->where('po_id', $id)
                ->where('bill_status', 0)
                ->get();
        return $query->getResult();
    }

    public function get_bill_bypo_id_report($id)
    {
        $query = $this->db->table($this->table)
                ->select('owners_bill.*, owners.owners_balance')
                ->join('owners', 'owners_bill.owners_id=owners.owners_id')
                ->where('po_id', $id)
                ->get();
        return $query->getResult();
    }

    public function get_bill_by_desc($id, $desc)
    {
        $query = $this->db->table($this->table)
                ->select('owners_bill.*, owners.owners_balance')
                ->join('owners', 'owners_bill.owners_id=owners.owners_id')
                ->where('po_id', $id)
                ->where('description', $desc)
                ->get();
        return $query->getResult();
    }

    public function total_hutang(){
        $query = $this->db->table('owners_bill')
                        ->select('SUM(`amount`) AS payable')
                        ->where('owners_id', session()->get('owners_id'))
                        ->where('bill_status', 0)
                        ->get();
        return $query->getResult();
    }
}
?>