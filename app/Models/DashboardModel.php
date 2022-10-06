<?php namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $table = "material_detail";
    protected $matDetail = "material_detail";
    protected $primaryKey = 'mat_detail_id';

    public function __construct()
    {
        parent::__construct();
    }

	public function get_warehouse_by_owner(){
		$owner_id = session()->get('owners_id');

		$sql = "SELECT 
					w.warehouse_id, 
					w.wh_name,
					SUM(ws.stock_ok)  AS stock_ok, 
					SUM(ws.stock_nok) AS stock_nok
				FROM material_detail md
				JOIN warehouse_soh ws ON md.mat_detail_id=ws.mat_detail_id
				JOIN inbound_detail id ON md.mat_detail_id=id.material_detail_id
				JOIN inbound i ON id.inbound_id=i.inbound_id
				JOIN warehouse w ON i.inbound_location=w.warehouse_id
				JOIN material m ON md.material_id=m.material_id
				JOIN purchase_order po ON i.inbound_po=po.po_id
				WHERE po.owners_id = '$owner_id'
				AND (stock_ok >0 or stock_nok >0)
				GROUP BY w.warehouse_id
				";
		$res = $this->db->query($sql);
		return $res->getResultArray();
       
    }

	public function get_data_by_owner($limit, $start, $search, $col, $dir, $wh_id){
		$owner_id = session()->get('owners_id');

		$whereWH = "";
		if(!empty($wh_id)) $whereWH = " AND w.warehouse_id='$wh_id'";

		$whereSearch = "";
		if(!empty($search)) $whereSearch = " AND (w.wh_name LIKE '%$search%' or md.material_id LIKE '%$search%' or m.material_name LIKE '%$search%')";

		$orderBy = "ORDER BY w.warehouse_id ASC, md.material_id ASC ";
		if (!empty($order)) $orderBy = " ORDER BY ".$col." ".$dir." ";

		$limitFilter = "";
		if ($limit!='-1') $limitFilter = " LIMIT ".$start.", ".$limit." ";

		$sql = "SELECT 
					w.warehouse_id, 
					w.wh_name, 
					md.material_id, 
					m.material_name, 
					(SELECT SUM(pod.qty_good) AS reserved_qty FROM po_out_detail pod 
												JOIN po_outbound po ON pod.po_outbound_id = po.po_outbound_id
												WHERE po.po_out_status = 1 AND pod.material_id = md.material_id) AS reserved_qty, 
					SUM(ws.stock_ok)  AS stock_ok, 
					SUM(ws.stock_nok) AS stock_nok
				FROM material_detail md
				JOIN warehouse_soh ws ON md.mat_detail_id=ws.mat_detail_id
				JOIN inbound_detail id ON md.mat_detail_id=id.material_detail_id
				JOIN inbound i ON id.inbound_id=i.inbound_id
				JOIN warehouse w ON i.inbound_location=w.warehouse_id
				JOIN material m ON md.material_id=m.material_id
				JOIN purchase_order po ON i.inbound_po=po.po_id
				WHERE po.owners_id = '$owner_id'
				AND (stock_ok >0 or stock_nok >0)
				$whereWH
				$whereSearch
				GROUP BY w.warehouse_id,md.material_id
				$orderBy
				$limitFilter
				";
		$res = $this->db->query($sql);
		return $res->getResult();
       
    }

	public function get_data_by_owner_count($search="",$wh_id=""){
		$owner_id = session()->get('owners_id');

		$whereWH = "";
		if(!empty($wh_id)) $whereWH = " AND w.warehouse_id='$wh_id'";

		$whereSearch = "";
		if(!empty($search)) $whereSearch = " AND (w.wh_name LIKE '%$search%' or md.material_id LIKE '%$search%' or m.material_name LIKE '%$search%')";

		$sql = "SELECT 
					w.warehouse_id, 
					w.wh_name, 
					md.material_id, 
					m.material_name, 
					(SELECT SUM(pod.qty_good) AS reserved_qty FROM po_out_detail pod 
												JOIN po_outbound po ON pod.po_outbound_id = po.po_outbound_id
												WHERE po.po_out_status = 1 AND pod.material_id = md.material_id) AS reserved_qty, 
					SUM(ws.stock_ok)  AS stock_ok, 
					SUM(ws.stock_nok) AS stock_nok
				FROM material_detail md
				JOIN warehouse_soh ws ON md.mat_detail_id=ws.mat_detail_id
				JOIN inbound_detail id ON md.mat_detail_id=id.material_detail_id
				JOIN inbound i ON id.inbound_id=i.inbound_id
				JOIN warehouse w ON i.inbound_location=w.warehouse_id
				JOIN material m ON md.material_id=m.material_id
				JOIN purchase_order po ON i.inbound_po=po.po_id
				WHERE po.owners_id = '$owner_id'
				AND (stock_ok >0 or stock_nok >0)
				$whereWH
				$whereSearch
				GROUP BY w.warehouse_id, md.material_id
				";
		$res = $this->db->query($sql);
		return $res->getNumRows();
       
    }

    public function get_soh(){
        $query = $this->db->table($this->matDetail)
        ->select('`warehouse`.`warehouse_id`,
                  `warehouse`.`wh_name`,
                  `material_detail`.`material_id`, 
                  `material`.`material_name`,
                  SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                  SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
        ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
        ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
        ->join('material', 'material_detail.material_id=material.material_id')
        ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
        ->where('purchase_order.owners_id', session()->get('owners_id'))
        ->where('stock_ok > 0')
        ->orwhere('stock_nok > 0')
        ->groupBy('`material_detail`.`material_id`')
        ->get();
        return $query->getResult();
    }
    public function all_soh($owner, $limit, $start, $col, $dir){
        $filter_owner = null;

        if(@$owner){
            $filter_owner = " AND material.owners_id='$owner'";
        }
        
        $cond = "warehouse.warehouse_id != '' $filter_owner";
        if(session()->get('warehouse_id') == "POSLOG"){
                if($filter_owner != null){
                        $query = $this->db->table($this->matDetail)
                        ->select('`warehouse`.`warehouse_id`,
                                `warehouse`.`wh_name`,
                                `material_detail`.`material_id`, 
                                `material`.`material_name`,
                                (SELECT SUM(pod.`qty_good`) AS reserved_qty FROM po_out_detail pod 
                                                JOIN po_outbound po ON pod.`po_outbound_id` = po.`po_outbound_id`
                                                WHERE po.`po_out_status` = 1 AND pod.`material_id` = `material_detail`.`material_id`) AS reserved_qty,
                                SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                        ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                        ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where($cond)
                        ->where('(stock_ok > 0 or stock_nok > 0)')
                        ->limit($limit, $start)
                        ->groupBy('`material_detail`.`material_id`')
                        ->orderBy($col, $dir)
                        ->get();
                        return $query->getResult();
                } else {
                        $query = $this->db->table($this->matDetail)
                        ->select('`warehouse`.`warehouse_id`,
                                `warehouse`.`wh_name`,
                                `material_detail`.`material_id`, 
                                `material`.`material_name`,
                                (SELECT SUM(pod.`qty_good`) AS reserved_qty FROM po_out_detail pod 
                                                JOIN po_outbound po ON pod.`po_outbound_id` = po.`po_outbound_id`
                                                WHERE po.`po_out_status` = 1 AND pod.`material_id` = `material_detail`.`material_id`) AS reserved_qty,
                                SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                        ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                        ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('stock_ok > 0')
                        ->orwhere('stock_nok > 0')
                        ->limit($limit, $start)
                        ->groupBy('`material_detail`.`material_id`')
                        ->orderBy($col, $dir)
                        ->get();
                        return $query->getResult();
                }
            
        } elseif(session()->get('user_type') == 1){
            $query = $this->db->table($this->matDetail)
                ->select('`warehouse`.`warehouse_id`,
                          `warehouse`.`wh_name`,
                          `material_detail`.`material_id`, 
                          `material`.`material_name`,
                          (SELECT SUM(pod.`qty_good`) AS reserved_qty FROM po_out_detail pod 
                                        JOIN po_outbound po ON pod.`po_outbound_id` = po.`po_outbound_id`
                                        WHERE po.`po_out_status` = 1 AND pod.`material_id` = `material_detail`.`material_id`) AS reserved_qty,
                          SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                          SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                ->where('purchase_order.owners_id', session()->get('owners_id'))
                ->where('(stock_ok > 0 or stock_nok > 0)')
                ->limit($limit, $start)
                ->groupBy('`material_detail`.`material_id`')
                ->orderBy($col, $dir)
                ->get();
                return $query->getResult();
        } else {
                if($filter_owner != null){
                        $query = $this->db->table($this->matDetail)
                            ->select('`warehouse`.`warehouse_id`,
                                      `warehouse`.`wh_name`,
                                      `material_detail`.`material_id`, 
                                      `material`.`material_name`,
                                      (SELECT SUM(pod.`qty_good`) AS reserved_qty FROM po_out_detail pod 
                                                    JOIN po_outbound po ON pod.`po_outbound_id` = po.`po_outbound_id`
                                                    WHERE po.`po_out_status` = 1 AND pod.`material_id` = `material_detail`.`material_id` AND po.`warehouse_id` = "'.@session()->get('warehouse_id').'") AS reserved_qty,
                                      SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                      SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                            ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                            ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                            ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                            ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                            ->join('material', 'material_detail.material_id=material.material_id')
                            ->where($cond)
                            ->where('inbound.inbound_location', session()->get('warehouse_id'))
                            ->where('(stock_ok > 0 or stock_nok > 0)')
                            ->limit($limit, $start)
                            ->groupBy('`material_detail`.`material_id`')
                            ->orderBy($col, $dir)
                            ->get();
                            return $query->getResult();
                } else {
                        $query = $this->db->table($this->matDetail)
                            ->select('`warehouse`.`warehouse_id`,
                                      `warehouse`.`wh_name`,
                                      `material_detail`.`material_id`, 
                                      `material`.`material_name`,
                                      (SELECT SUM(pod.`qty_good`) AS reserved_qty FROM po_out_detail pod 
                                                    JOIN po_outbound po ON pod.`po_outbound_id` = po.`po_outbound_id`
                                                    WHERE po.`po_out_status` = 1 AND pod.`material_id` = `material_detail`.`material_id` AND po.`warehouse_id` = "'.@session()->get('warehouse_id').'") AS reserved_qty,
                                      SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                      SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                            ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                            ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                            ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                            ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                            ->join('material', 'material_detail.material_id=material.material_id')
                            ->where('inbound.inbound_location', session()->get('warehouse_id'))
                            ->where('(stock_ok > 0 or stock_nok > 0)')
                            ->limit($limit, $start)
                            ->groupBy('`material_detail`.`material_id`')
                            ->orderBy($col, $dir)
                            ->get();
                            return $query->getResult();
                }
        }
    }

    public function all_soh_count($owner){
        $filter_owner = null;
        
        if(@$owner){
            $filter_owner = " AND material.owners_id='$owner'";
        }
        
        $cond = "warehouse.warehouse_id != '' $filter_owner";
        if(session()->get('warehouse_id') == "POSLOG"){
                if($filter_owner != null){
                        $query = $this->db->table($this->matDetail)
                                        ->select('`warehouse`.`warehouse_id`,
                                        `warehouse`.`wh_name`,
                                        `material_detail`.`material_id`, 
                                        `material`.`material_name`,
                                        (SELECT SUM(pod.`qty_good`) AS reserved_qty FROM po_out_detail pod 
                                                        JOIN po_outbound po ON pod.`po_outbound_id` = po.`po_outbound_id`
                                                        WHERE po.`po_out_status` = 1 AND pod.`material_id` = `material_detail`.`material_id`) AS reserved_qty,
                                        SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                        SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                                ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                                ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                                ->join('material', 'material_detail.material_id=material.material_id')
                                ->where($cond)
                                ->where('(stock_ok > 0 or stock_nok > 0)')
                                ->groupBy('`material_detail`.`material_id`');
                                return $query->countAllResults();
                } else {
                        $query = $this->db->table($this->matDetail)
                                        ->select('`warehouse`.`warehouse_id`,
                                        `warehouse`.`wh_name`,
                                        `material_detail`.`material_id`, 
                                        `material`.`material_name`,
                                        (SELECT SUM(pod.`qty_good`) AS reserved_qty FROM po_out_detail pod 
                                                        JOIN po_outbound po ON pod.`po_outbound_id` = po.`po_outbound_id`
                                                        WHERE po.`po_out_status` = 1 AND pod.`material_id` = `material_detail`.`material_id`) AS reserved_qty,
                                        SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                        SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                                ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                                ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                                ->join('material', 'material_detail.material_id=material.material_id')
                                ->where('stock_ok > 0')
                                ->orwhere('stock_nok > 0')
                                ->groupBy('`material_detail`.`material_id`');
                                return $query->countAllResults();
                }
        } elseif(session()->get('user_type') == 1){
            $query = $this->db->table($this->matDetail)
                    ->select('`warehouse`.`warehouse_id`,
                            `warehouse`.`wh_name`,
                            `material_detail`.`material_id`, 
                            `material`.`material_name`,
                            (SELECT SUM(pod.`qty_good`) AS reserved_qty FROM po_out_detail pod 
                                        JOIN po_outbound po ON pod.`po_outbound_id` = po.`po_outbound_id`
                                        WHERE po.`po_out_status` = 1 AND pod.`material_id` = `material_detail`.`material_id`) AS reserved_qty,
                            SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                            SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                    ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                    ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                    ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('material', 'material_detail.material_id=material.material_id')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->where('purchase_order.owners_id', session()->get('owners_id'))
                    ->where('(stock_ok > 0 or stock_nok > 0)')
                    ->groupBy('`material_detail`.`material_id`');
                    return $query->countAllResults();
        } else {
                if($filter_owner != null){
                        $query = $this->db->table($this->matDetail)
                                ->select('`warehouse`.`warehouse_id`,
                                        `warehouse`.`wh_name`,
                                        `material_detail`.`material_id`, 
                                        `material`.`material_name`,
                                        (SELECT SUM(pod.`qty_good`) AS reserved_qty FROM po_out_detail pod 
                                                JOIN po_outbound po ON pod.`po_outbound_id` = po.`po_outbound_id`
                                                WHERE po.`po_out_status` = 1 AND pod.`material_id` = `material_detail`.`material_id` AND po.`warehouse_id` = "'.@session()->get('warehouse_id').'") AS reserved_qty,
                                        SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                        SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                                ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                                ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                                ->join('material', 'material_detail.material_id=material.material_id')
                                ->where($cond)
                                ->where('inbound.inbound_location', session()->get('warehouse_id'))
                                ->where('(stock_ok > 0 or stock_nok > 0)')
                                ->groupBy('`material_detail`.`material_id`');
                                return $query->countAllResults();
                } else {
                        $query = $this->db->table($this->matDetail)
                                ->select('`warehouse`.`warehouse_id`,
                                        `warehouse`.`wh_name`,
                                        `material_detail`.`material_id`, 
                                        `material`.`material_name`,
                                        (SELECT SUM(pod.`qty_good`) AS reserved_qty FROM po_out_detail pod 
                                                JOIN po_outbound po ON pod.`po_outbound_id` = po.`po_outbound_id`
                                                WHERE po.`po_out_status` = 1 AND pod.`material_id` = `material_detail`.`material_id` AND po.`warehouse_id` = "'.@session()->get('warehouse_id').'") AS reserved_qty,
                                        SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                        SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                                ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                                ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                                ->join('material', 'material_detail.material_id=material.material_id')
                                ->where('inbound.inbound_location', session()->get('warehouse_id'))
                                ->where('stock_ok > 0')
                                ->orwhere('stock_nok > 0')
                                ->groupBy('`material_detail`.`material_id`');
                                return $query->countAllResults();
                }
        }
    }

    public function search_soh($owner, $limit, $start, $search, $col, $dir){
        $filter_owner = null;
        
        if(@$owner){
            $filter_owner = " AND material.owners_id='$owner'";
        }
        
        $cond = "warehouse.warehouse_id != '' $filter_owner";
        if(session()->get('warehouse_id') == "POSLOG"){
                if($filter_owner != null){
                        $query = $this->db->table($this->matDetail)
                                ->select('`warehouse`.`warehouse_id`,
                                        `warehouse`.`wh_name`,
                                        `material_detail`.`material_id`, 
                                        `material`.`material_name`,
                                        (SELECT SUM(pod.`qty_good`) AS reserved_qty FROM po_out_detail pod 
                                                        JOIN po_outbound po ON pod.`po_outbound_id` = po.`po_outbound_id`
                                                        WHERE po.`po_out_status` = 1 AND pod.`material_id` = `material_detail`.`material_id`) AS reserved_qty,
                                        SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                        SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                                ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                                ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                                ->join('material', 'material_detail.material_id=material.material_id')
                                ->like('warehouse.wh_name', $search)
                                ->orLike('material_detail.material_id', $search)
                                ->orLike('material.material_name', $search)
                                ->orLike('stock_ok', $search)
                                ->orLike('stock_nok', $search)
                                ->where($cond)
                                ->where('(stock_ok > 0 or stock_nok > 0)')
                                ->limit($limit, $start)
                                ->groupBy('`material_detail`.`material_id`')
                                ->orderBy($col, $dir)
                                ->get();
                                return $query->getResult();
                } else {
                        $query = $this->db->table($this->matDetail)
                                ->select('`warehouse`.`warehouse_id`,
                                        `warehouse`.`wh_name`,
                                        `material_detail`.`material_id`, 
                                        `material`.`material_name`,
                                        (SELECT SUM(pod.`qty_good`) AS reserved_qty FROM po_out_detail pod 
                                                        JOIN po_outbound po ON pod.`po_outbound_id` = po.`po_outbound_id`
                                                        WHERE po.`po_out_status` = 1 AND pod.`material_id` = `material_detail`.`material_id`) AS reserved_qty,
                                        SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                        SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                                ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                                ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                                ->join('material', 'material_detail.material_id=material.material_id')
                                ->like('warehouse.wh_name', $search)
                                ->orLike('material_detail.material_id', $search)
                                ->orLike('material.material_name', $search)
                                ->orLike('stock_ok', $search)
                                ->orLike('stock_nok', $search)
                                ->where('stock_ok > 0')
                                ->orwhere('stock_nok > 0')
                                ->limit($limit, $start)
                                ->groupBy('`material_detail`.`material_id`')
                                ->orderBy($col, $dir)
                                ->get();
                                return $query->getResult();

                }
            } elseif(session()->get('user_type') == 1){ 
                $query = $this->db->table($this->matDetail)
                        ->select('`warehouse`.`warehouse_id`,
                                  `warehouse`.`wh_name`,
                                  `material_detail`.`material_id`, 
                                  `material`.`material_name`,
                                  (SELECT SUM(pod.`qty_good`) AS reserved_qty FROM po_out_detail pod 
                                        JOIN po_outbound po ON pod.`po_outbound_id` = po.`po_outbound_id`
                                        WHERE po.`po_out_status` = 1 AND pod.`material_id` = `material_detail`.`material_id`) AS reserved_qty,
                                  SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                  SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                        ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                        ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                        ->like('warehouse.wh_name', $search)
                        ->orLike('material_detail.material_id', $search)
                        ->orLike('material.material_name', $search)
                        ->orLike('stock_ok', $search)
                        ->orLike('stock_nok', $search)
                        ->where('purchase_order.owners_id', session()->get('owners_id'))
                        ->where('(stock_ok > 0 or stock_nok > 0)')
                        ->limit($limit, $start)
                        ->groupBy('`material_detail`.`material_id`')
                        ->orderBy($col, $dir)
                        ->get();
                        return $query->getResult();
            } else {
                if($filter_owner != null){
                        $query = $this->db->table($this->matDetail)
                                ->select('`warehouse`.`warehouse_id`,
                                        `warehouse`.`wh_name`,
                                        `material_detail`.`material_id`, 
                                        `material`.`material_name`,
                                        (SELECT SUM(pod.`qty_good`) AS reserved_qty FROM po_out_detail pod 
                                                JOIN po_outbound po ON pod.`po_outbound_id` = po.`po_outbound_id`
                                                WHERE po.`po_out_status` = 1 AND pod.`material_id` = `material_detail`.`material_id` AND po.`warehouse_id` = "'.@session()->get('warehouse_id').'") AS reserved_qty,
                                        SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                        SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                                ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                                ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                                ->join('material', 'material_detail.material_id=material.material_id')
                                ->like('warehouse.wh_name', $search)
                                ->orLike('material_detail.material_id', $search)
                                ->orLike('material.material_name', $search)
                                ->orLike('stock_ok', $search)
                                ->orLike('stock_nok', $search)
                                ->where($cond)
                                ->where('inbound.inbound_location', session()->get('warehouse_id'))
                                ->where('(stock_ok > 0 or stock_nok > 0)')
                                ->limit($limit, $start)
                                ->groupBy('`material_detail`.`material_id`')
                                ->orderBy($col, $dir)
                                ->get();
                                return $query->getResult();
                } else {
                        $query = $this->db->table($this->matDetail)
                                ->select('`warehouse`.`warehouse_id`,
                                        `warehouse`.`wh_name`,
                                        `material_detail`.`material_id`, 
                                        `material`.`material_name`,
                                        (SELECT SUM(pod.`qty_good`) AS reserved_qty FROM po_out_detail pod 
                                                JOIN po_outbound po ON pod.`po_outbound_id` = po.`po_outbound_id`
                                                WHERE po.`po_out_status` = 1 AND pod.`material_id` = `material_detail`.`material_id` AND po.`warehouse_id` = "'.@session()->get('warehouse_id').'") AS reserved_qty,
                                        SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                        SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                                ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                                ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                                ->join('material', 'material_detail.material_id=material.material_id')
                                ->like('warehouse.wh_name', $search)
                                ->orLike('material_detail.material_id', $search)
                                ->orLike('material.material_name', $search)
                                ->orLike('stock_ok', $search)
                                ->orLike('stock_nok', $search)
                                ->where('inbound.inbound_location', session()->get('warehouse_id'))
                                ->where('(stock_ok > 0 or stock_nok > 0)')
                                ->limit($limit, $start)
                                ->groupBy('`material_detail`.`material_id`')
                                ->orderBy($col, $dir)
                                ->get();
                                return $query->getResult();

                }
            }
    }
    
    public function search_soh_count($owner, $search){
        $filter_owner = null;
        
        if(@$owner){
            $filter_owner = " AND material.owners_id='$owner'";
        }
        
        $cond = "warehouse.warehouse_id != '' $filter_owner";
        if(session()->get('warehouse_id') == "POSLOG"){
                if($filter_owner != null){
                        $query = $this->db->table($this->matDetail)
                                ->select('`warehouse`.`warehouse_id`,
                                        `warehouse`.`wh_name`,
                                        `material_detail`.`material_id`, 
                                        `material`.`material_name`,
                                        (SELECT SUM(pod.`qty_good`) AS reserved_qty FROM po_out_detail pod 
                                                        JOIN po_outbound po ON pod.`po_outbound_id` = po.`po_outbound_id`
                                                        WHERE po.`po_out_status` = 1 AND pod.`material_id` = `material_detail`.`material_id`) AS reserved_qty,
                                        SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                        SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                                ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                                ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                                ->join('material', 'material_detail.material_id=material.material_id')
                                ->like('warehouse.wh_name', $search)
                                ->orLike('material_detail.material_id', $search)
                                ->orLike('material.material_name', $search)
                                ->orLike('stock_ok', $search)
                                ->orLike('stock_nok', $search)
                                ->where($cond)
                                ->where('(stock_ok > 0 or stock_nok > 0)')
                                ->groupBy('`material_detail`.`material_id`');
                                return $query->countAllResults();
                } else {
                        $query = $this->db->table($this->matDetail)
                                ->select('`warehouse`.`warehouse_id`,
                                        `warehouse`.`wh_name`,
                                        `material_detail`.`material_id`, 
                                        `material`.`material_name`,
                                        (SELECT SUM(pod.`qty_good`) AS reserved_qty FROM po_out_detail pod 
                                                        JOIN po_outbound po ON pod.`po_outbound_id` = po.`po_outbound_id`
                                                        WHERE po.`po_out_status` = 1 AND pod.`material_id` = `material_detail`.`material_id`) AS reserved_qty,
                                        SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                        SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                                ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                                ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                                ->join('material', 'material_detail.material_id=material.material_id')
                                ->like('warehouse.wh_name', $search)
                                ->orLike('material_detail.material_id', $search)
                                ->orLike('material.material_name', $search)
                                ->orLike('stock_ok', $search)
                                ->orLike('stock_nok', $search)
                                ->where('(stock_ok > 0 or stock_nok > 0)')
                                ->groupBy('`material_detail`.`material_id`');
                                return $query->countAllResults();

                }
        } elseif(session()->get('user_type') == 1){ 
            $query = $this->db->table($this->matDetail)
                    ->select('`warehouse`.`warehouse_id`,
                            `warehouse`.`wh_name`,
                            `material_detail`.`material_id`, 
                            `material`.`material_name`,
                            (SELECT SUM(pod.`qty_good`) AS reserved_qty FROM po_out_detail pod 
                                        JOIN po_outbound po ON pod.`po_outbound_id` = po.`po_outbound_id`
                                        WHERE po.`po_out_status` = 1 AND pod.`material_id` = `material_detail`.`material_id`) AS reserved_qty,
                            SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                            SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                    ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                    ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                    ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('material', 'material_detail.material_id=material.material_id')
                    ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                    ->like('warehouse.wh_name', $search)
                    ->orLike('material_detail.material_id', $search)
                    ->orLike('material.material_name', $search)
                    ->orLike('stock_ok', $search)
                    ->orLike('stock_nok', $search)
                    ->where('purchase_order.owners_id', session()->get('owners_id'))
                    ->where('(stock_ok > 0 or stock_nok > 0)')
                    ->groupBy('`material_detail`.`material_id`');
                    return $query->countAllResults();
        } else {
                if($filter_owner != null){
                        $query = $this->db->table($this->matDetail)
                                ->select('`warehouse`.`warehouse_id`,
                                        `warehouse`.`wh_name`,
                                        `material_detail`.`material_id`, 
                                        `material`.`material_name`,
                                        (SELECT SUM(pod.`qty_good`) AS reserved_qty FROM po_out_detail pod 
                                                        JOIN po_outbound po ON pod.`po_outbound_id` = po.`po_outbound_id`
                                                        WHERE po.`po_out_status` = 1 AND pod.`material_id` = `material_detail`.`material_id` AND po.`warehouse_id` = "'.@session()->get('warehouse_id').'") AS reserved_qty,
                                        SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                        SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                                ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                                ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                                ->join('material', 'material_detail.material_id=material.material_id')
                                ->like('warehouse.wh_name', $search)
                                ->orLike('material_detail.material_id', $search)
                                ->orLike('material.material_name', $search)
                                ->orLike('stock_ok', $search)
                                ->orLike('stock_nok', $search)
                                ->where($cond)
                                ->where('inbound.inbound_location', session()->get('warehouse_id'))
                                ->where('(stock_ok > 0 or stock_nok > 0)')
                                ->groupBy('`material_detail`.`material_id`');
                                return $query->countAllResults();
                } else {
                        $query = $this->db->table($this->matDetail)
                                ->select('`warehouse`.`warehouse_id`,
                                        `warehouse`.`wh_name`,
                                        `material_detail`.`material_id`, 
                                        `material`.`material_name`,
                                        (SELECT SUM(pod.`qty_good`) AS reserved_qty FROM po_out_detail pod 
                                                        JOIN po_outbound po ON pod.`po_outbound_id` = po.`po_outbound_id`
                                                        WHERE po.`po_out_status` = 1 AND pod.`material_id` = `material_detail`.`material_id` AND po.`warehouse_id` = "'.@session()->get('warehouse_id').'") AS reserved_qty,
                                        SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                        SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                                ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                                ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                                ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                                ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                                ->join('material', 'material_detail.material_id=material.material_id')
                                ->like('warehouse.wh_name', $search)
                                ->orLike('material_detail.material_id', $search)
                                ->orLike('material.material_name', $search)
                                ->orLike('stock_ok', $search)
                                ->orLike('stock_nok', $search)
                                ->where('inbound.inbound_location', session()->get('warehouse_id'))
                                ->where('(stock_ok > 0 or stock_nok > 0)')
                                ->groupBy('`material_detail`.`material_id`');
                                return $query->countAllResults();

                }
        }
    }

    public function total_admin_fee(){
        if(session()->get('warehouse_id') == "POSLOG"){
                $query = $this->db->table('owners_bill')
                                ->select('SUM(`amount`) AS admin_fee')
                                ->where('description', 'ADMIN FEE')
                                ->where('bill_status', 0)
                                ->get();
        } elseif(session()->get('user_type') == 1){ 
                $query = $this->db->table('owners_bill')
                                ->select('SUM(`amount`) AS admin_fee')
                                ->where('description', 'ADMIN FEE')
                                ->where('owners_id', session()->get('owners_id'))
                                ->where('bill_status', 0)
                                ->get();
        } else {
                $query = $this->db->table('owners_bill')
                                ->select('SUM(`amount`) AS admin_fee')
                                ->join('po_outbound', 'owners_bill.po_id = po_outbound.po_outbound_id')
                                ->where('po_outbound.warehouse_id', @session()->get('warehouse_id'))
                                ->where('owners_bill.description', 'ADMIN FEE')
                                ->where('owners_bill.bill_status', 0)
                                ->get();
        }
        return $query->getResult();
    }

    public function total_biaya_kurir(){
        if(session()->get('warehouse_id') == "POSLOG"){
                $query = $this->db->table('owners_bill')
                                ->select('SUM(`amount`) AS kurir')
                                ->where('description', 'BIAYA ONGKIR')
                                ->where('bill_status', 0) 
                                ->get();
        } elseif(session()->get('user_type') == 1){ 
                $query = $this->db->table('owners_bill')
                                ->select('SUM(`amount`) AS kurir')
                                ->where('description', 'BIAYA ONGKIR')
                                ->where('owners_id', session()->get('owners_id'))
                                ->where('bill_status', 0) 
                                ->get();
        } else {
                $query = $this->db->table('owners_bill')
                                ->select('SUM(`amount`) AS kurir')
                                ->join('po_outbound', 'owners_bill.po_id = po_outbound.po_outbound_id')
                                ->where('po_outbound.warehouse_id', @session()->get('warehouse_id'))
                                ->where('owners_bill.description', 'BIAYA ONGKIR')
                                ->where('owners_bill.bill_status', 0) 
                                ->get();
        }
        return $query->getResult();
    }

    public function total_biaya_packing(){
        if(session()->get('warehouse_id') == "POSLOG"){
                $query = $this->db->table('owners_bill')
                                ->select('SUM(`amount`) AS packing')
                                ->where('description', 'BIAYA PACKING') 
                                ->where('bill_status', 0)
                                ->get();
        } elseif(session()->get('user_type') == 1){ 
                $query = $this->db->table('owners_bill')
                                ->select('SUM(`amount`) AS packing')
                                ->where('description', 'BIAYA PACKING')
                                ->where('owners_id', session()->get('owners_id'))
                                ->where('bill_status', 0)
                                ->get();
        } else { // NANTI DIPERUNTUKKAN UNTUK MEMUNCULKAN BILL PER WAREHOUSE.
                $query = $this->db->table('owners_bill')
                                ->select('SUM(`amount`) AS packing')
                                ->join('po_outbound', 'owners_bill.po_id = po_outbound.po_outbound_id')
                                ->where('po_outbound.warehouse_id', @session()->get('warehouse_id'))
                                ->where('owners_bill.description', 'BIAYA PACKING') 
                                ->where('owners_bill.bill_status', 0)
                                ->get();
        }
        return $query->getResult();
    }

    public function total_warehouse_fee(){
        if(session()->get('warehouse_id') == "POSLOG"){
                $query = $this->db->table('owners_bill')
                                ->select('SUM(`amount`) AS wh_fee')
                                ->where('description', 'ADMIN FEE')
                                ->where('bill_status', 1)
                                ->get();
        } elseif(session()->get('user_type') == 1){ 
                $query = $this->db->table('owners_bill')
                                ->select('SUM(`amount`) AS wh_fee')
                                ->where('description', 'ADMIN FEE')
                                ->where('owners_id', session()->get('owners_id'))
                                ->where('bill_status', 1)
                                ->get();
        } else {
                $query = $this->db->table('owners_bill')
                                ->select('SUM(`amount`) AS wh_fee')
                                ->join('po_outbound', 'owners_bill.po_id = po_outbound.po_outbound_id')
                                ->where('po_outbound.warehouse_id', @session()->get('warehouse_id'))
                                ->where('owners_bill.description', 'ADMIN FEE')
                                ->where('owners_bill.bill_status', 1)
                                ->get();
        }
        return $query->getResult();
    }

    public function total_soh(){// nanti ditambahin parameter
        if(session()->get('warehouse_id') == "POSLOG"){
            $query = $this->db->table($this->matDetail)
                    ->select('`warehouse`.`warehouse_id`,
                            `warehouse`.`wh_name`,
                            SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                            SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                    ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                    ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                    ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('material', 'material_detail.material_id=material.material_id')
                    ->get();
            
        } elseif(session()->get('user_type') == 1){ 
            $query = $this->db->table($this->matDetail)
                    ->select('`warehouse`.`warehouse_id`,
                                `warehouse`.`wh_name`,
                                SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                SUM(`warehouse_soh`.`stock_nok`) AS stock_nok, 
                                (SELECT SUM(pod.`qty_good`) AS reserved_qty FROM po_out_detail pod 
                                JOIN po_outbound po ON pod.`po_outbound_id` = po.`po_outbound_id`
                                WHERE po.`po_out_status` = 1 AND pod.`material_id` = `material_detail`.`material_id`) AS reserved_qty')
                    ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                    ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                    ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                    ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                    ->join('material', 'material_detail.material_id=material.material_id')
                    ->where('material_detail.owner_id', session()->get('owners_id'))
                    ->get();
        } else {
                $query = $this->db->table($this->matDetail)
                        ->select('`warehouse`.`warehouse_id`,
                                `warehouse`.`wh_name`,
                                SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                        ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                        ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('inbound.inbound_location', session()->get('warehouse_id'))
                        ->get();
        }
        return $query->getResult();
    }

//     method dashboard
    public function total_soh_f($owner){// nanti ditambahin parameter
        $filter_owner = null;
        
        if(@$owner){
            $filter_owner = " AND material_detail.`owner_id`='$owner'";
        }
        
        $cond = "warehouse.warehouse_id != '' $filter_owner";
        if(session()->get('warehouse_id') == "POSLOG"){
                $query = $this->db->table($this->matDetail)
                        ->select('`warehouse`.`warehouse_id`,
                                `warehouse`.`wh_name`,
                                SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                        ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                        ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where($cond)
                        ->get();
        } else {
                $query = $this->db->table($this->matDetail)
                        ->select('`warehouse`.`warehouse_id`,
                                `warehouse`.`wh_name`,
                                SUM(`warehouse_soh`.`stock_ok`)  AS stock_ok,
                                SUM(`warehouse_soh`.`stock_nok`) AS stock_nok')
                        ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                        ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where($cond)
                        ->where('inbound.inbound_location', session()->get('warehouse_id'))
                        ->get();
        }
        return $query->getResult();
    }

    public function stok_good_detail_f($owner){// nanti ditambahin parameter
        $filter_owner = null;
        
        if(@$owner){
            $filter_owner = " AND material_detail.`owner_id`='$owner'";
        }
        
        $cond = "warehouse.warehouse_id != '' $filter_owner";
        if(session()->get('warehouse_id') == "POSLOG"){
                $query = $this->db->table($this->matDetail)
                        ->select("`warehouse`.`warehouse_id`,
                                `warehouse`.`wh_name`,
                                `material_detail`.`material_id`, 
                                `material`.`material_name`,
                                `material_location`.`location_id`,
                                CONCAT(area_blok.`blok_name`, ' ', rak.`rak_name`, ' ', shelf.`shelf_name`) AS mat_loc,
                                `material_location`.`qty`")
                        ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                        ->join('material_location', 'material_detail.mat_detail_id=material_location.material_detail_id')
                        ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                        ->join('rak', 'shelf.rak_id=rak.rak_id')
                        ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                        ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                        ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('inbound_detail.qty_good_in > 0')
                        ->where('wh_area.area_mat_st = 1')
                        ->where($cond)
                        ->get();
        } else {
                $query = $this->db->table($this->matDetail)
                        ->select("`warehouse`.`warehouse_id`,
                                `warehouse`.`wh_name`,
                                `material_detail`.`material_id`, 
                                `material`.`material_name`,
                                `material_location`.`location_id`,
                                CONCAT(area_blok.`blok_name`, ' ', rak.`rak_name`, ' ', shelf.`shelf_name`) AS mat_loc,
                                `material_location`.`qty`")
                        ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                        ->join('material_location', 'material_detail.mat_detail_id=material_location.material_detail_id')
                        ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                        ->join('rak', 'shelf.rak_id=rak.rak_id')
                        ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                        ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                        ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('inbound.inbound_location', session()->get('warehouse_id'))
                        ->where('inbound_detail.qty_good_in > 0')
                        ->where('wh_area.area_mat_st = 1')
                        ->where($cond)
                        ->get();
        }
        return $query->getResult();
    }

    public function stok_notgood_detail_f($owner){// nanti ditambahin parameter
        $filter_owner = null;
        
        if(@$owner){
            $filter_owner = " AND material_detail.`owner_id`='$owner'";
        }
        
        $cond = "warehouse.warehouse_id != '' $filter_owner";
        if(session()->get('warehouse_id') == "POSLOG"){
                $query = $this->db->table($this->matDetail)
                        ->select("`warehouse`.`warehouse_id`,
                                `warehouse`.`wh_name`,
                                `material_detail`.`material_id`, 
                                `material`.`material_name`,
                                `material_location`.`location_id`,
                                CONCAT(area_blok.`blok_name`, ' ', rak.`rak_name`, ' ', shelf.`shelf_name`) AS mat_loc,
                                `material_location`.`qty`")
                        ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                        ->join('material_location', 'material_detail.mat_detail_id=material_location.material_detail_id')
                        ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                        ->join('rak', 'shelf.rak_id=rak.rak_id')
                        ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                        ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                        ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('inbound_detail.qty_notgood_in > 0')
                        ->where('wh_area.area_mat_st = 0')
                        ->where($cond)
                        ->get();
        } else {
                $query = $this->db->table($this->matDetail)
                        ->select("`warehouse`.`warehouse_id`,
                                `warehouse`.`wh_name`,
                                `material_detail`.`material_id`, 
                                `material`.`material_name`,
                                `material_location`.`location_id`,
                                CONCAT(area_blok.`blok_name`, ' ', rak.`rak_name`, ' ', shelf.`shelf_name`) AS mat_loc,
                                `material_location`.`qty`")
                        ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                        ->join('material_location', 'material_detail.mat_detail_id=material_location.material_detail_id')
                        ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                        ->join('rak', 'shelf.rak_id=rak.rak_id')
                        ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                        ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                        ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('inbound.inbound_location', session()->get('warehouse_id'))
                        ->where('inbound_detail.qty_notgood_in > 0')
                        ->where('wh_area.area_mat_st = 0')
                        ->where($cond)
                        ->get();
        }
        
        return $query->getResult();
    }

//     method dashboard
public function stok_good_detail(){// nanti ditambahin parameter
        if(session()->get('warehouse_id') == "POSLOG"){
                $query = $this->db->table($this->matDetail)
                        ->select("`warehouse`.`warehouse_id`,
                                `warehouse`.`wh_name`,
                                `material_detail`.`material_id`, 
                                `material`.`material_name`,
                                `material_location`.`location_id`,
                                CONCAT(area_blok.`blok_name`, ' ', rak.`rak_name`, ' ', shelf.`shelf_name`) AS mat_loc,
                                `material_location`.`qty`")
                        ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                        ->join('material_location', 'material_detail.mat_detail_id=material_location.material_detail_id')
                        ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                        ->join('rak', 'shelf.rak_id=rak.rak_id')
                        ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                        ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                        ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('inbound_detail.qty_good_in > 0')
                        ->where('wh_area.area_mat_st = 1')
                        ->get();
        } elseif(session()->get('user_type') == 1){ 
                $query = $this->db->table($this->matDetail)
                        ->select("`warehouse`.`warehouse_id`,
                                `warehouse`.`wh_name`,
                                `material_detail`.`material_id`, 
                                `material`.`material_name`,
                                `material_location`.`location_id`,
                                CONCAT(area_blok.`blok_name`, ' ', rak.`rak_name`, ' ', shelf.`shelf_name`) AS mat_loc,
                                `material_location`.`qty`")
                        ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                        ->join('material_location', 'material_detail.mat_detail_id=material_location.material_detail_id')
                        ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                        ->join('rak', 'shelf.rak_id=rak.rak_id')
                        ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                        ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                        ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('material_detail.owner_id', session()->get('owners_id'))
                        ->where('inbound_detail.qty_good_in > 0')
                        ->where('wh_area.area_mat_st = 1')
                        ->get();
        } else {
                $query = $this->db->table($this->matDetail)
                        ->select("`warehouse`.`warehouse_id`,
                                `warehouse`.`wh_name`,
                                `material_detail`.`material_id`, 
                                `material`.`material_name`,
                                `material_location`.`location_id`,
                                CONCAT(area_blok.`blok_name`, ' ', rak.`rak_name`, ' ', shelf.`shelf_name`) AS mat_loc,
                                `material_location`.`qty`")
                        ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                        ->join('material_location', 'material_detail.mat_detail_id=material_location.material_detail_id')
                        ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                        ->join('rak', 'shelf.rak_id=rak.rak_id')
                        ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                        ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                        ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('inbound.inbound_location', session()->get('warehouse_id'))
                        ->where('inbound_detail.qty_good_in > 0')
                        ->where('wh_area.area_mat_st = 1')
                        ->get();
        }
        return $query->getResult();
    }

    public function stok_notgood_detail(){// nanti ditambahin parameter
        if(session()->get('warehouse_id') == "POSLOG"){
                $query = $this->db->table($this->matDetail)
                        ->select("`warehouse`.`warehouse_id`,
                                `warehouse`.`wh_name`,
                                `material_detail`.`material_id`, 
                                `material`.`material_name`,
                                `material_location`.`location_id`,
                                CONCAT(area_blok.`blok_name`, ' ', rak.`rak_name`, ' ', shelf.`shelf_name`) AS mat_loc,
                                `material_location`.`qty`")
                        ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                        ->join('material_location', 'material_detail.mat_detail_id=material_location.material_detail_id')
                        ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                        ->join('rak', 'shelf.rak_id=rak.rak_id')
                        ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                        ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                        ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('inbound_detail.qty_notgood_in > 0')
                        ->where('wh_area.area_mat_st = 0')
                        ->get();
        } elseif(session()->get('user_type') == 1){ 
                $query = $this->db->table($this->matDetail)
                        ->select("`warehouse`.`warehouse_id`,
                                `warehouse`.`wh_name`,
                                `material_detail`.`material_id`, 
                                `material`.`material_name`,
                                `material_location`.`location_id`,
                                CONCAT(area_blok.`blok_name`, ' ', rak.`rak_name`, ' ', shelf.`shelf_name`) AS mat_loc,
                                `material_location`.`qty`")
                        ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                        ->join('material_location', 'material_detail.mat_detail_id=material_location.material_detail_id')
                        ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                        ->join('rak', 'shelf.rak_id=rak.rak_id')
                        ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                        ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                        ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('material_detail.owner_id', session()->get('owners_id'))
                        ->where('inbound_detail.qty_notgood_in > 0')
                        ->where('wh_area.area_mat_st = 0')
                        ->get();
        } else {
                $query = $this->db->table($this->matDetail)
                        ->select("`warehouse`.`warehouse_id`,
                                `warehouse`.`wh_name`,
                                `material_detail`.`material_id`, 
                                `material`.`material_name`,
                                `material_location`.`location_id`,
                                CONCAT(area_blok.`blok_name`, ' ', rak.`rak_name`, ' ', shelf.`shelf_name`) AS mat_loc,
                                `material_location`.`qty`")
                        ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                        ->join('material_location', 'material_detail.mat_detail_id=material_location.material_detail_id')
                        ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                        ->join('rak', 'shelf.rak_id=rak.rak_id')
                        ->join('area_blok', 'rak.blok_id=area_blok.blok_id')
                        ->join('wh_area', 'area_blok.wh_area_id=wh_area.area_id')
                        ->join('inbound_detail', 'material_detail.mat_detail_id=inbound_detail.material_detail_id')
                        ->join('inbound', 'inbound_detail.inbound_id=inbound.inbound_id')
                        ->join('warehouse', 'inbound.inbound_location=warehouse.warehouse_id')
                        ->join('material', 'material_detail.material_id=material.material_id')
                        ->where('inbound.inbound_location', session()->get('warehouse_id'))
                        ->where('inbound_detail.qty_notgood_in > 0')
                        ->where('wh_area.area_mat_st = 0')
                        ->get();
        }
        
        return $query->getResult();
    }
    

    public function check_material($owner_id, $material_id, $batch_no, $exp_date){
        $query = $this->db->table($this->table)
                ->select('material_detail.mat_detail_id')
                ->where('owner_id', $owner_id)
                ->where('material_id', $material_id)
                ->where('batch_no', $batch_no)
                ->where('expired_date', $exp_date)
                ->limit(1)
                ->get();
        if($query->getNumRows() > 0){
            return $query->getRow()->mat_detail_id;
        }else{
            return 0;
        }
    }

    public function get_location_bymaterial($owner_id, $warehouse_id, $mat_detail_id){
        $query = $this->db->table($this->table)
                ->select('`material_detail`.`mat_detail_id`
                , `material`.`material_name`
                , `material_detail`.`owner_id`
                , `owners`.`owners_status`
                , `material_detail`.`expired_date`
                , `material_detail`.`batch_no`
                , `material_location`.`shelf_id`
                , `material_location`.`location_id`
                , `shelf`.`shelf_name`
                , `rak`.`rak_name`
                , `area_blok`.`blok_name`
                , `wh_area`.`wh_area_name`
                , `warehouse`.`warehouse_id`
                , `warehouse`.`wh_name`
                , `material_location`.`qty`')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->join('material_location', 'material_location.material_detail_id=material_detail.mat_detail_id')
                ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                ->join('owners', 'material_detail.owner_id=owners.owners_id')
                ->join('rak', 'shelf.rak_id = rak.rak_id')
                ->join('area_blok', 'rak.blok_id = area_blok.blok_id')
                ->join('wh_area', 'area_blok.wh_area_id = wh_area.area_id')
                ->join('warehouse', 'wh_area.wh_id = warehouse.warehouse_id') 
                ->where('material_location.qty > 0')
                ->where('owners.owners_id', $owner_id)
                ->where('warehouse.warehouse_id', $warehouse_id)
                ->where('material_detail.mat_detail_id', $mat_detail_id)
                ->get();
        return $query->getResult();
    }

    public function get_qty_bylocation($owner_id, $warehouse_id, $mat_detail_id, $location_id){
        $query = $this->db->table($this->table)
                ->select('`material_detail`.`mat_detail_id`
                , `material`.`material_name`
                , `material_detail`.`owner_id`
                , `owners`.`owners_status`
                , `material_detail`.`expired_date`
                , `material_detail`.`batch_no`
                , `material_location`.`shelf_id`
                , `material_location`.`location_id`
                , `shelf`.`shelf_name`
                , `rak`.`rak_name`
                , `area_blok`.`blok_name`
                , `wh_area`.`wh_area_name`
                , `warehouse`.`warehouse_id`
                , `warehouse`.`wh_name`
                , `material_location`.`qty`')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->join('material_location', 'material_location.material_detail_id=material_detail.mat_detail_id')
                ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                ->join('owners', 'material_detail.owner_id=owners.owners_id')
                ->join('rak', 'shelf.rak_id = rak.rak_id')
                ->join('area_blok', 'rak.blok_id = area_blok.blok_id')
                ->join('wh_area', 'area_blok.wh_area_id = wh_area.area_id')
                ->join('warehouse', 'wh_area.wh_id = warehouse.warehouse_id') 
                ->where('material_location.qty > 0')
                ->where('owners.owners_id', $owner_id)
                ->where('warehouse.warehouse_id', $warehouse_id)
                ->where('material_detail.mat_detail_id', $mat_detail_id)
                ->where('material_location.location_id', $location_id)
                ->get();
        return $query->getResult();
    }

    public function get_material_byowner($owner_id, $warehouse_id){
        $query = $this->db->table($this->table)
                ->select('`material_detail`.`mat_detail_id`
                , `material`.`material_name`
                , `material_detail`.`owner_id`
                , `owners`.`owners_status`
                , `material_detail`.`expired_date`
                , `material_detail`.`batch_no`
                , `material_location`.`shelf_id`
                , `material_location`.`location_id`
                , `shelf`.`shelf_name`
                , `rak`.`rak_name`
                , `area_blok`.`blok_name`
                , `wh_area`.`wh_area_name`
                , `warehouse`.`warehouse_id`
                , `warehouse`.`wh_name`
                , `material_location`.`qty`')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->join('material_location', 'material_location.material_detail_id=material_detail.mat_detail_id')
                ->join('shelf', 'material_location.shelf_id=shelf.shelf_id')
                ->join('owners', 'material_detail.owner_id=owners.owners_id')
                ->join('rak', 'shelf.rak_id = rak.rak_id')
                ->join('area_blok', 'rak.blok_id = area_blok.blok_id')
                ->join('wh_area', 'area_blok.wh_area_id = wh_area.area_id')
                ->join('warehouse', 'wh_area.wh_id = warehouse.warehouse_id') 
                ->where('material_location.qty > 0')
                ->where('owners.owners_id', $owner_id)
                ->where('warehouse.warehouse_id', $warehouse_id)
                ->groupBy('`material_detail`.`mat_detail_id`')
                ->get();
        return $query->getResult();
    }

    public function get_all_material(){
        $query = $this->db->table($this->table)
                ->select('material_detail.mat_detail_id, material.material_name, material.material_id, material_detail.expired_date, material_detail.batch_no')
                ->join('material', 'material_detail.material_id=material.material_id')
                ->join('owners', 'material_detail.owner_id=owners.owners_id')
                ->join('warehouse_soh', 'material_detail.mat_detail_id=warehouse_soh.mat_detail_id')
                ->where('warehouse_soh.stock_ok > 0')
                ->get();
        return $query->getResult();
    }

    public function inbound_data_chart(){
        $query = $this->db->table('inbound')
                ->select('count(inbound_id) as "jml_inbound", inbound_doc_date')
                // ->where('warehouse_soh.stock_ok > 0')
                ->groupBy('inbound_doc_date')
                ->get();
        return $query->getResult();
    }

    public function count_inbound_chart($owners, $date){
        $filter_owner = null;

        if(@$owners){
            $filter_owner = " AND purchase_order.owners_id='$owners'";
        }
        
        $cond = "inbound.inbound_id != '' $filter_owner";
        if(session()->get('user_type') == 1){
                $query = $this->db->table('inbound')
                        ->select('count(inbound_id) as "jml_inbound"')
                        ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                        ->where('inbound_doc_date', $date)
                        ->where('purchase_order.owners_id', session()->get('owners_id'))
                        ->limit(1)
                        ->get();
        } else {
                if(session()->get('warehouse_id') == 'POSLOG'){
                        $query = $this->db->table('inbound')
                                ->select('count(inbound_id) as "jml_inbound"')
                                ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                                ->where($cond)
                                ->where('inbound_doc_date', $date)
                                ->limit(1)
                                ->get();
                } else {
                        $query = $this->db->table('inbound')
                                ->select('count(inbound_id) as "jml_inbound"')
                                ->join('purchase_order', 'inbound.inbound_po=purchase_order.po_id')
                                ->where('inbound.inbound_location', @session()->get('warehouse_id'))
                                ->where($cond)
                                ->where('inbound_doc_date', $date)
                                ->limit(1)
                                ->get();
                }
        }
        if($query->getNumRows() > 0){
                return $query->getRow()->jml_inbound;
        }else{
                return 0;
        }
    }

    public function count_shipping_chart($owners, $date){
        $filter_owner = null;

        if(@$owners){
            $filter_owner = " AND po_outbound.owners_id='$owners'";
        }
        
        $cond = "outbound_do.do_id != '' $filter_owner";
        if(session()->get('user_type') == 1){
                $query = $this->db->table('outbound_do')
                        ->select('count(outbound_do.do_id) as "jml_shipping"')
                        ->join('outbound_do_detail', 'outbound_do.do_id=outbound_do_detail.do_id')
                        ->join('outbound', 'outbound_do_detail.outbound_id=outbound.outbound_id')
                        ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                        ->where('do_date', $date)
                        ->where('po_outbound.owners_id', session()->get('owners_id'))
                        ->groupBy('outbound_do.do_id') // kayanya harus diganti jadi do_detail_id
                        ->limit(1)
                        ->get();
        } else {
                if(@$owners){
                        $query = $this->db->table('outbound_do')
                                ->select('count(outbound_do.do_id) as "jml_shipping"')
                                ->join('outbound_do_detail', 'outbound_do.do_id=outbound_do_detail.do_id')
                                ->join('outbound', 'outbound_do_detail.outbound_id=outbound.outbound_id')
                                ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                                ->where($cond)
                                ->where('do_date', $date)
                                ->groupBy('outbound_do.do_id') // kayanya harus diganti jadi do_detail_id
                                ->limit(1)
                                ->get();
                } else {
                        $query = $this->db->table('outbound_do')
                                ->select('count(outbound_do.do_id) as "jml_shipping"')
                                ->join('outbound_do_detail', 'outbound_do.do_id=outbound_do_detail.do_id')
                                ->join('outbound', 'outbound_do_detail.outbound_id=outbound.outbound_id')
                                ->join('po_outbound', 'outbound.po_outbound_id=po_outbound.po_outbound_id')
                                ->where('po_outbound.warehouse_id', @session()->get('warehouse_id'))
                                ->where($cond)
                                ->where('do_date', $date)
                                ->groupBy('outbound_do.do_id')
                                ->limit(1)
                                ->get();
                }
        }
        if($query->getNumRows() > 0){
                return $query->getRow()->jml_shipping;
        }else{
                return 0;
        }
    }

    public function get_warehouse()
    {
        $query = $this->db->table('warehouse')
        ->join('city', 'warehouse.city_id=city.city_id')
        ->join('state', 'warehouse.state_id=state.state_id')
        ->get();
        return $query->getResult();
    }

    public function find_warehouse($id)
    {
        $query = $this->db->table('warehouse')
        ->where('warehouse_id', $id)
        ->limit(1)
        ->get();
        return $query->getRow();
    }
}
?>