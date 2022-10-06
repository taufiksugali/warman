
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
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
				<!--begin::Header-->
				<div class="card-header h-auto">
					<!--begin::Title-->
					<div class="card-title py-5">
						<h3 class="card-label">Inbound Data</h3>
					</div>
					<!--end::Title-->
				</div>
				<!--end::Header-->
				<div class="card-body" >
					<div class="form-group row">
						<div class="col-8">
							<label>Date Range</label>
							<div class="row">
								<div class="col-8">
									<div class="input-daterange input-group" id="kt_datepicker_5">
									<input type="text" class="form-control" id="start_date_dashboard" name="start_date" readonly="readonly" placeholder="Select date" data-date-format="dd-mm-yyyy">
									<div class="input-group-append">
										<span class="input-group-text">
											<i class="la la-ellipsis-h"></i>
										</span>
									</div>
									<input type="text" class="form-control" id="until_date_dashboard" name="until_date" readonly="readonly" placeholder="Select date" data-date-format="dd-mm-yyyy">
									</div>
								</div>
								<div class="col-4">
									<button type="submit" onclick="getInboundBar()" class="btn btn-primary mr-2">Search</button>
								</div>
							</div>
						</div>
					</div>
					<div id="chart_inbound_bar">
						<!--begin::Chart-->
						<canvas id="myChart3" style="width:10; height:10; position: relative"></canvas>
						<!--end::Chart-->
					</div>
				</div>
			</div>
			<div class="card card-custom gutter-b">
				<!--begin::Header-->
				<div class="card-header h-auto">
					<!--begin::Title-->
					<div class="card-title py-5">
						<h3 class="card-label">Outbound Data</h3>
					</div>
					<!--end::Title-->
				</div>
				<!--end::Header-->
				<div class="card-body" >
					<div class="form-group row">
						<div class="col-8">
							<label>Date Range</label>
							<div class="row">
								<div class="col-8">
									<div class="input-daterange input-group" id="kt_datepicker_6">
									<input type="text" class="form-control" id="start_date_dashboard_2" name="start_date_2" readonly="readonly" placeholder="Select date" data-date-format="dd-mm-yyyy">
									<div class="input-group-append">
										<span class="input-group-text">
											<i class="la la-ellipsis-h"></i>
										</span>
									</div>
									<input type="text" class="form-control" id="until_date_dashboard_2" name="until_date_2" readonly="readonly" placeholder="Select date" data-date-format="dd-mm-yyyy">
									</div>
								</div>
								<div class="col-4">
									<button type="submit" onclick="getOutboundBar2()" class="btn btn-primary mr-2">Search</button>
								</div>
							</div>
						</div>
					</div>
					<div>
						<!--begin::Chart-->
						<canvas id="myChart5" style="width:10; height:10; position: relative"></canvas>
						<!--end::Chart-->
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
<script>
	let click_total = 0;
	const ctx4 = document.getElementById('myChart5').getContext("2d");
	let config = {
		type: 'bar',
		data: null
	};
	var OutboundBar = new Chart(ctx4, config);
	
	function getOutboundBar2() {
		var updateOutboundBar = function(){
			var start_date_dashboard_2 = $('#start_date_dashboard_2').val();
			var until_date_dashboard_2 = $('#until_date_dashboard_2').val();
			var base_url = "<?= base_url() ?>";
			$.getJSON(base_url + "/dashboard/get_outboundBarChartData?start_date="+start_date_dashboard_2+"&until_date="+until_date_dashboard_2+"", function (data) {
				var out = JSON.parse(JSON.stringify(data));
				var dataset = {
					labels:  out.labels,
					datasets: [{
						label: 'Outbound daily',
						data: out.datasets,
						backgroundColor: 'rgba(54, 162, 235, 0.2)',
						borderColor: 'rgb(54, 162, 235)',
						tension: 0.1
					}]
				}
				removeData(OutboundBar);
				addData(OutboundBar, dataset);
			});
		}
		updateOutboundBar();
	}

	function addData(chart, data) {
		chart.data = data;
		chart.update();
	}

	function removeData(chart) {
		chart.data.labels.pop();
		chart.data.datasets.forEach((dataset) => {
			dataset.data.pop();
		});
		chart.update();
	}
</script>