<?php use App\Models\PrivilegeModel; ?>
<?php $this->privilege = new PrivilegeModel(); ?>
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
                        <a href="" class="text-muted">Level Data</a>
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
                            <h3 class="card-title">Edit Privilege</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('privilege/update'); ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Level Name
                                    <span class="text-danger">*</span></label>
                                    <input type="hidden" name="level_id" value="<?= $level->level_id ?>" />
                                    <input type="text" name="level_name" value="<?= $level->level_name ?>" readonly class="form-control <?= ($validation->getError('level_name')) ? 'is-invalid' : ''; ?>" placeholder="Enter name" />
                                    <?php if($validation->getError('level_name')){ echo '<div class="invalid-feedback">'.$validation->getError('level_name').'</div>'; } ?>
                                </div>
                                <table class="table table-bordered table-hover rounded">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Menu</th>
                                            <th scope="col">Sub Menu</th>
                                            <th scope="col">Access</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- buat satu array, disitu nampung yang akan di simpen di table user menu access  -->
                                        <!-- nanti ketika menu 'bukan' merupakan parent menu, dia insert di perulangan pertama ke array menu id dan null untuk sub menu nya -->
                                        <!-- ketika menu merupakan parent, dia nge save arraynya di perulangan kedua  -->
                                        <?php if (@$menu) :
                                            $no = 0;
                                            $index = 0;
                                            $level_id = null;
                                            $menu_id = null;
                                            $submenu_id = null;
                                            $access = "";
                                            $access2 = null;
                                            $cek_access = null;

                                            foreach ($menu as $row) :
                                            $no++; 
                                        ?>
                                        <tr class="table-primary">
                                            <th scope="row" class="text-left"><?= $no ?></th>
                                            <td colspan="2"><?= $row->menu_name ?></td>
                                            <?php if($row->is_parent == 0) {
                                                $level_id = $level->level_id;

                                                $menu_id = $row->id;
                                                
                                                $cek_access = $this->privilege->get_user_access_byid($level_id, $menu_id, $submenu_id);
                                                // echo json_encode($cek_access);
                                                if(!empty(@$cek_access)) {
                                                    $access = "checked";
                                                }else{
                                                    $access2 = "checked";
                                                }
                                            ?>
                                                <td class="text-center">
                                                    <input type="hidden" value="<?= $index ?>" id="user_privilege<?= $index ?>" name="user_privilege[]">
                                                    <input type="hidden" value="<?= $row->id ?>" id="menu_id<?= $index ?>" name="menu_id[]">
                                                    <input type="hidden" value="" id="submenu_id<?= $index ?>" name="submenu_id[]">
                                                    <input type="checkbox" id="check_<?= $index ?>" <?= $access ?> onClick="checked_val(<?= $index ?>)" />
                                                    <?php if(!empty(@$cek_access)) { ?>
                                                        <input type="hidden" value="1" id="check_val<?= $index ?>" name="check[]" />
                                                    <?php } else { ?> 
                                                        <input type="hidden" value="0" id="check_val<?= $index ?>" name="check[]" />
                                                    <?php } ?>
                                                    <!-- <div class="form-group row">
                                                        <div class="radio-inline">
                                                            <label class="radio">
                                                            <input type="radio" id="check_yes<?= $index ?>" <?= $access ?> name="check[]" value="1">
                                                            <span></span>Yes<?= $index ?></label>
                                                            <label class="radio radio-danger">
                                                            <input type="radio" id="check_no<?= $index ?>" <?= $access2 ?> name="check[]" value="0">
                                                            <span></span>No<?= $index ?></label>
                                                        </div>
                                                    </div> -->
                                                </td>
                                            <?php 
                                                $index++; 
                                                $level_id = null;
                                                $menu_id = null;
                                                $submenu_id = null;
                                                $cek_access = null;
                                                $access = "";
                                                $access2 = null;
                                                } else { 
                                            ?>
                                                <td>&nbsp;</td>
                                            <?php } ?>
                                        </tr>
                                        <?php $submenus = $this->privilege->get_all_sub_menu(@$row->id);?>
                                        <?php if(!empty(@$submenus)) {?>
                                                <?php $noSub = 1; ?>
                                                <?php 
                                                    foreach(@$submenus as $rowS) { 
                                                    $level_id = $level->level_id;
                                                    $menu_id = $row->id;
                                                    $submenu_id = $rowS->id;

                                                    $cek_access = $this->privilege->get_user_access_byid($level_id, $menu_id, $submenu_id);
                                                    // print_r($cek_access);
                                                    if(!empty(@$cek_access)) {
                                                        $access = "checked";
                                                    }else{
                                                        $access2 = "checked";
                                                    }
                                                ?>
                                                    <tr>
                                                        <th scope="row" class="text-left"><?php echo $no.'.'.$noSub; ?></th>
                                                        <td>&nbsp;</td>
                                                        <td><?= $rowS->submenu_name ?></td>
                                                        <td align="center">
                                                            <input type="hidden" value="<?= $index ?>" id="user_privilege<?= $index ?>" name="user_privilege[]">
                                                            <input type="hidden" value="<?= $rowS->menu_id ?>" id="menu_id<?= $index ?>" name="menu_id[]">
                                                            <input type="hidden" value="<?= $rowS->id ?>" id="submenu_id<?= $index ?>" name="submenu_id[]">
                                                            <input type="checkbox" id="check_<?= $index ?>" <?= $access ?> onClick="checked_val(<?= $index ?>)" />
                                                            <?php if(!empty(@$cek_access)) { ?>
                                                                <input type="hidden" value="1" id="check_val<?= $index ?>" name="check[]" />
                                                            <?php } else { ?> 
                                                                <input type="hidden" value="0" id="check_val<?= $index ?>" name="check[]" />
                                                            <?php } ?>
                                                            <!-- <div class="form-group">
                                                                <div class="radio-inline">
                                                                    <label class="radio">
                                                                    <input type="radio" id="check_yes<?= $index ?>" <?= $access ?> name="check[]" value="1">
                                                                    <span></span>Yes<?= $index ?></label>
                                                                    <label class="radio radio-danger">
                                                                    <input type="radio" id="check_no<?= $index ?>" <?= $access2 ?> name="check[]" value="0">
                                                                    <span></span>No<?= $index ?></label>
                                                                </div>
                                                            </div> -->
                                                        </td>
                                                    </tr>
                                                    <?php   
                                                        $noSub++;
                                                        $index++;
                                                        $level_id = null;
                                                        $menu_id = null;
                                                        $submenu_id = null;
                                                        $cek_access = null;
                                                        $access = "";
                                                        $access2 = null;
                                                    }; ?>
                                            <?php }; ?>
                                        <?php
                                            endforeach;
                                        endif;
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('privilege'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end::Container-->
            <script>
                function checked_val(idx) {
                    if(document.getElementById("check_"+idx).checked) {
                        document.getElementById("check_val"+idx).value = 1;
                    } else {
                        document.getElementById("check_val"+idx).value = 0;
                    }
                }
            </script>
        </div>
    </div>
	<!--end::Entry-->
</div>
<!--end::Content-->