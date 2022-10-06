
var uu = document.getElementById("f_nonmarketplace");
var ee = document.getElementById("f_marketplace");
var sh = document.getElementById("ship_row");
var ins = document.getElementById("ins_row");
var tot = document.getElementById("total_row");
uu.style.display = "none";
ee.style.display = "none";
sh.style.display = "none";
ins.style.display = "none";
tot.style.display = "none";

$(document).ready(function() {
    $("#transporter_name").select2({
        tags: true
    });

    $("#btn-save" ).click(function() {
        var error = false;
        var msgError = "";
        var transaction_from = $("#transaction_from");

        // Transaction From
        if (transaction_from.val().trim()=="") {
            error = true;
            var msg = "Transaction From is required!";
            msgError += msg+"<br/>";
            $("#transaction_from_error").text(msg);
        } else {
            $("#transaction_from_error").text("");
        }

        if (transaction_from.val()=="Marketplace") {
            // courier
            var transporter_name = $("#transporter_name");
            if (transporter_name.val().trim()=="") {
                error = true;
                var msg = "Courier is required!";
                msgError += msg+"<br/>";
                $("#transporter_name_error").text(msg);
            } else {
                $("#transporter_name_error").text("");
            }

            // Resi Number
            var resi_number = $("#resi_number");
            if (resi_number.val().trim()=="") {
                error = true;
                var msg = "Resi number is required!";
                msgError += msg+"<br/>";
                $("#resi_number_error").text(msg);
            } else {
                $("#resi_number_error").text("");
            }
        } else {
            // courier radio button
            var courier_radio = $('input[name="transporter_id"]:checked');
            if (typeof courier_radio.val() == 'undefined' || courier_radio.val()=="") {
                error = true;
                var msg = "Choose courier is required!";
                msgError += msg+"<br/>";
                $("#transporter_id_error").text(msg);
            } else {
                $("#transporter_id_error").text("");
            }
        }

        if(!error) {
            $( "#form-outboundpo" ).submit();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: msgError
            });
        }
    });
})

function transactionFrom() {
    var transaction_from = document.getElementById("transaction_from").value;
    if (transaction_from == 'Marketplace') {
        var w = document.getElementById("f_marketplace");
        var z = document.getElementById("f_nonmarketplace");
        w.style.display = "block";
        z.style.display = "none";
    }

    if (transaction_from == 'Non Marketplace') {
        var w = document.getElementById("f_nonmarketplace");
        var z = document.getElementById("f_marketplace");
        w.style.display = "block";
        z.style.display = "none";
    }
}

function insuranceChanged()
{
    var transporter_id = $( 'input[name=transporter_id]:checked' ).val();
    if(transporter_id == 1){
        if($('#ins_check').is(":checked")){
            ins.style.display = "";
            var formattedFee = parseFloat($('#fee').val()) + parseFloat($('#feeTax').val());
            var formattedInsurance = parseFloat($('#insurance').val()) + parseFloat($('#insuranceTax').val());
            var totalFee = formattedFee + formattedInsurance
            document.getElementById("shipping_fee").innerHTML = formattedFee.toLocaleString();
            document.getElementById("insurance_fee").innerHTML = formattedInsurance.toLocaleString();
            document.getElementById("total_fee").innerHTML = totalFee.toLocaleString();
        } else {
            ins.style.display = "none";
            var formattedFee = parseFloat($('#fee').val()) + parseFloat($('#feeTax').val());
            var totalFee = formattedFee;
            document.getElementById("shipping_fee").innerHTML = formattedFee.toLocaleString();
            document.getElementById("total_fee").innerHTML = totalFee.toLocaleString();
        }
    } else { //kondisi ketika kurir yang dipilih adalah sicepat.
        if($('#ins_check').is(":checked")){
            ins.style.display = "";
            var fee = parseFloat($('#totalFee').val());
            var insurance = parseFloat($('#price_tot').val()) * 0.0025;
            var totalFee = fee +  Math.round(insurance);
            document.getElementById("shipping_fee").innerHTML = fee.toLocaleString();
            document.getElementById("insurance_fee").innerHTML = Math.round(insurance).toLocaleString();
            document.getElementById("total_fee").innerHTML = totalFee.toLocaleString();
        } else {
            ins.style.display = "none";
            var totalFee = parseFloat($('#totalFee').val());
            document.getElementById("shipping_fee").innerHTML = totalFee.toLocaleString();
            document.getElementById("total_fee").innerHTML = totalFee.toLocaleString();;
        }
    }
}

function getCourierService() {
    var customer_id = $('#customer_id').val();
    var po_outbound_id = $('#po_outbound_id').val();
    var warehouse_id_outboundpo = $('#warehouse_id_outboundpo').val();
    // var transporter_id = $('#transporter_id').val();
    var transporter_id = $( 'input[name=transporter_id]:checked' ).val();
    var outbound_qty_tot = $('#outbound_qty_tot').val();
    var weight_tot = $('#weight_tot').val();
    var height_tot = $('#height_tot').val();
    var length_tot = $('#length_tot').val();
    var width_tot = $('#width_tot').val();
    var price_tot = $('#price_tot').val();

    if(transporter_id == 1){
        $('#ins_check').prop('checked', true);
    } else {
        var price_tot_int = parseInt(price_tot);
        if(price_tot_int > 500000){
            $('#ins_check').prop('checked', true);
            $('.checkbox').hide();
        } else {
            $('#ins_check').prop('checked', false);
        }
    }

    // var data_parse = {"customer_id": customer_id, "warehouse_id_outboundpo": warehouse_id_outboundpo, "transporter_id": transporter_id, "outbound_qty_tot": outbound_qty_tot, "weight_tot": weight_tot, "height_tot": height_tot, "length_tot": length_tot, "width_tot": width_tot};
    $.ajax({
        url : base_url_new + '/outboundpo/get_courier_service?customer_id='+customer_id+'&warehouse_id_outboundpo='+warehouse_id_outboundpo+'&transporter_id='+transporter_id+'&outbound_qty_tot='+outbound_qty_tot+'&weight_tot='+weight_tot+'&height_tot='+height_tot+'&length_tot='+length_tot+'&width_tot='+width_tot+'&price_tot='+price_tot+'&po_outbound_id='+po_outbound_id,
        method : "GET",
        beforeSend: function() {
            $('#service_id').empty();
        },
        success: function(data) {      
            $('#service_id').html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR, textStatus, errorThrown);
        }
    });
}

