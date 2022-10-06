<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Inbound</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Inbound Process</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Add Inbound Process</a>
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
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Add Inbound Process</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('inbound/create'); ?>">
                            <div class="card-body">
                                <div class="input_fields_wrap">
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label>PO Number
                                            <span class="text-danger">*</span></label>
                                            <select required class="form-control select select2 <?= ($validation->getError('po_id')) ? 'is-invalid' : ''; ?>" value="<?= old('po_id'); ?>" id="po_id" name="po_id">
                                                <option value="" selected></option>
                                                <?php foreach(@$po_number as $row) { ?>
                                                <option value="<?= @$row->po_id; ?>" data-val="<?= @$row->wh_name; ?>"><?php echo $row->po_id.'-'.$row->po_number.'. Seller: '. $row->owners_name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if($validation->getError('po_id')){ echo '<div class="invalid-feedback">'.$validation->getError('po_id').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                            <label>Warehouse
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="supplier_id" disabled class="form-control <?= ($validation->getError('supplier_id')) ? 'is-invalid' : ''; ?>" id="supplier" placeholder="Enter Warehouse" />
                                            <?php if($validation->getError('supplier_id')){ echo '<div class="invalid-feedback">'.$validation->getError('supplier_id').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Remark</label>
                                        <textarea name="description" class="form-control <?= ($validation->getError('description')) ? 'is-invalid' : ''; ?>" placeholder="Enter description" ></textarea>
                                        <?php if($validation->getError('description')){ echo '<div class="invalid-feedback">'.$validation->getError('description').'</div>'; } ?>
                                    </div>
                                    <div class="separator separator-dashed"></div>
                                    <label>Product Data</label>
                                    <div style="overflow-x:auto">
                                        <table class="table nowrap table-bordered table-checkable table-nopaging">
                                            <thead>
                                                <tr>
                                                    <th width="55px"></th>
                                                    <th>ID</th>
                                                    <th>PO Number</th>
                                                    <th>PO Date</th>
                                                    <th>Product ID</th>
                                                    <th>Product</th>
                                                    <th>Plan Qty</th>
                                                    <th>Due Date</th>
                                                </tr>
                                            </thead>
                                            <tbody id="do_list">
                                            <?php
                                            if(@$purchase_order) :
                                                foreach ($purchase_order as $row) :
                                                    if($row->qty > 1){
                                                        $po_uom = $row->uom_name.'(s)';
                                                    }else{
                                                        $po_uom = $row->uom_name;
                                                    }
                                                    ?>
                                                    <tr class="text-nowrap">
                                                        <td><input type="checkbox" class="listCheckbox purchaseCheck" name="purchase_order[]" value="<?= $row->po_detail_id ?>" <?php if(@in_array($row->po_detail_id, $this->input->post('purchase_order'))){ echo 'checked'; } ?>/></td>
                                                        <td><?= $row->po_detail_id ?></td>
                                                        <td><?= $row->po_number ?></td>
                                                        <td><?= date('d-m-Y', strtotime($row->po_date)) ?></td>
                                                        <td><?= $row->material_name ?></td>
                                                        <td class="text-right"><?= number_format($row->qty).' '.$po_uom ?></td>
                                                        <td><?= date('d-m-Y', strtotime($row->due_date)) ?></td>
                                                    </tr>
                                                    <?php
                                                            endforeach;
                                                        endif;
                                                    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('inbound'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
    </div>
	<!--end::Entry-->
</div>
<!--end::Content-->

