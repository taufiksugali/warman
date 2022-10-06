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
                        <a href="" class="text-muted">MAterial Uom</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Material Uom Data</a>
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
                            <h3 class="card-title">Edit Material Uom</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('materialuom/update'); ?>">
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-md-4">

                                        <label>Material
                                        <span class="text-danger">*</span></label>
                                        <input type="hidden" name="mat_uom_id" value="<?= $matuom->mat_uom_id ?>" />
                                        <select class="select form-control custom-select showproduct <?= ($validation->getError('material_id')) ? 'is-invalid' : ''; ?>" value="<?= old('material_id'); ?>" id="material_id" name="material_id">
                                            <option></option>
                                            <?php if (@$material) :
                                            foreach ($material as $row) :
                                                ?>
                                            <option value="<?= $row->material_id ?>" <?php if($matuom->material_id == $row->material_id){echo "selected";} ?>><?= $row->material_id.' - '. $row->material_name . ' 1 '. $row->uom_name?></option>
                                            <?php endforeach; endif; ?>
                                        </select>
                                        <?php if($validation->getError('')){ echo '<div class="invalid-feedback">'.$validation->getError('material_id').'</div>'; } ?>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Quantity:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                        =
                                                </span>
                                            </div>
                                            <input type="text" value="<?= $matuom->qty ?>" id="qty" name="qty" 
                                            class="form-control <?= ($validation->getError('qty')) ? 'is-invalid' : ''; ?>" 
                                            placeholder="Enter Quantity" onkeypress="return CheckNumeric()">
                                        </div>
                                        <?php if($validation->getError('')){ echo '<div class="invalid-feedback">'.$validation->getError('qty').'</div>'; } ?>
                                        <span class="form-text text-muted">Item amount in 1 Pack</span>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Uom
                                        <span class="text-danger">*</span></label>
                                        <select class="select form-control custom-select showproduct <?= ($validation->getError('uom_id')) ? 'is-invalid' : ''; ?>" value="<?= old('uom_id'); ?>" id="uom_id" name="uom_id">
                                            <option></option>
                                            <?php if (@$uom) :
                                                foreach ($uom as $row) :
                                            ?>
                                            <option value="<?= $row->uom_id ?>" <?php if($matuom->uom_id == $row->uom_id){echo "selected";} ?>><?= $row->uom_name ?></option>
                                            <?php endforeach; endif; ?>
                                        </select>
                                        <?php if($validation->getError('')){ echo '<div class="invalid-feedback">'.$validation->getError('uom_id').'</div>'; } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Material Group is_active
                                    <span class="text-danger">*</span></label>
                                        <select class="select2 select form-control custom-select <?= ($validation->getError('is_active')) ? 'is-invalid' : ''; ?>" value="<?= old('is_active'); ?>" id="is_active" name="is_active" >
                                            <option></option>
                                            <option value="1" <?php if($matuom->is_active == 1){echo "selected";} ?>>Active</option>
                                            <option value="0" <?php if($matuom->is_active == 0){echo "selected";} ?>>Inactive</option>
                                        </select>
                                    <?php if($validation->getError('is_active')){ echo '<div class="invalid-feedback">'.$validation->getError('is_active').'</div>'; } ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('materialgroup'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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