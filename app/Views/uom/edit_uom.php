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
                        <a href="" class="text-muted">UoM</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">UoM Owner</a>
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
                            <h3 class="card-title">Edit UoM</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('uom/update'); ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>UoM Name
                                    <span class="text-danger">*</span></label>
                                    <input type="hidden" name="uom_id" value="<?= $uom->uom_id ?>" />
                                    <input type="text" name="uom_name" value="<?= $uom->uom_name ?>" class="form-control <?= ($validation->getError('uom_name')) ? 'is-invalid' : ''; ?>" placeholder="Enter name" />
                                    <?php if($validation->getError('uom_name')){ echo '<div class="invalid-feedback">'.$validation->getError('uom_name').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>UoM Status
                                    <span class="text-danger">*</span></label>
                                        <select class="select2 select form-control custom-select <?= ($validation->getError('status')) ? 'is-invalid' : ''; ?>" value="<?= old('status'); ?>" id="status" name="status" >
                                            <option></option>
                                            <option value="1" <?php if($uom->status == 1){echo "selected";} ?>>Active</option>
                                            <option value="0" <?php if($uom->status == 0){echo "selected";} ?>>Inactive</option>
                                        </select>
                                    <?php if($validation->getError('status')){ echo '<div class="invalid-feedback">'.$validation->getError('status').'</div>'; } ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('uom'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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