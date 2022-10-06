
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Overview</h5>
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
				<div class="col-md-12">
					<div class="card card-custom gutter-b card-stretch">
							<!--begin::Header-->
							<div class="card-header border-0 py-5">
								<h3 class="card-title align-items-start flex-column">
									<div class="row">
										<div class="col-4">
											<div class="symbol symbol-40 symbol-light-primary bg-light mr-3">
												<div class="symbol-label">
													<span class="svg-icon svg-icon-md svg-icon-primary">
														<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Notification2.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect x="0" y="0" width="24" height="24"/>
																<path d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z" fill="#000000"/>
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</div>
											</div>
										</div>
										<div class="col-8">
											<!-- <span class="card-label font-weight-bolder text-dark">Filter</span> -->
										</div>
									</div>
								</h3>
								<div class="card-toolbar">
									<label>Customer <span class="text-danger">*</span></label>&nbsp;&nbsp;
									<select class="form-control select select2 " placeholder="Select a Seller" id="f_dash_owner" name="owners_id" >
										<option value="" selected>All</option>
										<?php foreach($owners_data as $row){ ?>
											<option value="<?= $row->owners_id ?>" ><?= $row->owners_name ?></option>
										<?php } ?>
									</select>&nbsp;&nbsp;
									<button type="submit" id="btn_filter_dash" onclick="refreshDashboard();" class="btn btn-primary mr-2">Filter</button>&nbsp;
									<a href="<?= base_url('dashboard'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Reset</a>
								</div>
							</div>
						</div>
					</div>	
				</div>
				<div class="row">
					<div class="col-xl-6">
						<div class="row">
							<div class="col-xl-6">
								<!--begin::Stats Widget 25-->
								<div class="card card-custom bg-white card-stretch gutter-b">
									<!--begin::Body-->
									<div class="card-body">
										<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Check.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24"/>
												<path d="M8,4 C8.55228475,4 9,4.44771525 9,5 L9,17 L18,17 C18.5522847,17 19,17.4477153 19,18 C19,18.5522847 18.5522847,19 18,19 L9,19 C8.44771525,19 8,18.5522847 8,18 C7.44771525,18 7,17.5522847 7,17 L7,6 L5,6 C4.44771525,6 4,5.55228475 4,5 C4,4.44771525 4.44771525,4 5,4 L8,4 Z" fill="#000000" opacity="0.3"/>
												<rect fill="#000000" opacity="0.3" x="11" y="7" width="8" height="8" rx="4"/>
												<circle fill="#000000" cx="8" cy="18" r="3"/>
											</g>
											</svg><!--end::Svg Icon-->
										</span>
										<span class="card-title font-weight-bolder text-dark-85 font-size-h2 mb-0 mt-6 d-block" id="ibd_today"><?= $inbound_today ?></span>
										<span class="font-weight-bold text-dark-65 font-size-md">Inbound Today</span>
									</div>
									<!--end::Body-->
								</div>
									<!--end::Stats Widget 25-->
							</div>
							<div class="col-xl-6">
								<!--begin::Stats Widget 25-->
								<div class="card card-custom bg-white card-stretch gutter-b">
									<!--begin::Body-->
									<div class="card-body">
										<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Check.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24"/>
												<path d="M20.4061385,6.73606154 C20.7672665,6.89656288 21,7.25468437 21,7.64987309 L21,16.4115967 C21,16.7747638 20.8031081,17.1093844 20.4856429,17.2857539 L12.4856429,21.7301984 C12.1836204,21.8979887 11.8163796,21.8979887 11.5143571,21.7301984 L3.51435707,17.2857539 C3.19689188,17.1093844 3,16.7747638 3,16.4115967 L3,7.64987309 C3,7.25468437 3.23273352,6.89656288 3.59386153,6.73606154 L11.5938615,3.18050598 C11.8524269,3.06558805 12.1475731,3.06558805 12.4061385,3.18050598 L20.4061385,6.73606154 Z" fill="#000000" opacity="0.3"/>
												<polygon fill="#000000" points="14.9671522 4.22441676 7.5999999 8.31727912 7.5999999 12.9056825 9.5999999 13.9056825 9.5999999 9.49408582 17.25507 5.24126912"/>
											</g>
											</svg><!--end::Svg Icon-->
										</span>
										<span class="card-title font-weight-bolder text-dark-85 font-size-h2 mb-0 mt-6 d-block" id="obd_today"><?= $outbound_today ?></span>
										<span class="font-weight-bold text-dark-65 font-size-md">Outbound Today</span>
									</div>
									<!--end::Body-->
								</div>
								<!--end::Stats Widget 25-->
							</div>
						</div>
					</div>
				<div class="col-xl-6">
					<div class="row">
						<div class="col-xl-6">
							<!--begin::Stats Widget 25-->
							<div class="card card-custom bg-light-success card-stretch gutter-b">
								<!--begin::Body-->
								<div class="card-body">
									<span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Check.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24"/>
												<path d="M9.26193932,16.6476484 C8.90425297,17.0684559 8.27315905,17.1196257 7.85235158,16.7619393 C7.43154411,16.404253 7.38037434,15.773159 7.73806068,15.3523516 L16.2380607,5.35235158 C16.6013618,4.92493855 17.2451015,4.87991302 17.6643638,5.25259068 L22.1643638,9.25259068 C22.5771466,9.6195087 22.6143273,10.2515811 22.2474093,10.6643638 C21.8804913,11.0771466 21.2484189,11.1143273 20.8356362,10.7474093 L17.0997854,7.42665306 L9.26193932,16.6476484 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(14.999995, 11.000002) rotate(-180.000000) translate(-14.999995, -11.000002) "/>
												<path d="M4.26193932,17.6476484 C3.90425297,18.0684559 3.27315905,18.1196257 2.85235158,17.7619393 C2.43154411,17.404253 2.38037434,16.773159 2.73806068,16.3523516 L11.2380607,6.35235158 C11.6013618,5.92493855 12.2451015,5.87991302 12.6643638,6.25259068 L17.1643638,10.2525907 C17.5771466,10.6195087 17.6143273,11.2515811 17.2474093,11.6643638 C16.8804913,12.0771466 16.2484189,12.1143273 15.8356362,11.7474093 L12.0997854,8.42665306 L4.26193932,17.6476484 Z" fill="#000000" fill-rule="nonzero" transform="translate(9.999995, 12.000002) rotate(-180.000000) translate(-9.999995, -12.000002) "/>
											</g>
										</svg><!--end::Svg Icon-->
									</span>
									<span class="card-title font-weight-bolder text-dark-85 font-size-h2 mb-0 mt-6 d-block" id="dash_stok_ok"><?= $stock_ok ?></span>
									<span class="font-weight-bold text-dark-65 font-size-md">Stok Good</span>
									<a href="" data-toggle="modal" data-target="#goodstock" class="stretched-link"></a>
								</div>
								<!--end::Body-->
							</div>
								<!--end::Stats Widget 25-->
						</div>
						<div class="col-xl-6">
							<!--begin::Stats Widget 25-->
							<div class="card card-custom bg-light-danger card-stretch gutter-b">
								<!--begin::Body-->
								<div class="card-body">
									<span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Check.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
												<rect x="0" y="7" width="16" height="2" rx="1"/>
												<rect opacity="0.3" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000) " x="0" y="7" width="16" height="2" rx="1"/>
											</g>
										</g>
										</svg><!--end::Svg Icon-->
									</span>
									<span class="card-title font-weight-bolder text-dark-85 font-size-h2 mb-0 mt-6 d-block" id="dash_stok_nok"><?= $stock_nok ?></span>
									<span class="font-weight-bold text-dark-65 font-size-md">Stok Not Good</span>
									<a href="" data-toggle="modal" data-target="#notgoodstock" class="stretched-link"></a>
								</div>
								<!--end::Body-->
							</div>
							<!--end::Stats Widget 25-->
						</div>
					</div>
					
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="card card-custom gutter-b">
						<!--begin::Header-->
						<div class="card-header h-auto">
							<!--begin::Title-->
							<div class="card-title py-5">
								<h3 class="card-label">Inbound last 7 days</h3>
							</div>
							<!--end::Title-->
						</div>
						<!--end::Header-->
						<div class="card-body" >
							<!--begin::Chart-->
							<canvas id="inbound_last_week" style="width:10; height:10; position: relative"></canvas>
							<!--end::Chart-->
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="card card-custom gutter-b">
						<!--begin::Header-->
						<div class="card-header h-auto">
							<!--begin::Title-->
							<div class="card-title py-5">
								<h3 class="card-label">Outbound last 7 days</h3>
							</div>
							<!--end::Title-->
						</div>
						<!--end::Header-->
						<div class="card-body" >
							<!--begin::Chart-->
							<canvas id="outbound_last_week" style="width:10; height:10; position: relative"></canvas>
							<!--end::Chart-->
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="card card-custom gutter-b">
						<!--begin::Header-->
						<div class="card-header h-auto">
							<!--begin::Title-->
							<div class="card-title py-5">
								<h3 class="card-label">Inbound last 30 days</h3>
							</div>
							<!--end::Title-->
						</div>
						<!--end::Header-->
						<div class="card-body" >
							<!--begin::Chart-->
							<canvas id="myChart" style="width:10; height:10; position: relative"></canvas>
							<!--end::Chart-->
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="card card-custom gutter-b">
						<!--begin::Header-->
						<div class="card-header h-auto">
							<!--begin::Title-->
							<div class="card-title py-5">
								<h3 class="card-label">Outbound last 30 days</h3>
							</div>
							<!--end::Title-->
						</div>
						<!--end::Header-->
						<div class="card-body" >
							<!--begin::Chart-->
							<canvas id="myChart2" style="width:10; height:10; position: relative"></canvas>
							<!--end::Chart-->
						</div>
					</div>
				</div>
			</div>
			<div class="card card-custom gutter-b">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Warehouse Stock on Hand
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
                                <th>Warehouse</th>
                                <th>WH. Name</th>
                                <th>Product</th>
                                <th>Product Name</th>
								<th>GOOD</th>
								<th>NOT GOOD</th>
								<th>RESERVED</th>
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
<!-- Modal Stok Good-->
<div class="modal fade" id="goodstock" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="goodstock" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Stock Good Materials</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i aria-hidden="true" class="ki ki-close"></i>
				</button>
			</div>
			<div class="modal-body">
				<div id="tbl_dash_good">
					<table class="table display table-separate table-bordered-scroll-x" id="stock_good">
						<thead>
							<tr>
								<th th width="3%">No.</th>
								<th>Warehouse ID</th>
								<th>Warehouse Name</th>
								<th>Material ID</th>
								<th>Material Name</th>
								<th>Location</th>
								<th>Qty</th>
							</tr>
						</thead>
						<tbody >
						<?php $i = 1; ?>
							<?php foreach(@$stok_good_data as $row) { ?>
							<tr>
								<td scope="row" th width="3%"><?= $i; ?></td>
								<td><?= @$row->warehouse_id; ?></td>
								<td><?= @$row->wh_name; ?></td>
								<td><?= @$row->material_id; ?></td>
								<td><?= @$row->material_name; ?></td>
								<td><?= @$row->mat_loc; ?></td>
								<td><?= @$row->qty; ?></td>
							</tr>
							<?php $i++ ?>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="notgoodstock" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="notgoodstock" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Stock Not Good Materials</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i aria-hidden="true" class="ki ki-close"></i>
				</button>
			</div>
			<div class="modal-body">
				<div id="tbl_dash_notgood">
					<table class="table display table-separate table-bordered-scroll-x" id="stock_notgood">
						<thead>
							<tr>
								<th width="3%">No.</th>
								<th>Warehouse ID</th>
								<th>Warehouse Name</th>
								<th>Material ID</th>
								<th>Material Name</th>
								<th>Location</th>
								<th>Qty</th>
							</tr>
						</thead>
						<tbody>
						<?php $j = 1; ?>
							<?php foreach(@$stok_notgood_data as $row2) { ?>
							<tr>
								<td scope="row" th width="3%"><?= $j; ?></td>
								<td><?= @$row2->warehouse_id; ?></td>
								<td><?= @$row2->wh_name; ?></td>
								<td><?= @$row2->material_id; ?></td>
								<td><?= @$row2->material_name; ?></td>
								<td><?= @$row2->mat_loc; ?></td>
								<td><?= @$row2->qty; ?></td>
							</tr>
							<?php $j++ ?>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
