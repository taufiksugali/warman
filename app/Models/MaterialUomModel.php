<?php namespace App\Models;

use CodeIgniter\Model;

class MaterialUomModel extends Model
{
    protected $table = "material_uom";
    protected $primaryKey = 'mat_uom_id';

    public function __construct()
    {
        parent::__construct();
    }

    // Serverside
    public function all_matuom($limit, $start, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->join('material', 'material_uom.material_id=material.material_id')
                ->join('uom', 'material_uom.uom_id=uom.uom_id')
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function all_matuom_count()
    {
        $query = $this->db->table($this->table);
        return $query->countAll();
    }

    public function search_matuom($limit, $start, $search, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->join('material', 'material_uom.material_id=material.material_id')
                ->join('uom', 'material_uom.uom_id=uom.uom_id')
                ->like('mat_group_name', $search)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function search_matuom_count($search)
    {
        $query = $this->db->table($this->table)
                ->selectCount($this->primaryKey, 'total')
                ->join('material', 'material_uom.material_id=material.material_id')
                ->join('uom', 'material_uom.uom_id=uom.uom_id')
                ->like('material_id', $search)
                ->get();
        return $query->getRow()->total;
    }
    // End Serverside

    public function get_matuom_byid($id)
    {
        $query = $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_all_mat_uom(){
        $query = $this->db->table($this->table)
                ->where('is_active', '1')
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

    public function delete_data($id)
	{
		$this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->delete();
	}
}
?>