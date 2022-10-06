<?php namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = "user_menu";
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

     // Serverside
     public function all_menu($limit, $start, $col, $dir)
     {
         $query = $this->db->table($this->table)
                 ->limit($limit, $start)
                 ->orderBy($col, $dir)
                 ->get();
         return $query->getResult();
     }
 
     public function all_menu_count()
     {
         $query = $this->db->table($this->table);
         return $query->countAll();
     }
 
     public function search_menu($limit, $start, $search, $col, $dir)
     {
         $query = $this->db->table($this->table)
                 ->like('menu_name', $search)
                 ->limit($limit, $start)
                 ->orderBy($col, $dir)
                 ->get();
         return $query->getResult();
     }
 
     public function search_menu_count($search)
     {
         $query = $this->db->table($this->table)
                 ->selectCount($this->primaryKey, 'total')
                 ->like('menu_name', $search)
                 ->get();
         return $query->getRow()->total;
     }
     // End Serverside

     public function get_all_menu(){
        $query = $this->db->table($this->table)
                ->get();
        return $query->getResult();
    }

    public function get_menu_byid($id)
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