<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Inventory Owner</h5>
				<!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Manual Update Stock Owner</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Manual Update Stock Owner Data</a>
                    </li>
                </ul>
                <!--end::Breadcrumb-->
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
        <!--end::Notice-->
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Manual Update Stock Owner Data
                        <span class="d-block text-muted pt-2 font-size-sm">scrollable datatable with fixed height</span></h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
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
                                <th data-orderable="false">Actions</th>
                                <!-- <th data-orderable="false">Status</th> -->
                                <th>Warehouse name</th>
                                <th>Owner name</th>
                                <th>Material name</th>
                                <th>Stock Good Seller</th>
                                <th>Stock Not Good Seller</th>
                                <th>Stock Good Warehouse</th>
                                <th>Stock Not Good Warehouse</th>
                                <th>Updated Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>
<!--end::Content-->
<!-- modal detail shelf -->
<div class="modal fade" id="sohowner" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="sohowner" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Update Stock</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i aria-hidden="true" class="ki ki-close"></i>
				</button>
			</div>
			<div class="modal-body">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script>
    function get_soh_owner(idx) {
				var sot_id = document.getElementById('sohowner'+idx+'').value;
				// AJAX request
				$.ajax({
					url: 'soh_owner/get_soh_byId',
					type: 'post',
					data: {sot_id: sot_id},
					success: function(response){ 
						// Add response in Modal body
						// console.log(response);
						$('.modal-body').html(response); 

						// Display Modal
						$('#sohowner').modal('show'); 
					}
				});
			}
</script>