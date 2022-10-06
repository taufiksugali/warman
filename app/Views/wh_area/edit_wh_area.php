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
                        <a href="" class="text-muted">Warehouse Area</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Edit Warehouse Area</a>
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
                            <h3 class="card-title">Edit Warehouse Area</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('wharea/update'); ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="font-weight-bold">Warehouse Name<span class="text-danger">*</span></label>
                                    <input type="hidden" name="area_id" value="<?= $wh_area->area_id?>"/>
                                    <select class="form-control select select2 <?= ($validation->getError('warehouse_id')) ? 'is-invalid' : ''; ?>" value="<?= old('warehouse_id'); ?>" id="service" name="warehouse_id">
                                        <option value="" selected></option>
                                        <?php foreach(@$warehouse as $row) { ?>
                                        <option value="<?= @$row->warehouse_id; ?>" <?php if($wh_area->wh_id==$row->warehouse_id){echo "selected";} ?>><?= @$row->wh_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php if($validation->getError('warehouse_id')){ echo '<div class="invalid-feedback">'.$validation->getError('warehouse_id').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Warehouse Area Code
                                    <span class="text-danger">*</span></label>
                                    <input type="text" value="<?= $wh_area->wh_area_code?>" name="wh_area_code"  class="form-control <?= ($validation->getError('wh_area_code')) ? 'is-invalid' : ''; ?>" placeholder="Enter code" />
                                    <?php if($validation->getError('wh_area_code')){ echo '<div class="invalid-feedback">'.$validation->getError('wh_area_code').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Warehouse Area Name
                                    <span class="text-danger">*</span></label>
                                    <input type="text" value="<?= $wh_area->wh_area_name?>" name="wh_area_name" class="form-control <?= ($validation->getError('wh_area_name')) ? 'is-invalid' : ''; ?>" placeholder="Enter name" />
                                    <?php if($validation->getError('wh_area_name')){ echo '<div class="invalid-feedback">'.$validation->getError('wh_area_name').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Material Condition
                                    <span class="text-danger">*</span></label>
                                    <div class="radio-inline">
                                        <label class="radio">
                                        <input type="radio" <?php if($wh_area->area_mat_st == 1){ echo 'checked' ;} ?> name="material_st" value="1">
                                        <span></span>Good</label>
                                        <label class="radio radio-danger">
                                        <input type="radio" <?php if($wh_area->area_mat_st == 0){ echo 'checked' ;} ?> name="material_st" value="0">
                                        <span></span>Not Good</label>
                                    </div>
                                    <span class="form-text text-muted">Determine whether this area is for good materials or not</span>
                                </div>
                                <!-- tambahin lagi pilihan type of goods disini -->
                                <div class="form-group">
                                    <label class="font-weight-bold">Type of Goods<span class="text-danger">*</span></label>
                                    <select class="form-control select select2 <?= ($validation->getError('jenis_id')) ? 'is-invalid' : ''; ?>" value="<?= old('jenis_id'); ?>" id="jeniss" name="jenis_id">
                                        <option value="" selected></option>
                                        <?php foreach(@$jenis as $row) { ?>
                                        <option value="<?= @$row->jenis_id; ?>" <?php if($wh_area->jenis_id==$row->jenis_id){echo "selected";} ?>><?= @$row->jenis_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php if($validation->getError('warehouse_id')){ echo '<div class="invalid-feedback">'.$validation->getError('warehouse_id').'</div>'; } ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('wharea'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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