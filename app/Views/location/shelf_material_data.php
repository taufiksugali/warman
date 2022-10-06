<table class="table display table-separate table-bordered-scroll-x" id="shelf_materials">
    <thead>
        <tr>
            <th th width="3%">No.</th>
            <th>Action</th>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Expired Date</th>
            <th>Batch Num.</th>
            <th>Owner</th>
            <th>Qty</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
        <?php 
        if(!empty($materials)){
        foreach(@$materials as $row) { ?>
            <?php if(@$row->qty != 0) {?>
                <tr>
                    <td scope="row" th width="3%"><?= $i; ?></td>
                    <td width="10%" align="center">
                        <?php if(session()->get('warehouse_id') != "POSLOG") { ?>
                            <a href="<?= base_url('location/edit/'.$row->location_id) ?>" class="btn btn-sm btn-clean btn-icon mr-1" title="Move"><span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Map\Marker2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                            </g>
                            </svg></span></a>
                        <?php } ?>
                    </td>
                    <td width="10%"><?= @$row->material_id; ?></td>
                    <td><?= @$row->material_name; ?></td>
                    <td><?= date('d-m-Y', strtotime(@$row->expired_date)) ?></td>
                    <td><?= @$row->batch_no; ?></td>
                    <td><?= @$row->owners_name; ?></td>
                    <td><?= @$row->qty; ?></td>
                </tr>
            <?php } ?>
        <?php $i++ ?>
        <?php } 
        } else {
            echo '<tr><td colspan="8" align="center" style="padding: 10px;">Shelf is empty</td></tr>';
        }?>
    </tbody>
</table>
<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/crud/datatables/basic/basic.js"></script>