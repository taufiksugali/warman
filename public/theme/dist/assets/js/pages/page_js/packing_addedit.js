var idx = 0;
$(document).ready(function() {
    $('#scan-barcode').focus();
    $("#btn-scan").click(function() {
        $("#btn-scan").hide();
        $("#scan-barcode").show();
        $("#btn-select").show();
        $("#select-product").hide();
        $("#text-search").text("Scan Barcode Product/Product ID");
    });

    $("#btn-select").click(function() {
        $("#btn-scan").show();
        $("#scan-barcode").hide();
        $("#btn-select").hide();
        $("#select-product").show();
        $("#text-search").text("Select Product");
    });

    $('#custom_fee').change(function() {
        if(this.checked) {
            $(".custom_fee_text").attr("readonly", false); 
            $(".custom_fee_text").removeClass("form-control-solid");
        } else {
            $(".custom_fee_text").attr("readonly", true); 
            $(".custom_fee_text").addClass("form-control-solid");
            $("#packing_fee").val(packing_fee);
            $("#admin_fee").val(admin_fee);
            $("#custom_service_fee").val(custom_service_fee);
        }
        // $('#textbox1').val(this.checked);        
    });

    $("#selectProduct").select2({
        ajax: {
          url: base_url+'/packing/getProductItem/'+idPO,
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              q: params.term,
              page: params.page
            };
          },
          processResults: function (data, page) {
            return {
              results: data.items  
            };
          },
          cache: true
        },
        escapeMarkup: function (markup) { return markup; },
        minimumInputLength: 3,
        templateResult: formatRepo,
        templateSelection: formatRepoSelection 
    });   

    $("#selectProduct").on("select2:select", function(e) {
        var data = e.params.data;
        data.qty = 1;
        $('#addProduct').trigger('click',data);
        $('#selectProduct').val('').trigger('change');
    });

    $('#scan-barcode').keypress(function(e){
        var keycode = (e.keyCode ? e.keyCode : e.which);
        var value = e.currentTarget.value;
        if(keycode == '13' && value != ""){           
            $.ajax({
                type: 'POST',
                url: base_url+'/packing/getProductByBarcode/'+idPO,
                data: '&barcode='+value,
                dataType:'json',
                success: function(result){
                    if(result.code=='200') {
                        var data = result.data;
                        data.qty = 1;
                        $('#addProduct').trigger('click', data);
                    } else if (result.code == '204' || result.code == '403') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: result.msg
                        });
                    }
                }
            });
            this.value = "";
            this.focus();
            e.preventDefault();
        }
        if (keycode == '13') {
            e.preventDefault();
        }
    });

    $("#addProduct").click(function(event, param) {
        if(typeof param == "undefined") {
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Data empty'
            });
            return;
        }else{
            var status = true;
            $('.rowTbl').each(function(x,y){
                var cIdx = $(this).attr('data-attr');
                var kode = $('#material_id_'+cIdx).val();
                var qty = parseFloat($('#qty_'+cIdx).val());
                if(kode == param.id) {
                    $('#qty_'+cIdx).val(qty + 1);
                     status = false;
                    return;
                }
                   
            });
            if(!status) {
                return;
            }
        }
        var barcode = "";
        if(param.barcode!=""){
            barcode += param.barcode;
        }

        idx++; 
        var row = "<tr data-attr='"+idx+"' id='idx-"+idx+"' class='rowTbl'>" +
                    "<td>"+
                        param.barcode+
                        "<input type='hidden' name='material_id[]' id='material_id_"+idx+"' data-attr='"+idx+"' value='"+param.id+"'/>" +
                        "<input type='hidden' name='qty_request[]' id='qty_request_"+idx+"' data-attr='"+idx+"' value='"+param.qty_request+"'/>" +
                    "</td>" +
                    "<td>" + param.material_code + "</td>" +
                    "<td>" + param.material_name + "</td>" +
                    "<td>" + param.uom_name + "</td>" +
                    "<td style='text-align: center;'>" +
                        "<input type='text' id='qty_"+idx+"' style='width: 100px;' onkeypress='return CheckNumeric()' name='qty[]' value='"+param.qty+"' required />"+
                    "</td>" +
                  "</tr>";
        $('#grid-body').append(row);
    });

    $( "#btn-save" ).click(function() {
        $("#btn-save").prop('disabled', true);
        var error = false;
        var msgError = "";

        if($("#custom_fee").is(':checked')) {
            var pf = parseInt($('#packing_fee').val());
            if (pf<=0) {
                var error = false;
                var msg = "Packing fee is not empty<br/>";
                msgError += msg;
            }
            
            var af = parseInt($('#admin_fee').val());
            if (af<=0) {
                var error = false;
                var msg = "Admin fee is not empty<br/>";
                msgError += msg;
            }
        }

        // check detail
        var dataDetail = [];
        var no_ = 0;
        $('.rowTbl').each(function(x,y){
            no_ ++;
            var cIdx = $(this).attr('data-attr');
            var idProd = $('#material_id_'+cIdx).val();
            var qty = $('#qty_'+cIdx).val();
            if(typeof dataDetail[idProd] == "undefined") { 
                dataDetail[idProd] = parseInt(qty);
            } else {
                dataDetail[idProd] += parseInt(qty);
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
                    if(dataDetail[value.material_id]!=value.outbound_qty) {
                        error2 = true;
                        errorDet = true;
                        var real = dataDetail[value.material_id];
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
                    url: base_url + "/packing/save",
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
                                function(){ 
                                    window.open(base_url + "/outboundhistory/print_outbound_bast/"+result.data);
                                    window.location.replace(base_url + "/packing");
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
        }
    });

});

function removeRow(prefix, idx) {
    $('#'+prefix+idx).remove();
}

function formatRepo (repo) {
    if (repo.loading) return repo.text;

    var markup = '<div class="clearfix">' +
                    '<div class="col-sm-5">' + repo.material_code + '</div>' +
                    '<div class="col-sm-7">' + repo.material_name + '</div>' +
                '</div>';
    return markup;
}

function formatRepoSelection (repo) {
    return repo.material_code || repo.material_name;
}

function infoCustomFee() {
    var text_ = "- STORI E-Production Services powered by Zalora<br/>\
                - iHub (International Logistics Hub)<br/>\
                - Custom Packaging";
    Swal.fire({
        icon: 'info',
        title: 'which includes the custom fee are:',
        html: text_,
        width: 500
    });
}
