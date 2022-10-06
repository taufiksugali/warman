<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class OwnersModel extends Model
{
    protected $table = "owners";
    protected $primaryKey = 'owners_id';
 
    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(owners_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(owners_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "OWN".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    // Serverside
    public function all_owner($limit, $start, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->join('state', 'owners.state_id=state.state_id', 'left')
                ->join('city', 'owners.city_id=city.city_id', 'left')
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function all_owner_count()
    {
        $query = $this->db->table($this->table);
        return $query->countAll();
    }

    public function search_owner($limit, $start, $search, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->join('state', 'owners.state_id=state.state_id', 'left')
                ->join('city', 'owners.city_id=city.city_id', 'left')
                ->like('owners_name', $search)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function search_owner_count($search)
    {
        $query = $this->db->table($this->table)
                ->join('state', 'owners.state_id=state.state_id', 'left')
                ->join('city', 'owners.city_id=city.city_id', 'left')
                ->selectCount($this->primaryKey, 'total')
                ->like('owners_name', $search)
                ->get();
        return $query->getRow()->total;
    }
    // End Serverside

    public function get_all_owner(){
        $query = $this->db->table($this->table)
                ->where('owners_status', 1)
                ->get();
        return $query->getResult();
    }

    public function get_owner_byid($id)
    {
        $query = $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function generate_va_number() {
        $query = $this->db->query("SELECT concat('69',LPAD(FLOOR(RAND() * 1000000000), 6, '0')) As VA_NUMBER");
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

    public function delete_data($id)
	{
		$this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->delete();
	}
    
    public function get_all_bank(){
        $query = $this->db->table('bank')
                ->where('bank_status', 1)
                ->get();
        return $query->getResult();
    }

    
    public function total_seller(){
        $query = $this->db->table($this->table)
                        ->select('count(`owners_id`) AS total_seller')
                        ->get();
        return $query->getResult();
    }
}
?>