<?php namespace App\Models;

use CodeIgniter\Model;

class AgreementModel extends Model
{
    protected $table = "owners_agreement";
    protected $primaryKey = 'agreement_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_agreement($owners_id){
        $query = $this->db->table($this->table)
                ->where('owners_id', $owners_id)
                ->get();
        return $query->getResult();
    }

    public function get_agreement_byId($id){
        $query = $this->db->table($this->table)
                ->where('agreement_id', $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function insert_data($data)
    {
        return $this->db->table($this->table)
                ->insert($data);
    }

    public function delete_data($id)
    {
        $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->delete();
    }

    public function update_data($id, $data)
	{
		$this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->update($data);
	}
}