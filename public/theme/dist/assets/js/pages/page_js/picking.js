var idx = 0;
var newProdIsert = [];
$(document).ready(function() {
    $('#material_id_outbound').change(function(){ 
        var id=$('#material_id_outbound').val();
        
        $.ajax({
            url : base_url+"/outbound/get_location_bymaterial",
            method : "POST",
            data : {owner_id: owner_id, warehouse_id: id_wh, material_id: id},
            async : true,
            dataType : 'json',
            success: function(data){
                var html = '<option value="" selected></option>';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].location_id+'>'+data[i].wh_area_name+'-'+data[i].blok_name+'-'+data[i].rak_name+'-'+data[i].shelf_name+'</option>';
                }
                
                $('#location_id_outbound').html(html);

            }
        });
        return false;
    });
    
    $('#location_id_outbound').change(function(){ 
        var mat_id=$('#material_id_outbound').val();
        var id=$(this).val();
        $.ajax({
            url : base_url+"/picking/get_qty_bylocation",
            method : "POST",
            data : {owner_id: owner_id, warehouse_id: id_wh, material_id: mat_id, location_id: id, po_id: idPO},
            async : true,
            dataType : 'json',
            success: function(data){
                var i;
                for(i=0; i<data.length; i++){
                    newProdIsert = data[i];
                    $('#qty_outbound').val(data[i].stock);
                }
                
            }
        });
        return false;
    });

    $( "#modalMaterial" ).on('shown.bs.modal', function(){
        // clear form modal
        $('#material_id_outbound').val(null).trigger('change');
        $('#location_id_outbound').val(null).trigger('change');
        $('#qty_outbound').val(null);
        $('#quantity').val(null);
    });

    $("#addProduct").click(function(event, param) {
        var active = 1;
        if(typeof param == "undefined") {
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Data empty'
            });
            return;
        }
        
        idx++; 
        var row = "<tr data-attr='"+idx+"' id='idx-"+idx+"' class='rowTbl'>" +
                    "<td>"+
                        param.mat_detail_id+
                        "<input type='hidden' name='po_outbound_id[]' id='po_outbound_id_"+idx+"' data-attr='"+idx+"' value='"+param.po_outbound_id+"'/>" +
                        "<input type='hidden' name='po_det_outbound_id[]' id='po_det_outbound_id_"+idx+"' data-attr='"+idx+"' value='"+param.po_det_outbound_id+"'/>" +

                        "<input type='hidden' name='location_id[]' id='location_id_"+idx+"' data-attr='"+idx+"' value='"+param.location_id+"'/>" +
                        "<input type='hidden' name='mat_detail_id[]' id='mat_detail_id_"+idx+"' data-attr='"+idx+"' value='"+param.mat_detail_id+"'/>" +
                        "<input type='hidden' name='material_id[]' id='material_id_"+idx+"' data-attr='"+idx+"' value='"+param.material_id+"'/>" +
                        "<input type='hidden' name='shelf_id[]' id='shelf_id_"+idx+"' data-attr='"+idx+"' value='"+param.shelf_id+"'/>" +
                        "<input type='hidden' name='qty_request[]' id='qty_request_"+idx+"' data-attr='"+idx+"' value='"+param.qty_request+"'/>" +
                        "<input type='hidden' name='stock[]' id='stock_"+idx+"' data-attr='"+idx+"' value='"+param.stock+"'/>" +
                    "</td>" +
                    "<td id='text_matrial_code_"+idx+"'>" + param.material_code + "</td>" +
                    "<td id='text_matrial_name_"+idx+"'>" + 
                        param.material_name + "<br/>" +
                        "Batch : " + param.batch_no + "<br/>" +
                        "Exp. : " + param.expired_date + "<br/>" +
                    "</td>" +
                    "<td> " +
                        param.wh_area_name + "<br/>" +
                        param.rak_name + "<br/>" +
                        param.shelf_name + "<br/>" +
                    "</td>" +
                    "<td id='text_uom_"+idx+"'>" + param.uom_name + "</td>" +
                    "<td style='text-align: right;'>" + param.stock + "</td>" +
                    "<td style='text-align: center;'>" +
                        "<input type='text' id='qty_"+idx+"' style='width: 55px;' onkeypress='return CheckNumeric()' onblur='checkProductQty("+idx+")' name='qty[]' value='"+param.qty_realisasi+"' required />"+
                    "</td>" +
                    "<td style='text-align: center;'>"+
                        "<a type='button' onclick='removeRow(\"idx-\","+idx+");' ><span class='svg-icon svg-icon-danger svg-icon-md'><svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1'><g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'><rect x='0' y='0' width='24' height='24'></rect><circle fill='#000000' opacity='0.3' cx='12' cy='12' r='10'></circle><path d='M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z' fill='#000000'></path></g></svg></span></a>"+
                    "</td>" +
                  "</tr>";
        $('#grid-body').append(row);
        
    });

    $( "#btn-save" ).click(function() {
        $("#btn-save").prop('disabled', true);
        var error = false;
        var msgError = "";

        // get data detail
        var dataDetail = [];
        var no_ = 0;
        $('.rowTbl').each(function(x,y){
            no_ ++;
            var cIdx = $(this).attr('data-attr');
            var mat_id = $('#mat_detail_id_'+cIdx).val();
            var idProd = $('#material_id_'+cIdx).val();
            var qtyReq = $('#qty_request_'+cIdx).val();
            var qty = $('#qty_'+cIdx).val();

            if(typeof dataDetail[idProd] == "undefined") { 
                dataDetail[idProd] = [];

                dataDetail[idProd]['product_id'] = mat_id;
                dataDetail[idProd]['product_code'] = $('#text_matrial_code_'+cIdx).text();
                dataDetail[idProd]['product_name'] = $('#text_matrial_name_'+cIdx).text();
                dataDetail[idProd]['unit'] = $('#text_uom_'+cIdx).text();
                dataDetail[idProd]['qty_request'] = parseInt(qtyReq);
                dataDetail[idProd]['qty'] = parseInt(qty);
            } else {
                dataDetail[idProd]['qty'] += parseInt(qty);
            }
        });

        if (jQuery.isEmptyObject(dataDetail)) {
            error = true;
            var msg = "Detail product is not empty";
            msgError += msg+"<br/>";
        }

        if(!error) {
            var error2 = false;
            var varTab = "<table id='tbl-error'>";
            var header = true;
            $.each(detail_po, function( index, value ) {
                var errorDet = false;
                var real = 0;
                if(typeof dataDetail[value.material_id] == "undefined") {
                    error2 = true;
                    errorDet = true;
                } else {
                    if(dataDetail[value.material_id].qty!=value.outbound_qty) {
                        error2 = true;
                        errorDet = true;
                        var real = dataDetail[value.material_id].qty;
                    }
                }
                if (errorDet) {
                    if (header) {
                        varTab += "<tr>\
                                    <th>Product Code</th>\
                                    <th>Product Name</th>\
                                    <th>Unit</th>\
                                    <th>Qty Request</th>\
                                    <th>Qty Realization</th>\
                                </tr>";
                        header = false;
                    }
                    varTab += "<tr>\
                                    <td>"+value.material_code+"</td>\
                                    <td>"+value.material_name+"</td>\
                                    <td>"+value.uom_name+"</td>\
                                    <td>"+value.outbound_qty+"</td>\
                                    <td>"+real+"</td>\
                                </tr>";
                }
                
            });
            varTab += "</table>";
            if(!error2) {
                var formData    = new FormData($("#form-picking")[0]);
                $.ajax({
                    type: "POST",
                    url: base_url + "/picking/save",
                    dataType:'json',
                    data: formData,
                    async : false,
                    success: function(result){
                        if(result.code == '204') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                html: result.msg,
                                width: 800
                            });
                        } else if(result.code == '200') {
                            Swal.fire({
                                icon: 'info',
                                title: 'Success...',
                                html: result.msg
                            });
                            setTimeout(
                                function(){ window.location.replace(base_url + "/picking");
                                }, 1000);
                        }
                        $("#btn-save").prop('disabled', false);
                    },
                    cache:false,
                    contentType: false,
                    processData: false
                });
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'please check again, the data does not match the request!',
                    html: varTab,
                    width: 800
                })
                $("#btn-save").prop('disabled', false);
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: msgError
            });
            $("#btn-save").prop('disabled', false);
        }
    });

    if (dataProdReq.length>0) {
        for (let i = 0; i < dataProdReq.length; i++) {
            $('#addProduct').trigger('click',dataProdReq[i]);
        }
    }

});

