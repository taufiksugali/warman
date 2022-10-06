<?php namespace App\Models;

use CodeIgniter\Model;

class MaterialModel extends Model
{
    protected $table = "material";
    protected $primaryKey = 'material_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(material_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(material_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "MTR".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    // Serverside
    public function all_material($limit, $start, $col, $dir)
    {
        if(session()->get('user_type') == 1){
            $query = $this->db->table($this->table)
                    ->join('material_group', 'material.mat_group_id=material_group.mat_group_id')
                    ->join('uom', 'material.mat_uom=uom.uom_id')
                    ->where('material.owners_id', session()->get('owners_id'))
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
        } else {
            if(session()->get('warehouse_id') == "POSLOG"){
                $query = $this->db->table($this->table)
                        ->join('material_group', 'material.mat_group_id=material_group.mat_group_id')
                        ->join('uom', 'material.mat_uom=uom.uom_id')
                        ->limit($limit, $start)
                        ->orderBy($col, $dir)
                        ->get();
            } else {
                $query = $this->db->table($this->table)
                        ->select('material.*, material_group.mat_group_name, material_group.jenis_id,
                                    uom.uom_name')
                        ->join('material_group', 'material.mat_group_id=material_group.mat_group_id')
                        ->join('uom', 'material.mat_uom=uom.uom_id')
                        ->join('material_detail', 'material.material_id = material_detail.material_id')
                        ->join('inbound_detail', 'material_detail.material_id = inbound_detail.material_detail_id')
                        ->join('inbound', 'inbound_detail.inbound_id = inbound.inbound_id')
                        ->where('inbound.inbound_location', @session()->get('warehouse_id'))
                        ->groupBy('material.material_id')
                        ->limit($limit, $start)
                        ->orderBy($col, $dir)
                        ->get();
            }
        }
        return $query->getResult();
    }

    public function all_material_count()
    {
        if(session()->get('user_type') == 1){
            $query = $this->db->table($this->table)
                    ->join('material_group', 'material.mat_group_id=material_group.mat_group_id')
                    ->join('uom', 'material.mat_uom=uom.uom_id')
                    ->where('material.owners_id', session()->get('owners_id'));
        } else {
            if(session()->get('warehouse_id') == "POSLOG"){
                $query = $this->db->table($this->table)
                        ->join('material_group', 'material.mat_group_id=material_group.mat_group_id')
                        ->join('uom', 'material.mat_uom=uom.uom_id');
            } else {
                $query = $this->db->table($this->table)
                        ->select('material.*, material_group.mat_group_name, material_group.jenis_id,
                                            uom.uom_name')
                        ->join('material_group', 'material.mat_group_id=material_group.mat_group_id')
                        ->join('uom', 'material.mat_uom=uom.uom_id')
                        ->join('material_detail', 'material.material_id = material_detail.material_id')
                        ->join('inbound_detail', 'material_detail.material_id = inbound_detail.material_detail_id')
                        ->join('inbound', 'inbound_detail.inbound_id = inbound.inbound_id')
                        ->where('inbound.inbound_location', @session()->get('warehouse_id'))
                        ->groupBy('material.material_id');
            }
        }
        return $query->countAllResults();
    }

    public function search_material($limit, $start, $search, $col, $dir)
    {
        if(session()->get('user_type') == 1){
            $query = $this->db->table($this->table)
                    ->join('material_group', 'material.mat_group_id=material_group.mat_group_id')
                    ->join('uom', 'material.mat_uom=uom.uom_id')
                    ->where('material.owners_id', session()->get('owners_id'))
                    ->like('material.material_name', $search)
                    ->orLike('material.description', $search)
                    ->orLike('material_group.mat_group_name', $search)
                    ->orLike('uom.uom_name', $search)
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
        } else {
            if(session()->get('warehouse_id') == "POSLOG"){
                $query = $this->db->table($this->table)
                        ->join('material_group', 'material.mat_group_id=material_group.mat_group_id')
                        ->join('uom', 'material.mat_uom=uom.uom_id')
                        ->like('material.material_name', $search)
                        ->orLike('material.description', $search)
                        ->orLike('material_group.mat_group_name', $search)
                        ->orLike('uom.uom_name', $search)
                        ->limit($limit, $start)
                        ->orderBy($col, $dir)
                        ->get();
            } else {
                $query = $this->db->table($this->table)
                        ->select('material.*, material_group.mat_group_name, material_group.jenis_id,
                        uom.uom_name')
                        ->join('material_group', 'material.mat_group_id=material_group.mat_group_id')
                        ->join('uom', 'material.mat_uom=uom.uom_id')
                        ->join('material_detail', 'material.material_id = material_detail.material_id')
                        ->join('inbound_detail', 'material_detail.material_id = inbound_detail.material_detail_id')
                        ->join('inbound', 'inbound_detail.inbound_id = inbound.inbound_id')
                        ->where('inbound.inbound_location', @session()->get('warehouse_id'))
                        ->groupStart()
                            ->like('material.material_name', $search)
                            ->orLike('material.description', $search)
                            ->orLike('material_group.mat_group_name', $search)
                            ->orLike('uom.uom_name', $search)
                        ->groupEnd()
                        ->groupBy('material.material_id')
                        ->limit($limit, $start)
                        ->orderBy($col, $dir)
                        ->get();
            }
        }
        return $query->getResult();
    }

    public function search_material_count($search)
    {
        if(session()->get('user_type') == 1){
            $query = $this->db->table($this->table)
                    ->selectCount($this->primaryKey, 'total')
                    ->join('material_group', 'material.mat_group_id=material_group.mat_group_id')
                    ->join('uom', 'material.mat_uom=uom.uom_id')
                    ->where('material.owners_id', session()->get('owners_id'))
                    ->like('material.material_name', $search)
                    ->orLike('material.description', $search)
                    ->orLike('material_group.mat_group_name', $search)
                    ->orLike('uom.uom_name', $search);
        } else {
            if(session()->get('warehouse_id') == "POSLOG"){
                $query = $this->db->table($this->table)
                        ->selectCount('material.material_id', 'total')
                        ->join('material_group', 'material.mat_group_id=material_group.mat_group_id')
                        ->join('uom', 'material.mat_uom=uom.uom_id')
                        ->like('material.material_name', $search)
                        ->orLike('material.description', $search)
                        ->orLike('material_group.mat_group_name', $search)
                        ->orLike('uom.uom_name', $search);
            } else {
                $query = $this->db->table($this->table)
                        ->selectCount('material.material_id', 'total')
                        ->select('material.*, material_group.mat_group_name, material_group.jenis_id,
                                            uom.uom_name')
                        ->join('material_group', 'material.mat_group_id=material_group.mat_group_id')
                        ->join('uom', 'material.mat_uom=uom.uom_id')
                        ->join('material_detail', 'material.material_id = material_detail.material_id')
                        ->join('inbound_detail', 'material_detail.material_id = inbound_detail.material_detail_id')
                        ->join('inbound', 'inbound_detail.inbound_id = inbound.inbound_id')
                        ->where('inbound.inbound_location', @session()->get('warehouse_id'))
                        ->groupStart()
                            ->like('material.material_name', $search)
                            ->orLike('material.description', $search)
                            ->orLike('material_group.mat_group_name', $search)
                            ->orLike('uom.uom_name', $search)
                        ->groupEnd()
                        ->groupBy('material.material_id');
            }
        }
        return $query->countAllResults();
    }
    
    // End Serverside

    // start of auditor Serverside
    public function all_material_audit($limit, $start, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->select('material.*
                        , uom.uom_name
                        , material_group.mat_group_name
                        , owners.owners_name')
                ->join('material_group', 'material.mat_group_id=material_group.mat_group_id')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->join('owners', 'material.owners_id=owners.owners_id')
                ->where('material.approval_status', 0)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function all_material_count_audit()
    {
        $query = $this->db->table($this->table)
                ->select('material.*
                    , uom.uom_name
                    , material_group.mat_group_name
                    , owners.owners_name')
                ->join('material_group', 'material.mat_group_id=material_group.mat_group_id')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->join('owners', 'material.owners_id=owners.owners_id')
                ->where('material.approval_status', 0);
    
        return $query->countAllResults();
    }

    public function search_material_audit($limit, $start, $search, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->select('material.*
                        , uom.uom_name
                        , material_group.mat_group_name
                        , owners.owners_name')
                ->join('material_group', 'material.mat_group_id=material_group.mat_group_id')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->join('owners', 'material.owners_id=owners.owners_id')
                ->where('material.approval_status', 0)
                ->groupStart()
                    ->like('material.material_name', $search)
                    ->orLike('material.description', $search)
                    ->orLike('material_group.mat_group_name', $search)
                    ->orLike('uom.uom_name', $search)
                ->groupEnd()
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        
        return $query->getResult();
    }

    public function search_material_count_audit($search)
    {
        $query = $this->db->table($this->table)
                ->selectCount($this->primaryKey, 'total')
                ->select('material.*
                            , uom.uom_name
                            , material_group.mat_group_name
                            , owners.owners_name')
                ->join('material_group', 'material.mat_group_id=material_group.mat_group_id')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->join('owners', 'material.owners_id=owners.owners_id')
                ->where('material.approval_status', 0)
                ->groupStart()
                    ->like('material.material_name', $search)
                    ->orLike('material.description', $search)
                    ->orLike('material_group.mat_group_name', $search)
                    ->orLike('uom.uom_name', $search)
                ->groupEnd()
                ->get();
        return $query->getRow()->total;
    }
    // End of Serverside auditor

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

    public function get_material_byid($id)
    {
        $query = $this->db->table($this->table)
                ->select('material.*
                            , uom.uom_name
                            , material_group.mat_group_name
                            , owners.owners_name')
                ->join('material_group', 'material.mat_group_id=material_group.mat_group_id')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->join('owners', 'material.owners_id=owners.owners_id')
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function check_materialowner_byid($id, $owners_id)
    {
        $query = $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->where('owners_id', $owners_id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_all_material(){
        if(session()->get('user_type') == 1){
            $query = $this->db->table($this->table)
                    ->join('uom', 'material.mat_uom=uom.uom_id')
                    ->where('material.owners_id', session()->get('owners_id'))
                    ->where('material.status', 1)
                    ->where('material.approval_status', 1)
                    ->get();
        } else {
            $query = $this->db->table($this->table)
                    ->join('uom', 'material.mat_uom=uom.uom_id')
                    ->where('material.status', 1)
                    ->where('material.approval_status', 1)
                    ->get();
        }
        return $query->getResult();
    }

    public function get_city_name($regency_id)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://hris.poslogistics.co.id/api/Hris_Api/getByidRegency?token=0a05252241f3bc45ffc4abaeca369963&id='.$regency_id.'&param=regency_id');
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result     = curl_exec ($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $dataObject = json_decode($result);
        
        return $dataObject->data[0]->regency_name .', '. $dataObject->data[0]->province_name;
    }

    public function generate_history_id(){
        $lastId = $this->db->table('materialsize_hist')
                ->select('MAX(RIGHT(size_id, 7)) AS last_id')
                ->get();
        $lastMidId = $this->db->table('materialsize_hist')
                ->select('MAX(MID(size_id, 4, 6)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
        $midId = date('ymd');
        $char = "MSH".$midId;
        if($lastMidId == $midId){
                $tmp = ($lastId->getRow()->last_id)+1;
                $id = substr($tmp, -5);
        }else{
                $id = "00001";
        }
        return $char.$id;
    }

    public function insert_hist_data($data)
    {
        return $this->db->table('materialsize_hist')
                ->insert($data);
    }
}
?>