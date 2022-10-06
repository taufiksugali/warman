<!--begin::Footer-->
<?php use App\Models\OwnersModel; ?>
<?php $this->owner = new OwnersModel(); ?>
<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
						<!--begin::Container-->
						<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
							<!--begin::Copyright-->
							<div class="text-dark order-2 order-md-1">
								Copyright &copy; 2021 - <strong><span>STORI Enterprise</span></strong>. All Rights Reserved
							</div>
							<!--end::Copyright-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Main-->
		<!-- begin::User Panel-->
		<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
			<!--begin::Header-->
			<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
				<h3 class="font-weight-bold m-0">User Profile</h3>
				<a class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
					<i class="ki ki-close icon-xs text-muted"></i>
				</a>
			</div>
			<!--end::Header-->
			<!--begin::Content-->
			<div class="offcanvas-content pr-5 mr-n5">
				<!--begin::Header-->
				<div class="d-flex align-items-center mt-5">
					<div class="symbol symbol-100 mr-5">
						<?php if(session()->get('user_src') == 'LOCAL') { ?>
							<div class="symbol-label" style="background-image:url('<?= base_url(''); ?>/theme/dist/assets/media/users/blank.png')"></div>
						<?php } else { ?>
							<div class="symbol-label" style="background-image:url('http://app.poslogistics.co.id:6080/hris/./upload/employee/<?= session()->get('employee_photo') ?>')"></div>
						<?php } ?>
						<i class="symbol-badge bg-primary"></i>
					</div>
					<div class="d-flex flex-column">
						<a class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?= session()->get('fullname'); ?></a>
						<div class="text-muted mt-1"><?= session()->get('job_title'); ?></div>
						<div class="navi mt-2">
							<a class="navi-item">
								<span class="navi-link p-0 pb-2">
									<span class="navi-icon mr-1">
										<span class="svg-icon svg-icon-lg svg-icon-primary">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
													<circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</span>
									<span class="navi-text text-muted text-hover-primary"><?= session()->get('email'); ?></span>
								</span>
							</a>
							<a href="<?php echo base_url('auth/logout'); ?>" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>
						</div>
					</div>
				</div>
				<!--end::Header-->
				<div class="separator separator-dashed mt-8 mb-5"></div>
				<?php if(session()->get('user_type') == 1) { ?>
					<div class="navi navi-spacer-x-0 p-0">
						<!--begin::Item-->
						<a class="navi-item">
							<div class="navi-link">
								<div class="symbol symbol-40 symbol-light-primary bg-light mr-3">
									<div class="symbol-label">
										<!-- <img src="<?= base_url(); ?>/logo/svg/balance.svg" /> -->
										<span class="svg-icon svg-icon-md svg-icon-primary">
											<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Notification2.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"/>
													<circle fill="#000000" opacity="0.3" cx="20.5" cy="12.5" r="1.5"/>
													<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 6.500000) rotate(-15.000000) translate(-12.000000, -6.500000) " x="3" y="3" width="18" height="7" rx="1"/>
													<path d="M22,9.33681558 C21.5453723,9.12084552 21.0367986,9 20.5,9 C18.5670034,9 17,10.5670034 17,12.5 C17,14.4329966 18.5670034,16 20.5,16 C21.0367986,16 21.5453723,15.8791545 22,15.6631844 L22,18 C22,19.1045695 21.1045695,20 20,20 L4,20 C2.8954305,20 2,19.1045695 2,18 L2,6 C2,4.8954305 2.8954305,4 4,4 L20,4 C21.1045695,4 22,4.8954305 22,6 L22,9.33681558 Z" fill="#000000"/>
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</div>
								</div>
								<div class="navi-text">
									<div class="font-weight-bold">Current Balance</div>
									<div class="text-muted">Rp. <?= number_format($this->owner->get_owner_byid(session()->get('owners_id'))->owners_balance) ?></div>
								</div>
							</div>
						</a>
						<a class="navi-item" href="<?= base_url('/owners/editSeller/'.session()->get('owners_id')); ?>">
							<div class="navi-link">
								<div class="symbol symbol-40 symbol-light-primary bg-light mr-3">
									<div class="symbol-label">
										<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Smile.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"/>
													<rect fill="#000000" opacity="0.3" x="2" y="2" width="20" height="20" rx="10"/>
													<path d="M6.16794971,14.5547002 C5.86159725,14.0951715 5.98577112,13.4743022 6.4452998,13.1679497 C6.90482849,12.8615972 7.52569784,12.9857711 7.83205029,13.4452998 C8.9890854,15.1808525 10.3543313,16 12,16 C13.6456687,16 15.0109146,15.1808525 16.1679497,13.4452998 C16.4743022,12.9857711 17.0951715,12.8615972 17.5547002,13.1679497 C18.0142289,13.4743022 18.1384028,14.0951715 17.8320503,14.5547002 C16.3224187,16.8191475 14.3543313,18 12,18 C9.64566871,18 7.67758127,16.8191475 6.16794971,14.5547002 Z" fill="#000000"/>
												</g>
											</svg>
										<!--end::Svg Icon-->
										</span>
									</div>
								</div>
								<div class="navi-text">
									<div class="font-weight-bold">Seller Profile</div>
								</div>	
							</div>
						</a>
						<!--end:Item-->
					</div>
				<?php } ?>
			</div>
			<!--end::Content-->
		</div>
		<!-- end::User Panel-->
		
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop">
			<span class="svg-icon">
				<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24" />
						<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
						<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
					</g>
				</svg>
				<!--end::Svg Icon-->
			</span>
		</div>
		<!--end::Scrolltop-->
		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="<?= base_url(); ?>/theme/dist/assets/plugins/global/plugins.bundle.js"></script>
		<script src="<?= base_url(); ?>/theme/dist/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="<?= base_url(); ?>/theme/dist/assets/js/scripts.bundle.js"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Vendors(used by this page)-->
		<script src="<?= base_url(); ?>/theme/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
		<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM"></script>
		<script src="<?= base_url(); ?>/theme/dist/assets/plugins/custom/gmaps/gmaps.js"></script>
		<!--end::Page Vendors-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="<?= base_url(); ?>/theme/dist/assets/js/pages/widgets.js"></script>
		<!--begin::Page Vendors(used by this page)-->
		<script src="<?= base_url(); ?>/theme/dist/assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<!--end::Page Vendors-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="<?= base_url(); ?>/theme/dist/assets/js/pages/crud/datatables/basic/scrollable.js"></script>
		<script src="<?= base_url(); ?>/theme/dist/assets/js/pages/serverside-datatables.js"></script>
		<!--begin::Page Scripts(used by this page)-->
		<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/crud/forms/widgets/select2.js"></script>
		<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/crud/forms/widgets/autosize.js"></script>
		<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js"></script>
		<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/crud/forms/widgets/bootstrap-timepicker.js"></script>
		<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/crud/forms/widgets/bootstrap-select.js"></script>
		<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js"></script>
		<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/crud/datatables/basic/basic.js"></script>
		<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/crud/forms/widgets/form-repeater.js"></script>
		<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/crud/forms/widgets/jquery-mask.js"></script>
		<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/crud/forms/widgets/bootstrap-touchspin.js?v=7.2.9"></script>
		<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/features/miscellaneous/toastr.js?v=7.2.9"></script>
		<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/sweetalert.js"></script>
		<!-- <script src="<?= base_url(''); ?>/template/assets/js/pages/crud/datatables/basic/basic.js"></script> -->
		<!-- <script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/sweetalert.js"></script>
		<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/format_numbering.js"></script> -->
		<!--end::Page Scripts-->
		
		<!-- PAGE JS -->
		<script>
			var base_url_new = "<?= base_url('') ?>";
		</script>
		
		<!-- END OF PAGE JS -->
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnqACpjEB47TZ4SQf6Fwt6sa6hhAyO5dM&callback=initMap" type="text/javascript"></script>
		<script>
			$('.select').select2({
				placeholder: 'Select an option'
			});
			
			$('.datepicker_2').datepicker({
				format: 'dd-mm-yyyy',
				todayHighlight: true,
				autoclose: true
			});
		</script>
		<!-- purchase order and inbound js -->
		<script type="text/javascript">
			$(document).ready(function() {
				var max_fields      = 10; //maximum input boxes allowed
				var wrapper         = $(".input_fields_wrap"); //Fields wrapper
				var add_button      = $(".add_field_button"); //Add button ID
				// var import_btn      = $(".import_button"); //import button ID
				var x = 0; //initlal text box count
				$(add_button).click(function(e){ //on add input button click
					e.preventDefault();
						x++; //text box increment
						$(wrapper).append(
							'<div><div class="form-group row"><div class="col-4"><label class="font-weight-bold">Product<span class="text-danger">*</span></label><select class="select form-control custom-select showproduct" required id="material_id'+x+'" name="material_id[]"><option></option><?php
							if (@$material) :
								foreach ($material as $row) :
									if($row->material_weight == $row->weight_comparison && $row->material_height == $row->height_comparison
                                                                                && $row->material_length == $row->length_comparison && $row->material_width == $row->width_comparison) :
							?>
							<option value="<?= $row->material_id ?>"><?= $row->material_name ?>
							</option><?php endif; endforeach; endif; ?>
							</select></div><div class="col-4"><label class="font-weight-bold">Quantity<span class="text-danger">*</span></label><div class="input-group"><input type="text" required class="form-control numbers" id="quantity" name="quantity['+x+']" placeholder="Quantity"></div></div><div class="col-3"><label class="font-weight-bold">Unit Price<span class="text-danger">*</span></label><div class="input-group"><div class="input-group-append"><span class="input-group-text">Rp.</span></div><input type="text" class="form-control form-control-solid numbers"  id="price'+x+'" readonly required name="material_price['+x+']" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this);" placeholder="Unit Price"></div></div><div class="col-1"><label class="font-weight-bold">&nbsp;</label><a href="#" id="remove_field" data-repeater-delete class="btn btn-light-danger btn-md font-weight-bolder form-control">X</a></div></div><div class="separator separator-dashed"></div></div>'); //add input box
							// Use Javascript
						$('.select').select2({
							placeholder: 'Select an option'
						});

						$('#material_id'+x+'').change(function () {
							var material_id = document.getElementById('material_id'+x+'').value;
							// console.log(area_id);
							$.ajax({
								method: 'POST',
								url: "<?php echo site_url("/purchaseorder/get_price"); ?>",
								beforeSend: function () {
								},
								dataType: "json",
								data: {
									material_id : material_id,
								},
								success: function (result) {
									document.getElementById('price'+x+'').value = result.price;
								}
							})
						});
				});

				
					
				$(wrapper).on("click","#remove_field", function(e){ //user click on remove text
					e.preventDefault(); $(this).parent('div').parent('div').parent('div').remove(); x--;
				});
			});
		</script>
		
		<!-- end of purchase order and inbound js -->

		<script type="text/javascript">

			function FormatCurrency(ctrl) {
				//Check if arrow keys are pressed - we want to allow navigation around textbox using arrow keys
				if (event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40) {
					return;
				}
				var val = ctrl.value;

				val = val.replace(/,/g, "")
				ctrl.value = "";
				val += '';
				x = val.split('.');
				x1 = x[0];
				x2 = x.length > 1 ? '.' + x[1] : '';

				var rgx = /(\d+)(\d{3})/;

				while (rgx.test(x1)) {
					x1 = x1.replace(rgx, '$1' + ',' + '$2');
				}

				ctrl.value = x1 + x2;
			}

			function CheckNumeric() {
				return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode == 46;
			}
		</script>



	<script>
			$(document).ready(function() {
					var max_fields      = 10; //maximum input boxes allowed
					var wrapper         = $(".pm_input_fields_wrap"); //Fields wrapper
					var add_button      = $(".pm_add_field_button"); //Add button ID
					var import_btn      = $(".import_button"); //import button ID
					var x = 0; //initlal text box count
					$(add_button).click(function(e){ //on add input button click
						e.preventDefault();
						
							x++; //text box increment
							
							$(wrapper).append(
								'<div><div class="form-group row"><div class="col-4"><label class="font-weight-bold">Packaging Material<span class="text-danger">*</span></label><select class="select form-control custom-select showproduct" required onchange="get_price2('+x+');hitung_material();" id="pm_id'+x+'"  name="pm_id['+x+']"><option></option><?php
								if (@$pm) :
									foreach ($pm as $row) :
								?>
								<option value="<?= $row->id ?>" data-id="<?= $row->pm_rate ?>"><?= $row->pm_name ?></option><?php endforeach; endif; ?>
								</select></div><div class="col-4"><label class="font-weight-bold">Quantity<span class="text-danger">*</span></label><div class="input-group"><div class="input-group  bootstrap-touchspin bootstrap-touchspin-injected"><input id="quantity'+x+'" type="text" class="form-control kt_touchspin_4 bootstrap-touchspin-vertical-btn" name="pm_qty['+x+']" value="1" onchange="hitung_total('+x+');hitung_material();" onkeypress="return CheckNumeric()"></div></div></div><div class="col-3"><label class="font-weight-bold">Rate each material<span class="text-danger">*</span></label><div class="input-group"><div class="input-group-append"><span class="input-group-text">Rp.</span></div><input type="hidden" id="subprice'+x+'" /><input type="text" class="form-control numbers"  id="price'+x+'" required name="pm_rate['+x+']" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this);" readonly placeholder="Rate for Each Product"></div></div><div class="col-1"><label class="font-weight-bold">&nbsp;</label><br/><a href="#" id="remove_field" data-repeater-delete class="btn font-weight-bold btn-light-danger btn-icon">X</a></div></div><div class="separator separator-dashed"></div></div>'); //add input box
								// Use Javascript
							$('.select').select2({
								placeholder: 'Select an option'
							});
							
							$('.kt_touchspin_4, #kt_touchspin_2_4').TouchSpin({
								min: 1,
								buttondown_class: 'btn btn-secondary',
								buttonup_class: 'btn btn-secondary',
								verticalbuttons: true,
								verticalup: '<i class="ki ki-plus"></i>',
								verticaldown: '<i class="ki ki-minus"></i>'
							});
					});
					$(wrapper).on("click","#remove_field", function(e){ //user click on remove text
						e.preventDefault(); $(this).parent('div').parent('div').parent('div').remove(); x--;
					});
				});
	</script>
	<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/crud/forms/widgets/bootstrap-touchspin.js?v=7.2.9"></script>

	<script>
		$(document).on('click', '#ibd_request', function () {
			toastr.options = {
				"closeButton": false,
				"debug": false,
				"newestOnTop": false,
				"progressBar": false,
				"positionClass": "toast-top-right",
				"preventDuplicates": false,
				"onclick": null,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": "5000",
				"extendedTimeOut": "1000",
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
				};

				toastr.error("Your balance is not enough", "Cannot do transaction");
		});
	</script>
	<script>
		$(document).on('click', '#obd_request', function () {
			toastr.options = {
				"closeButton": false,
				"debug": false,
				"newestOnTop": false,
				"progressBar": false,
				"positionClass": "toast-top-right",
				"preventDuplicates": false,
				"onclick": null,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": "5000",
				"extendedTimeOut": "1000",
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
				};

				toastr.error("Your balance is not enough", "Cannot do transaction");
		});
	</script>

	<!-- Custom JS -->
	<script>
		var base_url = "<?=base_url()?>";
	</script>
	<?php
		if(isset($js)){
			echo '<script src="'.base_url().'/theme/dist/assets/js/pages/page_js/'.$js.'"></script>';
		}
	?>
	<!-- END custom JS-->
	

	</body>
	<!--end::Body-->
</html>