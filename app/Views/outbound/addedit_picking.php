<style>
.select2-selection__rendered {
    line-height: 34px !important;
}
.select2-container .select2-selection--single {
    height: 38px !important;
}
.select2-selection__arrow {
    height: 37px !important;
}
.rowTbl td {
    vertical-align: middle;
}
.swal2-html-container {
    text-align: left;
    background: aliceblue;
    padding: 10px;
}
#tbl-error{
    width: 100%;
}
#tbl-error th, th {
  border: 1px solid black;
  padding: 5px;
}
#tbl-error th, td {
  border: 1px solid black;
  padding: 5px;
}
</style>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Picking</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="<?=base_url("picking")?>" class="text-muted">Picking List</a>
                    </li>
                    <li class="breadcrumb-item text-muted active">
                        <a href="" class="text-muted">Picking Detail</a>
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
                            <h3 class="card-title">Picking Detail</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" id="form-picking" class="form">
                            <div class="card-body">
                                <div class="input_fields_wrap">
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label>Outbound Request Number
                                            <span class="text-danger">*</span></label>
                                            <input type="hidden" name="po_id" id="po_id" value="<?= $outboundpo->po_outbound_id ?>"/>
                                            <input type="text" name="po_outbound_id" readonly class="form-control form-control-solid" id="po_outbound_id" value="<?= $outboundpo->po_outbound_id ?>" placeholder="Outbound Request Number" />
                                        </div>
                                        <div class="col-6">
                                            <label>Customer
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="customer_name" readonly class="form-control form-control-solid" id="customer_name" value="<?= $outboundpo->customer_name ?>" placeholder="Customer" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label>Delivery Date
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="po_out_date" readonly class="form-control form-control-solid" id="po_out_date" value="<?= $outboundpo->po_out_date ?>" placeholder="Delivery Date" />
                                        </div>
                                        <div class="col-6">
                                            <label>Seller
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="owners_name" readonly class="form-control form-control-solid" id="owners_name" value="<?= $outboundpo->owners_name ?>" placeholder="Seller" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label>Remark
                                            <span class="text-danger"></span></label>
                                            <input type="text" name="po_description" readonly class="form-control form-control-solid" id="po_description" value="<?= $outboundpo->po_description ?>" placeholder="Remark" />
                                        </div>
                                        <div class="col-6">
                                            <label>Warehouse
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="wh_name" readonly class="form-control form-control-solid" id="wh_name" value="<?= $outboundpo->wh_name ?>" placeholder="Warehouse" />
                                        </div>
                                    </div>


        
                                    <div class="separator separator-dashed"></div>
                                    <div style="overflow-x:auto">
                                        <table class="table nowrap table-bordered table-checkable table-nopaging">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: left; vertical-align: middle;" colspan="5">Product Detail</th>
                                                    <th style="text-align: center; vertical-align: middle;" colspan="3">
                                                        <div id="po" class="add_product">
                                                            <button type="button" class="btn font-weight-bold btn-light-warning btn-sm" data-toggle="modal" data-target="#modalMaterial">
                                                            <i class="la la-plus"></i>Add Product</button>
                                                        </div>
                                                        <a style="display: none;" type="button" class="btn btn-primary btn-xs" style="margin-top:4px" id="addProduct"><i class="fa fa-plus"></i> Add </a>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align: center; vertical-align: middle;" >Product ID</th>
                                                    <th style="text-align: center; vertical-align: middle;" >Product Code</th>
                                                    <th style="text-align: center; vertical-align: middle;" >Product Name</th>
                                                    <th style="text-align: center; vertical-align: middle;" >Location</th>
                                                    <th style="text-align: center; vertical-align: middle;" >Unit</th>
                                                    <th style="text-align: center; vertical-align: middle;"  width="55px">Stock</th>
                                                    <th style="text-align: center; vertical-align: middle;"  width="55px">Quantity</th>
                                                    <th style="text-align: center; vertical-align: middle;"  width="55px">#</th>
                                                </tr>
                                            </thead>
                                            <tbody id="grid-body">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="<?= base_url('picking'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
                                <button type="button" class="btn btn-primary mr-2" id="btn-save">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

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
                        <select style="width: 100%" class="select form-control custom-select showproduct" id="material_id_outbound" name="material_id">
                            <option value="" selected></option>
                            <?php foreach(@$material as $row) { ?>
                                <option value='<?= $row->mat_detail_id ?>'><?= $row->material_name .' - exp:'. $row->expired_date .' - batch:'. $row->batch_no ?></option>
                            <?php } ?>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12">
                        <label class="font-weight-bold">Location<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <select style="width: 100%" class="select form-control custom-select showproduct" id="location_id_outbound" name="location_id">
                            </select>
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

<script>
    var idPO        = '<?= $outboundpo->po_outbound_id ?>';
    var dataProdReq = <?=json_encode($material_ref)?>;
    var detail_po   = <?=json_encode($detail_po)?>;
    var owner_id    = '<?= $outboundpo->owners_id ?>';
    var id_wh       = '<?= $outboundpo->warehouse_id ?>';
</script>

