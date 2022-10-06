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
                        <a href="" class="text-muted">Supplier</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Add Supplier</a>
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
                            <h3 class="card-title">Add Supplier</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('supplier/create'); ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label><strong>Supplier Information:</strong> </label>
                                        <br>
                                        <div class="form-group">
                                            <label>Supplier Name
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="supplier_name" class="form-control <?= ($validation->getError('supplier_name')) ? 'is-invalid' : ''; ?>" placeholder="Enter name" />
                                            <?php if($validation->getError('supplier_name')){ echo '<div class="invalid-feedback">'.$validation->getError('supplier_name').'</div>'; } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Supplier Address
                                            <span class="text-danger">*</span></label>
                                            <textarea name="supplier_address" class="form-control <?= ($validation->getError('supplier_address')) ? 'is-invalid' : ''; ?>" placeholder="Enter address"></textarea>
                                            <?php if($validation->getError('supplier_address')){ echo '<div class="invalid-feedback">'.$validation->getError('supplier_address').'</div>'; } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Supplier City
                                            <span class="text-danger">*</span></label>
                                            <select class="select2 select form-control custom-select <?= ($validation->getError('supplier_city')) ? 'is-invalid' : ''; ?>" value="<?= old('supplier_city'); ?>" id="regency" name="supplier_city" >
													<?php if(@$supplier_city) { ?>
                                                    	<option></option>
														<?php foreach($supplier_city as $key => $regency) { ?>
															<?php if(@$supplier_city[$key-1]->province_id != $regency->province_id) { ?>
																<optgroup label="<?= $regency->province_name ?>">
															<?php } ?>
															<option value="<?= $regency->regency_id; ?>" ><?= $regency->regency_name; ?></option>
															<?php if(@$supplier_city[$key+1]->province_id != $regency->province_id) { ?>
																</optgroup>
															<?php } ?>
														<?php }} ?>
                                            		</select>
                                            <?php if($validation->getError('owner_name')){ echo '<div class="invalid-feedback">'.$validation->getError('owner_name').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label><strong>PIC Information:<strong> </label>
                                        <br>
                                        <div class="form-group">
                                            <label>PIC Name
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="pic_name" class="form-control <?= ($validation->getError('pic_name')) ? 'is-invalid' : ''; ?>" placeholder="Enter PIC name" />
                                            <?php if($validation->getError('pic_name')){ echo '<div class="invalid-feedback">'.$validation->getError('pic_name').'</div>'; } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>PIC Phone
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="pic_phone" class="form-control <?= ($validation->getError('pic_phone')) ? 'is-invalid' : ''; ?>" placeholder="Enter PIC phone" />
                                            <?php if($validation->getError('pic_phone')){ echo '<div class="invalid-feedback">'.$validation->getError('pic_phone').'</div>'; } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>PIC Email</label>
                                            <input type="text" name="pic_email" class="form-control <?= ($validation->getError('pic_email')) ? 'is-invalid' : ''; ?>" placeholder="Enter PIC email" />
                                            <?php if($validation->getError('pic_email')){ echo '<div class="invalid-feedback">'.$validation->getError('pic_email').'</div>'; } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('supplier'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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