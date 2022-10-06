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
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Packing</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="<?=base_url("packing")?>" class="text-muted">Packing List</a>
                    </li>
                    <li class="breadcrumb-item text-muted active">
                        <a href="" class="text-muted">Packing Detail</a>
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
                                            <label>Remark from seller
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="po_description" readonly class="form-control form-control-solid" id="po_description" value="<?= $outboundpo->po_description ?>" placeholder="Remark" />
                                        </div>
                                        <div class="col-6">
                                            <label>Warehouse
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="wh_name" readonly class="form-control form-control-solid" id="wh_name" value="<?= $outboundpo->wh_name ?>" placeholder="Warehouse" />
                                        </div>
                                    </div>
                                    <div class="form-group row" style="margin-bottom: 0px !important;">
                                        <div class="col-4">
                                            <label>Packing Fee
                                            <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        Rp.
                                                    </span>
                                                </div>
                                                <input type="text" id="packing_fee" name="packing_fee" class="form-control custom_fee_text form-control-solid" placeholder="Enter Packing Fee" onkeypress="return CheckNumeric()" value="<?=@$packing_fee?>" readonly />
                                            </div>
                                            
                                        </div>
                                        <div class="col-4">
                                            <label>Admin Fee
                                            <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        Rp.
                                                    </span>
                                                </div>
                                                <input type="text" id="admin_fee" name="admin_fee" class="form-control custom_fee_text form-control-solid" placeholder="Enter Admin Fee" onkeypress="return CheckNumeric()" value="<?=@$admin_fee?>" readonly />
                                            </div>
                                            
                                        </div>
                                        <div class="col-4">
                                            <label>Custom Service Fee 
                                            <span class="text-danger"></span>
                                                <div class="btn" style="padding: 0px !important; margin: 0px !important;border: 0px !important;" onclick="infoCustomFee();">
                                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Code/Info-circle.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="height: 1.2rem !important;width: 1.2rem !important;" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="15" height="15"/>
                                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                        <rect fill="#000000" x="11" y="10" width="2" height="7" rx="1"/>
                                                        <rect fill="#000000" x="11" y="7" width="2" height="2" rx="1"/>
                                                    </g>
                                                </svg><!--end::Svg Icon--></span>
                                                </div>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        Rp.
                                                    </span>
                                                </div>
                                                <input type="text" id="custom_service_fee" name="custom_service_fee" class="form-control custom_fee_text form-control-solid" placeholder="Enter Custom service Fee" onkeypress="return CheckNumeric()" value="<?=@$custom_service_fee?>" readonly />
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                            <input class="form-check-input" type="checkbox" value="1" id="custom_fee" name="custom_fee"/>
                                            <span class="form-check-label" for="custom_fee">Custom Fee</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label>Remark</label>
                                        <textarea name="description" class="form-control " placeholder="Enter remark"></textarea>
                                    </div>
                                    <div class="separator separator-dashed"></div>
                                    <label>Packaging Material</label>
                                    <div class="separator separator-dashed"></div>
                                    <div style="overflow-x:auto">
                                        <table name="tbl_ref" class="table table-dark rounded"  style="margin-top: 10px">
                                            <thead>
                                                <tr>
                                                    <th>Packaging Material</th>
                                                    <th>Layer</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl_ref">
                                                <?php foreach($outbound_package as $op) { ?>
                                                    <tr>
                                                        <td><input type="hidden" name="pm_id[]" value="<?= $op->pm_id ?>" /> <?= $op->pm_name ?></td>
                                                        <td><input type="hidden" name="pm_qty[]" value="<?= $op->pm_qty ?>" /> <?= $op->pm_qty ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="separator separator-dashed"></div>
                                    <label>Product Detail</label>
                                    <div class="separator separator-dashed"></div>
                                    <div style="overflow-x:auto">
                                        <table class="table nowrap table-bordered table-checkable table-nopaging">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: right; vertical-align: middle;" id="text-search" colspan="2">Scan Barcode Product/Product ID</th>
                                                    <th style="text-align: center; vertical-align: middle;" colspan="2">
                                                        <div style="display: none;" id="select-product">
                                                            <select class="form-control select select2" id="selectProduct" name="selectProduct" style="margin-top: 3px; width: 100%;" ></select>
                                                        </div>
                                                        <input type="text" class="form-control" style="margin-top: 3px; width: 100%;" id="scan-barcode" placeholder="Scan Product Barcode" >

                                                    </th>
                                                    <th style="text-align: left; vertical-align: middle;">
                                                        <a type="button" class="btn btn-white btn-sm" style="margin-top:4px;display: none;" id="btn-scan">
                                                            <span class="svg-icon svg-icon-success svg-icon-md">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3" d="M3 6C2.4 6 2 5.6 2 5V3C2 2.4 2.4 2 3 2H5C5.6 2 6 2.4 6 3C6 3.6 5.6 4 5 4H4V5C4 5.6 3.6 6 3 6ZM22 5V3C22 2.4 21.6 2 21 2H19C18.4 2 18 2.4 18 3C18 3.6 18.4 4 19 4H20V5C20 5.6 20.4 6 21 6C21.6 6 22 5.6 22 5ZM6 21C6 20.4 5.6 20 5 20H4V19C4 18.4 3.6 18 3 18C2.4 18 2 18.4 2 19V21C2 21.6 2.4 22 3 22H5C5.6 22 6 21.6 6 21ZM22 21V19C22 18.4 21.6 18 21 18C20.4 18 20 18.4 20 19V20H19C18.4 20 18 20.4 18 21C18 21.6 18.4 22 19 22H21C21.6 22 22 21.6 22 21Z" fill="black"></path>
                                                                    <path d="M3 16C2.4 16 2 15.6 2 15V9C2 8.4 2.4 8 3 8C3.6 8 4 8.4 4 9V15C4 15.6 3.6 16 3 16ZM13 15V9C13 8.4 12.6 8 12 8C11.4 8 11 8.4 11 9V15C11 15.6 11.4 16 12 16C12.6 16 13 15.6 13 15ZM17 15V9C17 8.4 16.6 8 16 8C15.4 8 15 8.4 15 9V15C15 15.6 15.4 16 16 16C16.6 16 17 15.6 17 15ZM9 15V9C9 8.4 8.6 8 8 8H7C6.4 8 6 8.4 6 9V15C6 15.6 6.4 16 7 16H8C8.6 16 9 15.6 9 15ZM22 15V9C22 8.4 21.6 8 21 8H20C19.4 8 19 8.4 19 9V15C19 15.6 19.4 16 20 16H21C21.6 16 22 15.6 22 15Z" fill="black"></path>
                                                                </svg>
                                                            </span>
                                                        </a>
                                                        <a type="button" class="btn btn-white btn-sm" style="margin-top:4px" id="btn-select">
                                                            <span class="svg-icon svg-icon-success svg-icon-md">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <rect x="0" y="0" width="24" height="24"/>
                                                                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>
                                                                           
                                                                        </g>
                                                                    </svg>
                                                                </span>
                                                        </a>
                                                        <a style="display: none;" type="button" class="btn btn-primary btn-xs" style="margin-top:4px" id="addProduct"><i class="fa fa-plus"></i> Add </a>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align: center; vertical-align: middle;" width="175px">Barcode</th>
                                                    <th style="text-align: center; vertical-align: middle;" width="175px">Product Code</th>
                                                    <th style="text-align: center; vertical-align: middle;" >Product Name</th>
                                                    <th style="text-align: center; vertical-align: middle;" width="150px">Unit</th>
                                                    <th style="text-align: center; vertical-align: middle;" width="150px">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody id="grid-body">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="<?= base_url('packing'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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


<script>
    var idPO        = '<?= $outboundpo->po_outbound_id ?>';
    var detail_po   = <?=json_encode($detail_po)?>;
    var owner_id    = '<?= $outboundpo->owners_id ?>';
    var id_wh       = '<?= $outboundpo->warehouse_id ?>';
    var packing_fee = <?=@$packing_fee?>;
    var admin_fee   = <?=@$admin_fee?>;
    var custom_service_fee = <?=@$custom_service_fee?>;

</script>

