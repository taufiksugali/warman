<?php namespace App\Models;

use CodeIgniter\Model;

class UomModel extends Model
{
    protected $table = "uom";
    protected $primaryKey = 'uom_id';

    public function __construct()
    {
        parent::__construct();
    }

     // Serverside
     public function all_uom($limit, $start, $col, $dir)
     {
         $query = $this->db->table($this->table)
                 ->limit($limit, $start)
                 ->orderBy($col, $dir)
                 ->get();
         return $query->getResult();
     }
 
     public function all_uom_count()
     {
         $query = $this->db->table($this->table);
         return $query->countAll();
     }
 
     public function search_uom($limit, $start, $search, $col, $dir)
     {
         $query = $this->db->table($this->table)
                 ->like('uom_name', $search)
                 ->limit($limit, $start)
                 ->orderBy($col, $dir)
                 ->get();
         return $query->getResult();
     }
 
     public function search_uom_count($search)
     {
         $query = $this->db->table($this->table)
                 ->selectCount($this->primaryKey, 'total')
                 ->like('uom_name', $search)
                 ->get();
         return $query->getRow()->total;
     }
     // End Serverside

     public function get_all_uom(){
        $query = $this->db->table($this->table)
                ->get();
        return $query->getResult();
    }

    public function get_uom_byid($id)
    {
        $query = $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_uom_byname($name)
    {
        $query = $this->db->table($this->table)
                ->where('uom_name', $name)
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