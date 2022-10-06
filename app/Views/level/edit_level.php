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
                        <a href="" class="text-muted">Level</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Level Data</a>
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
                            <h3 class="card-title">Edit Level</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('level/update'); ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Level Name
                                    <span class="text-danger">*</span></label>
                                    <input type="hidden" name="level_id" value="<?= $level->level_id ?>" />
                                    <input type="text" name="level_name" value="<?= $level->level_name ?>" class="form-control <?= ($validation->getError('level_name')) ? 'is-invalid' : ''; ?>" placeholder="Enter name" />
                                    <?php if($validation->getError('level_name')){ echo '<div class="invalid-feedback">'.$validation->getError('level_name').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Level Category
                                    <span class="text-danger">*</span></label>
                                        <select class="select2 select form-control custom-select <?= ($validation->getError('level_type')) ? 'is-invalid' : ''; ?>" value="<?= old('level_type'); ?>" id="level_type" name="level_type" >
                                            <option></option>
                                            <option value="0" <?php if($level->level_type == 0){echo "selected";} ?>>Warehouse</option>
                                            <option value="1" <?php if($level->level_type == 1){echo "selected";} ?>>Seller</option>
                                        </select>
                                    <?php if($validation->getError('level_type')){ echo '<div class="invalid-feedback">'.$validation->getError('level_type').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Level Status
                                    <span class="text-danger">*</span></label>
                                        <select class="select2 select form-control custom-select <?= ($validation->getError('level_status')) ? 'is-invalid' : ''; ?>" value="<?= old('level_status'); ?>" id="level_status" name="level_status" >
                                            <option></option>
                                            <option value="1" <?php if($level->level_status == 1){echo "selected";} ?>>Active</option>
                                            <option value="0" <?php if($level->level_status == 0){echo "selected";} ?>>Inactive</option>
                                        </select>
                                    <?php if($validation->getError('level_type')){ echo '<div class="invalid-feedback">'.$validation->getError('level_status').'</div>'; } ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('level'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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