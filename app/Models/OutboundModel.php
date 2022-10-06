<?php namespace App\Models;

use CodeIgniter\Model;

class OutboundModel extends Model
{
    protected $table = "outbound";
    protected $primaryKey = 'outbound_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(outbound_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(outbound_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "OTB".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    // Serverside
    public function all_outbound($limit, $start, $col, $dir)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
                $query = $this->db->table($this->table)
                        ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                        ->limit($limit, $start)
                        ->orderBy('out_date', 'DESC')
                        ->orderBy($col, $dir)
                        ->get();
                return $query->getResult();
        } else {
                $query = $this->db->table($this->table)
                        ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                        ->where('outbound.outbound_wh_asal', @session()->get('warehouse_id'))
                        ->limit($limit, $start)
                        ->orderBy('out_date', 'DESC')
                        ->orderBy($col, $dir)
                        ->get();
                return $query->getResult();
        }
    }

    public function all_outbound_count()
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
                $query = $this->db->table($this->table)
                        ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id');
                return $query->countAllResults();
        } else {
                $query = $this->db->table($this->table)
                        ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                        ->where('outbound.outbound_wh_asal', @session()->get('warehouse_id'));
                return $query->countAllResults();
        }
    }

    public function search_outbound($limit, $start, $search, $col, $dir)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
                $query = $this->db->table($this->table)
                        ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                        ->like('customer.customer_name', $search)
                        ->orLike('warehouse.wh_name', $search)
                        ->orLike('trans_type.trans_type_name', $search)
                        ->orLike('outbound.outbound_doc', $search)
                        ->orLike('outbound.outbound_doc_date', $search)
                        ->orLike('outbound.create_date', $search)
                        ->limit($limit, $start)
                        // ->orderBy('out_date', 'DESC')
                        ->orderBy($col, $dir)
                        ->get();
                return $query->getResult();
        } else {
                $query = $this->db->table($this->table)
                        ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                        ->where('outbound.outbound_wh_asal', @session()->get('warehouse_id'))
                        ->groupStart()
                                ->like('customer.customer_name', $search)
                                ->orLike('warehouse.wh_name', $search)
                                ->orLike('trans_type.trans_type_name', $search)
                                ->orLike('outbound.outbound_doc', $search)
                                ->orLike('outbound.outbound_doc_date', $search)
                                ->orLike('outbound.create_date', $search)
                        ->groupEnd()
                        ->limit($limit, $start)
                        // ->orderBy('out_date', 'DESC')
                        ->orderBy($col, $dir)
                        ->get();
                return $query->getResult();
        }
    }

    public function search_outbound_count($search)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
                $query = $this->db->table($this->table)
                        ->selectCount($this->primaryKey, 'total')
                        ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                        ->like('customer.customer_name', $search)
                        ->orLike('warehouse.wh_name', $search)
                        ->orLike('trans_type.trans_type_name', $search)
                        ->orLike('outbound.outbound_doc', $search)
                        ->orLike('outbound.outbound_doc_date', $search)
                        ->orLike('outbound.create_date', $search)
                        ->get();
                return $query->getRow()->total;
        } else {
                $query = $this->db->table($this->table)
                        ->selectCount($this->primaryKey, 'total')
                        ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                        ->where('outbound.outbound_wh_asal', @session()->get('warehouse_id'))
                        ->groupStart()
                                ->like('customer.customer_name', $search)
                                ->orLike('warehouse.wh_name', $search)
                                ->orLike('trans_type.trans_type_name', $search)
                                ->orLike('outbound.outbound_doc', $search)
                                ->orLike('outbound.outbound_doc_date', $search)
                                ->orLike('outbound.create_date', $search)
                        ->groupEnd()
                        ->get();
                return $query->getRow()->total;
        }
    }
    // End Serverside

    // Serverside PO
    public function all_po_outbound_bystatus($limit, $start, $col, $dir, $status)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
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
                        // ->where('po_outbound.transporter_id IS NOT NULL')
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
                                , po_outbound.po_outbound_doc_date
                                , po_outbound.po_create_date
                                , customer.customer_name
                                , warehouse.wh_name
                                , po_outbound.transporter_id
                                , po_outbound.po_resi_number')
                        ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                        ->join('warehouse', 'po_outbound.warehouse_id=warehouse.warehouse_id')
                        ->join('trans_type', 'po_outbound.po_outbound_type=trans_type.trans_type_id')
                        // ->where('po_outbound.transporter_id IS NOT NULL')
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
                        // ->where('po_outbound.transporter_id IS NOT NULL')
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
                        // ->where('po_outbound.transporter_id IS NOT NULL')
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
                        // ->where('po_outbound.transporter_id IS NOT NULL')
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
                        // ->where('po_outbound.transporter_id IS NOT NULL')
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
                        // ->where('po_outbound.transporter_id IS NOT NULL')
                        ->where('po_outbound.po_out_status', $status)
                        ->get();
                return $query->getRow()->total;
        } else {
                $query = $this->db->table('po_outbound')
                        ->selectCount('po_outbound.po_outbound_id', 'total')
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
                        ->groupStart()
                        ->like('customer.customer_name', $search)
                        ->orLike('po_outbound.po_outbound_id', $search)
                        ->orLike('warehouse.wh_name', $search)
                        ->orLike('trans_type.trans_type_name', $search)
                        ->orLike('po_outbound.po_outbound_doc', $search)
                        ->orLike('po_outbound.po_outbound_doc_date', $search)
                        ->orLike('po_outbound.po_create_date', $search)
                        ->groupEnd()
                        // ->where('po_outbound.transporter_id IS NOT NULL')
                        ->where('po_outbound.po_out_status', $status)
                        ->where('po_outbound.warehouse_id', @session()->get('warehouse_id'))
                        ->get();
                return $query->getRow()->total;
        }
    }
    // End Serverside

    public function get_po_outbound_detail($id){
        $query = $this->db->table('po_out_detail')
                ->join('po_outbound', 'po_out_detail.po_outbound_id = po_outbound.po_outbound_id')
                ->join('material', 'po_out_detail.material_id = material.material_id', 'left')
                ->join('owners', 'po_outbound.owners_id = owners.owners_id', 'left')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->where('po_out_detail.po_outbound_id', $id)   
                ->get();
        return $query->getResult();
    }

    // Serverside
    public function all_outbound_bystatus($limit, $start, $col, $dir, $status)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
                $query = $this->db->table($this->table)
                        ->select('outbound.outbound_id
                                , outbound.outbound_doc
                                , outbound.status
                                , outbound.outbound_doc_date
                                , outbound.create_date
                                , customer.customer_name
                                , warehouse.wh_name')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                        ->where('outbound.status', $status)
                        ->limit($limit, $start)
                        ->orderBy('out_date', 'DESC')
                        ->orderBy($col, $dir)
                        ->get();
                return $query->getResult();
        } else {
                $query = $this->db->table($this->table)
                        ->select('outbound.outbound_id
                                , outbound.outbound_doc
                                , outbound.status
                                , outbound.outbound_doc_date
                                , outbound.create_date
                                , customer.customer_name
                                , warehouse.wh_name')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                        ->where('outbound.outbound_wh_asal', @session()->get('warehouse_id'))
                        ->where('outbound.status', $status)
                        ->limit($limit, $start)
                        ->orderBy($col, $dir)
                        ->get();
                return $query->getResult();
        }
    }

    public function all_outbound_count_bystatus($status)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
                $query = $this->db->table($this->table)
                        ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                        ->where('outbound.status', $status);
                return $query->countAllResults();
        } else {
                $query = $this->db->table($this->table)
                        ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                        ->where('outbound.status', $status)
                        ->where('outbound.outbound_wh_asal', @session()->get('warehouse_id'));
                return $query->countAllResults();
        }
    }

    public function search_outbound_bystatus($limit, $start, $search, $col, $dir, $status)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
                $query = $this->db->table($this->table)
                        ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                        ->groupStart()
                                ->like('customer.customer_name', $search)
                                ->orLike('warehouse.wh_name', $search)
                                ->orLike('trans_type.trans_type_name', $search)
                                ->orLike('outbound.outbound_doc', $search)
                                ->orLike('outbound.outbound_doc_date', $search)
                                ->orLike('outbound.create_date', $search)
                        ->groupEnd()
                        ->where('outbound.status', $status)
                        ->limit($limit, $start)
                        ->orderBy('out_date', 'DESC')
                        ->orderBy($col, $dir)
                        ->get();
                return $query->getResult();
        } else {
                $query = $this->db->table($this->table)
                        ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                        ->where('outbound.status', $status)
                        ->where('outbound.outbound_wh_asal', @session()->get('warehouse_id'))
                        ->groupStart()
                                ->like('customer.customer_name', $search)
                                ->orLike('warehouse.wh_name', $search)
                                ->orLike('trans_type.trans_type_name', $search)
                                ->orLike('outbound.outbound_doc', $search)
                                ->orLike('outbound.outbound_doc_date', $search)
                                ->orLike('outbound.create_date', $search)
                        ->groupEnd()
                        ->limit($limit, $start)
                        ->orderBy('out_date', 'DESC')
                        ->orderBy($col, $dir)
                        ->get();
                return $query->getResult();
        }
    }

    public function search_outbound_count_bystatus($search, $status)
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
                $query = $this->db->table($this->table)
                        ->selectCount($this->primaryKey, 'total')
                        ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                        ->groupStart()
                                ->like('customer.customer_name', $search)
                                ->orLike('warehouse.wh_name', $search)
                                ->orLike('trans_type.trans_type_name', $search)
                                ->orLike('outbound.outbound_doc', $search)
                                ->orLike('outbound.outbound_doc_date', $search)
                                ->orLike('outbound.create_date', $search)
                        ->groupEnd()
                        ->where('outbound.status', $status)
                        ->get();
                return $query->getRow()->total;
        } else {
                $query = $this->db->table($this->table)
                        ->selectCount($this->primaryKey, 'total')
                        ->select('outbound.outbound_id, outbound.outbound_doc, outbound.status, outbound.outbound_doc_date, outbound.create_date, customer.customer_name, warehouse.wh_name')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                        ->where('outbound.status', $status)
                        ->where('outbound.outbound_wh_asal', @session()->get('warehouse_id'))
                        ->groupStart()
                                ->like('customer.customer_name', $search)
                                ->orLike('warehouse.wh_name', $search)
                                ->orLike('trans_type.trans_type_name', $search)
                                ->orLike('outbound.outbound_doc', $search)
                                ->orLike('outbound.outbound_doc_date', $search)
                                ->orLike('outbound.create_date', $search)
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

    public function update_data_bypo($id, $data)
    {
        $this->db->table($this->table)
                ->where('po_outbound_id', $id)
                ->update($data);
    }

    public function delete_data($id)
    {
        $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->delete();
    }

    public function get_outbound()
    {
        if(session()->get('warehouse_id') == 'POSLOG'){
                $query = $this->db->table($this->table)
                        ->select('outbound.outbound_id
                                , outbound.outbound_doc
                                , outbound.status
                                , outbound.outbound_doc_date
                                , outbound.create_date
                                , customer.customer_name
                                , warehouse.wh_name
                                , po_outbound.transporter_id
                                , transporter.transporter_alias')
                        ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                        ->join('transporter', 'po_outbound.transporter_id=transporter.transporter_id', 'LEFT')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                        ->where('outbound.status', 2)
                        ->get();
                return $query->getResult();
        } else {
                $query = $this->db->table($this->table)
                        ->select('outbound.outbound_id
                                , outbound.outbound_doc
                                , outbound.status
                                , outbound.outbound_doc_date
                                , outbound.create_date
                                , customer.customer_name
                                , warehouse.wh_name
                                , po_outbound.transporter_id
                                , transporter.transporter_alias')
                        ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                        ->join('transporter', 'po_outbound.transporter_id=transporter.transporter_id', 'LEFT')
                        ->join('customer', 'outbound.penerima=customer.customer_id')
                        ->join('warehouse', 'outbound.outbound_wh_asal=warehouse.warehouse_id')
                        ->join('trans_type', 'outbound.outbound_type=trans_type.trans_type_id')
                        ->where('outbound.status', 2)
                        ->where('outbound.outbound_wh_asal', @session()->get('warehouse_id'))
                        ->get();
                return $query->getResult();

        }
    }

    public function get_outbound_detail($id){
        $query = $this->db->table('outbound_detail')
                ->join('outbound', 'outbound_detail.outbound_id = outbound.outbound_id')
                ->join('material_detail', 'outbound_detail.material_detail_id = material_detail.mat_detail_id')
                ->join('material', 'material_detail.material_id = material.material_id')
                ->join('owners', 'material_detail.owner_id = owners.owners_id')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->where('outbound_detail.outbound_id', $id)   
                ->get();
        return $query->getResult();
    }

    public function get_outbound_detail_v2($id){
        $query = $this->db->table('outbound_detail')
                ->join('outbound', 'outbound_detail.outbound_id = outbound.outbound_id')
                ->join('material_detail', 'outbound_detail.material_detail_id = material_detail.mat_detail_id', 'left')
                ->join('material', 'outbound_detail.material_id = material.material_id', 'left')
                ->join('owners', 'outbound.owners_id = owners.owners_id', 'left')
                ->join('material_location', 'material_location.material_detail_id=material_detail.mat_detail_id', 'left')
                ->join('shelf', 'material_location.shelf_id=shelf.shelf_id', 'left')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->where('outbound_detail.outbound_id', $id)   
                ->get();
        return $query->getResult();
    }

    public function get_outbound_byid($id){
        $query = $this->db->table($this->table)
                ->select('`outbound`.`outbound_id`
                , `outbound`.`outbound_type`
                , `outbound`.`po_outbound_id`
                , `outbound`.`penerima`
                , `customer`.`customer_name`
                , `outbound`.`outbound_doc`
                , `outbound`.`outbound_doc_date`
                , `outbound`.`outbound_wh_asal`
                , `outbound`.`owners_id`
                , `outbound`.`create_date`
                , `warehouse`.`wh_name`
                , `outbound`.`status`
                , `outbound`.`out_date`
                , `outbound`.`create_by`
                , `outbound`.`description`
                , `trans_type`.`trans_type_name`')
                ->join('customer', 'outbound.penerima = customer.customer_id')
                ->join('warehouse', 'outbound_wh_asal = warehouse.warehouse_id')
                ->join('trans_type', 'outbound.outbound_type = trans_type.trans_type_id')
                ->where('outbound.outbound_id', $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_outbound_bypo($id){
        $query = $this->db->table($this->table)
                ->select('`outbound`.`outbound_id`
                , `outbound`.`outbound_type`
                , `outbound`.`po_outbound_id`
                , `outbound`.`penerima`
                , `customer`.`customer_name`
                , `outbound`.`outbound_doc`
                , `outbound`.`outbound_doc_date`
                , `outbound`.`outbound_wh_asal`
                , `outbound`.`owners_id`
                , `outbound`.`create_date`
                , `warehouse`.`wh_name`
                , `outbound`.`status`
                , `outbound`.`out_date`
                , `outbound`.`create_by`
                , `outbound`.`description`
                , `trans_type`.`trans_type_name`')
                ->join('customer', 'outbound.penerima = customer.customer_id')
                ->join('warehouse', 'outbound_wh_asal = warehouse.warehouse_id')
                ->join('trans_type', 'outbound.outbound_type = trans_type.trans_type_id')
                ->where('outbound.po_outbound_id', $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function print_history($cond){
        // $query = $this->db->query("SELECT ob.`outbound_id` AS nomor
        //             , ob.`out_date` AS tgl_penyerahan
        //             , ob.`outbound_wh_asal`
        //             , wh.`wh_name` AS gd_pengirim
        //             , ob.`penerima`
        //             , cs.`customer_name`
        //             FROM outbound ob 
        //             JOIN `warehouse` wh ON ob.`outbound_wh_asal` = wh.`warehouse_id`
        //             JOIN customer cs ON ob.`penerima` = cs.`customer_id`
        //     $cond");
        $query = $this->db->table('outbound ob')
                ->select("ob.outbound_id AS nomor
                        , ob.out_date AS tgl_penyerahan
                        , ob.outbound_wh_asal
                        , ob.create_date
                        , wh.wh_name AS gd_pengirim
                        , ob.penerima
                        , ob.po_outbound_id
                        , cs.customer_name
                        , cs.customer_address
                        , cs.customer_phone
                        , tr.transporter_name AS transporter
                        , tr.transporter_alias
                        , (SELECT phone FROM users 
                                WHERE owners_id = pob.owners_id AND level_id = 'LV006') AS telepon_pengirim
                        , pob.owners_id
                        , pob.po_description
                        , pob.transporter_marketplace
                        , pob.po_resi_number
                        , pob.transporter_id
                        , ow.owners_name")
                ->join('customer cs', 'ob.penerima = cs.customer_id')
                ->join('warehouse wh', 'ob.outbound_wh_asal = wh.warehouse_id')
                ->join('po_outbound pob', 'ob.po_outbound_id = pob.po_outbound_id')
                ->join('owners ow', 'pob.owners_id = ow.owners_id')
                ->join('outbound_do_detail dod', 'ob.outbound_id = dod.outbound_id', 'left')
                ->join('transporter tr', 'dod.transporter_id = tr.transporter_id', 'left')
                ->where($cond)
                ->limit(1)
                ->get();
        return $query->getRow(); 
    }

    public function print_history_v2($cond){
        $query = $this->db->table('outbound ob')
                ->select("ob.outbound_id AS nomor
                        , ob.out_date AS tgl_penyerahan
                        , ob.outbound_wh_asal
                        , ob.create_date
                        , wh.wh_name AS gd_pengirim
                        , ob.penerima
                        , ob.po_outbound_id
                        , cs.customer_name
                        , cs.customer_address
                        , cs.customer_phone
                        , tr.transporter_name AS transporter
                        , tr.transporter_alias
                        , (SELECT phone FROM users 
                                WHERE owners_id = pob.owners_id AND level_id = 'LV006' LIMIT 1) AS telepon_pengirim
                        , pob.owners_id
                        , pob.po_description
                        , pob.transporter_marketplace
                        , pob.po_resi_number
                        , pob.transporter_id
                        , tr2.transporter_alias as transporter_base_on_po
                        , ow.owners_name")
                ->join('customer cs', 'ob.penerima = cs.customer_id')
                ->join('warehouse wh', 'ob.outbound_wh_asal = wh.warehouse_id')
                ->join('po_outbound pob', 'ob.po_outbound_id = pob.po_outbound_id')
                ->join('owners ow', 'pob.owners_id = ow.owners_id')
                ->join('outbound_do_detail dod', 'ob.outbound_id = dod.outbound_id', 'left')
                ->join('transporter tr', 'dod.transporter_id = tr.transporter_id', 'left')
                ->join('transporter tr2', 'pob.transporter_id = tr2.transporter_id', 'left')
                ->where($cond)
                ->limit(1)
                ->get();
        return $query->getRow(); 
    }

    public function print_history_v3($cond){
        $query = $this->db->table('outbound ob')
                ->select("ob.outbound_id AS nomor
                        , ob.out_date AS tgl_penyerahan
                        , ob.outbound_wh_asal
                        , ob.create_date
                        , wh.wh_name AS gd_pengirim
                        , ob.penerima
                        , ob.po_outbound_id
                        , cs.customer_name
                        , cs.customer_address
                        , cs.customer_phone
                        , ob.outbound_transpoter
                        , ob.license_plate
                        , ob.outbound_driver

                        , pob.owners_id
                        , pob.po_description
                        , pob.transporter_marketplace
                        , pob.po_resi_number
                        , pob.transporter_id
                        , ow.owners_name")
                ->join('customer cs', 'ob.penerima = cs.customer_id')
                ->join('warehouse wh', 'ob.outbound_wh_asal = wh.warehouse_id')
                ->join('po_outbound pob', 'ob.po_outbound_id = pob.po_outbound_id')
                ->join('owners ow', 'pob.owners_id = ow.owners_id')
                ->join('outbound_do_detail dod', 'ob.outbound_id = dod.outbound_id', 'left')
                ->where($cond)
                ->limit(1)
                ->get();
        return $query->getRow(); 
    }

    public function print_history_detail($cond){
        // $query = $this->db->query("SELECT
        // m.`material_name` AS nama_produk
        // , obd.`qty_realization` AS total_keluar
        // FROM outbound_detail obd 
        // JOIN `material_detail` md ON obd.`material_detail_id` = md.`mat_detail_id`
        // JOIN material m ON md.`material_id` = m.`material_id`
        //     $cond");
        $query = $this->db->table('outbound_detail obd')
                ->select('m.`material_name`
                            , md.`material_id`
                            , obd.`qty_realization` AS total_keluar
                            , obd.koli')
                ->join('material_detail md', 'obd.material_detail_id = md.mat_detail_id')
                ->join('material m', 'md.material_id = m.material_id')
                ->where($cond)
                ->get();
        return $query->getResult();
    }

    public function print_history_detail_v2($cond){
        $query = $this->db->table('outbound_detail obd')
                ->select('m.`material_name`
                            , md.`material_id`
                            , sum(obd.`qty_realization`) AS total_keluar
                            , obd.koli')
                ->join('material_detail md', 'obd.material_detail_id = md.mat_detail_id')
                ->join('material m', 'md.material_id = m.material_id')
                ->where($cond)
                ->groupBy('m.material_id')
                ->get();
        return $query->getResult();
    }
}
?>