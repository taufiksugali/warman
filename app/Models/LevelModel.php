<?php namespace App\Models;

use CodeIgniter\Model;

class LevelModel extends Model
{
    protected $table = "user_level";
    protected $primaryKey = 'level_id';

    public function __construct()
    {
        parent::__construct();
    }
    
    public function check_role($controller="", $level="") {
        $rtn = false;
        $sql = "SELECT
                    m.*,
                    uam.level_id
                FROM (
                    SELECT 
                        um.id AS menu_id,
                        '0' AS sub_menu_id,
                        LOWER(um.controller) AS controller
                    FROM user_menu um
                    WHERE um.is_active='1' 
                    AND um.is_parent='0'
                
                    UNION ALL
                
                    SELECT 
                        usm.menu_id,
                        usm.id AS sub_menu_id,
                        LOWER(usm.controller) AS controller
                    FROM user_sub_menu usm
                    WHERE usm.is_active='1'
                ) m
                JOIN user_access_menu uam ON uam.menu_id=m.menu_id AND uam.sub_menu_id=m.sub_menu_id
                WHERE m.controller='".$controller."'
                AND uam.level_id='".$level."'
                ";
        $res = $this->db->query($sql);
        if ($res->getNumRows()>0) {
            $rtn = true;
        }
        return $rtn;
    }

     // Serverside
     public function all_level($limit, $start, $col, $dir)
     {
         $query = $this->db->table($this->table)
                //  ->where("level_id != 'LV001'")
                 ->limit($limit, $start)
                 ->orderBy($col, $dir)
                 ->get();
         return $query->getResult();
     }
 
     public function all_level_count()
     {
         $query = $this->db->table($this->table)
                        ->selectCount($this->primaryKey, 'total')
                        // ->where("level_id != 'LV001'")
                        ->get();
         return $query->getRow()->total;
     }
 
     public function search_level($limit, $start, $search, $col, $dir)
     {
         $query = $this->db->table($this->table)
                //  ->where("level_id != 'LV001'")
                 ->like('level_name', $search)
                 ->limit($limit, $start)
                 ->orderBy($col, $dir)
                 ->get();
         return $query->getResult();
     }
 
     public function search_level_count($search)
     {
         $query = $this->db->table($this->table)
                 ->selectCount($this->primaryKey, 'total')
                //  ->where("level_id != 'LV001'")
                 ->like('level_name', $search)
                 ->get();
         return $query->getRow()->total;
     }
     // End Serverside

     public function get_all_level(){
        if(session()->get('user_type') == 1){ 
            $query = $this->db->table($this->table)
                    ->where("level_status = '1'")
                    ->where("level_type = '1'")
                    ->where("level_id != 'LV006'")
                    ->get();
        } else {
            $query = $this->db->table($this->table)
                    ->where("level_status = '1'")
                    ->get();
        }
        return $query->getResult();
    }

    public function get_level_byid($id)
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