function removeRow(prefix, idx) {
    $('#'+prefix+idx).remove();
}

function setTable(){
    var quantity = document.getElementById('quantity').value;
    var stock = document.getElementById('qty_outbound').value;

    if(parseInt(quantity) > parseInt(stock)){
        Swal.fire({
            icon: 'info',
            title: 'Oops...',
            text: 'Quantity out of stock!'
        });
        return;
    } else if (parseInt(quantity)==0) {
        Swal.fire({
            icon: 'info',
            title: 'Oops...',
            text: 'Quantity cannot be empty !'
        });
        return;
    } else {
        $check = check_data_table(newProdIsert.location_id);
        if ($check) {
            newProdIsert.qty_realisasi = parseInt(quantity);
            $('#addProduct').trigger('click',newProdIsert);

            $('#modalMaterial').modal('hide');
            newProdIsert = [];
        } else {
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Product already exists.!'
            });
            return;
        }
    }
}

function check_data_table(location_id="") {
    var status = true;
    $('.rowTbl').each(function(x,y){
        var cIdx = $(this).attr('data-attr');
        var kode = $('#location_id_'+cIdx).val();
        if(kode == location_id)
            status = false;
    });
    return status;
}

function checkProductQty(idx_){
    var stock = parseInt($("#stock_"+idx_).val());
    var qty = parseInt($("#qty_"+idx_).val());

    if (qty<=0) {
        Swal.fire({
            icon: 'info',
            title: 'Oops...',
            html: 'Quantity cannot be empty! <br/>If zero the number will be filled 1.'
        });
        $("#qty_"+idx_).val(1);
    }

    if (qty>stock) {
        Swal.fire({
            icon: 'info',
            title: 'Oops...',
            html: 'Quantity out of stock! <br/>If the quantity exceeds the stock it will be filled as much as the available stock.'
        });
        $("#qty_"+idx_).val(stock);
    }
}