<?php 
    // -- start of notifications for seller
    function get_materialsize_dm($owners_id) { // DM stands for doesn't match
        $db = \Config\Database::connect();
        $query = $db->table('material')
                ->where('owners_id', $owners_id)
                ->where('( material_height != height_comparison OR material_width != width_comparison 
                            OR material_length != length_comparison OR material_weight != weight_comparison )')
                ->orderBy('update_date', 'ASC')
                ->get();
        return $query->getResult();
    }

    function get_invoice_npy($owners_id){ // NPY stands for not approved yet
        $db = \Config\Database::connect();
        $query = $db->table('po_outbound')
                ->join('customer', 'po_outbound.po_penerima=customer.customer_id')
                ->where('po_outbound.owners_id', $owners_id)
                ->where('po_out_status', 4)
                ->orderBy('po_create_date', 'ASC')
                ->get();
        return $query->getResult();
    }
    // -- end of notifications for seller
?>