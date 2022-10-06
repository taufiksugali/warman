                    <!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Subheader-->
						<div class="subheader py-3 py-lg-8 subheader-transparent" id="kt_subheader">
							<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Info-->
								<div class="d-flex align-items-center mr-1">
									<!--begin::Page Heading-->
									<div class="d-flex align-items-baseline flex-wrap mr-5">
										<!--begin::Page Title-->
										<h2 class="d-flex align-items-center text-dark font-weight-bold my-1 mr-3">Users</h2>
										<!--end::Page Title-->
										<!--begin::Breadcrumb-->
										<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold my-2 p-0">
											<li class="breadcrumb-item text-muted">
												<a href="javascript:" class="text-muted">Master Data</a>
											</li>
											<li class="breadcrumb-item text-muted">
												<a href="javascript:" class="text-muted">Users</a>
											</li>
										</ul>
										<!--end::Breadcrumb-->
									</div>
									<!--end::Page Heading-->
								</div>
								<!--end::Info-->
							</div>
						</div>
						<!--end::Subheader-->
                        <!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Card-->
								<div class="card card-custom">
									<div class="card-header flex-wrap py-5">
										<div class="card-title">
											<h3 class="card-label">Data Users
											<span class="d-block text-muted pt-2 font-size-sm">Data loaded from our server's</span></h3>
										</div>
										<div class="card-toolbar">
											<!--begin::Button-->
											<?php if(session()->get('user_type') == 1 or session()->get('level_id') == 'LV001') { ?>
												<a href="<?= base_url('users/add'); ?>" class="btn btn-primary font-weight-bolder">
												<span class="svg-icon svg-icon-md">
													<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<circle fill="#000000" cx="9" cy="15" r="6" />
															<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
														</g>
													</svg>
													<!--end::Svg Icon-->
												</span>Add Users</a>
											<?php } ?>
											<!--end::Button-->
										</div>
									</div>
									<div class="card-body">
										<!--begin: Datatable-->
										<table class="table table-separate table-head-custom table-checkable" id="data-table-server-side-scrollx">
											<thead>
												<tr>
													<th data-orderable="false">No. </th>
													<th data-orderable="false">Actions</th>
													<th data-orderable="false">Status</th>
													<th>Full Name</th>
													<?php if(session()->get('user_type') == 0){ ?>
														<th>Store</th>
														<th>Email</th>
													<?php } ?>
													<th>Phone</th>
													<th>Level</th>
													<?php if(session()->get('user_type') == 0){ ?>
														<th>Warehouse</th>
													<?php } ?>
												</tr>
											</thead>
											<tbody>
                                            
											</tbody>
										</table>
										<!--end: Datatable-->
									</div>
								</div>
								<!--end::Card-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
                    </div>
					<!--end::Content-->