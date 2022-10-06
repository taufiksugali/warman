<?php namespace App\Models;

use CodeIgniter\Model;

class WhAreaModel extends Model
{
    protected $table = "wh_area";
    protected $primaryKey = 'area_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(area_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(area_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "WHA".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    // Serverside
    public function all_wh_area($limit, $start, $col, $dir)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        } else {
            $query = $this->db->table($this->table)
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->where('warehouse.warehouse_id', @session()->get('warehouse_id'))
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        }
    }

    public function all_wh_area_count()
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id');
            return $query->countAllResults();
        } else {
            $query = $this->db->table($this->table)
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->where('warehouse.warehouse_id', @session()->get('warehouse_id'));
            return $query->countAllResults();
        }
    }

    public function search_wh_area($limit, $start, $search, $col, $dir)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->like('warehouse.wh_name', $search)
                    ->orLike('wh_area.wh_area_name', $search)
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        } else {
            $query = $this->db->table($this->table)
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->where('warehouse.warehouse_id', @session()->get('warehouse_id'))
                    ->groupStart()
                        ->like('warehouse.wh_name', $search)
                        ->orLike('wh_area.wh_area_name', $search)
                    ->groupEnd()
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        }
    }

    public function search_wh_area_count($search)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->selectCount($this->primaryKey, 'total')
                    ->like('warehouse.wh_name', $search)
                    ->orLike('wh_area.wh_area_name', $search)
                    ->get();
            return $query->getRow()->total;
        } else {
            $query = $this->db->table($this->table)
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->selectCount($this->primaryKey, 'total')
                    ->where('warehouse.warehouse_id', @session()->get('warehouse_id'))
                    ->groupStart()
                        ->like('warehouse.wh_name', $search)
                        ->orLike('wh_area.wh_area_name', $search)
                    ->groupEnd()
                    ->get();
            return $query->getRow()->total;
        }
    }
    // End Serverside

    public function get_all_wh_area(){
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->where('status', 1)
                    ->get();
            return $query->getResult();
        } else {
            $query = $this->db->table($this->table)
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->where('warehouse.warehouse_id', @session()->get('warehouse_id'))
                    ->where('wh_area.status', 1)
                    ->get();
            return $query->getResult();
        }
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

    public function get_wh_area_byid($id)
    {
        $query = $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_wharea_bywhid($wh_id){
        $query = $this->db->table($this->table)
                ->where("wh_id", $wh_id)
                ->get();
        return $query->getResult();
    }

    public function get_good_wharea_bywhid($wh_id){
        $query = $this->db->table($this->table)
                ->where("wh_id", $wh_id)
                ->where("area_mat_st", '1')
                ->get();
        return $query->getResult();
    }

    public function get_ng_wharea_bywhid($wh_id){
        $query = $this->db->table($this->table)
                ->where("wh_id", $wh_id)
                ->where("area_mat_st", '0')
                ->get();
        return $query->getResult();
    }
}
?>