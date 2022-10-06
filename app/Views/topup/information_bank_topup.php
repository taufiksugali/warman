<div class="form-group row">
    <div class="col-3">
        <label>Account Bank <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-control-solid" value="<?= @$owners_account_bank->bank_name ?>" readonly/>
    </div>
    <div class="col-3">
        <label>Account Name <span class="text-danger">*</span></label>
        <input type="text" name="topup_name" class="form-control form-control-solid" value="<?= @$owners_account_bank->account_name ?>" readonly/>
    </div>
    <div class="col-3">
        <label>Account Number <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-control-solid" value="<?= @$owners_account_bank->account_number ?>" readonly/>
    </div>
    <div class="col-3">
        <label>Account Status <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-control-solid" value="<?php if(@$owners_account_bank->status){echo "Active";} else {echo "Inactive";} ?>" readonly/>
    </div>
    <input hidden type="text" name="from_bank" id="from_bank" class="form-control form-control-solid" value="<?= @$owners_account_bank->bank_id ?>"/>
</div>