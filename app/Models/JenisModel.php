<?php namespace App\Models;

use CodeIgniter\Model;

class JenisModel extends Model
{
    protected $table = "jenis";
    protected $primaryKey = 'jenis_id';

    public function __construct()
    {
        parent::__construct();
    }

     // Serverside
     public function all_jenis($limit, $start, $col, $dir)
     {
         $query = $this->db->table($this->table)
                 ->limit($limit, $start)
                 ->orderBy($col, $dir)
                 ->get();
         return $query->getResult();
     }
 
     public function all_jenis_count()
     {
         $query = $this->db->table($this->table);
         return $query->countAll();
     }
 
     public function search_jenis($limit, $start, $search, $col, $dir)
     {
         $query = $this->db->table($this->table)
                 ->like('jenis_name', $search)
                 ->limit($limit, $start)
                 ->orderBy($col, $dir)
                 ->get();
         return $query->getResult();
     }
 
     public function search_jenis_count($search)
     {
         $query = $this->db->table($this->table)
                 ->selectCount($this->primaryKey, 'total')
                 ->like('jenis_name', $search)
                 ->get();
         return $query->getRow()->total;
     }
     // End Serverside

     public function get_all_jenis(){
        $query = $this->db->table($this->table)
                ->where('jenis_status','1')
                ->get();
        return $query->getResult();
    }

    public function get_jenis_byid($id)
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