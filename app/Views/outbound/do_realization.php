<?php use App\Models\OutboundModel; ?>
<?php $this->outbound = new OutboundModel(); ?>
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
                        <a href="" class="text-muted">Shipping</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Update Shipping</a>
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
                            <h3 class="card-title">Update Shipping</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('outbounddo/update'); ?>">
                            <div class="card-body">
                                <div class="input_fields_outbound">
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label>Shipping ID
                                            <span class="text-danger">*</span></label>
                                            <input type="text" readonly name="do_id" class="form-control <?= ($validation->getError('do_trans_resi')) ? 'is-invalid' : ''; ?>" value="<?= $outbound_do->do_id ?>" />
                                            <?php if($validation->getError('do_trans_resi')){ echo '<div class="invalid-feedback">'.$validation->getError('do_trans_resi').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                            <label>Shipping Date
                                            <span class="text-danger">*</span></label>
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" value="<?php echo date_format(date_create(@$outbound_do->do_date), 'd-m-Y H:i:s'); ?>" readonly="readonly" name="do_date" placeholder="Select date" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php if($validation->getError('do_date')){ echo '<div class="invalid-feedback">'.$validation->getError('do_date').'</div>'; } ?>
                                        </div>
                                    </div>

                                    <table name="tbl_material" class="table table-condensed table-hover table-primary"  style="margin-top: 10px">
                                        <thead>
                                            <tr>
                                                <th>Invoice Number</th>
                                                <th>Transporter</th>
                                                <th>Customer</th>
                                                <th>AWB Number</th>
                                                <th>Shipping Cost</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabLO">
                                        <?php
                                            if(@$outbound_do_detail) :
                                                $i = 0;
                                                foreach ($outbound_do_detail as $row) :
                                                    
                                                    ?>
                                                    <tr class="text-nowrap table-active">
                                                        <td>
                                                            <input type="hidden" style="width: 55px;" name="do_detail_id[]" value="<?= $row->do_detail_id ?>"/>
                                                            <input type="hidden" style="width: 55px;" name="outbound_id[]" value="<?= $row->outbound_id ?>"/>
                                                            <?= $row->outbound_id ?></td>
                                                        <td>    
                                                            <?php if($row->transporter_alias != null){
                                                                   echo $row->transporter_alias; 
                                                                } else {
                                                                    echo 'MARKETPLACE';
                                                                } ?>
                                                        </td>
                                                        <td>    
                                                            <?php 
                                                                echo $row->customer_name; 
                                                            ?>
                                                        </td>
                                                        <td><input type="text" required class="form-control" name="do_out_resi[<?php echo $i ?>]" value="<?php if($row->transporter_alias != null){ echo @$row->do_out_resi; } else { echo @$row->po_resi_number;} ?>"/></td>
                                                        <td>
                                                            <div class="input-group">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        Rp.
                                                                    </span>
                                                                </div>
                                                                <input type="text" required class="form-control" name="do_ongkir[<?php echo $i ?>]" value="<?php if($row->transporter_alias != null){ echo @$row->do_ongkir; } else { echo 0; }?>" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" />
                                                            </div>
                                                        </td>
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
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Update</button>
                                <a href="<?= base_url('outbounddo'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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
