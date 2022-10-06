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
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Transaction</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Transaction</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Dispatch Order</a>
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
            <form method="post" class="form" action="<?php echo base_url('outboundpo/create'); ?>">
            <div class="row">
                <div class="col-md-12">
                    <!--begin::Card-->
                    <div class="card card-custom card-sticky gutter-b" id="kt_page_sticky_card">
                        <div class="card-header">
                            <h3 class="card-title">Add Dispatch Order</h3>
                            <div class="card-toolbar">
                                <a href="<?= base_url('outboundpo'); ?>" class="btn btn-light-primary font-weight-bolder mr-2"  type="reset">
                                <i class="ki ki-long-arrow-back icon-sm"></i>Cancel</a>
                                <button type="submit" class="btn btn-primary font-weight-bolder">
                                <i class="ki ki-check icon-sm"></i>Next</button>
                            </div>
                        </div>
                        
                        <!--begin::Form-->
                            <div class="card-body">
                                <?= session()->getFlashdata('message'); ?>
                                <div class="input_fields_outbound_po">
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label>Owner Name<span class="text-danger">*</span></label>
                                            <?php if(session()->get('user_type') == 1){ ?>
                                                <input type="text" hidden name="owner_id" id="owner_id_outbound" autocomplete="off" class="form-control <?= ($validation->getError('owners_id')) ? 'is-invalid' : ''; ?>" value="<?= session()->get('owners_id') ?>" />
                                                <input type="text" hidden name="add" id="customer_add" autocomplete="off" class="form-control" value="0" />
                                                <input type="text" readonly name="owners_name" autocomplete="off" class="form-control form-control-solid <?= ($validation->getError('owners_id')) ? 'is-invalid' : ''; ?>" value="<?= $this->owner->get_owner_byid(session()->get('owners_id'))->owners_name ?>" placeholder="Enter code" />
                                                <?php if($validation->getError('owners_id')){ echo '<div class="invalid-feedback">'.$validation->getError('owners_id').'</div>'; } ?>
                                            <?php } else {?>
                                                <select class="form-control select select2 <?= ($validation->getError('owners_id')) ? 'is-invalid' : ''; ?>" value="<?= old('owner_id'); ?>" id="owner_id_outbound" name="owner_id">
                                                <option value="" selected></option>
                                                <?php foreach(@$owner as $row) { ?>
                                                <option value="<?= @$row->owners_id; ?>"><?= @$row->owners_name; ?></option>
                                                <?php } ?>
                                                </select>
                                                <?php if($validation->getError('owners_id')){ echo '<div class="invalid-feedback">'.$validation->getError('owners_id').'</div>'; } ?>
                                            <?php } ?>
                                        </div>
                                        <div class="col-4">
                                            <label>Doc. Date
                                            <span class="text-danger">*</span></label>
                                                <div class="input-group date">
                                                    <input type="text" class="form-control form-control-solid" required value="<?php echo date_format(date_create(date('Y-m-d')), 'd-m-Y'); ?>" readonly="readonly" name="doc_date" placeholder="Select date" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php if($validation->getError('doc_date')){ echo '<div class="invalid-feedback">'.$validation->getError('doc_date').'</div>'; } ?>
                                        </div>
                                        <div class="col-4">
                                            <label>Outbound Date
                                            <span class="text-danger">*</span></label>
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" id="kt_datepicker_2" readonly="readonly" required name="out_date" placeholder="Select date" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php if($validation->getError('shipping_date')){ echo '<div class="invalid-feedback">'.$validation->getError('shipping_date').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-3">
                                            <label>Customer
                                            <span class="text-danger">*</span></label>
                                            <select class="form-control select select2 <?= ($validation->getError('customer_id')) ? 'is-invalid' : ''; ?>" value="<?= old('customer_id'); ?>" id="customer_id" name="customer_id" onchange="form_view_cust()">
                                                <option value="" selected></option>
                                                <?php foreach(@$customer as $row) { ?>
                                                    <option value="<?= @$row->customer_id; ?>"><?= @$row->customer_name .' - '. @$row->customer_phone; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if($validation->getError('customer_id')){ echo '<div class="invalid-feedback">'.$validation->getError('customer_id').'</div>'; } ?>
                                        </div>
                                        <div class="col-1">
                                        <label>&nbsp;</label><br/>
                                            <a id="btn_add_cus" onclick="form_add_cust()" class="btn btn-icon btn-primary" title="Add Customer">
                                                <i class="flaticon2-add"></i>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <label>Warehouse
                                            <span class="text-danger">*</span></label>
                                            <select class="form-control select select2 <?= ($validation->getError('warehouse_id')) ? 'is-invalid' : ''; ?>" value="<?= old('warehouse_id'); ?>" id="warehouse_id_outboundpo" name="warehouse_id">
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
                                        
                                    </div>
                                    <div id="add_customer">
                                        
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label>Remark</label>
                                            <textarea name="description" class="form-control <?= ($validation->getError('description')) ? 'is-invalid' : ''; ?>" placeholder="Enter remark" ></textarea>
                                            <?php if($validation->getError('description')){ echo '<div class="invalid-feedback">'.$validation->getError('description').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div id="po" class="add_product">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <button type="button" class="btn font-weight-bold btn-light-warning btn-sm" data-toggle="modal" data-target="#modalMaterial">
                                                        <i class="la la-plus"></i>Add Product</button>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="separator separator-dashed"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table name="tbl_material" class="table table-condensed table-hover"  style="margin-top: 10px">
                                        <thead>
                                            <tr>
                                            <th>Product ID</th>
                                            <th>Product Name</th>
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
                </div>
                <!--end::Container-->
            </div>
        </form>
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
                <div class="form-group row">
                    <div class="col-12">
                        <label class="font-weight-bold">Product<span class="text-danger">*</span></label>
                        <div class="input-group">
                        <select style="width: 100%" class="select form-control custom-select <?= ($validation->getError('material_id_outboundpo')) ? 'is-invalid' : ''; ?>" id="material_id_outboundpo" name="material_id">
                        </select>
                        <?php if($validation->getError('material_id_outboundpo')){ echo '<div class="invalid-feedback">'.$validation->getError('material_id_outboundpo').'</div>'; } ?>
                        </div>
                    </div>
                </div>
                <input type="hidden" readonly class="form-control form-control-solid numbers" value="" id="material_price_outbound" name="material_price_outbound" placeholder="Enter Price">
                <input type="hidden" readonly class="form-control numbers" value="" id="material_price_val" name="material_price_val" placeholder="Enter Price">
                <input type="hidden" id="material_volume" name="material_volume">
                <input type="hidden" id="material_luas_permukaan" name="material_luas_permukaan">
                <div class="form-group row">
                    <div class="col-6">
                        <label class="font-weight-bold">Stock at Location / Good<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" readonly class="form-control form-control-solid numbers" value="" id="qty_outbound" name="qty" placeholder="Stock">
                            
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="font-weight-bold">Stock at Location / Not Good<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" readonly class="form-control form-control-solid numbers" value="" id="qty_outbound_ng" name="qty_ng" placeholder="Stock">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <label class="font-weight-bold">Quantity<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control numbers <?= ($validation->getError('quantity')) ? 'is-invalid' : ''; ?>" id="quantity" name="quantity" placeholder="Quantity" onkeypress="return CheckNumeric()">
                            <?php if($validation->getError('quantity')){ echo '<div class="invalid-feedback">'.$validation->getError('quantity').'</div>'; } ?>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" onclick="setTablePO()">Add</button>
              </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
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