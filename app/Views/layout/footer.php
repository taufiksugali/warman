<!--begin::Footer-->
<?php use App\Models\OwnersModel; ?>
<?php $this->owner = new OwnersModel(); ?>
<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
						<!--begin::Container-->
						<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
							<!--begin::Copyright-->
							<div class="text-dark order-2 order-md-1">
								Copyright &copy; 2021 - <strong><span>WARMAN Enterprise</span></strong>. Make With LOVE
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
		
		<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/page_js/outboundpo.js"></script>
		<?php if($title == "Dashboard") { ?>
			<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/page_js/dashboard.js"></script>
		<?php } ?>
		<?php if($title == "Purchaseorder") { ?>
			<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/page_js/po.js"></script>
		<?php } ?>
		<?php if($title == "Materiallocation") { ?>
			<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/page_js/location.js"></script>
		<?php } ?>
		<!-- END OF PAGE JS -->
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnqACpjEB47TZ4SQf6Fwt6sa6hhAyO5dM&callback=initMap" type="text/javascript"></script>
		<script>
			$('#kt_datepicker_2').datepicker({
			format: 'dd-mm-yyyy',
			todayHighlight: true,
			autoclose: true
			});

			$('.select').select2({
				placeholder: 'Select an option'
			});
			
			$('.datepicker_2').datepicker({
				format: 'dd-mm-yyyy',
				todayHighlight: true,
				autoclose: true
			});

			// $(document).ready(function){
			// 	$('#warehouse_id').change(function(){
			// 		var warehouse_id = $('#warehouse_id').val();
			// 		if(warehouse_id != ''){
			// 			$.ajax({
			// 				url:"<?php echo base_url(''); ?>/wharea/getArea_byWh",
			// 				method: "POST",
			// 				data:{warehouse_id:warehouse_id},
			// 				success:function(data)
			// 				{
			// 					$('#area_id').html(data);
			// 				}
			// 			})
			// 		}
			// 	})

			// 	$('#area_id').change(function(){
			// 		var area_id = $('#area_id').val();
			// 		if(area_id != ''){
			// 			$.ajax({
			// 				url:"<?php echo base_url(''); ?>/blok/getBlok_byArea",
			// 				method: "POST",
			// 				data:{area_id:area_id},
			// 				success:function(data)
			// 				{
			// 					$('#area_id').html(data);
			// 				}
			// 			})
			// 		}
			// 	})
			// });
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
							</select></div><div class="col-4"><label class="font-weight-bold">Quantity<span class="text-danger">*</span></label><div class="input-group"><input type="text" required class="form-control numbers" id="quantity" name="quantity['+x+']" placeholder="Quantity"><span class="input-group-text" id="basic-addon2">BAG</span></div></div><div class="col-1"><label class="font-weight-bold">&nbsp;</label><a href="#" id="remove_field" data-repeater-delete class="btn btn-light-danger btn-md font-weight-bolder form-control">X</a></div></div><div class="separator separator-dashed"></div></div>'); //add input box
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

			$("#po_id").change(function(){ //method pas inbound milih nomor PO
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url("inbound/get_purchase"); ?>",
                    data: { po_id : $("#po_id").val() },
                    dataType: "json",
                    beforeSend: function(e) {
                      if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                      }
                    },
                    success: function(response){
                      $("#do_list").html(response.do_list);
                      calculateSum();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            });

			$("#po_id_2").change(function(){
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url("inbound/get_purchase_2"); ?>",
                    data: { po_id : $("#po_id_2").val() },
                    dataType: "json",
                    beforeSend: function(e) {
                      if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                      }
                    },
                    success: function(response){
                      $("#do_list_2").html(response.do_list);
                      calculateSum();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            });
		</script>
		
		<script type="text/javascript">
			function get_material_price() {
				var material_id = document.getElementById('material_id0').value;
				// console.log(material_id);
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
						document.getElementById('price0').value = result.price;
					}
				})
			}
		</script>
		<!-- end of purchase order and inbound js -->
		<script>
			$(document).ready(function() {
				var max_fields      = 10; //maximum input boxes allowed
				var wrapper         = $(".input_fields_outbound"); //Fields wrapper
				var add_button      = $(".add_field_outbound"); //Add button ID
				var x = 0; //initlal text box count
				$(add_button).click(function(e){ //on add input button click
					e.preventDefault();
						x++; //text box increment
						$(wrapper).append(
							'<div><div class="form-group row"><div class="col-6"><label class="font-weight-bold">Material<span class="text-danger">*</span></label><select class="select form-control custom-select showproduct" id="material_id'+x+'" name="material_id[]"><option></option><?php
							if (@$material) :
								foreach ($material as $row) :
							?>
							<option value="<?= $row->material_id ?>"><?= $row->material_name ?>
							</option><?php endforeach; endif; ?>
							</select></div><div class="col-5"><label class="font-weight-bold">Quantity<span class="text-danger">*</span></label><div class="input-group"><input type="text" class="form-control numbers" id="quantity" name="quantity['+x+']" placeholder="Quantity"></div></div><div class="col-1"><label class="font-weight-bold">&nbsp;</label><a href="#" id="remove_field" data-repeater-delete class="btn btn-light-danger btn-md font-weight-bolder form-control">X</a></div></div><div class="separator separator-dashed"></div></div>'); //add input box
							// Use Javascript
						$('.select').select2({
							placeholder: 'Select an option'
						});
				});
					
				$(wrapper).on("click","#remove_field", function(e){ //user click on remove text
					e.preventDefault(); $(this).parent('div').parent('div').parent('div').remove(); x--;
				});
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function() {
				var value = $('#po_id').find(':selected').data('val');
				document.getElementById("supplier").value = "";
				$('#po_id').change(function() {
				var value = $('#po_id').find(':selected').data('val');
				document.getElementById("supplier").value = value;
				});
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function() {
				var value = $('#po_id_2').find(':selected').data('val');
				document.getElementById("supplier").value = "";
				$('#po_id_2').change(function() {
				var value = $('#po_id_2').find(':selected').data('val');
				document.getElementById("supplier").value = value;
				});
			});
		</script>
		<script type="text/javascript">
			var x = 0;
			var x_ng = 0;
			$(document).ready(function() {
				var max_fields         = 10; //maximum input boxes allowed
				var max_fields_ng      = 10; //maximum input boxes allowed
				var wrapper            = $(".input_fields_loc"); //Fields wrapper
				var wrapper_ng         = $(".input_fields_loc_ng"); //Fields wrapper
				var add_button         = $(".add_field_loc"); //Add button ID
				var add_button_ng      = $(".add_field_loc_ng"); //Add button ID
				 //initlal text box count
				$(add_button).click(function(e){ //on add input button click
					e.preventDefault();
						x++; //text box increment
						var i;
						var good = document.getElementById("qty_good").value;
						var not_good = 0;
						var total = parseInt(good) + parseInt(not_good);
						
						var qty_all = 0;
						for (i = 0; i < x; i++) {
							var qty = document.getElementById("quantity"+i+"").value;
							console.log(qty);
							console.log(x);
							if(qty === null || qty === "" || qty === 0){

							}else {
								qty_all = qty_all + parseInt(qty);
							}
						}
						if( qty_all >= total){
							x--;
							alert("All product has been located");
						} else {
							$(wrapper).append(
							'<div><div class="form-group row"><div class="col-6"><label class="font-weight-bold">Area<span class="text-danger">*</span></label><select class="select form-control custom-select showproduct" value="<?= old('area_id'); ?>" id="area_id'+x+'" name="area_id[]"><option></option><?php
							if (@$warehouse_area) :
								foreach ($warehouse_area as $row) :
							?>
							 <option value="<?= $row->area_id ?>"><?= $row->wh_area_name ?>
							 </option><?php endforeach; endif; ?>
							 </select></div><div class="col-5"><label class="font-weight-bold">Block<span class="text-danger">*</span></label><div class="input-group"><select class="select form-control custom-select showproduct" value="<?= old('blok_id'); ?>" id="blok_id'+x+'" name="blok_id['+x+']"><option></option>'
                            +'</select></div></div><div class="col-1"></div></div><div class="form-group row"><div class="col-6"><label class="font-weight-bold">Rack<span class="text-danger">*</span></label><select class="select form-control custom-select showproduct" value="<?= old('rak_id'); ?>" id="rak_id'+x+'" name="rak_id['+x+']"><option></option>'
							+'</select></div><div class="col-5"><label class="font-weight-bold">Shelf<span class="text-danger">*</span></label><div class="input-group"><select class="select form-control custom-select showproduct" value="<?= old('shelf_id'); ?>" id="shelf_id'+x+'" name="shelf_id['+x+']"><option></option>'
							+'</select></div></div><div class="col-1"></div></div><div class="form-group row"><div class="col-6"><label class="font-weight-bold">Shelf Availability</label><div class="input-group"><input type="text" class="form-control " value="" id="sisa_kosong'+x+'" name="sisa_kosong['+x+']" placeholder="Shelf Availability"></div></div><div class="col-5"><label class="font-weight-bold">Qty<span class="text-danger">*</span></label><div class="input-group"><input type="text" class="form-control numbers" value="" id="quantity'+x+'" name="quantity['+x+']" placeholder="Quantity"></div></div><div class="col-1"><label class="font-weight-bold">&nbsp;</label><a href="#" id="remove_field" data-repeater-delete class="btn btn-light-danger btn-md font-weight-bolder form-control">X</a></div></div><div class="separator separator-dashed"></div></div>'
							); //add input box
							// Use Javascript
						$('.select').select2({
							placeholder: 'Select an option'
						});

						$('#area_id'+x+'').change(function () {
							var area_id = document.getElementById('area_id'+x+'').value;
							// console.log(area_id);
							$.ajax({
								method: 'POST',
								url: "<?php echo site_url("/location/get_blok"); ?>",
								beforeSend: function () {
								},
								dataType: "json",
								data: {
									area_id : area_id,
								},
								success: function (result) {
									document.getElementById('blok_id'+x+'').innerHTML = result.blok;
								}
							})
						});

						$('#blok_id'+x+'').change(function () {
							var blok_id = document.getElementById('blok_id'+x+'').value;
							// console.log(area_id);
							$.ajax({
								method: 'POST',
								url: "<?php echo site_url("/location/get_rak"); ?>",
								beforeSend: function () {
								},
								dataType: "json",
								data: {
									blok_id : blok_id,
								},
								success: function (result) {
									document.getElementById('rak_id'+x+'').innerHTML = result.rak;
								}
							})
						});

						$('#rak_id'+x+'').change(function () {
							var rak_id = document.getElementById('rak_id'+x+'').value;
							// console.log(area_id);
							$.ajax({
								method: 'POST',
								url: "<?php echo site_url("/location/get_shelf"); ?>",
								beforeSend: function () {
								},
								dataType: "json",
								data: {
									rak_id : rak_id,
								},
								success: function (result) {
									document.getElementById('shelf_id'+x+'').innerHTML = result.shelf;
								}
							})
						});

						$('#shelf_id'+x+'').change(function () {
							var shelf_id = document.getElementById('shelf_id'+x+'').value;
							// console.log(area_id);
							$.ajax({
								method: 'POST',
								url: "<?php echo site_url("/location/get_availability"); ?>",
								beforeSend: function () {
								},
								dataType: "json",
								data: {
									shelf_id : shelf_id,
								},
								success: function (result) {
									console.log(result);
									document.getElementById('sisa_kosong'+x+'').value = result.avail;
								}
							})
						});

						}
						
				});

				$(add_button_ng).click(function(e){ //on add input button click
					e.preventDefault();
						x_ng++; //text box increment
						var i;
						var good = 0;
						var not_good = document.getElementById("qty_not_good").value;
						var total = parseInt(good) + parseInt(not_good);
						console.log('material ng ' + total);
						var qty_all = 0;
						for (i = 0; i < x_ng; i++) {
							var qty = document.getElementById("quantity_ng"+i+"").value;
							if(qty === null || qty === "" || qty === 0){

							}else {
								qty_all = qty_all + parseInt(qty);
							}
						}
						console.log(qty_all);
						if( qty_all >= total){
							alert("All material has been located");
							x_ng--;
						} else {
							$(wrapper_ng).append(
							'<div><div class="form-group row"><div class="col-6"><label class="font-weight-bold">Area<span class="text-danger">*</span></label><select class="select form-control custom-select showproduct" value="<?= old('area_id'); ?>" id="area_id_ng'+x_ng+'" name="area_id_ng[]"><option></option><?php
							if (@$warehouse_area_ng) :
								foreach ($warehouse_area_ng as $row) :
							?>
							 <option value="<?= $row->area_id ?>"><?= $row->wh_area_name ?>
							 </option><?php endforeach; endif; ?>
							 </select></div><div class="col-5"><label class="font-weight-bold">Block<span class="text-danger">*</span></label><div class="input-group"><select class="select form-control custom-select showproduct" value="<?= old('blok_id'); ?>" id="blok_id_ng'+x_ng+'" name="blok_id_ng['+x_ng+']"><option></option>'
                            +'</select></div></div><div class="col-1"></div></div><div class="form-group row"><div class="col-6"><label class="font-weight-bold">Rack<span class="text-danger">*</span></label><select class="select form-control custom-select showproduct" value="<?= old('rak_id'); ?>" id="rak_id_ng'+x_ng+'" name="rak_id_ng['+x_ng+']"><option></option>'
							+'</select></div><div class="col-5"><label class="font-weight-bold">Shelf<span class="text-danger">*</span></label><div class="input-group"><select class="select form-control custom-select showproduct" value="<?= old('shelf_id'); ?>" id="shelf_id_ng'+x_ng+'" name="shelf_id_ng['+x_ng+']"><option></option>'
							+'</select></div></div><div class="col-1"></div></div><div class="form-group row"><div class="col-6"><label class="font-weight-bold">Shelf Availability</label><div class="input-group"><input type="text" class="form-control " value="" id="sisa_kosong_ng'+x_ng+'" name="sisa_kosong_ng['+x_ng+']" placeholder="Shelf Availability"></div></div><div class="col-5"><label class="font-weight-bold">Qty<span class="text-danger">*</span></label><div class="input-group"><input type="text" class="form-control numbers" value="" id="quantity_ng'+x_ng+'" name="quantity_ng['+x_ng+']" placeholder="Quantity"></div></div><div class="col-1"><label class="font-weight-bold">&nbsp;</label><a href="#" id="remove_field_ng" data-repeater-delete class="btn btn-light-danger btn-md font-weight-bolder form-control">X</a></div></div><div class="separator separator-dashed"></div></div>'
							); //add input box
							// Use Javascript
						$('.select').select2({
							placeholder: 'Select an option'
						});

						$('#area_id_ng'+x_ng+'').change(function () {
							var area_id = document.getElementById('area_id_ng'+x_ng+'').value;
							// console.log(area_id);
							$.ajax({
								method: 'POST',
								url: "<?php echo site_url("/location/get_blok"); ?>",
								beforeSend: function () {
								},
								dataType: "json",
								data: {
									area_id : area_id,
								},
								success: function (result) {
									document.getElementById('blok_id_ng'+x_ng+'').innerHTML = result.blok;
								}
							})
						});

						$('#blok_id_ng'+x_ng+'').change(function () {
							var blok_id = document.getElementById('blok_id_ng'+x_ng+'').value;
							// console.log(area_id);
							$.ajax({
								method: 'POST',
								url: "<?php echo site_url("/location/get_rak"); ?>",
								beforeSend: function () {
								},
								dataType: "json",
								data: {
									blok_id : blok_id,
								},
								success: function (result) {
									document.getElementById('rak_id_ng'+x_ng+'').innerHTML = result.rak;
								}
							})
						});

						$('#rak_id_ng'+x_ng+'').change(function () {
							var rak_id = document.getElementById('rak_id_ng'+x_ng+'').value;
							// console.log(area_id);
							$.ajax({
								method: 'POST',
								url: "<?php echo site_url("/location/get_shelf"); ?>",
								beforeSend: function () {
								},
								dataType: "json",
								data: {
									rak_id : rak_id,
								},
								success: function (result) {
									document.getElementById('shelf_id_ng'+x_ng+'').innerHTML = result.shelf;
								}
							})
						});

						$('#shelf_id_ng'+x_ng+'').change(function () {
							var shelf_id = document.getElementById('shelf_id_ng'+x_ng+'').value;
							// console.log(area_id);
							$.ajax({
								method: 'POST',
								url: "<?php echo site_url("/location/get_availability"); ?>",
								beforeSend: function () {
								},
								dataType: "json",
								data: {
									shelf_id : shelf_id,
								},
								success: function (result) {
									console.log(result);
									document.getElementById('sisa_kosong_ng'+x_ng+'').value = result.avail;
								}
							})
						});

						}
						
				});
					
				$(wrapper).on("click","#remove_field", function(e){ //user click on remove text
					e.preventDefault(); $(this).parent('div').parent('div').parent('div').remove(); x--;
				});

				$(wrapper_ng).on("click","#remove_field_ng", function(e){ //user click on remove text
					e.preventDefault(); $(this).parent('div').parent('div').parent('div').remove(); x_ng--;
				});
			});

			function validate_form(){
				var i;
				var good = document.getElementById("qty_good").value;
				var not_good = document.getElementById("qty_not_good").value;
				var total = parseInt(good) + parseInt(not_good);

				var qty_good = 0;
				var qty_ng   = 0;
				var qty_all  = 0;
				for (i = 0; i <= x; i++) {
					var qty = document.getElementById("quantity"+i+"").value;
					if(qty === null || qty === ''){
						qty = 0;
					}
					qty_all = qty_all + parseInt(qty);
					qty_good = qty_good + parseInt(qty);
				}
				for (i = 0; i <= x_ng; i++) {
					var qty = document.getElementById("quantity_ng"+i+"").value;
					if(qty === null || qty === ''){
						qty = 0;
					}
					qty_all = qty_all + parseInt(qty);
					qty_ng = qty_ng + parseInt(qty);
				}

				if(qty_good === null || qty_good === ''){
					qty_good = 0;
				}
				// console.log(document.getElementById("quantity_ng0").value);

				if(qty_ng === null || qty_ng === ''){
					qty_ng = 0;
				}
				console.log('qty good ' + qty_good);
				console.log(qty_ng);
				if(qty_all !== total){
					alert("Product quantity doesn't match");
					return false;
				}
			}

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
		<script type='text/javascript'>
			function get_mat_onshelf(idx) {
				var shelf_id = document.getElementById('shelfmats'+idx+'').value;

				// AJAX request
				$.ajax({
					url: 'location/get_material_byshelf',
					type: 'post',
					data: {shelf_id: shelf_id},
					success: function(response){ 
						// Add response in Modal body
						// console.log(response);
						$('.modal-body').html(response); 

						// Display Modal
						$('#shelfmats').modal('show'); 
					}
				});
			}

			function get_shipping_detail(idx) {
				var do_id = document.getElementById('do_id_'+idx+'').value;
				console.log(do_id);
				// AJAX request
				$.ajax({
					url: 'outbounddo/get_shipping_detail',
					type: 'post',
					data: {do_id: do_id},
					success: function(response){ 
						// Add response in Modal body
						// console.log(response);
						$('.modal-body').html(response); 

						// Display Modal
						$('#shipping_detail').modal('show'); 
					}
				});
			}

			function view_privilege(idx) {
				var level_id = document.getElementById('user_level'+idx+'').value;
				console.log(level_id);
				// AJAX request
				$.ajax({
					url: 'privilege/getLevelAccess',
					type: 'post',
					data: {level_id: level_id},
					success: function(response){ 
						// Add response in Modal body
						// console.log(response);
						$('.modal-body').html(response); 

						// Display Modal
						$('#shelfmats').modal('show'); 
					}
				});
			}
		</script>

		<script type="text/javascript">
			function get_blok() {
				var area_id = document.getElementById('area_id0').value;
				// console.log(area_id);
				$.ajax({
					method: 'POST',
					url: "<?php echo site_url("/location/get_blok"); ?>",
					beforeSend: function () {
					},
					dataType: "json",
					data: {
						area_id : area_id,
					},
					success: function (result) {
						document.getElementById('blok_id0').innerHTML = result.blok;
					}
				})
			}

			function get_rak() {
				var blok_id = document.getElementById('blok_id0').value;
				// console.log(area_id);
				$.ajax({
					method: 'POST',
					url: "<?php echo site_url("/location/get_rak"); ?>",
					beforeSend: function () {
					},
					dataType: "json",
					data: {
						blok_id : blok_id,
					},
					success: function (result) {
						document.getElementById('rak_id0').innerHTML = result.rak;
					}
				})
			}

			function get_shelf() {
				var rak_id = document.getElementById('rak_id0').value;
				// console.log(area_id);
				$.ajax({
					method: 'POST',
					url: "<?php echo site_url("/location/get_shelf"); ?>",
					beforeSend: function () {
					},
					dataType: "json",
					data: {
						rak_id : rak_id,
					},
					success: function (result) {
						document.getElementById('shelf_id0').innerHTML = result.shelf;
					}
				})
			}

			function get_avail() {
				var shelf_id = document.getElementById('shelf_id0').value;
				// console.log(area_id);
				$.ajax({
					method: 'POST',
					url: "<?php echo site_url("/location/get_availability"); ?>",
					beforeSend: function () {
					},
					dataType: "json",
					data: {
						shelf_id : shelf_id,
					},
					success: function (result) {
						console.log(result);
						document.getElementById('sisa_kosong0').value = result.avail;
					}
				})
			}

			function get_blok_ng() {
				var area_id = document.getElementById('area_id_ng0').value;
				// console.log(area_id);
				$.ajax({
					method: 'POST',
					url: "<?php echo site_url("/location/get_blok"); ?>",
					beforeSend: function () {
					},
					dataType: "json",
					data: {
						area_id : area_id,
					},
					success: function (result) {
						document.getElementById('blok_id_ng0').innerHTML = result.blok;
					}
				})
			}

			function get_rak_ng() {
				var blok_id = document.getElementById('blok_id_ng0').value;
				// console.log(area_id);
				$.ajax({
					method: 'POST',
					url: "<?php echo site_url("/location/get_rak"); ?>",
					beforeSend: function () {
					},
					dataType: "json",
					data: {
						blok_id : blok_id,
					},
					success: function (result) {
						document.getElementById('rak_id_ng0').innerHTML = result.rak;
					}
				})
			}

			function get_shelf_ng() {
				var rak_id = document.getElementById('rak_id_ng0').value;
				// console.log(area_id);
				$.ajax({
					method: 'POST',
					url: "<?php echo site_url("/location/get_shelf"); ?>",
					beforeSend: function () {
					},
					dataType: "json",
					data: {
						rak_id : rak_id,
					},
					success: function (result) {
						document.getElementById('shelf_id_ng0').innerHTML = result.shelf;
					}
				})
			}

			function get_avail_ng() {
				var shelf_id = document.getElementById('shelf_id_ng0').value;
				// console.log(area_id);
				$.ajax({
					method: 'POST',
					url: "<?php echo site_url("/location/get_availability"); ?>",
					beforeSend: function () {
					},
					dataType: "json",
					data: {
						shelf_id : shelf_id,
					},
					success: function (result) {
						console.log(result);
						document.getElementById('sisa_kosong_ng0').value = result.avail;
					}
				})
			}
		</script>
		<script type="text/javascript">
			function get_city() {
				var state_id = document.getElementById('state_id').value;
				// console.log(area_id);
				$.ajax({
					method: 'POST',
					url: "<?php echo site_url("/warehouse/get_city"); ?>",
					beforeSend: function () {
					},
					dataType: "json",
					data: {
						state_id : state_id,
					},
					success: function (result) {
						document.getElementById('city_id').innerHTML = result.city;
					}
				})
			}

			function get_district() {
				var city_id = document.getElementById('city_id').value;
				// console.log(area_id);
				$.ajax({
					method: 'POST',
					url: "<?php echo site_url("/warehouse/get_district"); ?>",
					beforeSend: function () {
					},
					dataType: "json",
					data: {
						city_id : city_id,
					},
					success: function (result) {
						document.getElementById('district_id').innerHTML = result.district;
					}
				})
			}

			function get_sub_district() {
				var district_id = document.getElementById('district_id').value;
				// console.log(area_id);
				$.ajax({
					method: 'POST',
					url: "<?php echo site_url("/warehouse/get_sub_district"); ?>",
					beforeSend: function () {
					},
					dataType: "json",
					data: {
						district_id : district_id,
					},
					success: function (result) {
						document.getElementById('sdistrict_id').innerHTML = result.sub_district;
					}
				})
			}
		</script>

		<!-- JS UNTUK OUTBOUND -->
		<script type="text/javascript">
			function pilihJenisTarifOutbound() {
				var admin_fee = document.getElementById("admin_fee").value;
				if (admin_fee == 'sales') {
					var w = document.getElementById("tariff_admin_sales");
					var x = document.getElementById("tariff_packing_sales");
					w.style.display = "block";
					x.style.display = "block";
				}
				if (admin_fee != 'sales' && admin_fee != null) {
					var w = document.getElementById("tariff_admin_sales");
					var x = document.getElementById("tariff_packing_sales");
					w.style.display = "none";
					x.style.display = "none";
				}
			}
		</script>	
		<script type="text/javascript">
        $(document).ready(function(){
 
            $('#wh_id_master').change(function(){ 
                var id=$(this).val();

                $.ajax({
                    url : "<?php echo site_url('blok/get_wh_area');?>",
                    method : "POST",
                    data : {warehouse_id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        var html = '<option value="" selected></option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].area_id+'>'+data[i].wh_area_name+'</option>';
                        }
                        $('#area_id_master').html(html);
 
                    }
                });
                return false;
            }); 
             
			$('#area_id_master').change(function(){ 
                var id=$(this).val();
				//alert(id);
                $.ajax({
                    url : "<?php echo site_url('rak/get_block');?>",
                    method : "POST",
                    data : {area_id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        var html = '<option value="" selected></option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].blok_id+'>'+data[i].blok_name+'</option>';
                        }
                        $('#blok_id_master').html(html);
 
                    }
                });
                return false;
            });

			$('#blok_id_master').change(function(){ 
                var id=$(this).val();
				//alert(id);
                $.ajax({
                    url : "<?php echo site_url('shelf/get_rak');?>",
                    method : "POST",
                    data : {rak_id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        var html = '<option value="" selected></option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].rak_id+'>'+data[i].rak_name+'</option>';
                        }
                        $('#rak_id_master').html(html);
 
                    }
                });
                return false;
            }); 

			// $('#owner_id_outbound').change(function(){ 
            //     var id=$(this).val();
			// 	var id_wh=$('#warehouse_id_outbound').val();
			// 	//alert(id);
            //     $.ajax({
            //         url : "<?php echo site_url('outbound/get_material_byowner');?>",
            //         method : "POST",
            //         data : {owner_id: id, warehouse_id: id_wh},
            //         async : true,
            //         dataType : 'json',
            //         success: function(data){
                         
            //             var html = '<option value="" selected></option>';
            //             var i;
            //             for(i=0; i<data.length; i++){
            //                 html += '<option value='+data[i].mat_detail_id+'>'+data[i].material_name+' - exp:'+data[i].expired_date+' - batch:'+data[i].batch_no+'</option>';
            //             }
						
            //             $('#material_id_outbound').html(html);
 
            //         }
            //     });
            //     return false;
            // });

			// $('#warehouse_id_outbound').change(function(){ 
            //     var id=$('#owner_id_outbound').val();
			// 	var id_wh=$(this).val();
			// 	//alert(id);
            //     $.ajax({
            //         url : "<?php echo site_url('outbound/get_material_byowner');?>",
            //         method : "POST",
            //         data : {owner_id: id, warehouse_id: id_wh},
            //         async : true,
            //         dataType : 'json',
            //         success: function(data){
                         
            //             var html = '<option value="" selected></option>';
            //             var i;
            //             for(i=0; i<data.length; i++){
            //                 html += '<option value='+data[i].mat_detail_id+'>'+data[i].material_name+' - exp:'+data[i].expired_date+' - batch:'+data[i].batch_no+'</option>';
            //             }
						
            //             $('#material_id_outbound').html(html);
 
            //         }
            //     });
            //     return false;
            // });

			$('#material_id_outbound').change(function(){ 
				var owner_id=$('#owner_id_outbound').val();
				var id_wh=$('#warehouse_id_outbound').val();
				var id=$('#material_id_outbound').val();
				
				//alert(id);
                $.ajax({
                    url : "<?php echo site_url('outbound/get_location_bymaterial');?>",
                    method : "POST",
                    data : {owner_id: owner_id, warehouse_id: id_wh, material_id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        // console.log(data);
                        var html = '<option value="" selected></option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].location_id+'>'+data[i].wh_area_name+'-'+data[i].blok_name+'-'+data[i].rak_name+'-'+data[i].shelf_name+'</option>';
                        }
						
                        $('#location_id_outbound').html(html);
 
                    }
                });
                return false;
            });

			$('#location_id_outbound').change(function(){ 
				var owner_id=$('#owner_id_outbound').val();
				var id_wh=$('#warehouse_id_outbound').val();
				var mat_id=$('#material_id_outbound').val();
				var id=$(this).val();
				console.log(id_wh);
				console.log(owner_id);
				console.log(mat_id);
				console.log(id);
				//alert(id);
                $.ajax({
                    url : "<?php echo site_url('outbound/get_qty_bylocation');?>",
                    method : "POST",
                    data : {owner_id: owner_id, warehouse_id: id_wh, material_id: mat_id, location_id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         console.log(data);
                        //var html = '<option value="" selected></option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            $('#qty_outbound').val(data[i].qty);
                            $('#material_id_model_choose_product').val(data[i].material_id);
							//html += '<option value='+data[i].location_id+'>'+data[i].wh_area_name+'-'+data[i].blok_name+'-'+data[i].rak_name+'-'+data[i].shelf_name+'</option>';
                        }
						
                    }
                });
                return false;
            });
        });
		//---- method add po versi dua. untuk yang di modalnya js nya ada tepat di atas ^
		$('#po_outbound_id').change(function(){ 
                var id=$(this).val();
				let id_owner;
				let id_wh;

				// method untuk munculin data di form
                $.ajax({
                    url : "<?php echo site_url('outboundpo/get_outbound_byid');?>",
                    method : "POST",
                    data : {po_outbound_id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
						// console.log(data);
						// $('#doc_number').val(data.po_outbound_doc);
						var data_po = JSON.stringify(data);
						var json = JSON.parse(data_po);
						// console.log(json.po_outbound_doc);
						
						$('#doc_number').val(json.po_outbound_doc);
						$('#customer_id').val(json.po_penerima);
						$('#customer_name').val(json.customer_name);
						$('#warehouse_id_outbound').val(json.warehouse_id);
						$('#warehouse_name').val(json.wh_name);
						$('#owner_id_outbound').val(json.owners_id);
						$('#owners_name').val(json.owners_name);
						id_wh = json.warehouse_id;
						id_owner = json.owners_id;
						console.log(id_owner);
						$.ajax({
							url : "<?php echo site_url('outbound/get_material_byowner');?>",
							method : "POST",
							data : {owner_id: id_owner, warehouse_id: id_wh},
							async : true,
							dataType : 'json',
							success: function(data){
								
								console.log(data);
								var html = '<option value="" selected></option>';
								var i;
								for(i=0; i<data.length; i++){
									html += '<option value='+data[i].mat_detail_id+'>'+data[i].material_name+' - exp:'+data[i].expired_date+' - batch:'+data[i].batch_no+'</option>';
								}
								$('#material_id_outbound').html(html);
		
							}
						});
                    }
                });

				
				//alert(id);
               
				// method buat munculin data di table
				$.ajax({
                    url : "<?php echo site_url('outboundpo/get_outbound_detail');?>",
                    method : "POST",
                    data : {po_outbound_id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
						console.log(data);
						// $('#doc_number').val(data.po_outbound_doc);
						// var data_po = JSON.stringify(data);
						// var json = JSON.parse(data_po);
						$("#tbl_ref").html("");
                        var html = '<option value="" selected></option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            $('#tbl_ref').append('<tr><td>'+data[i].material_id+'</td><td>'+data[i].material_name+'</td><td>'+data[i].outbound_qty+' '+data[i].uom_name+'(s)</td></tr>');
                        }
						
                        // $('#tbl_ref').html(html);
 
                    }
                });
				// get packaging material berdasarkan id po nya. (ide)
				
                return false;
            });

		// untuk outbound po catatan: besok buat outbound nya kaya outbound plan aja. tp di modalnya isinya material aja.
		function get_material_outbound() {
			var state_id = document.getElementById('state_id').value;
			// console.log(area_id);
			$.ajax({
				method: 'POST',
				url: "<?php echo site_url("/warehouse/get_city"); ?>",
				beforeSend: function () {
				},
				dataType: "json",
				data: {
					state_id : state_id,
				},
				success: function (result) {
					document.getElementById('city_id').innerHTML = result.city;
				}
			})
		}

		// $(document).ready(function() {
		// 		var max_fields      = 10; //maximum input boxes allowed
		// 		var wrapper         = $(".input_fields_outbound_po"); //Fields wrapper
		// 		var add_button      = $(".add_field_button"); //Add button ID
		// 		var x = 0; //initlal text box count
		// 		$(add_button).click(function(e){ //on add input button click
		// 			e.preventDefault();
		// 				x++; //text box increment
		// 				$(wrapper).append(
		// 					'<div><div class="form-group row"><div class="col-6"><label class="font-weight-bold">Material<span class="text-danger">*</span></label><select class="select form-control custom-select showproduct" id="material_id'+x+'" name="material_id[]"><option></option><?php
		// 					if (@$material) :
		// 						foreach ($material as $row) :
		// 					?>
		// 					<option value="<?php //echo $row->material_id ?>"><?php // echo $row->material_name ?>
		// 					</option><?php // endforeach; endif; ?>
		// 					</select></div><div class="col-5"><label class="font-weight-bold">Quantity<span class="text-danger">*</span></label><div class="input-group"><input type="text" class="form-control numbers" id="quantity" name="quantity['+x+']" placeholder="Quantity"></div></div><div class="col-1"><label class="font-weight-bold">&nbsp;</label><a href="#" id="remove_field" data-repeater-delete class="btn btn-light-danger btn-md font-weight-bolder form-control">X</a></div></div><div class="separator separator-dashed"></div></div>'); //add input box
		// 					// Use Javascript
		// 				$('.select').select2({
		// 					placeholder: 'Select an option'
		// 				});
		// 		});
					
		// 		$(wrapper).on("click","#remove_field", function(e){ //user click on remove text
		// 			e.preventDefault(); $(this).parent('div').parent('div').parent('div').remove(); x--;
		// 		});
		// 	});

		$('#warehouse_id_outboundpo').change(function(){ 
                var id=$('#owner_id_outbound').val();
				var id_wh=$(this).val();
				//alert(id);
                $.ajax({
                    url : "<?php echo site_url('outboundpo/get_material_byowner');?>",
                    method : "POST",
                    data : {owner_id: id, warehouse_id: id_wh},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        var html = '<option value="" selected></option>';
                        var i;
                        for(i=0; i<data.length; i++){
							if(data[i].material_weight === data[i].weight_comparison && data[i].material_height === data[i].height_comparison &&
							data[i].material_length === data[i].length_comparison && data[i].material_width === data[i].width_comparison){
                            	html += '<option value='+data[i].material_id+'>'+data[i].material_name+'</option>';
							}
                        }
                        $('#material_id_outboundpo').html(html);
 
                    }
                });
                return false;
            });
		
			$('#material_id_outboundpo').change(function(){ 
				var owner_id=$('#owner_id_outbound').val();
				var id_wh=$('#warehouse_id_outboundpo').val();
				var id=$(this).val();
				var formatter = new Intl.NumberFormat('id-ID', {
					style: 'currency',
					currency: 'IDR',

					// These options are needed to round to whole numbers if that's what you want.
					//minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
					//maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
				});
				//alert(id);
                $.ajax({
                    url : "<?php echo site_url('outboundpo/get_qty_bylocation');?>",
                    method : "POST",
                    data : {owner_id: owner_id, warehouse_id: id_wh, material_id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data) {
                        //var html = '<option value="" selected></option>';
                        var i;
                        for(i=0; i<data.length; i++){
							total_qty = data[i].qty - data[i].reserved_qty;
							var volume = data[i].material_length * data[i].material_height * data[i].material_width;

							// RUMUS = 2 × (p.l + p.t +l.t)
							var luasPermukaan = 2 * ((data[i].material_length * data[i].material_width) + (data[i].material_length * data[i].material_height) + (data[i].material_width * data[i].material_height));
							
							$('#material_volume').val(volume);
							$('#material_luas_permukaan').val(luasPermukaan);
                            $('#qty_outbound').val(total_qty);
                            $('#material_price_outbound').val(formatter.format(data[i].material_price));
                            $('#material_price_val').val(data[i].material_price);
							//html += '<option value='+data[i].location_id+'>'+data[i].wh_area_name+'-'+data[i].blok_name+'-'+data[i].rak_name+'-'+data[i].shelf_name+'</option>';
                        }
						
                    }
                });

                $.ajax({
                    url : "<?php echo site_url('outboundpo/get_qty_bylocation_po');?>",
                    method : "POST",
                    data : {owner_id: owner_id, warehouse_id: id_wh, material_id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        //var html = '<option value="" selected></option>';
                        var i;
                        for(i=0; i<data.length; i++){
							$('#qty_outbound_ng').val(data[i].qty);
							if(data[i].qty === null || data[i].qty === ''){
								$('#qty_outbound_ng').val(0);	
							}
							//html += '<option value='+data[i].location_id+'>'+data[i].wh_area_name+'-'+data[i].blok_name+'-'+data[i].rak_name+'-'+data[i].shelf_name+'</option>';
                        }
						
                    }
                });
                return false;
            });
    </script>

	<script type="text/javascript">
		var j = 0;
		function setTable(){
			var material_id_master = document.getElementById('material_id_model_choose_product').value;
			var material = document.getElementById('material_id_outbound');
			var location = document.getElementById('location_id_outbound');
			var material_id_outbound = document.getElementById('material_id_outbound').value;
			var location_id = document.getElementById('location_id_outbound').value;
			var quantity = document.getElementById('quantity').value;
			var stock = document.getElementById('qty_outbound').value;

			if(parseInt(quantity) > parseInt(stock)){
				alert('Quantity out of stock!')
			} else {
				$('#tbl_material').append('<tr id="row'+j+'"><td>'+material_id_outbound+'</td><td>'+material.options[material.selectedIndex].text+'<input type="hidden" name="material_id_master[]" value="'+material_id_master+'"><input type="hidden" name="material_id[]" value="'+material_id_outbound+'"><input type="hidden" name="location[]" value="'+location_id+'"></td><td>'+location.options[location.selectedIndex].text+'</td><td>'+quantity+'<input type="hidden" name="quantity[]" value="'+quantity+'"></td><td><a href="javascript:;" class="label label-danger" onclick="removeRowOut(\'row'+j+'\')"><span class="fa fa-times"></span></a></td></tr>');
				j++;

				document.getElementById('quantity').value = "";
				$('#material_id_outbound').val(null).trigger('change');
				$('#qty_outbound').val(null);
				$('#modalMaterial').modal('hide');
			}
		}

		function removeRowOut(rowid){
			var row = document.getElementById(rowid);
			row.parentNode.removeChild(row);j--;
		}
	</script>

