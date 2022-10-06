<?php namespace App\Models;

use CodeIgniter\Model;

class LocationModel extends Model
{
    protected $table = "material_location";
    protected $primaryKey = 'location_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(location_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(location_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "LOC".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    // Serverside
    public function all_material($limit, $start, $col, $dir)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table('inbound_detail')
                ->select('`material`.`material_name`
                , `po_detail`.`material_id`
                , `inbound`.`inbound_id`
                , `inbound_detail`.`material_detail_id`
                , `inbound_detail`.`qty_good_in`
                , `inbound_detail`.`qty_notgood_in`
                , `inbound_detail`.`qty_realization`
                , `inbound`.`inbound_rcv_date`
                , `warehouse`.`wh_name`
                , `inbound`.`inbound_location`
                , `inbound_detail`.`det_inbound_id`')
                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                ->join('po_detail', 'inbound_detail.po_detail_id=po_detail.po_detail_id')
                ->join('material', 'po_detail.material_id=material.material_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->where('inbound_detail.status', 2)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
            return $query->getResult();
        } else {
            $query = $this->db->table('inbound_detail')
                ->select('`material`.`material_name`
                , `po_detail`.`material_id`
                , `inbound`.`inbound_id`
                , `inbound_detail`.`material_detail_id`
                , `inbound_detail`.`qty_good_in`
                , `inbound_detail`.`qty_notgood_in`
                , `inbound_detail`.`qty_realization`
                , `inbound`.`inbound_rcv_date`
                , `warehouse`.`wh_name`
                , `inbound`.`inbound_location`
                , `inbound_detail`.`det_inbound_id`')
                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                ->join('po_detail', 'inbound_detail.po_detail_id=po_detail.po_detail_id')
                ->join('material', 'po_detail.material_id=material.material_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->where('inbound_detail.status', 2)
                ->where('inbound.inbound_location', session()->get('warehouse_id'))
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
            return $query->getResult();
        }
        
    }

    public function all_material_count()
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table('inbound_detail')
                ->select('`material`.`material_name`
                , `po_detail`.`material_id`
                , `inbound`.`inbound_id`
                , `inbound_detail`.`material_detail_id`
                , `inbound_detail`.`qty_good_in`
                , `inbound_detail`.`qty_notgood_in`
                , `inbound_detail`.`qty_realization`
                , `inbound`.`inbound_rcv_date`
                , `warehouse`.`wh_name`
                , `inbound`.`inbound_location`
                , `inbound_detail`.`det_inbound_id`')
                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                ->join('po_detail', 'inbound_detail.po_detail_id=po_detail.po_detail_id')
                ->join('material', 'po_detail.material_id=material.material_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->where('inbound_detail.status', 2);
            return $query->countAllResults();
        } else {
            $query = $this->db->table('inbound_detail')
                ->select('`material`.`material_name`
                , `po_detail`.`material_id`
                , `inbound`.`inbound_id`
                , `inbound_detail`.`material_detail_id`
                , `inbound_detail`.`qty_good_in`
                , `inbound_detail`.`qty_notgood_in`
                , `inbound_detail`.`qty_realization`
                , `inbound`.`inbound_rcv_date`
                , `warehouse`.`wh_name`
                , `inbound`.`inbound_location`
                , `inbound_detail`.`det_inbound_id`')
                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                ->join('po_detail', 'inbound_detail.po_detail_id=po_detail.po_detail_id')
                ->join('material', 'po_detail.material_id=material.material_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->where('inbound_detail.status', 2)
                ->where('inbound.inbound_location', session()->get('warehouse_id'));
            return $query->countAllResults();
        }
    }

    public function search_material($limit, $start, $search, $col, $dir)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table('inbound_detail')
                    ->select('`material`.`material_name`
                    , `po_detail`.`material_id`
                    , `inbound`.`inbound_id`
                    , `inbound_detail`.`material_detail_id`
                    , `inbound_detail`.`qty_good_in`
                    , `inbound_detail`.`qty_notgood_in`
                    , `inbound_detail`.`qty_realization`
                    , `inbound`.`inbound_rcv_date`
                    , `warehouse`.`wh_name`
                    , `inbound`.`inbound_location`
                    , `inbound_detail`.`det_inbound_id`')
                    ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                    ->join('po_detail', 'inbound_detail.po_detail_id=po_detail.po_detail_id')
                    ->join('material', 'po_detail.material_id=material.material_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->where('inbound_detail.status', 2)
                    ->groupStart()
                        ->like('material.material_id', $search)
                        ->orLike('material.material_name', $search)
                        ->orLike('inbound_detail.qty_good_in', $search)
                        ->orLike('inbound_detail.qty_notgood_in', $search)
                        ->orLike('inbound.inbound_rcv_date', $search)
                        ->orLike('warehouse.wh_name', $search)
                    ->groupEnd()
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        } else {
            $query = $this->db->table('inbound_detail')
                    ->select('`material`.`material_name`
                    , `po_detail`.`material_id`
                    , `inbound`.`inbound_id`
                    , `inbound_detail`.`material_detail_id`
                    , `inbound_detail`.`qty_good_in`
                    , `inbound_detail`.`qty_notgood_in`
                    , `inbound_detail`.`qty_realization`
                    , `inbound`.`inbound_rcv_date`
                    , `warehouse`.`wh_name`
                    , `inbound`.`inbound_location`
                    , `inbound_detail`.`det_inbound_id`')
                    ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                    ->join('po_detail', 'inbound_detail.po_detail_id=po_detail.po_detail_id')
                    ->join('material', 'po_detail.material_id=material.material_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->where('inbound_detail.status', 2)
                    ->where('inbound.inbound_location', session()->get('warehouse_id'))
                    ->groupStart()
                        ->like('material.material_id', $search)
                        ->orLike('material.material_name', $search)
                        ->orLike('inbound_detail.qty_good_in', $search)
                        ->orLike('inbound_detail.qty_notgood_in', $search)
                        ->orLike('inbound.inbound_rcv_date', $search)
                        ->orLike('warehouse.wh_name', $search)
                    ->groupEnd()
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();

        }
    }

    public function search_material_count($search)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table('inbound_detail')
                    ->selectCount('inbound_detail.det_inbound_id', 'total')
                    ->select('`material`.`material_name`
                    , `po_detail`.`material_id`
                    , `inbound_detail`.`material_detail_id`
                    , `inbound_detail`.`qty_good_in`
                    , `inbound_detail`.`qty_notgood_in`
                    , `inbound_detail`.`qty_realization`
                    , `inbound`.`inbound_rcv_date`
                    , `warehouse`.`wh_name`
                    , `inbound`.`inbound_location`
                    , `inbound_detail`.`det_inbound_id`')
                    ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                    ->join('po_detail', 'inbound_detail.po_detail_id=po_detail.po_detail_id')
                    ->join('material', 'po_detail.material_id=material.material_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->where('inbound_detail.status', 2)
                    ->groupStart()
                            ->like('material.material_id', $search)
                            ->orLike('material.material_name', $search)
                            ->orLike('inbound_detail.qty_good_in', $search)
                            ->orLike('inbound_detail.qty_notgood_in', $search)
                            ->orLike('inbound.inbound_rcv_date', $search)
                            ->orLike('warehouse.wh_name', $search)
                        ->groupEnd()
                    ->get();
            return $query->getRow()->total;
        } else {
            $query = $this->db->table('inbound_detail')
                    ->selectCount('inbound_detail.det_inbound_id', 'total')
                    ->select('`material`.`material_name`
                    , `po_detail`.`material_id`
                    , `inbound_detail`.`material_detail_id`
                    , `inbound_detail`.`qty_good_in`
                    , `inbound_detail`.`qty_notgood_in`
                    , `inbound_detail`.`qty_realization`
                    , `inbound`.`inbound_rcv_date`
                    , `warehouse`.`wh_name`
                    , `inbound`.`inbound_location`
                    , `inbound_detail`.`det_inbound_id`')
                    ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                    ->join('po_detail', 'inbound_detail.po_detail_id=po_detail.po_detail_id')
                    ->join('material', 'po_detail.material_id=material.material_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->where('inbound_detail.status', 2)
                    ->where('inbound.inbound_location', session()->get('warehouse_id'))
                    ->groupStart()
                            ->like('material.material_id', $search)
                            ->orLike('material.material_name', $search)
                            ->orLike('inbound_detail.qty_good_in', $search)
                            ->orLike('inbound_detail.qty_notgood_in', $search)
                            ->orLike('inbound.inbound_rcv_date', $search)
                            ->orLike('warehouse.wh_name', $search)
                        ->groupEnd()
                    ->get();
            return $query->getRow()->total;
        }
    }
    // End Serverside

    public function get_detail_material($det_inbound_id, $material_detail_id){
        $query = $this->db->table('inbound_detail')
                ->select('inbound_detail.det_inbound_id, material.material_name, inbound_detail.material_detail_id, inbound.inbound_location,
                inbound_detail.qty_good_in, inbound_detail.qty_notgood_in, inbound_detail.qty_realization, inbound.inbound_id,
                material.material_code, mb.batch_no, mb.expired_date')
                ->join('inbound', 'inbound_detail.inbound_id = inbound.inbound_id')
                ->join('po_detail', 'inbound_detail.po_detail_id=po_detail.po_detail_id')
                ->join('material', 'po_detail.material_id=material.material_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->join('material_detail mb','mb.mat_detail_id=inbound_detail.material_detail_id')
                ->where('inbound_detail.status', 2)
                ->where('inbound_detail.det_inbound_id', $det_inbound_id)
                ->where('inbound_detail.material_detail_id', $material_detail_id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_detail_material_move($location_id){
        $query = $this->db->table('material_location')
                ->select('material_location.location_id
                            , material_location.material_detail_id
                            , material_location.qty 
                            , material_location.shelf_id
                            , shelf.rak_id
                            , rak.blok_id
                            , area_blok.wh_area_id
                            , shelf.shelf_availability
                            , material.material_name')
                ->join('material_detail', 'material_location.material_detail_id = material_detail.mat_detail_id')
                ->join('shelf', 'material_location.shelf_id = shelf.shelf_id')
                ->join('rak', 'shelf.rak_id = rak.rak_id')
                ->join('area_blok', 'rak.blok_id = area_blok.blok_id')
                ->join('wh_area', 'area_blok.wh_area_id = wh_area.area_id') // sampe sini.
                ->join('material', 'material_detail.material_id=material.material_id')
                ->where('material_location.location_id', $location_id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function check_material_detail_on_shelf($material_detail_id, $shelf_id, $exec){
        $query = $this->db->table('material_location')
                ->selectCount($this->primaryKey, 'total')
                ->select('`location_id`
                    , `material_detail_id`
                    , material_location.`shelf_id`
                    , material_location.status
                    , shelf.shelf_availability
                    , qty')
                ->join('shelf', 'material_location.shelf_id = shelf.shelf_id')
                ->where('material_detail_id', $material_detail_id)
                ->where('material_location.shelf_id', $shelf_id)
                ->get();
        if($exec == "count"){
            return $query->getRow()->total;
        }else {
            return $query->getRow();
        }
    }

    public function check_material_detail_on_shelfv2($location_id){
        $query = $this->db->table('material_location')
                ->selectCount($this->primaryKey, 'total')
                ->select('`location_id`
                    , `material_detail_id`
                    , material_location.`shelf_id`
                    , material_location.status
                    , shelf.shelf_availability
                    , qty')
                ->join('shelf', 'material_location.shelf_id = shelf.shelf_id')
                ->where('location_id', $location_id)
                ->get();
        return $query->getRow();
    }

    public function get_location_byid($id){
        $query = $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->limit(1)
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
                ->where($this->primaryKey, $id)
                ->update($data);
    }

    public function delete_data($id)
    {
        $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->delete();
    }

    public function get_wharea_bywhid($wh_id){
        $query = $this->db->table('wh_area')
                ->where("wh_id", $wh_id)
                ->where("status", 1)
                ->orderBy('wh_area_name', 'ASC')
                ->get();
        return $query->getResult();
    }

    public function get_blok_byarea($area_id){
        $query = $this->db->table('area_blok')
                ->where("wh_area_id", $area_id)
                ->where("status", 1)
                ->get();
        return $query->getResult();
    }

    public function get_rak_byblok($blok_id){
        $query = $this->db->table('rak')
                ->where("blok_id", $blok_id)
                ->where("status", 1)
                ->get();
        return $query->getResult();
    }

    public function get_shelf_byrak($rak_id){
        $query = $this->db->table('shelf')
                ->where("rak_id", $rak_id)
                ->where("status", 1)
                ->orderBy('shelf_id', 'DESC')
                ->get();
        return $query->getResult();
    }

    public function get_materials_byshelf($shelf_id){
        //tampilkan expired date, owner, batch number nya juga.
        $query = $this->db->table('material_location')
                ->select('material_location.`shelf_id`
                            , material_detail.`material_id`
                            , material_detail.`batch_no`
                            , material_detail.`expired_date`
                            , owners.`owners_name`
                            , material.`material_name`
                            , material_location.`qty`
                            , material_location.`location_id`
                            , material_location.`material_detail_id`')
                ->join('material_detail', 'material_location.`material_detail_id` = material_detail.`mat_detail_id`')
                ->join('material', 'material_detail.`material_id` = material.`material_id`')
                ->join('owners', 'material_detail.`owner_id` = owners.`owners_id`')
                ->where('material_location.`shelf_id`', $shelf_id)
                ->get();
        return $query->getResult();
    }

    public function count_material_on_shelf($shelf_id){
        $query = $this->db->table('material_location')
                ->select('location_id
                    , shelf_id
                    , material_detail_id
                    , SUM(qty) AS qty')
                ->where('shelf_id', $shelf_id)
                ->groupBy('shelf_id')
                ->limit(1)
                ->get();
        
        return $query->getRow();
    }
}
?>