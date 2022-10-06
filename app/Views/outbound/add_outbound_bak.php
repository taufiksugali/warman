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
                        <a href="" class="text-muted">Outbound Plan</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Add Outbound Plan</a>
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
                            <h3 class="card-title">Add Outbound Plan</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('outbound/create'); ?>">
                            <div class="card-body">
                                <div class="input_fields_outbound">
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label>Doc. Number
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="doc_number" class="form-control <?= ($validation->getError('doc_number')) ? 'is-invalid' : ''; ?>" placeholder="Enter document number" />
                                            <?php if($validation->getError('doc_number')){ echo '<div class="invalid-feedback">'.$validation->getError('doc_number').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                            <label>Doc. Date
                                            <span class="text-danger">*</span></label>
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" value="<?php echo date_format(date_create(date('Y-m-d')), 'd-m-Y'); ?>" readonly="readonly" name="doc_date" placeholder="Select date" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php if($validation->getError('doc_date')){ echo '<div class="invalid-feedback">'.$validation->getError('doc_date').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label>Customer
                                            <span class="text-danger">*</span></label>
                                            <select class="form-control select select2 <?= ($validation->getError('customer_id')) ? 'is-invalid' : ''; ?>" value="<?= old('customer_id'); ?>" id="customer_id" name="customer_id">
                                                <option value="" selected></option>
                                                <?php foreach(@$customer as $row) { ?>
                                                <option value="<?= @$row->customer_id; ?>"><?= @$row->customer_name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if($validation->getError('customer_id')){ echo '<div class="invalid-feedback">'.$validation->getError('customer_id').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                            <label>Warehouse
                                            <span class="text-danger">*</span></label>
                                            <select class="form-control select select2 <?= ($validation->getError('warehouse_id')) ? 'is-invalid' : ''; ?>" value="<?= old('warehouse_id'); ?>" id="warehouse_id_outbound" name="warehouse_id">
                                                <option value="" selected></option>
                                                <?php foreach(@$warehouse as $row) { ?>
                                                <option value="<?= @$row->warehouse_id; ?>"><?= @$row->wh_name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if($validation->getError('warehouse_id')){ echo '<div class="invalid-feedback">'.$validation->getError('warehouse_id').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label>Out Date
                                            <span class="text-danger">*</span></label>
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" id="kt_datepicker_2" readonly="readonly" name="out_date" placeholder="Select date" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php if($validation->getError('shipping_date')){ echo '<div class="invalid-feedback">'.$validation->getError('shipping_date').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                            <label>Seller
                                            <span class="text-danger">*</span></label>
                                            <select class="form-control select select2 <?= ($validation->getError('owner_id')) ? 'is-invalid' : ''; ?>" value="<?= old('owner_id'); ?>" id="owner_id_outbound" name="owner_id">
                                                <option value="" selected></option>
                                                <?php foreach(@$owner as $row) { ?>
                                                <option value="<?= @$row->owners_id; ?>"><?= @$row->owners_name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if($validation->getError('owner_id')){ echo '<div class="invalid-feedback">'.$validation->getError('owner_id').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Description
                                        <span class="text-danger">*</span></label>
                                        <textarea name="description" class="form-control <?= ($validation->getError('description')) ? 'is-invalid' : ''; ?>" placeholder="Enter description" ></textarea>
                                        <?php if($validation->getError('description')){ echo '<div class="invalid-feedback">'.$validation->getError('description').'</div>'; } ?>
                                    </div>
                                    <div id="po" class="add_product">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <button type="button" class="btn font-weight-bold btn-light-warning btn-sm" data-toggle="modal" data-target="#modalMaterial">
                                                        <i class="la la-plus"></i>Add Material</button>
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
                                            <th>Material ID</th>
                                            <th>Material Name</th>
                                            <th>Location</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_material">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('allocation'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4>Choose Material</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
              </div>
              <div class="modal-body">
              <div class="input_fields_outbound">
                <div class="form-group">
                    <div class="col-12">
                        <label class="font-weight-bold">Material<span class="text-danger">*</span></label>
                        <div class="input-group">
                        <select style="width: 100%" class="select form-control custom-select showproduct <?= ($validation->getError('material_id_outbound')) ? 'is-invalid' : ''; ?>" id="material_id_outbound" name="material_id">
                        </select>
                        <?php if($validation->getError('material_id_outbound')){ echo '<div class="invalid-feedback">'.$validation->getError('material_id_outbound').'</div>'; } ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12">
                        <label class="font-weight-bold">Location<span class="text-danger">*</span></label>
                        <div class="input-group">
                        <select style="width: 100%" class="select form-control custom-select showproduct <?= ($validation->getError('location_id_outbound')) ? 'is-invalid' : ''; ?>" id="location_id_outbound" name="location_id">
                        </select>
                        <?php if($validation->getError('location_id_outbound')){ echo '<div class="invalid-feedback">'.$validation->getError('location_id_outbound').'</div>'; } ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12">
                        <label class="font-weight-bold">Stock at Location<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" readonly class="form-control numbers <?= ($validation->getError('qty')) ? 'is-invalid' : ''; ?>" value="<?= old('qty'); ?>" id="qty_outbound" name="qty" placeholder="Stock">
                            <?php if($validation->getError('qty')){ echo '<div class="invalid-feedback">'.$validation->getError('qty').'</div>'; } ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12">
                        <label class="font-weight-bold">Quantity<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control numbers <?= ($validation->getError('quantity')) ? 'is-invalid' : ''; ?>" value="<?= old('quantity'); ?>" id="quantity" name="quantity" placeholder="Quantity">
                            <?php if($validation->getError('quantity')){ echo '<div class="invalid-feedback">'.$validation->getError('quantity').'</div>'; } ?>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" onclick="setTable()">Add</button>
              </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>