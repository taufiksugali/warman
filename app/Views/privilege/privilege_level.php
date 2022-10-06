<?php use App\Models\PrivilegeModel; ?>
<?php $this->privilege = new PrivilegeModel(); ?>
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
                <?php if(!empty(@$cek_access)) { ?>
                    <span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"/>
                        <path d="M6.26193932,17.6476484 C5.90425297,18.0684559 5.27315905,18.1196257 4.85235158,17.7619393 C4.43154411,17.404253 4.38037434,16.773159 4.73806068,16.3523516 L13.2380607,6.35235158 C13.6013618,5.92493855 14.2451015,5.87991302 14.6643638,6.25259068 L19.1643638,10.2525907 C19.5771466,10.6195087 19.6143273,11.2515811 19.2474093,11.6643638 C18.8804913,12.0771466 18.2484189,12.1143273 17.8356362,11.7474093 L14.0997854,8.42665306 L6.26193932,17.6476484 Z" fill="#000000" fill-rule="nonzero" transform="translate(11.999995, 12.000002) rotate(-180.000000) translate(-11.999995, -12.000002) "/>
                    </g>
                    </svg></span>
                <?php } else { ?> 
                    
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
                        <span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"/>
                                <path d="M6.26193932,17.6476484 C5.90425297,18.0684559 5.27315905,18.1196257 4.85235158,17.7619393 C4.43154411,17.404253 4.38037434,16.773159 4.73806068,16.3523516 L13.2380607,6.35235158 C13.6013618,5.92493855 14.2451015,5.87991302 14.6643638,6.25259068 L19.1643638,10.2525907 C19.5771466,10.6195087 19.6143273,11.2515811 19.2474093,11.6643638 C18.8804913,12.0771466 18.2484189,12.1143273 17.8356362,11.7474093 L14.0997854,8.42665306 L6.26193932,17.6476484 Z" fill="#000000" fill-rule="nonzero" transform="translate(11.999995, 12.000002) rotate(-180.000000) translate(-11.999995, -12.000002) "/>
                            </g>
                        </svg></span>
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