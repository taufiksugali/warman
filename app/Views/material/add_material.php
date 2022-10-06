<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Master Data</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Product</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Add Product</a>
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
                            <h3 class="card-title">Add Product</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('material/create'); ?>">
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="font-weight-bold">Product Code
                                        <span class="text-danger">*</span></label>
                                        <input type="text" name="material_code" class="form-control <?= ($validation->getError('material_code')) ? 'is-invalid' : ''; ?>" value="<?= old('material_code') ?>" placeholder="Enter code" />
                                        <?php if($validation->getError('material_code')){ echo '<div class="invalid-feedback">'.$validation->getError('material_code').'</div>'; } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="font-weight-bold">Product Group <span class="text-danger">*</span></label>
                                        <select class="form-control select select2 <?= ($validation->getError('mat_group_id')) ? 'is-invalid' : ''; ?>" value="<?= old('mat_group_id'); ?>" id="service" name="mat_group_id">
                                            <option value="" selected></option>
                                            <?php foreach(@$mat_group as $row) { ?>
                                            <option value="<?= @$row->mat_group_id; ?>" <?php if(@$row->mat_group_id == old('mat_group_id')){ echo 'selected'; } ?>><?= @$row->mat_group_name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php if($validation->getError('mat_group_id')){ echo '<div class="invalid-feedback">'.$validation->getError('mat_group_id').'</div>'; } ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="font-weight-bold">Product Name
                                        <span class="text-danger">*</span></label>
                                        <input type="text" name="material_name" class="form-control <?= ($validation->getError('material_name')) ? 'is-invalid' : ''; ?>" value="<?= old('material_name') ?>" placeholder="Enter name" />
                                        <?php if($validation->getError('material_name')){ echo '<div class="invalid-feedback">'.$validation->getError('material_name').'</div>'; } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="font-weight-bold">Product Unit <span class="text-danger">*</span></label>
                                        <select class="form-control select select2 <?= ($validation->getError('material_uom')) ? 'is-invalid' : ''; ?>" value="<?= old('material_uom'); ?>" id="uom_id" name="material_uom">
                                            <option value="" selected></option>
                                            <?php foreach(@$mat_uom as $row) { ?>
                                            <option value="<?= @$row->uom_id; ?>" <?php if(@$row->uom_id == old('material_uom')){ echo 'selected'; } ?>><?= @$row->uom_name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php if($validation->getError('material_uom')){ echo '<div class="invalid-feedback">'.$validation->getError('material_uom').'</div>'; } ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="font-weight-bold">Product Weight
                                        <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="material_weight" value="<?= old('material_weight') ?>" 
                                            class="form-control <?= ($validation->getError('material_weight')) ? 'is-invalid' : ''; ?>" 
                                            placeholder="Enter weight" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this);" />
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    Kg
                                                </span>
                                            </div>
                                        </div>
                                        <?php if($validation->getError('material_weight')){ echo '<div class="invalid-feedback">'.$validation->getError('material_weight').'</div>'; } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="font-weight-bold">Description</label>
                                        <div class="input-group">
                                            <textarea name="description" class="form-control <?= ($validation->getError('description')) ? 'is-invalid' : ''; ?>" placeholder="Enter description"><?= old('description') ?></textarea>
                                        </div>
                                        <?php if($validation->getError('description')){ echo '<div class="invalid-feedback">'.$validation->getError('description').'</div>'; } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="font-weight-bold">Owner Product <span class="text-danger">*</span></label>
                                        <select class="form-control select select2 <?= ($validation->getError('owners_id')) ? 'is-invalid' : ''; ?>" value="<?= old('owners_id'); ?>" id="owners_id" name="owners_id">
                                            <option value="" selected></option>
                                            <?php foreach(@$owner as $row) { ?>
                                            <option value="<?= @$row->owners_id; ?>" <?php if(@$row->owners_id == old('owners_id')){ echo 'selected'; } ?>><?= @$row->owners_name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php if($validation->getError('owners_id')){ echo '<div class="invalid-feedback">'.$validation->getError('owners_id').'</div>'; } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('material'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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