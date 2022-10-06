function form_view_layout() {
    var warehouse_id = document.getElementById('id_warehouse').value;
    // e.preventDefault();
    // AJAX request
    $.ajax({
        url: 'location/view_layout',
        type: 'post',
        data: {warehouse_id: warehouse_id},
        success: function(response){ 
            // Add response in Modal body
            // console.log(response);
            $('#wh_layout').empty();
            $('#wh_layout').html(response);
        }
    });
}