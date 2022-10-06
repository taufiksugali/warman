<?php use App\Models\OutbounddoDetailModel; ?>
<?php $this->do_detail = new OutbounddoDetailModel(); ?>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Invoice</h5>
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
			<!--begin::Dashboard-->
			<div class="row">
				<div class="col-12">
                <div class="card card-custom overflow-hidden">
                    <div class="card-body p-0">
                        <!-- begin: Invoice-->
                        <!-- begin: Invoice header-->
                        <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
                            
                            <div class="col-md-9">
                                <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                                    <h1 class="display-4 font-weight-boldest mb-10">INVOICE</h1>
                                    <div class="d-flex flex-column align-items-md-end px-0">
                                        <!--begin::Logo-->
                                        <a class="mb-5">
                                            <img src="<?= base_url('/logo/stori-2.jpg');?>" alt="" class="logo-default max-h-50px">
                                        </a>
                                        <!--end::Logo-->
                                        <span class="d-flex flex-column align-items-md-end opacity-70">
                                            <!-- alamat gudang -->
                                            <span><?= $po_data->wh_address ?></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="border-bottom w-100"></div>
                                <div class="d-flex justify-content-between pt-6">
                                    <div class="d-flex flex-column flex-root">
                                        <!-- tanggal PO -->
                                        <span class="font-weight-bolder mb-2">DATE</span>
                                        <span class="opacity-70"><?= date('d M Y', strtotime($po_data->po_create_date)) ?></span>
                                    </div>
                                    <div class="d-flex flex-column flex-root">
                                        <!-- PO ID -->
                                        <span class="font-weight-bolder mb-2">INVOICE NO.</span>
                                        <span class="opacity-70"><?= $po_data->po_outbound_id ?></span>
                                    </div>
                                    <div class="d-flex flex-column flex-root">
                                        <!-- data seller -->
                                        <span class="font-weight-bolder mb-2">INVOICE TO.</span>
                                        <span class="opacity-70"><?= $po_data->owners_name. ', '.$po_data->owners_address ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end: Invoice header-->
                        <!-- begin: Invoice body-->
                        <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                            <div class="col-md-9">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="pl-0 font-weight-bold text-muted text-uppercase">Description</th>
                                                <th class="text-right font-weight-bold text-muted text-uppercase">REF. ID</th>
                                                <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $total_amount = 0;
                                            if (@$bill) :
                                                $no = 0;
                                                $total_amount = 0;
                                                foreach ($bill as $row) :
                                                $no++; 
                                                $awb = @$this->do_detail->get_shipping_detail($row->ref_id)->do_out_resi;
                                                // $print_awb_num = "";
                                                // if($awb != null and $awb != ""){
                                                //     $print_awb_num = ' - AWB NUMBER: '. $awb;    
                                                // }
                                            ?>
                                            <tr class="font-weight-boldest">
                                                <td class="pl-0 pt-7"><?= $row->description ?></td>
                                                <td class="text-right pt-7"><?= $row->ref_id ?></td>
                                                <td class="text-danger pr-0 pt-7 text-right"><?= 'Rp. '.number_format($row->amount) ?></td>
                                            </tr>
                                            <?php
                                                $total_amount = $total_amount + $row->amount;
                                                endforeach;
                                            endif;
                                            $due_date = strtotime($po_data->po_create_date);
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end: Invoice body-->
                        <!-- begin: Invoice footer-->
                        <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
                            <div class="col-md-9">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="font-weight-bold text-muted text-uppercase"></th>
                                                <th class="font-weight-bold text-muted text-uppercase">AWB NUMBER</th>
                                                <!-- tanggal dibuat PO ditambah 1 bulan -->
                                                <th class="font-weight-bold text-muted text-uppercase">DUE DATE</th>
                                                <!-- total tagihan -->
                                                <th class="font-weight-bold text-muted text-uppercase">TOTAL AMOUNT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="font-weight-bolder">
                                                <td></td>
                                                <td><?= @$awb ?></td>
                                                <td><?= date('d M Y', strtotime("+1 month", $due_date)) ?></td>
                                                <td class="text-danger font-size-h3 font-weight-boldest"><?= 'Rp. '.number_format($total_amount) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end: Invoice footer-->
                        <!-- begin: Invoice action-->
                        <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                            <div class="col-md-9">
                                <?= session()->getFlashdata('message'); ?>
                                <div class="d-flex justify-content-between">
                                    <?php if(intval($po_data->po_out_status) > 3) { ?>
                                    <?php } else { ?>
                                        <button class="btn btn-light-danger font-weight-bold" id="reject_invoice" data-id="<?= @$po_data->po_outbound_id ?>">Reject Invoice</button>
                                        <!-- <a href="<?php //echo base_url('outboundpo/accept_invoice/'.$po_data->po_outbound_id)?>" class="btn btn-primary font-weight-bold">Approve Invoice</a> -->
                                        <!-- <a href="<?php //echo base_url('outboundpo/accept_invoice/'.$po_data->po_outbound_id)?>" class="btn btn-primary font-weight-bold">Approve Invoice</a> -->
                                        <button class="btn btn-primary font-weight-bold" id="approve_invoice" data-id="<?= @$po_data->po_outbound_id ?>">Approve Invoice</button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- end: Invoice action-->
                        <!-- end: Invoice-->
                    </div>
                </div>
				</div>
			</div>
			
			<!--begin::Row-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>
<!--end::Content-->