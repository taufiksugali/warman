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
                        <a href="" class="text-muted">Product Detail</a>
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
                            <h3 class="card-title">Product Detail</h3>
                        </div>
                        <!--begin::Form-->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <label><strong>Detail Data: </strong></label>
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
                                <div class="col-6">
                                    <label><strong>Marketplace Links: </strong></label>
                                    <table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
                                        <thead>
                                            <th class="text-center">No.</th>
                                            <th>Marketplace</th>
                                            <th>Link</th>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;?>
                                            <?php 
                                            if(!empty($market)){
                                                foreach(@$market as $row) { ?>
                                                <tr >
                                                    <td style="margin-top: 5px; margin-bottom: 5px" scope="row" width="3%"><?= $i; ?></td>
                                                    <td><?= @$row->market_name; ?></td>
                                                    <td><a href="<?= @$row->market_url; ?>" target="_blank"><?= @$row->market_url; ?></a></td>
                                                </tr>
                                                <?php $i++ ?>
                                            <?php } 
                                            }?>
                                        <tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-footer text-center">
                            <div class="col-lg-12">
                                <a href="<?php echo base_url('materialapproval'); ?>" type="reset" class="btn btn-success mr-2">Back</a>
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