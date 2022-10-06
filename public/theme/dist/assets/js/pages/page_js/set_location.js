var x = 0;
var x_ng = 0;
$(document).ready(function() {
    var max_fields         = 10; //maximum input boxes allowed
    var max_fields_ng      = 10; //maximum input boxes allowed
    var wrapper            = $(".input_fields_loc"); //Fields wrapper
    var wrapper_ng         = $(".input_fields_loc_ng"); //Fields wrapper
    var add_button         = $(".add_field_loc"); //Add button ID
    var add_button_ng      = $(".add_field_loc_ng"); //Add button ID
     //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
            x++; //text box increment
            var i;
            var good = document.getElementById("qty_good").value;
            var not_good = 0;
            var total = parseInt(good) + parseInt(not_good);
            
            var qty_all = 0;
            for (i = 0; i < x; i++) {
                var qty = document.getElementById("quantity"+i+"").value;
                console.log(qty);
                console.log(x);
                if(qty === null || qty === "" || qty === 0){

                }else {
                    qty_all = qty_all + parseInt(qty);
                }
            }
            if( qty_all >= total){
                x--;
                alert("All product has been located");
            } else {
                var option_area = '<option></option>';
                for (let i = 0; i < whs_area.length; i++) {
                    option_area +='<option value="'+whs_area[i].area_id+'">'+whs_area[i].wh_area_name+'</option>';
                    
                }
                $('.add_location').append(
                    '<div class="form-group row" style="margin-bottom: 0px !important;">\
                        <div class="col-12">\
                            <div class="form-group row">\
                                <div class="col-2">\
                                    <div class="input-group">\
                                        <select class="select form-control custom-select showproduct" value="" id="area_id'+x+'" name="area_id[]">'+option_area+'</select>\
                                    </div>\
                                </div>\
                                <div class="col-2">\
                                    <div class="input-group">\
                                        <select class="select form-control custom-select showproduct" value="" id="blok_id'+x+'" name="blok_id['+x+']"><option></option></select>\
                                    </div>\
                                </div>\
                                <div class="col-2">\
                                    <div class="input-group">\
                                        <select class="select form-control custom-select showproduct" value="" id="rak_id'+x+'" name="rak_id['+x+']"><option></option></select>\
                                    </div>\
                                </div>\
                                <div class="col-2">\
                                    <div class="input-group">\
                                        <select class="select form-control custom-select showproduct" value="" id="shelf_id'+x+'" name="shelf_id['+x+']"><option></option></select>\
                                    </div>\
                                </div>\
                                <div class="col-2">\
                                    <div class="input-group">\
                                        <input type="text" class="form-control " value="" id="sisa_kosong'+x+'" name="sisa_kosong['+x+']" placeholder="Shelf Availability">\
                                    </div>\
                                </div>\
                                <div class="col-1">\
                                    <div class="input-group">\
                                        <input type="text" class="form-control numbers" value="" id="quantity'+x+'" name="quantity['+x+']" placeholder="Quantity">\
                                    </div>\
                                </div>\
                                <div class="col-1">\
                                    <div class="input-group">\
                                        <a href="#" id="remove_field" data-repeater-delete class="btn btn-light-danger btn-md font-weight-bolder form-control">X</a>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                    </div>'
                ); //add input box
                // Use Javascript
            $('.select').select2({
                placeholder: 'Select an option'
            });

            $('#area_id'+x+'').change(function () {
                var area_id = document.getElementById('area_id'+x+'').value;
                // console.log(area_id);
                $.ajax({
                    method: 'POST',
                    url: base_url+"/location/get_blok",
                    beforeSend: function () {
                    },
                    dataType: "json",
                    data: {
                        area_id : area_id,
                    },
                    success: function (result) {
                        console.log(result.blok);
                        document.getElementById('blok_id'+x+'').innerHTML = result.blok;
                    }
                })
            });

            $('#blok_id'+x+'').change(function () {
                var blok_id = document.getElementById('blok_id'+x+'').value;
                // console.log(area_id);
                $.ajax({
                    method: 'POST',
                    url: base_url+"/location/get_rak",
                    beforeSend: function () {
                    },
                    dataType: "json",
                    data: {
                        blok_id : blok_id,
                    },
                    success: function (result) {
                        document.getElementById('rak_id'+x+'').innerHTML = result.rak;
                    }
                })
            });

            $('#rak_id'+x+'').change(function () {
                var rak_id = document.getElementById('rak_id'+x+'').value;
                // console.log(area_id);
                $.ajax({
                    method: 'POST',
                    url: base_url+"/location/get_shelf",
                    beforeSend: function () {
                    },
                    dataType: "json",
                    data: {
                        rak_id : rak_id,
                    },
                    success: function (result) {
                        document.getElementById('shelf_id'+x+'').innerHTML = result.shelf;
                    }
                })
            });

            $('#shelf_id'+x+'').change(function () {
                var shelf_id = document.getElementById('shelf_id'+x+'').value;
                // console.log(area_id);
                $.ajax({
                    method: 'POST',
                    url: base_url+"/location/get_availability",
                    beforeSend: function () {
                    },
                    dataType: "json",
                    data: {
                        shelf_id : shelf_id,
                    },
                    success: function (result) {
                        document.getElementById('sisa_kosong'+x+'').value = result.avail;
                    }
                })
            });

            }
            
    });

    $(add_button_ng).click(function(e){ //on add input button click
        e.preventDefault();
            x_ng++; //text box increment
            var i;
            var good = 0;
            var not_good = document.getElementById("qty_not_good").value;
            var total = parseInt(good) + parseInt(not_good);
            console.log('material ng ' + total);
            var qty_all = 0;
            for (i = 0; i < x_ng; i++) {
                var qty = document.getElementById("quantity_ng"+i+"").value;
                if(qty === null || qty === "" || qty === 0){

                }else {
                    qty_all = qty_all + parseInt(qty);
                }
            }
            console.log(qty_all);
            if( qty_all >= total){
                alert("All material has been located");
                x_ng--;
            } else {
                var option_area_ng = '<option></option>';
                for (let i = 0; i < whs_area_ng.length; i++) {
                    option_area_ng +='<option value="'+whs_area_ng[i].area_id+'">'+whs_area_ng[i].wh_area_name+'</option>';
                    
                }
                $(".add_location_ng").append(
                    '<div class="form-group row" style="margin-bottom: 0px !important;">\
                        <div class="col-12">\
                            <div class="form-group row">\
                                <div class="col-2">\
                                    <div class="input-group">\
                                        <select class="select form-control custom-select showproduct" value="" id="area_id_ng'+x_ng+'" name="area_id_ng[]">'+option_area_ng+'</select>\
                                    </div>\
                                </div>\
                                <div class="col-2">\
                                    <div class="input-group">\
                                        <select class="select form-control custom-select showproduct" value="" id="blok_id_ng'+x_ng+'" name="blok_id_ng['+x_ng+']"><option></option></select>\
                                    </div>\
                                </div>\
                                <div class="col-2">\
                                    <div class="input-group">\
                                    <select class="select form-control custom-select showproduct" value="" id="rak_id_ng'+x_ng+'" name="rak_id_ng['+x_ng+']"><option></option></select>\
                                    </div>\
                                </div>\
                                <div class="col-2">\
                                    <div class="input-group">\
                                    <select class="select form-control custom-select showproduct" value="" id="shelf_id_ng'+x_ng+'" name="shelf_id_ng['+x_ng+']"><option></option></select>\
                                    </div>\
                                </div>\
                                <div class="col-2">\
                                    <div class="input-group">\
                                    <input type="text" class="form-control " value="" id="sisa_kosong_ng'+x_ng+'" name="sisa_kosong_ng['+x_ng+']" placeholder="Shelf Availability">\
                                    </div>\
                                </div>\
                                <div class="col-1">\
                                    <div class="input-group">\
                                        <input type="text" class="form-control numbers" value="" id="quantity_ng'+x_ng+'" name="quantity_ng['+x_ng+']" placeholder="Quantity">\
                                    </div>\
                                </div>\
                                <div class="col-1">\
                                    <div class="input-group">\
                                        <a href="#" id="remove_field_ng" data-repeater-delete class="btn btn-light-danger btn-md font-weight-bolder form-control">X</a>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                    </div>'
                ); 
            $('.select').select2({
                placeholder: 'Select an option'
            });

            $('#area_id_ng'+x_ng+'').change(function () {
                var area_id = document.getElementById('area_id_ng'+x_ng+'').value;
                // console.log(area_id);
                $.ajax({
                    method: 'POST',
                    url: base_url+"/location/get_blok",
                    beforeSend: function () {
                    },
                    dataType: "json",
                    data: {
                        area_id : area_id,
                    },
                    success: function (result) {
                        document.getElementById('blok_id_ng'+x_ng+'').innerHTML = result.blok;
                    }
                })
            });

            $('#blok_id_ng'+x_ng+'').change(function () {
                var blok_id = document.getElementById('blok_id_ng'+x_ng+'').value;
                // console.log(area_id);
                $.ajax({
                    method: 'POST',
                    url: base_url+"/location/get_rak",
                    beforeSend: function () {
                    },
                    dataType: "json",
                    data: {
                        blok_id : blok_id,
                    },
                    success: function (result) {
                        document.getElementById('rak_id_ng'+x_ng+'').innerHTML = result.rak;
                    }
                })
            });

            $('#rak_id_ng'+x_ng+'').change(function () {
                var rak_id = document.getElementById('rak_id_ng'+x_ng+'').value;
                // console.log(area_id);
                $.ajax({
                    method: 'POST',
                    url: base_url+"/location/get_shelf",
                    beforeSend: function () {
                    },
                    dataType: "json",
                    data: {
                        rak_id : rak_id,
                    },
                    success: function (result) {
                        document.getElementById('shelf_id_ng'+x_ng+'').innerHTML = result.shelf;
                    }
                })
            });

            $('#shelf_id_ng'+x_ng+'').change(function () {
                var shelf_id = document.getElementById('shelf_id_ng'+x_ng+'').value;
                // console.log(area_id);
                $.ajax({
                    method: 'POST',
                    url: base_url+"/location/get_availability",
                    beforeSend: function () {
                    },
                    dataType: "json",
                    data: {
                        shelf_id : shelf_id,
                    },
                    success: function (result) {
                        console.log(result);
                        document.getElementById('sisa_kosong_ng'+x_ng+'').value = result.avail;
                    }
                })
            });

            }
            
    });
        
    $(wrapper).on("click","#remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').parent('div').parent('div').remove(); x--;
    });

    $(wrapper_ng).on("click","#remove_field_ng", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').parent('div').parent('div').remove(); x_ng--;
    });
});

