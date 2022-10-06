<?php namespace App\Models;

use CodeIgniter\Model;

class PurchaseOrderModel extends Model
{
    protected $table = "purchase_order";
    protected $primaryKey = 'po_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(po_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(po_id, 3, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "PO".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    // Serverside
    public function all_po($limit, $start, $col, $dir)
    {
        if(session()->get('user_type')==1){
            $query = $this->db->table($this->table)
                    ->where('owners_id', session()->get('owners_id'))
                    ->limit($limit, $start)
                    // ->orderBy('po_date', 'DESC')
                    ->orderBy($col, $dir)
                    ->get();
        } else {
            if(session()->get('warehouse_id') == 'POSLOG'){
                $query = $this->db->table($this->table)
                        ->where('po_status', 1)
                        ->limit($limit, $start)
                        ->orderBy($col, $dir)
                        ->get();
            } else {
                $query = $this->db->table($this->table)
                        ->where('po_status', 1)
                        ->where('warehouse_id', @session()->get('warehouse_id'))
                        ->limit($limit, $start)
                        ->orderBy($col, $dir)
                        ->get();
            }
        }
        return $query->getResult();
    }

    public function all_po_count()
    {
        if(session()->get('user_type')==1){
            $query = $this->db->table($this->table)
                    ->where('owners_id', session()->get('owners_id'));
        } else {
            if(session()->get('warehouse_id') == 'POSLOG'){
                $query = $this->db->table($this->table)
                        ->where('po_status', 1);
            } else {
                $query = $this->db->table($this->table)
                        ->where('po_status', 1)
                        ->where('warehouse_id', @session()->get('warehouse_id'));
            }
        }
        return $query->countAllResults();
    }

    public function search_po($limit, $start, $search, $col, $dir)
    {
        if(session()->get('user_type')==1){
            $query = $this->db->table($this->table)
                    ->where('owners_id', session()->get('owners_id'))
                    ->groupStart()
                        ->like('purchase_order.po_number', $search)
                        ->orLike('purchase_order.po_date', $search)
                        ->orLike('purchase_order.description', $search)
                    ->groupEnd()
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
        } else {
            if(session()->get('warehouse_id') == 'POSLOG'){
                $query = $this->db->table($this->table)
                        ->where('po_status', 1)
                        ->groupStart()
                            ->like('purchase_order.po_number', $search)
                            ->orLike('purchase_order.po_date', $search)
                            ->orLike('purchase_order.description', $search)
                        ->groupEnd()
                        ->limit($limit, $start)
                        ->orderBy($col, $dir)
                        ->get();
            } else {
                $query = $this->db->table($this->table)
                        ->where('po_status', 1)
                        ->where('warehouse_id', @session()->get('warehouse_id'))
                        ->groupStart()
                            ->like('purchase_order.po_number', $search)
                            ->orLike('purchase_order.po_date', $search)
                            ->orLike('purchase_order.description', $search)
                        ->groupEnd()
                        ->limit($limit, $start)
                        ->orderBy($col, $dir)
                        ->get();
            }
        }
        return $query->getResult();
    }