function getOneService() { // ubah disini
    var customer_id = $('#customer_id').val();
    var warehouse_id_outboundpo = $('#warehouse_id_outboundpo').val();
    // var transporter_id = $('#transporter_id').val();
    var transporter_id = $( 'input[name=transporter_id]:checked' ).val();
    var outbound_qty_tot = $('#outbound_qty_tot').val();
    var weight_tot = $('#weight_tot').val();
    var height_tot = $('#height_tot').val();
    var length_tot = $('#length_tot').val();
    var width_tot = $('#width_tot').val();
    var price_tot = $('#price_tot').val();
    var service_id = $('#service_id').val();

    $.ajax({
        url : base_url_new + '/outboundpo/get_courier_service?customer_id='+customer_id+'&warehouse_id_outboundpo='+warehouse_id_outboundpo+'&transporter_id='+transporter_id+'&outbound_qty_tot='+outbound_qty_tot+'&weight_tot='+weight_tot+'&height_tot='+height_tot+'&length_tot='+length_tot+'&width_tot='+width_tot+'&price_tot='+price_tot+'&service_id='+service_id,
        method : "GET",
        beforeSend: function() {
            $('#input_date').html('');
        },
        success: function(data) {
            $('#input_date').html(data);
            if(transporter_id == 1){
                sh.style.display = "";
                ins.style.display = "";
                tot.style.display = "";
                var totalFee = $('#totalFee').val();
                var formattedFee = parseFloat($('#fee').val()) + parseFloat($('#feeTax').val());
                var formattedInsurance = parseFloat($('#insurance').val()) + parseFloat($('#insuranceTax').val());
                document.getElementById("shipping_fee").innerHTML = formattedFee.toLocaleString();
                document.getElementById("insurance_fee").innerHTML = formattedInsurance.toLocaleString();
                document.getElementById("total_fee").innerHTML = parseFloat(totalFee).toLocaleString();
            } else {
                if(parseInt(price_tot) > 500000){
                    sh.style.display = "";
                    ins.style.display = "";
                    tot.style.display = "";
                    var fee = parseFloat($('#totalFee').val());
                    var insurance = parseFloat($('#price_tot').val()) * 0.0025;
                    var totalFee = fee +  Math.round(insurance);
                    document.getElementById("shipping_fee").innerHTML = fee.toLocaleString();
                    document.getElementById("insurance_fee").innerHTML = Math.round(insurance).toLocaleString();
                    document.getElementById("total_fee").innerHTML = totalFee.toLocaleString();
                } else {
                    sh.style.display = "";
                    tot.style.display = "";
                    var totalFee = parseFloat($('#totalFee').val());
                    document.getElementById("shipping_fee").innerHTML = totalFee.toLocaleString();
                    document.getElementById("total_fee").innerHTML = totalFee.toLocaleString();
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR, textStatus, errorThrown);
        }
    });
}

function form_add_cust() {
    // var shelf_id = document.getElementById('shelfmats'+idx+'').value;
    // e.preventDefault();
    // AJAX request
    $.ajax({
        url: 'customer/form_add_customer',
        type: 'post',
        // data: {shelf_id: shelf_id},
        success: function(response){ 
            // Add response in Modal body
            // console.log(response);
            $('#add_customer').html(response); 
            $('#customer_id').prop('disabled', 'disabled');
            $('#customer_add').val(1); 
        }
    });
}

function form_view_cust() {
    var customer_id = document.getElementById('customer_id').value;
    // e.preventDefault();
    // AJAX request
    $.ajax({
        url: 'customer/form_edit_customer',
        type: 'post',
        data: {customer_id: customer_id},
        success: function(response){ 
            // Add response in Modal body
            // console.log(response);
            $('#add_customer').html(response); 
            $('#btn_add_cus').remove();
            $('#customer_add').val(0); 
        }
    });
}

function getBoxRecommendation(){
    if($('#add_pack_box').is(":checked")){
        var all_volume = 0;
        $('.total_volume').each(function() {
            all_volume += parseInt($(this).val());
        });
        $('#total_all_volume').html('<input type="hidden" name="total_all_volume" class="total_all_volume" value="'+all_volume+'"/>');
        $.ajax({
            url : base_url_new + "/outboundpo/get_packing_kardus_ver2?total_all_volume="+all_volume,
            method : "GET",
            beforeSend: function() {
                $('#box_recommendation').empty();
            },
            success: function(data) {
                $('#box_recommendation').html(data);
            }
        });
    } else {
        $('#box_recommendation').empty();
    }
}

function getAdditionalPackaging(){
    if($('#additional_pack_checkbox').is(":checked")){
        $('#additional_packaging').show();
        $("#pm_id0").prop('required', true);
    } else {
        $('#additional_packaging').hide();
        $("#pm_id0").prop('required', false);
    }
}