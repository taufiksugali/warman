<?php namespace App\Models;

use CodeIgniter\Model;

class OutboundpoDetailModel extends Model
{
    protected $table = "po_out_detail";
    protected $primaryKey = 'po_det_outbound_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(po_det_outbound_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
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

    public function check_status($id){
        $query = $this->db->table($this->table)
        ->select('status')
        ->where('po_out_detail.po_outbound_id', $id)
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
        $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->update($data);
    }

    public function delete_data($id)
    {
        $this->db->table($this->table)
                ->where('po_outbound_id', $id)
                ->delete();
    }
}
?>