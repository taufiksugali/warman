<?php namespace App\Models;

use CodeIgniter\Model;

class WarehouseModel extends Model
{
    protected $table = "warehouse";
    protected $primaryKey = 'warehouse_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(warehouse_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(warehouse_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "WHS".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    // Serverside
    public function all_warehouse($limit, $start, $col, $dir)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->join('state', 'warehouse.state_id=state.state_id', 'left')
                    ->join('city', 'warehouse.city_id=city.city_id', 'left')
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        } else {
            $query = $this->db->table($this->table)
                    ->join('state', 'warehouse.state_id=state.state_id', 'left')
                    ->join('city', 'warehouse.city_id=city.city_id', 'left')
                    ->where('warehouse.warehouse_id', @session()->get('warehouse_id'))
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        }
    }

    public function all_warehouse_count()
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table);
            return $query->countAll();
        } else {
            $query = $this->db->table($this->table)
                    ->where('warehouse.warehouse_id', @session()->get('warehouse_id'));
            return $query->countAllResults();
        }
    }

    public function search_warehouse($limit, $start, $search, $col, $dir)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->join('state', 'warehouse.state_id=state.state_id', 'left')
                    ->join('city', 'warehouse.city_id=city.city_id', 'left')
                    ->like('wh_name', $search)
                    ->orLike('wh_code', $search)
                    ->orLike('wh_address', $search)
                    ->orLike('wh_pic', $search)
                    ->orLike('wh_pic_phone', $search)
                    ->orLike('wh_pic_email', $search)
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        } else {
            $query = $this->db->table($this->table)
                    ->join('state', 'warehouse.state_id=state.state_id', 'left')
                    ->join('city', 'warehouse.city_id=city.city_id', 'left')
                    ->where('warehouse.warehouse_id', @session()->get('warehouse_id'))
                    ->groupStart()
                        ->like('wh_name', $search)
                        ->orLike('wh_code', $search)
                        ->orLike('wh_address', $search)
                        ->orLike('wh_pic', $search)
                        ->orLike('wh_pic_phone', $search)
                        ->orLike('wh_pic_email', $search)
                    ->groupEnd()
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();    
        }
    }

    public function search_warehouse_count($search)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->selectCount($this->primaryKey, 'total')
                    ->join('state', 'warehouse.state_id=state.state_id', 'left')
                    ->join('city', 'warehouse.city_id=city.city_id', 'left')
                    ->like('wh_name', $search)
                    ->orLike('wh_code', $search)
                    ->orLike('wh_address', $search)
                    ->orLike('wh_pic', $search)
                    ->orLike('wh_pic_phone', $search)
                    ->orLike('wh_pic_email', $search)
                    ->get();
            return $query->getRow()->total;
        } else {
            $query = $this->db->table($this->table)
                    ->selectCount($this->primaryKey, 'total')
                    ->join('state', 'warehouse.state_id=state.state_id', 'left')
                    ->join('city', 'warehouse.city_id=city.city_id', 'left')
                    ->where('warehouse.warehouse_id', @session()->get('warehouse_id'))
                    ->groupStart()
                        ->like('wh_name', $search)
                        ->orLike('wh_code', $search)
                        ->orLike('wh_address', $search)
                        ->orLike('wh_pic', $search)
                        ->orLike('wh_pic_phone', $search)
                        ->orLike('wh_pic_email', $search)
                    ->groupEnd()
                    ->get();
            return $query->getRow()->total;
        }
    }
    // End Serverside

    public function get_all_warehouse(){
        if(session()->get('warehouse_id') == 'POSLOG' || session()->get('user_type') == 1){
            $query = $this->db->table($this->table)
                    ->where('status', 1)
                    ->get();
            return $query->getResult();
        } else {
            $query = $this->db->table($this->table)
                    ->where('warehouse_id', @session()->get('warehouse_id'))
                    ->where('status', 1)
                    ->get();
            return $query->getResult();
        }
    }

    public function get_warehouse_view_loc($wh_id){
        $query = $this->db->table($this->table)
                ->where('warehouse_id', $wh_id)
                ->where('status', 1)
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
                ->where($this->primaryKey, $id)
                ->delete();
    }

    public function get_warehouse_byid($id)
    {
        $query = $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_warehouse_bycode($id)
    {
        $query = $this->db->table($this->table)
                ->where('wh_code', $id)
                ->limit(1)
                ->get();
        return $query->getRow();
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