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
                        <a href="" class="text-muted">Menu</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Menu Data</a>
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
                            <h3 class="card-title">Edit Menu</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('menu/update'); ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Menu Name
                                    <span class="text-danger">*</span></label>
                                    <input type="hidden" name="id" value="<?= $menu->id ?>" />
                                    <input type="text" name="menu_name" value="<?= $menu->menu_name ?>" class="form-control <?= ($validation->getError('menu_name')) ? 'is-invalid' : ''; ?>" placeholder="Enter name" />
                                    <?php if($validation->getError('menu_name')){ echo '<div class="invalid-feedback">'.$validation->getError('menu_name').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Icon
                                    <span class="text-danger">*</span></label>
                                    <input type="text" name="icon" value="<?= $menu->icon ?>" class="form-control <?= ($validation->getError('icon')) ? 'is-invalid' : ''; ?>" placeholder="Enter icon name" />
                                    <?php if($validation->getError('icon')){ echo '<div class="invalid-feedback">'.$validation->getError('icon').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Controller
                                    <span class="text-danger">*</span></label>
                                    <input type="text" name="controller" value="<?= $menu->controller ?>" class="form-control <?= ($validation->getError('controller')) ? 'is-invalid' : ''; ?>" placeholder="Enter controller name" />
                                    <?php if($validation->getError('controller')){ echo '<div class="invalid-feedback">'.$validation->getError('controller').'</div>'; } ?>
                                </div>
                                <div class="form-group">
                                    <label>Parent Menu
                                    <span class="text-danger">*</span></label>
                                    <div class="radio-inline">
                                        <label class="radio">
                                        <input type="radio" <?php if($menu->is_parent == 1){echo "checked";} ?> name="is_parent" value="1">
                                        <span></span>Yes</label>
                                        <label class="radio radio-danger">
                                        <input type="radio" <?php if($menu->is_parent == 0){echo "checked";} ?> name="is_parent" value="0">
                                        <span></span>No</label>
                                    </div>
                                    <span class="form-text text-muted">Determine whether this menu is a parent menu or not</span>
                                </div>
                                <div class="form-group">
                                    <label>Menu Status
                                    <span class="text-danger">*</span></label>
                                        <select class="select2 select form-control custom-select <?= ($validation->getError('is_active')) ? 'is-invalid' : ''; ?>" value="<?= old('is_active'); ?>" id="is_active" name="is_active" >
                                            <option></option>
                                            <option value="1" <?php if($menu->is_active == 1){echo "selected";} ?>>Active</option>
                                            <option value="0" <?php if($menu->is_active == 0){echo "selected";} ?>>Inactive</option>
                                        </select>
                                    <?php if($validation->getError('is_active')){ echo '<div class="invalid-feedback">'.$validation->getError('is_active').'</div>'; } ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('menu'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
    </div>
	<!--end::Entry-->
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Fontawesome Icons</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-arrow-alt-circle-left"></i>
                                        </div>
                                        <div class="text-muted">far fa-arrow-alt-circle-left</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-arrow-alt-circle-right"></i>
                                        </div>
                                        <div class="text-muted">far fa-arrow-alt-circle-right</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-arrow-alt-circle-up"></i>
                                        </div>
                                        <div class="text-muted">far fa-arrow-alt-circle-up</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-arrow-alt-circle-down"></i>
                                        </div>
                                        <div class="text-muted">far fa-arrow-alt-circle-down</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-bell-slash"></i>
                                        </div>
                                        <div class="text-muted">far fa-bell-slash</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-bookmark"></i>
                                        </div>
                                        <div class="text-muted">far fa-bookmark</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-building"></i>
                                        </div>
                                        <div class="text-muted">far fa-building</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-calendar"></i>
                                        </div>
                                        <div class="text-muted">far fa-calendar</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-calendar-alt"></i>
                                        </div>
                                        <div class="text-muted">far fa-calendar-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-calendar-check"></i>
                                        </div>
                                        <div class="text-muted">far fa-calendar-check</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-calendar-minus"></i>
                                        </div>
                                        <div class="text-muted">far fa-calendar-minus</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-calendar-plus"></i>
                                        </div>
                                        <div class="text-muted">far fa-calendar-plus</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-calendar-times"></i>
                                        </div>
                                        <div class="text-muted">far fa-calendar-times</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-caret-square-down"></i>
                                        </div>
                                        <div class="text-muted">far fa-caret-square-down</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-caret-square-left"></i>
                                        </div>
                                        <div class="text-muted">far fa-caret-square-left</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-caret-square-right"></i>
                                        </div>
                                        <div class="text-muted">far fa-caret-square-right</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-caret-square-up"></i>
                                        </div>
                                        <div class="text-muted">far fa-caret-square-up</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-chart-bar"></i>
                                        </div>
                                        <div class="text-muted">far fa-chart-bar</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-check-circle"></i>
                                        </div>
                                        <div class="text-muted">far fa-check-circle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-check-square"></i>
                                        </div>
                                        <div class="text-muted">far fa-check-square</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-circle"></i>
                                        </div>
                                        <div class="text-muted">far fa-circle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-clipboard"></i>
                                        </div>
                                        <div class="text-muted">far fa-clipboard</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-clock"></i>
                                        </div>
                                        <div class="text-muted">far fa-clock</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-clone"></i>
                                        </div>
                                        <div class="text-muted">far fa-clone</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-closed-captioning"></i>
                                        </div>
                                        <div class="text-muted">far fa-closed-captioning</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-comment"></i>
                                        </div>
                                        <div class="text-muted">far fa-comment</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-comment-alt"></i>
                                        </div>
                                        <div class="text-muted">far fa-comment-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-comment-dots"></i>
                                        </div>
                                        <div class="text-muted">far fa-comment-dots</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-comments"></i>
                                        </div>
                                        <div class="text-muted">far fa-comments</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-compass"></i>
                                        </div>
                                        <div class="text-muted">far fa-compass</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-copy"></i>
                                        </div>
                                        <div class="text-muted">far fa-copy</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-copyright"></i>
                                        </div>
                                        <div class="text-muted">far fa-copyright</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-credit-card"></i>
                                        </div>
                                        <div class="text-muted">far fa-credit-card</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-dizzy"></i>
                                        </div>
                                        <div class="text-muted">far fa-dizzy</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-dot-circle"></i>
                                        </div>
                                        <div class="text-muted">far fa-dot-circle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-edit"></i>
                                        </div>
                                        <div class="text-muted">far fa-edit</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-envelope"></i>
                                        </div>
                                        <div class="text-muted">far fa-envelope</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-envelope-open"></i>
                                        </div>
                                        <div class="text-muted">far fa-envelope-open</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-eye"></i>
                                        </div>
                                        <div class="text-muted">far fa-eye</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-eye-slash"></i>
                                        </div>
                                        <div class="text-muted">far fa-eye-slash</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-file"></i>
                                        </div>
                                        <div class="text-muted">far fa-file</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-file-alt"></i>
                                        </div>
                                        <div class="text-muted">far fa-file-alt</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-file-archive"></i>
                                        </div>
                                        <div class="text-muted">far fa-file-archive</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-file-audio"></i>
                                        </div>
                                        <div class="text-muted">far fa-file-audio</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-file-code"></i>
                                        </div>
                                        <div class="text-muted">far fa-file-code</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-file-excel"></i>
                                        </div>
                                        <div class="text-muted">far fa-file-excel</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-file-image"></i>
                                        </div>
                                        <div class="text-muted">far fa-file-image</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-file-pdf"></i>
                                        </div>
                                        <div class="text-muted">far fa-file-pdf</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-file-powerpoint"></i>
                                        </div>
                                        <div class="text-muted">far fa-file-powerpoint</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-file-video"></i>
                                        </div>
                                        <div class="text-muted">far fa-file-video</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-file-word"></i>
                                        </div>
                                        <div class="text-muted">far fa-file-word</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-flag"></i>
                                        </div>
                                        <div class="text-muted">far fa-flag</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-flushed"></i>
                                        </div>
                                        <div class="text-muted">far fa-flushed</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-folder"></i>
                                        </div>
                                        <div class="text-muted">far fa-folder</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-folder-open"></i>
                                        </div>
                                        <div class="text-muted">far fa-folder-open</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-font-awesome-logo-full"></i>
                                        </div>
                                        <div class="text-muted">far fa-font-awesome-logo-full</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-frown"></i>
                                        </div>
                                        <div class="text-muted">far fa-frown</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-frown-open"></i>
                                        </div>
                                        <div class="text-muted">far fa-frown-open</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-futbol"></i>
                                        </div>
                                        <div class="text-muted">far fa-futbol</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-gem"></i>
                                        </div>
                                        <div class="text-muted">far fa-gem</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-grimace"></i>
                                        </div>
                                        <div class="text-muted">far fa-grimace</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-grin"></i>
                                        </div>
                                        <div class="text-muted">far fa-grin</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-grin-alt"></i>
                                        </div>
                                        <div class="text-muted">far fa-grin-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-grin-beam"></i>
                                        </div>
                                        <div class="text-muted">far fa-grin-beam</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-grin-beam-sweat"></i>
                                        </div>
                                        <div class="text-muted">far fa-grin-beam-sweat</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-grin-hearts"></i>
                                        </div>
                                        <div class="text-muted">far fa-grin-hearts</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-grin-squint"></i>
                                        </div>
                                        <div class="text-muted">far fa-grin-squint</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-grin-squint-tears"></i>
                                        </div>
                                        <div class="text-muted">far fa-grin-squint-tears</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-grin-stars"></i>
                                        </div>
                                        <div class="text-muted">far fa-grin-stars</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-grin-tears"></i>
                                        </div>
                                        <div class="text-muted">far fa-grin-tears</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-grin-tongue"></i>
                                        </div>
                                        <div class="text-muted">far fa-grin-tongue</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-grin-tongue-squint"></i>
                                        </div>
                                        <div class="text-muted">far fa-grin-tongue-squint</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-grin-tongue-wink"></i>
                                        </div>
                                        <div class="text-muted">far fa-grin-tongue-wink</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-grin-wink"></i>
                                        </div>
                                        <div class="text-muted">far fa-grin-wink</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-hand-lizard"></i>
                                        </div>
                                        <div class="text-muted">far fa-hand-lizard</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-hand-paper"></i>
                                        </div>
                                        <div class="text-muted">far fa-hand-paper</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-hand-peace"></i>
                                        </div>
                                        <div class="text-muted">far fa-hand-peace</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-hand-point-down"></i>
                                        </div>
                                        <div class="text-muted">far fa-hand-point-down</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-hand-point-left"></i>
                                        </div>
                                        <div class="text-muted">far fa-hand-point-left</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-hand-point-right"></i>
                                        </div>
                                        <div class="text-muted">far fa-hand-point-right</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-hand-point-up"></i>
                                        </div>
                                        <div class="text-muted">far fa-hand-point-up</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-hand-pointer"></i>
                                        </div>
                                        <div class="text-muted">far fa-hand-pointer</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-hand-rock"></i>
                                        </div>
                                        <div class="text-muted">far fa-hand-rock</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-hand-scissors"></i>
                                        </div>
                                        <div class="text-muted">far fa-hand-scissors</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-hand-spock"></i>
                                        </div>
                                        <div class="text-muted">far fa-hand-spock</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-handshake"></i>
                                        </div>
                                        <div class="text-muted">far fa-handshake</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-hdd"></i>
                                        </div>
                                        <div class="text-muted">far fa-hdd</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-heart"></i>
                                        </div>
                                        <div class="text-muted">far fa-heart</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-hospital"></i>
                                        </div>
                                        <div class="text-muted">far fa-hospital</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-hourglass"></i>
                                        </div>
                                        <div class="text-muted">far fa-hourglass</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-id-badge"></i>
                                        </div>
                                        <div class="text-muted">far fa-id-badge</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-id-card"></i>
                                        </div>
                                        <div class="text-muted">far fa-id-card</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-image"></i>
                                        </div>
                                        <div class="text-muted">far fa-image</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-images"></i>
                                        </div>
                                        <div class="text-muted">far fa-images</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-keyboard"></i>
                                        </div>
                                        <div class="text-muted">far fa-keyboard</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-kiss"></i>
                                        </div>
                                        <div class="text-muted">far fa-kiss</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-kiss-beam"></i>
                                        </div>
                                        <div class="text-muted">far fa-kiss-beam</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-kiss-wink-heart"></i>
                                        </div>
                                        <div class="text-muted">far fa-kiss-wink-heart</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-laugh"></i>
                                        </div>
                                        <div class="text-muted">far fa-laugh</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-laugh-beam"></i>
                                        </div>
                                        <div class="text-muted">far fa-laugh-beam</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-laugh-squint"></i>
                                        </div>
                                        <div class="text-muted">far fa-laugh-squint</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-laugh-wink"></i>
                                        </div>
                                        <div class="text-muted">far fa-laugh-wink</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-lemon"></i>
                                        </div>
                                        <div class="text-muted">far fa-lemon</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-life-ring"></i>
                                        </div>
                                        <div class="text-muted">far fa-life-ring</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-lightbulb"></i>
                                        </div>
                                        <div class="text-muted">far fa-lightbulb</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-list-alt"></i>
                                        </div>
                                        <div class="text-muted">far fa-list-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-map"></i>
                                        </div>
                                        <div class="text-muted">far fa-map</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-meh"></i>
                                        </div>
                                        <div class="text-muted">far fa-meh</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-meh-blank"></i>
                                        </div>
                                        <div class="text-muted">far fa-meh-blank</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-meh-rolling-eyes"></i>
                                        </div>
                                        <div class="text-muted">far fa-meh-rolling-eyes</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-minus-square"></i>
                                        </div>
                                        <div class="text-muted">far fa-minus-square</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-money-bill-alt"></i>
                                        </div>
                                        <div class="text-muted">far fa-money-bill-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-moon"></i>
                                        </div>
                                        <div class="text-muted">far fa-moon</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-newspaper"></i>
                                        </div>
                                        <div class="text-muted">far fa-newspaper</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-object-group"></i>
                                        </div>
                                        <div class="text-muted">far fa-object-group</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-object-ungroup"></i>
                                        </div>
                                        <div class="text-muted">far fa-object-ungroup</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-paper-plane"></i>
                                        </div>
                                        <div class="text-muted">far fa-paper-plane</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-pause-circle"></i>
                                        </div>
                                        <div class="text-muted">far fa-pause-circle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-play-circle"></i>
                                        </div>
                                        <div class="text-muted">far fa-play-circle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-plus-square"></i>
                                        </div>
                                        <div class="text-muted">far fa-plus-square</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-question-circle"></i>
                                        </div>
                                        <div class="text-muted">far fa-question-circle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-registered"></i>
                                        </div>
                                        <div class="text-muted">far fa-registered</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-sad-cry"></i>
                                        </div>
                                        <div class="text-muted">far fa-sad-cry</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-sad-tear"></i>
                                        </div>
                                        <div class="text-muted">far fa-sad-tear</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-save"></i>
                                        </div>
                                        <div class="text-muted">far fa-save</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-share-square"></i>
                                        </div>
                                        <div class="text-muted">far fa-share-square</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-smile"></i>
                                        </div>
                                        <div class="text-muted">far fa-smile</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-smile-beam"></i>
                                        </div>
                                        <div class="text-muted">far fa-smile-beam</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-smile-wink"></i>
                                        </div>
                                        <div class="text-muted">far fa-smile-wink</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-snowflake"></i>
                                        </div>
                                        <div class="text-muted">far fa-snowflake</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-square"></i>
                                        </div>
                                        <div class="text-muted">far fa-square</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-star"></i>
                                        </div>
                                        <div class="text-muted">far fa-star</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-star-half"></i>
                                        </div>
                                        <div class="text-muted">far fa-star-half</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-sticky-note"></i>
                                        </div>
                                        <div class="text-muted">far fa-sticky-note</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-stop-circle"></i>
                                        </div>
                                        <div class="text-muted">far fa-stop-circle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-sun"></i>
                                        </div>
                                        <div class="text-muted">far fa-sun</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-surprise"></i>
                                        </div>
                                        <div class="text-muted">far fa-surprise</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-thumbs-down"></i>
                                        </div>
                                        <div class="text-muted">far fa-thumbs-down</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-thumbs-up"></i>
                                        </div>
                                        <div class="text-muted">far fa-thumbs-up</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-times-circle"></i>
                                        </div>
                                        <div class="text-muted">far fa-times-circle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-tired"></i>
                                        </div>
                                        <div class="text-muted">far fa-tired</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-trash-alt"></i>
                                        </div>
                                        <div class="text-muted">far fa-trash-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-user"></i>
                                        </div>
                                        <div class="text-muted">far fa-user</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-user-circle"></i>
                                        </div>
                                        <div class="text-muted">far fa-user-circle</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-window-close"></i>
                                        </div>
                                        <div class="text-muted">far fa-window-close</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-window-maximize"></i>
                                        </div>
                                        <div class="text-muted">far fa-window-maximize</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-window-minimize"></i>
                                        </div>
                                        <div class="text-muted">far fa-window-minimize</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl far fa-window-restore"></i>
                                        </div>
                                        <div class="text-muted">far fa-window-restore</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-ad"></i>
                                        </div>
                                        <div class="text-muted">fas fa-ad</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-address-book"></i>
                                        </div>
                                        <div class="text-muted">fas fa-address-book</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-address-card"></i>
                                        </div>
                                        <div class="text-muted">fas fa-address-card</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-adjust"></i>
                                        </div>
                                        <div class="text-muted">fas fa-adjust</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-air-freshener"></i>
                                        </div>
                                        <div class="text-muted">fas fa-air-freshener</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-align-center"></i>
                                        </div>
                                        <div class="text-muted">fas fa-align-center</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-align-justify"></i>
                                        </div>
                                        <div class="text-muted">fas fa-align-justify</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-align-left"></i>
                                        </div>
                                        <div class="text-muted">fas fa-align-left</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-align-right"></i>
                                        </div>
                                        <div class="text-muted">fas fa-align-right</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-allergies"></i>
                                        </div>
                                        <div class="text-muted">fas fa-allergies</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-ambulance"></i>
                                        </div>
                                        <div class="text-muted">fas fa-ambulance</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-american-sign-language-interpreting"></i>
                                        </div>
                                        <div class="text-muted">fas fa-american-sign-language-interpreting</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-anchor"></i>
                                        </div>
                                        <div class="text-muted">fas fa-anchor</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-angle-double-down"></i>
                                        </div>
                                        <div class="text-muted">fas fa-angle-double-down</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-angle-double-left"></i>
                                        </div>
                                        <div class="text-muted">fas fa-angle-double-left</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-angle-double-right"></i>
                                        </div>
                                        <div class="text-muted">fas fa-angle-double-right</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-angle-double-up"></i>
                                        </div>
                                        <div class="text-muted">fas fa-angle-double-up</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-angle-down"></i>
                                        </div>
                                        <div class="text-muted">fas fa-angle-down</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-angle-left"></i>
                                        </div>
                                        <div class="text-muted">fas fa-angle-left</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-angle-right"></i>
                                        </div>
                                        <div class="text-muted">fas fa-angle-right</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-angle-up"></i>
                                        </div>
                                        <div class="text-muted">fas fa-angle-up</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-angry"></i>
                                        </div>
                                        <div class="text-muted">fas fa-angry</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-ankh"></i>
                                        </div>
                                        <div class="text-muted">fas fa-ankh</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-apple-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-apple-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-archive"></i>
                                        </div>
                                        <div class="text-muted">fas fa-archive</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-archway"></i>
                                        </div>
                                        <div class="text-muted">fas fa-archway</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-arrow-alt-circle-down"></i>
                                        </div>
                                        <div class="text-muted">fas fa-arrow-alt-circle-down</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-arrow-alt-circle-left"></i>
                                        </div>
                                        <div class="text-muted">fas fa-arrow-alt-circle-left</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-arrow-alt-circle-right"></i>
                                        </div>
                                        <div class="text-muted">fas fa-arrow-alt-circle-right</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-arrow-alt-circle-up"></i>
                                        </div>
                                        <div class="text-muted">fas fa-arrow-alt-circle-up</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-arrow-circle-down"></i>
                                        </div>
                                        <div class="text-muted">fas fa-arrow-circle-down</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-arrow-circle-left"></i>
                                        </div>
                                        <div class="text-muted">fas fa-arrow-circle-left</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-arrow-circle-right"></i>
                                        </div>
                                        <div class="text-muted">fas fa-arrow-circle-right</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-arrow-circle-up"></i>
                                        </div>
                                        <div class="text-muted">fas fa-arrow-circle-up</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-arrow-down"></i>
                                        </div>
                                        <div class="text-muted">fas fa-arrow-down</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-arrow-left"></i>
                                        </div>
                                        <div class="text-muted">fas fa-arrow-left</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-arrow-right"></i>
                                        </div>
                                        <div class="text-muted">fas fa-arrow-right</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-arrow-up"></i>
                                        </div>
                                        <div class="text-muted">fas fa-arrow-up</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-arrows-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-arrows-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-arrows-alt-h"></i>
                                        </div>
                                        <div class="text-muted">fas fa-arrows-alt-h</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-arrows-alt-v"></i>
                                        </div>
                                        <div class="text-muted">fas fa-arrows-alt-v</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-assistive-listening-systems"></i>
                                        </div>
                                        <div class="text-muted">fas fa-assistive-listening-systems</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-asterisk"></i>
                                        </div>
                                        <div class="text-muted">fas fa-asterisk</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-at"></i>
                                        </div>
                                        <div class="text-muted">fas fa-at</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-atlas"></i>
                                        </div>
                                        <div class="text-muted">fas fa-atlas</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-atom"></i>
                                        </div>
                                        <div class="text-muted">fas fa-atom</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-audio-description"></i>
                                        </div>
                                        <div class="text-muted">fas fa-audio-description</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-award"></i>
                                        </div>
                                        <div class="text-muted">fas fa-award</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-baby"></i>
                                        </div>
                                        <div class="text-muted">fas fa-baby</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-baby-carriage"></i>
                                        </div>
                                        <div class="text-muted">fas fa-baby-carriage</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-backspace"></i>
                                        </div>
                                        <div class="text-muted">fas fa-backspace</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-backward"></i>
                                        </div>
                                        <div class="text-muted">fas fa-backward</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bacon"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bacon</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bacteria"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bacteria</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bacterium"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bacterium</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bahai"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bahai</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-balance-scale"></i>
                                        </div>
                                        <div class="text-muted">fas fa-balance-scale</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-balance-scale-left"></i>
                                        </div>
                                        <div class="text-muted">fas fa-balance-scale-left</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-balance-scale-right"></i>
                                        </div>
                                        <div class="text-muted">fas fa-balance-scale-right</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-ban"></i>
                                        </div>
                                        <div class="text-muted">fas fa-ban</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-band-aid"></i>
                                        </div>
                                        <div class="text-muted">fas fa-band-aid</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-barcode"></i>
                                        </div>
                                        <div class="text-muted">fas fa-barcode</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bars"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bars</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-baseball-ball"></i>
                                        </div>
                                        <div class="text-muted">fas fa-baseball-ball</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-basketball-ball"></i>
                                        </div>
                                        <div class="text-muted">fas fa-basketball-ball</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bath"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bath</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-battery-empty"></i>
                                        </div>
                                        <div class="text-muted">fas fa-battery-empty</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-battery-full"></i>
                                        </div>
                                        <div class="text-muted">fas fa-battery-full</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-battery-half"></i>
                                        </div>
                                        <div class="text-muted">fas fa-battery-half</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-battery-quarter"></i>
                                        </div>
                                        <div class="text-muted">fas fa-battery-quarter</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-battery-three-quarters"></i>
                                        </div>
                                        <div class="text-muted">fas fa-battery-three-quarters</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bed"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bed</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-beer"></i>
                                        </div>
                                        <div class="text-muted">fas fa-beer</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bell"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bell</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bell-slash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bell-slash</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bezier-curve"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bezier-curve</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bible"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bible</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bicycle"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bicycle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-biking"></i>
                                        </div>
                                        <div class="text-muted">fas fa-biking</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-binoculars"></i>
                                        </div>
                                        <div class="text-muted">fas fa-binoculars</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-biohazard"></i>
                                        </div>
                                        <div class="text-muted">fas fa-biohazard</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-birthday-cake"></i>
                                        </div>
                                        <div class="text-muted">fas fa-birthday-cake</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-blender"></i>
                                        </div>
                                        <div class="text-muted">fas fa-blender</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-blender-phone"></i>
                                        </div>
                                        <div class="text-muted">fas fa-blender-phone</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-blind"></i>
                                        </div>
                                        <div class="text-muted">fas fa-blind</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-blog"></i>
                                        </div>
                                        <div class="text-muted">fas fa-blog</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bold"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bold</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bolt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bolt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bomb"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bomb</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bone"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bone</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bong"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bong</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-book"></i>
                                        </div>
                                        <div class="text-muted">fas fa-book</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-book-dead"></i>
                                        </div>
                                        <div class="text-muted">fas fa-book-dead</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-book-medical"></i>
                                        </div>
                                        <div class="text-muted">fas fa-book-medical</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-book-open"></i>
                                        </div>
                                        <div class="text-muted">fas fa-book-open</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-book-reader"></i>
                                        </div>
                                        <div class="text-muted">fas fa-book-reader</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bookmark"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bookmark</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-border-all"></i>
                                        </div>
                                        <div class="text-muted">fas fa-border-all</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-border-none"></i>
                                        </div>
                                        <div class="text-muted">fas fa-border-none</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-border-style"></i>
                                        </div>
                                        <div class="text-muted">fas fa-border-style</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bowling-ball"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bowling-ball</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-box"></i>
                                        </div>
                                        <div class="text-muted">fas fa-box</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-box-open"></i>
                                        </div>
                                        <div class="text-muted">fas fa-box-open</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-box-tissue"></i>
                                        </div>
                                        <div class="text-muted">fas fa-box-tissue</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-boxes"></i>
                                        </div>
                                        <div class="text-muted">fas fa-boxes</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-braille"></i>
                                        </div>
                                        <div class="text-muted">fas fa-braille</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-brain"></i>
                                        </div>
                                        <div class="text-muted">fas fa-brain</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bread-slice"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bread-slice</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-briefcase"></i>
                                        </div>
                                        <div class="text-muted">fas fa-briefcase</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-briefcase-medical"></i>
                                        </div>
                                        <div class="text-muted">fas fa-briefcase-medical</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-broadcast-tower"></i>
                                        </div>
                                        <div class="text-muted">fas fa-broadcast-tower</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-broom"></i>
                                        </div>
                                        <div class="text-muted">fas fa-broom</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-brush"></i>
                                        </div>
                                        <div class="text-muted">fas fa-brush</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bug"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bug</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-building"></i>
                                        </div>
                                        <div class="text-muted">fas fa-building</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bullhorn"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bullhorn</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bullseye"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bullseye</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-burn"></i>
                                        </div>
                                        <div class="text-muted">fas fa-burn</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bus"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bus</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-bus-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-bus-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-business-time"></i>
                                        </div>
                                        <div class="text-muted">fas fa-business-time</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-calculator"></i>
                                        </div>
                                        <div class="text-muted">fas fa-calculator</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-calendar"></i>
                                        </div>
                                        <div class="text-muted">fas fa-calendar</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-calendar-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-calendar-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-calendar-check"></i>
                                        </div>
                                        <div class="text-muted">fas fa-calendar-check</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-calendar-day"></i>
                                        </div>
                                        <div class="text-muted">fas fa-calendar-day</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-calendar-minus"></i>
                                        </div>
                                        <div class="text-muted">fas fa-calendar-minus</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-calendar-plus"></i>
                                        </div>
                                        <div class="text-muted">fas fa-calendar-plus</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-calendar-times"></i>
                                        </div>
                                        <div class="text-muted">fas fa-calendar-times</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-calendar-week"></i>
                                        </div>
                                        <div class="text-muted">fas fa-calendar-week</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-camera"></i>
                                        </div>
                                        <div class="text-muted">fas fa-camera</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-camera-retro"></i>
                                        </div>
                                        <div class="text-muted">fas fa-camera-retro</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-campground"></i>
                                        </div>
                                        <div class="text-muted">fas fa-campground</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-candy-cane"></i>
                                        </div>
                                        <div class="text-muted">fas fa-candy-cane</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cannabis"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cannabis</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-capsules"></i>
                                        </div>
                                        <div class="text-muted">fas fa-capsules</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-car"></i>
                                        </div>
                                        <div class="text-muted">fas fa-car</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-car-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-car-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-car-battery"></i>
                                        </div>
                                        <div class="text-muted">fas fa-car-battery</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-car-crash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-car-crash</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-car-side"></i>
                                        </div>
                                        <div class="text-muted">fas fa-car-side</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-caravan"></i>
                                        </div>
                                        <div class="text-muted">fas fa-caravan</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-caret-down"></i>
                                        </div>
                                        <div class="text-muted">fas fa-caret-down</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-caret-left"></i>
                                        </div>
                                        <div class="text-muted">fas fa-caret-left</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-caret-right"></i>
                                        </div>
                                        <div class="text-muted">fas fa-caret-right</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-caret-square-down"></i>
                                        </div>
                                        <div class="text-muted">fas fa-caret-square-down</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-caret-square-left"></i>
                                        </div>
                                        <div class="text-muted">fas fa-caret-square-left</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-caret-square-right"></i>
                                        </div>
                                        <div class="text-muted">fas fa-caret-square-right</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-caret-square-up"></i>
                                        </div>
                                        <div class="text-muted">fas fa-caret-square-up</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-caret-up"></i>
                                        </div>
                                        <div class="text-muted">fas fa-caret-up</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-carrot"></i>
                                        </div>
                                        <div class="text-muted">fas fa-carrot</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cart-arrow-down"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cart-arrow-down</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cart-plus"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cart-plus</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cash-register"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cash-register</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cat"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cat</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-certificate"></i>
                                        </div>
                                        <div class="text-muted">fas fa-certificate</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chair"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chair</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chalkboard"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chalkboard</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chalkboard-teacher"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chalkboard-teacher</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-charging-station"></i>
                                        </div>
                                        <div class="text-muted">fas fa-charging-station</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chart-area"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chart-area</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chart-bar"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chart-bar</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chart-line"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chart-line</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chart-pie"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chart-pie</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-check"></i>
                                        </div>
                                        <div class="text-muted">fas fa-check</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-check-circle"></i>
                                        </div>
                                        <div class="text-muted">fas fa-check-circle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-check-double"></i>
                                        </div>
                                        <div class="text-muted">fas fa-check-double</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-check-square"></i>
                                        </div>
                                        <div class="text-muted">fas fa-check-square</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cheese"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cheese</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chess"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chess</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chess-bishop"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chess-bishop</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chess-board"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chess-board</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chess-king"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chess-king</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chess-knight"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chess-knight</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chess-pawn"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chess-pawn</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chess-queen"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chess-queen</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chess-rook"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chess-rook</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chevron-circle-down"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chevron-circle-down</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chevron-circle-left"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chevron-circle-left</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chevron-circle-right"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chevron-circle-right</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chevron-circle-up"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chevron-circle-up</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chevron-down"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chevron-down</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chevron-left"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chevron-left</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chevron-right"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chevron-right</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-chevron-up"></i>
                                        </div>
                                        <div class="text-muted">fas fa-chevron-up</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-child"></i>
                                        </div>
                                        <div class="text-muted">fas fa-child</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-church"></i>
                                        </div>
                                        <div class="text-muted">fas fa-church</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-circle"></i>
                                        </div>
                                        <div class="text-muted">fas fa-circle</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-circle-notch"></i>
                                        </div>
                                        <div class="text-muted">fas fa-circle-notch</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-city"></i>
                                        </div>
                                        <div class="text-muted">fas fa-city</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-clinic-medical"></i>
                                        </div>
                                        <div class="text-muted">fas fa-clinic-medical</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-clipboard"></i>
                                        </div>
                                        <div class="text-muted">fas fa-clipboard</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-clipboard-check"></i>
                                        </div>
                                        <div class="text-muted">fas fa-clipboard-check</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-clipboard-list"></i>
                                        </div>
                                        <div class="text-muted">fas fa-clipboard-list</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-clock"></i>
                                        </div>
                                        <div class="text-muted">fas fa-clock</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-clone"></i>
                                        </div>
                                        <div class="text-muted">fas fa-clone</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-closed-captioning"></i>
                                        </div>
                                        <div class="text-muted">fas fa-closed-captioning</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cloud"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cloud</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cloud-download-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cloud-download-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cloud-meatball"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cloud-meatball</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cloud-moon"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cloud-moon</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cloud-moon-rain"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cloud-moon-rain</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cloud-rain"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cloud-rain</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cloud-showers-heavy"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cloud-showers-heavy</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cloud-sun"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cloud-sun</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cloud-sun-rain"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cloud-sun-rain</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cloud-upload-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cloud-upload-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cocktail"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cocktail</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-code"></i>
                                        </div>
                                        <div class="text-muted">fas fa-code</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-code-branch"></i>
                                        </div>
                                        <div class="text-muted">fas fa-code-branch</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-coffee"></i>
                                        </div>
                                        <div class="text-muted">fas fa-coffee</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cog"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cog</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cogs"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cogs</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-coins"></i>
                                        </div>
                                        <div class="text-muted">fas fa-coins</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-columns"></i>
                                        </div>
                                        <div class="text-muted">fas fa-columns</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-comment"></i>
                                        </div>
                                        <div class="text-muted">fas fa-comment</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-comment-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-comment-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-comment-dollar"></i>
                                        </div>
                                        <div class="text-muted">fas fa-comment-dollar</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-comment-dots"></i>
                                        </div>
                                        <div class="text-muted">fas fa-comment-dots</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-comment-medical"></i>
                                        </div>
                                        <div class="text-muted">fas fa-comment-medical</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-comment-slash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-comment-slash</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-comments"></i>
                                        </div>
                                        <div class="text-muted">fas fa-comments</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-comments-dollar"></i>
                                        </div>
                                        <div class="text-muted">fas fa-comments-dollar</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-compact-disc"></i>
                                        </div>
                                        <div class="text-muted">fas fa-compact-disc</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-compass"></i>
                                        </div>
                                        <div class="text-muted">fas fa-compass</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-compress"></i>
                                        </div>
                                        <div class="text-muted">fas fa-compress</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-compress-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-compress-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-compress-arrows-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-compress-arrows-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-concierge-bell"></i>
                                        </div>
                                        <div class="text-muted">fas fa-concierge-bell</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cookie"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cookie</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cookie-bite"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cookie-bite</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-copy"></i>
                                        </div>
                                        <div class="text-muted">fas fa-copy</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-copyright"></i>
                                        </div>
                                        <div class="text-muted">fas fa-copyright</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-couch"></i>
                                        </div>
                                        <div class="text-muted">fas fa-couch</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-credit-card"></i>
                                        </div>
                                        <div class="text-muted">fas fa-credit-card</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-crop"></i>
                                        </div>
                                        <div class="text-muted">fas fa-crop</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-crop-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-crop-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cross"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cross</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-crosshairs"></i>
                                        </div>
                                        <div class="text-muted">fas fa-crosshairs</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-crow"></i>
                                        </div>
                                        <div class="text-muted">fas fa-crow</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-crown"></i>
                                        </div>
                                        <div class="text-muted">fas fa-crown</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-crutch"></i>
                                        </div>
                                        <div class="text-muted">fas fa-crutch</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cube"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cube</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cubes"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cubes</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-cut"></i>
                                        </div>
                                        <div class="text-muted">fas fa-cut</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-database"></i>
                                        </div>
                                        <div class="text-muted">fas fa-database</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-deaf"></i>
                                        </div>
                                        <div class="text-muted">fas fa-deaf</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-democrat"></i>
                                        </div>
                                        <div class="text-muted">fas fa-democrat</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-desktop"></i>
                                        </div>
                                        <div class="text-muted">fas fa-desktop</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dharmachakra"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dharmachakra</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-diagnoses"></i>
                                        </div>
                                        <div class="text-muted">fas fa-diagnoses</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dice"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dice</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dice-d20"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dice-d20</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dice-d6"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dice-d6</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dice-five"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dice-five</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dice-four"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dice-four</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dice-one"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dice-one</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dice-six"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dice-six</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dice-three"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dice-three</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dice-two"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dice-two</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-digital-tachograph"></i>
                                        </div>
                                        <div class="text-muted">fas fa-digital-tachograph</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-directions"></i>
                                        </div>
                                        <div class="text-muted">fas fa-directions</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-disease"></i>
                                        </div>
                                        <div class="text-muted">fas fa-disease</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-divide"></i>
                                        </div>
                                        <div class="text-muted">fas fa-divide</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dizzy"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dizzy</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dna"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dna</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dog"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dog</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dollar-sign"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dollar-sign</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dolly"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dolly</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dolly-flatbed"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dolly-flatbed</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-donate"></i>
                                        </div>
                                        <div class="text-muted">fas fa-donate</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-door-closed"></i>
                                        </div>
                                        <div class="text-muted">fas fa-door-closed</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-door-open"></i>
                                        </div>
                                        <div class="text-muted">fas fa-door-open</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dot-circle"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dot-circle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dove"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dove</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-download"></i>
                                        </div>
                                        <div class="text-muted">fas fa-download</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-drafting-compass"></i>
                                        </div>
                                        <div class="text-muted">fas fa-drafting-compass</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dragon"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dragon</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-draw-polygon"></i>
                                        </div>
                                        <div class="text-muted">fas fa-draw-polygon</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-drum"></i>
                                        </div>
                                        <div class="text-muted">fas fa-drum</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-drum-steelpan"></i>
                                        </div>
                                        <div class="text-muted">fas fa-drum-steelpan</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-drumstick-bite"></i>
                                        </div>
                                        <div class="text-muted">fas fa-drumstick-bite</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dumbbell"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dumbbell</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dumpster"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dumpster</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dumpster-fire"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dumpster-fire</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-dungeon"></i>
                                        </div>
                                        <div class="text-muted">fas fa-dungeon</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-edit"></i>
                                        </div>
                                        <div class="text-muted">fas fa-edit</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-egg"></i>
                                        </div>
                                        <div class="text-muted">fas fa-egg</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-eject"></i>
                                        </div>
                                        <div class="text-muted">fas fa-eject</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-ellipsis-h"></i>
                                        </div>
                                        <div class="text-muted">fas fa-ellipsis-h</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-ellipsis-v"></i>
                                        </div>
                                        <div class="text-muted">fas fa-ellipsis-v</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-envelope"></i>
                                        </div>
                                        <div class="text-muted">fas fa-envelope</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-envelope-open"></i>
                                        </div>
                                        <div class="text-muted">fas fa-envelope-open</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-envelope-open-text"></i>
                                        </div>
                                        <div class="text-muted">fas fa-envelope-open-text</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-envelope-square"></i>
                                        </div>
                                        <div class="text-muted">fas fa-envelope-square</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-equals"></i>
                                        </div>
                                        <div class="text-muted">fas fa-equals</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-eraser"></i>
                                        </div>
                                        <div class="text-muted">fas fa-eraser</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-ethernet"></i>
                                        </div>
                                        <div class="text-muted">fas fa-ethernet</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-euro-sign"></i>
                                        </div>
                                        <div class="text-muted">fas fa-euro-sign</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-exchange-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-exchange-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-exclamation"></i>
                                        </div>
                                        <div class="text-muted">fas fa-exclamation</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-exclamation-circle"></i>
                                        </div>
                                        <div class="text-muted">fas fa-exclamation-circle</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-exclamation-triangle"></i>
                                        </div>
                                        <div class="text-muted">fas fa-exclamation-triangle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-expand"></i>
                                        </div>
                                        <div class="text-muted">fas fa-expand</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-expand-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-expand-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-expand-arrows-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-expand-arrows-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-external-link-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-external-link-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-external-link-square-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-external-link-square-alt</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-eye"></i>
                                        </div>
                                        <div class="text-muted">fas fa-eye</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-eye-dropper"></i>
                                        </div>
                                        <div class="text-muted">fas fa-eye-dropper</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-eye-slash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-eye-slash</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-fan"></i>
                                        </div>
                                        <div class="text-muted">fas fa-fan</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-fast-backward"></i>
                                        </div>
                                        <div class="text-muted">fas fa-fast-backward</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-fast-forward"></i>
                                        </div>
                                        <div class="text-muted">fas fa-fast-forward</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-faucet"></i>
                                        </div>
                                        <div class="text-muted">fas fa-faucet</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-fax"></i>
                                        </div>
                                        <div class="text-muted">fas fa-fax</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-feather"></i>
                                        </div>
                                        <div class="text-muted">fas fa-feather</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-feather-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-feather-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-female"></i>
                                        </div>
                                        <div class="text-muted">fas fa-female</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-fighter-jet"></i>
                                        </div>
                                        <div class="text-muted">fas fa-fighter-jet</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file-archive"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file-archive</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file-audio"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file-audio</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file-code"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file-code</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file-contract"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file-contract</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file-csv"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file-csv</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file-download"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file-download</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file-excel"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file-excel</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file-export"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file-export</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file-image"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file-image</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file-import"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file-import</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file-invoice"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file-invoice</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file-invoice-dollar"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file-invoice-dollar</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file-medical"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file-medical</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file-medical-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file-medical-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file-pdf"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file-pdf</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file-powerpoint"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file-powerpoint</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file-prescription"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file-prescription</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file-signature"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file-signature</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file-upload"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file-upload</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file-video"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file-video</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-file-word"></i>
                                        </div>
                                        <div class="text-muted">fas fa-file-word</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-fill"></i>
                                        </div>
                                        <div class="text-muted">fas fa-fill</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-fill-drip"></i>
                                        </div>
                                        <div class="text-muted">fas fa-fill-drip</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-film"></i>
                                        </div>
                                        <div class="text-muted">fas fa-film</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-filter"></i>
                                        </div>
                                        <div class="text-muted">fas fa-filter</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-fingerprint"></i>
                                        </div>
                                        <div class="text-muted">fas fa-fingerprint</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-fire"></i>
                                        </div>
                                        <div class="text-muted">fas fa-fire</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-fire-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-fire-alt</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-fire-extinguisher"></i>
                                        </div>
                                        <div class="text-muted">fas fa-fire-extinguisher</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-first-aid"></i>
                                        </div>
                                        <div class="text-muted">fas fa-first-aid</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-fish"></i>
                                        </div>
                                        <div class="text-muted">fas fa-fish</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-fist-raised"></i>
                                        </div>
                                        <div class="text-muted">fas fa-fist-raised</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-flag"></i>
                                        </div>
                                        <div class="text-muted">fas fa-flag</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-flag-checkered"></i>
                                        </div>
                                        <div class="text-muted">fas fa-flag-checkered</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-flag-usa"></i>
                                        </div>
                                        <div class="text-muted">fas fa-flag-usa</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-flask"></i>
                                        </div>
                                        <div class="text-muted">fas fa-flask</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-flushed"></i>
                                        </div>
                                        <div class="text-muted">fas fa-flushed</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-folder"></i>
                                        </div>
                                        <div class="text-muted">fas fa-folder</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-folder-minus"></i>
                                        </div>
                                        <div class="text-muted">fas fa-folder-minus</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-folder-open"></i>
                                        </div>
                                        <div class="text-muted">fas fa-folder-open</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-folder-plus"></i>
                                        </div>
                                        <div class="text-muted">fas fa-folder-plus</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-font"></i>
                                        </div>
                                        <div class="text-muted">fas fa-font</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-font-awesome-logo-full"></i>
                                        </div>
                                        <div class="text-muted">fas fa-font-awesome-logo-full</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-football-ball"></i>
                                        </div>
                                        <div class="text-muted">fas fa-football-ball</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-forward"></i>
                                        </div>
                                        <div class="text-muted">fas fa-forward</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-frog"></i>
                                        </div>
                                        <div class="text-muted">fas fa-frog</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-frown"></i>
                                        </div>
                                        <div class="text-muted">fas fa-frown</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-frown-open"></i>
                                        </div>
                                        <div class="text-muted">fas fa-frown-open</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-funnel-dollar"></i>
                                        </div>
                                        <div class="text-muted">fas fa-funnel-dollar</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-futbol"></i>
                                        </div>
                                        <div class="text-muted">fas fa-futbol</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-gamepad"></i>
                                        </div>
                                        <div class="text-muted">fas fa-gamepad</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-gas-pump"></i>
                                        </div>
                                        <div class="text-muted">fas fa-gas-pump</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-gavel"></i>
                                        </div>
                                        <div class="text-muted">fas fa-gavel</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-gem"></i>
                                        </div>
                                        <div class="text-muted">fas fa-gem</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-genderless"></i>
                                        </div>
                                        <div class="text-muted">fas fa-genderless</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-ghost"></i>
                                        </div>
                                        <div class="text-muted">fas fa-ghost</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-gift"></i>
                                        </div>
                                        <div class="text-muted">fas fa-gift</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-gifts"></i>
                                        </div>
                                        <div class="text-muted">fas fa-gifts</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-glass-cheers"></i>
                                        </div>
                                        <div class="text-muted">fas fa-glass-cheers</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-glass-martini"></i>
                                        </div>
                                        <div class="text-muted">fas fa-glass-martini</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-glass-martini-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-glass-martini-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-glass-whiskey"></i>
                                        </div>
                                        <div class="text-muted">fas fa-glass-whiskey</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-glasses"></i>
                                        </div>
                                        <div class="text-muted">fas fa-glasses</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-globe"></i>
                                        </div>
                                        <div class="text-muted">fas fa-globe</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-globe-africa"></i>
                                        </div>
                                        <div class="text-muted">fas fa-globe-africa</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-globe-americas"></i>
                                        </div>
                                        <div class="text-muted">fas fa-globe-americas</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-globe-asia"></i>
                                        </div>
                                        <div class="text-muted">fas fa-globe-asia</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-globe-europe"></i>
                                        </div>
                                        <div class="text-muted">fas fa-globe-europe</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-golf-ball"></i>
                                        </div>
                                        <div class="text-muted">fas fa-golf-ball</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-gopuram"></i>
                                        </div>
                                        <div class="text-muted">fas fa-gopuram</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-graduation-cap"></i>
                                        </div>
                                        <div class="text-muted">fas fa-graduation-cap</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-greater-than"></i>
                                        </div>
                                        <div class="text-muted">fas fa-greater-than</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-greater-than-equal"></i>
                                        </div>
                                        <div class="text-muted">fas fa-greater-than-equal</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-grimace"></i>
                                        </div>
                                        <div class="text-muted">fas fa-grimace</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-grin"></i>
                                        </div>
                                        <div class="text-muted">fas fa-grin</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-grin-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-grin-alt</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-grin-beam"></i>
                                        </div>
                                        <div class="text-muted">fas fa-grin-beam</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-grin-beam-sweat"></i>
                                        </div>
                                        <div class="text-muted">fas fa-grin-beam-sweat</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-grin-hearts"></i>
                                        </div>
                                        <div class="text-muted">fas fa-grin-hearts</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-grin-squint"></i>
                                        </div>
                                        <div class="text-muted">fas fa-grin-squint</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-grin-squint-tears"></i>
                                        </div>
                                        <div class="text-muted">fas fa-grin-squint-tears</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-grin-stars"></i>
                                        </div>
                                        <div class="text-muted">fas fa-grin-stars</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-grin-tears"></i>
                                        </div>
                                        <div class="text-muted">fas fa-grin-tears</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-grin-tongue"></i>
                                        </div>
                                        <div class="text-muted">fas fa-grin-tongue</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-grin-tongue-squint"></i>
                                        </div>
                                        <div class="text-muted">fas fa-grin-tongue-squint</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-grin-tongue-wink"></i>
                                        </div>
                                        <div class="text-muted">fas fa-grin-tongue-wink</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-grin-wink"></i>
                                        </div>
                                        <div class="text-muted">fas fa-grin-wink</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-grip-horizontal"></i>
                                        </div>
                                        <div class="text-muted">fas fa-grip-horizontal</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-grip-lines"></i>
                                        </div>
                                        <div class="text-muted">fas fa-grip-lines</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-grip-lines-vertical"></i>
                                        </div>
                                        <div class="text-muted">fas fa-grip-lines-vertical</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-grip-vertical"></i>
                                        </div>
                                        <div class="text-muted">fas fa-grip-vertical</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-guitar"></i>
                                        </div>
                                        <div class="text-muted">fas fa-guitar</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-h-square"></i>
                                        </div>
                                        <div class="text-muted">fas fa-h-square</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hamburger"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hamburger</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hammer"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hammer</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hamsa"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hamsa</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hand-holding"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hand-holding</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hand-holding-heart"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hand-holding-heart</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hand-holding-medical"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hand-holding-medical</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hand-holding-usd"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hand-holding-usd</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hand-holding-water"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hand-holding-water</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hand-lizard"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hand-lizard</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hand-middle-finger"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hand-middle-finger</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hand-paper"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hand-paper</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hand-peace"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hand-peace</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hand-point-down"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hand-point-down</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hand-point-left"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hand-point-left</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hand-point-right"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hand-point-right</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hand-point-up"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hand-point-up</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hand-pointer"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hand-pointer</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hand-rock"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hand-rock</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hand-scissors"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hand-scissors</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hand-sparkles"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hand-sparkles</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hand-spock"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hand-spock</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hands"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hands</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hands-helping"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hands-helping</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hands-wash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hands-wash</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-handshake"></i>
                                        </div>
                                        <div class="text-muted">fas fa-handshake</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-handshake-alt-slash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-handshake-alt-slash</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-handshake-slash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-handshake-slash</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hanukiah"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hanukiah</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hard-hat"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hard-hat</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hashtag"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hashtag</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hat-cowboy"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hat-cowboy</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hat-cowboy-side"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hat-cowboy-side</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hat-wizard"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hat-wizard</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hdd"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hdd</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-head-side-cough"></i>
                                        </div>
                                        <div class="text-muted">fas fa-head-side-cough</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-head-side-cough-slash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-head-side-cough-slash</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-head-side-mask"></i>
                                        </div>
                                        <div class="text-muted">fas fa-head-side-mask</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-head-side-virus"></i>
                                        </div>
                                        <div class="text-muted">fas fa-head-side-virus</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-heading"></i>
                                        </div>
                                        <div class="text-muted">fas fa-heading</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-headphones"></i>
                                        </div>
                                        <div class="text-muted">fas fa-headphones</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-headphones-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-headphones-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-headset"></i>
                                        </div>
                                        <div class="text-muted">fas fa-headset</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-heart"></i>
                                        </div>
                                        <div class="text-muted">fas fa-heart</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-heart-broken"></i>
                                        </div>
                                        <div class="text-muted">fas fa-heart-broken</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-heartbeat"></i>
                                        </div>
                                        <div class="text-muted">fas fa-heartbeat</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-helicopter"></i>
                                        </div>
                                        <div class="text-muted">fas fa-helicopter</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-highlighter"></i>
                                        </div>
                                        <div class="text-muted">fas fa-highlighter</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hiking"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hiking</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hippo"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hippo</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-history"></i>
                                        </div>
                                        <div class="text-muted">fas fa-history</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hockey-puck"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hockey-puck</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-holly-berry"></i>
                                        </div>
                                        <div class="text-muted">fas fa-holly-berry</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-home"></i>
                                        </div>
                                        <div class="text-muted">fas fa-home</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-horse"></i>
                                        </div>
                                        <div class="text-muted">fas fa-horse</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-horse-head"></i>
                                        </div>
                                        <div class="text-muted">fas fa-horse-head</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hospital"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hospital</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hospital-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hospital-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hospital-symbol"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hospital-symbol</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hospital-user"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hospital-user</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hot-tub"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hot-tub</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hotdog"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hotdog</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hotel"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hotel</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hourglass"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hourglass</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hourglass-end"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hourglass-end</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hourglass-half"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hourglass-half</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hourglass-start"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hourglass-start</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-house-damage"></i>
                                        </div>
                                        <div class="text-muted">fas fa-house-damage</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-house-user"></i>
                                        </div>
                                        <div class="text-muted">fas fa-house-user</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-hryvnia"></i>
                                        </div>
                                        <div class="text-muted">fas fa-hryvnia</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-i-cursor"></i>
                                        </div>
                                        <div class="text-muted">fas fa-i-cursor</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-ice-cream"></i>
                                        </div>
                                        <div class="text-muted">fas fa-ice-cream</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-icicles"></i>
                                        </div>
                                        <div class="text-muted">fas fa-icicles</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-icons"></i>
                                        </div>
                                        <div class="text-muted">fas fa-icons</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-id-badge"></i>
                                        </div>
                                        <div class="text-muted">fas fa-id-badge</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-id-card"></i>
                                        </div>
                                        <div class="text-muted">fas fa-id-card</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-id-card-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-id-card-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-igloo"></i>
                                        </div>
                                        <div class="text-muted">fas fa-igloo</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-image"></i>
                                        </div>
                                        <div class="text-muted">fas fa-image</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-images"></i>
                                        </div>
                                        <div class="text-muted">fas fa-images</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-inbox"></i>
                                        </div>
                                        <div class="text-muted">fas fa-inbox</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-indent"></i>
                                        </div>
                                        <div class="text-muted">fas fa-indent</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-industry"></i>
                                        </div>
                                        <div class="text-muted">fas fa-industry</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-infinity"></i>
                                        </div>
                                        <div class="text-muted">fas fa-infinity</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-info"></i>
                                        </div>
                                        <div class="text-muted">fas fa-info</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-info-circle"></i>
                                        </div>
                                        <div class="text-muted">fas fa-info-circle</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-italic"></i>
                                        </div>
                                        <div class="text-muted">fas fa-italic</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-jedi"></i>
                                        </div>
                                        <div class="text-muted">fas fa-jedi</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-joint"></i>
                                        </div>
                                        <div class="text-muted">fas fa-joint</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-journal-whills"></i>
                                        </div>
                                        <div class="text-muted">fas fa-journal-whills</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-kaaba"></i>
                                        </div>
                                        <div class="text-muted">fas fa-kaaba</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-key"></i>
                                        </div>
                                        <div class="text-muted">fas fa-key</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-keyboard"></i>
                                        </div>
                                        <div class="text-muted">fas fa-keyboard</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-khanda"></i>
                                        </div>
                                        <div class="text-muted">fas fa-khanda</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-kiss"></i>
                                        </div>
                                        <div class="text-muted">fas fa-kiss</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-kiss-beam"></i>
                                        </div>
                                        <div class="text-muted">fas fa-kiss-beam</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-kiss-wink-heart"></i>
                                        </div>
                                        <div class="text-muted">fas fa-kiss-wink-heart</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-kiwi-bird"></i>
                                        </div>
                                        <div class="text-muted">fas fa-kiwi-bird</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-landmark"></i>
                                        </div>
                                        <div class="text-muted">fas fa-landmark</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-language"></i>
                                        </div>
                                        <div class="text-muted">fas fa-language</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-laptop"></i>
                                        </div>
                                        <div class="text-muted">fas fa-laptop</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-laptop-code"></i>
                                        </div>
                                        <div class="text-muted">fas fa-laptop-code</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-laptop-house"></i>
                                        </div>
                                        <div class="text-muted">fas fa-laptop-house</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-laptop-medical"></i>
                                        </div>
                                        <div class="text-muted">fas fa-laptop-medical</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-laugh"></i>
                                        </div>
                                        <div class="text-muted">fas fa-laugh</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-laugh-beam"></i>
                                        </div>
                                        <div class="text-muted">fas fa-laugh-beam</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-laugh-squint"></i>
                                        </div>
                                        <div class="text-muted">fas fa-laugh-squint</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-laugh-wink"></i>
                                        </div>
                                        <div class="text-muted">fas fa-laugh-wink</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-layer-group"></i>
                                        </div>
                                        <div class="text-muted">fas fa-layer-group</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-leaf"></i>
                                        </div>
                                        <div class="text-muted">fas fa-leaf</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-lemon"></i>
                                        </div>
                                        <div class="text-muted">fas fa-lemon</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-less-than"></i>
                                        </div>
                                        <div class="text-muted">fas fa-less-than</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-less-than-equal"></i>
                                        </div>
                                        <div class="text-muted">fas fa-less-than-equal</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-level-down-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-level-down-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-level-up-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-level-up-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-life-ring"></i>
                                        </div>
                                        <div class="text-muted">fas fa-life-ring</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-lightbulb"></i>
                                        </div>
                                        <div class="text-muted">fas fa-lightbulb</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-link"></i>
                                        </div>
                                        <div class="text-muted">fas fa-link</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-lira-sign"></i>
                                        </div>
                                        <div class="text-muted">fas fa-lira-sign</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-list"></i>
                                        </div>
                                        <div class="text-muted">fas fa-list</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-list-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-list-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-list-ol"></i>
                                        </div>
                                        <div class="text-muted">fas fa-list-ol</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-list-ul"></i>
                                        </div>
                                        <div class="text-muted">fas fa-list-ul</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-location-arrow"></i>
                                        </div>
                                        <div class="text-muted">fas fa-location-arrow</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-lock"></i>
                                        </div>
                                        <div class="text-muted">fas fa-lock</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-lock-open"></i>
                                        </div>
                                        <div class="text-muted">fas fa-lock-open</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-long-arrow-alt-down"></i>
                                        </div>
                                        <div class="text-muted">fas fa-long-arrow-alt-down</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-long-arrow-alt-left"></i>
                                        </div>
                                        <div class="text-muted">fas fa-long-arrow-alt-left</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-long-arrow-alt-right"></i>
                                        </div>
                                        <div class="text-muted">fas fa-long-arrow-alt-right</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-long-arrow-alt-up"></i>
                                        </div>
                                        <div class="text-muted">fas fa-long-arrow-alt-up</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-low-vision"></i>
                                        </div>
                                        <div class="text-muted">fas fa-low-vision</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-luggage-cart"></i>
                                        </div>
                                        <div class="text-muted">fas fa-luggage-cart</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-lungs"></i>
                                        </div>
                                        <div class="text-muted">fas fa-lungs</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-lungs-virus"></i>
                                        </div>
                                        <div class="text-muted">fas fa-lungs-virus</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-magic"></i>
                                        </div>
                                        <div class="text-muted">fas fa-magic</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-magnet"></i>
                                        </div>
                                        <div class="text-muted">fas fa-magnet</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-mail-bulk"></i>
                                        </div>
                                        <div class="text-muted">fas fa-mail-bulk</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-male"></i>
                                        </div>
                                        <div class="text-muted">fas fa-male</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-map"></i>
                                        </div>
                                        <div class="text-muted">fas fa-map</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-map-marked"></i>
                                        </div>
                                        <div class="text-muted">fas fa-map-marked</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-map-marked-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-map-marked-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-map-marker"></i>
                                        </div>
                                        <div class="text-muted">fas fa-map-marker</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-map-marker-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-map-pin"></i>
                                        </div>
                                        <div class="text-muted">fas fa-map-pin</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-map-signs"></i>
                                        </div>
                                        <div class="text-muted">fas fa-map-signs</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-marker"></i>
                                        </div>
                                        <div class="text-muted">fas fa-marker</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-mars"></i>
                                        </div>
                                        <div class="text-muted">fas fa-mars</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-mars-double"></i>
                                        </div>
                                        <div class="text-muted">fas fa-mars-double</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-mars-stroke"></i>
                                        </div>
                                        <div class="text-muted">fas fa-mars-stroke</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-mars-stroke-h"></i>
                                        </div>
                                        <div class="text-muted">fas fa-mars-stroke-h</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-mars-stroke-v"></i>
                                        </div>
                                        <div class="text-muted">fas fa-mars-stroke-v</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-mask"></i>
                                        </div>
                                        <div class="text-muted">fas fa-mask</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-medal"></i>
                                        </div>
                                        <div class="text-muted">fas fa-medal</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-medkit"></i>
                                        </div>
                                        <div class="text-muted">fas fa-medkit</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-meh"></i>
                                        </div>
                                        <div class="text-muted">fas fa-meh</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-meh-blank"></i>
                                        </div>
                                        <div class="text-muted">fas fa-meh-blank</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-meh-rolling-eyes"></i>
                                        </div>
                                        <div class="text-muted">fas fa-meh-rolling-eyes</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-memory"></i>
                                        </div>
                                        <div class="text-muted">fas fa-memory</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-menorah"></i>
                                        </div>
                                        <div class="text-muted">fas fa-menorah</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-mercury"></i>
                                        </div>
                                        <div class="text-muted">fas fa-mercury</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-meteor"></i>
                                        </div>
                                        <div class="text-muted">fas fa-meteor</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-microchip"></i>
                                        </div>
                                        <div class="text-muted">fas fa-microchip</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-microphone"></i>
                                        </div>
                                        <div class="text-muted">fas fa-microphone</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-microphone-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-microphone-alt</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-microphone-alt-slash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-microphone-alt-slash</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-microphone-slash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-microphone-slash</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-microscope"></i>
                                        </div>
                                        <div class="text-muted">fas fa-microscope</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-minus"></i>
                                        </div>
                                        <div class="text-muted">fas fa-minus</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-minus-circle"></i>
                                        </div>
                                        <div class="text-muted">fas fa-minus-circle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-minus-square"></i>
                                        </div>
                                        <div class="text-muted">fas fa-minus-square</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-mitten"></i>
                                        </div>
                                        <div class="text-muted">fas fa-mitten</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-mobile"></i>
                                        </div>
                                        <div class="text-muted">fas fa-mobile</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-mobile-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-mobile-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-money-bill"></i>
                                        </div>
                                        <div class="text-muted">fas fa-money-bill</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-money-bill-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-money-bill-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-money-bill-wave"></i>
                                        </div>
                                        <div class="text-muted">fas fa-money-bill-wave</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-money-bill-wave-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-money-bill-wave-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-money-check"></i>
                                        </div>
                                        <div class="text-muted">fas fa-money-check</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-money-check-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-money-check-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-monument"></i>
                                        </div>
                                        <div class="text-muted">fas fa-monument</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-moon"></i>
                                        </div>
                                        <div class="text-muted">fas fa-moon</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-mortar-pestle"></i>
                                        </div>
                                        <div class="text-muted">fas fa-mortar-pestle</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-mosque"></i>
                                        </div>
                                        <div class="text-muted">fas fa-mosque</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-motorcycle"></i>
                                        </div>
                                        <div class="text-muted">fas fa-motorcycle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-mountain"></i>
                                        </div>
                                        <div class="text-muted">fas fa-mountain</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-mouse"></i>
                                        </div>
                                        <div class="text-muted">fas fa-mouse</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-mouse-pointer"></i>
                                        </div>
                                        <div class="text-muted">fas fa-mouse-pointer</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-mug-hot"></i>
                                        </div>
                                        <div class="text-muted">fas fa-mug-hot</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-music"></i>
                                        </div>
                                        <div class="text-muted">fas fa-music</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-network-wired"></i>
                                        </div>
                                        <div class="text-muted">fas fa-network-wired</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-neuter"></i>
                                        </div>
                                        <div class="text-muted">fas fa-neuter</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-newspaper"></i>
                                        </div>
                                        <div class="text-muted">fas fa-newspaper</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-not-equal"></i>
                                        </div>
                                        <div class="text-muted">fas fa-not-equal</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-notes-medical"></i>
                                        </div>
                                        <div class="text-muted">fas fa-notes-medical</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-object-group"></i>
                                        </div>
                                        <div class="text-muted">fas fa-object-group</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-object-ungroup"></i>
                                        </div>
                                        <div class="text-muted">fas fa-object-ungroup</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-oil-can"></i>
                                        </div>
                                        <div class="text-muted">fas fa-oil-can</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-om"></i>
                                        </div>
                                        <div class="text-muted">fas fa-om</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-otter"></i>
                                        </div>
                                        <div class="text-muted">fas fa-otter</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-outdent"></i>
                                        </div>
                                        <div class="text-muted">fas fa-outdent</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-pager"></i>
                                        </div>
                                        <div class="text-muted">fas fa-pager</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-paint-brush"></i>
                                        </div>
                                        <div class="text-muted">fas fa-paint-brush</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-paint-roller"></i>
                                        </div>
                                        <div class="text-muted">fas fa-paint-roller</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-palette"></i>
                                        </div>
                                        <div class="text-muted">fas fa-palette</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-pallet"></i>
                                        </div>
                                        <div class="text-muted">fas fa-pallet</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-paper-plane"></i>
                                        </div>
                                        <div class="text-muted">fas fa-paper-plane</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-paperclip"></i>
                                        </div>
                                        <div class="text-muted">fas fa-paperclip</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-parachute-box"></i>
                                        </div>
                                        <div class="text-muted">fas fa-parachute-box</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-paragraph"></i>
                                        </div>
                                        <div class="text-muted">fas fa-paragraph</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-parking"></i>
                                        </div>
                                        <div class="text-muted">fas fa-parking</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-passport"></i>
                                        </div>
                                        <div class="text-muted">fas fa-passport</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-pastafarianism"></i>
                                        </div>
                                        <div class="text-muted">fas fa-pastafarianism</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-paste"></i>
                                        </div>
                                        <div class="text-muted">fas fa-paste</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-pause"></i>
                                        </div>
                                        <div class="text-muted">fas fa-pause</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-pause-circle"></i>
                                        </div>
                                        <div class="text-muted">fas fa-pause-circle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-paw"></i>
                                        </div>
                                        <div class="text-muted">fas fa-paw</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-peace"></i>
                                        </div>
                                        <div class="text-muted">fas fa-peace</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-pen"></i>
                                        </div>
                                        <div class="text-muted">fas fa-pen</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-pen-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-pen-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-pen-fancy"></i>
                                        </div>
                                        <div class="text-muted">fas fa-pen-fancy</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-pen-nib"></i>
                                        </div>
                                        <div class="text-muted">fas fa-pen-nib</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-pen-square"></i>
                                        </div>
                                        <div class="text-muted">fas fa-pen-square</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-pencil-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-pencil-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-pencil-ruler"></i>
                                        </div>
                                        <div class="text-muted">fas fa-pencil-ruler</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-people-arrows"></i>
                                        </div>
                                        <div class="text-muted">fas fa-people-arrows</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-people-carry"></i>
                                        </div>
                                        <div class="text-muted">fas fa-people-carry</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-pepper-hot"></i>
                                        </div>
                                        <div class="text-muted">fas fa-pepper-hot</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-percent"></i>
                                        </div>
                                        <div class="text-muted">fas fa-percent</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-percentage"></i>
                                        </div>
                                        <div class="text-muted">fas fa-percentage</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-person-booth"></i>
                                        </div>
                                        <div class="text-muted">fas fa-person-booth</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-phone"></i>
                                        </div>
                                        <div class="text-muted">fas fa-phone</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-phone-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-phone-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-phone-slash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-phone-slash</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-phone-square"></i>
                                        </div>
                                        <div class="text-muted">fas fa-phone-square</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-phone-square-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-phone-square-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-phone-volume"></i>
                                        </div>
                                        <div class="text-muted">fas fa-phone-volume</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-photo-video"></i>
                                        </div>
                                        <div class="text-muted">fas fa-photo-video</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-piggy-bank"></i>
                                        </div>
                                        <div class="text-muted">fas fa-piggy-bank</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-pills"></i>
                                        </div>
                                        <div class="text-muted">fas fa-pills</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-pizza-slice"></i>
                                        </div>
                                        <div class="text-muted">fas fa-pizza-slice</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-place-of-worship"></i>
                                        </div>
                                        <div class="text-muted">fas fa-place-of-worship</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-plane"></i>
                                        </div>
                                        <div class="text-muted">fas fa-plane</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-plane-arrival"></i>
                                        </div>
                                        <div class="text-muted">fas fa-plane-arrival</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-plane-departure"></i>
                                        </div>
                                        <div class="text-muted">fas fa-plane-departure</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-plane-slash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-plane-slash</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-play"></i>
                                        </div>
                                        <div class="text-muted">fas fa-play</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-play-circle"></i>
                                        </div>
                                        <div class="text-muted">fas fa-play-circle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-plug"></i>
                                        </div>
                                        <div class="text-muted">fas fa-plug</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-plus"></i>
                                        </div>
                                        <div class="text-muted">fas fa-plus</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-plus-circle"></i>
                                        </div>
                                        <div class="text-muted">fas fa-plus-circle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-plus-square"></i>
                                        </div>
                                        <div class="text-muted">fas fa-plus-square</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-podcast"></i>
                                        </div>
                                        <div class="text-muted">fas fa-podcast</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-poll"></i>
                                        </div>
                                        <div class="text-muted">fas fa-poll</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-poll-h"></i>
                                        </div>
                                        <div class="text-muted">fas fa-poll-h</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-poo"></i>
                                        </div>
                                        <div class="text-muted">fas fa-poo</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-poo-storm"></i>
                                        </div>
                                        <div class="text-muted">fas fa-poo-storm</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-poop"></i>
                                        </div>
                                        <div class="text-muted">fas fa-poop</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-portrait"></i>
                                        </div>
                                        <div class="text-muted">fas fa-portrait</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-pound-sign"></i>
                                        </div>
                                        <div class="text-muted">fas fa-pound-sign</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-power-off"></i>
                                        </div>
                                        <div class="text-muted">fas fa-power-off</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-pray"></i>
                                        </div>
                                        <div class="text-muted">fas fa-pray</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-praying-hands"></i>
                                        </div>
                                        <div class="text-muted">fas fa-praying-hands</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-prescription"></i>
                                        </div>
                                        <div class="text-muted">fas fa-prescription</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-prescription-bottle"></i>
                                        </div>
                                        <div class="text-muted">fas fa-prescription-bottle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-prescription-bottle-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-prescription-bottle-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-print"></i>
                                        </div>
                                        <div class="text-muted">fas fa-print</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-procedures"></i>
                                        </div>
                                        <div class="text-muted">fas fa-procedures</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-project-diagram"></i>
                                        </div>
                                        <div class="text-muted">fas fa-project-diagram</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-pump-medical"></i>
                                        </div>
                                        <div class="text-muted">fas fa-pump-medical</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-pump-soap"></i>
                                        </div>
                                        <div class="text-muted">fas fa-pump-soap</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-puzzle-piece"></i>
                                        </div>
                                        <div class="text-muted">fas fa-puzzle-piece</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-qrcode"></i>
                                        </div>
                                        <div class="text-muted">fas fa-qrcode</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-question"></i>
                                        </div>
                                        <div class="text-muted">fas fa-question</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-question-circle"></i>
                                        </div>
                                        <div class="text-muted">fas fa-question-circle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-quidditch"></i>
                                        </div>
                                        <div class="text-muted">fas fa-quidditch</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-quote-left"></i>
                                        </div>
                                        <div class="text-muted">fas fa-quote-left</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-quote-right"></i>
                                        </div>
                                        <div class="text-muted">fas fa-quote-right</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-quran"></i>
                                        </div>
                                        <div class="text-muted">fas fa-quran</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-radiation"></i>
                                        </div>
                                        <div class="text-muted">fas fa-radiation</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-radiation-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-radiation-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-rainbow"></i>
                                        </div>
                                        <div class="text-muted">fas fa-rainbow</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-random"></i>
                                        </div>
                                        <div class="text-muted">fas fa-random</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-receipt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-receipt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-record-vinyl"></i>
                                        </div>
                                        <div class="text-muted">fas fa-record-vinyl</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-recycle"></i>
                                        </div>
                                        <div class="text-muted">fas fa-recycle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-redo"></i>
                                        </div>
                                        <div class="text-muted">fas fa-redo</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-redo-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-redo-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-registered"></i>
                                        </div>
                                        <div class="text-muted">fas fa-registered</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-remove-format"></i>
                                        </div>
                                        <div class="text-muted">fas fa-remove-format</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-reply"></i>
                                        </div>
                                        <div class="text-muted">fas fa-reply</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-reply-all"></i>
                                        </div>
                                        <div class="text-muted">fas fa-reply-all</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-republican"></i>
                                        </div>
                                        <div class="text-muted">fas fa-republican</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-restroom"></i>
                                        </div>
                                        <div class="text-muted">fas fa-restroom</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-retweet"></i>
                                        </div>
                                        <div class="text-muted">fas fa-retweet</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-ribbon"></i>
                                        </div>
                                        <div class="text-muted">fas fa-ribbon</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-ring"></i>
                                        </div>
                                        <div class="text-muted">fas fa-ring</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-road"></i>
                                        </div>
                                        <div class="text-muted">fas fa-road</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-robot"></i>
                                        </div>
                                        <div class="text-muted">fas fa-robot</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-rocket"></i>
                                        </div>
                                        <div class="text-muted">fas fa-rocket</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-route"></i>
                                        </div>
                                        <div class="text-muted">fas fa-route</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-rss"></i>
                                        </div>
                                        <div class="text-muted">fas fa-rss</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-rss-square"></i>
                                        </div>
                                        <div class="text-muted">fas fa-rss-square</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-ruble-sign"></i>
                                        </div>
                                        <div class="text-muted">fas fa-ruble-sign</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-ruler"></i>
                                        </div>
                                        <div class="text-muted">fas fa-ruler</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-ruler-combined"></i>
                                        </div>
                                        <div class="text-muted">fas fa-ruler-combined</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-ruler-horizontal"></i>
                                        </div>
                                        <div class="text-muted">fas fa-ruler-horizontal</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-ruler-vertical"></i>
                                        </div>
                                        <div class="text-muted">fas fa-ruler-vertical</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-running"></i>
                                        </div>
                                        <div class="text-muted">fas fa-running</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-rupee-sign"></i>
                                        </div>
                                        <div class="text-muted">fas fa-rupee-sign</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sad-cry"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sad-cry</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sad-tear"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sad-tear</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-satellite"></i>
                                        </div>
                                        <div class="text-muted">fas fa-satellite</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-satellite-dish"></i>
                                        </div>
                                        <div class="text-muted">fas fa-satellite-dish</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-save"></i>
                                        </div>
                                        <div class="text-muted">fas fa-save</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-school"></i>
                                        </div>
                                        <div class="text-muted">fas fa-school</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-screwdriver"></i>
                                        </div>
                                        <div class="text-muted">fas fa-screwdriver</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-scroll"></i>
                                        </div>
                                        <div class="text-muted">fas fa-scroll</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sd-card"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sd-card</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-search"></i>
                                        </div>
                                        <div class="text-muted">fas fa-search</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-search-dollar"></i>
                                        </div>
                                        <div class="text-muted">fas fa-search-dollar</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-search-location"></i>
                                        </div>
                                        <div class="text-muted">fas fa-search-location</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-search-minus"></i>
                                        </div>
                                        <div class="text-muted">fas fa-search-minus</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-search-plus"></i>
                                        </div>
                                        <div class="text-muted">fas fa-search-plus</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-seedling"></i>
                                        </div>
                                        <div class="text-muted">fas fa-seedling</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-server"></i>
                                        </div>
                                        <div class="text-muted">fas fa-server</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-shapes"></i>
                                        </div>
                                        <div class="text-muted">fas fa-shapes</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-share"></i>
                                        </div>
                                        <div class="text-muted">fas fa-share</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-share-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-share-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-share-alt-square"></i>
                                        </div>
                                        <div class="text-muted">fas fa-share-alt-square</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-share-square"></i>
                                        </div>
                                        <div class="text-muted">fas fa-share-square</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-shekel-sign"></i>
                                        </div>
                                        <div class="text-muted">fas fa-shekel-sign</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-shield-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-shield-alt</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-shield-virus"></i>
                                        </div>
                                        <div class="text-muted">fas fa-shield-virus</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-ship"></i>
                                        </div>
                                        <div class="text-muted">fas fa-ship</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-shipping-fast"></i>
                                        </div>
                                        <div class="text-muted">fas fa-shipping-fast</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-shoe-prints"></i>
                                        </div>
                                        <div class="text-muted">fas fa-shoe-prints</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-shopping-bag"></i>
                                        </div>
                                        <div class="text-muted">fas fa-shopping-bag</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-shopping-basket"></i>
                                        </div>
                                        <div class="text-muted">fas fa-shopping-basket</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-shopping-cart"></i>
                                        </div>
                                        <div class="text-muted">fas fa-shopping-cart</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-shower"></i>
                                        </div>
                                        <div class="text-muted">fas fa-shower</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-shuttle-van"></i>
                                        </div>
                                        <div class="text-muted">fas fa-shuttle-van</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sign"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sign</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sign-in-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sign-in-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sign-language"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sign-language</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sign-out-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sign-out-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-signal"></i>
                                        </div>
                                        <div class="text-muted">fas fa-signal</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-signature"></i>
                                        </div>
                                        <div class="text-muted">fas fa-signature</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sim-card"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sim-card</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sink"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sink</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sitemap"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sitemap</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-skating"></i>
                                        </div>
                                        <div class="text-muted">fas fa-skating</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-skiing"></i>
                                        </div>
                                        <div class="text-muted">fas fa-skiing</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-skiing-nordic"></i>
                                        </div>
                                        <div class="text-muted">fas fa-skiing-nordic</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-skull"></i>
                                        </div>
                                        <div class="text-muted">fas fa-skull</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-skull-crossbones"></i>
                                        </div>
                                        <div class="text-muted">fas fa-skull-crossbones</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-slash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-slash</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sleigh"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sleigh</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sliders-h"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sliders-h</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-smile"></i>
                                        </div>
                                        <div class="text-muted">fas fa-smile</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-smile-beam"></i>
                                        </div>
                                        <div class="text-muted">fas fa-smile-beam</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-smile-wink"></i>
                                        </div>
                                        <div class="text-muted">fas fa-smile-wink</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-smog"></i>
                                        </div>
                                        <div class="text-muted">fas fa-smog</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-smoking"></i>
                                        </div>
                                        <div class="text-muted">fas fa-smoking</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-smoking-ban"></i>
                                        </div>
                                        <div class="text-muted">fas fa-smoking-ban</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sms"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sms</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-snowboarding"></i>
                                        </div>
                                        <div class="text-muted">fas fa-snowboarding</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-snowflake"></i>
                                        </div>
                                        <div class="text-muted">fas fa-snowflake</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-snowman"></i>
                                        </div>
                                        <div class="text-muted">fas fa-snowman</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-snowplow"></i>
                                        </div>
                                        <div class="text-muted">fas fa-snowplow</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-soap"></i>
                                        </div>
                                        <div class="text-muted">fas fa-soap</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-socks"></i>
                                        </div>
                                        <div class="text-muted">fas fa-socks</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-solar-panel"></i>
                                        </div>
                                        <div class="text-muted">fas fa-solar-panel</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sort"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sort</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sort-alpha-down"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sort-alpha-down</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sort-alpha-down-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sort-alpha-down-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sort-alpha-up"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sort-alpha-up</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sort-alpha-up-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sort-alpha-up-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sort-amount-down"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sort-amount-down</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sort-amount-down-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sort-amount-down-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sort-amount-up"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sort-amount-up</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sort-amount-up-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sort-amount-up-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sort-down"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sort-down</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sort-numeric-down"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sort-numeric-down</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sort-numeric-down-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sort-numeric-down-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sort-numeric-up"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sort-numeric-up</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sort-numeric-up-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sort-numeric-up-alt</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sort-up"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sort-up</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-spa"></i>
                                        </div>
                                        <div class="text-muted">fas fa-spa</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-space-shuttle"></i>
                                        </div>
                                        <div class="text-muted">fas fa-space-shuttle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-spell-check"></i>
                                        </div>
                                        <div class="text-muted">fas fa-spell-check</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-spider"></i>
                                        </div>
                                        <div class="text-muted">fas fa-spider</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-spinner"></i>
                                        </div>
                                        <div class="text-muted">fas fa-spinner</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-splotch"></i>
                                        </div>
                                        <div class="text-muted">fas fa-splotch</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-spray-can"></i>
                                        </div>
                                        <div class="text-muted">fas fa-spray-can</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-square"></i>
                                        </div>
                                        <div class="text-muted">fas fa-square</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-square-full"></i>
                                        </div>
                                        <div class="text-muted">fas fa-square-full</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-square-root-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-square-root-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-stamp"></i>
                                        </div>
                                        <div class="text-muted">fas fa-stamp</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-star"></i>
                                        </div>
                                        <div class="text-muted">fas fa-star</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-star-and-crescent"></i>
                                        </div>
                                        <div class="text-muted">fas fa-star-and-crescent</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-star-half"></i>
                                        </div>
                                        <div class="text-muted">fas fa-star-half</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-star-half-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-star-half-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-star-of-david"></i>
                                        </div>
                                        <div class="text-muted">fas fa-star-of-david</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-star-of-life"></i>
                                        </div>
                                        <div class="text-muted">fas fa-star-of-life</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-step-backward"></i>
                                        </div>
                                        <div class="text-muted">fas fa-step-backward</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-step-forward"></i>
                                        </div>
                                        <div class="text-muted">fas fa-step-forward</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-stethoscope"></i>
                                        </div>
                                        <div class="text-muted">fas fa-stethoscope</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sticky-note"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sticky-note</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-stop"></i>
                                        </div>
                                        <div class="text-muted">fas fa-stop</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-stop-circle"></i>
                                        </div>
                                        <div class="text-muted">fas fa-stop-circle</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-stopwatch"></i>
                                        </div>
                                        <div class="text-muted">fas fa-stopwatch</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-stopwatch-20"></i>
                                        </div>
                                        <div class="text-muted">fas fa-stopwatch-20</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-store"></i>
                                        </div>
                                        <div class="text-muted">fas fa-store</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-store-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-store-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-store-alt-slash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-store-alt-slash</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-store-slash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-store-slash</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-stream"></i>
                                        </div>
                                        <div class="text-muted">fas fa-stream</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-street-view"></i>
                                        </div>
                                        <div class="text-muted">fas fa-street-view</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-strikethrough"></i>
                                        </div>
                                        <div class="text-muted">fas fa-strikethrough</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-stroopwafel"></i>
                                        </div>
                                        <div class="text-muted">fas fa-stroopwafel</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-subscript"></i>
                                        </div>
                                        <div class="text-muted">fas fa-subscript</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-subway"></i>
                                        </div>
                                        <div class="text-muted">fas fa-subway</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-suitcase"></i>
                                        </div>
                                        <div class="text-muted">fas fa-suitcase</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-suitcase-rolling"></i>
                                        </div>
                                        <div class="text-muted">fas fa-suitcase-rolling</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sun"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sun</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-superscript"></i>
                                        </div>
                                        <div class="text-muted">fas fa-superscript</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-surprise"></i>
                                        </div>
                                        <div class="text-muted">fas fa-surprise</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-swatchbook"></i>
                                        </div>
                                        <div class="text-muted">fas fa-swatchbook</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-swimmer"></i>
                                        </div>
                                        <div class="text-muted">fas fa-swimmer</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-swimming-pool"></i>
                                        </div>
                                        <div class="text-muted">fas fa-swimming-pool</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-synagogue"></i>
                                        </div>
                                        <div class="text-muted">fas fa-synagogue</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sync"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sync</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-sync-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-sync-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-syringe"></i>
                                        </div>
                                        <div class="text-muted">fas fa-syringe</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-table"></i>
                                        </div>
                                        <div class="text-muted">fas fa-table</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-table-tennis"></i>
                                        </div>
                                        <div class="text-muted">fas fa-table-tennis</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-tablet"></i>
                                        </div>
                                        <div class="text-muted">fas fa-tablet</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-tablet-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-tablet-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-tablets"></i>
                                        </div>
                                        <div class="text-muted">fas fa-tablets</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-tachometer-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-tachometer-alt</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-tag"></i>
                                        </div>
                                        <div class="text-muted">fas fa-tag</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-tags"></i>
                                        </div>
                                        <div class="text-muted">fas fa-tags</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-tape"></i>
                                        </div>
                                        <div class="text-muted">fas fa-tape</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-tasks"></i>
                                        </div>
                                        <div class="text-muted">fas fa-tasks</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-taxi"></i>
                                        </div>
                                        <div class="text-muted">fas fa-taxi</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-teeth"></i>
                                        </div>
                                        <div class="text-muted">fas fa-teeth</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-teeth-open"></i>
                                        </div>
                                        <div class="text-muted">fas fa-teeth-open</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-temperature-high"></i>
                                        </div>
                                        <div class="text-muted">fas fa-temperature-high</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-temperature-low"></i>
                                        </div>
                                        <div class="text-muted">fas fa-temperature-low</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-tenge"></i>
                                        </div>
                                        <div class="text-muted">fas fa-tenge</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-terminal"></i>
                                        </div>
                                        <div class="text-muted">fas fa-terminal</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-text-height"></i>
                                        </div>
                                        <div class="text-muted">fas fa-text-height</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-text-width"></i>
                                        </div>
                                        <div class="text-muted">fas fa-text-width</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-th"></i>
                                        </div>
                                        <div class="text-muted">fas fa-th</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-th-large"></i>
                                        </div>
                                        <div class="text-muted">fas fa-th-large</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-th-list"></i>
                                        </div>
                                        <div class="text-muted">fas fa-th-list</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-theater-masks"></i>
                                        </div>
                                        <div class="text-muted">fas fa-theater-masks</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-thermometer"></i>
                                        </div>
                                        <div class="text-muted">fas fa-thermometer</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-thermometer-empty"></i>
                                        </div>
                                        <div class="text-muted">fas fa-thermometer-empty</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-thermometer-full"></i>
                                        </div>
                                        <div class="text-muted">fas fa-thermometer-full</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-thermometer-half"></i>
                                        </div>
                                        <div class="text-muted">fas fa-thermometer-half</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-thermometer-quarter"></i>
                                        </div>
                                        <div class="text-muted">fas fa-thermometer-quarter</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-thermometer-three-quarters"></i>
                                        </div>
                                        <div class="text-muted">fas fa-thermometer-three-quarters</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-thumbs-down"></i>
                                        </div>
                                        <div class="text-muted">fas fa-thumbs-down</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-thumbs-up"></i>
                                        </div>
                                        <div class="text-muted">fas fa-thumbs-up</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-thumbtack"></i>
                                        </div>
                                        <div class="text-muted">fas fa-thumbtack</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-ticket-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-ticket-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-times"></i>
                                        </div>
                                        <div class="text-muted">fas fa-times</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-times-circle"></i>
                                        </div>
                                        <div class="text-muted">fas fa-times-circle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-tint"></i>
                                        </div>
                                        <div class="text-muted">fas fa-tint</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-tint-slash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-tint-slash</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-tired"></i>
                                        </div>
                                        <div class="text-muted">fas fa-tired</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-toggle-off"></i>
                                        </div>
                                        <div class="text-muted">fas fa-toggle-off</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-toggle-on"></i>
                                        </div>
                                        <div class="text-muted">fas fa-toggle-on</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-toilet"></i>
                                        </div>
                                        <div class="text-muted">fas fa-toilet</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-toilet-paper"></i>
                                        </div>
                                        <div class="text-muted">fas fa-toilet-paper</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-toilet-paper-slash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-toilet-paper-slash</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-toolbox"></i>
                                        </div>
                                        <div class="text-muted">fas fa-toolbox</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-tools"></i>
                                        </div>
                                        <div class="text-muted">fas fa-tools</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-tooth"></i>
                                        </div>
                                        <div class="text-muted">fas fa-tooth</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-torah"></i>
                                        </div>
                                        <div class="text-muted">fas fa-torah</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-torii-gate"></i>
                                        </div>
                                        <div class="text-muted">fas fa-torii-gate</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-tractor"></i>
                                        </div>
                                        <div class="text-muted">fas fa-tractor</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-trademark"></i>
                                        </div>
                                        <div class="text-muted">fas fa-trademark</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-traffic-light"></i>
                                        </div>
                                        <div class="text-muted">fas fa-traffic-light</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-trailer"></i>
                                        </div>
                                        <div class="text-muted">fas fa-trailer</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-train"></i>
                                        </div>
                                        <div class="text-muted">fas fa-train</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-tram"></i>
                                        </div>
                                        <div class="text-muted">fas fa-tram</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-transgender"></i>
                                        </div>
                                        <div class="text-muted">fas fa-transgender</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-transgender-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-transgender-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-trash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-trash</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-trash-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-trash-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-trash-restore"></i>
                                        </div>
                                        <div class="text-muted">fas fa-trash-restore</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-trash-restore-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-trash-restore-alt</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-tree"></i>
                                        </div>
                                        <div class="text-muted">fas fa-tree</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-trophy"></i>
                                        </div>
                                        <div class="text-muted">fas fa-trophy</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-truck"></i>
                                        </div>
                                        <div class="text-muted">fas fa-truck</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-truck-loading"></i>
                                        </div>
                                        <div class="text-muted">fas fa-truck-loading</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-truck-monster"></i>
                                        </div>
                                        <div class="text-muted">fas fa-truck-monster</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-truck-moving"></i>
                                        </div>
                                        <div class="text-muted">fas fa-truck-moving</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-truck-pickup"></i>
                                        </div>
                                        <div class="text-muted">fas fa-truck-pickup</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-tshirt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-tshirt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-tty"></i>
                                        </div>
                                        <div class="text-muted">fas fa-tty</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-tv"></i>
                                        </div>
                                        <div class="text-muted">fas fa-tv</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-umbrella"></i>
                                        </div>
                                        <div class="text-muted">fas fa-umbrella</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-umbrella-beach"></i>
                                        </div>
                                        <div class="text-muted">fas fa-umbrella-beach</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-underline"></i>
                                        </div>
                                        <div class="text-muted">fas fa-underline</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-undo"></i>
                                        </div>
                                        <div class="text-muted">fas fa-undo</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-undo-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-undo-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-universal-access"></i>
                                        </div>
                                        <div class="text-muted">fas fa-universal-access</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-university"></i>
                                        </div>
                                        <div class="text-muted">fas fa-university</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-unlink"></i>
                                        </div>
                                        <div class="text-muted">fas fa-unlink</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-unlock"></i>
                                        </div>
                                        <div class="text-muted">fas fa-unlock</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-unlock-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-unlock-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-upload"></i>
                                        </div>
                                        <div class="text-muted">fas fa-upload</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-alt-slash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-alt-slash</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-astronaut"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-astronaut</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-check"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-check</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-circle"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-circle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-clock"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-clock</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-cog"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-cog</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-edit"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-edit</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-friends"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-friends</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-graduate"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-graduate</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-injured"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-injured</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-lock"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-lock</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-md"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-md</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-minus"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-minus</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-ninja"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-ninja</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-nurse"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-nurse</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-plus"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-plus</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-secret"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-secret</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-shield"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-shield</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-slash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-slash</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-tag"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-tag</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-tie"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-tie</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-user-times"></i>
                                        </div>
                                        <div class="text-muted">fas fa-user-times</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-users"></i>
                                        </div>
                                        <div class="text-muted">fas fa-users</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-users-cog"></i>
                                        </div>
                                        <div class="text-muted">fas fa-users-cog</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-users-slash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-users-slash</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-utensil-spoon"></i>
                                        </div>
                                        <div class="text-muted">fas fa-utensil-spoon</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-utensils"></i>
                                        </div>
                                        <div class="text-muted">fas fa-utensils</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-vector-square"></i>
                                        </div>
                                        <div class="text-muted">fas fa-vector-square</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-venus"></i>
                                        </div>
                                        <div class="text-muted">fas fa-venus</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-venus-double"></i>
                                        </div>
                                        <div class="text-muted">fas fa-venus-double</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-venus-mars"></i>
                                        </div>
                                        <div class="text-muted">fas fa-venus-mars</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-vest"></i>
                                        </div>
                                        <div class="text-muted">fas fa-vest</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-vest-patches"></i>
                                        </div>
                                        <div class="text-muted">fas fa-vest-patches</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-vial"></i>
                                        </div>
                                        <div class="text-muted">fas fa-vial</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-vials"></i>
                                        </div>
                                        <div class="text-muted">fas fa-vials</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-video"></i>
                                        </div>
                                        <div class="text-muted">fas fa-video</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-video-slash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-video-slash</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-vihara"></i>
                                        </div>
                                        <div class="text-muted">fas fa-vihara</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-virus"></i>
                                        </div>
                                        <div class="text-muted">fas fa-virus</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-virus-slash"></i>
                                        </div>
                                        <div class="text-muted">fas fa-virus-slash</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-viruses"></i>
                                        </div>
                                        <div class="text-muted">fas fa-viruses</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-voicemail"></i>
                                        </div>
                                        <div class="text-muted">fas fa-voicemail</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-volleyball-ball"></i>
                                        </div>
                                        <div class="text-muted">fas fa-volleyball-ball</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-volume-down"></i>
                                        </div>
                                        <div class="text-muted">fas fa-volume-down</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-volume-mute"></i>
                                        </div>
                                        <div class="text-muted">fas fa-volume-mute</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-volume-off"></i>
                                        </div>
                                        <div class="text-muted">fas fa-volume-off</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-volume-up"></i>
                                        </div>
                                        <div class="text-muted">fas fa-volume-up</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-vote-yea"></i>
                                        </div>
                                        <div class="text-muted">fas fa-vote-yea</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-vr-cardboard"></i>
                                        </div>
                                        <div class="text-muted">fas fa-vr-cardboard</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-walking"></i>
                                        </div>
                                        <div class="text-muted">fas fa-walking</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-wallet"></i>
                                        </div>
                                        <div class="text-muted">fas fa-wallet</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-warehouse"></i>
                                        </div>
                                        <div class="text-muted">fas fa-warehouse</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-water"></i>
                                        </div>
                                        <div class="text-muted">fas fa-water</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-wave-square"></i>
                                        </div>
                                        <div class="text-muted">fas fa-wave-square</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-weight"></i>
                                        </div>
                                        <div class="text-muted">fas fa-weight</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-weight-hanging"></i>
                                        </div>
                                        <div class="text-muted">fas fa-weight-hanging</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-wheelchair"></i>
                                        </div>
                                        <div class="text-muted">fas fa-wheelchair</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-wifi"></i>
                                        </div>
                                        <div class="text-muted">fas fa-wifi</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-wind"></i>
                                        </div>
                                        <div class="text-muted">fas fa-wind</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-window-close"></i>
                                        </div>
                                        <div class="text-muted">fas fa-window-close</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-window-maximize"></i>
                                        </div>
                                        <div class="text-muted">fas fa-window-maximize</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-window-minimize"></i>
                                        </div>
                                        <div class="text-muted">fas fa-window-minimize</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-window-restore"></i>
                                        </div>
                                        <div class="text-muted">fas fa-window-restore</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-wine-bottle"></i>
                                        </div>
                                        <div class="text-muted">fas fa-wine-bottle</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-wine-glass"></i>
                                        </div>
                                        <div class="text-muted">fas fa-wine-glass</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-wine-glass-alt"></i>
                                        </div>
                                        <div class="text-muted">fas fa-wine-glass-alt</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-won-sign"></i>
                                        </div>
                                        <div class="text-muted">fas fa-won-sign</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-wrench"></i>
                                        </div>
                                        <div class="text-muted">fas fa-wrench</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-x-ray"></i>
                                        </div>
                                        <div class="text-muted">fas fa-x-ray</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-yen-sign"></i>
                                        </div>
                                        <div class="text-muted">fas fa-yen-sign</div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <div class="d-flex flex-grow-1 align-items-center bg-hover-light p-4 rounded">
                                        <div class="mr-4 flex-shrink-0 text-center" style="width: 40px;">
                                            <i class="icon-xl fas fa-yin-yang"></i>
                                        </div>
                                        <div class="text-muted">fas fa-yin-yang</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Content-->