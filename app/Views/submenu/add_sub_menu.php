<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Sub Menu</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Sub Menu</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Add Sub Menu</a>
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
                            <h3 class="card-title">Add Sub Menu</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('submenu/create'); ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Sub Menu Name
                                    <span class="text-danger">*</span></label>
                                    <input type="text" name="submenu_name" class="form-control <?= ($validation->getError('submenu_name')) ? 'is-invalid' : ''; ?>" placeholder="Enter sub name" />
                                    <?php if($validation->getError('submenu_name')){ echo '<div class="invalid-feedback">'.$validation->getError('submenu_name').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Parent Menu
                                    <span class="text-danger">*</span></label>
                                    <select class="select form-control custom-select showproduct <?= ($validation->getError('menu_id')) ? 'is-invalid' : ''; ?>" value="<?= old('menu_id'); ?>" id="menu_id" name="menu_id">
                                        <option></option>
                                        <?php if (@$menu) :
                                            foreach ($menu as $row) :
                                        ?>
                                        <option value="<?= $row->id ?>"><?= $row->menu_name ?></option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                    <?php if($validation->getError('')){ echo '<div class="invalid-feedback">'.$validation->getError('menu_id').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Controller
                                    <span class="text-danger">*</span></label>
                                    <input type="text" name="controller" class="form-control <?= ($validation->getError('controller')) ? 'is-invalid' : ''; ?>" placeholder="Enter controller name" />
                                    <?php if($validation->getError('controller')){ echo '<div class="invalid-feedback">'.$validation->getError('controller').'</div>'; } ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('submenu'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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