<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Owner</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Owner</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Add Owner</a>
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
                            <h3 class="card-title">Add Owner</h3>
                        </div>
                        <!--begin::Form-->
                        <form method="post" class="form" action="<?php echo base_url('owners/create'); ?>">
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label>Owner Name
                                        <span class="text-danger">*</span></label>
                                        <input type="text" name="owners_name" class="form-control <?= ($validation->getError('owners_name')) ? 'is-invalid' : ''; ?>" placeholder="Enter name" />
                                        <?php if($validation->getError('owners_name')){ echo '<div class="invalid-feedback">'.$validation->getError('owners_name').'</div>'; } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-secondary font-weight-normal">Coordinate Point <span class="text-danger">*</span></label>
                                        <div class="form-group row">
                                            <div class="col-md-5">
                                                <input type="text" class="form-control <?= ($validation->getError('owners_latitude')) ? 'is-invalid' : ''; ?>" id="owners_latitude" name="owners_latitude" 
                                                placeholder="Latitude" />
                                                
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control  <?= ($validation->getError('owners_longitude')) ? 'is-invalid' : ''; ?>" id="owners_longitude" name="owners_longitude" 
                                                placeholder="Longitude" />
                                                
                                            </div>
                                            <div class="col-md-2">
                                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-latlong" title="Pilih Titik Koordinat"><i class="fa fa-map-marker-alt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label>Owner State
                                        <span class="text-danger">*</span></label>
                                        <select class="select form-control custom-select showproduct <?= ($validation->getError('state_id')) ? 'is-invalid' : ''; ?>" value="<?= old('state_id'); ?>" id="state_id" name="state_id" onchange="get_city()">
                                            <option></option>
                                            <?php if (@$state) :
                                                foreach ($state as $row) :
                                            ?>
                                            <option value="<?= $row->state_id ?>"><?= $row->state_name ?></option>
                                            <?php endforeach; endif; ?>
                                        </select>
                                        <?php if($validation->getError('state_id')){ echo '<div class="invalid-feedback">'.$validation->getError('state_id').'</div>'; } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Owner Address
                                        <span class="text-danger">*</span></label>
                                        <textarea name="owners_address" class="form-control <?= ($validation->getError('owners_address')) ? 'is-invalid' : ''; ?>" placeholder="Enter address"></textarea>
                                        <?php if($validation->getError('owners_address')){ echo '<div class="invalid-feedback">'.$validation->getError('owners_address').'</div>'; } ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label>Owner City
                                        <span class="text-danger">*</span></label>
                                        <select class="select form-control custom-select showproduct <?= ($validation->getError('city_id')) ? 'is-invalid' : ''; ?>" value="<?= old('city_id'); ?>" id="city_id" name="city_id" onchange="get_district()">
                                            <option></option>
                                            
                                        </select>
                                        <?php if($validation->getError('city_id')){ echo '<div class="invalid-feedback">'.$validation->getError('city_id').'</div>'; } ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label>Owner District
                                        <span class="text-danger">*</span></label>
                                        <select class="select form-control custom-select showproduct <?= ($validation->getError('district_id')) ? 'is-invalid' : ''; ?>" value="<?= old('district_id'); ?>" id="district_id" name="district_id" onchange="get_sub_district()">
                                            <option></option>
                                            
                                        </select>
                                        <?php if($validation->getError('district_id')){ echo '<div class="invalid-feedback">'.$validation->getError('district_id').'</div>'; } ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label>Owner Sub District
                                        <span class="text-danger">*</span></label>
                                        <select class="select form-control custom-select showproduct <?= ($validation->getError('sdistrict_id')) ? 'is-invalid' : ''; ?>" value="<?= old('sdistrict_id'); ?>" id="sdistrict_id" name="sdistrict_id">
                                            <option></option>
                                            
                                        </select>
                                        <?php if($validation->getError('sdistrict_id')){ echo '<div class="invalid-feedback">'.$validation->getError('sdistrict_id').'</div>'; } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="<?= base_url('owners'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
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
                document.getElementById("owners_latitude").value = latLng.lat();
                document.getElementById("owners_longitude").value = latLng.lng();
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
                document.getElementById("owners_latitude").value = latLng.lat();
                document.getElementById("owners_longitude").value = latLng.lng();
            });
        }
    }
</script>