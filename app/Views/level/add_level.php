<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Level</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Level</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Add Level</a>
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
                            <h3 class="card-title">Add Level</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('level/create'); ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Level ID
                                    <span class="text-danger">*</span></label>
                                    <input type="text" name="level_id" class="form-control <?= ($validation->getError('level_id')) ? 'is-invalid' : ''; ?>" required placeholder="Enter ID" />
                                    <?php if($validation->getError('level_id')){ echo '<div class="invalid-feedback">'.$validation->getError('level_id').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Level Name
                                    <span class="text-danger">*</span></label>
                                    <input type="text" name="level_name" class="form-control <?= ($validation->getError('level_name')) ? 'is-invalid' : ''; ?>" required placeholder="Enter name" />
                                    <?php if($validation->getError('level_name')){ echo '<div class="invalid-feedback">'.$validation->getError('level_name').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Level Category
                                    <span class="text-danger">*</span></label>
                                        <select class="select2 select form-control custom-select <?= ($validation->getError('level_type')) ? 'is-invalid' : ''; ?>" value="<?= old('level_type'); ?>" id="level_type" name="level_type" >
                                            <option></option>
                                            <option value="0">Warehouse</option>
                                            <option value="1">Seller</option>
                                        </select>
                                    <?php if($validation->getError('level_type')){ echo '<div class="invalid-feedback">'.$validation->getError('level_type').'</div>'; } ?>
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