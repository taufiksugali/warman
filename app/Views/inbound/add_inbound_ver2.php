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
                        <a href="" class="text-muted">Inbound PRocess</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Add Inbound Process v2</a>
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
                            <h3 class="card-title">Add Inbound Versi 2</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('inbound/create_ver2'); ?>">
                            <div class="card-body">
                                <div class="input_fields_wrap">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label>PO Number
                                            <span class="text-danger">*</span></label>
                                            <select class="form-control select select2 <?= ($validation->getError('po_id')) ? 'is-invalid' : ''; ?>" value="<?= old('po_id'); ?>" id="po_id_2" name="po_id">
                                                <option value="" selected></option>
                                                <?php foreach(@$po_number as $row) { ?>
                                                <option value="<?= @$row->po_id; ?>" data-val="<?= @$row->wh_name; ?>"><?php echo $row->po_id.'-'.$row->po_number.'. Seller: '. $row->owners_name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if($validation->getError('po_id')){ echo '<div class="invalid-feedback">'.$validation->getError('po_id').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label>Warehouse
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="supplier_id" disabled class="form-control <?= ($validation->getError('supplier_id')) ? 'is-invalid' : ''; ?>" id="supplier" placeholder="Warehouse" />
                                            <?php if($validation->getError('supplier_id')){ echo '<div class="invalid-feedback">'.$validation->getError('supplier_id').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                            <label>Recieve By
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="rec_by" required class="form-control <?= ($validation->getError('rec_by')) ? 'is-invalid' : ''; ?>" placeholder="Enter name" />
                                            <?php if($validation->getError('rec_by')){ echo '<div class="invalid-feedback">'.$validation->getError('rec_by').'</div>'; } ?>
                                        </div>
                                    </div><div class="form-group">
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
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="3" width="55px">No</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="3">ID</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="3">PO Number</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="3">PO Date</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="3">Product ID</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="3">Product Name</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="3">Due Date</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="3">Batch No.</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="3">Exp. Date</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="3">Plan</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="3" width="55px">Realization</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="3" width="55px">Leftovers</th>
                                                    <th style="text-align: center; vertical-align: middle;" colspan="3" width="55px">Item Diterima</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="3" width="55px">Check</th>
                                                </tr>
                                                <tr>
                                                    <th colspan="3">Kondisi</th>
                                                </tr>
                                                <tr>
                                                    <th width="55px">Good</th>
                                                    <th width="55px">Not Good</th>
                                                    <th width="55px">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="do_list_2">
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('inbound'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end::Container-->
            <script>
                function hitung_total(idx) {
				if ($("#good_qty_" + idx).val() == "") {
					good_qty = 0;
				} else {
                    gt = $("#good_qty_" + idx).val();
					good_qty = parseInt(gt.replace(",", ""));
				}

				if ($("#notgood_qty_" + idx).val() == "") {
					notgood_qty = 0;
				} else {
                    ngt = $("#notgood_qty_" + idx).val();
					notgood_qty = parseInt(ngt.replace(",", ""));
				}
				var total;
				total = parseInt(good_qty) + parseInt(notgood_qty);
				$("#total_" + idx).val(total);
                po_qty = $("#po_qty_" + idx).val();
                sisa = parseInt(total) - parseInt(po_qty);
				if (sisa > 0) {
					$("#sisa_" + idx).val(sisa);
					$("#realisasi_" + idx).val(total);
				} else if (sisa < 0) {
					$("#sisa_" + idx).val(0);
					$("#realisasi_" + idx).val(total);
				} else {
					$("#sisa_" + idx).val('0');
					$("#realisasi_" + idx).val(total);
				}

			}
            </script>
        </div>
    </div>
	<!--end::Entry-->
</div>
<!--end::Content-->

