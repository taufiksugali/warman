<?php namespace App\Models;

use CodeIgniter\Model;

class BankModel extends Model
{
    protected $table = "owners_bank";
    protected $primaryKey = 'owners_bank_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_bank(){
        $query = $this->db->table('bank')
                ->where('bank_status', 1)
                ->get();
        return $query->getResult();
    }

    public function get_bank(){
        $query = $this->db->table('bank')
                ->get();
        return $query->getResult();
    }

    public function insert_data($data)
    {
        return $this->db->table($this->table)
                ->insert($data);
    }

    public function get_accountByOwner($owners_id){
        $query = $this->db->table('owners_bank')
                ->select('owners_bank.*, bank.bank_name')
                ->join('bank', 'owners_bank.bank_id=bank.bank_id')
                ->where('owners_id', $owners_id)
                ->get();
        return $query->getResult();
    }

    public function get_bank_byid($id)
    {
        $query = $this->db->table('owners_bank')
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function delete_data($id)
    {
        $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->delete();
    }
}