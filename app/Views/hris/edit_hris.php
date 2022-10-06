<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">User HRIS Data</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">User HRIS</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">User HRIS Data</a>
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
                            <h3 class="card-title">Edit User HRIS</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('userhris/update'); ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>NIK
                                    <span class="text-danger">*</span></label>
                                    <input type="text" name="hris_nik" value="<?= $hris->hris_nik ?>" class="form-control <?= ($validation->getError('hris_nik')) ? 'is-invalid' : ''; ?>" placeholder="Enter sub name" readonly/>
                                    <?php if($validation->getError('hris_nik')){ echo '<div class="invalid-feedback">'.$validation->getError('hris_nik').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Employee Name
                                    <span class="text-danger">*</span></label>
                                    <input type="text" name="hris_name" value="<?= $hris->hris_name ?>" class="form-control <?= ($validation->getError('hris_name')) ? 'is-invalid' : ''; ?>" placeholder="Enter sub name" readonly/>
                                    <?php if($validation->getError('hris_name')){ echo '<div class="invalid-feedback">'.$validation->getError('hris_name').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Email
                                    <span class="text-danger">*</span></label>
                                    <input type="text" name="hris_email" value="<?= $hris->hris_email ?>" class="form-control <?= ($validation->getError('hris_email')) ? 'is-invalid' : ''; ?>" placeholder="Enter sub name" readonly/>
                                    <?php if($validation->getError('hris_email')){ echo '<div class="invalid-feedback">'.$validation->getError('hris_email').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>User Level
                                    <span class="text-danger">*</span></label>
                                    <select class="select form-control custom-select showproduct <?= ($validation->getError('user_level')) ? 'is-invalid' : ''; ?>" value="<?= old('user_level'); ?>" id="user_level" name="user_level">
                                        <option></option>
                                        <?php if (@$level) :
                                            foreach ($level as $row) :
                                        ?>
                                        <option value="<?= $row->level_id ?>" <?php if($hris->user_level == $row->level_id){echo "selected";} ?>><?= $row->level_name ?></option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                    <?php if($validation->getError('')){ echo '<div class="invalid-feedback">'.$validation->getError('user_level').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>User Warehouse
                                    <span class="text-danger">*</span></label>
                                    <select class="select form-control custom-select showproduct <?= ($validation->getError('warehouse_id')) ? 'is-invalid' : ''; ?>" value="<?= old('warehouse_id'); ?>" id="warehouse_id" name="warehouse_id">
                                        <option></option>
                                        <option value="POSLOG" <?php if($hris->warehouse_id == "POSLOG"){echo "selected";} ?>>User Poslog</option>
                                        <?php if (@$warehouse) :
                                            foreach ($warehouse as $row) :
                                        ?>
                                        <option value="<?= $row->warehouse_id ?>" <?php if($hris->warehouse_id == $row->warehouse_id){echo "selected";} ?>><?= $row->wh_name ?></option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                    <?php if($validation->getError('')){ echo '<div class="invalid-feedback">'.$validation->getError('warehouse_id').'</div>'; } ?>
                                    <span class="form-text text-muted">'User Poslog' can access all warehouse data</span>
                                </div>
                                <div class="form-group">
                                    <label>User Status
                                    <span class="text-danger">*</span></label>
                                        <select class="select2 select form-control custom-select <?= ($validation->getError('hris_status')) ? 'is-invalid' : ''; ?>" value="<?= old('hris_status'); ?>" id="hris_status" name="hris_status" >
                                            <option></option>
                                            <option value="1" <?php if($hris->hris_status == 1){echo "selected";} ?>>Active</option>
                                            <option value="0" <?php if($hris->hris_status == 0){echo "selected";} ?>>Inactive</option>
                                        </select>
                                    <?php if($validation->getError('hris_status')){ echo '<div class="invalid-feedback">'.$validation->getError('hris_status').'</div>'; } ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('userhris'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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