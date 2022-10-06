<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Audit</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Product</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Product Approval</a>
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
                    <form action="<?php echo base_url('materialapproval/approval_cost'); ?>" method="post">
                        <div class="card card-custom gutter-b example example-compact">
                            <div class="card-header">
                                <h3 class="card-title">Product Approval</h3>
                            </div>
                            <!--begin::Form-->
                            <div class="card-body">
                                <label><strong>Detail Data: </strong></label>
                                <div class="row">
                                    <div class="col-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td width="20%"><strong>Product ID</strong></td>
                                                <td width="5%"><strong>:</strong></td>
                                                <td width="75%"><?= @$details->material_id ?></td>
                                            </tr>
                                            <tr>
                                                <td width="20%"><strong>Product Code</strong></td>
                                                <td width="5%"><strong>:</strong></td>
                                                <td width="75%"><?= @$details->material_code ?></td>
                                            </tr>
                                            <tr>
                                                <td width="20%"><strong>Product Name</strong></td>
                                                <td width="5%"><strong>:</strong></td>
                                                <td width="75%">
                                                        <?= @$details->material_name ?> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="20%"><strong>Description</strong></td>
                                                <td width="5%"><strong>:</strong></td>
                                                <td width="75%"><?= @$details->po_description ?></td>
                                            </tr>
                                            
                                        </table>
                                    </div>
                                    <div class="col-6">
                                    <table class="table table-borderless">
                                            <tr>
                                                <td width="20%"><strong>Product Group</strong></td>
                                                <td width="5%"><strong>:</strong></td>
                                                <td width="75%"><?= @$details->mat_group_name ?></td>
                                            </tr>
                                            <tr>
                                                <td width="20%"><strong>Product Unit</strong></td>
                                                <td width="5%"><strong>:</strong></td>
                                                <td width="75%"><?= @$details->uom_name ?></td>
                                            </tr>
                                            <tr>
                                                <td width="20%"><strong>Product Price</strong></td>
                                                <td width="5%"><strong>:</strong></td>
                                                <td width="75%">Rp. <?= number_format(@$details->material_price) ?></td>
                                            </tr>
                                            <tr>
                                                <td width="20%"><strong>Seller</strong></td>
                                                <td width="5%"><strong>:</strong></td>
                                                <td width="75%"><?= @$details->owners_name ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <label><strong>Special Agreement:</strong></label>
                                <table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
                                    <thead>
                                        <tr>
                                            <th data-orderable="false">No</th>
                                            <th>Filename</th>
                                            <th>Remark</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;?>
                                        <?php 
                                            if(!empty($agreement)){
                                            foreach(@$agreement as $row) { ?>
                                                <tr >
                                                    <td style="margin-top: 5px; margin-bottom: 5px" scope="row" width="3%"><?= $i; ?></td>
                                                    <td><a href="<?= base_url('../file/special-agreement/'.$row->owners_id.'/'.$row->agreement_file) ?>" target="_blank"><?= @$row->agreement_file; ?></a></td>
                                                    <td><?= @$row->agreement_remark; ?></td>
                                                    <td><?php if(@$row->agreement_status == 1){echo '<span class="badge badge-success">Active</span>';}else if(@$row->agreement_status == 0){echo '<span class="badge badge-danger">Inactive</span>';}?></td>
                                                </tr>
                                            <?php $i++ ?>
                                            <?php } 
                                            }?>
                                    </tbody>
                                </table>
                                <label><strong>price scheme:</strong></label>
                                <br>
                                <?php 
                                    $approval_status = null;
                                    $percentage_status = null;
                                    $percentage = null;
                                    $min_percent_rate = null;
                                    $max_percent_rate = null;
                                    $srg_percent_interval = null;

                                    $fix_status = null;
                                    $inbound_stt = null;
                                    $ibd_rate_type = null;
                                    $ibd_rate = null;
                                    $outbound_stt = null;
                                    $otb_rate_type = null;
                                    $otb_rate = null;
                                    $storage_stt = null;
                                    $srg_rate_type = null;
                                    $srg_rate = null;

                                    if(@$approval){
                                        $approval_status = 1;
                                        if($approval->percentage_status == 1){
                                            $percentage_status = 1;
                                            $percentage = $approval->percentage_value;
                                            $min_percent_rate = $approval->min_percentage;
                                            $max_percent_rate = $approval->max_percentage;
                                            $srg_percent_interval = $approval->bill_interval;
                                        }

                                        if($approval->fix_status == 1){
                                            $fix_status = 1;
                                            if($approval->inbound_status == 1){
                                                $inbound_stt = 1;
                                                $ibd_rate_type = $approval->inbound_type;
                                                $ibd_rate = $approval->inbound_cost;
                                            }

                                            if($approval->outbound_status == 1){
                                                $outbound_stt = 1;
                                                $otb_rate_type = $approval->outbound_type;
                                                $otb_rate = $approval->outbound_cost;
                                            }
                                            
                                            if($approval->storage_status == 1) {
                                                $storage_stt = 1;
                                                $srg_rate_type = $approval->storage_type;
                                                $srg_rate = $approval->storage_cost;
                                            }
                                        }
                                    } else {
                                        $percentage_status = 2; // default sistem
                                        $percentage = 3.5;
                                        $min_percent_rate = 2500;
                                        $max_percent_rate = 15000;
                                        $srg_percent_interval = 30;
                                    }
                                ?>
                                <div id="price-scheme">
                                    <div id="percentage-scheme">
                                        <div class="option">
                                            <div class="option-control">
                                                <label class="radio">
                                                    <input type="radio" onclick="pricing_type();" name="pricing" id="percentage" value="percentage" <?php if(@$percentage_status == 1 || @$percentage_status == 2){ echo "checked"; } ?> />
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="option-label">
                                                <span class="option-head">
                                                    <span class="option-title">Percentage
                                                    <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M21.6 11.2L19.3 8.89998V5.59993C19.3 4.99993 18.9 4.59993 18.3 4.59993H14.9L12.6 2.3C12.2 1.9 11.6 1.9 11.2 2.3L8.9 4.59993H5.6C5 4.59993 4.6 4.99993 4.6 5.59993V8.89998L2.3 11.2C1.9 11.6 1.9 12.1999 2.3 12.5999L4.6 14.9V18.2C4.6 18.8 5 19.2 5.6 19.2H8.9L11.2 21.5C11.6 21.9 12.2 21.9 12.6 21.5L14.9 19.2H18.2C18.8 19.2 19.2 18.8 19.2 18.2V14.9L21.5 12.5999C22 12.1999 22 11.6 21.6 11.2Z" fill="black"/>
                                                        <path d="M11.3 9.40002C11.3 10.2 11.1 10.9 10.7 11.3C10.3 11.7 9.8 11.9 9.2 11.9C8.8 11.9 8.40001 11.8 8.10001 11.6C7.80001 11.4 7.50001 11.2 7.40001 10.8C7.20001 10.4 7.10001 10 7.10001 9.40002C7.10001 8.80002 7.20001 8.4 7.30001 8C7.40001 7.6 7.7 7.29998 8 7.09998C8.3 6.89998 8.7 6.80005 9.2 6.80005C9.5 6.80005 9.80001 6.9 10.1 7C10.4 7.1 10.6 7.3 10.8 7.5C11 7.7 11.1 8.00005 11.2 8.30005C11.3 8.60005 11.3 9.00002 11.3 9.40002ZM10.1 9.40002C10.1 8.80002 10 8.39998 9.90001 8.09998C9.80001 7.79998 9.6 7.70007 9.2 7.70007C9 7.70007 8.8 7.80002 8.7 7.90002C8.6 8.00002 8.50001 8.2 8.40001 8.5C8.40001 8.7 8.30001 9.10002 8.30001 9.40002C8.30001 9.80002 8.30001 10.1 8.40001 10.4C8.40001 10.6 8.5 10.8 8.7 11C8.8 11.1 9 11.2001 9.2 11.2001C9.5 11.2001 9.70001 11.1 9.90001 10.8C10 10.4 10.1 10 10.1 9.40002ZM14.9 7.80005L9.40001 16.7001C9.30001 16.9001 9.10001 17.1 8.90001 17.1C8.80001 17.1 8.70001 17.1 8.60001 17C8.50001 16.9 8.40001 16.8001 8.40001 16.7001C8.40001 16.6001 8.4 16.5 8.5 16.4L14 7.5C14.1 7.3 14.2 7.19998 14.3 7.09998C14.4 6.99998 14.5 7 14.6 7C14.7 7 14.8 6.99998 14.9 7.09998C15 7.19998 15 7.30002 15 7.40002C15.2 7.30002 15.1 7.50005 14.9 7.80005ZM16.6 14.2001C16.6 15.0001 16.4 15.7 16 16.1C15.6 16.5 15.1 16.7001 14.5 16.7001C14.1 16.7001 13.7 16.6 13.4 16.4C13.1 16.2 12.8 16 12.7 15.6C12.5 15.2 12.4 14.8001 12.4 14.2001C12.4 13.3001 12.6 12.7 12.9 12.3C13.2 11.9 13.7 11.7001 14.5 11.7001C14.8 11.7001 15.1 11.8 15.4 11.9C15.7 12 15.9 12.2 16.1 12.4C16.3 12.6 16.4 12.9001 16.5 13.2001C16.6 13.4001 16.6 13.8001 16.6 14.2001ZM15.4 14.1C15.4 13.5 15.3 13.1 15.2 12.9C15.1 12.6 14.9 12.5 14.5 12.5C14.3 12.5 14.1 12.6001 14 12.7001C13.9 12.8001 13.8 13.0001 13.7 13.2001C13.6 13.4001 13.6 13.8 13.6 14.1C13.6 14.7 13.7 15.1 13.8 15.4C13.9 15.7 14.1 15.8 14.5 15.8C14.8 15.8 15 15.7 15.2 15.4C15.3 15.2 15.4 14.7 15.4 14.1Z" fill="black"/>
                                                        </svg></span>
                                                    </span>
                                                </span>
                                                <br>
                                                <div class="form-percentage" id="form-percentage" >
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <div class="input-group">
                                                                <input type="text" value="<?php echo $percentage; ?>" <?php if($percentage_status == 0 || $percentage_status == null){ echo "disabled"; }  ?> class="form-control nozero numbers" id="percentage_value" name="percentage_value" placeholder="e.g., 5" />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        %
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <label style="padding-top: 10px;">/Transaksi</label>
                                                        </div>
                                                        <div>
                                                            <input type="text" class="form-control" id="material_id"  name="material_id" value="<?php echo @$details->material_id ?>" placeholder="e.g., 5" hidden/>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        Min Cost
                                                                    </span>
                                                                </div>
                                                                <input type="text" class="form-control" value="<?php echo $min_percent_rate; ?>" <?php if($percentage_status == 0 || $percentage_status == null){ echo "disabled"; }  ?> onkeyup="" data-type="currency" id="min_cost" name="min_cost" placeholder="e.g., 500,000" />
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        Max Cost
                                                                    </span>
                                                                </div>
                                                                <input type="text" class="form-control" onkeyup="" value="<?php echo $max_percent_rate; ?>" <?php if(@$percentage_status == 0 || @$percentage_status == null){ echo "disabled"; }  ?> data-type="currency" id="max_cost" name="max_cost" placeholder="e.g., 500,000" />
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        Billing interval 
                                                                    </span>
                                                                </div>
                                                                <input type="text" class="form-control" onkeyup="" value="<?php echo $srg_percent_interval; ?>" <?php if(@$percentage_status == 0 || @$percentage_status == null){ echo "disabled"; }  ?> data-type="currency" id="bill_interval" name="bill_interval" placeholder="e.g., 30" />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        Day
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div id="fix-scheme">
                                        <div class="option">
                                            <div class="option-control">
                                                <label class="radio">
                                                    <input type="radio" onclick="pricing_type();" name="pricing" id="fix" value="fix" <?php if($fix_status == 1 ){ echo "checked"; }  ?>/>
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="option-label">
                                                <span class="option-head">
                                                    <span class="option-title">Fix
                                                        <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                            <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="gray"/>
                                                            <path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="black"/>
                                                        </svg></span>
                                                    </span>
                                                    <div>
                                                        <input type="text" class="form-control" id="material_id" name="material_id" value="<?php echo @$details->material_id ?>" placeholder="e.g., 5" hidden/>
                                                    </div>
                                                </span>
                                                <br>
                                                <div id="form-fix" disable="true">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="option">
                                                                <div class="option-control">
                                                                    <span class="form-check form-check-custom form-check-solid form-check-lg">
                                                                        <input class="form-check-input" <?php if($inbound_stt == 1){ echo "checked"; }elseif($fix_status != 1){ echo "disabled"; }  ?> onclick="fix_type();" type="checkbox" id="inbound" name="inbound"/>
                                                                        <span></span>
                                                                    </span>
                                                                </div>
                                                                <div class="option-label">
                                                                    <span class="option-head">
                                                                        <span class="option-title">Inbound
                                                                            <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                                                <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="gray"/>
                                                                                <path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="black"/>
                                                                            </svg></span>
                                                                        </span>
                                                                    </span>
                                                                    <br>
                                                                    <div id="form-inbound">
                                                                        <div id="formInbTrx">
                                                                            <div class="row">
                                                                                <div class="col-2">
                                                                                    <div class="option-control">
                                                                                        <label class="radio">
                                                                                            <input type="radio" <?php if($inbound_stt == 1 && $ibd_rate_type == 1){ echo "checked"; }elseif($inbound_stt != 1){ echo "disabled"; }  ?> onclick="inb_type();" name="inb-type" id="inb-trx" value="1"/>
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-10">
                                                                                    <div class="option-label">
                                                                                        <span class="option-head">
                                                                                            <div class="row">
                                                                                                <div class="col-12">
                                                                                                    <div class="input-group">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text">
                                                                                                                Rp.
                                                                                                            </span>
                                                                                                        </div>
                                                                                                        <input type="text" <?php if($inbound_stt != 1){ echo "disabled"; }  ?> class="form-control" value="<?php if($inbound_stt == 1 && $ibd_rate_type == 1){ echo $ibd_rate; }  ?>" id="inbound_cost_trx" name="inbound_cost_trx" class="custom-cost" placeholder="e.g., 500,000" />
                                                                                                        <div class="input-group-append">
                                                                                                            <span class="input-group-text">
                                                                                                                / Trx
                                                                                                            </span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                        <div id="formInbPcs">
                                                                            <div class="row">
                                                                                <div class="col-2">
                                                                                    <div class="option-control">
                                                                                        <label class="radio">
                                                                                            <input type="radio" <?php if($inbound_stt == 1 && $ibd_rate_type == 2){ echo "checked"; }elseif($inbound_stt != 1){ echo "disabled"; } ?> name="inb-type" id="inb-pcs" value="2"/>
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-10">
                                                                                    <div class="option-label">
                                                                                        <span class="option-head">
                                                                                            <div class="row">
                                                                                                <div class="col-12">
                                                                                                    <div class="input-group">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text">
                                                                                                                Rp.
                                                                                                            </span>
                                                                                                        </div>
                                                                                                        <input type="text" <?php if($inbound_stt != 1){ echo "disabled"; } ?> 
                                                                                                            value="<?php if($inbound_stt == 1 && $ibd_rate_type == 2){ echo $ibd_rate; }  ?>" class="form-control" id="inbound_cost_pcs" name="inbound_cost_pcs" placeholder="e.g., 500,000" />
                                                                                                        <div class="input-group-append">
                                                                                                            <span class="input-group-text">
                                                                                                                / Pcs
                                                                                                            </span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                        <div id="formInbKg">
                                                                            <div class="row">
                                                                                <div class="col-2">
                                                                                    <div class="option-control">
                                                                                        <label class="radio">
                                                                                            <input type="radio" <?php if($inbound_stt == 1 && $ibd_rate_type == 3){ echo "checked"; }elseif($inbound_stt != 1){ echo "disabled"; } ?> name="inb-type" id="inb-kg" value="3"/>
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-10">
                                                                                    <div class="option-label">
                                                                                        <span class="option-head">
                                                                                            <div class="row">
                                                                                                <div class="col-12">
                                                                                                    <div class="input-group">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text">
                                                                                                                Rp.
                                                                                                            </span>
                                                                                                        </div>
                                                                                                        <input type="text" <?php if($inbound_stt != 1){ echo "disabled"; } ?> value="<?php if($inbound_stt == 1 && $ibd_rate_type == 3){ echo $ibd_rate; }  ?>" class="form-control" id="inbound_cost_kg" name="inbound_cost_kg" placeholder="e.g., 500,000" />
                                                                                                        <div class="input-group-append">
                                                                                                            <span class="input-group-text">
                                                                                                                / Kg
                                                                                                            </span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="option">
                                                                <div class="option-control">
                                                                    <span class="form-check form-check-custom form-check-solid form-check-lg">
                                                                        <input class="form-check-input" <?php if($outbound_stt == 1){ echo "checked"; }elseif($fix_status != 1){ echo "disabled"; } ?> onclick="fix_type();" type="checkbox" id="outbound" name="outbound"/>
                                                                        <span></span>
                                                                    </span>
                                                                </div>
                                                                <div class="option-label">
                                                                    <span class="option-head">
                                                                        <span class="option-title">Outbound
                                                                            <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                                                <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="gray"/>
                                                                                <path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="black"/>
                                                                            </svg></span>
                                                                        </span>
                                                                    </span>
                                                                    <br>
                                                                    <div id="form-outbound">
                                                                        <div id="formOutTrx">
                                                                            <div class="row">
                                                                                <div class="col-2">
                                                                                    <div class="option-control">
                                                                                        <label class="radio">
                                                                                            <input type="radio" <?php if($outbound_stt == 1 && $otb_rate_type == 1){ echo "checked"; }elseif($outbound_stt != 1){ echo "disabled"; } ?> name="out-type" id="out-trx" value="1"/>
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-10">
                                                                                    <div class="option-label">
                                                                                        <span class="option-head">
                                                                                            <div class="row">
                                                                                                <div class="col-12">
                                                                                                    <div class="input-group">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text">
                                                                                                                Rp.
                                                                                                            </span>
                                                                                                        </div>
                                                                                                        <input type="text" <?php if($outbound_stt != 1){ echo "disabled"; } ?>  value="<?php if($outbound_stt == 1 && $otb_rate_type == 1){ echo $otb_rate; }  ?>" class="form-control" id="outbound_cost_trx" name="outbound_cost_trx" placeholder="e.g., 500,000" />
                                                                                                        <div class="input-group-append">
                                                                                                            <span class="input-group-text">
                                                                                                                / Trx
                                                                                                            </span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                        <div id="formOutPcs">
                                                                            <div class="row">
                                                                                <div class="col-2">
                                                                                    <div class="option-control">
                                                                                        <label class="radio">
                                                                                            <input type="radio" <?php if($outbound_stt == 1 && $otb_rate_type == 2){ echo "checked"; }elseif($outbound_stt != 1){ echo "disabled"; } ?> name="out-type" id="out-pcs" value="2"/>
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-10">
                                                                                    <div class="option-label">
                                                                                        <span class="option-head">
                                                                                            <div class="row">
                                                                                                <div class="col-12">
                                                                                                    <div class="input-group">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text">
                                                                                                                Rp.
                                                                                                            </span>
                                                                                                        </div>
                                                                                                        <input type="text" <?php if($outbound_stt != 1){ echo "disabled"; } ?>  value="<?php if($outbound_stt == 1 && $otb_rate_type == 2){ echo $otb_rate; }  ?>" class="form-control" id="outbound_cost_pcs" name="outbound_cost_pcs" placeholder="e.g., 500,000" />
                                                                                                        <div class="input-group-append">
                                                                                                            <span class="input-group-text">
                                                                                                                / Pcs
                                                                                                            </span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                        <div id="formOutKg">
                                                                            <div class="row">
                                                                                <div class="col-2">
                                                                                    <div class="option-control">
                                                                                        <label class="radio">
                                                                                            <input type="radio" <?php if($outbound_stt == 1 && $otb_rate_type == 3){ echo "checked"; }elseif($outbound_stt != 1){ echo "disabled"; } ?> name="out-type" id="out-kg" value="3"/>
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-10">
                                                                                    <div class="option-label">
                                                                                        <span class="option-head">
                                                                                            <div class="row">
                                                                                                <div class="col-12">
                                                                                                    <div class="input-group">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text">
                                                                                                                Rp.
                                                                                                            </span>
                                                                                                        </div>
                                                                                                        <input type="text" <?php if($outbound_stt != 1){ echo "disabled"; } ?>  value="<?php if($outbound_stt == 1 && $otb_rate_type == 3){ echo $otb_rate; }  ?>" class="form-control" id="outbound_cost_kg" name="outbound_cost_kg" placeholder="e.g., 500,000" />
                                                                                                        <div class="input-group-append">
                                                                                                            <span class="input-group-text">
                                                                                                                / Kg
                                                                                                            </span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="option">
                                                                <div class="option-control">
                                                                    <span class="form-check form-check-custom form-check-solid form-check-lg">
                                                                        <input class="form-check-input" <?php if($storage_stt == 1){ echo "checked"; }elseif($fix_status != 1){ echo "disabled"; } ?> onclick="fix_type();" type="checkbox" id="storage" name="storage"/>
                                                                        <span></span>
                                                                    </span>
                                                                </div>
                                                                <div class="option-label">
                                                                    <span class="option-head">
                                                                        <span class="option-title">Storage ( per Month )
                                                                            <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                                                <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="gray"/>
                                                                                <path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="black"/>
                                                                            </svg></span>
                                                                        </span>
                                                                    </span>
                                                                    <br>
                                                                    <div id="form-storage">
                                                                        <div id="formSrgCbm">
                                                                            <div class="row">
                                                                                <div class="col-2">
                                                                                    <div class="option-control">
                                                                                        <label class="radio">
                                                                                            <input type="radio" <?php if($outbound_stt == 1 && $srg_rate_type == 1){ echo "checked"; }elseif($storage_stt != 1){ echo "disabled"; } ?> name="srg-type" id="srg-cbm" value="1"/>
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-10">
                                                                                    <div class="option-label">
                                                                                        <span class="option-head">
                                                                                            <div class="row">
                                                                                                <div class="col-12">
                                                                                                    <div class="input-group">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text">
                                                                                                                Rp.
                                                                                                            </span>
                                                                                                        </div>
                                                                                                        <input type="text" <?php if($storage_stt != 1){ echo "disabled"; } ?>  value="<?php if($storage_stt == 1 && $srg_rate_type == 1){ echo $srg_rate; }  ?>" class="form-control" id="storage_cost_cbm" name="storage_cost_cbm" placeholder="e.g., 500,000" />
                                                                                                        <div class="input-group-append">
                                                                                                            <span class="input-group-text">
                                                                                                                /Cbm
                                                                                                            </span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <div class="col-lg-12">
                                    <button type="sumbit" class="btn btn-success mr-2">Accept</button>
                                    <a href="<?php echo base_url('materialapproval/reject/'.$details->material_id); ?>" type="sumbit" class="btn btn-danger mr-2">Reject</a>
                                    <a href="<?php echo base_url('materialapproval'); ?>" type="reset" class="btn btn-secondary mr-2">Back</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--end::Container-->
        </div>
    </div>
	<!--end::Entry-->
