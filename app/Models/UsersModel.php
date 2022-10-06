<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class UsersModel extends Model
{
    protected $table = "users";
    protected $primaryKey = 'user_id';
 
    public function __construct()
    {
        parent::__construct();
    }

    // Serverside
    public function all_users($limit, $start, $col, $dir)
    {
        if(session()->get('user_type') == 1){ 
            $query = $this->db->table($this->table)
                    ->select('users.user_id
                                , users.fullname
                                , users.email
                                , users.company
                                , users.phone
                                , users.level_id
                                , users.warehouse_id
                                , users.status
                                , warehouse.wh_name
                                , user_level.level_name')
                    ->join('user_level', 'user_level.level_id=users.level_id', 'left')
                    ->join('warehouse', 'warehouse.warehouse_id=users.warehouse_id', 'left')
                    ->where('owners_id', session()->get('owners_id'))
                    ->where("user_id != '".session()->get('user_id')."'")
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
        } else {
            $query = $this->db->table($this->table)
                    ->select('users.user_id
                                , users.fullname
                                , users.email
                                , users.company
                                , users.phone
                                , users.level_id
                                , users.warehouse_id
                                , users.status
                                , warehouse.wh_name
                                , user_level.level_name
                                , owners.owners_name')
                    ->join('user_level', 'user_level.level_id=users.level_id', 'left')
                    ->join('warehouse', 'warehouse.warehouse_id=users.warehouse_id', 'left')
                    ->join('owners', 'users.owners_id=owners.owners_id', 'left')
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
        }
        return $query->getResult();
    }

    public function all_users_count()
    {
        if(session()->get('user_type') == 1){ 
            $query = $this->db->table($this->table)
                ->where('owners_id', session()->get('owners_id'))
                ->where("user_id != '".session()->get('user_id')."'");
        } else {
            $query = $this->db->table($this->table);
        }
        return $query->countAllResults();
    }

    public function search_users($limit, $start, $search, $col, $dir)
    {
        if(session()->get('user_type') == 1){ 
            $query = $this->db->table($this->table)
                    ->select('users.user_id
                            , users.fullname
                            , users.email
                            , users.company
                            , users.phone
                            , users.level_id
                            , users.warehouse_id
                            , users.status
                            , warehouse.wh_name
                            , user_level.level_name')
                    ->join('user_level', 'user_level.level_id=users.level_id', 'left')
                    ->join('warehouse', 'warehouse.warehouse_id=users.warehouse_id', 'left')
                    ->where('owners_id', session()->get('owners_id'))
                    ->where("user_id != '".session()->get('user_id')."'")
                    ->like('fullname', $search)
                    ->orLike('email', $search)
                    ->orLike('phone', $search)
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
        } else {
            $query = $this->db->table($this->table)
                    ->select('users.user_id
                            , users.fullname
                            , users.email
                            , users.company
                            , users.phone
                            , users.level_id
                            , users.warehouse_id
                            , users.status
                            , warehouse.wh_name
                            , owners.owners_name')
                    ->join('user_level', 'user_level.level_id=users.level_id', 'left')
                    ->join('warehouse', 'warehouse.warehouse_id=users.warehouse_id', 'left')
                    ->join('owners', 'users.owners_id=owners.owners_id', 'left')
                    ->like('fullname', $search)
                    ->orLike('email', $search)
                    ->orLike('phone', $search)
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
        }
        return $query->getResult();
    }

    public function search_users_count($search)
    {
        if(session()->get('user_type') == 1){ 
            $query = $this->db->table($this->table)
                    ->select('users.user_id
                            , users.fullname
                            , users.email
                            , users.company
                            , users.phone
                            , users.level_id
                            , users.warehouse_id
                            , users.status
                            , warehouse.wh_name
                            , user_level.level_name')
                    ->selectCount($this->primaryKey, 'total')
                    ->join('user_level', 'user_level.level_id=users.level_id', 'left')
                    ->join('warehouse', 'warehouse.warehouse_id=users.warehouse_id', 'left')
                    ->where('owners_id', session()->get('owners_id'))
                    ->where("user_id != '".session()->get('user_id')."'")
                    ->like('fullname', $search)
                    ->orLike('email', $search)
                    ->orLike('phone', $search)
                    ->get();
        } else {
            $query = $this->db->table($this->table)
                    ->select('users.user_id
                            , users.fullname
                            , users.email
                            , users.company
                            , users.phone
                            , users.level_id
                            , users.warehouse_id
                            , users.status
                            , warehouse.wh_name
                            , user_level.level_name
                            , owners.owners_name')
                    ->selectCount($this->primaryKey, 'total')
                    ->join('user_level', 'user_level.level_id=users.level_id', 'left')
                    ->join('warehouse', 'warehouse.warehouse_id=users.warehouse_id', 'left')
                    ->join('owners', 'users.owners_id=owners.owners_id', 'left')
                    ->like('fullname', $search)
                    ->orLike('email', $search)
                    ->orLike('phone', $search)
                    ->get();
        }
        return $query->getRow()->total;
    }
    // End Serverside

    public function get_users()
    {
        $query = $this->db->table('users')->get();
        return $query->getResult();
    }

    public function get_users_byid($id)
	{
		$query = $this->db->table($this->table)
		->where($this->primaryKey, $id)
		->limit(1)
		->get();
		return $query->getRow();
	}

    public function generate_id() 
    {
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(user_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(user_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "LOG".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
        //UID21031600002
    }

    public function login($user_email, $user_password)
	{
		$query = $this->db->table($this->table)
		->where('email', $user_email)
		->where('password', $user_password)
		->limit(1)
		->get();
		return $query->getRow();
	}

    public function insert_data($data){
        return $this->db->table($this->table)->insert($data);
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

	public function checkEmail($email)
    {
        $query = $this->db->table($this->table)
                ->where('email', $email)
                ->limit(1)
                ->get();
		return $query->getRow();
    }

    public function updateUser($id, $data)
	{
		$this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->update($data);
	}

    public function getUserById($id)
	{
		$query = $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
		return $query->getRow();
	}
}