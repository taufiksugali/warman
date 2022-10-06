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
                        <a href="" class="text-muted">Material Uom</a>
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
                        <form method="post" class="form" action="<?php echo base_url('materialgroup/update'); ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Material Group Name
                                    <span class="text-danger">*</span></label>
                                    <input type="hidden" name="mat_group_id" value="<?= $matgroup->mat_group_id ?>" />
                                    <input type="text" name="mat_group_name" value="<?= $matgroup->mat_group_name ?>" class="form-control <?= ($validation->getError('mat_group_name')) ? 'is-invalid' : ''; ?>" placeholder="Enter sub name" />
                                    <?php if($validation->getError('mat_group_name')){ echo '<div class="invalid-feedback">'.$validation->getError('mat_group_name').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Jenis
                                    <span class="text-danger">*</span></label>
                                    <select class="select form-control custom-select showproduct <?= ($validation->getError('jenis_id')) ? 'is-invalid' : ''; ?>" value="<?= old('jenis_id'); ?>" id="jenis_id" name="jenis_id">
                                        <option></option>
                                        <?php if (@$jenis) :
                                            foreach ($jenis as $row) :
                                        ?>
                                        <option value="<?= $row->jenis_id ?>" <?php if($matgroup->jenis_id == $row->jenis_id){echo "selected";} ?>><?= $row->jenis_name ?></option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                    <?php if($validation->getError('')){ echo '<div class="invalid-feedback">'.$validation->getError('jenis_id').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Material Group Status
                                    <span class="text-danger">*</span></label>
                                        <select class="select2 select form-control custom-select <?= ($validation->getError('status')) ? 'is-invalid' : ''; ?>" value="<?= old('status'); ?>" id="status" name="status" >
                                            <option></option>
                                            <option value="1" <?php if($matgroup->status == 1){echo "selected";} ?>>Active</option>
                                            <option value="0" <?php if($matgroup->status == 0){echo "selected";} ?>>Inactive</option>
                                        </select>
                                    <?php if($validation->getError('status')){ echo '<div class="invalid-feedback">'.$validation->getError('status').'</div>'; } ?>
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