</div>
<!--end::Content-->
<script>
    function testing_onload() {
        $("#form-fix *").prop("disabled", true);
        console.log('testing onload');
        alert("Image is loaded");
    }

    function pricing_type(){
        if ($('#percentage').prop('checked') == true) {
            $("#form-fix *").prop("disabled", true);
            $("#form-percentage *").prop("disabled", false);
        } else if ($('#fix').prop('checked') == true) {
            $("#form-percentage *").prop("disabled", true);
            $("#form-fix *").prop("disabled", false);
        }
    }
    function fix_type(){
        if ($('#inbound').prop('checked') == true) {
            $("#form-inbound *").prop("disabled", false);
            var inbound = document.getElementById('inbound').value = 1;
        } else if($('#inbound').prop('checked') == false){
            $("#form-inbound *").prop("disabled", true);
            var inbound = document.getElementById('inbound').value = 0;
        } if ($('#outbound').prop('checked') == true) {
            $("#form-outbound *").prop("disabled", false);
            var outbound = document.getElementById('outbound').value = 1;
        } else if($('#outbound').prop('checked') == false){
            $("#form-outbound *").prop("disabled", true);
            var outbound = document.getElementById('outbound').value = 0;
        } if($('#storage').prop('checked') == true){
            $("#form-storage *").prop("disabled", false);
            var storage = document.getElementById('storage').value = 1;
        } else if($('#storage').prop('checked') == false){
            $("#form-storage *").prop("disabled", true);
            var storage = document.getElementById('storage').value = 0;
        }
    }
    function inb_type(){
        if($('#inb-trx').prop('checked') == true){
            $("#inbound_cost_trx").prop("disabled", false);
        }else if($('#inb-trx').prop('checked') == false){
            $("#inbound_cost_trx").prop("disabled", true);
        }
    }
    
</script>