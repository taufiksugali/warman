<?php use App\Models\LocationModel; ?>
<?php $this->location = new LocationModel(); ?>
<style>
.table-bordered th, .table-bordered td {
    border: 1.5px solid #b2b2b2;
}
.table th, .table td {
    padding: 0rem;
    vertical-align: top;
}
</style>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Location</h5>
				<!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">View Location</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Location Data</a>
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
                        <h3 class="card-label">View Location
                        <span class="d-block text-muted pt-2 font-size-sm"></span></h3>
                    </div>
                    <div class="card-toolbar">
                        
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-4">
                            <label>Warehouse</label>
                            <select class="form-control select select2" name="warehouse_id" id="id_warehouse" onchange="form_view_layout()">
                                <option value="" selected></option>
                                <?php foreach(@$warehouse as $row) { ?>
                                <option value="<?= @$row->warehouse_id; ?>"><?= @$row->wh_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div id="wh_layout">

                    </div>
                </div>
            </div>
        </div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>
<!--end::Content-->
<!-- modal detail shelf -->
<div class="modal fade" id="shelfmats" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="shelfmats" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Shelf Materials</h5>
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