<?php use App\Models\StateModel; ?>
<?php use App\Models\TopupModel; ?>
<?php $this->state = new StateModel(); ?>
<?php $this->topup = new TopupModel(); ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Profile</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Seller</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Seller Profile</a>
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
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
        <div class="container"> 
            <div class="row">
                <div class="col-md-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b example example-compact">

                        <div class="card-header">
                            <h3 class="card-title">Seller Profile</h3>
                        </div>
                        <!--begin::Content-->
                        <div id="kt_account_profile_details" class="collapse show">
                            <!--begin::Form-->
                            <form id="kt_account_profile_details_form" class="form" method="POST" action="<?php echo base_url('owners/updateSeller'); ?>">
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <?= session()->getFlashdata('message'); ?>
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label text-lg-right required fw-bold fs-6 ">Store Name<span class="text-danger">*</span></label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <input type="hidden" name="owners_id" value="<?= $owner->owners_id ?>" />
                                            <input type="text" name="owners_name" class="form-control <?= ($validation->getError('owners_name')) ? 'is-invalid' : ''; ?>" placeholder="Enter name" value="<?= $owner->owners_name ?>" />
                                            <?php if($validation->getError('owners_name')){ echo '<div class="invalid-feedback">'.$validation->getError('owners_name').'</div>'; } ?>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label text-lg-right required fw-bold fs-6">Store Address<span class="text-danger">*</span></label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                        <textarea name="owners_address" class="form-control <?= ($validation->getError('owners_address')) ? 'is-invalid' : ''; ?>" placeholder="Enter address"><?= $owner->owners_address ?></textarea>
                                            <?php if($validation->getError('owners_address')){ echo '<div class="invalid-feedback">'.$validation->getError('owners_address').'</div>'; } ?>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label text-lg-right required fw-bold fs-6">Province<span class="text-danger">*</span></label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <select class="select form-control custom-select showproduct <?= ($validation->getError('state_id')) ? 'is-invalid' : ''; ?>" value="<?= old('state_id'); ?>" id="state_id" name="state_id" onchange="get_city()">
                                                <option></option>
                                                <?php if (@$state) :
                                                    foreach ($state as $row) :
                                                ?>
                                                <option value="<?= $row->state_id ?>" <?php if($owner->state_id == $row->state_id){ echo "selected"; }?> ><?= $row->state_name ?></option>
                                                <?php endforeach; endif; ?>
                                            </select>
                                            <?php if($validation->getError('state_id')){ echo '<div class="invalid-feedback">'.$validation->getError('state_id').'</div>'; } ?>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label text-lg-right required fw-bold fs-6">City<span class="text-danger">*</span></label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                        <select class="select form-control custom-select showproduct <?= ($validation->getError('city_id')) ? 'is-invalid' : ''; ?>" value="<?= old('city_id'); ?>" id="city_id" name="city_id" onchange="get_district()">
                                            <option></option>
                                            <option value="<?= @$owner->city_id ?>" selected ><?= @$this->state->getCityById($owner->city_id)->city_name ?></option>
                                        </select>
                                        <?php if($validation->getError('city_id')){ echo '<div class="invalid-feedback">'.$validation->getError('city_id').'</div>'; } ?>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label text-lg-right required fw-bold fs-6">District<span class="text-danger">*</span></label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <select class="select form-control custom-select showproduct <?= ($validation->getError('district_id')) ? 'is-invalid' : ''; ?>" value="<?= old('district_id'); ?>" id="district_id" name="district_id" onchange="get_sub_district()">
                                                <option></option>
                                                <option value="<?= @$owner->district_id ?>" selected ><?= @$this->state->getDistrictById($owner->district_id)->district_name ?></option>
                                            </select>
                                        <?php if($validation->getError('district_id')){ echo '<div class="invalid-feedback">'.$validation->getError('district_id').'</div>'; } ?>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label text-lg-right required fw-bold fs-6">Sub District<span class="text-danger">*</span></label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                        <select class="select form-control custom-select showproduct <?= ($validation->getError('sdistrict_id')) ? 'is-invalid' : ''; ?>" value="<?= old('sdistrict_id'); ?>" id="sdistrict_id" name="sdistrict_id">
                                            <option></option>
                                            <option value="<?= @$owner->sdistrict_id ?>" selected ><?= @$this->state->getSubDistrictById($owner->sdistrict_id)->sdistrict_name ?></option>
                                        </select>
                                        <?php if($validation->getError('sdistrict_id')){ echo '<div class="invalid-feedback">'.$validation->getError('sdistrict_id').'</div>'; } ?>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label text-lg-right required fw-bold fs-6">Store Location<span class="text-danger">*</span></label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <div class="form-group row">
                                                <div class="col-md-5">
                                                    <input type="text" onkeypress="return CheckNumeric()" value="<?= $owner->owners_latitude ?>" class="form-control <?= ($validation->getError('owners_latitude')) ? 'is-invalid' : ''; ?>" id="owners_latitude" name="owners_latitude" 
                                                    placeholder="Latitude" />
                                                    
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" onkeypress="return CheckNumeric()" value="<?= $owner->owners_longitude ?>" class="form-control  <?= ($validation->getError('owners_longitude')) ? 'is-invalid' : ''; ?>" id="owners_longitude" name="owners_longitude" 
                                                    placeholder="Longitude" />
                                                    
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-latlong" title="Pilih Titik Koordinat"><i class="fa fa-map-marker-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label text-lg-right required fw-bold fs-6">Owner Status<span class="text-danger">*</span></label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row pt-3">
                                            <div class="radio-inline">
                                                <label class="radio">
                                                <input type="radio" <?php if(@$owner->owners_status == 1){echo "checked";}?> name="status" id="status" value="1">
                                                <span></span>Active</label>
                                                <label class="radio radio-danger">
                                                <input type="radio" <?php if(@$owner->owners_status == 0){echo "checked";}?> name="status" id="status" value="0">
                                                <span></span>Inactive</label>
                                            </div>
                                            <?php if($validation->getError('status')){ echo '<div class="invalid-feedback">'.$validation->getError('status').'</div>'; } ?>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Card body-->
                                <!--begin::Actions-->
                                <div class="card-footer col-10 d-flex justify-content-end py-6 px-9">
                                    <a href="<?= base_url('dashboard_seller'); ?>" class="btn btn-light btn-active-light-primary me-2" type="reset">Discard</a>
                                    <!-- <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button> -->
                                    <button type="submit" class="btn btn-primary ml-2" id="kt_account_profile_details_submit">Save Changes</button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Content-->
                    </div>
                    
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Account Profile </h3>
                        </div>
                        <!--begin::Content-->
                        <div id="kt_account_profile_details" class="collapse show">
                            <!--begin::Form-->
                            <form id="kt_account_profile_details_form" class="form" method="POST" action="<?php echo base_url('owners/updateAccount'); ?>">
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <?= session()->getFlashdata('message_profile'); ?>
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label text-lg-right required fw-bold fs-6 ">Email<span class="text-danger">*</span></label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <input type="hidden" name="owners_id" value="<?= $owner->owners_id ?>" />
                                            <input type="hidden" name="user_id" value="<?= $users->user_id ?>" />
                                            <input type="text" name="email" class="form-control <?= ($validation->getError('email')) ? 'is-invalid' : ''; ?>" placeholder="Enter name" value="<?= $users->email ?>" />
                                            <?php if($validation->getError('email')){ echo '<div class="invalid-feedback">'.$validation->getError('email').'</div>'; } ?>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label text-lg-right required fw-bold fs-6 ">Phone Number<span class="text-danger">*</span></label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <input type="text" name="phone" class="form-control <?= ($validation->getError('phone')) ? 'is-invalid' : ''; ?>" placeholder="Enter name" value="<?= $users->phone ?>" />
                                            <?php if($validation->getError('phone')){ echo '<div class="invalid-feedback">'.$validation->getError('phone').'</div>'; } ?>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Card body-->
                                <!--begin::Actions-->
                                <div class="card-footer col-10 d-flex justify-content-end py-6 px-9">
                                    <a href="<?= base_url('dashboard_seller'); ?>" class="btn btn-light btn-active-light-primary me-2" type="reset">Discard</a>
                                    <!-- <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button> -->
                                    <button type="submit" class="btn btn-primary ml-2" id="kt_account_profile_details_submit">Save Changes</button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Content-->
                    </div>

                    <div class="card card-custom gutter-b">
                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
                            <div class="card-title">
                                <h3 class="card-label">Bank Account Data
                                <span class="d-block text-muted pt-2 font-size-sm">scrollable datatable with fixed height</span></h3>
                            </div>
                            <div class="card-toolbar">
                                <!--begin::Button-->
                                <a href="<?= base_url('owners/addOwnersBank'); ?>" class="btn btn-primary font-weight-bolder">
                                <span class="svg-icon svg-icon-md">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                            <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>Add Bank Account</a>
                                <!--end::Button-->
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin: Datatable-->
                            <?= session()->getFlashdata('message_bank'); ?>
                            <table class="table table-separate table-head-custom table-checkable">
                                <thead>
                                    <tr>
                                        <th data-orderable="false">No</th>
                                        <th data-orderable="false">Actions</th>
                                        <th>Bank Account</th>
                                        <th>Account Name</th>
                                        <th>Account Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    <?php 
                                        if(!empty($bank_account)){
                                        foreach(@$bank_account as $row) { ?>
                                            <tr>
                                                <td scope="row" th width="3%"><?= $i; ?></td>
                                                <td width="10%" align="center">
                                                <button class="btn btn-sm btn-clean btn-icon mr-1" id="delete_bankAccount" data-id="<?=@$row->owners_bank_id?>" title="Delete"><span class="svg-icon svg-icon-danger svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                        <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                                                    </g>
                                                </svg></span></button>
                                                </td>
                                                <td><?= @$row->bank_name; ?></td>
                                                <td><?= @$row->account_name; ?></td>
                                                <td><?= @$row->account_number; ?></td>
                                            </tr>
                                        <?php $i++ ?>
                                        <?php } 
                                        }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card card-custom gutter-b">
                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
                            <div class="card-title">
                                <h3 class="card-label">Store Marketplace Data
                                <span class="d-block text-muted pt-2 font-size-sm">scrollable datatable with fixed height</span></h3>
                            </div>
                            <div class="card-toolbar">
                                <!--begin::Button-->
                                <a href="<?= base_url('owners/add_marketplace'); ?>" class="btn btn-primary font-weight-bolder">
                                <span class="svg-icon svg-icon-md">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                            <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>Add Marketplace</a>
                                <!--end::Button-->
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin: Datatable-->
                            <?= session()->getFlashdata('message_market'); ?>
                            <table class="table table-separate table-head-custom table-checkable">
                                <thead>
                                    <tr>
                                        <th data-orderable="false">No</th>
                                        <th data-orderable="false">Actions</th>
                                        <th >Marketplace</th>
                                        <th>Market Link</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    <?php 
                                        if(!empty($market)){
                                        foreach(@$market as $row) { ?>
                                            <tr >
                                                <td style="margin-top: 5px; margin-bottom: 5px" scope="row" width="3%"><?= $i; ?></td>
                                                <td width="10%" align="center">
                                                    <a href="<?= base_url('owners/edit_marketplace/'.@$row->owners_market_id)?>" class="btn btn-sm btn-clean btn-icon mr-1" title="Edit"><span class="svg-icon svg-icon-warning svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                                                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                        </g>
                                                    </svg></span></a>
                                                    <button class="btn btn-sm btn-clean btn-icon mr-1" id="delete_market" data-id="<?=@$row->owners_market_id?>" title="Delete"><span class="svg-icon svg-icon-danger svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                            <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                                                        </g>
                                                        </svg></span>
                                                    </button>
                                                </td>
                                                <td><?= @$row->market_name; ?></td>
                                                <td><a href="<?= @$row->market_url; ?>" target="_blank"><?= @$row->market_url; ?></a></td>
                                                <td><?= @$row->market_remark; ?></td>
                                            </tr>
                                        <?php $i++ ?>
                                        <?php } 
                                        }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card card-custom gutter-b">
                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
                            <div class="card-title">
                                <h3 class="card-label">Upload Special Agreement
                                <span class="d-block text-muted pt-2 font-size-sm">scrollable datatable with fixed height</span></h3>
                            </div>
                            <div class="card-toolbar">
                                <!--begin::Button-->
                                <a href="<?= base_url('owners/add_agreement'); ?>" class="btn btn-primary font-weight-bolder">
                                <span class="svg-icon svg-icon-md">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                            <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>Add Agreement</a>
                                <!--end::Button-->
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin: Datatable-->
                            <?= session()->getFlashdata('message_agreement'); ?>
                            <table class="table table-separate table-head-custom table-checkable">
                                <thead>
                                    <tr>
                                        <th data-orderable="false">No</th>
                                        <th data-orderable="false">Actions</th>
                                        <th>Filename</th>
                                        <th>Remark</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;?>
                                    <?php 
                                        if(!empty($agreement)){
                                        foreach(@$agreement as $row) { ?>
                                            <tr >
                                                <td style="margin-top: 5px; margin-bottom: 5px" scope="row" width="3%"><?= $i; ?></td>
                                                <td width="10%" align="center">
                                                    <a href="<?= base_url('owners/edit_agreement/'.@$row->agreement_id)?>" class="btn btn-sm btn-clean btn-icon mr-1" title="Edit"><span class="svg-icon svg-icon-warning svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                                                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                        </g>
                                                    </svg></span></a>
                                                    <button class="btn btn-sm btn-clean btn-icon mr-1" id="delete_agreement" data-id="<?=@$row->agreement_id?>" title="Delete"><span class="svg-icon svg-icon-danger svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                            <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                                                        </g>
                                                        </svg></span>
                                                    </button>
                                                </td>
                                                <td><a href="<?= base_url('../file/special-agreement/'.session()->get('owners_id').'/'.$row->agreement_file) ?>" target="_blank"><?= @$row->agreement_file; ?></a></td>
                                                <td><?= @$row->agreement_remark; ?></td>
                                                <td><?php if(@$row->agreement_status == 1){echo '<span class="badge badge-success">Active</span>';}else if(@$row->agreement_status == 0){echo '<span class="badge badge-danger">Inactive</span>';}?></td>
                                            </tr>
                                        <?php $i++ ?>
                                        <?php } 
                                        }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
    </div>
	<!--end::Entry-->