<script type="text/javascript">
		var j = 0;
		var item = 0;
		function setTablePO(){
			var material = document.getElementById('material_id_outboundpo');
			var material_id_outbound = document.getElementById('material_id_outboundpo').value;
			var quantity = document.getElementById('quantity').value;
			var material_volume = document.getElementById('material_volume').value;
			var material_luas_permukaan = document.getElementById('material_luas_permukaan').value;
			var price = document.getElementById('material_price_val').value;
			var stock = document.getElementById('qty_outbound').value;
			var formatter = new Intl.NumberFormat('id-ID', {
				style: 'currency',
				currency: 'IDR',

				// These options are needed to round to whole numbers if that's what you want.
				//minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
				//maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
			});
			var total_volume = material_volume * quantity;
			var total_luas_permukaan = material_luas_permukaan * quantity;
			if(parseInt(quantity) > parseInt(stock)){
				alert('Quantity out of stock!')
			} else if(!quantity || parseInt(quantity) == 0){
				alert('Please fill the quantity')
			} else {
				var status_ = true;
				$('.rowTbl').each(function(x,y){
					var cIdx = $(this).attr('data-attr');
					var kode = $('#material_id'+cIdx).val();
					if(kode == material_id_outbound) {
						status_ = false;
						return;
					}
				});
				if (!status_) {
					document.getElementById('quantity').value = "";
					$('#material_id_outboundpo').val(null).trigger('change');
					$('#qty_outbound').val(null);
					$('#material_price_outbound').val(null);
					$('#material_price_val').val(null);
					$('#qty_outbound_ng').val(null);
					$('#modalMaterial').modal('hide');
					return false;
				}

				item++;
				
				$('#tbl_material').append('<tr data-attr="'+j+'" class="rowTbl" id="row'+j+'"><td>'+material_id_outbound+'</td><td>'+material.options[material.selectedIndex].text
				+'<input type="hidden" id="material_id'+j+'" name="material_id[]" value="'+material_id_outbound+'"><input type="hidden" name="total_volume[]" class="total_volume" value="'+total_volume+'"><input type="hidden" name="total_luas_permukaan[]" class="total_luas_permukaan" value="'+total_luas_permukaan+'"><div id="total_all_volume"></div></td><td>'+quantity+'<input type="hidden" name="quantity['+j+']" value="'
				+quantity+'"></td><td><a href="javascript:;" class="label label-danger" onclick="removeRow(\'row'+j+'\')"><span class="fa fa-times"></span></a></td></tr>');
				j++;
				if(item>0){
					var w = document.getElementById("packaging_card");
					w.style.display = "block";
				}
				document.getElementById('quantity').value = "";
				$('#material_id_outboundpo').val(null).trigger('change');
				$('#qty_outbound').val(null);
				$('#material_price_outbound').val(null);
				$('#material_price_val').val(null);
				$('#qty_outbound_ng').val(null);
				$('#modalMaterial').modal('hide');
				countVolume();
				getBoxRecommendation();
			}
		}

		function countVolume() {
			var total_all_volume = 0;
			$('.total_volume').each(function() {
				total_all_volume += parseInt($(this).val());
			});
			$('#total_all_volume').empty();
			$('#total_all_volume').html('<input type="hidden" name="total_all_volume" class="total_all_volume" value="'+total_all_volume+'"/>');
			
			$.ajax({
				method: 'GET',
				url: "<?php echo site_url('outboundpo/get_packing_kardus?total_all_volume=');?>"+total_all_volume,
				beforeSend: function() {
					$('.showproduct').empty();
				},
				success: function (data) {
					$('.showproduct').html(data);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					var error = {message: errorThrown}
					ErrorMessage(error);
				}
			});
		}

		function removeRow(rowid){
			item--;
			if(item<1){
				var w = document.getElementById("packaging_card");
				w.style.display = "none";
			}
			var row = document.getElementById(rowid);
			row.parentNode.removeChild(row);j--;
			getBoxRecommendation();
		}
	</script>
	<!-- dashboard -->
	<script>
		
		
	</script>
	<!-- dashboard end -->
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
								</select></div><div class="col-4"><label class="font-weight-bold">Layer<span class="text-danger">*</span></label><div class="input-group"><div class="input-group  bootstrap-touchspin bootstrap-touchspin-injected"><input id="quantity'+x+'" type="text" class="form-control kt_touchspin_4 bootstrap-touchspin-vertical-btn" name="pm_qty['+x+']" value="1" onchange="hitung_total('+x+');hitung_material();" onkeypress="return CheckNumeric()"></div></div></div><div class="col-3"><label class="font-weight-bold">Total Material Price<span class="text-danger">*</span></label><div class="input-group"><div class="input-group-append"><span class="input-group-text">Rp.</span></div><input type="hidden" id="subprice'+x+'" /><input type="text" class="form-control numbers"  id="price'+x+'" required name="pm_rate['+x+']" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this);" readonly placeholder="Rate for Each Product"></div></div><div class="col-1"><label class="font-weight-bold">&nbsp;</label><br/><a href="#" id="remove_field" data-repeater-delete class="btn font-weight-bold btn-light-danger btn-icon">X</a></div></div><div class="separator separator-dashed"></div></div>'); //add input box
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
		function get_price() {
			// Get Total All Volume * Quantity
			var totalAllLuasPermukaan = 0;
			$('.total_luas_permukaan').each(function() {
				totalAllLuasPermukaan += parseInt($(this).val());
			});

			// Total luas permukaan ÷ material
			var dimensiMaterial = 0;
			if ($('#pm_id0').select2('data')[0].text.toLowerCase() == "bubble wrap (20x20cm)") dimensiMaterial = 400;
			if ($('#pm_id0').select2('data')[0].text.toLowerCase() == "plastik (10x10cm)") dimensiMaterial = 100;
			if ($('#pm_id0').select2('data')[0].text.toLowerCase() == "lakban fragile (100cm)") dimensiMaterial = 100;
			var totalMaterial = Math.ceil(totalAllLuasPermukaan / dimensiMaterial);

			var subprice = $('#subprice0').val();

			// Harga Material per biji
			var price = $('#pm_id0').select2('data')[0].element.attributes[1].nodeValue.toString(); //buat generate harga packaging material saat pilih material.

			// Total harga material * Harga Material per biji
			var priceTotal = totalMaterial * price;

			$('#price0').val(priceTotal);
			$('#subprice0').val(priceTotal);
			
			// console.log(`Total Luas Permukaan ----> ${totalAllLuasPermukaan}`);
			// console.log(`Total Material yg dibutuhkan ----> ${totalMaterial}`);
			// console.log(`Harga Material per biji ---> ${price}`);
			// console.log(`Harga Material TOTAL ---> ${priceTotal}`);

			// console.log($('#pm_id0').select2('data')[0].text.toLowerCase())
		}

		function get_price2(x) {
			// Get Total All Volume * Quantity
			var totalAllLuasPermukaan2 = 0;
			$('.total_luas_permukaan').each(function() {
				totalAllLuasPermukaan2 += parseInt($(this).val());
			});

			// Total luas permukaan ÷ material
			var dimensiMaterial2 = 0;
			if ($(`#pm_id${x}`).select2('data')[0].text.toLowerCase() == "bubble wrap (20x20cm)") dimensiMaterial2 = 400;
			if ($(`#pm_id${x}`).select2('data')[0].text.toLowerCase() == "plastik (10x10cm)") dimensiMaterial2 = 100;
			if ($(`#pm_id${x}`).select2('data')[0].text.toLowerCase() == "lakban fragile (100cm)") dimensiMaterial2 = 100;
			var totalMaterial2 = Math.ceil(totalAllLuasPermukaan2 / dimensiMaterial2);

			var subprice = $('#subprice'+x+'').val();

			// Harga Material per biji
			var price2 = $('#pm_id'+x+'').select2('data')[0].element.attributes[1].nodeValue.toString();

			// Total harga material * Harga Material per biji
			var priceTotal2 = totalMaterial2 * price2;

			$('#price'+x+'').val(priceTotal2);
			$('#subprice'+x+'').val(priceTotal2);

			// console.log(`Total Luas Permukaan ----> ${totalAllLuasPermukaan2}`);
			// console.log(`Total Material yg dibutuhkan ----> ${totalMaterial2}`);
			// console.log(`Harga Material per biji ---> ${price2}`);
			// console.log(`Harga Material TOTAL ---> ${priceTotal2}`);

			// console.log($('#pm_id'+x+'').select2('data')[0])
		}
	</script>
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

