<style>
  #left-panel {
    height: 500px;
    width: 0;
    position: absolute;
    z-index: 1;
    top: 20px;
    left: 20px;
    background-color: #f7f8f9;
    overflow-x: hidden;
    transition: 0.5s;
  }

  #left-panel #closebtn {
    position: absolute;
    right: 5px;
    font-size: 20px;
    margin-left: 50px;
  }
</style>

<?php
if(@$warehouse_marker) {
  $no = 0;
  foreach($warehouse_marker as $row) {
    $no++;
    $dataLocations[] = array(
      $no,
      $row->wh_name, 
      $row->wh_latitude,
      $row->wh_longitude,
      base_url('images/marker/warehouse.png'),
      '<strong><u>'.$row->wh_name.'</u></strong><br>'.$row->wh_address.', <br>'.$row->city_name.', '.$row->state_name.' <input type="hidden" id="pos_marker" value="'.$row->warehouse_id.'">',
    );
  }
}else{
	$dataLocations = array();
}
?>

<script>
  function openNav() {
    var pos_marker = document.getElementById("pos_marker").value;

    document.getElementById("left-panel").style.width = "50%";
    document.getElementById("map").style.width = "50%";
    document.getElementById("map").style.marginLeft = "50%";

    if (window.XMLHttpRequest) {
      xmlhttp = new XMLHttpRequest();
    } else {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("warehouseData").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","<?= base_url() ?>/dashboard/inventory_data?wh_id="+pos_marker,true);
    xmlhttp.send();
  }

  function closeNav() {
    document.getElementById("left-panel").style.width = "0";
    document.getElementById("map").style.width = "100%";
    document.getElementById("map").style.marginLeft = "0";
  }

  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 5,
      center: {lat: -1.605328, lng: 117.451067}
    });

    setMarkers(map);
  }

  var locations = <?php echo json_encode($dataLocations, JSON_NUMERIC_CHECK); ?>;

  function setMarkers(map) {
    var shape = {
      coords: [1, 1, 1, 20, 18, 20, 18, 1],
      type: 'poly'
    };

    var infowindow =  new google.maps.InfoWindow({});

    var marker;

    for (var i = 0; i < locations.length; i++) {
      var location = locations[i];
      var marker = new google.maps.Marker({
        position: {lat: location[2], lng: location[3]},
        map: map,
        icon: {url: location[4], size: new google.maps.Size(32, 32), origin: new google.maps.Point(0, 0), anchor: new google.maps.Point(0, 32)},
        shape: shape,
        title: location[1],
        zIndex: location[0]
      });

      google.maps.event.addListener(marker, 'click', (function (marker, i) {
        return function () {
          infowindow.setContent(locations[i][5]);
          infowindow.open(map, marker);
          openNav();
          map.setZoom(20);          
          map.setCenter(marker.getPosition());
        }
      })(marker, i));
    }
  }
</script>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Inventory</h5>
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
			<div class="row">
				<div class="col-md-12">
          <div class="card card-custom gutter-b card-stretch">
            <div class="card-body">
                <div id="left-panel">
                  <a href="javascript:void(0)" id="closebtn" onclick="closeNav()">&times;</a>
                  <div id="warehouseData">
                    <p><strong>Loading...</strong></p>
                  </div>
               </div>
  					   <div id="map" style="height: 500px; width: 100%;"></div>
  					   <div id="legend" style="background: #fff;  padding: 9px; margin: 10px;"></div>
            </div>
          </div>
				</div>
			</div>
		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>
<!--end::Content-->