</div>
<!--end::Content-->

<div class="modal fade" id="modal-latlong">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Titik Koordinat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="mapz" style="height: 400px; width: 100%;"></div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" data-dismiss="modal">Pilih</a>
            </div>
        </div>
    </div>
</div>
<script>
    function initMap() {
        var x = navigator.geolocation;
        x.getCurrentPosition(success, failure);

        function success(position){
            var myLat = position.coords.latitude;
            var myLong = position.coords.longitude;

            var coords = {lat: myLat, lng: myLong};

            var map = new google.maps.Map(document.getElementById('mapz'), {
                zoom: 17,
                center: coords,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            });

            var marker = new google.maps.Marker({
                position: coords,
                map: map,
                title: 'Pilih Lokasi Kantor',
                draggable: true
            });

            google.maps.event.addListener(marker, 'dragend', function(marker){
                var latLng = marker.latLng;
                document.getElementById("owners_latitude").value = latLng.lat();
                document.getElementById("owners_longitude").value = latLng.lng();
            }); 
        }
        
        function failure(){
            alert('Geolocation failure!');
            var coords = {lat: -6.168117, lng: 106.835152};

            var map = new google.maps.Map(document.getElementById('mapz'), {
                zoom: 17,
                center: coords,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            });

            var marker = new google.maps.Marker({
                position: coords,
                map: map,
                title: 'Pilih Lokasi Kantor',
                draggable: true
            });

            google.maps.event.addListener(marker, 'dragend', function(marker){
                var latLng = marker.latLng;
                document.getElementById("owners_latitude").value = latLng.lat();
                document.getElementById("owners_longitude").value = latLng.lng();
            });
        }
    }
</script>
