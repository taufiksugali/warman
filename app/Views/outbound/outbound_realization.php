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
                        <a href="" class="text-muted">Outbound Process</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Add Outbound Process</a>
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
                            <h3 class="card-title">Add Outbound Process</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('out_realization/create'); ?>">
                            <div class="card-body">
                                <div class="input_fields_wrap">
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label class="font-weight-bold">Material Packaging ID
                                            <span class="text-danger">*</span></label>
                                            <input type="hidden" value="<?= $outbound_data->outbound_id ?>" name="outbound_id" id="inbound_id" placeholder="Enter code" />
                                            <input type="text" value="<?= $outbound_data->outbound_id ?>" name="outbound" disabled class="form-control <?= ($validation->getError('inbound_id')) ? 'is-invalid' : ''; ?>"  placeholder="Enter code" />
                                            <?php if($validation->getError('inbound_id')){ echo '<div class="invalid-feedback">'.$validation->getError('inbound_id').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                        <label class="font-weight-bold">Packaging System Date
                                            <span class="text-danger">*</span></label>
                                            <input type="text" value="<?= $outbound_data->create_date ?>" name="inbound_date" disabled class="form-control <?= ($validation->getError('inbound_date')) ? 'is-invalid' : ''; ?>" id="inbound_date" placeholder="Enter code" />
                                            <?php if($validation->getError('inbound_date')){ echo '<div class="invalid-feedback">'.$validation->getError('inbound_date').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label class="font-weight-bold">Document Number
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="doc_number" value="<?= @$outbound_data->outbound_doc; ?>" class="form-control <?= ($validation->getError('doc_number')) ? 'is-invalid' : ''; ?>" placeholder="Enter code" />
                                            <?php if($validation->getError('doc_number')){ echo '<div class="invalid-feedback">'.$validation->getError('doc_number').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                        <label class="font-weight-bold">Document Date
                                            <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="kt_datepicker_2" readonly="readonly" value="<?= date('m/d/Y', strtotime(@$outbound_data->outbound_doc_date)); ?>" name="doc_date" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php if($validation->getError('doc_date')){ echo '<div class="invalid-feedback">'.$validation->getError('doc_date').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label class="font-weight-bold">Customer Name
                                            <span class="text-danger">*</span></label>
                                            <input type="text" value="<?= $outbound_data->customer_name ?>" name="supplier_id" disabled class="form-control <?= ($validation->getError('supplier_id')) ? 'is-invalid' : ''; ?>" id="supplier_id" placeholder="Enter code" />
                                            <?php if($validation->getError('supplier_id')){ echo '<div class="invalid-feedback">'.$validation->getError('supplier_id').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                            <label class="font-weight-bold">Warehouse Origin
                                            <span class="text-danger">*</span></label>
                                            <input type="text" value="<?= $outbound_data->wh_name ?>" name="warehouse_id" disabled class="form-control <?= ($validation->getError('warehouse_id')) ? 'is-invalid' : ''; ?>" id="warehouse_id" placeholder="Enter code" />
                                            <?php if($validation->getError('warehouse_id')){ echo '<div class="invalid-feedback">'.$validation->getError('warehouse_id').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label>Packaging Date
                                            <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="kt_datepicker_2" readonly="readonly" value="<?= date('m/d/Y', strtotime(@$outbound_data->out_date)); ?>" name="doc_date" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <?php if($validation->getError('rec_date')){ echo '<div class="invalid-feedback">'.$validation->getError('rec_date').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                            <label>Seller
                                            <span class="text-danger">*</span></label>
                                            <input type="text" hidden id="owner_id_outbound" name="owner_id" class="form-control <?= ($validation->getError('owner_id')) ? 'is-invalid' : ''; ?>" placeholder="Enter Warehouse" />
                                            <input type="text" readonly id="owners_name" name="owners_name" class="form-control <?= ($validation->getError('owner_id')) ? 'is-invalid' : ''; ?>" placeholder="Enter Seller" />
                                            <?php if($validation->getError('owner_id')){ echo '<div class="invalid-feedback">'.$validation->getError('owner_id').'</div>'; } ?>
                                        </div>
                                        <div class="col-6" hidden>
                                            <label class="font-weight-bold">Outbound Type
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="type_id" value="<?= $outbound_data->trans_type_name ?>" disabled class="form-control <?= ($validation->getError('type_id')) ? 'is-invalid' : ''; ?>" placeholder="Enter code" />
                                            <?php if($validation->getError('type_id')){ echo '<div class="invalid-feedback">'.$validation->getError('type_id').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Description
                                        <span class="text-danger">*</span></label>
                                        <textarea name="description" disabled class="form-control <?= ($validation->getError('description')) ? 'is-invalid' : ''; ?>" placeholder="Enter description" ><?= $outbound_data->description ?></textarea>
                                        <?php if($validation->getError('description')){ echo '<div class="invalid-feedback">'.$validation->getError('description').'</div>'; } ?>
                                    </div>
                                    <div class="separator separator-dashed"></div>
                                    <label>Material Data</label>
                                    <div style="overflow-x:auto">
                                        <table class="table nowrap table-bordered table-checkable table-nopaging">
                                            <thead style="text-align: center; vertical-align: middle;"> 
                                                <tr>
                                                    <th style="text-align: center; vertical-align: middle;">Product</th>
                                                    <th style="text-align: center; vertical-align: middle;">Batch No.</th>
                                                    <th style="text-align: center; vertical-align: middle;">Exp. Date</th>
                                                    <th style="text-align: center; vertical-align: middle;">Plan</th>
                                                    <th style="text-align: center; vertical-align: middle;" width="55px">Realization</th>
                                                    <th style="text-align: center; vertical-align: middle;" width="55px">Check</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if(@$outbound_detail) :
                                                $i = 0;
                                                foreach ($outbound_detail as $row) :
                                                    if($row->outbound_qty > 1){
                                                        $uom = $row->uom_name.'(s)';
                                                    }else{
                                                        $uom = $row->uom_name;
                                                    }
                                                    ?>
                                                    <tr class="text-nowrap">
                                                        <td><input type="hidden" style="width: 55px;" name="material_detail[]" value="<?= $row->mat_detail_id ?>"/><?= $row->material_name ?></td>
                                                        <td><?= $row->batch_no ?></td>
                                                        <td><?= $row->expired_date ?></td>
                                                        <td><input type="hidden" style="width: 55px;" name="det_outbound[<?php echo $i ?>]" value="<?= $row->det_outbound_id ?>"/><?= number_format($row->outbound_qty).' '.$uom ?></td>
                                                        <td><input type="hidden" style="width: 55px;" name="location[<?php echo $i ?>]" value="<?= $row->location_id ?>"/><input type="text" value="<?= $row->outbound_qty ?>" style="width: 55px;" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" name="good_out[<?php echo $i ?>]"/></td>
                                                        <td><input type="checkbox" class="listCheckbox purchaseCheck" name="check[<?php echo $i ?>]" value="1"/></td>
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
                                <a href="<?= base_url('out_realization'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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
