<?php namespace App\Models;

use CodeIgniter\Model;

class PickingModel extends Model
{
    protected $table = "outbound";
    protected $primaryKey = 'outbound_id';

    public function __construct()
    {
        parent::__construct();
    }

    // Serverside PO
    public function all_po_outbound_bystatus($limit, $start, $col, $dir, $status)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
                $query = $this->db->table('po_outbound')
                        ->select('po_outbound.po_outbound_id
                                , po_outbound.po_outbound_doc
                                , po_outbound.po_out_status
                                , po_outbound.picking_status
                                , po_outbound.picking_done
                                , po_outbound.po_outbound_doc_date
                                , po_outbound.po_create_date
                                , customer.customer_name
                                , warehouse.wh_name
                                , po_outbound.transporter_id
                                , po_outbound.po_resi_number')
                        ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                        ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                        ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
                        ->where('po_outbound.picking_done IS NULL')
                        ->where('po_outbound.po_out_status', $status)
                        ->limit($limit, $start)
                        // ->orderBy('po_create_date', 'DESC')
                        ->orderBy($col, $dir)
                        ->get();
                return $query->getResult();
        } else {
                $query = $this->db->table('po_outbound')
                        ->select('po_outbound.po_outbound_id
                                , po_outbound.po_outbound_doc
                                , po_outbound.po_out_status
                                , po_outbound.picking_status
                                , po_outbound.picking_done
                                , po_outbound.po_outbound_doc_date
                                , po_outbound.po_create_date
                                , customer.customer_name
                                , warehouse.wh_name
                                , po_outbound.transporter_id
                                , po_outbound.po_resi_number')
                        ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                        ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                        ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
                        ->where('po_outbound.picking_done IS NULL')
                        ->where('po_outbound.po_out_status', $status)
                        ->where('po_outbound.warehouse_id', @session()->get('warehouse_id'))
                        ->limit($limit, $start)
                        // ->orderBy('po_create_date', 'DESC')
                        ->orderBy($col, $dir)
                        ->get();
                return $query->getResult();

        }
    }

