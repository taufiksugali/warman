<?php use App\Models\OwnersModel; ?>
<?php $this->owner = new OwnersModel(); 
    $owner = $this->owner->get_all_owner();?>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Inbound Request</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Inbound Request</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Add Inbound Request</a>
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
                            <h3 class="card-title">Add Inbound Request</h3>
                        </div>
                        <!--begin::Form-->
                        <?= session()->getFlashdata('message'); ?>
                        <form method="post" class="form" action="<?php echo base_url('purchaseorder/create'); ?>">
                            <div class="card-body">
                                <div class="input_fields_wrap">
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label>PO Number
                                            <span class="text-danger">*</span></label>
                                            <input required type="text" name="po_number" autocomplete="off" class="form-control <?= ($validation->getError('po_number')) ? 'is-invalid' : ''; ?>" placeholder="Enter PO number" />
                                            <?php if($validation->getError('po_number')){ echo '<div class="invalid-feedback">'.$validation->getError('po_number').'</div>'; } ?>
                                        </div>
                                        <div class="col-4">
                                        <label>Warehouse
                                            <span class="text-danger">*</span></label>
                                            <select required class="form-control select select2 <?= ($validation->getError('warehouse_id')) ? 'is-invalid' : ''; ?>" value="<?= old('warehouse_id'); ?>" id="warehouse_id" name="warehouse_id">
                                                <option value="" selected></option>
                                                <?php $now = date('H:i');
                                                    foreach(@$warehouse as $row) { ?>
                                                <option value="<?= @$row->warehouse_id; ?>" 
                                                    <?php 
                                                        $start = date('H:i', strtotime($row->opening_hour));
                                                        $end = date('H:i', strtotime($row->closing_hour));
                                                        if(intVal($row->is_open) == 0){ 
                                                            echo "disabled"; 
                                                        } elseif(date('H:i') >= $start && date('H:i') <= $end){    
                                                        } else {
                                                            echo "disabled";
                                                        }
                                                            ?>><?= @$row->wh_name; ?> 
                                                            <?php 
                                                                if(intVal($row->is_open) == 0){ 
                                                                    echo "(Close)"; 
                                                                } elseif(date('H:i') >= $start && date('H:i') <= $end){    
                                                                } else {
                                                                    echo "(Close)";
                                                                }
                                                            ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <?php if($validation->getError('warehouse_id')){ echo '<div class="invalid-feedback">'.$validation->getError('warehouse_id').'</div>'; } ?>
                                        </div>
                                        <div class="col-4">
                                            <label>PO Date
                                            <span class="text-danger">*</span></label>
                                                <div class="input-group date">
                                                    <input type="text" class="form-control form-control-solid" value="<?php echo date_format(date_create(date('Y-m-d')), 'd-m-Y'); ?>" readonly="readonly" name="po_date" placeholder="Select date" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php if($validation->getError('po_date')){ echo '<div class="invalid-feedback">'.$validation->getError('po_date').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label>Owner Name</label>
                                            <?php if(session()->get('user_type') == 1){ ?>
                                                <input type="text" hidden name="owners_id" autocomplete="off" class="form-control <?= ($validation->getError('owners_id')) ? 'is-invalid' : ''; ?>" value="<?= session()->get('owners_id') ?>" />
                                                <input type="text" readonly name="owners_name" autocomplete="off" class="form-control form-control-solid <?= ($validation->getError('owners_id')) ? 'is-invalid' : ''; ?>" value="<?= $this->owner->get_owner_byid(session()->get('owners_id'))->owners_name ?>" placeholder="Enter code" />
                                                <?php if($validation->getError('owners_id')){ echo '<div class="invalid-feedback">'.$validation->getError('owners_id').'</div>'; } ?>
                                            <?php } else {?>
                                                <select class="form-control select select2 <?= ($validation->getError('owners_id')) ? 'is-invalid' : ''; ?>" value="<?= old('owners_id'); ?>" id="owners_id" name="owners_id">
                                                <option value="" selected></option>
                                                <?php foreach(@$owner as $row) { ?>
                                                <option value="<?= @$row->owners_id; ?>"><?= @$row->owners_name; ?></option>
                                                <?php } ?>
                                                </select>
                                                <?php if($validation->getError('owners_id')){ echo '<div class="invalid-feedback">'.$validation->getError('owners_id').'</div>'; } ?>
                                            <?php } ?>
                                        </div>
                                        <div class="col-4">
                                            <label>Due Date
                                            <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="kt_datepicker_2" required readonly="readonly" name="due_date" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php if($validation->getError('due_date')){ echo '<div class="invalid-feedback">'.$validation->getError('due_date').'</div>'; } ?>
                                        </div>
                                        <div class="col-4">
                                            <label>Quality Control
                                            <span class="text-danger">*</span></label>
                                            <div class="radio-inline">
                                                <label class="radio">
                                                <input type="radio" name="qc_status" value="1" onchange="get_qc();">
                                                <span></span>Yes</label>
                                                <label class="radio radio-danger">
                                                <input type="radio" checked name="qc_status" value="0" onchange="get_qc();">
                                                <span></span>No</label>
                                            </div>
                                            <span class="form-text text-muted">Determine whether this products will be checked by warehouse or not.</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <label>Remark</label>
                                            <textarea name="description" class="form-control <?= ($validation->getError('description')) ? 'is-invalid' : ''; ?>" rows="4" placeholder="Enter remark" ></textarea>
                                            <?php if($validation->getError('description')){ echo '<div class="invalid-feedback">'.$validation->getError('description').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div id="po" class="add_product">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <button type="button" class="add_field_button btn font-weight-bold btn-light-warning btn-sm">
                                                        <i class="la la-plus"></i>Add Product</button>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="form-group row">
                                                        <div class="col-6">
                                                            <label class="font-weight-bold">Product<span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <select required class="select form-control custom-select showproduct" id="material_id0" name="material_id[]" onchange="get_material_price()">
                                                                    <option></option>
                                                                    <?php if (@$material) :
                                                                        foreach ($material as $row) :
                                                                            if($row->material_weight == $row->weight_comparison && $row->material_height == $row->height_comparison
                                                                                && $row->material_length == $row->length_comparison && $row->material_width == $row->width_comparison) :
                                                                    ?>
                                                                    <option value="<?= $row->material_id ?>"><?= $row->material_name ?></option>
                                                                    <?php endif; endforeach; endif; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="font-weight-bold">Quantity<span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="text" required class="form-control numbers <?= ($validation->getError('quantity')) ? 'is-invalid' : ''; ?>" value="" id="quantity" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this);" name="quantity[0]" placeholder="Quantity">
                                                                <span class="input-group-text" id="basic-addon2">BAG</span>
                                                                <?php if($validation->getError('quantity')){ echo '<div class="invalid-feedback">'.$validation->getError('quantity').'</div>'; } ?>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-4">
                                                            <label class="font-weight-bold">Unit Price<span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        Rp.
                                                                    </span>
                                                                </div>
                                                                <input type="text" required readonly class="form-control form-control-solid numbers <?= ($validation->getError('material_price')) ? 'is-invalid' : ''; ?>"  id="price0" name="material_price[0]" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this);" placeholder="Unit Price">
                                                                <?php if($validation->getError('material_price')){ echo '<div class="invalid-feedback">'.$validation->getError('material_price').'</div>'; } ?>
                                                            </div>
                                                        </div> -->
                                                        <div class="col-1">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="separator separator-dashed"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div id="btn">
                                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                                    </div>
                                    <a href="<?= base_url('purchaseorder'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                            <div class="modal fade" id="ModalQc" tabindex="-1" aria-labelledby="ModalQc" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirm Quality Control</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <p>Are you sure? <strong>Quality Control</strong> will be takes more time.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success mr-2">Submit</button>
                                            <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
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
    function get_qc(){
        var radios = document.getElementsByName('qc_status');

        for (var i = 0, length = radios.length; i < length; i++) {
            if (radios[i].checked) {
                // do whatever you want with the checked radio
                console.log(radios[i].value);

                if(radios[i].value == "1"){
                    console.log("yes");
                    document.getElementById("btn").innerHTML = '<a onclick="modal_qc()" class="btn btn-primary mr-2">Submit</a>'
                }else if (radios[i].value == "0"){
                    console.log("no");
                    document.getElementById("btn").innerHTML = '<button type="submit" class="btn btn-success mr-2">Submit</button>'
                }

                // only one radio can be logically checked, don't check the rest
                break;
            }
        }
    }

    function modal_qc(){
        $.ajax({
            success: function(response){ 
                // Add response in Modal body
                // console.log(response);
                // Display Modal
                $('#ModalQc').modal('show'); 
            }
        });
    }

</script>