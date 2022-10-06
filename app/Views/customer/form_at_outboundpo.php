<?php use App\Models\StateModel; ?>
<?php $this->state = new StateModel(); ?>
<?php $disabled = ''; ?>
<?php $class = ''; ?>
<?php if(@$customer) { $disabled = "disabled"; $class="form-control-solid"; } ?>
<label><strong>Add Customer Information:</strong> </label>
<div class="form-group row">
    <div class="col-4">
        <label>Customer Name
        <span class="text-danger">*</span></label>
        <input type="text" name="customer_name" <?= $disabled ?> value="<?= @$customer->customer_name ?>" class="form-control <?= ($validation->getError('customer_name')) ? 'is-invalid' : ''; ?>" placeholder="Enter name" />
        <?php if($validation->getError('customer_name')){ echo '<div class="invalid-feedback">'.$validation->getError('customer_name').'</div>'; } ?>
    </div>
    <div class="col-4">
        <label>Customer Phone
        <span class="text-danger">*</span></label>
        <input type="text" <?= $disabled ?> name="pic_phone" class="form-control <?= ($validation->getError('pic_phone')) ? 'is-invalid' : ''; ?>" value="<?= @$customer->customer_phone ?>" onkeypress="return CheckNumeric()" placeholder="Enter phone" />
        <?php if($validation->getError('pic_phone')){ echo '<div class="invalid-feedback">'.$validation->getError('pic_phone').'</div>'; } ?>
    </div>
    <div class="col-4">
        <label>Customer Email
        <span class="text-danger">*</span></label>
        <input type="text" <?= $disabled ?> name="pic_email" class="form-control <?= ($validation->getError('pic_email')) ? 'is-invalid' : ''; ?>" value="<?= @$customer->customer_email ?>" placeholder="Enter email" />
        <?php if($validation->getError('pic_email')){ echo '<div class="invalid-feedback">'.$validation->getError('pic_email').'</div>'; } ?>
    </div>
</div>

<div class="form-group row">
    <div class="col-12">
        <label>Customer Address
        <span class="text-danger">*</span></label>
        <textarea name="customer_address" <?= $disabled ?> class="form-control <?= ($validation->getError('customer_address')) ? 'is-invalid' : ''; ?>" placeholder="Enter address"><?= @$customer->customer_address ?></textarea>
        <?php if($validation->getError('customer_address')){ echo '<div class="invalid-feedback">'.$validation->getError('customer_address').'</div>'; } ?>
    </div>    
</div>

<div class="form-group row">
    <div class="col-6">
        <label>Province
        <span class="text-danger">*</span></label>
        <select <?= $disabled ?> class="select form-control <?= $class ?> custom-select <?= ($validation->getError('state_id')) ? 'is-invalid' : ''; ?>" value="<?= old('state_id'); ?>" id="state_id" name="state_id" onchange="get_city()">
            <?php if(!@$customer){ ?>
                <option></option>
                <?php if (@$state) :
                    foreach ($state as $row) :
                ?>
                <option value="<?= $row->state_id ?>"><?= $row->state_name ?></option>
                <?php endforeach; endif; ?>
            <?php } else { ?>
                <option></option>
                <?php if (@$state) :
                    foreach ($state as $row) :
                ?>
                <option value="<?= $row->state_id ?>" <?php if($customer->state_id == $row->state_id){ echo "selected"; }?> ><?= $row->state_name ?></option>
                <?php endforeach; endif; ?>
            <?php } ?>
        </select>
        <?php if($validation->getError('state_id')){ echo '<div class="invalid-feedback">'.$validation->getError('state_id').'</div>'; } ?>
    </div>
    <div class="col-6">
        <label>City
        <span class="text-danger">*</span></label>
        <select <?= $disabled ?> class="select form-control custom-select <?= $class ?>  <?= ($validation->getError('city_id')) ? 'is-invalid' : ''; ?>" value="<?= old('city_id'); ?>" id="city_id" name="city_id" onchange="get_district()">
            <option></option>
            <?php if(@$customer){ ?>
                <option value="<?= @$city_name ?>" selected><?= @$city_name ?></option>
            <?php } ?>
        </select>
        <?php if($validation->getError('city_id')){ echo '<div class="invalid-feedback">'.$validation->getError('city_id').'</div>'; } ?>
    </div>
</div>

<div class="form-group row">
    <div class="col-6">
        <label>District
        <span class="text-danger">*</span></label>
        <select <?= $disabled ?> class="select form-control custom-select <?= $class ?>  <?= ($validation->getError('district_id')) ? 'is-invalid' : ''; ?>" value="<?= old('district_id'); ?>" id="district_id" name="district_id" onchange="get_sub_district()">
            <option></option>
            <?php if(@$customer){ ?>
                <option value="<?= @$district_name ?>" selected><?= @$district_name ?></option>
            <?php } ?>
        </select>
        <?php if($validation->getError('district_id')){ echo '<div class="invalid-feedback">'.$validation->getError('district_id').'</div>'; } ?>
    </div>
    <div class="col-6">    
        <label>Sub District
        <span class="text-danger">*</span></label>
        <select <?= $disabled ?> class="select form-control custom-select <?= $class ?>  <?= ($validation->getError('sdistrict_id')) ? 'is-invalid' : ''; ?>" value="<?= old('sdistrict_id'); ?>" id="sdistrict_id" name="sdistrict_id">
            <option></option>
            <?php if(@$customer){ ?>
                <option value="<?= @$sdistrict_name ?>" selected><?= @$sdistrict_name ?></option>
            <?php } ?>
        </select>
        <?php if($validation->getError('sdistrict_id')){ echo '<div class="invalid-feedback">'.$validation->getError('sdistrict_id').'</div>'; } ?>
    </div>
</div>
<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/crud/forms/widgets/select2.js"></script>