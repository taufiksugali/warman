<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Inbound Report</h5>
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
			<div class="card card-custom gutter-b">
					<div class="card-body">
						<div class="input_fields_wrap">
							<div class="form-group row">
								<div class="col-6">
									<label>Date Range</label>
									<div class="input-daterange input-group" id="kt_datepicker_5">
										<input type="text" class="form-control" id="filter_start" name="filter_start">
										<div class="input-group-append">
											<span class="input-group-text">
												<i class="la la-ellipsis-h"></i>
											</span>
										</div>
										<input type="text" class="form-control" id="filter_end" name="filter_end">
									</div>
								</div>
								<div class="col-6">
								<?php if(session()->get('warehouse_id') == 'POSLOG'){ ?>
									<label>Warehouse</label>
									<select class="form-control select select2" value="<?= old('warehouse_id'); ?>" id="filter_wh" name="warehouse_id">
										<option value="" selected></option>
										<?php foreach(@$warehouse as $row) { ?>
										<option value="<?= @$row->warehouse_id; ?>"><?= @$row->wh_name; ?></option>
										<?php } ?>
									</select>
								<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<button type="submit" onclick="reloadTable();" class="btn btn-primary mr-2">Filter</button>
						<a href="<?= base_url('reportin'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Reset</a>
					</div>
			</div>
			<div class="card card-custom gutter-b">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Inbound Report
                        <span class="d-block text-muted pt-2 font-size-sm">scrollable datatable with fixed height</span></h3>
                    </div>
                    
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <?= session()->getFlashdata('message'); ?>
                    <table class="table table-separate table-head-custom table-checkable" id="data-table-server-side-scrollx">
                        <thead>
                            <tr>
                                <th data-orderable="false">No</th>
                                <th>Date</th>
                                <th>Warehouse ID</th>
                                <th>Warehouse Name</th>
                                <th>Material Name</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
			<!--begin::Row-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>
<!--end::Content-->
