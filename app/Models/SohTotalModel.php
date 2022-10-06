<?php namespace App\Models;

use CodeIgniter\Model;

class SohTotalModel extends Model
{
    protected $table = "soh_total";
    protected $primaryKey = 'sot_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_soh_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(sot_id, 11)) AS last_id')
                ->get();
        $lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(sot_id, 4, 6)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
        $midId = date('ymd');
        $char = "SOT".$midId;
        if($lastMidId == $midId){
                $tmp = ($lastId->getRow()->last_id)+1;
                $id = substr($tmp, -5);
        }else{
                $id = "00001";
        }
        return $char.$id;
    }

    public function all_soh($limit, $start, $col, $dir)
    {
        if(session()->get('warehouse_id') == "POSLOG"){
            $query = $this->db->table($this->table)
                    ->select('soh_total.sot_id, warehouse.wh_name, owners.owners_name, material.material_name, soh_total.stock_good_seller, soh_total.stock_ngood_seller, soh_total.stock_good_warehouse,
                    soh_total.stock_ngood_warehouse, updated_date')
                    ->join('warehouse', 'soh_total.warehouse_id=warehouse.warehouse_id')
                    ->join('owners', 'soh_total.owner_id=owners.owners_id')
                    ->join('material', 'soh_total.material_id=material.material_id')
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        } else {
            $query = $this->db->table($this->table)
                    ->select('soh_total.sot_id, warehouse.wh_name, owners.owners_name, material.material_name, soh_total.stock_good_seller, soh_total.stock_ngood_seller, soh_total.stock_good_warehouse,
                    soh_total.stock_ngood_warehouse, updated_date')
                    ->join('warehouse', 'soh_total.warehouse_id=warehouse.warehouse_id')
                    ->join('owners', 'soh_total.owner_id=owners.owners_id')
                    ->join('material', 'soh_total.material_id=material.material_id')
                    ->where('soh_total.warehouse_id', @session()->get('warehouse_id'))
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        } 

    }

    public function all_soh_count()
    {
        if(session()->get('warehouse_id') == "POSLOG"){
            $query = $this->db->table($this->table)
                ->select('soh_total.sot_id, warehouse.wh_name, owners.owners_name, material.material_name, soh_total.stock_good_seller, 
                soh_total.stock_ngood_seller, soh_total.stock_good_warehouse, soh_total.stock_ngood_warehouse, updated_date')
                ->join('warehouse', 'soh_total.warehouse_id=warehouse.warehouse_id')
                ->join('owners', 'soh_total.owner_id=owners.owners_id')
                ->join('material', 'soh_total.material_id=material.material_id');
            return $query->countAllResults();
        } else {
            $query = $this->db->table($this->table)
                ->select('soh_total.sot_id, warehouse.wh_name, owners.owners_name, material.material_name, soh_total.stock_good_seller, 
                soh_total.stock_ngood_seller, soh_total.stock_good_warehouse, soh_total.stock_ngood_warehouse, updated_date')
                ->join('warehouse', 'soh_total.warehouse_id=warehouse.warehouse_id')
                ->join('owners', 'soh_total.owner_id=owners.owners_id')
                ->join('material', 'soh_total.material_id=material.material_id')
                ->where('soh_total.warehouse_id', @session()->get('warehouse_id'));
            return $query->countAllResults();
        }
    }

    public function search_soh($limit, $start, $search, $col, $dir)
    {
        if(session()->get('warehouse_id') == "POSLOG"){
            $query = $this->db->table($this->table)
                    ->select('soh_total.sot_id, warehouse.wh_name, owners.owners_name, material.material_name, soh_total.stock_good_seller,
                    soh_total.stock_ngood_seller, soh_total.stock_good_warehouse, soh_total.stock_ngood_warehouse, updated_date')
                    ->join('warehouse', 'soh_total.warehouse_id=warehouse.warehouse_id')
                    ->join('owners', 'soh_total.owner_id=owners.owners_id')
                    ->join('material', 'soh_total.material_id=material.material_id')
                    ->like('soh_total.warehouse_id', $search)
                    ->orLike('soh_total.owner_id', $search)
                    ->orLike('soh_total.material_id', $search)
                    ->orLike('soh_total.stock_good_seller', $search)
                    ->orLike('soh_total.stock_ngood_seller', $search)
                    ->orLike('soh_total.stock_good_warehouse', $search)
                    ->orLike('soh_total.stock_ngood_warehouse', $search)
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        } else {
            $query = $this->db->table($this->table)
                    ->select('soh_total.sot_id, warehouse.wh_name, owners.owners_name, material.material_name, soh_total.stock_good_seller,
                    soh_total.stock_ngood_seller, soh_total.stock_good_warehouse, soh_total.stock_ngood_warehouse, updated_date')
                    ->join('warehouse', 'soh_total.warehouse_id=warehouse.warehouse_id')
                    ->join('owners', 'soh_total.owner_id=owners.owners_id')
                    ->join('material', 'soh_total.material_id=material.material_id')
                    ->where('soh_total.warehouse_id', @session()->get('warehouse_id'))
                    ->groupStart()
                        ->like('soh_total.owner_id', $search)
                        ->orLike('soh_total.material_id', $search)
                        ->orLike('soh_total.stock_good_seller', $search)
                        ->orLike('soh_total.stock_ngood_seller', $search)
                        ->orLike('soh_total.stock_good_warehouse', $search)
                        ->orLike('soh_total.stock_ngood_warehouse', $search)
                    ->groupEnd()
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        }
    }

    public function search_soh_count($search)
    {
        if(session()->get('warehouse_id') == "POSLOG"){
            $query = $this->db->table($this->table)
                    ->selectCount($this->primaryKey, 'total')
                    ->select('soh_total.sot_id, warehouse.wh_name, owners.owners_name, material.material_name, soh_total.stock_good_seller,
                    soh_total.stock_ngood_seller, soh_total.stock_good_warehouse, soh_total.stock_ngood_warehouse, updated_date')
                    ->join('warehouse', 'soh_total.warehouse_id=warehouse.warehouse_id')
                    ->join('owners', 'soh_total.owner_id=owners.owners_id')
                    ->join('material', 'soh_total.material_id=material.material_id')
                    ->like('soh_total.warehouse_id', $search)
                    ->orLike('soh_total.owner_id', $search)
                    ->orLike('soh_total.material_id', $search)
                    ->orLike('soh_total.stock_good_seller', $search)
                    ->orLike('soh_total.stock_ngood_seller', $search)
                    ->orLike('soh_total.stock_good_warehouse', $search)
                    ->orLike('soh_total.stock_ngood_warehouse', $search)
                    ->get();
            return $query->getRow()->total;
        } else {
            $query = $this->db->table($this->table)
                    ->selectCount($this->primaryKey, 'total')
                    ->select('soh_total.sot_id, warehouse.wh_name, owners.owners_name, material.material_name, soh_total.stock_good_seller,
                    soh_total.stock_ngood_seller, soh_total.stock_good_warehouse, soh_total.stock_ngood_warehouse, updated_date')
                    ->join('warehouse', 'soh_total.warehouse_id=warehouse.warehouse_id')
                    ->join('owners', 'soh_total.owner_id=owners.owners_id')
                    ->join('material', 'soh_total.material_id=material.material_id')
                    ->where('soh_total.warehouse_id', @session()->get('warehouse_id'))
                    ->groupStart()
                        ->like('soh_total.owner_id', $search)
                        ->orLike('soh_total.material_id', $search)
                        ->orLike('soh_total.stock_good_seller', $search)
                        ->orLike('soh_total.stock_ngood_seller', $search)
                        ->orLike('soh_total.stock_good_warehouse', $search)
                        ->orLike('soh_total.stock_ngood_warehouse', $search)
                    ->groupEnd()
                    ->get();
            return $query->getRow()->total;
        }
    }

    public function soh_owner($limit, $start, $col, $dir, $value){
        $query = $this->db->table($this->table)
                ->select('soh_total.sot_id, warehouse.wh_name, owners.owners_id, owners.owners_name, material.material_name, soh_total.stock_good_seller, soh_total.stock_ngood_seller, soh_total.stock_good_warehouse,
                soh_total.stock_ngood_warehouse, updated_date')
                ->join('warehouse', 'soh_total.warehouse_id=warehouse.warehouse_id')
                ->join('owners', 'soh_total.owner_id=owners.owners_id')
                ->join('material', 'soh_total.material_id=material.material_id')
                ->where('owners.owners_id', $value)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function soh_owner_count($value)
    {
        $query = $this->db->table($this->table)
            ->select('soh_total.sot_id, warehouse.wh_name, owners.owners_id, owners.owners_name, material.material_name, soh_total.stock_good_seller, 
            soh_total.stock_ngood_seller, soh_total.stock_good_warehouse, soh_total.stock_ngood_warehouse, updated_date')
            ->join('warehouse', 'soh_total.warehouse_id=warehouse.warehouse_id')
            ->join('owners', 'soh_total.owner_id=owners.owners_id')
            ->join('material', 'soh_total.material_id=material.material_id')
            ->where('owners.owners_id', $value);
        return $query->countAllResults();
    }

    public function search_soh_owner($limit, $start, $search, $col, $dir, $value)
    {
        $query = $this->db->table($this->table)
                ->select('soh_total.sot_id, warehouse.wh_name, owners.owners_id, owners.owners_name, material.material_name, soh_total.stock_good_seller,
                soh_total.stock_ngood_seller, soh_total.stock_good_warehouse, soh_total.stock_ngood_warehouse, updated_date')
                ->join('warehouse', 'soh_total.warehouse_id=warehouse.warehouse_id')
                ->join('owners', 'soh_total.owner_id=owners.owners_id')
                ->join('material', 'soh_total.material_id=material.material_id')
                ->where('owners.owners_id', $value)
                ->like('soh_total.warehouse_id', $search)
                ->orLike('soh_total.owner_id', $search)
                ->orLike('soh_total.material_id', $search)
                ->orLike('soh_total.stock_good_seller', $search)
                ->orLike('soh_total.stock_ngood_seller', $search)
                ->orLike('soh_total.stock_good_warehouse', $search)
                ->orLike('soh_total.stock_ngood_warehouse', $search)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function search_soh_owner_count($search, $value)
    {
        $query = $this->db->table($this->table)
                ->selectCount($this->primaryKey, 'total')
                ->select('soh_total.sot_id, warehouse.wh_name, owners.owners_id, owners.owners_name, material.material_name, soh_total.stock_good_seller,
                soh_total.stock_ngood_seller, soh_total.stock_good_warehouse, soh_total.stock_ngood_warehouse, updated_date')
                ->join('warehouse', 'soh_total.warehouse_id=warehouse.warehouse_id')
                ->join('owners', 'soh_total.owner_id=owners.owners_id')
                ->join('material', 'soh_total.material_id=material.material_id')
                ->where('owners.owners_id', $value)
                ->like('soh_total.warehouse_id', $search)
                ->orLike('soh_total.owner_id', $search)
                ->orLike('soh_total.material_id', $search)
                ->orLike('soh_total.stock_good_seller', $search)
                ->orLike('soh_total.stock_ngood_seller', $search)
                ->orLike('soh_total.stock_good_warehouse', $search)
                ->orLike('soh_total.stock_ngood_warehouse', $search)
                ->get();
        return $query->getRow()->total;
    }

    public function get_soh_byId($id){
        $query = $this->db->table($this->table)
                ->select('soh_total.sot_id, warehouse.wh_name, owners.owners_name, material.material_name, soh_total.stock_good_seller, soh_total.stock_ngood_seller, soh_total.stock_good_warehouse,
                soh_total.stock_ngood_warehouse, updated_date')
                ->join('warehouse', 'soh_total.warehouse_id=warehouse.warehouse_id')
                ->join('owners', 'soh_total.owner_id=owners.owners_id')
                ->join('material', 'soh_total.material_id=material.material_id')
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function update_data($id, $data)
    {
        $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->update($data);
    }

    public function insert_data($data){
        return $this->db->table('soh_total')
                ->insert($data);
    }

    public function generate_soh_hist_id(){
        $lastId = $this->db->table('soh_hist')
                ->select('MAX(RIGHT(sohhist_id, 7)) AS last_id')
                ->get();
        $lastMidId = $this->db->table('soh_hist')
                ->select('MAX(MID(sohhist_id, 4, 6)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
        $midId = date('ymd');
        $char = "SHH".$midId;
        if($lastMidId == $midId){
                $tmp = ($lastId->getRow()->last_id)+1;
                $id = substr($tmp, -5);
        }else{
                $id = "00001";
        }
        return $char.$id;
    }

    public function insert_hist($data){
        return $this->db->table('soh_hist')
                ->insert($data);
    }

    public function get_material_id($mat_detail_id){
        $query = $this->db->table('material_detail')
                ->select('material_detail.material_id')
                ->where('material_detail.mat_detail_id',$mat_detail_id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_stock_good($warehouse_id, $owner_id, $material_id){
        $query = $this->db->table($this->table)
                ->select('soh_total.sot_id, soh_total.stock_good_seller, soh_total.stock_good_warehouse')
                ->where('soh_total.warehouse_id', $warehouse_id)
                ->where('soh_total.owner_id', $owner_id)
                ->where('soh_total.material_id', $material_id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_stock_good_v2($warehouse_id, $owner_id, $material_id){
        $query = $this->db->table($this->table)
                ->select('soh_total.sot_id, soh_total.stock_good_seller, soh_total.stock_good_warehouse')
                ->where('soh_total.warehouse_id', $warehouse_id)
                ->where('soh_total.owner_id', $owner_id)
                ->where('soh_total.material_id', $material_id)
                ->get();
        return $query->getResult();
    }
}