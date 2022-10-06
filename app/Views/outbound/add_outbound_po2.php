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
                        <a href="" class="text-muted">Add Courier</a>
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
                            <h3 class="card-title">Add Courier</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" id="form-outboundpo" action="<?php echo base_url('outboundpo/create_courier'); ?>">
                            <div class="card-body">
                                <?= session()->getFlashdata('message'); ?>
                                <div class="input_fields_outbound_po">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label>Transaction From <span class="text-danger">*</span></label>
                                            <select class="form-control select select2 <?= ($validation->getError('transaction_from')) ? 'is-invalid' : ''; ?>" value="<?= old('transaction_from'); ?>" id="transaction_from" name="transaction_from" onchange="transactionFrom()">
                                                <option value="" selected></option>
                                                <option value="Marketplace">Marketplace</option>
                                                <option value="Non Marketplace">Non Marketplace</option>
                                            </select>
                                            <span class="text-danger error-msg" id="transaction_from_error"></span>
                                            <?php if($validation->getError('transaction_from')){ echo '<div class="invalid-feedback">'.$validation->getError('transaction_from').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div id="f_marketplace">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label>Courier<span class="text-danger">*</span><span style="color: #98999b;"> (Jika pilihan kurir tidak ada, ketik kurir yang anda gunakan lalu tekan enter)</span></label>
                                                <select class="form-control select select2 <?= ($validation->getError('transporter_name')) ? 'is-invalid' : ''; ?>" value="<?= old('transporter_name'); ?>" id="transporter_name" name="transporter_name"  style="width: 100%">
                                                    <option value="" selected>-- Select courier or enter courier --</option>
                                                    <?php 
                                                    foreach ($transporter as $key => $value) {
                                                        echo '<option value="'.$value->transporter_alias.'">'.$value->transporter_alias.'</option>';
                                                    } 
                                                    ?>
                                                </select>
                                                <span class="text-danger error-msg" id="transporter_name_error"></span>
                                                <?php if($validation->getError('transporter_name')){ echo '<div class="invalid-feedback">'.$validation->getError('transporter_name').'</div>'; } ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label>Resi Number <span class="text-danger">*</span><span style="color: #98999b;"> (Mohon isi dengan "-" jika tidak ada nomor resi)</span></label>
                                                <input type="text" id="resi_number"  name="resi_number" class="form-control <?= ($validation->getError('resi_number')) ? 'is-invalid' : ''; ?>"/>
                                                <span class="text-danger error-msg" id="resi_number_error"></span>
                                                <?php if($validation->getError('resi_number')){ echo '<div class="invalid-feedback">'.$validation->getError('resi_number').'</div>'; } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="f_nonmarketplace">
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label>Choose courier <span class="text-danger">*</span></label>
                                                <div class="radio-inline">
                                                    <?php $i = 0; foreach(@$transporter as $row) { ?>
                                                        <label class="radio">
                                                            <input type="radio" name="transporter_id" id="transporter_id" value="<?= @$row->transporter_id; ?>" onclick="getCourierService()">
                                                            <span></span>
                                                            <img src="<?= base_url(''); ?>/images/trans-photo/<?= $row->transporter_photo ?>" style="width: 70px; height: 55px;" class="h-55 align-self-center" alt="">
                                                            <!-- <span class="symbol-label"></span> -->
                                                        </label>
                                                    <?php $i++; } ?>
                                                </div>
                                                <span class="text-danger error-msg" id="transporter_id_error"></span>
                                                <?php if($validation->getError('transporter_id')){ echo '<div class="invalid-feedback">'.$validation->getError('transporter_id').'</div>'; } ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label>Choose service<span class="text-danger"></span></label>
                                                <select class="select form-control showproduct <?= ($validation->getError('service_id')) ? 'is-invalid' : ''; ?>" 
                                                    value="<?= old('service_id'); ?>" id="service_id" name="service_id" onchange="getOneService();">
                                                    <option value="" selected>Select an option</option>
                                                </select>
                                                <?php if($validation->getError('service_id')){ echo '<div class="invalid-feedback">'.$validation->getError('service_id').'</div>'; } ?>
                                            </div>
                                            <div class="col-2">
                                                <label>&nbsp;</label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="insurance_check" id="ins_check" onchange="insuranceChanged()">
                                                    <span></span>&nbsp;Insurance
                                                </label>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row">
                                            <div class="col-4">
                                                
                                            </div>
                                        </div> -->
                                        <div id="input_date"></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label>Seller <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-solid" value="<?= @$outbound->owners_name ?>" readonly/>
                                            <input type="hidden" class="form-control" id="po_outbound_id" name="po_outbound_id" value="<?= @$outbound->po_outbound_id ?>"/>
                                            <input type="hidden" class="form-control" id="customer_id" value="<?= @$outbound->po_penerima ?>"/>
                                            <input type="hidden" class="form-control" id="warehouse_id_outboundpo" value="<?= @$outbound->warehouse_id ?>"/>
                                        </div>
                                        <div class="col-4">
                                            <label>Doc. Date <span class="text-danger">*</span></label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control form-control-solid" value="<?= date_format(date_create(@$outbound->po_outbound_doc_date), 'd-m-Y') ?>" readonly="readonly" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="la la-calendar-check-o"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label>Seller Balance <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        Rp.
                                                    </span>
                                                </div>
                                                <input type="text" readonly autocomplete="off" class="form-control form-control-solid" value="<?= number_format(@$outbound->owners_balance) ?>" />
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label>Customer <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-solid" value="<?= @$outbound->customer_name ?>" readonly/>
                                        </div>
                                        <div class="col-4">
                                            <label>Warehouse <span class="text-danger">*</span></label>
                                            <input type="text" name="topup_name" class="form-control form-control-solid" value="<?= @$outbound->wh_name ?>" readonly/>
                                        </div>
                                        <div class="col-4">
                                            <label>Outbound Date <span class="text-danger">*</span></label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control form-control-solid" value="<?= date_format(date_create(@$outbound->po_out_date), 'd-m-Y') ?>" readonly="readonly" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="la la-calendar-check-o"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label>Remark</label>
                                            <textarea class="form-control form-control-solid" readonly><?= @$outbound->po_description ?></textarea>                                            
                                        </div>
                                    </div>
                                    <table name="tbl_material" class="table table-condensed table-hover"  style="margin-top: 10px">
                                        <thead>
                                            <tr>
                                                <th>Product ID</th>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>Weight</th>
                                                <th>Height</th>
                                                <th>Length</th>
                                                <th>Width</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $outbound_qty_tot = 0;
                                                $weight_tot = 0;
                                                $height_tot = 0;
                                                $length_tot = 0;
                                                $width_tot = 0;
                                                $price_tot = 0;
                                                foreach ($outbound_detail as $key => $value) {
                                                    $outbound_qty = $value->outbound_qty;
                                                    $weight = $value->material_weight * $value->outbound_qty;
                                                    $volume = ($value->material_length * $value->material_width * $value->material_height) * $value->outbound_qty;

                                                    $price = $value->material_price * $value->outbound_qty;                                                    

                                                    $outbound_qty_tot += $outbound_qty;
                                                    $weight_tot += $weight;
                                                    $height_tot += $value->material_height;
                                                    $length_tot += $value->material_length;
                                                    $width_tot += $value->material_width;
                                                    $price_tot += $price;
                                            ?>
                                                <tr>
                                                    <td><?= $value->material_id ?></td>
                                                    <td><?= $value->material_name ?></td>
                                                    <td><?= $value->outbound_qty ?></td>
                                                    <td><?= $weight ?></td>
                                                    <td><?= $value->material_height ?></td>
                                                    <td><?= $value->material_length ?></td>
                                                    <td><?= $value->material_width ?></td>
                                                    <td align="right"><?= number_format($price) ?></td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan="2"><b>Total</b></td>
                                                <td><b><?= $outbound_qty_tot ?></b></td>
                                                <td><b><?= $weight_tot ?></b></td>
                                                <td><b><?= $height_tot ?></b></td>
                                                <td><b><?= $length_tot ?></b></td>
                                                <td><b><?= $width_tot ?></b></td>
                                                <td align="right"><b><?= number_format($price_tot) ?></b></td>
                                            </tr>
                                            <tr id="ship_row"> 
                                                <td colspan="7"><b>Shipping fee</b></td>
                                                <td align="right"><b><span id="shipping_fee"></span></b></td>
                                            </tr>
                                            <tr id="ins_row"> 
                                                <td colspan="7"><b>Insurance fee</b></td>
                                                <td align="right"><b><span id="insurance_fee"></span></b></td>
                                            </tr>
                                            <tr id="total_row"> 
                                                <td colspan="7"><b>Total Shipping fee</b></td>
                                                <td align="right"><b><span id="total_fee"></span></b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <input type="hidden" class="form-control" id="outbound_qty_tot" value="<?= @$outbound_qty_tot ?>"/>
                                    <input type="hidden" class="form-control" id="weight_tot" value="<?= @$weight_tot ?>"/>
                                    <input type="hidden" class="form-control" id="height_tot" value="<?= @$height_tot ?>"/>
                                    <input type="hidden" class="form-control" id="length_tot" value="<?= @$length_tot ?>"/>
                                    <input type="hidden" class="form-control" id="width_tot" value="<?= @$width_tot ?>"/>
                                    <input type="hidden" class="form-control" name="price_tot" id="price_tot" value="<?= @$price_tot ?>"/>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary mr-2" id="btn-save">Submit</button>
                                <a href="<?= base_url('outboundpo'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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