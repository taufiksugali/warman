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
                        <a href="" class="text-muted">Level</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Add Level</a>
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
                            <h3 class="card-title">Edit Level</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('shelf/update'); ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="font-weight-bold">Warehouse Name<span class="text-danger">*</span></label>
                                    <input type="hidden" value="<?= $shelf_edit->shelf_id ?>" name="shelf_id" />
                                    <select class="form-control select select2 <?= ($validation->getError('warehouse_id')) ? 'is-invalid' : ''; ?>" value="<?= old('warehouse_id'); ?>" id="wh_id" name="warehouse_id">
                                        <option value="" selected></option>
                                        <?php foreach(@$warehouse as $row) { ?>
                                        <option value="<?= @$row->warehouse_id; ?>" <?php if($shelf_edit->warehouse_id == $row->warehouse_id){echo "selected";} ?>><?= @$row->wh_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php if($validation->getError('warehouse_id')){ echo '<div class="invalid-feedback">'.$validation->getError('warehouse_id').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Area Name<span class="text-danger">*</span></label>
                                    <select class="form-control select select2 <?= ($validation->getError('area_id')) ? 'is-invalid' : ''; ?>" value="<?= old('area_id'); ?>" id="area_id" name="area_id">
                                        <option value="" selected></option>
                                        <?php foreach(@$wh_area as $row) { ?>
                                        <option value="<?= @$row->area_id; ?>" <?php if($shelf_edit->wh_area_id == $row->area_id){echo "selected";} ?>><?= @$row->wh_area_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php if($validation->getError('area_id')){ echo '<div class="invalid-feedback">'.$validation->getError('area_id').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Block Name<span class="text-danger">*</span></label>
                                    <select class="form-control select select2 <?= ($validation->getError('blok_id')) ? 'is-invalid' : ''; ?>" value="<?= old('blok_id'); ?>" id="blok_id" name="blok_id">
                                        <option value="" selected></option>
                                        <?php foreach(@$blok as $row) { ?>
                                        <option value="<?= @$row->blok_id; ?>" <?php if($shelf_edit->blok_id == $row->blok_id){echo "selected";} ?>><?= @$row->blok_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php if($validation->getError('blok_id')){ echo '<div class="invalid-feedback">'.$validation->getError('blok_id').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Pallet Name<span class="text-danger">*</span></label>
                                    <select class="form-control select select2 <?= ($validation->getError('rak_id')) ? 'is-invalid' : ''; ?>" value="<?= old('rak_id'); ?>" id="rak_id" name="rak_id">
                                        <option value="" selected></option>
                                        <?php foreach(@$rak as $row) { ?>
                                        <option value="<?= @$row->rak_id; ?>" <?php if($shelf_edit->rak_id == $row->rak_id){echo "selected";} ?>><?= @$row->rak_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php if($validation->getError('rak_id')){ echo '<div class="invalid-feedback">'.$validation->getError('rak_id').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Level Code
                                    <span class="text-danger">*</span></label>
                                    <input type="text" value="<?= $shelf_edit->shelf_code ?>" name="shelf_code" class="form-control <?= ($validation->getError('shelf_code')) ? 'is-invalid' : ''; ?>" placeholder="Enter code" />
                                    <?php if($validation->getError('shelf_code')){ echo '<div class="invalid-feedback">'.$validation->getError('shelf_code').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Level Name
                                    <span class="text-danger">*</span></label>
                                    <input type="text" value="<?= $shelf_edit->shelf_name ?>" name="shelf_name" class="form-control <?= ($validation->getError('shelf_name')) ? 'is-invalid' : ''; ?>" placeholder="Enter name" />
                                    <?php if($validation->getError('shelf_name')){ echo '<div class="invalid-feedback">'.$validation->getError('shelf_name').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Level Max Capacity
                                    <span class="text-danger">*</span></label>
                                    <input type="text" name="shelf_max" value="<?= $shelf_edit->shelf_max ?>" class="form-control <?= ($validation->getError('shelf_max')) ? 'is-invalid' : ''; ?>" placeholder="Enter name" />
                                    <?php if($validation->getError('shelf_max')){ echo '<div class="invalid-feedback">'.$validation->getError('shelf_max').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Level Status
                                    <span class="text-danger">*</span></label>
                                        <select class="select2 select form-control custom-select <?= ($validation->getError('status')) ? 'is-invalid' : ''; ?>" value="<?= old('status'); ?>" id="status" name="status" >
                                            <option></option>
                                            <option value="1" <?php if($shelf_edit->status == 1){echo "selected";} ?>>Active</option>
                                            <option value="0" <?php if($shelf_edit->status == 0){echo "selected";} ?>>Inactive</option>
                                        </select>
                                    <?php if($validation->getError('status')){ echo '<div class="invalid-feedback">'.$validation->getError('status').'</div>'; } ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('shelf'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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