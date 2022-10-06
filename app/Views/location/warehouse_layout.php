<?php use App\Models\LocationModel; ?>
<?php $this->location = new LocationModel(); ?>
<table class="table table-bordered">
    <tbody>
        <?php 
        if(@$warehouse_area){
            $areas = $warehouse_area; $shelfIndex = 0;?>
        <?php foreach(@$areas as $row) { ?>
        <tr>
            <td width="10%">
                
            </td>
            
            <td>
            <?= @$row->wh_area_name; ?>
                <?php $bloks = $this->location->get_blok_byarea(@$row->area_id);?>
                <?php if(!empty(@$bloks)) { ?>
                <table class="table table-bordered">
                    <tbody>
                    <?php foreach(@$bloks as $rowB) { ?>
                        <tr>
                            <td style="padding:10px;"> 
                                <?= @$rowB->blok_name; ?>
                                <?php $raks = $this->location->get_rak_byblok(@$rowB->blok_id);?>
                                <?php if(!empty(@$raks)) { ?>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <?php foreach(@$raks as $rowR) { ?>
                                                    <td>
                                                        <?= $rowR->rak_name; ?>
                                                        <?php $shelfs = $this->location->get_shelf_byrak(@$rowR->rak_id);?>
                                                        <?php if(!empty(@$shelfs)) {?>
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                <?php foreach(@$shelfs as $rowS) { 
                                                                        $avail_data = $this->location->count_material_on_shelf($rowS->shelf_id);
                                                                        if(@$avail_data->qty == null){
                                                                            $jml_on_shelf = 0;
                                                                        }else {
                                                                            $jml_on_shelf = intVal($avail_data->qty);
                                                                        }
                                                                        $avail = intVal($rowS->shelf_max) - intVal($jml_on_shelf);
                                                                        $max = intVal($rowS->shelf_max);
                                                                        $percentage = $avail/$max*100;
                                                                        if($percentage <= 25){
                                                                            $label = 'bg-danger';
                                                                        }elseif($percentage > 25 && $percentage <= 75){
                                                                            $label = 'bg-warning';
                                                                        }elseif($percentage > 75){
                                                                            $label = 'bg-primary';
                                                                        }
                                                                        $progress = 100 - $percentage;
                                                                    ?>
                                                                    
                                                                    <tr>
                                                                        <td>
                                                                            <a href="#" data-toggle="modal" onclick="get_mat_onshelf(<?= $shelfIndex ?>);" class="text-secondary"><?= $rowS->shelf_name ?></a>
                                                                            <input type="hidden" value="<?= $rowS->shelf_id ?>" id="shelfmats<?= $shelfIndex ?>" name="shelfmats_id[<?= $shelfIndex ?>]">
                                                                            <div class="progress">
                                                                                <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar <?= $label ?>" role="progressbar" style="width: <?= $progress?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><?= $progress ?>%</div>
                                                                            </div>

                                                                        </td>
                                                                    </tr>
                                                                    <?php $shelfIndex++;
                                                                    }; ?>
                                                                </tbody>
                                                            </table>
                                                        <?php }; ?>
                                                    </td>
                                                    <!-- <td ></td> -->
                                                <?php }; ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php }; ?>
                            </td>
                        </tr>
                    <?php }; ?>
                    </tbody>
                </table>
                <?php }; ?>
            </td>
        </tr>
        <?php }; ?>
        <?php } ?>

    </tbody>
</table>