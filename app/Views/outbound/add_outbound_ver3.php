<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Outbound</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Product Packing</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Add Product Packing</a>
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
            <form method="post" class="form" action="<?php echo base_url('outbound/create'); ?>">
                <div class="row">
                    <div class="col-md-12">
                    <!--begin::Card-->
                    
                    <div class="card card-custom card-sticky gutter-b" id="kt_page_sticky_card">
                        <div class="card-header" style="">
                            <div class="card-title">
                                <h3 class="card-label">Form Add Product Packaging
                                <i class="mr-2"></i></h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="<?= base_url('outbound'); ?>" class="btn btn-light-primary font-weight-bolder mr-2"  type="reset">
                                <i class="ki ki-long-arrow-back icon-sm"></i>Cancel</a>
                                <button type="submit" class="btn btn-primary font-weight-bolder">
                                <i class="ki ki-check icon-sm"></i>Submit</button>
                            </div>
                        </div>
                        <!--begin::Form-->
                        
                            <div class="card-body">
                                <div class="input_fields_outbound">
                                <?= session()->getFlashdata('message'); ?>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label>Outbound Request Number
                                            <span class="text-danger">*</span></label>
                                            <input type="text" hidden id="po_outbound_id" name="po_outbound_id" value="<?= $outboundpo->po_outbound_id ?>" class="form-control <?= ($validation->getError('po_outbound_id')) ? 'is-invalid' : ''; ?>" placeholder="Enter Customer" />
                                            <input type="text" readonly id="po_id_detail" name="po_id_detail" value="<?= $outboundpo->po_outbound_id.'. Seller: '. $outboundpo->owners_name .'. Customer: '. $outboundpo->customer_name; ?>" class="form-control form-control-solid <?= ($validation->getError('po_outbound_id')) ? 'is-invalid' : ''; ?>" placeholder="Enter Customer" />
                                            <?php if($validation->getError('po_outbound_id')){ echo '<div class="invalid-feedback">'.$validation->getError('po_outbound_id').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label>Customer
                                            <span class="text-danger">*</span></label>
                                            <input type="text" hidden id="customer_id" name="customer_id" value="<?= $outboundpo->po_penerima ?>" class="form-control <?= ($validation->getError('customer_id')) ? 'is-invalid' : ''; ?>" placeholder="Enter Customer" />
                                            <input type="text" readonly id="customer_name" name="customer_name" value="<?= $outboundpo->customer_name ?>" class="form-control form-control-solid <?= ($validation->getError('customer_id')) ? 'is-invalid' : ''; ?>" placeholder="Enter Customer" />
                                            <?php if($validation->getError('customer_id')){ echo '<div class="invalid-feedback">'.$validation->getError('customer_id').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                            <label>Warehouse
                                            <span class="text-danger">*</span></label>
                                            <input type="text" hidden id="warehouse_id_outbound" name="warehouse_id" value="<?= $outboundpo->warehouse_id ?>" class="form-control <?= ($validation->getError('warehouse_id')) ? 'is-invalid' : ''; ?>" placeholder="Enter Warehouse" />
                                            <input type="text" readonly id="warehouse_name" name="warehouse_name" value="<?= $outboundpo->wh_name ?>" class="form-control form-control-solid <?= ($validation->getError('warehouse_id')) ? 'is-invalid' : ''; ?>" placeholder="Enter Warehouse" />
                                            <?php if($validation->getError('warehouse_id')){ echo '<div class="invalid-feedback">'.$validation->getError('warehouse_id').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label>Outbound Date
                                            <span class="text-danger">*</span></label>
                                                <div class="input-group date">
                                                    <input type="text" class="form-control form-control-solid" readonly="readonly" name="out_date" placeholder="Select date" value="<?php echo date_format(date_create(date('Y-m-d')), 'd-m-Y'); ?>"/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php if($validation->getError('out_date')){ echo '<div class="invalid-feedback">'.$validation->getError('out_date').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                            <label>PIC
                                            <span class="text-danger">*</span></label>
                                            <input type="text" hidden id="owner_id_outbound" name="owner_id" value="<?= $outboundpo->owners_id ?>" class="form-control <?= ($validation->getError('owner_id')) ? 'is-invalid' : ''; ?>" placeholder="Enter Warehouse" />
                                            <input type="text" readonly id="owners_name" name="owners_name" value="<?= $outboundpo->owners_name ?>" class="form-control form-control-solid <?= ($validation->getError('owner_id')) ? 'is-invalid' : ''; ?>" placeholder="Enter Seller" />
                                            <?php if($validation->getError('owner_id')){ echo '<div class="invalid-feedback">'.$validation->getError('owner_id').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label>License Plate / Container Number
                                            <span class="text-danger">*</span></label>
                                            <input type="text" id='lic_plate' name="lic_plate" required class="form-control <?= ($validation->getError('lic_plate')) ? 'is-invalid' : ''; ?>" placeholder="Enter number" />
                                            <?php if($validation->getError('lic_plate')){ echo '<div class="invalid-feedback">'.$validation->getError('lic_plate').'</div>'; } ?>
                                            <span class="text-danger error-msg"></span>
                                        </div>
                                        <div class="col-4">
                                            <label>Driver
                                            <span class="text-danger">*</span></label>
                                            <input type="text" id='outbound_driver' name="outbound_driver" required class="form-control <?= ($validation->getError('outbound_driver')) ? 'is-invalid' : ''; ?>" placeholder="Enter name" />
                                            <?php if($validation->getError('outbound_driver')){ echo '<div class="invalid-feedback">'.$validation->getError('outbound_driver').'</div>'; } ?>
                                            <span class="text-danger error-msg"></span>
                                        </div>
                                        <div class="col-4">
                                            <label>Transpoter
                                            <span class="text-danger">*</span></label>
                                            <input type="text" id='outbound_transpoter' name="outbound_transpoter" required class="form-control <?= ($validation->getError('outbound_transpoter')) ? 'is-invalid' : ''; ?>" placeholder="Enter number" />
                                            <?php if($validation->getError('outbound_transpoter')){ echo '<div class="invalid-feedback">'.$validation->getError('outbound_transpoter').'</div>'; } ?>
                                            <span class="text-danger error-msg"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Remark</label>
                                        <textarea name="description" class="form-control <?= ($validation->getError('description')) ? 'is-invalid' : ''; ?>" placeholder="Enter remark" ></textarea>
                                        <?php if($validation->getError('description')){ echo '<div class="invalid-feedback">'.$validation->getError('description').'</div>'; } ?>
                                    </div>
                                    <!-- <h5>Order List</h5> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="card card-custom gutter-b example example-compact">
                            <div class="card-header">
                                <h3 class="card-title">Order List Product Packing</h3>
                            </div>
                            <div class="card-body">
                                <table name="tbl_ref" class="table table-dark rounded"  style="margin-top: 10px">
                                    <thead>
                                        <tr>
                                            <th>Product ID</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl_ref">
                                        <?php foreach($outboundpo_detail as $row) { ?>
                                            <tr>
                                                <td><?= $row->material_id ?></td>
                                                <td><?= $row->material_name ?></td>
                                                <td><?= $row->outbound_qty.' '.$row->uom_name.'(s)' ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-custom gutter-b example example-compact">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">Products</h3>
                                </div>
                                <div class="card-toolbar">
                                    <div id="po" class="add_product">
                                        <button type="button" class="btn font-weight-bold btn-light-warning btn-sm" data-toggle="modal" data-target="#modalMaterial">
                                        <i class="la la-plus"></i>Add Product</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table name="tbl_material" class="table table-condensed table-hover table-striped rounded"  style="margin-top: 10px">
                                    <thead class="thead-light">
                                        <tr>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>Location</th>
                                        <th>Quantity</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl_material">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
            <!--end::Container-->
            <script>
                function hitung_total(idx) {
				if ($("#quantity" + idx).val() == "") {
					qty = 0;
				} else {
                    gt = $("#quantity" + idx).val();
					qty = parseInt(gt.replace(",", ""));
				}

				if ($("#subprice" + idx).val() == "") {
					price = 0;
				} else {
                    ngt = $("#subprice" + idx).val();
					price = parseInt(ngt.replace(",", ""));
				}
				var subtotal;
				subtotal = parseInt(qty) * parseInt(price);
				$("#price" + idx).val(subtotal);
                
			}

            function hitung_material(){
                var total = 0;
                for(var i=0;i <= 14; i++){
                    if($("#price" + i).val() == "" || $("#price" + i).val() == null){
                        gt = 0;
                    } else {
                        gt = $("#price" + i).val();
                    }
                    total += parseInt(gt);
                }
                $("#total").val(total);
                $("#packing_cost").val(total);
                // FormatCurrency("#packing_cost");
            }
            </script>
        </div>
    </div>
	<!--end::Entry-->
</div>
<!--end::Content-->
    <div class="modal fade" id="modalMaterial" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-wrapper">
          <!-- <div class="modal-dialog" style="max-width: 60%"> -->
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4>Choose Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
              </div>
              <div class="modal-body">
              <div class="input_fields_outbound">
                <div class="form-group">
                    <div class="col-12">
                        <label class="font-weight-bold">Product<span class="text-danger">*</span></label>
                        <div class="input-group">
                        <select style="width: 100%" class="select form-control custom-select showproduct <?= ($validation->getError('material_id_outbound')) ? 'is-invalid' : ''; ?>" id="material_id_outbound" name="material_id">
                            <option value="" selected></option>
                            <?php foreach(@$material as $row) { ?>
                                <option value='<?= $row->mat_detail_id ?>'><?= $row->material_name .' - exp:'. $row->expired_date .' - batch:'. $row->batch_no ?></option>
                            <?php } ?>
                        </select>
                        <?php if($validation->getError('material_id_outbound')){ echo '<div class="invalid-feedback">'.$validation->getError('material_id_outbound').'</div>'; } ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12">
                        <label class="font-weight-bold">Location<span class="text-danger">*</span></label>
                        <div class="input-group">
                        <select style="width: 100%" class="select form-control custom-select showproduct <?= ($validation->getError('location_id_outbound')) ? 'is-invalid' : ''; ?>" id="location_id_outbound" name="location_id">
                        </select>
                        <?php if($validation->getError('location_id_outbound')){ echo '<div class="invalid-feedback">'.$validation->getError('location_id_outbound').'</div>'; } ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12">
                        <label class="font-weight-bold">Stock at Location<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" readonly class="form-control numbers <?= ($validation->getError('qty')) ? 'is-invalid' : ''; ?>" value="<?= old('qty'); ?>" id="qty_outbound" name="qty" placeholder="Stock">
                            <?php if($validation->getError('qty')){ echo '<div class="invalid-feedback">'.$validation->getError('qty').'</div>'; } ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12">
                        <label class="font-weight-bold">Quantity<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="hidden" id="material_id_model_choose_product">
                            <input type="text" class="form-control numbers <?= ($validation->getError('quantity.*')) ? 'is-invalid' : ''; ?>" value="" id="quantity" name="quantity" placeholder="Quantity" onkeypress="return CheckNumeric()">
                            <?php if($validation->getError('quantity.*')){ echo '<div class="invalid-feedback">'.$validation->getError('quantity.*').'</div>'; } ?>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" onclick="setTable()">Add</button>
              </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