function get_blok() {
    var area_id = document.getElementById('area_id0').value;
    // console.log(area_id);
    $.ajax({
        method: 'POST',
        url:  base_url+"/location/get_blok",
        beforeSend: function () {
        },
        dataType: "json",
        data: {
            area_id : area_id,
        },
        success: function (result) {
            document.getElementById('blok_id0').innerHTML = result.blok;
        }
    })
}

function get_rak() {
    var blok_id = document.getElementById('blok_id0').value;
    // console.log(area_id);
    $.ajax({
        method: 'POST',
        url:  base_url+"/location/get_rak",
        beforeSend: function () {
        },
        dataType: "json",
        data: {
            blok_id : blok_id,
        },
        success: function (result) {
            document.getElementById('rak_id0').innerHTML = result.rak;
        }
    })
}

function get_shelf() {
    var rak_id = document.getElementById('rak_id0').value;
    // console.log(area_id);
    $.ajax({
        method: 'POST',
        url:  base_url+"/location/get_shelf",
        beforeSend: function () {
        },
        dataType: "json",
        data: {
            rak_id : rak_id,
        },
        success: function (result) {
            document.getElementById('shelf_id0').innerHTML = result.shelf;
        }
    })
}

function get_avail() {
    var shelf_id = document.getElementById('shelf_id0').value;
    // console.log(area_id);
    $.ajax({
        method: 'POST',
        url:  base_url+"/location/get_availability",
        beforeSend: function () {
        },
        dataType: "json",
        data: {
            shelf_id : shelf_id,
        },
        success: function (result) {
            console.log(result);
            document.getElementById('sisa_kosong0').value = result.avail;
        }
    })
}

