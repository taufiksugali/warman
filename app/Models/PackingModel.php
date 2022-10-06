<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\MaterialDetailModel;
use App\Models\OutboundpoModel;
use App\Models\ResourceController;
use App\Models\PackagingMaterialModel;
use App\Models\OutboundModel;
use App\Models\BillModel;
use App\Models\OutboundDetailModel;
use App\Models\MaterialSohModel;
use App\Models\LocationModel;
use App\Models\SohTotalModel;
use App\Models\ShelfModel;

class PackingModel extends Model
{
    protected $table = "outbound";
    protected $primaryKey = 'outbound_id';

    public function __construct()
    {
        parent::__construct();
        $this->material_detail = new MaterialDetailModel();
        $this->outboundpo = new OutboundpoModel();
        $this->pm = new PackagingMaterialModel();
        $this->outbound = new OutboundModel();
        $this->bill = new BillModel();
        $this->outbound_detail = new OutboundDetailModel();
        $this->material_soh = new MaterialSohModel();
        $this->location = new LocationModel();
        $this->soh = new SohTotalModel();
        $this->shelf = new ShelfModel();
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
                        ->where('po_outbound.picking_done IS NOT NULL')
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
                        ->where('po_outbound.picking_done IS NOT NULL')
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
                        ->where('po_outbound.picking_done IS NOT NULL')
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
                        ->where('po_outbound.picking_done IS NOT NULL')
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
                        ->where('po_outbound.picking_done IS NOT NULL')
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
                        ->where('po_outbound.picking_done IS NOT NULL')
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
                        ->where('po_outbound.picking_done IS NOT NULL')
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
                        ->where('po_outbound.picking_done IS NOT NULL')
                        ->where('po_outbound.po_out_status', $status)
                        ->where('po_outbound.warehouse_id', @session()->get('warehouse_id'))
                        ->get();
                return $query->getRow()->total;
        }
    }

    public function getPickingNo ($key="") {
        $query = $this->db->table('po_outbound')
        ->select('po_outbound.po_outbound_id')
        ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
        ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
        ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
        ->where('po_outbound.picking_done IS NOT NULL')
        ->where('po_outbound.po_outbound_id', $key)
        ->where('po_outbound.warehouse_id', @session()->get('warehouse_id'))
        ->get();
        return $query->getRow();
    }

    public function get_outbound_byid_after_picking($id){
        $query = $this->db->table('po_outbound')
                ->select('`po_outbound`.`po_outbound_id`
                , `po_outbound`.`po_outbound_type`
                , `po_outbound`.`po_penerima`
                , `customer`.`customer_name`
                , `customer`.`customer_phone`
                , `customer`.`customer_email`
                , `customer`.`customer_address`
                , `po_outbound`.`po_outbound_doc`
                , `po_outbound`.`po_outbound_doc_date`
                , `po_outbound`.`po_create_date`
                , `po_outbound`.`warehouse_id`
                , `warehouse`.`wh_name`
                , `warehouse`.`wh_address`
                , `po_outbound`.`po_out_status`
                , `po_outbound`.`picking_status`
                , `po_outbound`.`picking_done`
                , `po_outbound`.`po_out_date`
                , `po_outbound`.`po_create_by`
                , `po_outbound`.`po_description`
                , `po_outbound`.`owners_id`
                , `po_outbound`.`transporter_id`
                , `po_outbound`.`transporter_marketplace`
                , `po_outbound`.`po_resi_number`
                , `po_outbound`.`use_box`
                , `transporter`.`transporter_link`
                , `transporter`.`transporter_alias`
                , `owners`.`owners_name`
                , `owners`.`owners_address`
                , `owners`.`owners_balance`
                , `trans_type`.`trans_type_name`')
                ->join('customer', 'po_outbound.po_penerima = customer.customer_id')
                ->join('owners', 'po_outbound.owners_id = owners.owners_id')
                ->join('transporter', 'po_outbound.transporter_id = transporter.transporter_id', 'left')
                ->join('warehouse', 'po_outbound.warehouse_id = warehouse.warehouse_id')
                ->join('trans_type', 'po_outbound.po_outbound_type = trans_type.trans_type_id')
                ->where('po_outbound.picking_status','2')
                ->where('po_outbound.picking_done is not null')
                ->where('po_outbound.po_outbound_id', $id)
                ->limit(1)
                ->get();
        return $query->getRow();        
    }

    public function getProductItem ($poid="", $key="") {
        $data['items'] = array();
        $data['incomplete_results'] = false;
        $data['total_count'] = 0;

        $filter = "m.material_id is not null";
        if ($key != "???") {
            $filter = "(m.material_code like '%".$key."%' OR m.material_name like '%".$key."%' OR m.barcode like '%".$key."%' )";
        }

        $query = $this->db->table('picking_detail pd')
                    ->select('m.material_id as id,
                                m.material_code,
                                m.material_name,
                                IFNULL(m.barcode,"") AS barcode,
                                uom.uom_name,
                                pd.qty_request')
                    ->join('material m ', 'm.material_id=pd.material_id')
                    ->join('uom', 'uom.uom_id=m.mat_uom')
                    ->where('pd.po_outbound_id', $poid)
                    ->where($filter)
                    ->groupBy('m.material_id')
                    ->get();
                $total = $query->getNumRows();
        if($total > 0){
            $data['items'] = $query->getResult();
            $data['total_count'] = $total;
        }

        return $data;  
    }

    public function getProductByBarcode ($poid="", $key="") {
        $query = $this->db->table('picking_detail pd')
                        ->select('m.material_id as id,
                                m.material_code,
                                m.material_name,
                                IFNULL(m.barcode,"") AS barcode,
                                uom.uom_name,
                                pd.qty_request')
                        ->join('material m ', 'm.material_id=pd.material_id')
                        ->join('uom', 'uom.uom_id=m.mat_uom')
                        ->where('pd.po_outbound_id', $poid)
                        ->where('m.barcode', strval($key))
                        ->groupBy('m.material_id')
                        ->get();
        $total = $query->getNumRows();
        if ($total<=0) {
            $query = $this->db->table('picking_detail pd')
                        ->select('m.material_id as id,
                                m.material_code,
                                m.material_name,
                                IFNULL(m.barcode,"") AS barcode,
                                uom.uom_name,
                                pd.qty_request')
                        ->join('material m ', 'm.material_id=pd.material_id')
                        ->join('uom', 'uom.uom_id=m.mat_uom')
                        ->where('pd.po_outbound_id', $poid)
                        ->where('pd.material_detail_id', strval($key))
                        ->groupBy('m.material_id')
                        ->get();  
        }
        return $query->getRow();
    }

    public function getDetailPickingByPO($po_id="") {
        $query = $this->db->table('picking_detail')
        ->where('po_outbound_id', $po_id)
        ->get();
        return $query->getResult();
    }

    public function save_data($param,$po_id=''){
        try {
            $this->db->transBegin();
            // ==================================================
            $outboundpo = $this->get_outbound_byid_after_picking($po_id);
            // data insert outbound
            $id = $this->outbound->generate_id();
            $data_outbound = [
                'outbound_id'       => $id,
                'po_outbound_id'    => $outboundpo->po_outbound_id,
                // 'outbound_doc_date' => date_format(date_create($this->request->getPost('doc_date')), 'Y-m-d'),
                'out_date'          => $outboundpo->po_out_date,
                // 'outbound_doc' => $this->request->getPost('doc_number'),
                'description'       => trim($param["description"]),
                'penerima'          => $outboundpo->po_penerima,
                'outbound_wh_asal'  => $outboundpo->warehouse_id,
                'outbound_type'     => 'TY003',
                'status'            => 2,
                'create_date'       => date('Y-m-d H:i:s'),
                'create_by'         => session()->get('fullname')
            ];
            $this->outbound->insert_data($data_outbound);

            // update status PO
            $data_po = [
                'po_out_status' => 2
            ];
            $this->outboundpo->update_data($outboundpo->po_outbound_id, $data_po);

            // insert bull biayay packing default standard
            $packing_cost = 0;
            $outbound_package = $this->pm->get_outbound_package($outboundpo->po_outbound_id);
            foreach($outbound_package as $op){
                $packing_cost = $packing_cost + $op->pm_cost;
            }
            if ($param["custom_fee"]==1) $packing_cost = $param["packing_fee"];

            $bill_id = $this->bill->generate_id();
            $data_bill = [
                'bill_id'       => $bill_id,
                'ref_id'        => $id,
                'po_id'         => $outboundpo->po_outbound_id,
                'owners_id'     => $outboundpo->owners_id,
                'description'   => 'BIAYA PACKING',
                'amount'        => $packing_cost,
                'created_date'  => date('Y-m-d H:i:s'),
                'bill_status'   => 0
            ];
            $this->bill->insert_data($data_bill);

            // detail outbound
            $detailPicking = $this->getDetailPickingByPO($outboundpo->po_outbound_id);
            foreach ($detailPicking as $key => $value) {
                // Insert outbound detail
                $detil_id = $this->outbound_detail->generate_id();
                $data_outbound_detail = [
                    'det_outbound_id'   => $detil_id,
                    'outbound_id'       => $data_outbound['outbound_id'],
                    'material_detail_id'=> $value->material_detail_id,
                    'outbound_qty'      => $value->qty,
                    'qty_realization'   => $value->qty,
                    'location_id'       => $value->location_id,
                    'status' => 2
                ];
                $this->outbound_detail->insert_data($data_outbound_detail);

                // update warehouse_soh
                $current_stock = $this->material_soh->get_currrent_stock($value->material_detail_id)->stock_ok; 
                $new_stock = $current_stock - $data_outbound_detail['qty_realization'];
                $mat_soh = [
                    'stock_ok' => $new_stock,
                    'status' => 1
                ];
                $this->material_soh->update_byid($value->material_detail_id, $mat_soh);

                // update stok by location material_location
                $current_qty = $this->location->get_location_byid($value->location_id)->qty;
                $new_qty = $current_qty - $data_outbound_detail['qty_realization'];
                $mat_location = [
                    'qty' => $new_qty
                ];
                $this->location->update_data($value->location_id, $mat_location);

                // update storage
                $sataShelf      = $this->location->check_material_detail_on_shelfv2($value->location_id);
                $shelf_avail    = $sataShelf->shelf_availability;
                $shelf_id       = $sataShelf->shelf_id;
                $cur_avail      = $shelf_avail + $data_outbound_detail['qty_realization'];
                
                $data_shelf_tujuan = [
                    'shelf_availability' => $cur_avail
                ];
                $this->shelf->update_data($shelf_id, $data_shelf_tujuan);

                // update soh_total
                $warehouse_id   = $outboundpo->warehouse_id;
                $owner_id       = $outboundpo->owners_id;
                $material_id    = $value->material_id;
                $data_soh = $this->soh->get_stock_good_v2($warehouse_id, $owner_id, $material_id);
                $qty_out = $data_outbound_detail['qty_realization'];
                foreach ($data_soh as $key_soh => $val_soh) {
                    if ($qty_out>0) {
                        if ($qty_out>$val_soh->stock_good_warehouse) {
                            $qty_out_row = $val_soh->stock_good_warehouse;
                            $soh_tot = [
                                'stock_good_seller' => $val_soh->stock_good_seller - $qty_out_row,
                                'stock_good_warehouse' => $val_soh->stock_good_warehouse - $qty_out_row
                            ];
                            $this->soh->update_data($val_soh->sot_id, $soh_tot);
                            $qty_out = $qty_out - $qty_out_row;
                        } else {
                            $qty_out_row = $qty_out;
                            $soh_tot = [
                                'stock_good_seller' => $val_soh->stock_good_seller - $qty_out_row,
                                'stock_good_warehouse' => $val_soh->stock_good_warehouse - $qty_out_row
                            ];
                            $this->soh->update_data($val_soh->sot_id, $soh_tot);
                            $qty_out = $qty_out - $qty_out_row;
                        }
                    }
                }
                
            }

            // insert bill admin fee default standard
            $outboundpo_id      = $outboundpo->po_outbound_id;
            $outboundpo_detail  = $this->outboundpo->get_outbound_detail($outboundpo_id);
            $outbound_charge    = 0;

            foreach($outboundpo_detail as $row_po){
                $outbound_qty = $row_po->outbound_qty;
                $material_price = $row_po->material_price;
                $charge_per_material = 0.035 * ($material_price * intVal($row_po->outbound_qty));
    
                $outbound_charge = $outbound_charge + $charge_per_material;
            }
            if ($param["custom_fee"]==1) $outbound_charge = $param["admin_fee"];

            $bill_id = $this->bill->generate_id();
            $data_bill = [
                'bill_id'       => $bill_id,
                'owners_id'     => $outboundpo->owners_id,
                'ref_id'        => $id,
                'po_id'         => $outboundpo_id,
                'description'   => 'ADMIN FEE',
                'amount'        => $outbound_charge,
                'created_date'  => date('Y-m-d H:i:s'),
                'bill_status'   => 0
            ];
            $this->bill->insert_data($data_bill);

            if ($param["custom_fee"]==1 && $param["custom_service_fee"]>=0) {
                $bill_id = $this->bill->generate_id();
                $data_bill = [
                    'bill_id'       => $bill_id,
                    'owners_id'     => $outboundpo->owners_id,
                    'ref_id'        => $id,
                    'po_id'         => $outboundpo_id,
                    'description'   => 'CUSTOM SERVICE FEE',
                    'amount'        => $param["custom_service_fee"],
                    'created_date'  => date('Y-m-d H:i:s'),
                    'bill_status'   => 0
                ];
                $this->bill->insert_data($data_bill);
            }
            // ==================================================
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

    public function getOutboundByPO($po_id="") {
        $query = $this->db->table('outbound')
                            ->where('po_outbound_id', $po_id)
                            ->get();
        return $query->getRow();
    }

}
?>