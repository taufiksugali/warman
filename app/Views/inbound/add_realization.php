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
                        <a href="" class="text-muted">Physical Checklist</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Add Physical Checklist</a>
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
                            <h3 class="card-title">Add Physical Checklist</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('realization/create'); ?>">
                            <div class="card-body">
                                <div class="input_fields_wrap">
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label class="font-weight-bold">Inbound ID
                                            <span class="text-danger">*</span></label>
                                            <input type="hidden" value="<?= $inbound_data->inbound_id ?>" name="inbound_id" id="inbound_id" placeholder="Enter code" />
                                            <input type="text" value="<?= $inbound_data->inbound_id ?>" name="inbound" disabled class="form-control <?= ($validation->getError('inbound_id')) ? 'is-invalid' : ''; ?>"  placeholder="Enter code" />
                                            <?php if($validation->getError('inbound_id')){ echo '<div class="invalid-feedback">'.$validation->getError('inbound_id').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                        <label class="font-weight-bold">Inbound Date
                                            <span class="text-danger">*</span></label>
                                            <input type="text" value="<?= $inbound_data->create_date ?>" name="inbound_date" disabled class="form-control <?= ($validation->getError('inbound_date')) ? 'is-invalid' : ''; ?>" id="inbound_date" placeholder="Enter code" />
                                            <?php if($validation->getError('inbound_date')){ echo '<div class="invalid-feedback">'.$validation->getError('inbound_date').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label class="font-weight-bold">Warehouse Destination
                                            <span class="text-danger">*</span></label>
                                            <input type="text" value="<?= $inbound_data->wh_name ?>" name="warehouse_id" disabled class="form-control <?= ($validation->getError('warehouse_id')) ? 'is-invalid' : ''; ?>" id="warehouse_id" placeholder="Enter code" />
                                            <?php if($validation->getError('warehouse_id')){ echo '<div class="invalid-feedback">'.$validation->getError('warehouse_id').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                        <label class="font-weight-bold">Seller
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="owner_id" value="<?= @$owner->owners_id; ?>" class="form-control <?= ($validation->getError('owner_id')) ? 'is-invalid' : ''; ?>" placeholder="Enter owner" hidden />
                                            <input type="text" name="owners_name" value="<?= @$owner->owners_name; ?>" class="form-control <?= ($validation->getError('owners_name')) ? 'is-invalid' : ''; ?>" placeholder="Enter owner" readonly />
                                            <?php if($validation->getError('owner_id')){ echo '<div class="invalid-feedback">'.$validation->getError('owner_id').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                        <label>Recieve Date
                                            <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control datetimepicker-input" date-format="Y-m-d H:i:s" readonly="readonly" value="<?= date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'))) ; ?>" name="rec_date" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php if($validation->getError('rec_date')){ echo '<div class="invalid-feedback">'.$validation->getError('rec_date').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                            <label>Recieve By
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="rec_by" class="form-control <?= ($validation->getError('rec_by')) ? 'is-invalid' : ''; ?>" placeholder="Enter receiver name" required/>
                                            <?php if($validation->getError('rec_by')){ echo '<div class="invalid-feedback">'.$validation->getError('rec_by').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Remark</label>
                                        <textarea name="description" disabled class="form-control <?= ($validation->getError('description')) ? 'is-invalid' : ''; ?>" placeholder="Enter description" required><?= $inbound_data->description ?></textarea>
                                        <?php if($validation->getError('description')){ echo '<div class="invalid-feedback">'.$validation->getError('description').'</div>'; } ?>
                                    </div>
                                    <div class="separator separator-dashed"></div>
                                    <label>Product Data</label>
                                    <div style="overflow-x:auto">
                                        <table class="table nowrap table-bordered table-checkable table-nopaging">
                                            <thead style="text-align: center; vertical-align: middle;"> 
                                                <tr>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="3">Product ID</th>
                                                    <th style="text-align: center; vertical-align: middle;" rowspan="3">Product Name</th>
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
                                            <tbody>
                                            <?php
                                            if(@$inbound_detail) :
                                                $i = 0;
                                                foreach ($inbound_detail as $row) :
                                                    if($row->qty > 1){
                                                        $po_uom = $row->uom_name.'(s)';
                                                    }else{
                                                        $po_uom = $row->uom_name;
                                                    }
                                                    ?>
                                                    <tr class="text-nowrap">
                                                        <td><?= $row->material_id ?></td>
                                                        <td><input type="hidden" style="width: 55px;" name="material[]" value="<?= $row->material_id ?>"/><?= $row->material_name ?></td>
                                                        <td><input type="text" style="width: 100px;" name="batch[<?php echo $i ?>]"/></td>
                                                        <td><input type="text" id="kt_datepicker_2" readonly="readonly" style="width: 100px;" name="exp[<?php echo $i ?>]"/></td>
                                                        <td class="text-right"><input type="hidden" id="po_qty_<?= $i ?>" style="width: 55px;" name="det_inbound[<?php echo $i ?>]" value="<?= $row->det_inbound_id ?>"/><?= number_format($row->qty).' '.$po_uom ?></td>
                                                        <td>
                                                            <input type="text" id="realisasi_<?= $i ?>" style="width: 55px;" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" name="qty_realization[]" readonly />
                                                            <input type="hidden" style="width: 55px;" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" name="material_price[<?php echo $i ?>]" value="<?= $row->material_price ?>" />
                                                        </td>
                                                        <td><input type="text" id="sisa_<?= $i ?>" style="width: 55px;" name="left[<?php echo $i ?>]" readonly="readonly"/></td>
                                                        <td><input type="text" id="good_qty_<?= $i ?>" value="<?= $row->qty ?>" style="width: 55px;" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this); hitung_total(<?= $i ?>);" name="good[<?php echo $i ?>]"/></td>
                                                        <td><input type="text" id="notgood_qty_<?= $i ?>" style="width: 55px;" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this); hitung_total(<?= $i ?>);" name="not_good[<?php echo $i ?>]"/></td>
                                                        <td><input type="text" id="total_<?= $i ?>" style="width: 55px;" name="total[<?php echo $i ?>]" readonly="readonly"/></td>
                                                        <td><input type="checkbox" class="listCheckbox purchaseCheck" name="check[<?php echo $i ?>]" <?php if($row->cek == 1){ echo "checked"; } ?> value="1"/></td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                            endforeach;
                                                        endif;
                                                    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('realization'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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
