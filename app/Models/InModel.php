<?php namespace App\Models;

use CodeIgniter\Model;

class InModel extends Model
{
    protected $table = "material_detail";
    protected $matDetail = "material_detail";
    protected $inbound = "inbound_detail";
    protected $primaryKey = 'mat_detail_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function all_laporan_in($start_date, $end_date, $wh, $limit, $start, $col, $dir){
        $filter_date_range = null;
        $filter_wh = null;
        if($start_date != null && $end_date != null) {
            $filter_date_range = " AND (inbound_doc_date BETWEEN '$start_date' AND '$end_date')";
        }

        if(@$wh){
            $filter_wh = " AND inbound.inbound_location='$wh'";
        }
        
        $cond = "inbound.inbound_id != '' $filter_date_range $filter_wh";
        if($filter_date_range != null || $filter_wh != null){
            if(session()->get('warehouse_id') == 'POSLOG'){
                $query = $this->db->table($this->inbound)
                    ->select('inbound.`inbound_id`
                                , inbound.`inbound_rcv_date`
                                , inbound.`inbound_location`
                                , warehouse.`wh_name`
                                , inbound_detail.`material_detail_id`
                                , material.`material_name`
                                , inbound_detail.`qty_realization`
                                , purchase_order.`supplier_id`')
                    ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('material_detail', 'inbound_detail.material_detail_id=material_detail.mat_detail_id')
                    ->join('material', 'material_detail.material_id=material.material_id')
                    ->where($cond)
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->orderBy('inbound.inbound_rcv_date', 'DESC')
                    ->get();
            } else {
                $query = $this->db->table($this->inbound)
                    ->select('inbound.`inbound_id`
                                , inbound.`inbound_rcv_date`
                                , inbound.`inbound_location`
                                , warehouse.`wh_name`
                                , inbound_detail.`material_detail_id`
                                , material.`material_name`
                                , inbound_detail.`qty_realization`
                                , purchase_order.`supplier_id`')
                    ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('material_detail', 'inbound_detail.material_detail_id=material_detail.mat_detail_id')
                    ->join('material', 'material_detail.material_id=material.material_id')
                    ->where($cond)
                    ->where('inbound.inbound_location', @session()->get('warehouse_id'))
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->orderBy('inbound.inbound_rcv_date', 'DESC')
                    ->get();
            }
        } else {
            if(session()->get('warehouse_id') == 'POSLOG'){
                $query = $this->db->table($this->inbound)
                        ->select('inbound.`inbound_id`
                                    , inbound.`inbound_rcv_date`
                                    , inbound.`inbound_location`
                                    , warehouse.`wh_name`
                                    , inbound_detail.`material_detail_id`
                                    , material.`material_name`
                                    , inbound_detail.`qty_realization`
                                    , purchase_order.`supplier_id`')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                        ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                        ->join('material_detail', 'inbound_detail.material_detail_id=material_detail.mat_detail_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->limit($limit, $start)
                        ->orderBy($col, $dir)
                        ->orderBy('inbound.inbound_rcv_date', 'DESC')
                        ->get();
            } else {
                $query = $this->db->table($this->inbound)
                        ->select('inbound.`inbound_id`
                                    , inbound.`inbound_rcv_date`
                                    , inbound.`inbound_location`
                                    , warehouse.`wh_name`
                                    , inbound_detail.`material_detail_id`
                                    , material.`material_name`
                                    , inbound_detail.`qty_realization`
                                    , purchase_order.`supplier_id`')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                        ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                        ->join('material_detail', 'inbound_detail.material_detail_id=material_detail.mat_detail_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('inbound.inbound_location', @session()->get('warehouse_id'))
                        ->limit($limit, $start)
                        ->orderBy($col, $dir)
                        ->orderBy('inbound.inbound_rcv_date', 'DESC')
                        ->get();
            }
        }
        
        return $query->getResult();
    }

    public function all_laporan_in_count($start_date, $end_date, $wh){
        $filter_date_range = null;
        $filter_wh = null;
        if($start_date != null && $end_date != null) {
            $filter_date_range = " AND (inbound_doc_date BETWEEN '$start_date' AND '$end_date')";
        }

        if(@$wh){
            $filter_wh = " AND inbound.inbound_location='$wh'";
        }
        
        $cond = "inbound.inbound_id != '' $filter_date_range $filter_wh";
        if($filter_date_range != null || $filter_wh != null){
            if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->inbound)
                    ->select('inbound.`inbound_id`
                        , inbound.`inbound_rcv_date`
                        , inbound.`inbound_location`
                        , warehouse.`wh_name`
                        , inbound_detail.`material_detail_id`
                        , material.`material_name`
                        , inbound_detail.`qty_realization`
                        , purchase_order.`supplier_id`')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('material_detail', 'inbound_detail.material_detail_id=material_detail.mat_detail_id')
                    ->join('material', 'material_detail.material_id=material.material_id')
                    ->where($cond);
            } else {
            $query = $this->db->table($this->inbound)
                    ->select('inbound.`inbound_id`
                        , inbound.`inbound_rcv_date`
                        , inbound.`inbound_location`
                        , warehouse.`wh_name`
                        , inbound_detail.`material_detail_id`
                        , material.`material_name`
                        , inbound_detail.`qty_realization`
                        , purchase_order.`supplier_id`')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('material_detail', 'inbound_detail.material_detail_id=material_detail.mat_detail_id')
                    ->join('material', 'material_detail.material_id=material.material_id')
                    ->where($cond)
                    ->where('inbound.inbound_location', @session()->get('warehouse_id'));
            }
        } else {
            if(session()->get('warehouse_id') == 'POSLOG'){
                $query = $this->db->table($this->inbound)
                        ->select('inbound.`inbound_id`
                            , inbound.`inbound_rcv_date`
                            , inbound.`inbound_location`
                            , warehouse.`wh_name`
                            , inbound_detail.`material_detail_id`
                            , material.`material_name`
                            , inbound_detail.`qty_realization`
                            , purchase_order.`supplier_id`')
                            ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                        ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                        ->join('material_detail', 'inbound_detail.material_detail_id=material_detail.mat_detail_id')
                        ->join('material', 'material_detail.material_id=material.material_id');
            } else {
                $query = $this->db->table($this->inbound)
                        ->select('inbound.`inbound_id`
                            , inbound.`inbound_rcv_date`
                            , inbound.`inbound_location`
                            , warehouse.`wh_name`
                            , inbound_detail.`material_detail_id`
                            , material.`material_name`
                            , inbound_detail.`qty_realization`
                            , purchase_order.`supplier_id`')
                            ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                        ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                        ->join('material_detail', 'inbound_detail.material_detail_id=material_detail.mat_detail_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('inbound.inbound_location', @session()->get('warehouse_id'));
            }
        }
        return $query->countAllResults();
    }

    public function search_laporan_in($limit, $start, $search, $col, $dir){
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->inbound)
                        ->select('inbound.`inbound_id`
                        , inbound.`inbound_rcv_date`
                        , inbound.`inbound_location`
                        , warehouse.`wh_name`
                        , inbound_detail.`material_detail_id`
                        , material.`material_name`
                        , inbound_detail.`qty_realization`
                        , purchase_order.`supplier_id`')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('material_detail', 'inbound_detail.material_detail_id=material_detail.mat_detail_id')
                    ->join('material', 'material_detail.material_id=material.material_id')
                    ->like('warehouse.`wh_name`', $search)
                    ->orLike('inbound.inbound_location', $search)
                    ->orLike('material_detail.material_id', $search)
                    ->orLike('material.material_name', $search)
                    ->orLike('supplier.`supplier_name`', $search)
                    ->orLike('inbound_detail.`qty_realization`', $search)
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        } else {
            $query = $this->db->table($this->inbound)
                    ->select('inbound.`inbound_id`
                    , inbound.`inbound_rcv_date`
                    , inbound.`inbound_location`
                    , warehouse.`wh_name`
                    , inbound_detail.`material_detail_id`
                    , material.`material_name`
                    , inbound_detail.`qty_realization`
                    , purchase_order.`supplier_id`')
                    ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->join('material_detail', 'inbound_detail.material_detail_id=material_detail.mat_detail_id')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->where('inbound.inbound_location', @session()->get('warehouse_id'))
                ->groupStart()
                    ->like('warehouse.`wh_name`', $search)
                    ->orLike('material_detail.material_id', $search)
                    ->orLike('material.material_name', $search)
                    ->orLike('supplier.`supplier_name`', $search)
                    ->orLike('inbound_detail.`qty_realization`', $search)
                ->groupEnd()
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
            return $query->getResult();
        }
        
    }
    
    public function search_laporan_in_count($search){
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->inbound)
                        ->select('inbound.`inbound_id`
                        , inbound.`inbound_rcv_date`
                        , inbound.`inbound_location`
                        , warehouse.`wh_name`
                        , inbound_detail.`material_detail_id`
                        , material.`material_name`
                        , inbound_detail.`qty_realization`
                        , purchase_order.`supplier_id`')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('material_detail', 'inbound_detail.material_detail_id=material_detail.mat_detail_id')
                    ->join('material', 'material_detail.material_id=material.material_id')
                    ->selectCount('inbound_detail.det_inbound_id', 'total')
                    ->like('warehouse.`wh_name`', $search)
                    ->orLike('inbound.inbound_location', $search)
                    ->orLike('material_detail.material_id', $search)
                    ->orLike('material.material_name', $search)
                    ->orLike('supplier.`supplier_name`', $search)
                    ->orLike('inbound_detail.`qty_realization`', $search)
                    ->get();
            return $query->getRow()->total;
        } else {
            $query = $this->db->table($this->inbound)
                        ->select('inbound.`inbound_id`
                        , inbound.`inbound_rcv_date`
                        , inbound.`inbound_location`
                        , warehouse.`wh_name`
                        , inbound_detail.`material_detail_id`
                        , material.`material_name`
                        , inbound_detail.`qty_realization`
                        , purchase_order.`supplier_id`')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('material_detail', 'inbound_detail.material_detail_id=material_detail.mat_detail_id')
                    ->join('material', 'material_detail.material_id=material.material_id')
                    ->selectCount('inbound_detail.det_inbound_id', 'total')
                    ->where('inbound.inbound_location', @session()->get('warehouse_id'))
                    ->groupStart()
                        ->like('warehouse.`wh_name`', $search)
                        ->orLike('material_detail.material_id', $search)
                        ->orLike('material.material_name', $search)
                        ->orLike('supplier.`supplier_name`', $search)
                        ->orLike('inbound_detail.`qty_realization`', $search)
                    ->groupEnd()
                    ->get();
            return $query->getRow()->total;
        }
    }
}
?>