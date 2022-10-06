<?php namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = "customer";
    protected $primaryKey = 'customer_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(customer_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(customer_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "CUS".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

        // Serverside
        public function all_customer($limit, $start, $col, $dir)
        {
            if(session()->get('user_type')==1){
                $query = $this->db->table($this->table)
                        ->join('state', 'customer.state_id=state.state_id', 'left')
                        ->join('city', 'customer.city_id=city.city_id', 'left')
                        ->where('owners_id', session()->get('owners_id'))
                        ->limit($limit, $start)
                        ->orderBy($col, $dir)
                        ->get();
            } else {
                $query = $this->db->table($this->table)
                        ->join('state', 'customer.state_id=state.state_id', 'left')
                        ->join('city', 'customer.city_id=city.city_id', 'left')
                        ->limit($limit, $start)
                        ->orderBy($col, $dir)
                        ->get();
            }

            return $query->getResult();
        }
    
        public function all_customer_count()
        {
            if(session()->get('user_type')==1){
                $query = $this->db->table($this->table)
                        ->join('state', 'customer.state_id=state.state_id', 'left')
                        ->join('city', 'customer.city_id=city.city_id', 'left')
                        ->where('owners_id', session()->get('owners_id'));
            } else {
                $query = $this->db->table($this->table)
                        ->join('state', 'customer.state_id=state.state_id', 'left')
                        ->join('city', 'customer.city_id=city.city_id', 'left');
            }
            return $query->countAll();
        }
    
        public function search_customer($limit, $start, $search, $col, $dir)
        {
            if(session()->get('user_type')==1){
            $query = $this->db->table($this->table)
                    ->join('state', 'customer.state_id=state.state_id', 'left')
                    ->join('city', 'customer.city_id=city.city_id', 'left')
                    ->where('owners_id', session()->get('owners_id'))
                    ->like('customer_name', $search)
                    ->orLike('customer_address', $search)
                    ->orLike('customer_pic', $search)
                    ->orLike('customer_phone', $search)
                    ->orLike('customer_email', $search)
                    ->limit($limit, $start)
                    ->orderBy($col, $dir)
                    ->get();
            } else {
                $query = $this->db->table($this->table)
                        ->join('state', 'customer.state_id=state.state_id', 'left')
                        ->join('city', 'customer.city_id=city.city_id', 'left')
                        ->like('customer_name', $search)
                        ->orLike('customer_address', $search)
                        ->orLike('customer_pic', $search)
                        ->orLike('customer_phone', $search)
                        ->orLike('customer_email', $search)
                        ->limit($limit, $start)
                        ->orderBy($col, $dir)
                        ->get();
            }
            return $query->getResult();
        }
    
        public function search_customer_count($search)
        {
            if(session()->get('user_type')==1){
                $query = $this->db->table($this->table)
                        ->selectCount($this->primaryKey, 'total')
                        ->join('state', 'customer.state_id=state.state_id', 'left')
                        ->join('city', 'customer.city_id=city.city_id', 'left')
                        ->where('owners_id', session()->get('owners_id'))
                        ->like('customer_name', $search)
                        ->orLike('customer_address', $search)
                        ->orLike('customer_pic', $search)
                        ->orLike('customer_phone', $search)
                        ->orLike('customer_email', $search)
                        ->get();
            } else {
                $query = $this->db->table($this->table)
                        ->selectCount($this->primaryKey, 'total')
                        ->join('state', 'customer.state_id=state.state_id', 'left')
                        ->join('city', 'customer.city_id=city.city_id', 'left')
                        ->like('customer_name', $search)
                        ->orLike('customer_address', $search)
                        ->orLike('customer_pic', $search)
                        ->orLike('customer_phone', $search)
                        ->orLike('customer_email', $search)
                        ->get();
            }
            return $query->getRow()->total;
        }
        // End Serverside
    
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

    public function get_customer_byid($id)
    {
        $query = $this->db->table($this->table)
                ->where($this->primaryKey, $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_customer_byphone($id)
    {
        $query = $this->db->table($this->table)
                ->where('customer_phone', $id)
                ->limit(1)
                ->get();
        return $query->getRow();
    }

    public function get_all_customer(){
        if(session()->get('user_type')==1){
            $query = $this->db->table($this->table)
                    ->where('status', 1)
                    ->where('owners_id', session()->get('owners_id'))
                    ->get();
        } else {
            $query = $this->db->table($this->table)
                    ->where('status', 1)
                    ->get();
        }
        return $query->getResult();
    }

    public function get_city_name($regency_id)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://hris.poslogistics.co.id/api/Hris_Api/getByidRegency?token=0a05252241f3bc45ffc4abaeca369963&id='.$regency_id.'&param=regency_id');
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result     = curl_exec ($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $dataObject = json_decode($result);
        
        return $dataObject->data[0]->regency_name .', '. $dataObject->data[0]->province_name;
    }

    public function get_office_name($office_id){
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://tiana.poslogistics.co.id/tms-cl/index.php/api/Office/getByidBranchOffice?token=0a05252241f3bc45ffc4abaeca369963&id='. $office_id);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result     = curl_exec ($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $dataObject = json_decode($result);
        
        return $dataObject->data[0]->office_name;
    }
}
?>