<?php use App\Models\MaterialModel; ?>
<?php use App\Models\WarehouseModel; ?>
<?php $this->material = new MaterialModel(); ?>
<?php $this->warehouse = new WarehouseModel(); ?>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Inbound Request</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Inbound Request Data</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Batch Add Inbound Request</a>
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
                                <h3 class="card-label">Batch Add Inbound Request</h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="<?= base_url('purchaseorder'); ?>" class="btn btn-light-primary font-weight-bolder mr-2">
                                <i class="ki ki-long-arrow-back icon-xs"></i>Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form action="<?php echo base_url('purchaseorder/bulk_upload'); ?>" enctype="multipart/form-data" method="post" class="form" id="bulk_add_po">
                            <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-xl-2"></div>
                                    <div class="col-xl-8">
                                        <div class="my-5">
                                            <!-- -->
                                            <div class="form-group row">
                                                <label class="col-3">Download Template Here</label>
                                                <div class="col-9">
                                                    <a href="<?php echo base_url('/template').'/template_add_inbound_request.xlsx'; ?>" class="btn btn-outline-primary mr-3"><i class="flaticon-file"></i>Upload Format</a>
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
                                                        <button type="submit" form="bulk_add_po" class="btn btn-primary font-weight-bolder">
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
                                            <form action="<?php echo base_url('purchaseorder/bulk_create'); ?>" enctype="multipart/form-data" method="post" class="form" id="bulk_save_po">
                                                <h3 class="text-dark font-weight-bold">Preview:</h3>
                                                <!-- -->
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <table class="table table-striped table-bordered-scroll-x">
                                                            <thead> 
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th>Warehouse</th>
                                                                    <th>PO Number</th>
                                                                    <th>PO Date</th>
                                                                    <th>Due Date</th>
                                                                    <th>Remark</th>
                                                                    <th>QC</th>
                                                                    <th>Product ID</th>
                                                                    <th>Product Price</th>
                                                                    <th>Quantity</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="LO">
                                                            <?php
                                                            $no=0;
                                                            $error=0;
                                                            
                                                            foreach ($data_po as $row) {
                                                                $material_name = null;$warehouse=null;
                                                                $material_name = @$this->material->get_material_byid(@$data_po_detail[$no]['material_id'], session()->get('owners_id'))->material_name;
                                                                
                                                                if(@$row['warehouse_code'] != 'PO_DETAIL'){
                                                                    $warehouse = @$this->warehouse->get_warehouse_bycode(@$row['warehouse_code'])->warehouse_id;
                                                                } else {
                                                                    $warehouse='PO_DETAIL';
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

                                                                if(empty(@$row['po_number'])){
                                                                    $po_number_error = true;
                                                                    $error++;
                                                                }else{
                                                                    $po_number_error = false;
                                                                }
                                                                $check_errors[] = $po_number_error;
                                                                
                                                                if(empty(@$row['po_date'])){
                                                                    $po_date_error = true;
                                                                    $error++;
                                                                }else{
                                                                    $po_date_error = false;
                                                                }
                                                                $check_errors[] = $po_date_error;

                                                                if(empty(@$row['due_date']) or $row['due_date'] < $today){
                                                                    $due_date_error = true;
                                                                    $error++;
                                                                }else{
                                                                    $due_date_error = false;
                                                                }
                                                                $check_errors[] = $due_date_error;

                                                                if(empty(@$row['description'])){
                                                                    $description_error = false;
                                                                    // $error++;
                                                                }else{
                                                                    $description_error = false;
                                                                }
                                                                $check_errors[] = $description_error;

                                                                if(empty(@$row['qc_status'])){
                                                                    $qc_status_error = true;
                                                                    $error++;
                                                                }else{
                                                                    $qc_status_error = false;
                                                                }
                                                                $check_errors[] = $qc_status_error;

                                                                if(empty(@$data_po_detail[$no]['material_id']) or $material_name == null){
                                                                    $material_id_error = true;
                                                                    $error++;
                                                                }else{
                                                                    $material_id_error = false;
                                                                }
                                                                $check_errors[] = $material_id_error;

                                                                if(empty(@$data_po_detail[$no]['material_price'])){
                                                                    $material_price_error = true;
                                                                    $error++;
                                                                }else{
                                                                    $material_price_error = false;
                                                                }
                                                                $check_errors[] = $material_price_error;

                                                                if(empty(@$data_po_detail[$no]['qty'])){
                                                                    $qty_error = true;
                                                                    $error++;
                                                                }else{
                                                                    $qty_error = false;
                                                                }
                                                                $check_errors[] = $qty_error;
                                                        ?>
                                                            <tr>
                                                                <td><?= $no+1 ?> </td>
                                                                <td class="<?php if($warehouse_code_error == true){ echo 'table-danger'; } ?>"><input type="hidden" name="po[<?= $no; ?>][warehouse_id]" value="<?= @$row['warehouse_id'] ?>"><?php if(@$row['warehouse_code'] != 'PO_DETAIL'){ ?><?= @$row['warehouse_code'] ?><?php } ?></td>
                                                                <td class="<?php if($po_number_error == true){ echo 'table-danger'; } ?>"><input type="hidden" name="po[<?= $no; ?>][po_number]" value="<?= @$row['po_number'] ?>"><?php if(@$row['warehouse_code'] != 'PO_DETAIL'){ ?><?= @$row['po_number'] ?><?php } ?></td>
                                                                <td class="<?php if($po_date_error == true){ echo 'table-danger'; } ?>"><input type="hidden" name="po[<?= $no; ?>][po_date]" value="<?= @$row['po_date'] ?>"><?php if(@$row['warehouse_code'] != 'PO_DETAIL'){ ?><?= date_format(date_create(@$row['po_date']), 'd-m-Y') ?><?php } ?></td>
                                                                <td class="<?php if($due_date_error == true){ echo 'table-danger'; } ?>"><input type="hidden" name="po[<?= $no; ?>][due_date]" value="<?= @$row['due_date'] ?>"><?php if(@$row['warehouse_code'] != 'PO_DETAIL'){ ?><?= date_format(date_create(@$row['due_date']), 'd-m-Y') ?><?php } ?></td>
                                                                <td class="<?php if($description_error == true){ echo 'table-danger'; } ?>"><input type="hidden" name="po[<?= $no; ?>][description]" value="<?= @$row['description'] ?>"><?php if(@$row['warehouse_code'] != 'PO_DETAIL'){ ?><?= @$row['description'] ?><?php } ?></td>
                                                                <td class="<?php if($qc_status_error == true){ echo 'table-danger'; } ?>"><input type="hidden" name="po[<?= $no; ?>][qc_status]" value="<?= @$row['qc_status'] ?>"><?php if(@$row['warehouse_code'] != 'PO_DETAIL'){ ?><?php if(@$row['qc_status'] == 1){ echo "YES"; }else{ echo "NO";} ?><?php } ?></td>
                                                                <td class="<?php if($material_id_error == true){ echo 'table-danger'; } ?>"><input type="hidden" name="po_detail[<?= $no; ?>][material_id]" value="<?= @$data_po_detail[$no]['material_id'] ?>"><?= @$data_po_detail[$no]['material_id'] ?></td>
                                                                <td class="<?php if($material_price_error == true){ echo 'table-danger'; } ?>"><input type="hidden" name="po_detail[<?= $no; ?>][material_price]" value="<?= @$data_po_detail[$no]['material_price'] ?>"><?= @$data_po_detail[$no]['material_price'] ?></td>
                                                                <td class="<?php if($qty_error == true){ echo 'table-danger'; } ?>"><input type="hidden" name="po_detail[<?= $no; ?>][qty]" value="<?= @$data_po_detail[$no]['qty'] ?>"><?= @$data_po_detail[$no]['qty'] ?></td>
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
                                                            <button type="submit" form="bulk_save_po" class="btn btn-primary font-weight-bolder">
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