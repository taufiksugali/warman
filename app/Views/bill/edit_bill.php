<?php use App\Models\OwnersModel; ?>
<?php $this->owner = new OwnersModel(); 
    $owner = $this->owner->get_all_owner();?>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Bill</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Bill Data</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Edit Bill</a>
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
                            <h3 class="card-title">Bill</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" enctype='multipart/form-data' action="<?php echo base_url('bill/update'); ?>">
                            <div class="card-body">
                                <div class="input_fields_wrap">
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label>Seller Name
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="owners_name" readonly autocomplete="off" value="<?= $bill->owners_name ?>" class="form-control <?= ($validation->getError('topup_name')) ? 'is-invalid' : ''; ?>" placeholder="Enter name" />
                                            <?php if($validation->getError('owners_name')){ echo '<div class="invalid-feedback">'.$validation->getError('o').'</div>'; } ?>
                                        </div>
                                        <div class="col-4">
                                        <label>Description
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="description" readonly autocomplete="off" value="<?= $bill->description ?>" class="form-control <?= ($validation->getError('topup_name')) ? 'is-invalid' : ''; ?>" placeholder="Enter name" />
                                            <?php if($validation->getError('topup_name')){ echo '<div class="invalid-feedback">'.$validation->getError('topup_name').'</div>'; } ?>
                                        </div>
                                        <div class="col-4">
                                        <label>Created Date
                                            <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="<?= $bill->created_date ?>" readonly="readonly" name="topup_date" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php if($validation->getError('topup_date')){ echo '<div class="invalid-feedback">'.$validation->getError('topup_date').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label>Ref. ID
                                            <span class="text-danger">*</span></label>
                                                <input type="text" hidden name="bill_id" value="<?= $bill->bill_id ?>" autocomplete="off" class="form-control <?= ($validation->getError('owners_id')) ? 'is-invalid' : ''; ?>"  />
                                                <input type="text" hidden name="po_id" value="<?= $bill->po_id ?>" autocomplete="off" class="form-control <?= ($validation->getError('owners_id')) ? 'is-invalid' : ''; ?>"  />
                                                <div class="input-group">
                                                    <!-- <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            Rp.
                                                        </span>
                                                    </div> -->
                                                    <input type="text" readonly name="ref_id" autocomplete="off" class="form-control <?= ($validation->getError('owners_id')) ? 'is-invalid' : ''; ?>" value="<?= $bill->ref_id ?>" placeholder="Enter code" />
                                                </div>
                                                <?php if($validation->getError('owners_id')){ echo '<div class="invalid-feedback">'.$validation->getError('owners_id').'</div>'; } ?>
                                        </div>
                                        <div class="col-4">
                                            <label>Amount
                                            <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            Rp.
                                                        </span>
                                                    </div>
                                                <input type="text" required name="amount" value="<?= $bill->amount ?>" autocomplete="off" class="form-control <?= ($validation->getError('amount')) ? 'is-invalid' : ''; ?>"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this);"  />
                                                </div>
                                                <?php if($validation->getError('amount')){ echo '<div class="invalid-feedback">'.$validation->getError('amount').'</div>'; } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info mr-2">Update</button>
                                <a href="<?= base_url('bill'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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
