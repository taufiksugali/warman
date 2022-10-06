<?php namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table = "supplier";
    protected $primaryKey = 'supplier_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(supplier_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(supplier_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "SUP".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    // Serverside
    public function all_supplier($limit, $start, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function all_supplier_count()
    {
        $query = $this->db->table($this->table);
        return $query->countAll();
    }

    public function search_supplier($limit, $start, $search, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->like('supplier_name', $search)
                ->orLike('supplier_address', $search)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function search_supplier_count($search)
    {
        $query = $this->db->table($this->table)
                ->selectCount($this->primaryKey, 'total')
                ->like('supplier_name', $search)
                ->orLike('supplier_address', $search)
                ->get();
        return $query->getRow()->total;
    }
    // End Serverside

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
 
    public function get_supplier_byid($id)
    {
        $query = $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_all_supplier(){
        $query = $this->db->table($this->table)
                ->where('status', 1)
                ->get();
        return $query->getResult();
    }

    public function get_city_name($regency_id)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://hris.poslogistics.co.id/api/Hris_Api/getByidRegency?token=0a05252241f3bc45ffc4abaeca369963&id='.$regency_id.'&param=regency_id');
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result     = curl_exec ($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $dataObject = json_decode($result);
        
        return $dataObject->data[0]->regency_name .', '. $dataObject->data[0]->province_name;
    }
}
?>