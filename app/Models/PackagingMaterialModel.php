<?php namespace App\Models;

use CodeIgniter\Model;

class PackagingMaterialModel extends Model
{
    protected $table = "package_material";
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

     // Serverside
     public function all_pm($limit, $start, $col, $dir)
     {
         $query = $this->db->table($this->table)
                 ->limit($limit, $start)
                 ->orderBy($col, $dir)
                 ->get();
         return $query->getResult();
     }
 
     public function all_pm_count()
     {
         $query = $this->db->table($this->table);
         return $query->countAll();
     }
 
     public function search_pm($limit, $start, $search, $col, $dir)
     {
         $query = $this->db->table($this->table)
                 ->like('pm_name', $search)
                 ->limit($limit, $start)
                 ->orderBy($col, $dir)
                 ->get();
         return $query->getResult();
     }
 
     public function search_pm_count($search)
     {
         $query = $this->db->table($this->table)
                 ->selectCount($this->primaryKey, 'total')
                 ->like('pm_name', $search)
                 ->get();
         return $query->getRow()->total;
     }
     // End Serverside

     public function get_all_pm(){
        $query = $this->db->table($this->table)
                ->get();
        return $query->getResult();
    }

    // public function get_all_pm_not_kardus(){
    //     $query = $this->db->table($this->table)
    //             ->notLike('pm_name', 'Kardus')
    //             ->get();
    //     return $query->getResult();
    // }

    public function get_all_pm_not_kardus(){
        $sql = "SELECT *
                FROM $this->table
                WHERE pm_name IN ('Plastik (10x10cm)', 'Lakban Fragile (100cm)', 'Bubble Wrap (20x20cm)')
            ";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function get_all_pm_kardus(){
        $query = $this->db->table($this->table)
                ->like('pm_name', 'Kardus')
                ->orderBy('pm_name', 'ASC')
                ->get();
        return $query->getResult();
    }

    public function get_pm_kardus_byoutbound($id) //ambil id pm yang box aja, terus dipake buat itung dimensi.
    {
        $query = $this->db->table('outbound_package op')
                ->join('package_material pm', 'op.pm_id = pm.id')
                ->where('op.outbound_id', $id)
                ->where('pm.pm_category', 'BOX')
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_outbound_package($id) //ambil id pm yang box aja, terus dipake buat itung dimensi.
    {
        $query = $this->db->table('outbound_package op')
                ->join('package_material pm', 'op.pm_id = pm.id')
                ->where('op.outbound_id', $id)
                ->get();
        return $query->getResult();
    }

    public function get_pm_byid($id)
    {
        $query = $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
        return $query->getRow();
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