    public function search_po_count($search)
    {
        if(session()->get('user_type')==1){
            $query = $this->db->table($this->table)
                    ->selectCount($this->primaryKey, 'total')
                    ->where('owners_id', session()->get('owners_id'))
                    ->groupStart()
                        ->like('purchase_order.po_number', $search)
                        ->orLike('purchase_order.po_date', $search)
                        ->orLike('purchase_order.description', $search)
                    ->groupEnd()
                    ->get();
        } else {
            if(session()->get('warehouse_id') == 'POSLOG'){
                $query = $this->db->table($this->table)
                        ->selectCount($this->primaryKey, 'total')
                        ->where('po_status', 1)
                        ->groupStart()
                            ->like('purchase_order.po_number', $search)
                            ->orLike('purchase_order.po_date', $search)
                            ->orLike('purchase_order.description', $search)
                        ->groupEnd()
                        ->get();
            } else {
                $query = $this->db->table($this->table)
                        ->selectCount($this->primaryKey, 'total')
                        ->where('po_status', 1)
                        ->where('warehouse_id', @session()->get('warehouse_id'))
                        ->groupStart()
                            ->like('purchase_order.po_number', $search)
                            ->orLike('purchase_order.po_date', $search)
                            ->orLike('purchase_order.description', $search)
                        ->groupEnd()
                        ->get();
            }
        }
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

    public function get_po_byid($id)
    {
        $query = $this->db->table($this->table)
                ->join('warehouse', 'purchase_order.warehouse_id=warehouse.warehouse_id')
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_all_po(){
        $query = $this->db->table($this->table)
                ->join('owners', 'purchase_order.owners_id=owners.owners_id')
                ->join('warehouse', 'purchase_order.warehouse_id=warehouse.warehouse_id')
                ->where('po_status', 1)
                ->orWhere('po_status', 2)
                ->get();
        return $query->getResult();
    }

    public function get_po_detail($id){
        $query = $this->db->table('po_detail')
                ->join('material', 'po_detail.material_id=material.material_id')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->where('po_detail.po_id', $id)
                ->get();
        return $query->getResult();
    }

    public function getProductItem ($poid="", $key="") {
        $data['items'] = array();
        $data['incomplete_results'] = false;
        $data['total_count'] = 0;

        $filter = "material.material_id is not null";
        if ($key != "???") {
            $filter = "(material.material_code like '%".$key."%' OR material.material_name like '%".$key."%' OR material.barcode like '%".$key."%' )";
        }

        $query = $this->db->table('po_detail')
                    ->select('po_detail.`po_detail_id`, purchase_order.`po_number`
                    , purchase_order.`po_date`
                    , purchase_order.`owners_id`
                    , purchase_order.`qc_status`
                    , po_detail.`material_id`
                    , po_detail.`material_price`
                    , material.`material_id` AS id
                    , material.`material_name`
                    , material.`material_code`
                    , material.`material_weight`
                    , material.`material_length`
                    , material.`material_width`
                    , material.`material_height`
                    , IFNULL(material.barcode,"") AS barcode
                    , po_detail.`qty`
                    , uom.`uom_name`,
                    , purchase_order.due_date')
                    ->join('purchase_order', 'po_detail.`po_id`= purchase_order.`po_id`')
                    ->join('material', 'po_detail.material_id=material.material_id')
                    ->join('uom', 'material.mat_uom=uom.uom_id')
                    ->where('po_detail.po_id', $poid)
                    ->where($filter)
                    ->get();
                $total = $query->getNumRows();
        if($total > 0){
            $data['items'] = $query->getResult();
            $data['total_count'] = $total;
        }
        return $data;  
    }

    public function getProductByBarcode ($poid="", $key="") {
        $query = $this->db->table('po_detail')
                ->select('po_detail.`po_detail_id`, purchase_order.`po_number`
                    , purchase_order.`po_date`
                    , purchase_order.`owners_id`
                    , purchase_order.`qc_status`
                    , po_detail.`material_id`
                    , po_detail.`material_price`
                    , material.`material_name`
                    , material.`material_code`
                    , material.`material_weight`
                    , material.`material_length`
                    , material.`material_width`
                    , material.`material_height`
                    , IFNULL(material.barcode,"") AS barcode
                    , po_detail.`qty`
                    , uom.`uom_name`
                    , purchase_order.due_date')
                ->join('purchase_order', 'po_detail.`po_id`= purchase_order.`po_id`')
                ->join('material', 'po_detail.material_id=material.material_id')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->where('po_detail.po_id', $poid)
                ->where('material.barcode', strval($key))
                ->get();
        return $query->getRow();
    }

    public function get_purchase_order($po_id){
        $query = $this->db->table('po_detail')
                ->select('po_detail.`po_detail_id`, purchase_order.`po_number`
                , purchase_order.`po_date`
                , purchase_order.`owners_id`
                , purchase_order.`qc_status`
                , po_detail.`material_id`
                , po_detail.`material_price`
                , material.`material_code`
                , material.`material_name`
                , material.`material_weight`
                , material.`material_length`
                , material.`material_width`
                , material.`material_height`
                , po_detail.`qty`
                , uom.`uom_name`
                , purchase_order.due_date')
                ->join('purchase_order', 'po_detail.`po_id`= purchase_order.`po_id`')
                ->join('material', 'po_detail.material_id=material.material_id')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->where('po_detail.po_id', $po_id)
                ->where('po_detail.status', 1)
                ->get();
        return $query->getResult();
    }

    public function get_bill_byPo($id){
        $query = $this->db->table('owners_bill')
                ->where('ref_id', $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }
}
?>