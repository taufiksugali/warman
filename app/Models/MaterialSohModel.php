<?php namespace App\Models;

use CodeIgniter\Model;

class MaterialSohModel extends Model
{
    protected $table = "warehouse_soh";
    protected $primaryKey = 'soh_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(soh_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(soh_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "SOH".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    public function get_currrent_stock($mat_detail_id){
        $query = $this->db->table($this->table)
                ->select('warehouse_soh.stock_ok, warehouse_soh.stock_ok')
                ->where('warehouse_soh.mat_detail_id', $mat_detail_id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

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

    public function update_byid($id, $data)
    {
        $this->db->table($this->table)
                ->where('mat_detail_id', $id)
                ->update($data);
    }

    public function delete_data($id)
    {
        $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->delete();
    }
}
?>