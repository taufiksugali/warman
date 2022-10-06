<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Allocation Plan</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Allocation Plan</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Add Allocation Plan</a>
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
                            <h3 class="card-title">Add Allocation Plan</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('allocation/create'); ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="font-weight-bold">Customer Name<span class="text-danger">*</span></label>
                                    <select class="form-control select select2 <?= ($validation->getError('customer_id')) ? 'is-invalid' : ''; ?>" value="<?= old('customer_id'); ?>" id="customer_id" name="customer_id">
                                        <option value="" selected></option>
                                        <?php foreach(@$customer as $row) { ?>
                                        <option value="<?= @$row->customer_id; ?>"><?= @$row->customer_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php if($validation->getError('customer_id')){ echo '<div class="invalid-feedback">'.$validation->getError('customer_id').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Material<span class="text-danger">*</span></label>
                                    <select class="form-control select select2 <?= ($validation->getError('material_id')) ? 'is-invalid' : ''; ?>" value="<?= old('material_id'); ?>" id="material_id" name="material_id">
                                        <option value="" selected></option>
                                        <?php foreach(@$material as $row) { ?>
                                        <option value="<?= @$row->material_id; ?>"><?= @$row->material_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php if($validation->getError('material_id')){ echo '<div class="invalid-feedback">'.$validation->getError('material_id').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Qty
                                    <span class="text-danger">*</span></label>
                                    <input type="text" name="plan_qty" class="form-control <?= ($validation->getError('plan_qty')) ? 'is-invalid' : ''; ?>" placeholder="Enter code" />
                                    <?php if($validation->getError('plan_qty')){ echo '<div class="invalid-feedback">'.$validation->getError('plan_qty').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Warehouse Name
                                    <span class="text-danger">*</span></label>
                                    <select class="form-control select select2 <?= ($validation->getError('warehouse_id')) ? 'is-invalid' : ''; ?>" value="<?= old('warehouse_id'); ?>" id="warehouse_id" name="warehouse_id">
                                        <option value="" selected></option>
                                        <?php foreach(@$warehouse as $row) { ?>
                                        <option value="<?= @$row->warehouse_id; ?>"><?= @$row->wh_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php if($validation->getError('warehouse_id')){ echo '<div class="invalid-feedback">'.$validation->getError('warehouse_id').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Plan Due Date 
                                    <span class="text-danger">*</span></label>
                                        <div class="input-group date">
                                            <input type="text" class="form-control" id="kt_datepicker_2" readonly="readonly" name="plan_date" placeholder="Select date" />
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="la la-calendar-check-o"></i>
                                                </span>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('allocation'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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