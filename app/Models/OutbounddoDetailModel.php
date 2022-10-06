<?php namespace App\Models;

use CodeIgniter\Model;

class OutbounddoDetailModel extends Model
{
    protected $table = "outbound_do_detail";
    protected $primaryKey = 'do_detail_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(do_detail_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(do_detail_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "ODD".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    public function check_status($id){
        $query = $this->db->table($this->table)
        ->select('status')
        ->where('outbound_do_detail.do_id', $id)
        ->get();
        return $query->getResult();
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

    public function update_data_bypo($id, $data)
    {
        $this->db->table($this->table)
                ->where('outbound_id', $id)
                ->update($data);
    }

    public function delete_data($id)
    {
        $this->db->table($this->table)
                ->where('do_id', $id)
                ->delete();
    }

    public function get_outbounddo_detail($id){
        $query = $this->db->table('outbound_do_detail')
                ->select('outbound_do_detail.do_detail_id
                        , outbound_do_detail.do_id
                        , outbound_do_detail.outbound_id
                        , outbound_do_detail.do_out_resi
                        , outbound_do_detail.do_ongkir
                        , outbound_do_detail.transporter_id
                        , transporter.transporter_name
                        , transporter.transporter_alias
                        , customer.customer_name
                        , outbound.po_outbound_id
                        , outbound.status')
                ->join('transporter', 'outbound_do_detail.transporter_id = transporter.transporter_id', 'LEFT')
                ->join('outbound', 'outbound_do_detail.outbound_id = outbound.outbound_id', 'LEFT')
                ->join('po_outbound', 'outbound.po_outbound_id = po_outbound.po_outbound_id', 'LEFT')
                ->join('customer', 'po_outbound.po_penerima = customer.customer_id', 'LEFT')
                ->where('outbound_do_detail.do_id', $id)   
                ->get();
        return $query->getResult();
    }

    public function get_shippingid_byoutbound($id){
        $query = $this->db->table('outbound_do_detail')
                ->where('outbound_id', $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_shipping_detail($id){
        $query = $this->db->table('outbound_do_detail')
                ->where('do_detail_id', $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function checkDoDetail($id, $outbound_id)
    {
        $query = $this->db->table($this->table)
                ->select("outbound_do_detail.do_id
                            , outbound_do_detail.outbound_id
                            , outbound.status")
                ->join('outbound', 'outbound_do_detail.outbound_id = outbound.outbound_id')
                ->where('do_id', $id)
                ->where('outbound_do_detail.outbound_id !=', $outbound_id)
                ->where('outbound.status !=', 7);
		return $query->countAllResults();
    }
}
?>