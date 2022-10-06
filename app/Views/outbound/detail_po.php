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
                        <a href="" class="text-muted">Transaction Detail</a>
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
                            <h3 class="card-title">Transaction Detail</h3>
                        </div>
                        <!--begin::Form-->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <label><strong>Detail Data: </strong></label>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="20%"><strong>ID</strong></td>
                                            <td width="5%"><strong>:</strong></td>
                                            <td width="75%"><?= @$data_outbound->po_outbound_id ?></td>
                                        </tr>
                                        <tr>
                                            <td width="20%"><strong>Out Date</strong></td>
                                            <td width="5%"><strong>:</strong></td>
                                            <td width="75%"><?= date('d M Y', strtotime(@$data_outbound->po_out_date)) ?></td>
                                        </tr>
                                        <tr>
                                            <td width="20%"><strong>Courier</strong></td>
                                            <td width="5%"><strong>:</strong></td>
                                            <td width="75%">
                                            <?php 
                                                if(empty(@$data_outbound->transporter_id)) {
                                                    echo @$data_outbound->transporter_marketplace;
                                                } else {
                                                    echo @$data_outbound->transporter_alias;
                                                }
                                            ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="20%"><strong>Nomor AWB</strong></td>
                                            <td width="5%"><strong>:</strong></td>
                                            <td width="75%">
                                                    <?= @$data_awb->do_out_resi ?> 
                                                    <?php $resi = @$data_awb->do_out_resi; 
                                                        if($resi != null && $data_outbound->transporter_id != null){ 
                                                            echo ', Tracking Link: <a href="'. @$data_outbound->transporter_link .'" target="_blank">Click here</a>'; 
                                                        } 
                                                    ?>
                                                    <?php 
                                                        if(@$data_outbound->po_resi_number && @$data_outbound->po_out_status < 4){
                                                            echo @$data_outbound->po_resi_number;
                                                        }
                                                    ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="20%"><strong>Description</strong></td>
                                            <td width="5%"><strong>:</strong></td>
                                            <td width="75%"><?= @$data_outbound->po_description ?></td>
                                        </tr>
                                        <tr>
                                            <td width="20%"><strong>Customer Name</strong></td>
                                            <td width="5%"><strong>:</strong></td>
                                            <td width="75%"><?= @$data_outbound->customer_name ?></td>
                                        </tr>
                                        <tr>
                                            <td width="20%"><strong>Customer Phone</strong></td>
                                            <td width="5%"><strong>:</strong></td>
                                            <td width="75%"><?= @$data_outbound->customer_phone ?></td>
                                        </tr>
                                        <tr>
                                            <td width="20%"><strong>Customer Email</strong></td>
                                            <td width="5%"><strong>:</strong></td>
                                            <td width="75%"><?= @$data_outbound->customer_email ?></td>
                                        </tr>
                                        <tr>
                                            <td width="20%"><strong>Customer Address</strong></td>
                                            <td width="5%"><strong>:</strong></td>
                                            <td width="75%"><?= @$data_outbound->customer_address ?></td>
                                        </tr>
                                        <tr>
                                            <td width="20%"><strong>Outbound Status</strong></td>
                                            <td width="5%"><strong>:</strong></td>
                                            <td width="75%">
                                                <?php if(@$data_outbound->po_out_status == 1) {
                                                        echo '<span class="label label-light-success label-pill label-inline mr-2">New</span>';
                                                    } else if(@$data_outbound->po_out_status == 2)  { 
                                                        echo '<span class="label label-light-danger label-pill label-inline mr-2">Packing</span>';
                                                    } else if(@$data_outbound->po_out_status == 3)  { 
                                                        echo '<span class="label label-light-primary label-pill label-inline mr-2">Waiting for shipment</span>';
                                                    } else if(@$data_outbound->po_out_status == 4)  { 
                                                        echo '<span class="label label-light-info label-pill label-inline mr-2">Shipping</span>';
                                                    } else if(@$data_outbound->po_out_status == 5)  { 
                                                        echo '<span class="label label-light-info label-pill label-inline mr-2">Approved</span>';
                                                    } else if(@$data_outbound->po_out_status == 6)  { 
                                                        echo '<span class="label label-light-danger label-pill label-inline mr-2">AWB Rejected</span>';
                                                    } else if(@$data_outbound->po_out_status == 7)  { 
                                                        echo '<span class="label label-light-success label-pill label-inline mr-2">Done</span>';
                                                    }?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-6">
                                    <?php if(@$data_history) { ?>
                                    <label><strong>Fulfillment History: </strong></label>
                                    <!--begin::Timeline-->
                                    <div class="timeline timeline-6 mt-3">
                                    <?php if(@$data_history->po_create_date) { ?>
                                        <!--begin::Item-->
                                        <div class="timeline-item align-items-start">
                                            <!--begin::Label-->
                                            <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg"></div>
                                            <!--end::Label-->
                                            <!--begin::Badge-->
                                            <div class="timeline-badge">
                                                <i class="fa fa-genderless text-secondary icon-xl"></i>
                                            </div>
                                            <!--end::Badge-->
                                            <!--begin::Text-->
                                            <div class="timeline-content d-flex">
                                                <span class="font-weight-bolder text-dark-75 pl-3 font-size-lg">[<?php echo date('H:i d M y', strtotime($data_history->po_create_date)); ?>] Order Created to be sent on [<?php echo date('d M y', strtotime($data_history->po_out_date)); ?>]</span>
                                            </div>
                                            <!--end::Text-->
                                        </div>
                                        <!--end::Item-->
                                        <?php } ?>
                                        <?php if(@$data_history->ob_create_date) { ?>
                                        <!--begin::Item-->
                                        <div class="timeline-item align-items-start">
                                            <!--begin::Label-->
                                            <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg"></div>
                                            <!--end::Label-->
                                            <!--begin::Badge-->
                                            <div class="timeline-badge">
                                                <i class="fa fa-genderless text-danger icon-xl"></i>
                                            </div>
                                            <!--end::Badge-->
                                            <!--begin::Text-->
                                            <div class="timeline-content d-flex">
                                                <span class="font-weight-bolder text-dark-75 pl-3 font-size-lg">[<?php echo date('H:i d M y', strtotime($data_history->ob_create_date)); ?>] Picking and packing done</span>
                                            </div>
                                            <!--end::Text-->
                                        </div>
                                        <!--end::Item-->
                                        <?php } ?>

                                        <?php if(@$data_history->obd_create_date) { ?>
                                        <!--begin::Item-->
                                        <div class="timeline-item align-items-start">
                                            <!--begin::Label-->
                                            <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg"></div>
                                            <!--end::Label-->
                                            <!--begin::Badge-->
                                            <div class="timeline-badge">
                                                <i class="fa fa-genderless text-warning icon-xl"></i>
                                            </div>
                                            <!--end::Badge-->
                                            <!--begin::Content-->
                                            <div class="timeline-content d-flex">
                                                <span class="font-weight-bolder text-dark-75 pl-3 font-size-lg">[<?php echo date('H:i d M y', strtotime($data_history->obd_create_date)); ?>] Waiting for shipment</span>
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Item-->
                                        <?php } ?>

                                        <?php if(@$data_history->obd_update_date) { ?>
                                        <!--begin::Item-->
                                        <div class="timeline-item align-items-start">
                                            <!--begin::Label-->
                                            <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg"></div>
                                            <!--end::Label-->
                                            <!--begin::Badge-->
                                            <div class="timeline-badge">
                                                <i class="fa fa-genderless text-success icon-xl"></i>
                                            </div>
                                            <!--end::Badge-->
                                            <!--begin::Desc-->
                                            <div class="timeline-content d-flex">
                                                <span class="font-weight-bolder text-dark-75 pl-3 font-size-lg">[<?php echo date('H:i d M y', strtotime($data_history->obd_update_date)); ?>] Sent</span>
                                            </div>
                                            <!--end::Desc-->
                                        </div>
                                        <!--end::Item-->
                                        <?php } ?>
                                    </div>
                                    <!--end::Timeline-->
                                    <br>
                                    <?php } ?>
                                    <label><strong>Detail Product: </strong></label>
                                    <table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
                                        <thead>
                                            <th class="text-center">No.</th>
                                            <th>Product Name</th>
                                            <th>Qty Plan</th>
                                        </thead>
                                        <tbody>
                                            <?php if (@$outbound_detail) :
                                                $no = 0;
                                                foreach ($outbound_detail as $row) :
                                                $no++; 
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $no ?></td>
                                                <td><?= $row->material_name ?></td>
                                                <td><?= $row->outbound_qty.' '.$row->uom_name ?></td>
                                            </tr>
                                            <?php
                                                endforeach;
                                            endif;
                                            ?>
                                        <tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-footer text-center">
                            <div class="col-lg-12">
                                <a href="<?php if(session()->get('user_type') == 1){ echo base_url('outboundpo'); } else { echo base_url('outbound'); } ?>" type="reset" class="btn btn-success mr-2">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
    </div>
	<!--end::Entry-->
</div>
<!--end::Content-->