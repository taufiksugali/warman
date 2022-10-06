<?php namespace App\Models;

use CodeIgniter\Model;

class OutModel extends Model
{
    protected $table = "material_detail";
    protected $matDetail = "material_detail";
    protected $outbound = "outbound_detail";
    protected $primaryKey = 'mat_detail_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function all_laporan_out($start_date, $end_date, $wh, $limit, $start, $col, $dir){
        $filter_date_range = null;
        $filter_wh = null;
        if($start_date != null && $end_date != null) {
            $filter_date_range = " AND (out_date BETWEEN '$start_date' AND '$end_date')";
        }

        if(@$wh){
            $filter_wh = " AND outbound.outbound_wh_asal='$wh'";
        }
        
        $cond = "outbound.outbound_id != '' $filter_date_range $filter_wh";
        if($filter_date_range != null || $filter_wh != null){
            if(session()->get('user_type') == 1){
                $query = $this->db->table($this->outbound)
                        ->select('
                                    outbound.`outbound_id`
                                    , outbound.`po_outbound_id`
                                    , outbound.`out_date`
                                    , outbound.`outbound_wh_asal`
                                    , warehouse.`wh_name`
                                    , outbound_detail.`material_detail_id`
                                    , material.`material_name`
                                    , outbound_detail.`qty_realization`
                                    , outbound.`penerima`
                                    , customer.`customer_name`
                                    , owners.owners_name')
                        ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                        ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                        ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('po_outbound.owners_id', session()->get('owners_id'))
                        ->where($cond)
                        ->groupby('outbound.po_outbound_id') //nambah group by
                        ->limit($limit, $start)
                        ->orderBy($col, $dir)
                        ->orderBy('outbound.out_date', 'DESC')
                        ->get();
            } else {
                if(session()->get('warehouse_id') == 'POSLOG'){
                    $query = $this->db->table($this->outbound)
                            ->select('
                                        outbound.`outbound_id`
                                        , outbound.`po_outbound_id`
                                        , outbound.`out_date`
                                        , outbound.`outbound_wh_asal`
                                        , warehouse.`wh_name`
                                        , outbound_detail.`material_detail_id`
                                        , material.`material_name`
                                        , outbound_detail.`qty_realization`
                                        , outbound.`penerima`
                                        , customer.`customer_name`
                                        , owners.owners_name')
                            ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                            ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                            ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                            ->join('customer', 'outbound.penerima=customer.customer_id')
                            ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                            ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                            ->join('material', 'material_detail.material_id=material.material_id')
                            ->where($cond)
                            ->groupby('outbound.po_outbound_id')
                            ->limit($limit, $start)
                            ->orderBy($col, $dir)
                            ->orderBy('outbound.out_date', 'DESC')
                            ->get();
                } else {
                    $query = $this->db->table($this->outbound)
                            ->select('
                                        outbound.`outbound_id`
                                        , outbound.`po_outbound_id`
                                        , outbound.`out_date`
                                        , outbound.`outbound_wh_asal`
                                        , warehouse.`wh_name`
                                        , outbound_detail.`material_detail_id`
                                        , material.`material_name`
                                        , outbound_detail.`qty_realization`
                                        , outbound.`penerima`
                                        , customer.`customer_name`
                                        , owners.owners_name')
                            ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                            ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                            ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                            ->join('customer', 'outbound.penerima=customer.customer_id')
                            ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                            ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                            ->join('material', 'material_detail.material_id=material.material_id')
                            ->where($cond)
                            ->where('outbound.outbound_wh_asal', @session()->get('warehouse_id'))
                            ->groupby('outbound.po_outbound_id')
                            ->limit($limit, $start)
                            ->orderBy($col, $dir)
                            ->orderBy('outbound.out_date', 'DESC')
                            ->get();
                }
            }
        } else {
            if(session()->get('user_type') == 1){
                $query = $this->db->table($this->outbound)
                        ->select('
                                    outbound.`outbound_id`
                                    , outbound.`po_outbound_id`
                                    , outbound.`out_date`
                                    , outbound.`outbound_wh_asal`
                                    , warehouse.`wh_name`
                                    , outbound_detail.`material_detail_id`
                                    , material.`material_name`
                                    , outbound_detail.`qty_realization`
                                    , outbound.`penerima`
                                    , customer.`customer_name`
                                    , owners.owners_name')
                        ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                        ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                        ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('po_outbound.owners_id', session()->get('owners_id'))
                        ->groupby('outbound.po_outbound_id') //nambah group by
                        ->limit($limit, $start)
                        ->orderBy($col, $dir)
                        ->orderBy('outbound.out_date', 'DESC')
                        ->get();
            } else {
                if(session()->get('warehouse_id') == 'POSLOG'){
                    $query = $this->db->table($this->outbound)
                            ->select('
                                        outbound.`outbound_id`
                                        , outbound.`po_outbound_id`
                                        , outbound.`out_date`
                                        , outbound.`outbound_wh_asal`
                                        , warehouse.`wh_name`
                                        , outbound_detail.`material_detail_id`
                                        , material.`material_name`
                                        , outbound_detail.`qty_realization`
                                        , outbound.`penerima`
                                        , customer.`customer_name`
                                        , owners.owners_name')
                            ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                            ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                            ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                            ->join('customer', 'outbound.penerima=customer.customer_id')
                            ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                            ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                            ->join('material', 'material_detail.material_id=material.material_id')
                            ->groupby('outbound.po_outbound_id')
                            ->limit($limit, $start)
                            ->orderBy($col, $dir)
                            ->orderBy('outbound.out_date', 'DESC')
                            ->get();
                } else {
                    $query = $this->db->table($this->outbound)
                            ->select('
                                        outbound.`outbound_id`
                                        , outbound.`po_outbound_id`
                                        , outbound.`out_date`
                                        , outbound.`outbound_wh_asal`
                                        , warehouse.`wh_name`
                                        , outbound_detail.`material_detail_id`
                                        , material.`material_name`
                                        , outbound_detail.`qty_realization`
                                        , outbound.`penerima`
                                        , customer.`customer_name`
                                        , owners.owners_name')
                            ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                            ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                            ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                            ->join('customer', 'outbound.penerima=customer.customer_id')
                            ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                            ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                            ->join('material', 'material_detail.material_id=material.material_id')
                            ->where('outbound.outbound_wh_asal', @session()->get('warehouse_id'))
                            ->groupby('outbound.po_outbound_id')
                            ->limit($limit, $start)
                            ->orderBy($col, $dir)
                            ->orderBy('outbound.out_date', 'DESC')
                            ->get();

                }
            }
        }
            
        return $query->getResult();
    }

    public function all_laporan_out_count($start_date, $end_date, $wh){
        $filter_date_range = null;
        $filter_wh = null;
        if($start_date != null && $end_date != null) {
            $filter_date_range = " AND (out_date BETWEEN '$start_date' AND '$end_date')";
        }

        if(@$wh){
            $filter_wh = " AND outbound.outbound_wh_asal='$wh'";
        }
        
        $cond = "outbound.outbound_id != '' $filter_date_range $filter_wh";
        if($filter_date_range != null || $filter_wh != null){
            if(session()->get('user_type') == 1){
                $query = $this->db->table($this->outbound)
                    ->select('
                            outbound.`outbound_id`
                            , outbound.`po_outbound_id`
                            , outbound.`out_date`
                            , outbound.`outbound_wh_asal`
                            , warehouse.`wh_name`
                            , outbound_detail.`material_detail_id`
                            , material.`material_name`
                            , outbound_detail.`qty_realization`
                            , outbound.`penerima`
                            , customer.`customer_name`
                            , owners.owners_name')
                    ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                    ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                    ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                    ->join('customer', 'outbound.penerima=customer.customer_id')
                    ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                    ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                    ->join('material', 'material_detail.material_id=material.material_id')
                    ->where('po_outbound.owners_id', session()->get('owners_id'))
                    ->where($cond)
                    ->groupby('outbound.po_outbound_id'); //nambah group by;
            } else {
                if(session()->get('warehouse_id') == 'POSLOG'){
                    $query = $this->db->table($this->outbound)
                        ->select('
                                outbound.`outbound_id`
                                , outbound.`po_outbound_id`
                                , outbound.`out_date`
                                , outbound.`outbound_wh_asal`
                                , warehouse.`wh_name`
                                , outbound_detail.`material_detail_id`
                                , material.`material_name`
                                , outbound_detail.`qty_realization`
                                , outbound.`penerima`
                                , customer.`customer_name`
                                , owners.owners_name')
                        ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                        ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                        ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where($cond)
                        ->groupby('outbound.po_outbound_id');
                } else {
                    $query = $this->db->table($this->outbound)
                        ->select('
                                outbound.`outbound_id`
                                , outbound.`po_outbound_id`
                                , outbound.`out_date`
                                , outbound.`outbound_wh_asal`
                                , warehouse.`wh_name`
                                , outbound_detail.`material_detail_id`
                                , material.`material_name`
                                , outbound_detail.`qty_realization`
                                , outbound.`penerima`
                                , customer.`customer_name`
                                , owners.owners_name')
                        ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                        ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                        ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where($cond)
                        ->where('outbound.outbound_wh_asal', @session()->get('warehouse_id'))
                        ->groupby('outbound.po_outbound_id');

                }
            }
        } else {
            if(session()->get('user_type') == 1){
                $query = $this->db->table($this->outbound)
                    ->select('
                            outbound.`outbound_id`
                            , outbound.`po_outbound_id`
                            , outbound.`out_date`
                            , outbound.`outbound_wh_asal`
                            , warehouse.`wh_name`
                            , outbound_detail.`material_detail_id`
                            , material.`material_name`
                            , outbound_detail.`qty_realization`
                            , outbound.`penerima`
                            , customer.`customer_name`
                            , owners.owners_name')
                    ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                    ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                    ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                    ->join('customer', 'outbound.penerima=customer.customer_id')
                    ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                    ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                    ->join('material', 'material_detail.material_id=material.material_id')
                    ->where('po_outbound.owners_id', session()->get('owners_id'))
                    ->groupby('outbound.po_outbound_id');
            } else {
                if(session()->get('warehouse_id') == 'POSLOG'){
                    $query = $this->db->table($this->outbound)
                        ->select('
                                outbound.`outbound_id`
                                , outbound.`po_outbound_id`
                                , outbound.`out_date`
                                , outbound.`outbound_wh_asal`
                                , warehouse.`wh_name`
                                , outbound_detail.`material_detail_id`
                                , material.`material_name`
                                , outbound_detail.`qty_realization`
                                , outbound.`penerima`
                                , customer.`customer_name`
                                , owners.owners_name')
                        ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                        ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                        ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->groupby('outbound.po_outbound_id');
                } else {
                    $query = $this->db->table($this->outbound)
                        ->select('
                                outbound.`outbound_id`
                                , outbound.`po_outbound_id`
                                , outbound.`out_date`
                                , outbound.`outbound_wh_asal`
                                , warehouse.`wh_name`
                                , outbound_detail.`material_detail_id`
                                , material.`material_name`
                                , outbound_detail.`qty_realization`
                                , outbound.`penerima`
                                , customer.`customer_name`
                                , owners.owners_name')
                        ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                        ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                        ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('outbound.outbound_wh_asal', @session()->get('warehouse_id'))
                        ->groupby('outbound.po_outbound_id');

                }
            }
        }
        
        return $query->countAllResults();
    }

    public function search_laporan_out($start_date, $end_date, $wh, $limit, $start, $search, $col, $dir){
        $filter_date_range = null;
        $filter_wh = null;
        if($start_date != null && $end_date != null) {
            $filter_date_range = " AND (out_date BETWEEN '$start_date' AND '$end_date')";
        }

        if(@$wh){
            $filter_wh = " AND outbound.outbound_wh_asal='$wh'";
        }
        
        $cond = "outbound.outbound_id != '' $filter_date_range $filter_wh";
        if($filter_date_range != null || $filter_wh != null){
            if(session()->get('user_type') == 1){
                $query = $this->db->table($this->outbound)
                        ->select('
                                outbound.`outbound_id`
                                , outbound.`po_outbound_id`
                                , outbound.`out_date`
                                , outbound.`outbound_wh_asal`
                                , warehouse.`wh_name`
                                , outbound_detail.`material_detail_id`
                                , material.`material_name`
                                , outbound_detail.`qty_realization`
                                , outbound.`penerima`
                                , customer.`customer_name`
                                , owners.owners_name')
                        ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                        ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                        ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('po_outbound.owners_id', session()->get('owners_id'))
                        ->where($cond)
                        ->where("( warehouse.`wh_name` LIKE '%$search%' OR outbound.outbound_wh_asal LIKE '%$search%' OR 
                                    material_detail.material_id LIKE '%$search%' OR material.material_name LIKE '%$search%' OR
                                    owners.`owners_name` LIKE '%$search%' OR customer.`customer_name` LIKE '%$search%' OR
                                    outbound_detail.`qty_realization` LIKE '%$search%' )")
                        ->groupby('outbound.po_outbound_id') //nambah group by
                        ->limit($limit, $start)
                        ->orderBy($col, $dir)
                        ->orderBy('outbound.out_date', 'DESC')
                        ->get();
            } else {
                if(session()->get('warehouse_id') == 'POSLOG'){
                    $query = $this->db->table($this->outbound)
                            ->select('
                                    outbound.`outbound_id`
                                    , outbound.`po_outbound_id`
                                    , outbound.`out_date`
                                    , outbound.`outbound_wh_asal`
                                    , warehouse.`wh_name`
                                    , outbound_detail.`material_detail_id`
                                    , material.`material_name`
                                    , outbound_detail.`qty_realization`
                                    , outbound.`penerima`
                                    , customer.`customer_name`
                                    , owners.owners_name')
                            ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                            ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                            ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                            ->join('customer', 'outbound.penerima=customer.customer_id')
                            ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                            ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                            ->join('material', 'material_detail.material_id=material.material_id')
                            ->where($cond)
                            ->where("( warehouse.`wh_name` LIKE '%$search%' OR outbound.outbound_wh_asal LIKE '%$search%' OR 
                                        material_detail.material_id LIKE '%$search%' OR material.material_name LIKE '%$search%' OR
                                        owners.`owners_name` LIKE '%$search%' OR customer.`customer_name` LIKE '%$search%' OR
                                        outbound_detail.`qty_realization` LIKE '%$search%' )")
                            ->groupby('outbound.po_outbound_id')
                            ->limit($limit, $start)
                            ->orderBy($col, $dir)
                            ->orderBy('outbound.out_date', 'DESC')
                            ->get();
                } else {
                    $query = $this->db->table($this->outbound)
                            ->select('
                                    outbound.`outbound_id`
                                    , outbound.`po_outbound_id`
                                    , outbound.`out_date`
                                    , outbound.`outbound_wh_asal`
                                    , warehouse.`wh_name`
                                    , outbound_detail.`material_detail_id`
                                    , material.`material_name`
                                    , outbound_detail.`qty_realization`
                                    , outbound.`penerima`
                                    , customer.`customer_name`
                                    , owners.owners_name')
                            ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                            ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                            ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                            ->join('customer', 'outbound.penerima=customer.customer_id')
                            ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                            ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                            ->join('material', 'material_detail.material_id=material.material_id')
                            ->where($cond)
                            ->where('inbound.inbound_location', @session()->get('warehouse_id'))
                            ->where("( warehouse.`wh_name` LIKE '%$search%' OR 
                                        material_detail.material_id LIKE '%$search%' OR material.material_name LIKE '%$search%' OR
                                        owners.`owners_name` LIKE '%$search%' OR customer.`customer_name` LIKE '%$search%' OR
                                        outbound_detail.`qty_realization` LIKE '%$search%' )")
                            ->groupby('outbound.po_outbound_id')
                            ->limit($limit, $start)
                            ->orderBy($col, $dir)
                            ->orderBy('outbound.out_date', 'DESC')
                            ->get();

                }
            }
        } else {
            if(session()->get('user_type') == 1){
                $query = $this->db->table($this->outbound)
                        ->select('
                                outbound.`outbound_id`
                                , outbound.`po_outbound_id`
                                , outbound.`out_date`
                                , outbound.`outbound_wh_asal`
                                , warehouse.`wh_name`
                                , outbound_detail.`material_detail_id`
                                , material.`material_name`
                                , outbound_detail.`qty_realization`
                                , outbound.`penerima`
                                , customer.`customer_name`
                                , owners.owners_name')
                        ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                        ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                        ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('po_outbound.owners_id', session()->get('owners_id'))
                        ->where("( warehouse.`wh_name` LIKE '%$search%' OR outbound.outbound_wh_asal LIKE '%$search%' OR 
                                    material_detail.material_id LIKE '%$search%' OR material.material_name LIKE '%$search%' OR
                                    owners.`owners_name` LIKE '%$search%' OR customer.`customer_name` LIKE '%$search%' OR
                                    outbound_detail.`qty_realization` LIKE '%$search%' )")
                        ->groupby('outbound.po_outbound_id') //nambah group by
                        ->limit($limit, $start)
                        ->orderBy($col, $dir)
                        ->orderBy('outbound.out_date', 'DESC')
                        ->get();
            } else {
                if(session()->get('warehouse_id') == 'POSLOG'){
                $query = $this->db->table($this->outbound)
                        ->select('
                                outbound.`outbound_id`
                                , outbound.`po_outbound_id`
                                , outbound.`out_date`
                                , outbound.`outbound_wh_asal`
                                , warehouse.`wh_name`
                                , outbound_detail.`material_detail_id`
                                , material.`material_name`
                                , outbound_detail.`qty_realization`
                                , outbound.`penerima`
                                , customer.`customer_name`
                                , owners.owners_name')
                        ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                        ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                        ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->like('warehouse.`wh_name`', $search)
                        ->orLike('outbound.outbound_wh_asal', $search)
                        ->orLike('material_detail.material_id', $search)
                        ->orLike('material.material_name', $search)
                        ->orLike('owners.`owners_name`', $search)
                        ->orLike('customer.`customer_name`', $search)
                        ->orLike('outbound_detail.`qty_realization`', $search)
                        ->limit($limit, $start)
                        ->groupby('outbound.po_outbound_id')
                        ->orderBy($col, $dir)
                        ->orderBy('outbound.out_date', 'DESC')
                        ->get();
                } else {
                    $query = $this->db->table($this->outbound)
                            ->select('
                                    outbound.`outbound_id`
                                    , outbound.`po_outbound_id`
                                    , outbound.`out_date`
                                    , outbound.`outbound_wh_asal`
                                    , warehouse.`wh_name`
                                    , outbound_detail.`material_detail_id`
                                    , material.`material_name`
                                    , outbound_detail.`qty_realization`
                                    , outbound.`penerima`
                                    , customer.`customer_name`
                                    , owners.owners_name')
                            ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                            ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                            ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                            ->join('customer', 'outbound.penerima=customer.customer_id')
                            ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                            ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                            ->join('material', 'material_detail.material_id=material.material_id')
                            ->where('outbound.outbound_wh_asal', @session()->get('warehouse_id'))
                            ->groupStart()
                                ->like('warehouse.`wh_name`', $search)
                                ->orLike('material_detail.material_id', $search)
                                ->orLike('material.material_name', $search)
                                ->orLike('owners.`owners_name`', $search)
                                ->orLike('customer.`customer_name`', $search)
                                ->orLike('outbound_detail.`qty_realization`', $search)
                            ->groupEnd()
                            ->limit($limit, $start)
                            ->groupby('outbound.po_outbound_id')
                            ->orderBy($col, $dir)
                            ->orderBy('outbound.out_date', 'DESC')
                            ->get();
                }
            }

        }
        return $query->getResult();
    }
    
    public function search_laporan_out_count($start_date, $end_date, $wh, $search){
        $filter_date_range = null;
        $filter_wh = null;
        if($start_date != null && $end_date != null) {
            $filter_date_range = " AND (out_date BETWEEN '$start_date' AND '$end_date')";
        }

        if(@$wh){
            $filter_wh = " AND outbound.outbound_wh_asal='$wh'";
        }
        
        $cond = "outbound.outbound_id != '' $filter_date_range $filter_wh";
        if($filter_date_range != null || $filter_wh != null){
            if(session()->get('user_type') == 1){
                $query = $this->db->table($this->outbound)
                        ->select('
                                outbound.`outbound_id`
                                , outbound.`po_outbound_id`
                                , outbound.`out_date`
                                , outbound.`outbound_wh_asal`
                                , warehouse.`wh_name`
                                , outbound_detail.`material_detail_id`
                                , material.`material_name`
                                , outbound_detail.`qty_realization`
                                , outbound.`penerima`
                                , customer.`customer_name`
                                , owners.owners_name')
                        ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                        ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                        ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('po_outbound.owners_id', session()->get('owners_id'))
                        ->where($cond)
                        ->where("( warehouse.`wh_name` LIKE '%$search%' OR outbound.outbound_wh_asal LIKE '%$search%' OR 
                                    material_detail.material_id LIKE '%$search%' OR material.material_name LIKE '%$search%' OR
                                    owners.`owners_name` LIKE '%$search%' OR customer.`customer_name` LIKE '%$search%' OR
                                    outbound_detail.`qty_realization` LIKE '%$search%' )")
                        ->groupby('outbound.po_outbound_id');
            } else {
                if(session()->get('warehouse_id') == 'POSLOG'){
                    $query = $this->db->table($this->outbound)
                            ->select('
                                    outbound.`outbound_id`
                                    , outbound.`po_outbound_id`
                                    , outbound.`out_date`
                                    , outbound.`outbound_wh_asal`
                                    , warehouse.`wh_name`
                                    , outbound_detail.`material_detail_id`
                                    , material.`material_name`
                                    , outbound_detail.`qty_realization`
                                    , outbound.`penerima`
                                    , customer.`customer_name`
                                    , owners.owners_name')
                            ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                            ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                            ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                            ->join('customer', 'outbound.penerima=customer.customer_id')
                            ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                            ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                            ->join('material', 'material_detail.material_id=material.material_id')
                            ->where($cond)
                            ->where("( warehouse.`wh_name` LIKE '%$search%' OR outbound.outbound_wh_asal LIKE '%$search%' OR 
                                        material_detail.material_id LIKE '%$search%' OR material.material_name LIKE '%$search%' OR
                                        owners.`owners_name` LIKE '%$search%' OR customer.`customer_name` LIKE '%$search%' OR
                                        outbound_detail.`qty_realization` LIKE '%$search%' )")
                            ->groupby('outbound.po_outbound_id');
                } else {
                    $query = $this->db->table($this->outbound)
                            ->select('
                                    outbound.`outbound_id`
                                    , outbound.`po_outbound_id`
                                    , outbound.`out_date`
                                    , outbound.`outbound_wh_asal`
                                    , warehouse.`wh_name`
                                    , outbound_detail.`material_detail_id`
                                    , material.`material_name`
                                    , outbound_detail.`qty_realization`
                                    , outbound.`penerima`
                                    , customer.`customer_name`
                                    , owners.owners_name')
                            ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                            ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                            ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                            ->join('customer', 'outbound.penerima=customer.customer_id')
                            ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                            ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                            ->join('material', 'material_detail.material_id=material.material_id')
                            ->where($cond)
                            ->where('outbound.outbound_wh_asal', @session()->get('warehouse_id'))
                            ->where("( warehouse.`wh_name` LIKE '%$search%' OR 
                                        material_detail.material_id LIKE '%$search%' OR material.material_name LIKE '%$search%' OR
                                        owners.`owners_name` LIKE '%$search%' OR customer.`customer_name` LIKE '%$search%' OR
                                        outbound_detail.`qty_realization` LIKE '%$search%' )")
                            ->groupby('outbound.po_outbound_id');

                }
            }
        } else {
            if(session()->get('user_type') == 1){
                $query = $this->db->table($this->outbound)
                        ->select('
                                outbound.`outbound_id`
                                , outbound.`po_outbound_id`
                                , outbound.`out_date`
                                , outbound.`outbound_wh_asal`
                                , warehouse.`wh_name`
                                , outbound_detail.`material_detail_id`
                                , material.`material_name`
                                , outbound_detail.`qty_realization`
                                , outbound.`penerima`
                                , customer.`customer_name`
                                , owners.owners_name')
                        ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                        ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                        ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('po_outbound.owners_id', session()->get('owners_id'))
                        ->where("( warehouse.`wh_name` LIKE '%$search%' OR outbound.outbound_wh_asal LIKE '%$search%' OR 
                                    material_detail.material_id LIKE '%$search%' OR material.material_name LIKE '%$search%' OR
                                    owners.`owners_name` LIKE '%$search%' OR customer.`customer_name` LIKE '%$search%' OR
                                    outbound_detail.`qty_realization` LIKE '%$search%' )")
                        ->groupby('outbound.po_outbound_id');
            } else {
                if(session()->get('warehouse_id') == 'POSLOG'){
                    $query = $this->db->table($this->outbound)
                            ->select('
                                    outbound.`outbound_id`
                                    , outbound.`po_outbound_id`
                                    , outbound.`out_date`
                                    , outbound.`outbound_wh_asal`
                                    , warehouse.`wh_name`
                                    , outbound_detail.`material_detail_id`
                                    , material.`material_name`
                                    , outbound_detail.`qty_realization`
                                    , outbound.`penerima`
                                    , customer.`customer_name`
                                    , owners.owners_name')
                            ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                            ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                            ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                            ->join('customer', 'outbound.penerima=customer.customer_id')
                            ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                            ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                            ->join('material', 'material_detail.material_id=material.material_id')
                            ->like('warehouse.`wh_name`', $search)
                            ->orLike('outbound.outbound_wh_asal', $search)
                            ->orLike('material_detail.material_id', $search)
                            ->orLike('material.material_name', $search)
                            ->orLike('customer.`customer_name`', $search)
                            ->orLike('outbound_detail.`qty_realization`', $search)
                            ->groupby('outbound.po_outbound_id');
                } else {
                    $query = $this->db->table($this->outbound)
                            ->select('
                                    outbound.`outbound_id`
                                    , outbound.`po_outbound_id`
                                    , outbound.`out_date`
                                    , outbound.`outbound_wh_asal`
                                    , warehouse.`wh_name`
                                    , outbound_detail.`material_detail_id`
                                    , material.`material_name`
                                    , outbound_detail.`qty_realization`
                                    , outbound.`penerima`
                                    , customer.`customer_name`
                                    , owners.owners_name')
                            ->join('outbound', 'outbound_detail.outbound_id=outbound.outbound_id')
                            ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                            ->join('owners', 'po_outbound.owners_id=owners.owners_id')
                            ->join('customer', 'outbound.penerima=customer.customer_id')
                            ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                            ->join('material_detail', 'outbound_detail.material_detail_id=material_detail.mat_detail_id')
                            ->join('material', 'material_detail.material_id=material.material_id')
                            ->where('outbound.outbound_wh_asal', @session()->get('warehouse_id'))
                            ->groupStart()
                                ->like('warehouse.`wh_name`', $search)
                                ->orLike('outbound.outbound_wh_asal', $search)
                                ->orLike('material_detail.material_id', $search)
                                ->orLike('material.material_name', $search)
                                ->orLike('customer.`customer_name`', $search)
                                ->orLike('outbound_detail.`qty_realization`', $search)
                            ->groupEnd()
                            ->groupby('outbound.po_outbound_id');
                }
            }
        }
        return $query->countAllResults();
    }
}
?>