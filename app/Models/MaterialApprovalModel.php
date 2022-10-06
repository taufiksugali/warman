<?php namespace App\Models;

use CodeIgniter\Model;

class MaterialApprovalModel extends Model
{
    protected $table = "material_approval";
    protected $primaryKey = 'approval_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(approval_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(approval_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "APV".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    public function get_approvalById($id){
        $query = $this->db->table($this->table)
                ->where('material_id', $id)   
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
                ->where('material_id', $id)
                ->update($data);
    } // method update kalo material id dah ada.
}
?>