<?php use App\Models\OutboundModel; ?>
<?php $this->outbound = new OutboundModel(); ?>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Outbound</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Shipping</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Add Shipping</a>
                    </li>
                </ul>
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
            <div class="row">
                <div class="col-md-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Add Shipping</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('outbounddo/create'); ?>">
                            <div class="card-body">
                                <div class="input_fields_outbound">
                                    <?= session()->getFlashdata('message'); ?>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label>Outbound Date
                                            <span class="text-danger">*</span></label>
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" value="<?php echo date_format(date_create(date('Y-m-d H:i:s')), 'd-m-Y H:i:s'); ?>" readonly="readonly" name="do_date" placeholder="Select date" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php if($validation->getError('do_date')){ echo '<div class="invalid-feedback">'.$validation->getError('do_date').'</div>'; } ?>
                                        </div>
                                        <!-- <div class="col-6">
                                            <label>Invoice Number
                                            <span class="text-danger">*</span></label>
                                            <input type="text" id="do_trans_resi" required name="do_trans_resi" class="form-control <?= ($validation->getError('do_trans_resi')) ? 'is-invalid' : ''; ?>" placeholder="Enter document number" />
                                            <?php if($validation->getError('do_trans_resi')){ echo '<div class="invalid-feedback">'.$validation->getError('do_trans_resi').'</div>'; } ?>
                                        </div> -->
                                    </div>
                                    <!--  -->
                                    <!-- <h5>List Pesanan</h5>
                                    <table name="tbl_ref" class="table table-dark rounded"  style="margin-top: 10px">
                                        <thead>
                                            <tr>
                                                <th>Product ID</th>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_ref">
                                            
                                        </tbody>
                                    </table> -->
                                    <div id="po" class="add_product">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <button type="button" class="btn font-weight-bold btn-light-warning btn-sm" onclick="show_modalForm()">
                                                        <i class="la la-plus"></i>Add Package</button>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="separator separator-dashed"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <table name="tbl_material" class="table table-condensed table-hover"  style="margin-top: 10px">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>Invoice Number</th>
                                                <th>Warehouse</th>
                                                <th>Transporter</th>
                                                <th>Customer</th>
                                                <th>Product List</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabLO">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('outbounddo'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
    </div>
	<!--end::Entry-->
</div>
<!--end::Content-->
    <div class="modal fade" id="modalMaterial" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-wrapper">
          <!-- <div class="modal-dialog" style="max-width: 60%"> -->
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h4>Choose Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
              </div>
              <div class="modal-body">
              <div class="input_fields_outbound">
                <div class="form-group">
                    <!-- dapet data dari passingan data outboundd di controller. -->
                    <table class="table display table-separate table-bordered-scroll-x">
                        <thead> 
                            <tr>
                                <th>Check</th>
                                <th>No.</th>
                                <th>Invoice Number</th>
                                <th>Warehouse</th>
                                <th>Transporter</th>
                                <th>Customer</th>
                                <th>Products</th>
                            </tr>
                        </thead>
                        <tbody id="LO">
                            
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" onclick="addLO()">Add</button>
                </div>
              </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      
<script>
    var arr_temp_lo = <?= json_encode($outbound) ?>;
	var arr_lo = [];
    
    /* Perform when plus button */
	function show_modalForm(f) {
		$("#modalMaterial").modal();
		show_data_to_table(arr_temp_lo, "0", "LO");
	}

    function show_data_to_table(arr, f, elem) { // yang dilempar arr_temp_lo yang berisi data package
		$.ajax({
			type: "POST",
			dataType: "html",
			url: "<?= site_url("outbounddo/get_package") ?>?f="+ f,
			data: {
				json: JSON.stringify(arr),
                indicator: f
			},
			success: function(msg) {
				$("#" + elem).html(msg);
			}
		});
	}

    function addLO() {
		var checkboxes = document.getElementsByName('pid');
		for (var i = 0; i < checkboxes.length; i++) {
			if (checkboxes[i].checked) {
				idx = checkboxes[i].value;
				arr_temp_lo[idx]['status'] = 3; //nandain package yang dipilih kalo satu, nanti ditampilin.
				lo_id = arr_temp_lo[idx]['outbound_id'];
				arr_lo.push(lo_id);
			}
		}
        // console.log(arr_temp_lo);
		show_data_to_table(arr_temp_lo, "1", "tabLO");
		$('#modalMaterial').modal('hide');
	}

	function del_arr_DO(idx, x) {
		do_id = arr_temp_lo[idx]['do_id'];
		if (confirm('Remove Package ID ' + do_id + '?')) {
			arr_temp_lo[idx]['status'] = 2;
			show_data_to_table(arr_temp_lo, "1", "tabLO");
			arr_lo.splice(parseInt(x), 1);
		}
	}
</script>