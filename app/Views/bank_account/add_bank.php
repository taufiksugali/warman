<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Seller Profile</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Bank Account</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Add Bank Account</a>
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
                            <h3 class="card-title">Add Bank Account</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('owners/createOwnersBank'); ?>">
                            <div class="card-body">
                                <div class="row">
                                    <label class="col-lg-4 col-form-label text-lg-right required fw-bold fs-6 ">Bank Account<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="select form-control custom-select select select2 <?= ($validation->getError('bank_id')) ? 'is-invalid' : ''; ?>" value="<?= old('bank_id'); ?>" id="bank_id" name="bank_id" >
                                                <option value="" selected></option>
                                                <?php foreach(@$bank as $row) { ?>
                                                <option value="<?= @$row->bank_id; ?>" <?php if(old('bank_id') == $row->bank_id){echo "selected";}?>><?= @$row->bank_name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if($validation->getError('bank_id')){ echo '<div class="invalid-feedback">'.$validation->getError('bank_id').'</div>'; } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-lg-4 col-form-label text-lg-right required fw-bold fs-6 ">Account Name<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="account_name" id="account_name" class="form-control <?= ($validation->getError('account_name')) ? 'is-invalid' : ''; ?>" value="<?= old('account_name'); ?>" placeholder="Enter Account Name" />
                                            <?php if($validation->getError('account_name')){ echo '<div class="invalid-feedback">'.$validation->getError('account_name').'</div>'; } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-lg-4 col-form-label text-lg-right required fw-bold fs-6 ">Account Number<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="account_number" id="account_number" class="form-control <?= ($validation->getError('account_number')) ? 'is-invalid' : ''; ?>" value="<?= old('account_number'); ?>" placeholder="Enter Account Number" onkeypress="return CheckNumeric()"/>
                                            <?php if($validation->getError('account_number')){ echo '<div class="invalid-feedback">'.$validation->getError('account_number').'</div>'; } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-lg-4 col-form-label text-lg-right required fw-bold fs-6 ">Remark</label>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <textarea name="account_remark" id="account_remark" class="form-control <?= ($validation->getError('account_remark')) ? 'is-invalid' : ''; ?>" value="<?= old('account_remark'); ?>" placeholder="Enter Remark"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-lg-4 col-form-label text-lg-right required fw-bold fs-6 mt-3">Status<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label></label>
                                            <div class="radio-inline">
                                                <label class="radio">
                                                <input type="radio" checked name="status_bank" id="status_bank" value="1">
                                                <span></span>Active</label>
                                                <label class="radio radio-danger">
                                                <input type="radio" name="status_bank" id="status_bank" value="0">
                                                <span></span>Inactive</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('owners/editSeller/'. session()->get('owners_id')); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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