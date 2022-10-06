<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class UserhrisModel extends Model
{
    protected $table = "user_hris_role hris";
    protected $table2 = "user_hris_role";
    protected $primaryKey = 'hris_nik';
 
    public function __construct()
    {
        parent::__construct();
    }

    public function all_hris($limit, $start, $col, $dir)
     {
         $query = $this->db->table($this->table)
                 ->select("hris.hris_nik
                 , hris.hris_name
                 , hris.hris_email
                 , hris.user_level
                 , hris.warehouse_id
                 , hris.hris_status
                 , lvl.level_name
                 , wh.wh_name")
                 ->join('warehouse wh', 'hris.warehouse_id = wh.warehouse_id', 'left')
                 ->join('user_level lvl', 'hris.user_level = lvl.level_id', 'left')
                 ->where("hris_nik != '".session()->get('user_id')."'")
                 ->limit($limit, $start)
                 ->orderBy($col, $dir)
                 ->get();
         return $query->getResult();
     }
 
     public function all_hris_count()
     {
         $query = $this->db->table($this->table)
                        ->selectCount($this->primaryKey, 'total')
                        ->join('warehouse wh', 'hris.warehouse_id = wh.warehouse_id', 'left')
                        ->join('user_level lvl', 'hris.user_level = lvl.level_id', 'left')
                        ->where("hris_nik != '".session()->get('user_id')."'")
                        ->get();
         return $query->getRow()->total;
     }
 
     public function search_hris($limit, $start, $search, $col, $dir)
     {
         $query = $this->db->table($this->table)
                //  ->where("hris_id != 'LV001'")
                    ->select("hris.hris_nik
                    , hris.hris_name
                    , hris.hris_email
                    , hris.user_level
                    , hris.warehouse_id
                    , hris.hris_status
                    , lvl.level_name
                    , wh.wh_name")
                 ->join('warehouse wh', 'hris.warehouse_id = wh.warehouse_id', 'left')
                 ->join('user_level lvl', 'hris.user_level = lvl.level_id', 'left')
                 ->where("hris_nik != '".session()->get('user_id')."'")
                 ->like('hris_name', $search)
                 ->limit($limit, $start)
                 ->orderBy($col, $dir)
                 ->get();
         return $query->getResult();
     }

     public function search_hris_count($search)
     {
         $query = $this->db->table($this->table)
                 ->selectCount($this->primaryKey, 'total')
                //  ->where("hris_id != 'LV001'")
                 ->join('warehouse wh', 'hris.warehouse_id = wh.warehouse_id', 'left')
                 ->join('user_level lvl', 'hris.user_level = lvl.level_id', 'left')
                 ->where("hris_nik != '".session()->get('user_id')."'")
                 ->like('hris_nik', $search)
                 ->like('hris_name', $search)
                 ->get();
         return $query->getRow()->total;
     }

     // end of serverside

    public function get_users()
    {
        $query = $this->db->table('users')->get();
        return $query->getResult();
    }

    public function insert_data($data){
        return $this->db->table($this->table2)->insert($data);
    }

    public function update_data($id, $data)
	{
		$this->db->table($this->table)
		->where($this->primaryKey, $id)
		->update($data);
	}

	public function delete_data($id)
	{
		$this->db->table($this->table2)
                ->where($this->primaryKey, $id)
                ->delete();
	}

	public function checkEmail($email)
    {
        $query = $this->db->table($this->table2)
                ->where('hris_email', $email)
                ->limit(1)
                ->get();
		return $query->getRow();
    }

    public function updateUser($id, $data)
	{
		$this->db->table($this->table2)
                ->where($this->primaryKey, $id)
                ->update($data);
	}

    public function getUserByNik($id)
	{
		$query = $this->db->table($this->table)
                 ->select("hris.hris_nik
                    , hris.hris_name
                    , hris.hris_email
                    , hris.user_level
                    , hris.warehouse_id
                    , hris.hris_status
                    , lvl.level_name
                    , wh.wh_name")
                 ->join('warehouse wh', 'hris.warehouse_id = wh.warehouse_id', 'left')
                 ->join('user_level lvl', 'hris.user_level = lvl.level_id', 'left')
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
		return $query->getRow();
	}
}