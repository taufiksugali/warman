<?php use App\Models\StateModel; ?>
<?php $this->state = new StateModel(); ?>
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
                        <a href="" class="text-muted">Customer</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Edit Customer</a>
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
                            <h3 class="card-title">Edit Customer</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('customer/update'); ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label><strong>Customer Information:</strong> </label>
                                        <br>
                                        <div class="form-group">
                                            <label>Customer Name
                                            <span class="text-danger">*</span></label>
                                            <input type="hidden" name="customer_id" value="<?= $customer->customer_id ?>" />
                                            <input type="text" name="customer_name" class="form-control <?= ($validation->getError('customer_name')) ? 'is-invalid' : ''; ?>" value="<?= $customer->customer_name ?>" placeholder="Enter name" />
                                            <?php if($validation->getError('customer_name')){ echo '<div class="invalid-feedback">'.$validation->getError('customer_name').'</div>'; } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Customer Address
                                            <span class="text-danger">*</span></label>
                                            <textarea name="customer_address" class="form-control <?= ($validation->getError('customer_address')) ? 'is-invalid' : ''; ?>" placeholder="Enter address"><?= $customer->customer_address ?></textarea>
                                            <?php if($validation->getError('customer_address')){ echo '<div class="invalid-feedback">'.$validation->getError('customer_address').'</div>'; } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Province
                                            <span class="text-danger">*</span></label>
                                            <select class="select form-control custom-select showproduct <?= ($validation->getError('state_id')) ? 'is-invalid' : ''; ?>" value="<?= old('state_id'); ?>" id="state_id" name="state_id" onchange="get_city()">
                                                <option></option>
                                                <?php if (@$state) :
                                                    foreach ($state as $row) :
                                                ?>
                                                <option value="<?= $row->state_id ?>" <?php if($customer->state_id == $row->state_id){ echo "selected"; }?> ><?= $row->state_name ?></option>
                                                <?php endforeach; endif; ?>
                                            </select>
                                            <?php if($validation->getError('state_id')){ echo '<div class="invalid-feedback">'.$validation->getError('state_id').'</div>'; } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>City
                                            <span class="text-danger">*</span></label>
                                            <select class="select form-control custom-select showproduct <?= ($validation->getError('city_id')) ? 'is-invalid' : ''; ?>" value="<?= old('city_id'); ?>" id="city_id" name="city_id" onchange="get_district()">
                                                <option></option>
                                                <option value="<?= @$customer->city_id ?>" selected ><?= @$this->state->getCityById($customer->city_id)->city_name ?></option>
                                            </select>
                                            <?php if($validation->getError('city_id')){ echo '<div class="invalid-feedback">'.$validation->getError('city_id').'</div>'; } ?>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Customer Status
                                            <span class="text-danger">*</span></label>
                                                <select class="select2 select form-control custom-select <?= ($validation->getError('status')) ? 'is-invalid' : ''; ?>" value="<?= old('status'); ?>" id="status" name="status" >
                                                    <option></option>
                                                    <option value="1" <?php if($customer->status == 1){echo "selected";} ?>>Active</option>
                                                    <option value="0" <?php if($customer->status == 0){echo "selected";} ?>>Inactive</option>
                                                </select>
                                            <?php if($validation->getError('status')){ echo '<div class="invalid-feedback">'.$validation->getError('status').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label><strong>&nbsp;</strong> </label>
                                        <br>
                                        <div class="form-group">
                                            <label>Customer Phone
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="pic_phone" class="form-control <?= ($validation->getError('pic_phone')) ? 'is-invalid' : ''; ?>" value="<?= $customer->customer_phone ?>" placeholder="Enter phone" onkeypress="return CheckNumeric()" />
                                            <?php if($validation->getError('pic_phone')){ echo '<div class="invalid-feedback">'.$validation->getError('pic_phone').'</div>'; } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Customer Email</label>
                                            <input type="text" name="pic_email" class="form-control <?= ($validation->getError('pic_email')) ? 'is-invalid' : ''; ?>" value="<?= $customer->customer_email ?>" placeholder="Enter email" />
                                            <?php if($validation->getError('pic_email')){ echo '<div class="invalid-feedback">'.$validation->getError('pic_email').'</div>'; } ?>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label>District
                                            <span class="text-danger">*</span></label>
                                            <select class="select form-control custom-select showproduct <?= ($validation->getError('district_id')) ? 'is-invalid' : ''; ?>" value="<?= old('district_id'); ?>" id="district_id" name="district_id" onchange="get_sub_district()">
                                                    <option></option>
                                                    <option value="<?= @$customer->district_id ?>" selected ><?= @$this->state->getDistrictById($customer->district_id)->district_name ?></option>
                                                </select>
                                            <?php if($validation->getError('district_id')){ echo '<div class="invalid-feedback">'.$validation->getError('district_id').'</div>'; } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Sub District
                                            <span class="text-danger">*</span></label>
                                            <select class="select form-control custom-select showproduct <?= ($validation->getError('sdistrict_id')) ? 'is-invalid' : ''; ?>" value="<?= old('sdistrict_id'); ?>" id="sdistrict_id" name="sdistrict_id">
                                                <option></option>
                                                <option value="<?= @$customer->sdistrict_id ?>" selected ><?= @$this->state->getSubDistrictById($customer->sdistrict_id)->sdistrict_name ?></option>
                                            </select>
                                            <?php if($validation->getError('sdistrict_id')){ echo '<div class="invalid-feedback">'.$validation->getError('sdistrict_id').'</div>'; } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('customer'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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