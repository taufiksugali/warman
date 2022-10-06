
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Monthly Data</h5>
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
							<label>Choose Month</label>
							<div class="row">
								<div class="col-8">
									<div class="form-group">
										<select class="select form-control custom-select showproduct" id="month" name="month">
											<option></option>
											<option value="1">January</option>	
											<option value="2">February</option>	
											<option value="3">March</option>	
											<option value="4">April</option>	
											<option value="5">May</option>	
											<option value="6">June</option>	
											<option value="7">July</option>	
											<option value="8">August</option>	
											<option value="9">September</option>	
											<option value="10">October</option>	
											<option value="11">November</option>	
											<option value="12">December</option>	
										</select>
									</div>
								</div>
								<div class="col-4">
									<button type="submit" onclick="getInboundMonthly()" class="btn btn-primary mr-2">Search</button>
								</div>
							</div>
						</div>
					</div>
					<div id="chart_inbound_bar" style="display: none">
						<!--begin::Chart-->
						<canvas id="inbound_monthly" style="width:10; height:10; position: relative"></canvas>
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
							<label>Choose Month</label>
							<div class="row">
								<div class="col-8">
									<div class="form-group">
										<select class="select form-control custom-select showproduct" id="month_out" name="month_out">
											<option></option>
											<option value="1">January</option>	
											<option value="2">February</option>	
											<option value="3">March</option>	
											<option value="4">April</option>	
											<option value="5">May</option>	
											<option value="6">June</option>	
											<option value="7">July</option>	
											<option value="8">August</option>	
											<option value="9">September</option>	
											<option value="10">October</option>	
											<option value="11">November</option>	
											<option value="12">December</option>	
										</select>
									</div>
								</div>
								<div class="col-4">
									<button type="submit" onclick="getOutboundMonthly()" class="btn btn-primary mr-2">Search</button>
								</div>
							</div>
						</div>
					</div>
					<div id="chart_outbound_bar" style="display: none">
						<!--begin::Chart-->
						<canvas id="outbound_monthly" style="width:10; height:10; position: relative"></canvas>
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
	const inbound_chart = document.getElementById('inbound_monthly').getContext("2d");
	const ctx4 = document.getElementById('outbound_monthly').getContext("2d");
	
	let config = {
		type: 'bar',
		data: null
	};
	var inboundChart = new Chart(inbound_chart, config);
	var OutboundBar = new Chart(ctx4, config);
	
	function getInboundMonthly() {
		document.getElementById('chart_inbound_bar').style.display = 'block';
		var updateInboundMonthly = function(){
			var month = $('#month').val();
			var base_url = "<?= base_url() ?>";
			$.getJSON(base_url + "/dashboard/get_inboundMonthly?month="+month+"", function (data) {
				
				var out = JSON.parse(JSON.stringify(data));
				var dataset = {
					labels:  out.labels,
					datasets: [{
						label: 'Inbound per day',
						data: out.datasets,
						backgroundColor: 'rgb(75, 192, 192)',
						borderColor: 'rgb(54, 162, 235)',
						tension: 0.1
					}]
				};
				removeData(inboundChart);
				addData(inboundChart, dataset);
			});
		}
		updateInboundMonthly();
	}

	function getOutboundMonthly() {
		document.getElementById('chart_outbound_bar').style.display = 'block';
		var updateOutboundBar = function(){
			var month = $('#month_out').val();
			var base_url = "<?= base_url() ?>";
			$.getJSON(base_url + "/dashboard/get_outboundMonthly?month="+month+"", function (data) {
				var out = JSON.parse(JSON.stringify(data));
				var dataset = {
					labels:  out.labels,
					datasets: [{
						label: 'Outbound per day',
						data: out.datasets,
						backgroundColor: 'rgb(255, 99, 71)',
						borderColor: 'rgb(54, 162, 235)',
						tension: 0.1
					}]
				};
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