function get_blok_ng() {
    var area_id = document.getElementById('area_id_ng0').value;
    // console.log(area_id);
    $.ajax({
        method: 'POST',
        url: base_url+"/location/get_blok",
        beforeSend: function () {
        },
        dataType: "json",
        data: {
            area_id : area_id,
        },
        success: function (result) {
            document.getElementById('blok_id_ng0').innerHTML = result.blok;
        }
    })
}

function get_rak_ng() {
    var blok_id = document.getElementById('blok_id_ng0').value;
    // console.log(area_id);
    $.ajax({
        method: 'POST',
        url: base_url+"/location/get_rak",
        beforeSend: function () {
        },
        dataType: "json",
        data: {
            blok_id : blok_id,
        },
        success: function (result) {
            document.getElementById('rak_id_ng0').innerHTML = result.rak;
        }
    })
}

function get_shelf_ng() {
    var rak_id = document.getElementById('rak_id_ng0').value;
    // console.log(area_id);
    $.ajax({
        method: 'POST',
        url: base_url+"/location/get_shelf",
        beforeSend: function () {
        },
        dataType: "json",
        data: {
            rak_id : rak_id,
        },
        success: function (result) {
            document.getElementById('shelf_id_ng0').innerHTML = result.shelf;
        }
    })
}

