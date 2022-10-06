<?php namespace App\Models;

use CodeIgniter\Model;

class PrivilegeModel extends Model
{
    protected $table = "user_access_menu";
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

     // End Serverside

     public function get_all_sub_menu($id){
        $query = $this->db->table('user_sub_menu')
                ->select('user_sub_menu.*, user_menu.menu_name')
                ->join('user_menu', 'user_sub_menu.menu_id = user_menu.id')
                ->where('user_sub_menu.is_active', '1')
                ->where('user_sub_menu.menu_id', $id)
                ->get();
        return $query->getResult();
    }

    public function get_menu_all_by_privilege($id) {
        $query = $this->db->table('user_access_menu a')
                ->join('user_sub_menu b', 'a.sub_menu_id=b.id')
                ->join('user_menu c', 'a.menu_id=c.id')
                ->where('a.level_id', $id)
                ->get();
        return $query->getResult();
    }

    public function get_all_menu(){
        $query = $this->db->table('user_menu')
                ->where('is_active', '1')
                ->get();
        return $query->getResult();
    }

    public function get_sub_menu_by_id($id){
        $query = $this->db->table('user_sub_menu')
                ->where('id', $id)
                ->where('is_active', '1')
                ->get();
        return $query->getResult();
    }

    public function get_all_user_access(){
        $query = $this->db->table($this->table)
                ->get();
        return $query->getResult();
    }

    public function get_user_access($id){
        $query = $this->db->table($this->table)
                ->select('user_menu.*, user_access_menu.*')
                ->join('user_menu', 'user_access_menu.menu_id = user_menu.id')
                ->where('level_id', $id)
                ->groupBy('menu_id')
                ->get();
        return $query->getResult();
    }
    
    public function get_user_access_byid($level_id, $menu_id, $submenu_id)
    {
        if($submenu_id == 0 ||$submenu_id == "" || $submenu_id == null){
            $cond = "level_id = '$level_id' AND menu_id = '$menu_id'";
        }else{
            $cond = "level_id = '$level_id' AND menu_id = '$menu_id' AND sub_menu_id = '$submenu_id'";
        }
        $query = $this->db->table($this->table)
                ->where($cond)
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

    public function delete_by_levelID($level_id)
	{
		$this->db->table($this->table)
                ->where('level_id', $level_id)
                ->delete();
	}

}