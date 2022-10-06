<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Inventory</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Manual Update Product</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Edit Product</a>
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
                            <h3 class="card-title">Edit Product</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('materialsize/update'); ?>">
                            <div class="card-body">
                                <table class="table table-hover table-bordered">
                                    <tbody>
                                        <tr>
                                            <td width="25%"><strong>Product Code</strong></td>
                                            <td width="75%">
                                                <input type="hidden" name="material_id" value="<?= $material_edit->material_id ?>"/>
                                                <input type="text" name="material_code" readonly class="form-control form-control-solid <?= ($validation->getError('material_code')) ? 'is-invalid' : ''; ?>" value="<?= $material_edit->material_code ?>" placeholder="Enter code" />
                                                <?php if($validation->getError('material_code')){ echo '<div class="invalid-feedback">'.$validation->getError('material_code').'</div>'; } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><strong>Product Name</strong></td>
                                            <td width="75%">
                                                <input type="text" name="material_name" readonly class="form-control form-control-solid <?= ($validation->getError('material_name')) ? 'is-invalid' : ''; ?>" value="<?= $material_edit->material_name ?>" placeholder="Enter name" />
                                                <?php if($validation->getError('material_name')){ echo '<div class="invalid-feedback">'.$validation->getError('material_name').'</div>'; } ?>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <td width="10%"></td>
                                            <td width="35%">Data</td>
                                            <td width="35%">Actual</td>
                                            <td width="20%">Status</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Weight</td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" id="data_weight" name="material_weight"  value="<?= $material_edit->material_weight ?>" 
                                                    class="form-control <?= ($validation->getError('material_weight')) ? 'is-invalid' : ''; ?>" 
                                                    placeholder="Enter weight" onkeyup="get_weight();" onkeypress="return CheckNumeric()" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            Kg
                                                        </span>
                                                    </div>
                                                </div>
                                                <?php if($validation->getError('material_weight')){ echo '<div class="invalid-feedback">'.$validation->getError('material_weight').'</div>'; } ?>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" readonly name="weight_comparison" id="actual_weight"  
                                                    value="<?= $material_edit->weight_comparison ?>" class="form-control form-control-solid <?= ($validation->getError('weight_comparison')) ? 'is-invalid' : ''; ?>" 
                                                    placeholder="Enter weight" onkeyup="get_weight();" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            Kg
                                                        </span>
                                                    </div>
                                                </div>
                                                <?php if($validation->getError('weight_comparison')){ echo '<div class="invalid-feedback">'.$validation->getError('weight_comparison').'</div>'; } ?>
                                            </td>
                                            <td id="status_weight">
                                            <?php
                                                $data_weight = intval($material_edit->material_weight);
                                                $actual_weight = intval($material_edit->weight_comparison);

                                                if($data_weight != $actual_weight){
                                                    echo '<span class="label label-light-danger label-pill label-inline mr-2">Data does not match</span>';
                                                }else if($data_weight == $actual_weight){
                                                    echo '<span class="label label-light-success label-pill label-inline mr-2">Data matched</span>';
                                                }
                                            ?>
                                                <input type="hidden" name="remark2" id="remark2" class="form-control "/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Length</td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text"  id="data_length" value="<?= $material_edit->material_length ?>" onkeypress="return CheckNumeric()" 
                                                    class="form-control numbers <?= ($validation->getError('material_length')) ? 'is-invalid' : ''; ?>" 
                                                    value="<?= old('material_length'); ?>" name="material_length" placeholder="Length" onkeyup="get_length();" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">cm</span>
                                                    </div>
                                                    <?php if($validation->getError('material_length')){ echo '<div class="invalid-feedback">'.$validation->getError('material_length').'</div>'; } ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" readonly id="actual_length" value="<?= $material_edit->length_comparison ?>"
                                                    class="form-control form-control-solid numbers <?= ($validation->getError('length_comparison')) ? 'is-invalid' : ''; ?>" 
                                                    value="<?= old('length_comparison'); ?>" name="length_comparison" onkeyup="get_length();" placeholder="Length"/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">cm</span>
                                                    </div>
                                                    <?php if($validation->getError('length_comparison')){ echo '<div class="invalid-feedback">'.$validation->getError('length_comparison').'</div>'; } ?>
                                                </div>
                                            </td>
                                            <td id="status_length">
                                            <?php
                                                $data_length = intval($material_edit->material_length);
                                                $actual_length = intval($material_edit->length_comparison);

                                                if($data_length != $actual_length){
                                                    echo '<span class="label label-light-danger label-pill label-inline mr-2">Data does not match</span>';
                                                }else if($data_length == $actual_length){
                                                    echo '<span class="label label-light-success label-pill label-inline mr-2">Data matched</span>';
                                                }
                                            ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Width</td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" onkeypress="return CheckNumeric()"  id="data_width" value="<?= $material_edit->material_width ?>" 
                                                    class="form-control  numbers <?= ($validation->getError('material_width')) ? 'is-invalid' : ''; ?>" 
                                                    value="<?= old('material_width'); ?>" name="material_width" placeholder="Width" onkeyup="get_width();"/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">cm</span>
                                                    </div>
                                                    <?php if($validation->getError('material_width')){ echo '<div class="invalid-feedback">'.$validation->getError('material_width').'</div>'; } ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" readonly id="actual_width" value="<?= $material_edit->width_comparison ?>" 
                                                    class="form-control form-control-solid numbers <?= ($validation->getError('width_comparison')) ? 'is-invalid' : ''; ?>" 
                                                    value="<?= old('width_comparison'); ?>" name="width_comparison" placeholder="Width" onkeyup="get_width();"/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">cm</span>
                                                    </div>
                                                    <?php if($validation->getError('width_comparison')){ echo '<div class="invalid-feedback">'.$validation->getError('width_comparison').'</div>'; } ?>
                                                </div>
                                            </td>
                                            <td id="status_width">
                                            <?php
                                                $data_width = intval($material_edit->material_width);
                                                $actual_width = intval($material_edit->width_comparison);

                                                if($data_width != $actual_width){
                                                    echo '<span class="label label-light-danger label-pill label-inline mr-2">Data does not match</span>';
                                                }else if($data_width == $actual_width){
                                                    echo '<span class="label label-light-success label-pill label-inline mr-2">Data matched</span>';
                                                }
                                            ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Height</td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" id="data_height" onkeypress="return CheckNumeric()" value="<?= $material_edit->material_height ?>" 
                                                    class="form-control  numbers <?= ($validation->getError('material_height')) ? 'is-invalid' : ''; ?>" 
                                                    value="<?= old('material_height'); ?>" name="material_height" placeholder="Height" onkeyup="get_height();"/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">cm</span>
                                                    </div>
                                                    <?php if($validation->getError('material_height')){ echo '<div class="invalid-feedback">'.$validation->getError('material_height').'</div>'; } ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text"id="actual_height" readonly value="<?= $material_edit->height_comparison ?>" 
                                                    class="form-control form-control-solid numbers <?= ($validation->getError('height_comparison')) ? 'is-invalid' : ''; ?>" onkeyup="get_height();"
                                                    value="<?= old('height_comparison'); ?>" name="height_comparison" placeholder="Height"/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">cm</span>
                                                    </div>
                                                    <?php if($validation->getError('height_comparison')){ echo '<div class="invalid-feedback">'.$validation->getError('height_comparison').'</div>'; } ?>
                                                </div>
                                            </td>
                                            <td id="status_height">
                                            <?php
                                                $data_height = intval($material_edit->material_height);
                                                $actual_height = intval($material_edit->height_comparison);

                                                if($data_height != $actual_height){
                                                    echo '<span class="label label-light-danger label-pill label-inline mr-2">Data does not match</span>';
                                                }else if($data_height == $actual_height){
                                                    echo '<span class="label label-light-success label-pill label-inline mr-2">Data matched</span>';
                                                }
                                            ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('materialsize'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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
<script>
    let remark_weight = "";
    let remark_height = "";
    let remark_length = "";
    let remark_width = "";
    let remark = "";

    function get_weight(){
        var data_weight = parseFloat(document.getElementById('data_weight').value);
        var actual_weight = parseFloat(document.getElementById('actual_weight').value);
        
        if(data_weight != actual_weight){
            document.getElementById("status_weight").innerHTML = '<span class="label label-light-danger label-pill label-inline mr-2">Data does not match</span>';
        }else{
            document.getElementById("status_weight").innerHTML = '<span class="label label-light-success label-pill label-inline mr-2">Data matched</span>';
        }

        if(data_weight < actual_weight){
            var remark_stock = actual_weight - data_weight;
            remark_weight = "added weight "+remark_stock.toString()+" kg";
            remark = remark_weight + " " + remark_height + " " + remark_length + " " + remark_width;
            document.getElementById("remark2").value = remark;
        }else if(data_weight > actual_weight){
            var remark_stock = data_weight - actual_weight;
            remark_weight = "deducted weight "+remark_stock.toString()+" kg";
            remark = remark_weight + " " + remark_height + " " + remark_length + " " + remark_width;
            document.getElementById("remark2").value = remark;
        }else if(data_weight === actual_weight){
            remark_weight = "";
            remark = remark_weight + " " + remark_height + " " + remark_length + " " + remark_width;
            document.getElementById("remark2").value = remark;
        }
    }

    function get_height(){
        var data_height = parseFloat(document.getElementById('data_height').value);
        var actual_height = parseFloat(document.getElementById('actual_height').value);
        
        if(data_height != actual_height){
            document.getElementById("status_height").innerHTML = '<span class="label label-light-danger label-pill label-inline mr-2">Data does not match</span>';
        }else{
            document.getElementById("status_height").innerHTML = '<span class="label label-light-success label-pill label-inline mr-2">Data matched</span>';
        }

        if(data_height < actual_height){
            var remark_stock = actual_height - data_height;
            remark_height = "added height "+remark_stock.toString()+" cm";
            remark = remark_weight + " " +wremark_height + " " + remark_length + " " + remark_width;
            document.getElementById("remark2").value = remark;
        }else if(data_height > actual_height){
            var remark_stock = data_height - actual_height;
            remark_height = "deducted height "+remark_stock.toString()+" cm";
            remark = remark_weight + " " + remark_height + " " + remark_length + " " + remark_width;
            document.getElementById("remark2").value = remark;
        }else if(data_height === actual_height){
            remark_height = "";
            remark = remark_weight + " " + remark_height + " " + remark_length + " " + remark_width;
            document.getElementById("remark2").value = remark;
        }
    }

    function get_length(){
        var data_length = parseFloat(document.getElementById('data_length').value);
        var actual_length = parseFloat(document.getElementById('actual_length').value);
        
        if(data_length != actual_length){
            document.getElementById("status_length").innerHTML = '<span class="label label-light-danger label-pill label-inline mr-2">Data does not match</span>';
        }else{
            document.getElementById("status_length").innerHTML = '<span class="label label-light-success label-pill label-inline mr-2">Data matched</span>';
        }

        if(data_length < actual_length){
            var remark_stock = actual_length - data_length;
            remark_length = "added length "+remark_stock.toString()+" cm";
            remark = remark_weight + " " + remark_height + " " + remark_length + " " + remark_width;
            document.getElementById("remark2").value = remark;
        }else if(data_length > actual_length){
            var remark_stock = data_length - actual_length;
            remark_length = "deducted length "+remark_stock.toString()+" cm";
            remark = remark_weight + " " + remark_height + " " + remark_length + " " + remark_width;
            document.getElementById("remark2").value = remark;
        }else if(data_length === actual_length){
            remark_length = "";
            remark = remark_weight + " " + remark_height + " " + remark_length + " " + remark_width;
            document.getElementById("remark2").value = remark;
        }
    }

    function get_width(){
        var data_width = parseFloat(document.getElementById('data_width').value);
        var actual_width = parseFloat(document.getElementById('actual_width').value);
        
        if(data_width != actual_width){
            document.getElementById("status_width").innerHTML = '<span class="label label-light-danger label-pill label-inline mr-2">Data does not match</span>';
        }else{
            document.getElementById("status_width").innerHTML = '<span class="label label-light-success label-pill label-inline mr-2">Data matched</span>';
        }

        if(data_width < actual_width){
            var remark_stock = actual_width - data_width;
            remark_width = "added width "+remark_stock.toString()+" cm";
            remark = remark_weight + " " + remark_height + " " + remark_length + " " + remark_width;
            document.getElementById("remark2").value = remark;
        }else if(data_width > actual_width){
            var remark_stock = data_width - actual_width;
            remark_width = "deducted width "+remark_stock.toString()+" cm";
            remark = remark_weight + " " + remark_height + " " + remark_length + " " + remark_width;
            document.getElementById("remark2").value = remark;
        }else if(data_width === actual_width){
            remark_width = "";
            remark = remark_weight + " " + remark_height + " " + remark_length + " " + remark_width;
            document.getElementById("remark2").value = remark;
        }
    }
</script>
