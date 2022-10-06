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
                        <a href="" class="text-muted">Outbound</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Outbound Detail</a>
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
                            <h3 class="card-title">Outbound Detail</h3>
                        </div>
                        <!--begin::Form-->
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <td width="25%"><strong>Outbound ID</strong></td>
                                    <td width="75%"><?= $data_outbound->outbound_id ?></td>
                                </tr>
                                <tr>
                                    <td width="25%"><strong>Doc. Number</strong></td>
                                    <td width="75%"><?= $data_outbound->outbound_doc ?></td>
                                </tr>
                                <tr>
                                    <td width="25%"><strong>Doc. Date</strong></td>
                                    <td width="75%"><?= $data_outbound->outbound_doc_date ?></td>
                                </tr>
                                <tr>
                                    <td width="25%"><strong>Out Date</strong></td>
                                    <td width="75%"><?= $data_outbound->out_date ?></td>
                                </tr>
                                <tr>
                                    <td width="25%"><strong>Description</strong></td>
                                    <td width="75%"><?= $data_outbound->description ?></td>
                                </tr>
                                <tr>
                                    <td width="25%"><strong>Outbound Status</strong></td>
                                    <td width="75%">
                                        <?php if($data_outbound->status == '1'){
                                            echo '<span class="label label-light-success label-pill label-inline mr-2">Plan</span>';
                                        } else if($data_outbound->status == '2'){
                                            echo '<span class="label label-light-danger label-pill label-inline mr-2">Recieve</span>';
                                        } ?>
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <label><strong>Detail Material: </strong></label>
                            <table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
                                <thead>
                                    <th class="text-center">No.</th>
                                    <th>Product Name</th>
                                    <th>Qty Plan</th>
                                    <th>Qty Realization</th>
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
                                        <td>
                                            <?php if($row->qty_realization == null){
                                                    echo '-';
                                                } else {
                                                    echo $row->qty_realization.' '.$row->uom_name;
                                                } 
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                <tbody>
                            </table>
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