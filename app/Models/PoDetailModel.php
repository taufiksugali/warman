<?php namespace App\Models;

use CodeIgniter\Model;

class PoDetailModel extends Model
{
    protected $table = "po_detail";
    protected $primaryKey = 'po_detail_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(po_detail_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
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
                ->where('po_id', $id)
                ->delete();
    }

    public function get_po_byid($id)
    {
        $query = $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_po_detail($id){
        $query = $this->db->table($this->table)
                ->join('material', 'po_detail.material_id=material.material_id')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->where('po_detail.po_id', $id)
                ->get();
        return $query->getResult();
    }

    public function check_status($id){
        $query = $this->db->table($this->table)
        ->select('status')
        ->where('po_detail.po_id', $id)
        ->get();
        return $query->getResult();
    }
}
?>