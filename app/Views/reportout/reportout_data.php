<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Outbound Report</h5>
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
								<?php if(session()->get('warehouse_id') == 'POSLOG' || session()->get('user_type') == 1){ ?>
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
						<a href="<?= base_url('reportout'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Reset</a>
					</div>
			</div>
			<div class="card card-custom gutter-b">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Outbound Report
                        <span class="d-block text-muted pt-2 font-size-sm">scrollable datatable with fixed height</span></h3>
                    </div>
					<div class="card-toolbar">
						<!--begin::Button-->
						<div class="form-group row">
							<div class="col-lg-12">
								<div class="dropdown dropdown-inline">
									<button type="button" class="btn btn-light-primary font-weight-bold mr-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="svg-icon">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-opened.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" fill="#000000" opacity="0.3" />
													<path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>Export</button>
									<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
										<ul class="navi flex-column navi-hover py-2">
											<li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">Export Tools</li>
											<li class="navi-item">
												<a href="#" class="navi-link" id="export_copy">
													<span class="navi-icon">
														<i class="la la-copy"></i>
													</span>
													<span class="navi-text">Copy</span>
												</a>
											</li>
											<li class="navi-item">
												<a href="#" class="navi-link" id="export_excel">
													<span class="navi-icon">
														<i class="la la-file-excel-o"></i>
													</span>
													<span class="navi-text">Excel</span>
												</a>
											</li>
											<li class="navi-item">
												<a href="#" class="navi-link" id="export_csv">
													<span class="navi-icon">
														<i class="la la-file-text-o"></i>
													</span>
													<span class="navi-text">CSV</span>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<!--end::Button-->
					</div>
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <?= session()->getFlashdata('message'); ?>
                    <table class="table table-separate table-head-custom table-checkable" id="data-table-server-side-scrollx">
                        <thead>
                            <tr>
                                <th data-orderable="false">No</th>
                                <th>Out Date</th>
                                <th>Transaction ID</th>
                                <th>Warehouse</th>
                                <th>Material</th>
								<th>Customer</th>
                                <th data-orderable="false">ADMIN FEE</th>
                                <th data-orderable="false">PACKING FEE</th>
                                <th data-orderable="false">CUSTOM FEE</th>
                                <th data-orderable="false">SHIPPING FEE</th>
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
