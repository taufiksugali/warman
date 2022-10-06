<?php namespace App\Models;

use CodeIgniter\Model;

class BlokModel extends Model
{
    protected $table = "area_blok";
    protected $primaryKey = 'blok_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(blok_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(blok_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "WHB".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    // Serverside
    public function all_blok($limit, $start, $col, $dir)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->select('area_blok.*, wh_area.wh_area_name, warehouse.wh_name')
                    ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        } else {
            $query = $this->db->table($this->table)
                    ->select('area_blok.*, wh_area.wh_area_name, warehouse.wh_name')
                    ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->where('warehouse.warehouse_id', @session()->get('warehouse_id'))
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        }
    }

    public function all_blok_count()
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->select('area_blok.*, wh_area.wh_area_name, warehouse.wh_name')
                    ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id');
            return $query->countAllResults();
        } else {
            $query = $this->db->table($this->table)
                    ->select('area_blok.*, wh_area.wh_area_name, warehouse.wh_name')
                    ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->where('warehouse.warehouse_id', @session()->get('warehouse_id'));
            return $query->countAllResults();
        }
    }

    public function search_blok($limit, $start, $search, $col, $dir)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->select('area_blok.*, wh_area.wh_area_name, warehouse.wh_name')
                    ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->like('warehouse.wh_name', $search)
                    ->orLike('wh_area.wh_area_name', $search)
                    ->orLike('area_blok.blok_code', $search)
                    ->orLike('area_blok.blok_name', $search)
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        } else {
            $query = $this->db->table($this->table)
                    ->select('area_blok.*, wh_area.wh_area_name, warehouse.wh_name')
                    ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->where('warehouse.warehouse_id', @session()->get('warehouse_id'))
                    ->groupStart()
                        ->like('warehouse.wh_name', $search)
                        ->orLike('wh_area.wh_area_name', $search)
                        ->orLike('area_blok.blok_code', $search)
                        ->orLike('area_blok.blok_name', $search)
                    ->groupEnd()
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        }
    }

    public function search_blok_count($search)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->select('area_blok.*, wh_area.wh_area_name, warehouse.wh_name')
                    ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->selectCount($this->primaryKey, 'total')
                    ->like('warehouse.wh_name', $search)
                    ->orLike('wh_area.wh_area_name', $search)
                    ->orLike('area_blok.blok_code', $search)
                    ->orLike('area_blok.blok_name', $search)
                    ->get();
            return $query->getRow()->total;
        } else {
            $query = $this->db->table($this->table)
                    ->select('area_blok.*, wh_area.wh_area_name, warehouse.wh_name')
                    ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->selectCount($this->primaryKey, 'total')
                    ->where('warehouse.warehouse_id', @session()->get('warehouse_id'))
                    ->groupStart()
                        ->like('warehouse.wh_name', $search)
                        ->orLike('wh_area.wh_area_name', $search)
                        ->orLike('area_blok.blok_code', $search)
                        ->orLike('area_blok.blok_name', $search)
                    ->groupEnd()
                    ->get();
            return $query->getRow()->total;
        }
    }
    // End Serverside

    public function get_all_blok(){
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->where('status', 1)
                    ->get();
            return $query->getResult();
        } else {
            $query = $this->db->table($this->table)
                    ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->where('warehouse.warehouse_id', @session()->get('warehouse_id'))
                    ->where('area_blok.status', 1)
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
        return $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->update($data);
    }

    public function delete_data($id)
    {
        $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->delete();
    }

    public function get_blok_byid($id)
    {
        $query = $this->db->table($this->table)
                ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_blok_byarea($area_id){
        $query = $this->db->table($this->table)
                ->where("wh_area_id", $area_id)
                ->get();
        return $query->getResult();
    }
}
?>