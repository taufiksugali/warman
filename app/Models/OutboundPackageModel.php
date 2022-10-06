<?php namespace App\Models;

use CodeIgniter\Model;

class OutboundPackageModel extends Model
{
    protected $table = "outbound_package";
    protected $primaryKey = 'pm_detil_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(pm_detil_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
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

    public function check_status($id){
        $query = $this->db->table($this->table)
        ->select('status')
        ->where('outbound_package.pm_detil_id', $id)
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
                ->where('pm_detil_id', $id)
                ->delete();
    }
}
?>