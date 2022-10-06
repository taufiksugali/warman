<?php namespace App\Models;

use CodeIgniter\Model;

class InboundModel extends Model
{
    protected $table = "inbound";
    protected $primaryKey = 'inbound_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(inbound_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(inbound_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "INB".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    // Serverside
    public function all_inbound($limit, $start, $col, $dir)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->select('inbound.status, inbound.inbound_id, inbound.create_date, warehouse.wh_name, purchase_order.due_date')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                    ->where('inbound.status', 1)
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        } else {
            $query = $this->db->table($this->table)
                    ->select('inbound.status, inbound.inbound_id, inbound.create_date, warehouse.wh_name, purchase_order.due_date')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                    ->where('inbound.status', 1)
                    ->where('inbound.inbound_location', @session()->get('warehouse_id'))
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        }
    }

    public function all_inbound_count()
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->select('inbound.status, inbound.inbound_id, inbound.create_date, warehouse.wh_name, purchase_order.due_date')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                    ->where('inbound.status', 1);
            return $query->countAllResults();
        } else {
            $query = $this->db->table($this->table)
                    ->select('inbound.status, inbound.inbound_id, inbound.create_date, warehouse.wh_name, purchase_order.due_date')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                    ->where('inbound.status', 1)
                    ->where('inbound.inbound_location', @session()->get('warehouse_id'));
            return $query->countAllResults();
        }
    }

    public function search_inbound($limit, $start, $search, $col, $dir)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->select('inbound.status, inbound.inbound_id, inbound.create_date, warehouse.wh_name, purchase_order.due_date')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                    ->where('inbound.status', 1)
                    ->groupStart()
                        ->like('warehouse.wh_name', $search)
                        ->orLike('trans_type.trans_type_id', $search)
                        ->orLike('inbound.inbound_doc_date', $search)
                        ->orLike('inbound.inbound_rcv_date', $search)
                        ->orLike('inbound.inbound_rcv_by', $search)
                        ->orLike('inbound.create_date', $search)
                    ->groupEnd()
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        } else {
            $query = $this->db->table($this->table)
                    ->select('inbound.status, inbound.inbound_id, inbound.create_date, warehouse.wh_name, purchase_order.due_date')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                    ->where('inbound.status', 1)
                    ->where('inbound.inbound_location', @session()->get('warehouse_id'))
                    ->groupStart()
                        ->like('warehouse.wh_name', $search)
                        ->orLike('trans_type.trans_type_id', $search)
                        ->orLike('inbound.inbound_doc_date', $search)
                        ->orLike('inbound.inbound_rcv_date', $search)
                        ->orLike('inbound.inbound_rcv_by', $search)
                        ->orLike('inbound.create_date', $search)
                    ->groupEnd()
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
                    return $query->getResult();
                }
            }
            
    public function search_inbound_count($search)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                ->selectCount($this->primaryKey, 'total')
                ->select('inbound.status, inbound.inbound_id, inbound.create_date, warehouse.wh_name, purchase_order.due_date')
                ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                ->where('inbound.status', 1)
                ->groupStart()
                    ->like('warehouse.wh_name', $search)
                    ->orLike('trans_type.trans_type_id', $search)
                    ->orLike('inbound.inbound_doc_date', $search)
                    ->orLike('inbound.inbound_rcv_date', $search)
                    ->orLike('inbound.inbound_rcv_by', $search)
                    ->orLike('inbound.create_date', $search)
                ->groupEnd()
                ->get();
            return $query->getRow()->total;
        } else {
            $query = $this->db->table($this->table)
                ->selectCount($this->primaryKey, 'total')
                ->select('inbound.status, inbound.inbound_id, inbound.create_date, warehouse.wh_name, purchase_order.due_date')
                ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                ->where('inbound.status', 1)
                ->where('inbound.inbound_location', @session()->get('warehouse_id'))
                ->groupStart()
                    ->like('warehouse.wh_name', $search)
                    ->orLike('trans_type.trans_type_id', $search)
                    ->orLike('inbound.inbound_doc_date', $search)
                    ->orLike('inbound.inbound_rcv_date', $search)
                    ->orLike('inbound.inbound_rcv_by', $search)
                    ->orLike('inbound.create_date', $search)
                ->groupEnd()
                ->get();
            return $query->getRow()->total;
        }
    }
    // End Serverside

    // Serverside for inbound history
    public function all_inbound_bystatus($limit, $start, $col, $dir, $status, $status1)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->select('inbound.status, inbound.inbound_id, inbound.create_date, warehouse.wh_name, purchase_order.due_date')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                    ->where('inbound.status', $status)
                    ->orWhere('inbound.status', $status1)
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        } else {
            $query = $this->db->table($this->table)
                    ->select('inbound.status, inbound.inbound_id, inbound.create_date, warehouse.wh_name, purchase_order.due_date')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                    ->where('inbound.inbound_location', @session()->get('warehouse_id'))
                    ->groupStart()
                        ->where('inbound.status', $status)
                        ->orWhere('inbound.status', $status1)
                    ->groupEnd()
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        }
    }

    public function all_inbound_count_bystatus($status, $status1)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->select('inbound.status, inbound.inbound_id, inbound.create_date, warehouse.wh_name, purchase_order.due_date')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                    ->where('inbound.status', $status)
                    ->orWhere('inbound.status', $status1);
            return $query->countAllResults();
        } else {
            $query = $this->db->table($this->table)
                    ->select('inbound.status, inbound.inbound_id, inbound.create_date, warehouse.wh_name, purchase_order.due_date')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                    ->where('inbound.inbound_location', @session()->get('warehouse_id'))
                    ->groupStart()
                        ->where('inbound.status', $status)
                        ->orWhere('inbound.status', $status1)
                    ->groupEnd();
            return $query->countAllResults();
        }
    }

    public function search_inbound_bystatus($limit, $start, $search, $col, $dir, $status, $status1)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->select('inbound.status, inbound.inbound_id, inbound.create_date, warehouse.wh_name, purchase_order.due_date')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                    ->where('inbound.status', $status)
                    ->orWhere('inbound.status', $status1)
                    ->groupStart()
                        ->like('warehouse.wh_name', $search)
                        ->orLike('trans_type.trans_type_id', $search)
                        ->orLike('inbound.inbound_id', $search)
                        ->orLike('inbound.inbound_doc_date', $search)
                        ->orLike('inbound.inbound_rcv_date', $search)
                        ->orLike('inbound.inbound_rcv_by', $search)
                        ->orLike('inbound.create_date', $search)
                    ->groupEnd()
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        } else {
            $query = $this->db->table($this->table)
                    ->select('inbound.status, inbound.inbound_id, inbound.create_date, warehouse.wh_name, purchase_order.due_date')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                    ->where('inbound.inbound_location', @session()->get('warehouse_id'))
                    ->groupStart()
                        ->where('inbound.status', $status)
                        ->orWhere('inbound.status', $status1)
                    ->groupEnd()
                    ->groupStart()
                        ->like('warehouse.wh_name', $search)
                        ->orLike('trans_type.trans_type_id', $search)
                        ->orLike('inbound.inbound_id', $search)
                        ->orLike('inbound.inbound_doc_date', $search)
                        ->orLike('inbound.inbound_rcv_date', $search)
                        ->orLike('inbound.inbound_rcv_by', $search)
                        ->orLike('inbound.create_date', $search)
                    ->groupEnd()
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            return $query->getResult();
        }
    }

    public function search_inbound_count_bystatus($search, $status, $status1)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
            $query = $this->db->table($this->table)
                    ->selectCount($this->primaryKey, 'total')
                    ->select('inbound.status, inbound.inbound_id, inbound.create_date, warehouse.wh_name, purchase_order.due_date')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                    ->where('inbound.status', $status)
                    ->orWhere('inbound.status', $status1)
                    ->groupStart()
                        ->like('warehouse.wh_name', $search)
                        ->orLike('trans_type.trans_type_id', $search)
                        ->orLike('inbound.inbound_id', $search)
                        ->orLike('inbound.inbound_doc_date', $search)
                        ->orLike('inbound.inbound_rcv_date', $search)
                        ->orLike('inbound.inbound_rcv_by', $search)
                        ->orLike('inbound.create_date', $search)
                    ->groupEnd()
                    ->get();
            return $query->getRow()->total;
        } else {
            $query = $this->db->table($this->table)
                    ->selectCount($this->primaryKey, 'total')
                    ->select('inbound.status, inbound.inbound_id, inbound.create_date, warehouse.wh_name, purchase_order.due_date')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                    ->where('inbound.inbound_location', @session()->get('warehouse_id'))
                    ->groupStart()
                        ->where('inbound.status', $status)
                        ->orWhere('inbound.status', $status1)
                    ->groupEnd()
                    ->groupStart()
                        ->like('warehouse.wh_name', $search)
                        ->orLike('trans_type.trans_type_id', $search)
                        ->orLike('inbound.inbound_id', $search)
                        ->orLike('inbound.inbound_doc_date', $search)
                        ->orLike('inbound.inbound_rcv_date', $search)
                        ->orLike('inbound.inbound_rcv_by', $search)
                        ->orLike('inbound.create_date', $search)
                    ->groupEnd()
                    ->get();
            return $query->getRow()->total;
        }
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
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_inbound_detail($id){
        $query = $this->db->table('inbound_detail')
                ->join('po_detail', 'inbound_detail.po_detail_id=po_detail.po_detail_id')
                ->join('material', 'po_detail.material_id=material.material_id')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->join('material_detail','inbound_detail.material_detail_id=material_detail.mat_detail_id')
                ->where('inbound_detail.inbound_id', $id)   
                ->get();
        return $query->getResult();
    }

    public function get_inbound_byid($id){
        $query = $this->db->table($this->table)
                ->select('inbound.status
                , inbound.inbound_id
                , inbound.create_date
                , inbound.inbound_doc
                , inbound.inbound_po
                , inbound.inbound_doc_date
                , inbound.description
                , trans_type.trans_type_name
                , warehouse.wh_name
                , purchase_order.due_date
                , inbound.inbound_lic_plate
                , inbound.inbound_driver
                , inbound.inbound_rcv_by')
                ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->join('trans_type', 'inbound.inbound_type=trans_type.trans_type_id')
                ->where('inbound.inbound_id', $id)
                ->limit(1)
                ->get();
        return $query->getRow();        
    }

    public function print_history($cond){
        $query = $this->db->query("
            SELECT 
                ib.`inbound_id` AS nomor
                ,ib.`inbound_lic_plate` AS nopol
                ,ib.`inbound_driver` AS driver
                ,ib.`inbound_transpoter` AS transpoter
                ,ib.`inbound_shipment_number` AS shipment
                ,ow.`owners_name` AS pengirim
                ,wh.`wh_name` AS penerima
                ,wh.`wh_address` AS address
                ,ib.`inbound_rcv_date` AS tanggal
            FROM inbound ib 
            JOIN `purchase_order` po ON ib.`inbound_po` = po.`po_id`
            JOIN `owners` ow ON po.`owners_id` = ow.`owners_id`
            JOIN warehouse wh ON ib.`inbound_location` = wh.`warehouse_id`
            $cond");
        return $query->getRow();
    }

    public function print_history_detail($cond){
        $query = $this->db->query("
            SELECT 
                m.`material_name` AS nama_produk
                , ibd.`qty_realization` AS total_masuk
                , ibd.`qty_good_in` AS good
                , ibd.`qty_notgood_in` AS ng
                , m.`material_weight`
                , ibd.material_detail_id
                , md.mat_detail_id
                , md.batch_no
                , md.expired_date
                , ibd.`po_detail_id`
                , ml.shelf_id
            FROM inbound_detail ibd
            JOIN po_detail pod ON ibd.`po_detail_id` = pod.`po_detail_id`
            JOIN material m ON pod.`material_id` = m.`material_id`
            JOIN material_detail md ON md.mat_detail_id=ibd.material_detail_id
            JOIN material_location ml ON ml.material_detail_id=md.mat_detail_id
            $cond");
        return $query->getResult();
    }

    public function print_inbound_detail($cond){
        $query = $this->db->query("
            SELECT 
                m.`material_name` AS nama_produk
                , pod.`qty` AS total_masuk
                , ibd.`qty_good_in` AS good
                , ibd.`qty_notgood_in` AS ng
                , m.`material_weight`
            FROM inbound_detail ibd 
            JOIN po_detail pod ON ibd.`po_detail_id` = pod.`po_detail_id`
            JOIN material m ON pod.`material_id` = m.`material_id`
            $cond");
        return $query->getResult();
    }

    public function get_shelf_byid($id)
    {
        $query = $this->db->table('shelf')
        ->select('shelf.shelf_name, rak.rak_name, area_blok.blok_name, wh_area.wh_area_name, warehouse.wh_name')
                ->join('rak', 'shelf.rak_id=rak.rak_id')
                ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                ->join('warehouse', 'wh_area.wh_id=warehouse.warehouse_id')
                ->where('shelf.shelf_id', $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }
}
?>