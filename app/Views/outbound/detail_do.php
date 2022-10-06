<table class="table display table-separate table-bordered-scroll-x" id="shelf_materials">
    <thead>
        <tr>
            <th th width="3%">No.</th>
            <th>Status</th>
            <th>Shipping ID</th>
            <th>Invoice Number</th>
            <th>PO ID</th>
            <th>Customer</th>
            <th>AWB Number</th>
            <th>Transporter</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
        <?php 
        if(!empty($do_detail)){
        foreach(@$do_detail as $row) { 
                if(@$row->status == 1) {
                    $outbound_status = '<span class="label label-light-primary label-pill label-inline mr-2">New</span>';
                } else if(@$row->status == 2)  { 
                    $outbound_status = '<span class="label label-light-info label-pill label-inline mr-2">Packing</span>';
                } else if(@$row->status == 3)  { 
                    $outbound_status = '<span class="label label-light-primary label-pill label-inline mr-2">Shipping</span>';
                } else if(@$row->status == 4)  { 
                    $outbound_status = '<span class="label label-light-info label-pill label-inline mr-2">Sent</span>';
                } else if(@$row->status == 5)  { 
                    $outbound_status = '<span class="label label-light-info label-pill label-inline mr-2">Approved</span>';
                } else if(@$row->status == 6)  { 
                    $outbound_status = '<span class="label label-light-danger label-pill label-inline mr-2">AWB Rejected</span>';
                } else if(@$row->status == 7)  { 
                    $outbound_status = '<span class="label label-light-success label-pill label-inline mr-2">Done</span>';
                } 
            ?>
            <tr>
                <td scope="row" th width="3%"><?= $i; ?></td>
                <td width="10%"><?= $outbound_status; ?></td>
                <td><?= @$row->do_id; ?></td>
                <td><?= @$row->outbound_id; ?></td>
                <td><?= @$row->po_outbound_id ?></td>
                <td><?= @$row->customer_name ?></td>
                <td><?= @$row->do_out_resi; ?></td>
                <td><?= @$row->transporter_alias; ?></td>
            </tr>
        <?php $i++ ?>
        <?php } 
        } else {
            echo '<tr><td colspan="8" align="center" style="padding: 10px;">Data is empty</td></tr>';
        }?>
    </tbody>
</table>
<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/crud/datatables/basic/basic.js"></script>