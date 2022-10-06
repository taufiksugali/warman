<?php namespace App\Models;

use CodeIgniter\Model;

class MaterialGroupModel extends Model
{
    protected $table = "material_group";
    protected $primaryKey = 'mat_group_id';

    public function __construct()
    {
        parent::__construct();
    }

    // Serverside
    public function all_matgroup($limit, $start, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->join('jenis', 'material_group.jenis_id=jenis.jenis_id')
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function all_matgroup_count()
    {
        $query = $this->db->table($this->table);
        return $query->countAll();
    }

    public function search_matgroup($limit, $start, $search, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->join('jenis', 'material_group.jenis_id=jenis.jenis_id')
                ->like('mat_group_name', $search)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function search_matgroup_count($search)
    {
        $query = $this->db->table($this->table)
                ->selectCount($this->primaryKey, 'total')
                ->join('jenis', 'material_group.jenis_id=jenis.jenis_id')
                ->like('uom_name', $search)
                ->get();
        return $query->getRow()->total;
    }
    // End Serverside

    public function get_matgroup_byid($id)
    {
        $query = $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_matgroup_byname($id)
    {
        $query = $this->db->table($this->table)
                ->where('mat_group_name', $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_all_mat_group(){
        $query = $this->db->table($this->table)
                ->where('status', '1')
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