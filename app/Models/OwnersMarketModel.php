<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class OwnersMarketModel extends Model
{
    protected $table = "owners_market";
    protected $primaryKey = 'owners_market_id';
 
    public function __construct()
    {
        parent::__construct();
    }

    // Serverside
    public function all_market($limit, $start, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->join('marketplace', 'owners_market.market_id=market.market_id', 'left')
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function all_market_count()
    {
        $query = $this->db->table($this->table);
        return $query->countAllResults();
    }

    public function search_market($limit, $start, $search, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->join('marketplace', 'owners_market.market_id=market.market_id', 'left')
                ->like('market_name', $search)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function search_market_count($search)
    {
        $query = $this->db->table($this->table)
                ->join('marketplace', 'owners_market.market_id=market.market_id', 'left')
                ->selectCount($this->primaryKey, 'total')
                ->like('market_name', $search)
                ->get();
        return $query->getRow()->total;
    }
    // End Serverside

    public function get_all_market(){
        $query = $this->db->table($this->table)
                ->where('status', 1)
                ->get();
        return $query->getResult();
    }

    public function get_market_byid($id)
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

    //-- mengambil data master marketplace
    public function get_all_marketplace(){
        $query = $this->db->table('marketplace')
                ->where('status', 1)
                ->get();
        return $query->getResult();
    }
    //----
    
    public function get_owner_markets($owners_id){
        $query = $this->db->table($this->table)
                ->join('marketplace', 'owners_market.market_id=marketplace.market_id', 'left')
                ->where('owners_id', $owners_id)
                ->get();
        return $query->getResult();
    }
    
    public function total_seller(){
        $query = $this->db->table($this->table)
                        ->select('count(`owners_id`) AS total_seller')
                        ->get();
        return $query->getResult();
    }
}
?>