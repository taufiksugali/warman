<?php namespace App\Models;

use CodeIgniter\Model;

class AllocationModel extends Model
{
    protected $table = "allocation_plan";
    protected $primaryKey = 'plan_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_id(){
        $lastId = $this->db->table($this->table)
                ->select('MAX(RIGHT(plan_id, 7)) AS last_id')
                ->get();
		$lastMidId = $this->db->table($this->table)
                ->select('MAX(MID(plan_id, 4, 2)) AS last_mid_id')
                ->get()
                ->getRow()
                ->last_mid_id;
		$midId = date('y');
		$char = "PLN".$midId;
		if($lastMidId == $midId){
			$tmp = ($lastId->getRow()->last_id)+1;
			$id = substr($tmp, -5);
		}else{
			$id = "00001";
		}
		return $char.$id;
    }

    // Serverside
    public function all_allocation($limit, $start, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->select('allocation_plan.material_id, material.material_name, customer.customer_name, allocation_plan.plan_qty, uom.uom_name, allocation_plan.plan_date, warehouse.wh_name, allocation_plan.status')
                ->join('customer', 'allocation_plan.customer_id=customer.customer_id')
                ->join('warehouse', 'allocation_plan.wh_tujuan=warehouse.warehouse_id')
                ->join('material', 'allocation_plan.material_id=material.material_id')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function all_allocation_count()
    {
        $query = $this->db->table($this->table)
                ->select('allocation_plan.material_id, material.material_name, customer.customer_name, allocation_plan.plan_qty, uom.uom_name, allocation_plan.plan_date, warehouse.wh_name, allocation_plan.status')
                ->join('customer', 'allocation_plan.customer_id=customer.customer_id')
                ->join('warehouse', 'allocation_plan.wh_tujuan=warehouse.warehouse_id')
                ->join('material', 'allocation_plan.material_id=material.material_id')
                ->join('uom', 'material.mat_uom=uom.uom_id');
        return $query->countAll();
    }

    public function search_allocation($limit, $start, $search, $col, $dir)
    {
        $query = $this->db->table($this->table)
                ->select('allocation_plan.material_id, material.material_name, customer.customer_name, allocation_plan.plan_qty, uom.uom_name, allocation_plan.plan_date, warehouse.wh_name, allocation_plan.status')
                ->join('customer', 'allocation_plan.customer_id=customer.customer_id')
                ->join('warehouse', 'allocation_plan.wh_tujuan=warehouse.warehouse_id')
                ->join('material', 'allocation_plan.material_id=material.material_id')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->like('customer.customer_name', $search)
                ->orLike('material.material_name', $search)
                ->orLike('warehouse.warehouse_name', $search)
                ->orLike('allocation_plan.plan_date', $search)
                ->orLike('allocation_plan.plan_qty', $search)
                ->limit($limit, $start)
                ->orderBy($col, $dir)
                ->get();
        return $query->getResult();
    }

    public function search_customer_count($search)
    {
        $query = $this->db->table($this->table)
                ->selectCount($this->primaryKey, 'total')
                ->select('allocation_plan.material_id, material.material_name, customer.customer_name, allocation_plan.plan_qty, uom.uom_name, allocation_plan.plan_date, warehouse.wh_name, allocation_plan.status')
                ->join('customer', 'allocation_plan.customer_id=customer.customer_id')
                ->join('warehouse', 'allocation_plan.wh_tujuan=warehouse.warehouse_id')
                ->join('material', 'allocation_plan.material_id=material.material_id')
                ->join('uom', 'material.mat_uom=uom.uom_id')
                ->like('customer.customer_name', $search)
                ->orLike('material.material_name', $search)
                ->orLike('warehouse.warehouse_name', $search)
                ->orLike('allocation_plan.plan_date', $search)
                ->orLike('allocation_plan.plan_qty', $search)
                ->get();
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
}
?>