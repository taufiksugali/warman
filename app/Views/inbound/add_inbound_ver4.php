<?php
    $dataProdReq = array();
    foreach ($po_detail as $key => $value) {
        if (isset($dataProdReq[$value->material_id])) {
            $dataProdReq[$value->material_id]['qty'] += $value->qty;
        } else {
            $dataInsert = array(
                            "id"=>$value->material_id,
                            "code"=>$value->material_code,
                            "name"=>$value->material_name,
                            "qty"=>$value->qty,
            );
            $dataProdReq[$value->material_id] = $dataInsert;
        }
    }
?>
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
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Inbound</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Inbound Process</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Add Inbound Process</a>
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
                            <h3 class="card-title">Add Inbound</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" id="form-inbound" class="form" action="<?php echo base_url('inbound/create_ver2'); ?>">
                            <div class="card-body">
                                <div class="input_fields_wrap">
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label>PO Number
                                            <span class="text-danger">*</span></label>
                                            <input type="hidden" name="po_id" id="po_id" value="<?= $po_number->po_id ?>"/>
                                            <input type="text" name="po_number" readonly class="form-control form-control-solid" id="po_number" value="<?= $po_number->po_number ?>" placeholder="PO Number" />
                                        </div>
                                        <div class="col-6">
                                            <label>PO Date
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="po_date" readonly class="form-control form-control-solid" id="po_date" value="<?= $po_number->po_date ?>" placeholder="PO Date" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label>Warehouse
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="warehouse_name" readonly value="<?= $po_number->wh_name ?>" 
                                                class="form-control form-control-solid" id="warehouse" placeholder="Warehouse" />
                                 
                                        </div>
                                        <div class="col-6">
                                            <label>Recieve By
                                            <span class="text-danger">*</span></label>
                                            <input type="text" id='rec_by' name="rec_by" required class="form-control <?= ($validation->getError('rec_by')) ? 'is-invalid' : ''; ?>" placeholder="Enter name" />
                                            <?php if($validation->getError('rec_by')){ echo '<div class="invalid-feedback">'.$validation->getError('rec_by').'</div>'; } ?>
                                            <span class="text-danger error-msg"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label>License Plate / Container Number
                                            <span class="text-danger">*</span></label>
                                            <input type="text" id='lic_plate' name="lic_plate" required class="form-control <?= ($validation->getError('lic_plate')) ? 'is-invalid' : ''; ?>" placeholder="Enter number" />
                                            <?php if($validation->getError('lic_plate')){ echo '<div class="invalid-feedback">'.$validation->getError('lic_plate').'</div>'; } ?>
                                            <span class="text-danger error-msg"></span>
                                        </div>
                                        <div class="col-6">
                                            <label>Driver
                                            <span class="text-danger">*</span></label>
                                            <input type="text" id='inbound_driver' name="inbound_driver" required class="form-control <?= ($validation->getError('inbound_driver')) ? 'is-invalid' : ''; ?>" placeholder="Enter name" />
                                            <?php if($validation->getError('inbound_driver')){ echo '<div class="invalid-feedback">'.$validation->getError('inbound_driver').'</div>'; } ?>
                                            <span class="text-danger error-msg"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label>Shipment Number
                                            <span class="text-danger">*</span></label>
                                            <input type="text" id='shipment_number' name="shipment_number" required class="form-control <?= ($validation->getError('shipment_number')) ? 'is-invalid' : ''; ?>" placeholder="Enter number" />
                                            <?php if($validation->getError('shipment_number')){ echo '<div class="invalid-feedback">'.$validation->getError('shipment_number').'</div>'; } ?>
                                            <span class="text-danger error-msg"></span>
                                        </div>
                                        <div class="col-6">
                                            <label>Transpoter
                                            <span class="text-danger">*</span></label>
                                            <input type="text" id='inbound_transpoter' name="inbound_transpoter" required class="form-control <?= ($validation->getError('inbound_transpoter')) ? 'is-invalid' : ''; ?>" placeholder="Enter number" />
                                            <?php if($validation->getError('inbound_transpoter')){ echo '<div class="invalid-feedback">'.$validation->getError('inbound_transpoter').'</div>'; } ?>
                                            <span class="text-danger error-msg"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Remark</label>
                                        <textarea name="description" class="form-control <?= ($validation->getError('description')) ? 'is-invalid' : ''; ?>" placeholder="Enter remark" ></textarea>
                                        <?php if($validation->getError('description')){ echo '<div class="invalid-feedback">'.$validation->getError('description').'</div>'; } ?>
                                    </div>
                                    <div class="separator separator-dashed"></div>
                                    <label>Material Data</label>
                                    <div style="overflow-x:auto">
                                        <table class="table nowrap table-bordered table-checkable table-nopaging">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: right; vertical-align: middle;" id="text-search">Scan Barcode Product</th>
                                                    <th style="text-align: center; vertical-align: middle;" colspan="5">
                                                        <div style="display: none;" id="select-product">
                                                            <select class="form-control select select2" id="selectProduct" name="selectProduct" style="margin-top: 3px; width: 100%;" ></select>
                                                        </div>
                                                        <input type="text" class="form-control" style="margin-top: 3px; width: 100%;" id="scan-barcode" placeholder="Scan Product Barcode" >

                                                    </th>
                                                    <th style="text-align: left; vertical-align: middle;" colspan="5">
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
                                                        &nbsp;&nbsp;
                                                        <input type="checkbox" id="new-line" name="new-line" class="i-checks"> New Line

                                                        <a style="display: none;" type="button" class="btn btn-primary btn-xs" style="margin-top:4px" id="addProduct"><i class="fa fa-plus"></i> Add </a>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="2">Product Code</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="2">Product Name</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="2">Weight (kg)</th>
                                                    <th style="text-align: center; vertical-align: middle;" colspan="3">Dimension (cm)</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="2">Batch No.</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="2">Exp. Date</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="2" width="55px">Qty</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="2" width="55px">Is Not Good</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="2" width="55px">#</th>
                                                </tr>
                                                <tr>
                                                    <th width="55px">L</th>
                                                    <th width="55px">W</th>
                                                    <th width="55px">H</th>
                                                </tr>
                                            </thead>
                                            <tbody id="grid-body">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary mr-2" id="btn-save">Submit</button>
                                <a href="<?= base_url('purchaseorder'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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
    var idPO = '<?= $po_number->po_id ?>';
    var dataProdReq = <?=json_encode($dataProdReq)?>;
</script>

