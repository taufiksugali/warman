<?php namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $table = "material_detail";
    protected $matDetail = "material_detail";
    protected $primaryKey = 'mat_detail_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function all_soh($limit, $start, $col, $dir){
        // var_dump(session()->get('warehouse_id'));
        // die;
        if(session()->get('warehouse_id') == "POSLOG"){
            $query = $this->db->table($this->matDetail)
                ->select('`warehouse`.`warehouse_id`,
                          `warehouse`.`wh_name`,
                          `material_detail`.`material_id`, 
                          `material`.`material_name`,
                          SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                          SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->limit($limit, $start)
                ->groupBy('`material_detail`.`material_id`')
                ->orderBy($col, $dir)
                ->get();
                return $query->getResult();
        }else {
            $query = $this->db->table($this->matDetail)
                ->select('`warehouse`.`warehouse_id`,
                          `warehouse`.`wh_name`,
                          `material_detail`.`material_id`, 
                          `material`.`material_name`,
                          SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                          SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->where('inbound.inbound_location', session()->get('warehouse_id'))
                ->limit($limit, $start)
                ->groupBy('`material_detail`.`material_id`')
                ->orderBy($col, $dir)
                ->get();
                return $query->getResult();
        }
        
    }

    public function all_soh_count(){
        if(session()->get('warehouse_id') == "POSLOG"){
            $query = $this->db->table($this->matDetail)
                    ->selectCount('material_detail.material_id', 'total')
                    ->select('`warehouse`.`warehouse_id`,
                            `warehouse`.`wh_name`,
                            `material_detail`.`material_id`, 
                            `material`.`material_name`,
                            SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                            SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                    ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                    ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                    ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('material', 'material_detail.material_id=material.material_id')
                    ->groupBy('`material_detail`.`material_id`')
                    ->get();
                    return $query->getRow()->total;
        }else {
                $query = $this->db->table($this->matDetail)
                        ->selectCount('material_detail.material_id', 'total')
                        ->select('`warehouse`.`warehouse_id`,
                                `warehouse`.`wh_name`,
                                `material_detail`.`material_id`, 
                                `material`.`material_name`,
                                SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                        ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                        ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('inbound.inbound_location', session()->get('warehouse_id'))
                        ->groupBy('`material_detail`.`material_id`')
                        ->get();
                        return $query->getRow()->total;
        }
    }

    public function search_soh($limit, $start, $search, $col, $dir){
        if(session()->get('warehouse_id') == "POSLOG"){
            $query = $this->db->table($this->matDetail)
                    ->select('`warehouse`.`warehouse_id`,
                            `warehouse`.`wh_name`,
                            `material_detail`.`material_id`, 
                            `material`.`material_name`,
                            SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                            SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                    ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                    ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                    ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('material', 'material_detail.material_id=material.material_id')
                    ->like('warehouse.wh_name', $search)
                    ->orLike('material_detail.material_id', $search)
                    ->orLike('material.material_name', $search)
                    ->orLike('stock_ok', $search)
                    ->orLike('stock_nok', $search)
                    ->limit($limit, $start)
                    ->groupBy('`material_detail`.`material_id`')
                    ->orderBy($col, $dir)
                    ->get();
                    return $query->getResult();
            }else {
                $query = $this->db->table($this->matDetail)
                        ->select('`warehouse`.`warehouse_id`,
                                  `warehouse`.`wh_name`,
                                  `material_detail`.`material_id`, 
                                  `material`.`material_name`,
                                  SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                  SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                        ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                        ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('inbound.inbound_location', session()->get('warehouse_id'))
                        ->like('warehouse.wh_name', $search)
                        ->orLike('material_detail.material_id', $search)
                        ->orLike('material.material_name', $search)
                        ->orLike('stock_ok', $search)
                        ->orLike('stock_nok', $search)
                        ->limit($limit, $start)
                        ->groupBy('`material_detail`.`material_id`')
                        ->orderBy($col, $dir)
                        ->get();
                        return $query->getResult();
            }
    }
    
    public function search_soh_count($search){
        if(session()->get('warehouse_id') == "POSLOG"){
            $query = $this->db->table($this->matDetail)
                    ->select('`warehouse`.`warehouse_id`,
                            `warehouse`.`wh_name`,
                            `material_detail`.`material_id`, 
                            `material`.`material_name`,
                            SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                            SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                    ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                    ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                    ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('material', 'material_detail.material_id=material.material_id')
                    ->selectCount('`material_detail`.`material_id`', 'total')
                    ->like('warehouse.wh_name', $search)
                    ->orLike('material_detail.material_id', $search)
                    ->orLike('material.material_name', $search)
                    ->orLike('stock_ok', $search)
                    ->orLike('stock_nok', $search)
                    ->groupBy('`material_detail`.`material_id`')
                    ->get();
                    return $query->getRow()->total;
        }else {
            $query = $this->db->table($this->matDetail)
                    ->select('`warehouse`.`warehouse_id`,
                            `warehouse`.`wh_name`,
                            `material_detail`.`material_id`, 
                            `material`.`material_name`,
                            SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                            SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                    ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                    ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                    ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('material', 'material_detail.material_id=material.material_id')
                    ->selectCount('`material_detail`.`material_id`', 'total')
                    ->where('inbound.inbound_location', session()->get('warehouse_id'))
                    ->like('warehouse.wh_name', $search)
                    ->orLike('material_detail.material_id', $search)
                    ->orLike('material.material_name', $search)
                    ->orLike('stock_ok', $search)
                    ->orLike('stock_nok', $search)
                    ->groupBy('`material_detail`.`material_id`')
                    ->get();
                    return $query->getRow()->total;
        }
    }

    public function total_soh(){// nanti ditambahin parameter
        $query = $this->db->table($this->matDetail)
                ->select('`warehouse`.`warehouse_id`,
                          `warehouse`.`wh_name`,
                          SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                          SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->get();
        return $query->getResult();
    }

    public function stok_good_detail(){// nanti ditambahin parameter
        $query = $this->db->table($this->matDetail)
                ->select("`warehouse`.`warehouse_id`,
                          `warehouse`.`wh_name`,
                          `material_detail`.`material_id`, 
                          `material`.`material_name`,
                          `material_location`.`location_id`,
                          CONCAT(area_blok.`blok_name`, ' ', rak.`rak_name`, ' ', shelf.`shelf_name`) AS mat_loc,
                          `material_location`.`qty`")
                ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                ->join('material_location', 'material_detail.mat_detail_id=material_location.material_detail_id')
                ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                ->join('rak', 'shelf.rak_id=rak.rak_id')
                ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->where('inbound_detail.qty_good_in > 0')
                ->where('wh_area.area_mat_st = 1')
                ->get();
        return $query->getResult();
    }

    public function stok_notgood_detail(){// nanti ditambahin parameter
        $query = $this->db->table($this->matDetail)
                ->select("`warehouse`.`warehouse_id`,
                          `warehouse`.`wh_name`,
                          `material_detail`.`material_id`, 
                          `material`.`material_name`,
                          `material_location`.`location_id`,
                          CONCAT(area_blok.`blok_name`, ' ', rak.`rak_name`, ' ', shelf.`shelf_name`) AS mat_loc,
                          `material_location`.`qty`")
                ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                ->join('material_location', 'material_detail.mat_detail_id=material_location.material_detail_id')
                ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                ->join('rak', 'shelf.rak_id=rak.rak_id')
                ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->where('inbound_detail.qty_notgood_in > 0')
                ->where('wh_area.area_mat_st = 0')
                ->get();
        return $query->getResult();
    }

    public function check_material($owner_id, $material_id, $batch_no, $exp_date){
        $query = $this->db->table($this->table)
                ->select('material_detail.mat_detail_id')
                ->where('owner_id', $owner_id)
                ->where('material_id', $material_id)
                ->where('batch_no', $batch_no)
                ->where('expired_date', $exp_date)
                ->limit(1)
                ->get();
        if($query->getNumRows() > 0){
            return $query->getRow()->mat_detail_id;
        }else{
            return 0;
        }
    }

    public function get_location_bymaterial($owner_id, $warehouse_id, $mat_detail_id){
        $query = $this->db->table($this->table)
                ->select('`material_detail`.`mat_detail_id`
                , `material`.`material_name`
                , `material_detail`.`owner_id`
                , `owners`.`owners_status`
                , `material_detail`.`expired_date`
                , `material_detail`.`batch_no`
                , `material_location`.`shelf_id`
                , `material_location`.`location_id`
                , `shelf`.`shelf_name`
                , `rak`.`rak_name`
                , `area_blok`.`blok_name`
                , `wh_area`.`wh_area_name`
                , `warehouse`.`warehouse_id`
                , `warehouse`.`wh_name`
                , `material_location`.`qty`')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->join('material_location', 'material_location.material_detail_id=material_detail.mat_detail_id')
                ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                ->join('owners', 'material_detail.owner_id=owners.owners_id')
                ->join('rak', 'shelf.rak_id = rak.rak_id')
                ->join('area_blok', 'rak.blok_id = area_blok.blok_id')
                ->join('wh_area', 'area_blok.wh_area_id = wh_area.area_id')
                ->join('warehouse', 'wh_area.wh_id = warehouse.warehouse_id') 
                ->where('material_location.qty > 0')
                ->where('owners.owners_id', $owner_id)
                ->where('warehouse.warehouse_id', $warehouse_id)
                ->where('material_detail.mat_detail_id', $mat_detail_id)
                ->get();
        return $query->getResult();
    }

    public function get_qty_bylocation($owner_id, $warehouse_id, $mat_detail_id, $location_id){
        $query = $this->db->table($this->table)
                ->select('`material_detail`.`mat_detail_id`
                , `material`.`material_name`
                , `material_detail`.`owner_id`
                , `owners`.`owners_status`
                , `material_detail`.`expired_date`
                , `material_detail`.`batch_no`
                , `material_location`.`shelf_id`
                , `material_location`.`location_id`
                , `shelf`.`shelf_name`
                , `rak`.`rak_name`
                , `area_blok`.`blok_name`
                , `wh_area`.`wh_area_name`
                , `warehouse`.`warehouse_id`
                , `warehouse`.`wh_name`
                , `material_location`.`qty`')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->join('material_location', 'material_location.material_detail_id=material_detail.mat_detail_id')
                ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                ->join('owners', 'material_detail.owner_id=owners.owners_id')
                ->join('rak', 'shelf.rak_id = rak.rak_id')
                ->join('area_blok', 'rak.blok_id = area_blok.blok_id')
                ->join('wh_area', 'area_blok.wh_area_id = wh_area.area_id')
                ->join('warehouse', 'wh_area.wh_id = warehouse.warehouse_id') 
                ->where('material_location.qty > 0')
                ->where('owners.owners_id', $owner_id)
                ->where('warehouse.warehouse_id', $warehouse_id)
                ->where('material_detail.mat_detail_id', $mat_detail_id)
                ->where('material_location.location_id', $location_id)
                ->get();
        return $query->getResult();
    }

    public function get_material_byowner($owner_id, $warehouse_id){
        $query = $this->db->table($this->table)
                ->select('`material_detail`.`mat_detail_id`
                , `material`.`material_name`
                , `material_detail`.`owner_id`
                , `owners`.`owners_status`
                , `material_detail`.`expired_date`
                , `material_detail`.`batch_no`
                , `material_location`.`shelf_id`
                , `material_location`.`location_id`
                , `shelf`.`shelf_name`
                , `rak`.`rak_name`
                , `area_blok`.`blok_name`
                , `wh_area`.`wh_area_name`
                , `warehouse`.`warehouse_id`
                , `warehouse`.`wh_name`
                , `material_location`.`qty`')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->join('material_location', 'material_location.material_detail_id=material_detail.mat_detail_id')
                ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                ->join('owners', 'material_detail.owner_id=owners.owners_id')
                ->join('rak', 'shelf.rak_id = rak.rak_id')
                ->join('area_blok', 'rak.blok_id = area_blok.blok_id')
                ->join('wh_area', 'area_blok.wh_area_id = wh_area.area_id')
                ->join('warehouse', 'wh_area.wh_id = warehouse.warehouse_id') 
                ->where('material_location.qty > 0')
                ->where('owners.owners_id', $owner_id)
                ->where('warehouse.warehouse_id', $warehouse_id)
                ->groupBy('`material_detail`.`mat_detail_id`')
                ->get();
        return $query->getResult();
    }

    public function get_all_material(){
        $query = $this->db->table($this->table)
                ->select('material_detail.mat_detail_id, material.material_name, material.material_id, material_detail.expired_date, material_detail.batch_no')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->join('owners', 'material_detail.owner_id=owners.owners_id')
                ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                ->where('warehouse_soh.stock_ok > 0')
                ->get();
        return $query->getResult();
    }

    
}
?>