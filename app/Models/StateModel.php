<?php namespace App\Models;

use CodeIgniter\Model;

class StateModel extends Model
{
    protected $table = "state";
    protected $primaryKey = 'state_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function getState()
	{
		$query = $this->db->table('state')
                ->where('state_status', '1')
                ->get();
		return $query->getResult();
	}

    public function getStateById($state_id)
	{
		$query = $this->db->table('state')
                ->where('state_id', $state_id)
                ->limit(1)
                ->get();
		return $query->getRow();
	}

    public function getCity($state_id)
	{
		$query = $this->db->table('city')
                ->where('state_id', $state_id)
                ->where('city_status', '1')
                ->get();
		return $query->getResult();
	}
    
    public function getCityById($city)
	{
		$query = $this->db->table('city')
                ->where('city_id', $city)
                ->limit(1)
                ->get();
		return $query->getRow();
	}

    public function getDistrict($city_id)
	{
		$query = $this->db->table('district')
                ->where('city_id', $city_id)
                ->where('district_status', '1')
                ->get();
		return $query->getResult();
	}

    public function getDistrictById($district_id)
	{
		$query = $this->db->table('district')
                ->where('district_id', $district_id)
                ->where('district_status', '1')
                ->limit(1)
                ->get();
		return $query->getRow();
	}
    
    public function getSubDistrict($district_id)
	{
		$query = $this->db->table('sub_district')
                ->where('district_id', $district_id)
                ->where('sdistrict_status', '1')
                ->get();
		return $query->getResult();
	}
    
    public function getSubDistrictById($sdistrict_id)
	{
		$query = $this->db->table('sub_district')
                ->where('sdistrict_id', $sdistrict_id)
                ->where('sdistrict_status', '1')
                ->limit(1)
                ->get();
		return $query->getRow();
	}

    public function getAllByZipCode($zip_code){
        $query = $this->db->table('sub_district sd')
                ->select('sd.sdistrict_id, sd.district_id, d.city_id, c.state_id')
                ->join('district d', 'sd.district_id=d.district_id')
                ->join('city c', 'd.city_id=c.city_id')
                ->where('sd.zip_code', $zip_code)
                ->where('sd.sdistrict_status', '1')
                ->limit(1)
                ->get();
		return $query->getRow();
    }
    
}
?>