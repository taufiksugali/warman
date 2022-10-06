<?php use App\Models\MaterialModel; ?>
<?php use App\Models\WarehouseModel; ?>
<?php use App\Models\OutboundpoModel; ?>
<?php use App\Models\StateModel; ?>
<?php $this->material = new MaterialModel(); ?>
<?php $this->warehouse = new WarehouseModel(); ?>
<?php $this->outboundpo = new OutboundpoModel(); ?>
<?php $this->state = new StateModel(); ?>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Transaction</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Transaction Data</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Batch Add Transaction</a>
                    </li>
                </ul>
				<!--end::Page Title-->
			</div>
			<!--end::Info-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
				<!--begin::Dropdowns-->
			</div>
			<!--end::Toolbar-->
		</div>
	</div>
	<!--end::Subheader-->
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
        <div class="container"> 
            <div class="row">
                <div class="col-md-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b example example-compact card-sticky" id="kt_page_sticky_card">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Batch Add Transaction</h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="<?= base_url('outboundpo'); ?>" class="btn btn-light-primary font-weight-bolder mr-2">
                                <i class="ki ki-long-arrow-back icon-xs"></i>Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form action="<?php echo base_url('outboundpo/bulk_upload'); ?>" enctype="multipart/form-data" method="post" class="form" id="bulk_add_trans">
                            <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-xl-2"></div>
                                    <div class="col-xl-8">
                                        <div class="my-5">
                                            <!-- -->
                                            <div class="form-group row">
                                                <label class="col-3">Download Template Here</label>
                                                <div class="col-9">
                                                    <a href="<?php echo base_url('/template').'/template_add_transaction.xlsx'; ?>" class="btn btn-outline-primary mr-3"><i class="flaticon-file"></i>Upload Format</a>
                                                </div>
                                            </div>
                                            <?php if($import == 0) { ?>
                                            <div class="form-group row">
                                                <label class="col-3">Upload File Here</label>
                                                <div class="col-9">
                                                    <input type="file" name="fileexcel" class="form-control" id="file" required accept=".xls, .xlsx" /></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3"></label>
                                                <div class="col-9">
                                                    <div class="btn-group">
                                                        <button type="submit" form="bulk_add_trans" class="btn btn-primary font-weight-bolder">
                                                        <i class="ki ki-check icon-xs"></i>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php if($import == 1) { ?>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="my-5">
                                            <form action="<?php echo base_url('outboundpo/bulk_create'); ?>" enctype="multipart/form-data" method="post" class="form" id="bulk_save_trans">
                                                <h3 class="text-dark font-weight-bold">Preview:</h3>
                                                <!-- -->
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <table class="table table-striped responsive table-bordered-scroll-x">
                                                            <thead> 
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th>Warehouse</th>
                                                                    <th>Logistik</th>
                                                                    <th>Out Date</th>
                                                                    <th>Remark</th>
                                                                    <th>Nama Penerima</th>
                                                                    <th>No. Telp</th>
                                                                    <th>Email Penerima</th>
                                                                    <th>Alamat Penerima</th>
                                                                    <th>Kode POS</th>
                                                                    <th>Product ID</th>
                                                                    <th>Quantity</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="LO">
                                                            <?php
                                                            $no=0;
                                                            $error=0;
                                                            
                                                            foreach ($data_outbound as $row) {
                                                                $material_name = null;$warehouse=null;$transporter=null;$zip_code=null;
                                                                $material_name = @$this->material->get_material_byid(@$data_outbound_detail[$no]['material_id'], session()->get('owners_id'))->material_name;
                                                                
                                                                if(@$row['warehouse_code'] != 'PO_DETAIL'){
                                                                    $warehouse = @$this->warehouse->get_warehouse_bycode(@$row['warehouse_code'])->warehouse_id;
                                                                } else {
                                                                    $warehouse='PO_DETAIL';
                                                                }

                                                                if(@$row['transporter_alias'] != 'PO_DETAIL'){
                                                                    $transporter = $this->outboundpo->get_transporter_byalias($row['transporter_alias']);
                                                                } else {
                                                                    $transporter='PO_DETAIL';
                                                                }

                                                                if(@$row['zip_code'] != 'PO_DETAIL'){
                                                                    $zip_code = $this->state->getAllByZipCode($row['zip_code']);
                                                                } else {
                                                                    $zip_code = 'PO_DETAIL';
                                                                }
                                                                // var_dump($warehouse);
                                                                $today = date('Y-m-d');

                                                                if(empty(@$row['warehouse_code']) or ($warehouse == null or $warehouse == "")){
                                                                    $warehouse_code_error = true;
                                                                    $error++;
                                                                }else{
                                                                    $warehouse_code_error = false;
                                                                }
                                                                $check_errors[] = $warehouse_code_error;

                                                                if(empty(@$row['transporter_alias']) or ($transporter == null or $transporter == "")){
                                                                    $transporter_error = true;
                                                                    $error++;
                                                                }else{
                                                                    $transporter_error = false;
                                                                }
                                                                $check_errors[] = $transporter_error;
                                                                
                                                                if(empty(@$row['po_out_date']) or $row['po_out_date'] < $today){
                                                                    $po_out_date_error = true;
                                                                    $error++;
                                                                }else{
                                                                    $po_out_date_error = false;
                                                                }
                                                                $check_errors[] = $po_out_date_error;

                                                                if(empty(@$row['po_description'])){
                                                                    $po_description_error = false;
                                                                    // $error++;
                                                                }else{
                                                                    $po_description_error = false;
                                                                }
                                                                $check_errors[] = $po_description_error;

                                                                if(empty(@$row['customer_name'])){
                                                                    $customer_name_error = true;
                                                                    $error++;
                                                                }else{
                                                                    $customer_name_error = false;
                                                                }
                                                                $check_errors[] = $customer_name_error;

                                                                if(empty(@$row['customer_phone'])){
                                                                    $customer_phone_error = true;
                                                                    $error++;
                                                                }else{
                                                                    $customer_phone_error = false;
                                                                }
                                                                $check_errors[] = $customer_phone_error;

                                                                if(empty(@$row['customer_email'])){
                                                                    $customer_email_error = true;
                                                                    $error++;
                                                                }else{
                                                                    $customer_email_error = false;
                                                                }
                                                                $check_errors[] = $customer_email_error;

                                                                if(empty(@$row['customer_address'])){
                                                                    $customer_address_error = true;
                                                                    $error++;
                                                                }else{
                                                                    $customer_address_error = false;
                                                                }
                                                                $check_errors[] = $customer_address_error;

                                                                if(empty(@$row['zip_code']) or ($zip_code == null or $zip_code == "")){
                                                                    $zip_code_error = true;
                                                                    $error++;
                                                                }else{
                                                                    $zip_code_error = false;
                                                                }
                                                                $check_errors[] = $zip_code_error;

                                                                if(empty(@$data_outbound_detail[$no]['material_id']) or $material_name == null){
                                                                    $material_id_error = true;
                                                                    $error++;
                                                                }else{
                                                                    $material_id_error = false;
                                                                }
                                                                $check_errors[] = $material_id_error;

                                                                if(empty(@$data_outbound_detail[$no]['outbound_qty'])){
                                                                    $qty_error = true;
                                                                    $error++;
                                                                }else{
                                                                    $qty_error = false;
                                                                }
                                                                $check_errors[] = $qty_error;
                                                        ?>
                                                            <tr>
                                                                <td><?= $no+1 ?> </td>
                                                                <td class="<?php if($warehouse_code_error == true){ echo 'table-danger'; } ?>"><input type="hidden" name="outbound[<?= $no; ?>][warehouse_id]" value="<?= @$row['warehouse_id'] ?>"><?php if(@$row['warehouse_code'] != 'PO_DETAIL'){ ?><?= @$row['warehouse_code'] ?><?php } ?></td>
                                                                <td class="<?php if($transporter_error == true){ echo 'table-danger'; } ?>"><input type="hidden" name="outbound[<?= $no; ?>][transporter_alias]" value="<?= @$row['transporter_alias'] ?>"><?php if(@$row['warehouse_code'] != 'PO_DETAIL'){ ?><?= @$row['transporter_alias'] ?><?php } ?></td>
                                                                <td class="<?php if($po_out_date_error == true){ echo 'table-danger'; } ?>"><input type="hidden" name="outbound[<?= $no; ?>][po_out_date]" value="<?= @$row['po_out_date'] ?>"><?php if(@$row['warehouse_code'] != 'PO_DETAIL'){ ?><?= date_format(date_create(@$row['po_out_date']), 'd-m-Y') ?><?php } ?></td>
                                                                <td class="<?php if($po_description_error == true){ echo 'table-danger'; } ?>"><input type="hidden" name="outbound[<?= $no; ?>][po_description]" value="<?= @$row['po_description'] ?>"><?php if(@$row['warehouse_code'] != 'PO_DETAIL'){ ?><?= @$row['po_description'] ?><?php } ?></td>
                                                                <td class="<?php if($customer_name_error == true){ echo 'table-danger'; } ?>"><input type="hidden" name="outbound[<?= $no; ?>][customer_name]" value="<?= @$row['customer_name'] ?>"><?php if(@$row['warehouse_code'] != 'PO_DETAIL'){ ?><?= @$row['customer_name'] ?><?php } ?></td>
                                                                <td class="<?php if($customer_phone_error == true){ echo 'table-danger'; } ?>"><input type="hidden" name="outbound[<?= $no; ?>][customer_phone]" value="<?= @$row['customer_phone'] ?>"><?php if(@$row['warehouse_code'] != 'PO_DETAIL'){ ?><?= @$row['customer_phone'] ?><?php } ?></td>
                                                                <td class="<?php if($customer_email_error == true){ echo 'table-danger'; } ?>"><input type="hidden" name="outbound[<?= $no; ?>][customer_email]" value="<?= @$row['customer_email'] ?>"><?php if(@$row['warehouse_code'] != 'PO_DETAIL'){ ?><?= @$row['customer_email'] ?><?php } ?></td>
                                                                <td class="<?php if($customer_address_error == true){ echo 'table-danger'; } ?>"><input type="hidden" name="outbound[<?= $no; ?>][customer_address]" value="<?= @$row['customer_address'] ?>"><?php if(@$row['warehouse_code'] != 'PO_DETAIL'){ ?><?= @$row['customer_address'] ?><?php } ?></td>
                                                                <td class="<?php if($zip_code_error == true){ echo 'table-danger'; } ?>"><input type="hidden" name="outbound[<?= $no; ?>][zip_code]" value="<?= @$row['zip_code'] ?>"><?php if(@$row['warehouse_code'] != 'PO_DETAIL'){ ?><?= @$row['zip_code'] ?><?php } ?></td>
                                                                <td class="<?php if($material_id_error == true){ echo 'table-danger'; } ?>"><input type="hidden" name="outbound_detail[<?= $no; ?>][material_id]" value="<?= @$data_outbound_detail[$no]['material_id'] ?>"><?= @$data_outbound_detail[$no]['material_id'] ?></td>
                                                                <td class="<?php if($qty_error == true){ echo 'table-danger'; } ?>"><input type="hidden" name="outbound_detail[<?= $no; ?>][outbound_qty]" value="<?= @$data_outbound_detail[$no]['outbound_qty'] ?>"><?= @$data_outbound_detail[$no]['outbound_qty'] ?></td>
                                                            </tr>
                                                        <?php $no++; } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-9">
                                                        <div class="btn-group">
                                                            <?php if($error == 0) { ?>
                                                            <button type="submit" form="bulk_save_trans" class="btn btn-primary font-weight-bolder">
                                                            <i class="ki ki-check icon-xs"></i>Save Data</button>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
    </div>
	<!--end::Entry-->
</div>
<!--end::Content-->