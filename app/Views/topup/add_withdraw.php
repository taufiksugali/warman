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
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Withdraw</a>
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
                            <h3 class="card-title">Withdraw</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" enctype='multipart/form-data' action="<?php echo base_url('topup/create_withdraw'); ?>">
                            <div class="card-body">
                                <div class="input_fields_wrap">
                                <?= session()->getFlashdata('message'); ?>
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label>Current Balance
                                            <span class="text-danger">*</span></label>
                                                <input type="text" hidden name="owners_id" autocomplete="off" class="form-control <?= ($validation->getError('owners_id')) ? 'is-invalid' : ''; ?>" value="<?= session()->get('owners_id') ?>" />
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            Rp.
                                                        </span>
                                                    </div>
                                                <input type="text" readonly name="owners_balance" autocomplete="off" class="form-control <?= ($validation->getError('owners_id')) ? 'is-invalid' : ''; ?>" value="<?= number_format($this->owner->get_owner_byid(session()->get('owners_id'))->owners_balance) ?>" placeholder="Enter code" />
                                                </div>
                                                <?php if($validation->getError('owners_id')){ echo '<div class="invalid-feedback">'.$validation->getError('owners_id').'</div>'; } ?>
                                        </div>
                                        <div class="col-4">
                                            <label>Withdraw Amount
                                            <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            Rp.
                                                        </span>
                                                    </div>
                                                <input type="text" required name="topup_amount" autocomplete="off" class="form-control <?= ($validation->getError('topup_amount')) ? 'is-invalid' : ''; ?>"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this);"  />
                                                </div>
                                                <?php if($validation->getError('topup_amount')){ echo '<div class="invalid-feedback">'.$validation->getError('topup_amount').'</div>'; } ?>
                                        </div>
                                        <div class="col-4">
                                            <label>My Account
                                            <span class="text-danger">*</span></label>
                                            <select class="form-control select select2 <?= ($validation->getError('owners_bank_id')) ? 'is-invalid' : ''; ?>" value="<?= old('owners_bank_id'); ?>" name="owners_bank_id" id="owners_bank_id">
                                                <option value="" selected></option>
                                                <?php foreach(@$owners_bank as $row) { ?>
                                                <option value="<?= @$row->owners_bank_id; ?>"><?= @$row->bank_name . '/' . @$row->account_name . '/' . @$row->account_number; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if($validation->getError('owners_bank_id')){ echo '<div class="invalid-feedback">'.$validation->getError('owners_bank_id').'</div>'; } ?>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info mr-2">Withdraw</button>
                                <a href="<?= base_url('dashboard_seller'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">History</h3>
                        </div>
                        <!--begin::Form-->
                        <div class="card-body">
                            <label><strong>Withdraw History </strong></label>
                            <table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
                                <thead>
                                    <th data-orderable="false">No</th>
                                    <th data-orderable="false" width="10%">Status</th>
                                    <th>Seller</th>
                                    <th>Received By</th>
                                    <th>Bank</th>
                                    <th>Amount</th>
                                    <th>Withdraw Date</th>
                                </thead>
                                <tbody>
                                    <?php if (@$topup) :
                                        $no = 0;
                                        foreach ($topup as $row) :
                                        $no++; 
                                        if(@$row->topup_status == 5) {
                                            $topup_status = '<span class="label label-light-info label-pill label-inline mr-2">Paid</span>';
                                        } elseif(@$row->topup_status == 6) {
                                            $topup_status = '<span class="label label-light-danger label-pill label-inline mr-2">Rejected</span>';
                                        } else { 
                                            $topup_status = '<span class="label label-light-warning label-pill label-inline mr-2">Waiting</span>';
                                        }
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $no ?></td>
                                        <td><?= $topup_status ?></td>
                                        <td><?= @$row->owners_name ?></td>
                                        <td><?= @$row->topup_name ?></td>
                                        <td><?= @$row->bank_name ?></td>
                                        <td>Rp. <?= number_format(@$row->topup_amount) ?></td>
                                        <td><?= date_format(date_create(@$row->topup_date), 'd-m-Y') ?></td>
                                    </tr>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                <tbody>
                            </table>
                        </div>
                        <div class="card-footer text-center">
                            
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
