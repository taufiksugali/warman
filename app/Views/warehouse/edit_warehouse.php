<!--begin::Content-->
<?php use App\Models\StateModel; ?>
<?php $this->state = new StateModel(); ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Master Data</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Warehouse</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Edit Warehouse</a>
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
                            <h3 class="card-title">Edit Warehouse</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('warehouse/update'); ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label><strong>Warehouse Information:</strong> </label>
                                        <br>
                                        <div class="form-group">
                                            <label>Warehouse Code
                                            <span class="text-danger">*</span></label>
                                            <input type="hidden" name="warehouse_id" value="<?= $warehouse->warehouse_id ?>" placeholder="Enter code" />
                                            <input type="text" name="warehouse_code" class="form-control <?= ($validation->getError('warehouse_code')) ? 'is-invalid' : ''; ?>" value="<?= $warehouse->wh_code ?>" placeholder="Enter code" />
                                            <?php if($validation->getError('warehouse_code')){ echo '<div class="invalid-feedback">'.$validation->getError('warehouse_code').'</div>'; } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Warehouse Name
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="warehouse_name" class="form-control <?= ($validation->getError('warehouse_name')) ? 'is-invalid' : ''; ?>" value="<?= $warehouse->wh_name ?>" placeholder="Enter name" />
                                            <?php if($validation->getError('warehouse_name')){ echo '<div class="invalid-feedback">'.$validation->getError('warehouse_name').'</div>'; } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Warehouse State
                                            <span class="text-danger">*</span></label>
                                            <select class="select2 select form-control custom-select <?= ($validation->getError('state_id')) ? 'is-invalid' : ''; ?>" value="<?= old('state_id'); ?>" id="state_id" name="state_id" onchange="get_city()">
                                                <option></option>
                                                <?php if (@$state) :
                                                    foreach ($state as $row) :
                                                ?>
                                                <option value="<?= $row->state_id ?>" <?php if($row->state_id == $warehouse->state_id) { echo "selected"; } ?>><?= $row->state_name ?></option>
                                                <?php endforeach; endif; ?>
                                            </select>
                                            <?php if($validation->getError('state_id')){ echo '<div class="invalid-feedback">'.$validation->getError('state_id').'</div>'; } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Warehouse City
                                            <span class="text-danger">*</span></label>
                                            <select class="select form-control custom-select showproduct <?= ($validation->getError('city_id')) ? 'is-invalid' : ''; ?>" value="<?= old('city_id'); ?>" id="city_id" name="city_id" onchange="get_district()">
                                                <option></option>
                                                <option value="<?= @$warehouse->city_id ?>" selected ><?= @$this->state->getCityById($warehouse->city_id)->city_name ?></option>
                                            </select>
                                            <?php if($validation->getError('city_id')){ echo '<div class="invalid-feedback">'.$validation->getError('city_id').'</div>'; } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Warehouse District
                                            <span class="text-danger">*</span></label>
                                            <select class="select form-control custom-select showproduct <?= ($validation->getError('district_id')) ? 'is-invalid' : ''; ?>" value="<?= old('district_id'); ?>" id="district_id" name="district_id" onchange="get_sub_district()">
                                                <option></option>
                                                <option value="<?= @$warehouse->district_id ?>" selected ><?= @$this->state->getDistrictById($warehouse->district_id)->district_name ?></option>
                                            </select>
                                            <?php if($validation->getError('district_id')){ echo '<div class="invalid-feedback">'.$validation->getError('district_id').'</div>'; } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Warehouse Sub District
                                            <span class="text-danger">*</span></label>
                                            <select class="select form-control custom-select showproduct <?= ($validation->getError('sdistrict_id')) ? 'is-invalid' : ''; ?>" value="<?= old('sdistrict_id'); ?>" id="sdistrict_id" name="sdistrict_id">
                                                <option></option>
                                                <option value="<?= @$warehouse->sdistrict_id ?>" selected ><?= @$this->state->getSubDistrictById($warehouse->sdistrict_id)->sdistrict_name ?></option>
                                            </select>
                                            <?php if($validation->getError('sdistrict_id')){ echo '<div class="invalid-feedback">'.$validation->getError('sdistrict_id').'</div>'; } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Warehouse Address
                                            <span class="text-danger">*</span></label>
                                            <textarea name="warehouse_address" class="form-control <?= ($validation->getError('warehouse_address')) ? 'is-invalid' : ''; ?>" placeholder="Enter address"><?= $warehouse->wh_address ?></textarea>
                                            <?php if($validation->getError('warehouse_address')){ echo '<div class="invalid-feedback">'.$validation->getError('warehouse_address').'</div>'; } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Warehouse Method
                                            <span class="text-danger">*</span></label>
                                            <div class="radio-inline">
                                                <label class="radio">
                                                <input type="radio" <?php if($warehouse->wh_metode == 0){ echo "checked"; } ?> name="wh_metode" value="0">
                                                <span></span>FIFO</label>
                                                <label class="radio radio-danger">
                                                <input type="radio" <?php if($warehouse->wh_metode == 1 || $warehouse->wh_metode == null ){ echo "checked"; } ?> name="wh_metode" value="1">
                                                <span></span>FEFO</label>
                                            </div>
                                            <span class="form-text text-muted">Determine whether this warehouse use FIFO or FEFO</span>
                                        </div>
                                        <div class="form-group">
                                            <label>Accept Dropship
                                            <span class="text-danger">*</span></label>
                                            <div class="radio-inline">
                                                <label class="radio">
                                                <input type="radio" <?php if($warehouse->wh_dropship == 1){ echo "checked"; } ?>  name="wh_dropship" value="1">
                                                <span></span>Yes</label>
                                                <label class="radio radio-danger">
                                                <input type="radio" <?php if($warehouse->wh_dropship == 0 || $warehouse->wh_dropship == null){ echo "checked"; } ?>  name="wh_dropship" value="0">
                                                <span></span>No</label>
                                            </div>
                                            <span class="form-text text-muted">Determine whether this warehouse accept dropship or not</span>
                                        </div>
                                        <div class="form-group">
                                            <label>Accept COP
                                            <span class="text-danger">*</span></label>
                                            <div class="radio-inline">
                                                <label class="radio">
                                                <input type="radio" <?php if($warehouse->wh_cop == 1){ echo "checked"; } ?>  name="wh_cop" value="1">
                                                <span></span>Yes</label>
                                                <label class="radio radio-danger">
                                                <input type="radio" <?php if($warehouse->wh_cop == 0 || $warehouse->wh_cop == null){ echo "checked"; } ?>  name="wh_cop" value="0">
                                                <span></span>No</label>
                                            </div>
                                            <span class="form-text text-muted">Determine whether this warehouse accept COP or not</span>
                                        </div>
                                        <div class="form-group">
                                            <label>Warehouse Status
                                            <span class="text-danger">*</span></label>
                                                <select class="select2 select form-control custom-select <?= ($validation->getError('status')) ? 'is-invalid' : ''; ?>" value="<?= old('status'); ?>" id="status" name="status" >
                                                    <option></option>
                                                    <option value="1" <?php if($warehouse->status == 1){echo "selected";} ?>>Active</option>
                                                    <option value="0" <?php if($warehouse->status == 0){echo "selected";} ?>>Inactive</option>
                                                </select>
                                            <?php if($validation->getError('status')){ echo '<div class="invalid-feedback">'.$validation->getError('status').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label><strong>PIC Information:<strong> </label>
                                        <br>
                                        <div class="form-group">
                                            <label>PIC Name
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="pic_name" class="form-control <?= ($validation->getError('pic_name')) ? 'is-invalid' : ''; ?>" value="<?= $warehouse->wh_pic ?>" placeholder="Enter PIC name" />
                                            <?php if($validation->getError('pic_name')){ echo '<div class="invalid-feedback">'.$validation->getError('pic_name').'</div>'; } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>PIC Phone
                                            <span class="text-danger">*</span></label>
                                            <input type="text" name="pic_phone" class="form-control <?= ($validation->getError('pic_phone')) ? 'is-invalid' : ''; ?>" value="<?= $warehouse->wh_pic_phone ?>" placeholder="Enter PIC phone" />
                                            <?php if($validation->getError('pic_phone')){ echo '<div class="invalid-feedback">'.$validation->getError('pic_phone').'</div>'; } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>PIC Email</label>
                                            <input type="text" name="pic_email" class="form-control <?= ($validation->getError('pic_email')) ? 'is-invalid' : ''; ?>" value="<?= $warehouse->wh_pic_email ?>" placeholder="Enter PIC email" />
                                            <?php if($validation->getError('pic_email')){ echo '<div class="invalid-feedback">'.$validation->getError('pic_email').'</div>'; } ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-secondary font-weight-normal">Coordinate Point <span class="text-danger">*</span></label>
                                            <div class="form-group row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control <?= ($validation->getError('warehouse_latitude')) ? 'is-invalid' : ''; ?>" id="warehouse_latitude" name="warehouse_latitude" 
                                                    value="<?= $warehouse->wh_latitude ?>" placeholder="Latitude" />
                                                    
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control  <?= ($validation->getError('warehouse_longitude')) ? 'is-invalid' : ''; ?>" id="warehouse_longitude" name="warehouse_longitude" 
                                                    value="<?= $warehouse->wh_longitude ?>" placeholder="Longitude" />
                                                    
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-latlong" title="Pilih Titik Koordinat"><i class="fa fa-map-marker-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Open or Close
                                            <span class="text-danger">*</span></label>
                                            <div class="radio-inline">
                                                <label class="radio">
                                                <input type="radio" <?php if($warehouse->is_open == 1){ echo "checked"; } ?> name="is_open" value="1">
                                                <span></span>Open</label>
                                                <label class="radio radio-danger">
                                                <input type="radio" <?php if($warehouse->is_open == 0){ echo "checked"; } ?> name="is_open" value="0">
                                                <span></span>Close</label>
                                            </div>
                                            <span class="form-text text-muted">Determine whether this warehouse now open or close</span>
                                        </div>
                                        <div class="form-group">
                                            <label>Opening Hour
                                            <span class="text-danger">*</span></label>
                                            <input class="form-control" id="kt_timepicker_1" name="opening_hour" value="<?php echo date_format(date_create($warehouse->opening_hour), 'H:i'); ?>" readonly="readonly" placeholder="Select time" type="text">
                                            <span class="form-text text-muted">Determine this warehouse opening hour</span>
                                        </div>
                                        <div class="form-group">
                                            <label>Closing Hour
                                            <span class="text-danger">*</span></label>
                                            <input class="form-control" id="kt_timepicker_1" name="closing_hour" value="<?php echo date_format(date_create($warehouse->closing_hour), 'H:i'); ?>" readonly="readonly" placeholder="Select time" type="text">
                                            <span class="form-text text-muted">Determine this warehouse closing hour</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('warehouse'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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
<div class="modal fade" id="modal-latlong">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Titik Koordinat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="map" style="height: 400px; width: 100%;"></div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" data-dismiss="modal">Pilih</a>
            </div>
        </div>
    </div>
</div>
<script>
    function initMap() {
        var x = navigator.geolocation;
        x.getCurrentPosition(success, failure);

        function success(position){
            var myLat = position.coords.latitude;
            var myLong = position.coords.longitude;

            var coords = {lat: myLat, lng: myLong};

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 17,
                center: coords,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            });

            var marker = new google.maps.Marker({
                position: coords,
                map: map,
                title: 'Pilih Lokasi Kantor',
                draggable: true
            });

            google.maps.event.addListener(marker, 'dragend', function(marker){
                var latLng = marker.latLng;
                document.getElementById("warehouse_latitude").value = latLng.lat();
                document.getElementById("warehouse_longitude").value = latLng.lng();
            }); 
        }
        
        function failure(){
            alert('Geolocation failure!');
            var coords = {lat: -6.168117, lng: 106.835152};

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 17,
                center: coords,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            });

            var marker = new google.maps.Marker({
                position: coords,
                map: map,
                title: 'Pilih Lokasi Kantor',
                draggable: true
            });

            google.maps.event.addListener(marker, 'dragend', function(marker){
                var latLng = marker.latLng;
                document.getElementById("warehouse_latitude").value = latLng.lat();
                document.getElementById("warehouse_longitude").value = latLng.lng();
            });
        }
    }
</script>