function get_avail_ng() {
    var shelf_id = document.getElementById('shelf_id_ng0').value;
    // console.log(area_id);
    $.ajax({
        method: 'POST',
        url:  base_url+"/location/get_availability",
        beforeSend: function () {
        },
        dataType: "json",
        data: {
            shelf_id : shelf_id,
        },
        success: function (result) {
            console.log(result);
            document.getElementById('sisa_kosong_ng0').value = result.avail;
        }
    })
}
function validate_form(){
    var i;
    var good = document.getElementById("qty_good").value;
    var not_good = document.getElementById("qty_not_good").value;
    var total = parseInt(good) + parseInt(not_good);

    var qty_good = 0;
    var qty_ng   = 0;
    var qty_all  = 0;
    for (i = 0; i <= x; i++) {
        var qty = document.getElementById("quantity"+i+"").value;
        if(qty === null || qty === ''){
            qty = 0;
        }
        qty_all = qty_all + parseInt(qty);
        qty_good = qty_good + parseInt(qty);
    }
    for (i = 0; i <= x_ng; i++) {
        var qty = document.getElementById("quantity_ng"+i+"").value;
        if(qty === null || qty === ''){
            qty = 0;
        }
        qty_all = qty_all + parseInt(qty);
        qty_ng = qty_ng + parseInt(qty);
    }

    if(qty_good === null || qty_good === ''){
        qty_good = 0;
    }
    // console.log(document.getElementById("quantity_ng0").value);

    if(qty_ng === null || qty_ng === ''){
        qty_ng = 0;
    }

    if(qty_all !== total){
        alert("Product quantity doesn't match");
        return false;
    }
}