function getArea_byWarehouse() {
    var wh_id = document.getElementById("warehouse_id").value;
    // console.log(prospect);
    $.ajax({
        method: 'GET',
        url: base_url+"/blok/get_area?wh_id="+wh_id,
        beforeSend: function () {
            $('#area_id').empty();
        },
        success: function (data) {
            $('#area_id').html(data);
        }
    })
}