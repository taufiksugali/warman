<?php namespace App\Models;

use CodeIgniter\Model;

class SubMenuModel extends Model
{
    protected $table = "user_sub_menu";
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

     // Serverside
     public function all_sub_menu($limit, $start, $col, $dir)
     {
         $query = $this->db->table($this->table)
                 ->select('user_sub_menu.*, user_menu.menu_name')
                 ->join('user_menu', 'user_sub_menu.menu_id = user_menu.id')
                 ->limit($limit, $start)
                 ->orderBy($col, $dir)
                 ->get();
         return $query->getResult();
     }
 
     public function all_sub_menu_count()
     {
         $query = $this->db->table($this->table)
                 ->select('user_sub_menu.*, user_menu.menu_name')
                 ->join('user_menu', 'user_sub_menu.menu_id = user_menu.id');
         return $query->countAll();
     }
 
     public function search_sub_menu($limit, $start, $search, $col, $dir)
     {
         $query = $this->db->table($this->table)
                 ->select('user_sub_menu.*, user_menu.menu_name')
                 ->join('user_menu', 'user_sub_menu.menu_id = user_menu.id')
                 ->like('sub_menu_name', $search)
                 ->limit($limit, $start)
                 ->orderBy($col, $dir)
                 ->get();
         return $query->getResult();
     }
 
     public function search_sub_menu_count($search)
     {
         $query = $this->db->table($this->table)
                 ->selectCount($this->primaryKey, 'total')
                 ->join('user_menu', 'user_sub_menu.menu_id = user_menu.id')
                 ->like('sub_menu_name', $search)
                 ->get();
         return $query->getRow()->total;
     }
     // End Serverside

     public function get_all_sub_menu(){
        $query = $this->db->table($this->table)
                ->select('user_sub_menu.*, user_menu.menu_name')
                ->join('user_menu', 'user_sub_menu.menu_id = user_menu.id')
                ->get();
        return $query->getResult();
    }

    public function get_all_menu(){
        $query = $this->db->table('user_menu')
                ->where('is_active', '1')
                ->where('is_parent', '1')
                ->get();
        return $query->getResult();
    }

    public function get_sub_menu_byid($id)
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