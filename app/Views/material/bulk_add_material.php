<?php use App\Models\MaterialGroupModel; ?>
<?php use App\Models\UomModel; ?>
<?php $this->mat_group = new MaterialGroupModel(); ?>
<?php $this->uom = new UomModel(); ?>
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
                        <a href="" class="text-muted">Product</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Add Product</a>
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
                    <div class="card card-custom gutter-b example example-compact card-sticky" id="kt_page_sticky_card">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Batch Add Product</h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="<?= base_url('material'); ?>" class="btn btn-light-primary font-weight-bolder mr-2">
                                <i class="ki ki-long-arrow-back icon-xs"></i>Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form action="<?php echo base_url('material/bulk_add'); ?>" enctype="multipart/form-data" method="post" class="form" id="bulk_add_product">
                            <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-xl-2"></div>
                                    <div class="col-xl-8">
                                        <div class="my-5">
                                            <!-- -->
                                            <div class="form-group row">
                                                <label class="col-3">Download Template Here</label>
                                                <div class="col-9">
                                                    <a href="<?php echo base_url('/template').'/template_add_product_ver2.xlsx'; ?>" class="btn btn-outline-primary mr-3"><i class="flaticon-file"></i>Upload Format</a>
                                                </div>
                                            </div>
                                            <?php if($import == 0) { ?>
                                            <div class="form-group row">
                                                <label class="col-3">Upload File Here</label>
                                                <div class="col-9">
                                                    <input type="file" name="fileexcel" class="form-control" id="file" required accept=".xls, .xlsx" /></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3"></label>
                                                <div class="col-9">
                                                    <div class="btn-group">
                                                        <button type="submit" form="bulk_add_product" class="btn btn-primary font-weight-bolder">
                                                        <i class="ki ki-check icon-xs"></i>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php if($import == 1) { ?>
                                <div class="row">
                                    <div class="col-xl-2"></div>
                                    <div class="col-xl-8">
                                        <div class="my-5">
                                            <form action="<?php echo base_url('material/bulk_create'); ?>" enctype="multipart/form-data" method="post" class="form" id="bulk_save_product">
                                                <h3 class="text-dark font-weight-bold">Preview:</h3>
                                                <!-- -->
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <table class="table table-striped table-bordered-scroll-x">
                                                            <thead> 
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th>Product Name</th>
                                                                    <th>Description</th>
                                                                    <th>Product Group</th>
                                                                    <th>UoM</th>
                                                                    <th>Product Code</th>
                                                                    <th>Product Weight (Kg)</th>
                                                                    <th>Product Height (cm)</th>
                                                                    <th>Product Length (cm)</th>
                                                                    <th>Product Width (cm)</th>
                                                                    <th>Product Price (Rp)</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="LO">
                                                            <?php
                                                            $no=0;
                                                            $idx=0;
                                                            $error=0;
                                                            foreach ($material_data as $row) {
                                                                $mat_group_data = $this->mat_group->get_matgroup_byname(@$row['mat_group_name']);
                                                                //print_r($mat_group_data->mat_group_id);die;
                                                                $mat_group = @$mat_group_data->mat_group_id;
                                                                // var_dump($mat_group);
                                                                $uom = @$this->uom->get_uom_byname(@$row['uom_name'])->uom_id;

                                                                if(empty(@$row['material_name'])){
                                                                    $material_name_error = true;
                                                                    $error++;
                                                                }else{
                                                                    $material_name_error = false;
                                                                }
                                                                $check_errors[] = $material_name_error;

                                                                if(empty(@$row['description'])){
                                                                    $description = true;
                                                                    $error++;
                                                                }else{
                                                                    $description = false;
                                                                }
                                                                $check_errors[] = $description;
                                                                
                                                                if(empty(@$row['mat_group_name']) or $mat_group == null){
                                                                    $mat_group_name = true;
                                                                    $error++;
                                                                }else{
                                                                    $mat_group_name = false;
                                                                }
                                                                $check_errors[] = $mat_group_name;

                                                                if(empty(@$row['uom_name']) or $uom == null){
                                                                    $uom_name = true;
                                                                    $error++;
                                                                }else{
                                                                    $uom_name = false;
                                                                }
                                                                $check_errors[] = $uom_name;

                                                                if(empty(@$row['material_code'])){
                                                                    $material_code = true;
                                                                    $error++;
                                                                }else{
                                                                    $material_code = false;
                                                                }
                                                                $check_errors[] = $material_code;

                                                                if(empty(@$row['material_weight'])){
                                                                    $material_weight = true;
                                                                    $error++;
                                                                }else{
                                                                    $material_weight = false;
                                                                }
                                                                $check_errors[] = $material_weight;

                                                                if(empty(@$row['material_height'])){
                                                                    $material_height = true;
                                                                    $error++;
                                                                }else{
                                                                    $material_height = false;
                                                                }
                                                                $check_errors[] = $material_height;

                                                                if(empty(@$row['material_length'])){
                                                                    $material_length = true;
                                                                    $error++;
                                                                }else{
                                                                    $material_length = false;
                                                                }
                                                                $check_errors[] = $material_length;

                                                                if(empty(@$row['material_width'])){
                                                                    $material_width = true;
                                                                    $error++;
                                                                }else{
                                                                    $material_width = false;
                                                                }
                                                                $check_errors[] = $material_width;

                                                                if(empty(@$row['material_price'])){
                                                                    $material_price = true;
                                                                    $error++;
                                                                }else{
                                                                    $material_price = false;
                                                                }
                                                                $check_errors[] = $material_price;
                                                        ?>
                                                            <tr>
                                                                <td><?= $no+1 ?> </td>
                                                                <td class="<?php if($material_name_error == true){ echo 'table-danger'; } ?>"><input type="hidden" name="material[<?= $no; ?>][material_name]" value="<?= @$row['material_name'] ?>"><?= @$row['material_name'] ?></td>
                                                                <td class="<?php if($description == true){ echo 'table-danger'; } ?>"><input type="hidden" name="material[<?= $no; ?>][description]" value="<?= @$row['description'] ?>"><?= @$row['description'] ?></td>
                                                                <td class="<?php if($mat_group_name == true){ echo 'table-danger'; } ?>"><input type="hidden" name="material[<?= $no; ?>][mat_group_name]" value="<?= @$row['mat_group_name'] ?>"><?= @$row['mat_group_name'] ?></td>
                                                                <td class="<?php if($uom_name == true){ echo 'table-danger'; } ?>"><input type="hidden" name="material[<?= $no; ?>][uom_name]" value="<?= @$row['uom_name'] ?>"><?= @$row['uom_name'] ?></td>
                                                                <td class="<?php if($material_code == true){ echo 'table-danger'; } ?>"><input type="hidden" name="material[<?= $no; ?>][material_code]" value="<?= @$row['material_code'] ?>"><?= @$row['material_code'] ?></td>
                                                                <td class="<?php if($material_weight == true){ echo 'table-danger'; } ?>"><input type="hidden" name="material[<?= $no; ?>][material_weight]" value="<?= @$row['material_weight'] ?>"><?= @$row['material_weight'] ?></td>
                                                                <td class="<?php if($material_height == true){ echo 'table-danger'; } ?>"><input type="hidden" name="material[<?= $no; ?>][material_height]" value="<?= @$row['material_height'] ?>"><?= @$row['material_height'] ?></td>
                                                                <td class="<?php if($material_length == true){ echo 'table-danger'; } ?>"><input type="hidden" name="material[<?= $no; ?>][material_length]" value="<?= @$row['material_length'] ?>"><?= @$row['material_length'] ?></td>
                                                                <td class="<?php if($material_width == true){ echo 'table-danger'; } ?>"><input type="hidden" name="material[<?= $no; ?>][material_width]" value="<?= @$row['material_width'] ?>"><?= @$row['material_width'] ?></td>
                                                                <td class="<?php if($material_price == true){ echo 'table-danger'; } ?>"><input type="hidden" name="material[<?= $no; ?>][material_price]" value="<?= @$row['material_price'] ?>"><?= number_format(@$row['material_price']) ?></td>
                                                            </tr>
                                                        <?php $no++; } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-9">
                                                        <div class="btn-group">
                                                            <?php if($error == 0) { ?>
                                                            <button type="submit" form="bulk_save_product" class="btn btn-primary font-weight-bolder">
                                                            <i class="ki ki-check icon-xs"></i>Save Data</button>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <!--end::Form-->
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