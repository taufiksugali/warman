<!--begin::Footer-->
<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
						<!--begin::Container-->
						<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
							<!--begin::Copyright-->
							<div class="text-dark order-2 order-md-1">
								<span class="text-muted font-weight-bold mr-2">2021©</span>
								<a href="http://keenthemes.com/metronic" target="_blank" class="text-dark-75 text-hover-primary">PT Pos Logistik Indonesia</a>
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
				<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
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
						<i class="symbol-badge bg-success"></i>
					</div>
					<div class="d-flex flex-column">
						<a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?= session()->get('fullname'); ?></a>
						<div class="text-muted mt-1"><?= session()->get('job_title'); ?></div>
						<div class="navi mt-2">
							<a href="#" class="navi-item">
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
		<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/sweetalert.js"></script>
		<!-- <script src="<?= base_url(''); ?>/template/assets/js/pages/crud/datatables/basic/basic.js"></script> -->
		<!-- <script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/sweetalert.js"></script>
		<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/format_numbering.js"></script> -->
		<!--end::Page Scripts-->
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnqACpjEB47TZ4SQf6Fwt6sa6hhAyO5dM&callback=initMap" type="text/javascript"></script>
		<script>
			$('.select').select2({
				placeholder: 'Select an option'
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
		<script type="text/javascript">
			$(document).ready(function() {
				var max_fields      = 10; //maximum input boxes allowed
				var wrapper         = $(".input_fields_wrap"); //Fields wrapper
				var add_button      = $(".add_field_button"); //Add button ID
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

			$("#po_id").change(function(){
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
			$(document).ready(function() {
				var max_fields      = 10; //maximum input boxes allowed
				var wrapper         = $(".add_location"); //Fields wrapper
				var wrapper_ng         = $(".add_location_ng"); //Fields wrapper
				var add_button      = $(".add_field_loc"); //Add button ID
				var add_button_ng      = $(".add_field_loc"); //Add button ID
				 //initlal text box count
				$(add_button).click(function(e){ //on add input button click
					e.preventDefault();
						x++; //text box increment
						var i;
						var good = document.getElementById("qty_good").value;
						var not_good = document.getElementById("qty_not_good").value;
						var total = parseInt(good) + parseInt(not_good);
						
						var qty_all = 0;
						for (i = 0; i < x; i++) {
							var qty = document.getElementById("quantity"+i+"").value;
							qty_all = qty_all + parseInt(qty);
						}
						if( qty_all >= total){
							alert("All material has been located");
						} else {
							$(wrapper).append(
								'<div><div class="form-group row"><div class="col-12"><div class="form-group"><label class="font-weight-bold">Area<span class="text-danger">*</span></label><select class="select form-control custom-select showproduct" value="<?= old('area_id'); ?>" id="area_id'+x+'" name="area_id['+x+']"><option></option><?php 
							if (@$warehouse_area) :
								foreach ($warehouse_area as $row) :
							?>
                            <option value="<?= $row->area_id ?>"><?= $row->wh_area_name ?>
							</option><?php endforeach; endif; ?>
                            </select></div><div class="form-group"><label class="font-weight-bold">Block<span class="text-danger">*</span></label><div class="input-group"><select class="select form-control custom-select showproduct" value="<?= old('blok_id'); ?>" id="blok_id'+x+'" name="blok_id['+x+']"><option></option>'
							+'</select></div></div><div class="form-group"><label class="font-weight-bold">Rack<span class="text-danger">*</span></label><select class="select form-control custom-select showproduct" value="<?= old('material_id'); ?>" id="rak_id'+x+'" name="rak_id['+x+']"><option></option>'
                            +'</select></div><div class="form-group"><label class="font-weight-bold">Shelf<span class="text-danger">*</span></label><div class="input-group"><select class="select form-control custom-select showproduct" value="<?= old('material_id'); ?>" id="shelf_id'+x+'" name="shelf_id['+x+']"><option></option>'
                            +'</select></div></div><div class="form-group row"><div class="col-5"><label class="font-weight-bold">Shelf Availability</label><div class="input-group"><input type="text" readonly class="form-control" id="sisa_kosong'+x+'" name="sisa_kosong['+x+']" placeholder="Shelf Availability"></div></div><div class="col-5"><label class="font-weight-bold">Qty<span class="text-danger">*</span></label><div class="input-group"><input type="text" class="form-control numbers" id="quantity'+x+'" name="quantity['+x+']" placeholder="Quantity"></div></div><div class="col-2"><label class="font-weight-bold">&nbsp;</label><a href="#" id="remove_field" data-repeater-delete class="btn btn-light-danger btn-md font-weight-bolder form-control">X</a></div></div><div class="separator separator-dashed"></div></div></div></div>'
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
						
				}); // end of add good material button

				$(add_button_ng).click(function(e){ //on add input button click
					e.preventDefault();
						x++; //text box increment
						var i;
						var good = document.getElementById("qty_good").value;
						var not_good = document.getElementById("qty_not_good").value;
						var total = parseInt(good) + parseInt(not_good);
						
						var qty_all = 0;
						for (i = 0; i < x; i++) {
							var qty = document.getElementById("quantity"+i+"").value;
							qty_all = qty_all + parseInt(qty);
						}
						if( qty_all >= total){
							alert("All material has been located");
						} else {
							$(wrapper_ng).append(
								'<div><div class="form-group row"><div class="col-12"><div class="form-group"><label class="font-weight-bold">Area<span class="text-danger">*</span></label><select class="select form-control custom-select showproduct" value="<?= old('area_id'); ?>" id="area_id'+x+'" name="area_id['+x+']"><option></option><?php 
							if (@$warehouse_area) :
								foreach ($warehouse_area as $row) :
							?>
                            <option value="<?= $row->area_id ?>"><?= $row->wh_area_name ?>
							</option><?php endforeach; endif; ?>
                            </select></div><div class="form-group"><label class="font-weight-bold">Block<span class="text-danger">*</span></label><div class="input-group"><select class="select form-control custom-select showproduct" value="<?= old('blok_id'); ?>" id="blok_id'+x+'" name="blok_id['+x+']"><option></option>'
							+'</select></div></div><div class="form-group"><label class="font-weight-bold">Rack<span class="text-danger">*</span></label><select class="select form-control custom-select showproduct" value="<?= old('material_id'); ?>" id="rak_id'+x+'" name="rak_id['+x+']"><option></option>'
                            +'</select></div><div class="form-group"><label class="font-weight-bold">Shelf<span class="text-danger">*</span></label><div class="input-group"><select class="select form-control custom-select showproduct" value="<?= old('material_id'); ?>" id="shelf_id'+x+'" name="shelf_id['+x+']"><option></option>'
                            +'</select></div></div><div class="form-group row"><div class="col-5"><label class="font-weight-bold">Shelf Availability</label><div class="input-group"><input type="text" readonly class="form-control" id="sisa_kosong'+x+'" name="sisa_kosong['+x+']" placeholder="Shelf Availability"></div></div><div class="col-5"><label class="font-weight-bold">Qty<span class="text-danger">*</span></label><div class="input-group"><input type="text" class="form-control numbers" id="quantity'+x+'" name="quantity['+x+']" placeholder="Quantity"></div></div><div class="col-2"><label class="font-weight-bold">&nbsp;</label><a href="#" id="remove_field" data-repeater-delete class="btn btn-light-danger btn-md font-weight-bolder form-control">X</a></div></div><div class="separator separator-dashed"></div></div></div></div>'
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
					
				$(wrapper).on("click","#remove_field", function(e){ //user click on remove text
					e.preventDefault(); $(this).parent('div').parent('div').parent('div').remove(); x--;
				});
			});

			function validate_form(){
				var i;
				var good = document.getElementById("qty_good").value;
				var not_good = document.getElementById("qty_not_good").value;
				var total = parseInt(good) + parseInt(not_good);
				
				var qty_all = 0;
				for (i = 0; i <= x; i++) {
					var qty = document.getElementById("quantity"+i+"").value;
					qty_all = qty_all + parseInt(qty);
				}
				if(qty_all !== total){
					alert("Material quantity doesn't match");
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

			$('#owner_id_outbound').change(function(){ 
                var id=$(this).val();
				var id_wh=$('#warehouse_id_outbound').val();
				//alert(id);
                $.ajax({
                    url : "<?php echo site_url('outbound/get_material_byowner');?>",
                    method : "POST",
                    data : {owner_id: id, warehouse_id: id_wh},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        var html = '<option value="" selected></option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].mat_detail_id+'>'+data[i].material_name+' - exp:'+data[i].expired_date+' - batch:'+data[i].batch_no+'</option>';
                        }
						
                        $('#material_id_outbound').html(html);
 
                    }
                });
                return false;
            });

			$('#warehouse_id_outbound').change(function(){ 
                var id=$('#owner_id_outbound').val();
				var id_wh=$(this).val();
				//alert(id);
                $.ajax({
                    url : "<?php echo site_url('outbound/get_material_byowner');?>",
                    method : "POST",
                    data : {owner_id: id, warehouse_id: id_wh},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        var html = '<option value="" selected></option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].mat_detail_id+'>'+data[i].material_name+' - exp:'+data[i].expired_date+' - batch:'+data[i].batch_no+'</option>';
                        }
						
                        $('#material_id_outbound').html(html);
 
                    }
                });
                return false;
            });

			$('#material_id_outbound').change(function(){ 
				var owner_id=$('#owner_id_outbound').val();
				var id_wh=$('#warehouse_id_outbound').val();
				var id=$(this).val();
				//alert(id);
                $.ajax({
                    url : "<?php echo site_url('outbound/get_location_bymaterial');?>",
                    method : "POST",
                    data : {owner_id: owner_id, warehouse_id: id_wh, material_id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
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
				//alert(id);
                $.ajax({
                    url : "<?php echo site_url('outbound/get_qty_bylocation');?>",
                    method : "POST",
                    data : {owner_id: owner_id, warehouse_id: id_wh, material_id: mat_id, location_id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        //var html = '<option value="" selected></option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            $('#qty_outbound').val(data[i].qty);
							//html += '<option value='+data[i].location_id+'>'+data[i].wh_area_name+'-'+data[i].blok_name+'-'+data[i].rak_name+'-'+data[i].shelf_name+'</option>';
                        }
						
                    }
                });
                return false;
            });
        });
    </script>

	<script type="text/javascript">
		var j = 0;
		function setTable(){
			var material = document.getElementById('material_id_outbound');
			var location = document.getElementById('location_id_outbound');
			var material_id_outbound = document.getElementById('material_id_outbound').value;
			var location_id = document.getElementById('location_id_outbound').value;
			var quantity = document.getElementById('quantity').value;
			var stock = document.getElementById('qty_outbound').value;

			if(parseInt(quantity) > parseInt(stock)){
				alert('Quantity out of stock!')
			} else {
				$('#tbl_material').append('<tr id="row'+j+'"><td>'+material_id_outbound+'</td><td>'+material.options[material.selectedIndex].text+'<input type="hidden" name="material_id[]" value="'+material_id_outbound+'"><input type="hidden" name="location['+j+']" value="'+location_id+'"></td><td>'+location.options[location.selectedIndex].text+'</td><td>'+quantity+'<input type="hidden" name="quantity['+j+']" value="'+quantity+'"></td><td><a href="javascript:;" class="label label-danger" onclick="removeRow(\'row'+j+'\')"><span class="fa fa-times"></span></a></td></tr>');
				j++;

				document.getElementById('quantity').value = "";
				$('#material_id_outbound').val(null).trigger('change');
				$('#qty_outbound').val(null);
				$('#modalMaterial').modal('hide');
			}
		}

		function removeRow(rowid){
			var row = document.getElementById(rowid);
			row.parentNode.removeChild(row);
		}
	</script>

	
	
	</body>
	<!--end::Body-->
</html>