    public function all_po_outbound_count_bystatus($status)
    {
        if(session()->get('warehouse_id') == 'POSLOG') {
                $query = $this->db->table('po_outbound')
                        ->select('po_outbound.po_outbound_id
                                , po_outbound.po_outbound_doc
                                , po_outbound.po_out_status
                                , po_outbound.po_outbound_doc_date
                                , po_outbound.po_create_date
                                , customer.customer_name
                                , warehouse.wh_name
                                , po_outbound.transporter_id
                                , po_outbound.po_resi_number')
                        ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                        ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                        ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
                        ->where('po_outbound.picking_done IS NULL')
                        ->where('po_outbound.po_out_status', $status);
                        return $query->countAllResults();
                        
        } else {
                $query = $this->db->table('po_outbound')
                        ->select('po_outbound.po_outbound_id
                                , po_outbound.po_outbound_doc
                                , po_outbound.po_out_status
                                , po_outbound.po_outbound_doc_date
                                , po_outbound.po_create_date
                                , customer.customer_name
                                , warehouse.wh_name
                                , po_outbound.transporter_id
                                , po_outbound.po_resi_number')
                        ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                        ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                        ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
                        ->where('po_outbound.picking_done IS NULL')
                        ->where('po_outbound.po_out_status', $status)
                        ->where('po_outbound.warehouse_id', @session()->get('warehouse_id'));
                        return $query->countAllResults();
        }
    }

    public function search_po_outbound_bystatus($limit, $start, $search, $col, $dir, $status)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
                $query = $this->db->table('po_outbound')
                        ->select('po_outbound.po_outbound_id
                                , po_outbound.po_outbound_doc
                                , po_outbound.po_out_status
                                , po_outbound.picking_status
                                , po_outbound.picking_done
                                , po_outbound.po_outbound_doc_date
                                , po_outbound.po_create_date
                                , customer.customer_name
                                , warehouse.wh_name
                                , po_outbound.transporter_id
                                , po_outbound.po_resi_number')
                        ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                        ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                        ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
                        ->groupStart()
                        ->like('customer.customer_name', $search)
                        ->orLike('po_outbound.po_outbound_id', $search)
                        ->orLike('warehouse.wh_name', $search)
                        ->orLike('trans_type.trans_type_name', $search)
                        ->orLike('po_outbound.po_outbound_doc', $search)
                        ->orLike('po_outbound.po_outbound_doc_date', $search)
                        ->orLike('po_outbound.po_create_date', $search)
                        ->groupEnd()
                        ->where('po_outbound.picking_done IS NULL')
                        ->where('po_outbound.po_out_status', $status)
                        ->limit($limit, $start)
                        ->orderBy('po_create_date', 'DESC')
                        ->orderBy($col, $dir)
                        ->get();
                return $query->getResult();
                
        } else {
                $query = $this->db->table('po_outbound')
                        ->select('po_outbound.po_outbound_id
                                , po_outbound.po_outbound_doc
                                , po_outbound.po_out_status
                                , po_outbound.picking_status
                                , po_outbound.picking_done
                                , po_outbound.po_outbound_doc_date
                                , po_outbound.po_create_date
                                , customer.customer_name
                                , warehouse.wh_name
                                , po_outbound.transporter_id
                                , po_outbound.po_resi_number')
                        ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                        ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                        ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
                        ->groupStart()
                                ->like('customer.customer_name', $search)
                                ->orLike('po_outbound.po_outbound_id', $search)
                                ->orLike('warehouse.wh_name', $search)
                                ->orLike('trans_type.trans_type_name', $search)
                                ->orLike('po_outbound.po_outbound_doc', $search)
                                ->orLike('po_outbound.po_outbound_doc_date', $search)
                                ->orLike('po_outbound.po_create_date', $search)
                        ->groupEnd()
                        ->where('po_outbound.picking_done IS NULL')
                        ->where('po_outbound.po_out_status', $status)
                        ->where('po_outbound.warehouse_id', @session()->get('warehouse_id'))
                        ->limit($limit, $start)
                        ->orderBy('po_create_date', 'DESC')
                        ->orderBy($col, $dir)
                        ->get();
                return $query->getResult();
        }
    }

    public function search_po_outbound_count_bystatus($search, $status)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
                $query = $this->db->table('po_outbound')
                        ->selectCount('po_outbound.po_outbound_id', 'total')
                        ->select('po_outbound.po_outbound_id
                                , po_outbound.po_outbound_doc
                                , po_outbound.po_out_status
                                , po_outbound.picking_status
                                , po_outbound.picking_done
                                , po_outbound.po_outbound_doc_date
                                , po_outbound.po_create_date
                                , customer.customer_name
                                , warehouse.wh_name
                                , po_outbound.transporter_id
                                , po_outbound.po_resi_number')
                        ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                        ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                        ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
                        ->groupStart()
                        ->like('customer.customer_name', $search)
                        ->orLike('po_outbound.po_outbound_id', $search)
                        ->orLike('warehouse.wh_name', $search)
                        ->orLike('trans_type.trans_type_name', $search)
                        ->orLike('po_outbound.po_outbound_doc', $search)
                        ->orLike('po_outbound.po_outbound_doc_date', $search)
                        ->orLike('po_outbound.po_create_date', $search)
                        ->groupEnd()
                        ->where('po_outbound.picking_done IS NULL')
                        ->where('po_outbound.po_out_status', $status)
                        ->get();
                return $query->getRow()->total;
        } else {
                $query = $this->db->table('po_outbound')
                        ->selectCount('po_outbound.po_outbound_id', 'total')
                        ->select('po_outbound.po_outbound_id
                                , po_outbound.po_outbound_doc
                                , po_outbound.po_out_status
                                , po_outbound.picking_status
                                , po_outbound.picking_done
                                , po_outbound.po_outbound_doc_date
                                , po_outbound.po_create_date
                                , customer.customer_name
                                , warehouse.wh_name
                                , po_outbound.transporter_id
                                , po_outbound.po_resi_number')
                        ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                        ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                        ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
                        ->groupStart()
                        ->like('customer.customer_name', $search)
                        ->orLike('po_outbound.po_outbound_id', $search)
                        ->orLike('warehouse.wh_name', $search)
                        ->orLike('trans_type.trans_type_name', $search)
                        ->orLike('po_outbound.po_outbound_doc', $search)
                        ->orLike('po_outbound.po_outbound_doc_date', $search)
                        ->orLike('po_outbound.po_create_date', $search)
                        ->groupEnd()
                        ->where('po_outbound.picking_done IS NULL')
                        ->where('po_outbound.po_out_status', $status)
                        ->where('po_outbound.warehouse_id', @session()->get('warehouse_id'))
                        ->get();
                return $query->getRow()->total;
        }
    }
    // End Serverside

    public function referensi_matrial_location($owner_id="", $whs_id="", $po_id="") {
        $sql = "SELECT 
                    m.material_id,
                    m.material_code,
                    m.material_name,
                    md.mat_detail_id,
                    md.expired_date,
                    md.batch_no,
                    ml.shelf_id,
                    ml.location_id,
                    shelf.shelf_name,
                    rak.rak_name,
                    area_blok.blok_name,
                    wh_area.wh_area_name,
                    (ml.qty - (
                        SELECT 
                        IFNULL(SUM(pd.qty),0)
                        FROM picking_detail pd
                        JOIN po_outbound poob ON poob.po_outbound_id=pd.po_outbound_id
                        WHERE pd.location_id=ml.location_id
                        AND pd.material_detail_id=ml.material_detail_id
                        AND pd.shelf_id=ml.shelf_id
                        AND poob.po_out_status='1'
                        AND pd.po_outbound_id NOT IN (pod.po_outbound_id))
                    ) as stock,
                    uom.uom_name,
                    pod.outbound_qty as qty_request,
                    pod.po_outbound_id,
                    pod.po_det_outbound_id
                FROM material_detail md
                JOIN material m ON md.material_id=m.material_id 
                JOIN material_location ml ON ml.material_detail_id=md.mat_detail_id 
                JOIN shelf ON ml.shelf_id=shelf.shelf_id 
                JOIN rak ON shelf.rak_id = rak.rak_id 
                JOIN area_blok ON rak.blok_id = area_blok.blok_id 
                JOIN wh_area ON area_blok.wh_area_id = wh_area.area_id 
                JOIN uom ON m.mat_uom=uom.uom_id
                JOIN po_out_detail pod ON pod.material_id=m.material_id
                WHERE md.owner_id = '".$owner_id."' 
                AND wh_area.wh_id = '".$whs_id."' 
                AND pod.po_outbound_id='".$po_id."'
                having stock >0
                ORDER BY m.material_name ASC, md.expired_date ASC, ml.create_date ASC
                ";
                
        $res = $this->db->query($sql);
        return $res->getResult();
    }

    public function get_data_detail_picking($owner_id="", $whs_id="", $po_id="") {
        $sql = "SELECT
                    m.material_id,
                    m.material_code,
                    m.material_name,
                    md.mat_detail_id,
                    md.expired_date,
                    md.batch_no,
                    pd.shelf_id,
                    pd.location_id,
                    shelf.shelf_name,
                    rak.rak_name,
                    area_blok.blok_name,
                    wh_area.wh_area_name,
                    (ml.qty - (
                        SELECT 
                        IFNULL(SUM(pd2.qty),0)
                        FROM picking_detail pd2
                        JOIN po_outbound poob ON poob.po_outbound_id=pd2.po_outbound_id
                        WHERE pd2.location_id=ml.location_id
                        AND pd2.material_detail_id=ml.material_detail_id
                        AND pd2.shelf_id=ml.shelf_id
                        AND poob.po_out_status='1'
                        AND pd2.po_outbound_id NOT IN (pd.po_outbound_id))
                    ) as stock,
                    uom.uom_name,
                    pd.qty_request,
                    pd.po_outbound_id,
                    pd.po_det_outbound_id,
                    pd.qty
                FROM picking_detail pd
                JOIN material_detail md ON md.mat_detail_id=pd.material_detail_id
                JOIN material m ON md.material_id=m.material_id 
                JOIN material_location ml ON ml.material_detail_id=pd.material_detail_id 
                JOIN shelf ON ml.shelf_id=shelf.shelf_id 
                JOIN rak ON shelf.rak_id = rak.rak_id 
                JOIN area_blok ON rak.blok_id = area_blok.blok_id 
                JOIN wh_area ON area_blok.wh_area_id = wh_area.area_id 
                JOIN uom ON m.mat_uom=uom.uom_id
                WHERE md.owner_id = '".$owner_id."' 
                AND wh_area.wh_id = '".$whs_id."' 
                AND pd.po_outbound_id='".$po_id."'
                GROUP BY pd.id
                having stock >0
                ";
        $res = $this->db->query($sql);
        return $res->getResult();
    }

    public function referensi_matrial_by_location($owner_id="", $whs_id="", $po_id="", $mat_detail_id="", $location_id="") {
        $sql = "SELECT 
                    m.material_id,
                    m.material_code,
                    m.material_name,
                    md.mat_detail_id,
                    md.expired_date,
                    md.batch_no,
                    ml.shelf_id,
                    ml.location_id,
                    shelf.shelf_name,
                    rak.rak_name,
                    area_blok.blok_name,
                    wh_area.wh_area_name,
                    (ml.qty - (
                        SELECT 
                        IFNULL(SUM(pd.qty),0)
                        FROM picking_detail pd
                        JOIN po_outbound poob ON poob.po_outbound_id=pd.po_outbound_id
                        WHERE pd.location_id=ml.location_id
                        AND pd.material_detail_id=ml.material_detail_id
                        AND pd.shelf_id=ml.shelf_id
                        AND poob.po_out_status='1'
                        AND pd.po_outbound_id NOT IN (pod.po_outbound_id))
                    ) as stock,
                    uom.uom_name,
                    pod.outbound_qty as qty_request,
                    pod.po_outbound_id,
                    pod.po_det_outbound_id
                FROM material_detail md
                JOIN material m ON md.material_id=m.material_id 
                JOIN material_location ml ON ml.material_detail_id=md.mat_detail_id 
                JOIN shelf ON ml.shelf_id=shelf.shelf_id 
                JOIN rak ON shelf.rak_id = rak.rak_id 
                JOIN area_blok ON rak.blok_id = area_blok.blok_id 
                JOIN wh_area ON area_blok.wh_area_id = wh_area.area_id 
                JOIN uom ON m.mat_uom=uom.uom_id
                JOIN po_out_detail pod ON pod.material_id=m.material_id
                WHERE md.owner_id = '".$owner_id."' 
                AND wh_area.wh_id = '".$whs_id."' 
                AND pod.po_outbound_id='".$po_id."'
                AND md.mat_detail_id='".$mat_detail_id."'
                AND ml.location_id='".$location_id."'
                having stock >0
                ORDER BY m.material_name ASC, md.expired_date ASC, ml.create_date ASC
                ";
        $res = $this->db->query($sql);
        return $res->getResult();
    }

    public function save_data($param=array(), $idEdit=''){
        try {
            $this->db->transBegin();

            $idMaster = $this->saveMaster($param, $idEdit);
            $this->saveDetail($param, $idMaster);

            $status = $this->db->transStatus();
            if ($status === FALSE) {
                $this->db->transRollback();
            }else {
                $this->db->transCommit();
            }
            return $status;
        }catch (Exceptions $e) {
            $this->db->transRollback();
            return false;
        }
    }

    private function saveMaster($param, $idEdit){
        $idMaster = $idEdit;
        $data = array(
                    'picking_status' => $param['picking_status'],
                );

        $this->db->table('po_outbound')->where('po_outbound_id',$idEdit)->update($data);
        return $idMaster;
    }

    private function saveDetail($param, $idMaster){
        $this->db->table('picking_detail')->where('po_outbound_id',$idMaster)->delete();
        for($i = 0; $i < sizeof($param['location_id']); $i++) {
            $data = array(
                        'po_outbound_id'    => $idMaster,
                        'po_det_outbound_id'=> trim($param['po_det_outbound_id'][$i]),
                        'location_id'       => trim($param['location_id'][$i]),
                        'material_id'       => trim($param['material_id'][$i]),
                        'material_detail_id'=> trim($param['mat_detail_id'][$i]),
                        'shelf_id'          => trim($param['shelf_id'][$i]),
                        'qty_request'       => intval($param['qty_request'][$i]),
                        'qty'               => intval($param['qty'][$i]),
                        'created_date'      => date('Y-m-d H:i:s'),
                        'created_by'        => session()->get('fullname')
                    );
            $this->db->table('picking_detail')->insert($data);
        }
    }

    public function complete_data($param=array(), $idEdit='') {
        $data = array(
                    'picking_status' => $param['picking_status'],
                    'picking_by' => session()->get('fullname'),
                    'picking_done' => date('Y-m-d H:i:s')
                );

        $status = $this->db->table('po_outbound')->where('po_outbound_id',$idEdit)->update($data);
        return $status;
    }
}
?>