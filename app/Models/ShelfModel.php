<?php namespace App\Models;

use CodeIgniter\Model;

class ShelfModel extends Model
{
    protected $table = "shelf";
    protected $primaryKey = 'shelf_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(shelf_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(shelf_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "SLF".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    // Serverside
    public function all_shelf($limit, $start, $col, $dir)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->select('shelf.*, rak.rak_name, area_blok.blok_name, wh_area.wh_area_name, warehouse.wh_name')
                    ->join('rak', 'shelf.rak_id=rak.rak_id')
                    ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                    ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        } else {
            $query = $this->db->table($this->table)
                    ->select('shelf.*, rak.rak_name, area_blok.blok_name, wh_area.wh_area_name, warehouse.wh_name')
                    ->join('rak', 'shelf.rak_id=rak.rak_id')
                    ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                    ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->where('warehouse.warehouse_id', @session()->get('warehouse_id'))
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        }
    }

    public function all_shelf_count()
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->select('shelf.*, rak.rak_name, area_blok.blok_name, wh_area.wh_area_name, warehouse.wh_name')
                    ->join('rak', 'shelf.rak_id=rak.rak_id')
                    ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                    ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id');
            return $query->countAllResults();
        } else {
            $query = $this->db->table($this->table)
                    ->select('shelf.*, rak.rak_name, area_blok.blok_name, wh_area.wh_area_name, warehouse.wh_name')
                    ->join('rak', 'shelf.rak_id=rak.rak_id')
                    ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                    ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->where('warehouse.warehouse_id', @session()->get('warehouse_id'));
            return $query->countAllResults();
        }
    }

    public function search_shelf($limit, $start, $search, $col, $dir)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->select('shelf.*, rak.rak_name, area_blok.blok_name, wh_area.wh_area_name, warehouse.wh_name')
                    ->join('rak', 'shelf.rak_id=rak.rak_id')
                    ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                    ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->like('warehouse.wh_name', $search)
                    ->orLike('wh_area.wh_area_name', $search)
                    ->orLike('area_blok.blok_name', $search)
                    ->orLike('rak.rak_code', $search)
                    ->orLike('rak.rak_name', $search)
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        } else {
            $query = $this->db->table($this->table)
                    ->select('shelf.*, rak.rak_name, area_blok.blok_name, wh_area.wh_area_name, warehouse.wh_name')
                    ->join('rak', 'shelf.rak_id=rak.rak_id')
                    ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                    ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->where('warehouse.warehouse_id', session()->get('warehouse_id'))
                    ->groupStart()
                        ->like('warehouse.wh_name', $search)
                        ->orLike('wh_area.wh_area_name', $search)
                        ->orLike('area_blok.blok_name', $search)
                        ->orLike('rak.rak_code', $search)
                        ->orLike('rak.rak_name', $search)
                    ->groupEnd()
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        }
    }

    public function search_shelf_count($search)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->select('shelf.*, rak.rak_name, area_blok.blok_name, wh_area.wh_area_name, warehouse.wh_name')
                    ->join('rak', 'shelf.rak_id=rak.rak_id')
                    ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                    ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->selectCount($this->primaryKey, 'total')
                    ->like('warehouse.wh_name', $search)
                    ->orLike('wh_area.wh_area_name', $search)
                    ->orLike('area_blok.blok_code', $search)
                    ->orLike('area_blok.blok_name', $search)
                    ->orLike('rak.rak_code', $search)
                    ->orLike('rak.rak_name', $search)
                    ->get();
            return $query->getRow()->total;
        } else {
            $query = $this->db->table($this->table)
                    ->select('shelf.*, rak.rak_name, area_blok.blok_name, wh_area.wh_area_name, warehouse.wh_name')
                    ->join('rak', 'shelf.rak_id=rak.rak_id')
                    ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                    ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->selectCount($this->primaryKey, 'total')
                    ->where('warehouse.warehouse_id', session()->get('warehouse_id'))
                    ->groupStart()
                        ->like('warehouse.wh_name', $search)
                        ->orLike('wh_area.wh_area_name', $search)
                        ->orLike('area_blok.blok_code', $search)
                        ->orLike('area_blok.blok_name', $search)
                        ->orLike('rak.rak_code', $search)
                        ->orLike('rak.rak_name', $search)
                    ->groupEnd()
                    ->get();
            return $query->getRow()->total;
        }
    }
    // End Serverside

    public function get_all_shelf(){
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->where('status', 1)
                    ->get();
            return $query->getResult();
        } else {
            $query = $this->db->table($this->table)
                    ->join('rak', 'shelf.rak_id=rak.rak_id')
                    ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                    ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                    ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                    ->where('shelf.status', 1)
                    ->get();
            return $query->getResult();
        }
    }

    public function print_shelf(){
        $query = $this->db->table($this->table)
                ->select('shelf.*, rak.rak_name, area_blok.blok_name, wh_area.wh_area_name, warehouse.wh_name')
                ->join('rak', 'shelf.rak_id=rak.rak_id')
                ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                ->where('shelf.status', 1)
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

    public function get_shelf_byid($id)
    {
        $query = $this->db->table($this->table)
                ->join('rak', 'shelf.rak_id=rak.rak_id')
                ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_shelf_byrak($rak_id){
        $query = $this->db->table($this->table)
                ->where("rak_id", $rak_id)
                ->get();
        return $query->getResult();
    }
}
?>