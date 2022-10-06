<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Top Up</h5>
				<!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Top Up</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Top Up Data</a>
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
                        <h3 class="card-label">Top Up Data
                        <span class="d-block text-muted pt-2 font-size-sm">scrollable datatable with fixed height</span></h3>
                    </div>
                    <div class="card-toolbar">
                        
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
                                <th data-orderable="false" width="10%">Category</th>
                                <th data-orderable="false" width="10%">Status</th>
                                <th>Seller</th>
                                <th>Sent By</th>
                                <th>From Account</th>
                                <th>Amount</th>
                                <th>To Account</th>
                                <th>Top Up Date</th>
                                <th>Payment Method</th>
                                <th data-orderable="false" align="center">Top Up Proof</th>
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

<div class="modal fade" id="topupReject" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="topupReject" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Topup Reject</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i aria-hidden="true" class="ki ki-close"></i>
				</button>
			</div>
            <form method="post" class="form" enctype='multipart/form-data' action="<?php echo base_url('topup/rejectTopup'); ?>">
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-light-danger mr-2">Reject</button>
                    <button type="button" class="btn btn-light-dark font-weight-bold" data-dismiss="modal">Close</button>
                </div>
            </form>
		</div>
	</div>
</div>

<script>
    function modal_reject(idx){
        var topup_id = document.getElementById('topupReject'+idx+'').value;
        console.log(topup_id);
				// AJAX request
				$.ajax({
					url: 'topup/get_topup_byId',
					type: 'post',
					data: {topup_id: topup_id},
					success: function(response){ 
						// Add response in Modal body
						// console.log(response);
						$('.modal-body').html(response); 

						// Display Modal
						$('#topupReject').modal('show'); 
					}
				});
    }
</script>