<?php if (@$title == 'Top Up') { ?>
		<script>
			window.onload = function() {
				var aa = document.getElementById("transfer");
				var ii = document.getElementById("virtual_account");
				aa.style.display = "none";
				ii.style.display = "none";
			}

			function TforVa() {
				var type_topup = document.getElementById("type_topup").value;
				if (type_topup == 'Transfer') {
					var x = document.getElementById("transfer");
					var u = document.getElementById("virtual_account");
					x.style.display = "block";
					u.style.display = "none";
					getBankTransaction();
				}

				if (type_topup == 'Virtual Account') {
					var x = document.getElementById("virtual_account");
					var u = document.getElementById("transfer");
					x.style.display = "block";
					u.style.display = "none";
				}
			}

			function getBankAccountUser() {
				var bank_id = document.getElementById("bank_id").value;

				$.ajax({
					method: 'GET',
					url: "<?php echo base_url("/topup/get_information_bank?bank_id="); ?>"+bank_id,
					beforeSend: function() {
						$('#information-bank').empty();
					},
					success: function (data) {
						$('#information-bank').html(data);
					},
					error: function(jqXHR, textStatus, errorThrown) {
						alert('error');
					}
				});
			}

			function getBankTransaction(){
				var bank_transaction = document.getElementById("dest_account").value;
				
				$.ajax({
					method: 'GET',
					url: "<?php echo base_url("/topup/bank_transaction?id="); ?>"+bank_transaction,
					beforeSend: function() {
						$('#information_transaction').empty();
					},
					success: function (data) {
						$('#information_transaction').html(data);
					},
					error: function(jqXHR, textStatus, errorThrown) {
						alert('error');
					}
				});
			}
		</script>
	<?php } ?>

	<!-- Custom JS -->
	<?php
		if(isset($js)){
			echo '<script src="'.base_url().'/theme/dist/assets/js/pages/page_js/'.$js.'"></script>';
		}
	?>
	<!-- END custom JS-->
	
	<!-- <script>
	function getInboundBar()
	{
		var inboundBar = null;
		var updateInboundBar = function(){
			var start_date_dashboard = $('#start_date_dashboard').val();
			var until_date_dashboard = $('#until_date_dashboard').val();
			
			var base_url = "<?= base_url() ?>";
			$.getJSON(base_url + "/dashboard/get_inboundBarChartData?start_date="+start_date_dashboard+"&until_date="+until_date_dashboard+"", function (data) {
					
					var out = JSON.parse(JSON.stringify(data));
					const ctx3 = document.getElementById('myChart3');
					const datas3 = {
					labels:  out.labels,
					datasets: [{
						label: 'Inbound daily',
						data: out.datasets,
						fill: false,
						borderColor: 'rgb(255, 99, 71)',
						tension: 0.1
					}]
				};
				inboundBar = new Chart(ctx3, {
					type: 'bar',
					data: datas3
				}); 
				
				inboundBar.render();	
				// count++;
			}).then(function() {
				// console.log(count);
			});
		}
		
		updateInboundBar();
	}
	</script>
	<script>
		function getOutboundBar()
		{
			var updateOutboundBar = function(){
				var start_date_dashboard_2 = $('#start_date_dashboard_2').val();
				var until_date_dashboard_2 = $('#until_date_dashboard_2').val();
				var base_url = "<?= base_url() ?>";
				$.getJSON(base_url + "/dashboard/get_outboundBarChartData?start_date="+start_date_dashboard_2+"&until_date="+until_date_dashboard_2+"", function (data) {
						var out = JSON.parse(JSON.stringify(data));
						const ctx4 = document.getElementById('myChart4').getContext("2d");
						const datas4 = {
						labels:  out.labels,
						datasets: [{
							label: 'Outbound daily',
							data: out.datasets,
							fill: false,
							borderColor: 'rgb(255, 99, 71)',
							tension: 0.1
						}]
					}; 

					var OutboundBar = new Chart(ctx4, {
						type: 'bar',
						data: datas4
					}); 
					OutboundBar.update();
				});
			}
			updateOutboundBar();
		}
	</script> -->
	</body>
	<!--end::Body-->
</html>