var idx = 0;
$(document).ready(function() {
    $("#btn-scan").click(function() {
        $("#btn-scan").hide();
        $("#scan-barcode").show();
        $("#btn-select").show();
        $("#select-product").hide();
        $("#text-search").text("Scan Barcode Product");
    });

    $("#btn-select").click(function() {
        $("#btn-scan").show();
        $("#scan-barcode").hide();
        $("#btn-select").hide();
        $("#select-product").show();
        $("#text-search").text("Select Product");
    });

    $('#new-line').change(function() {
        $('#scan-barcode').focus();
    });

    $("#selectProduct").select2({
        ajax: {
          url: base_url+'/inbound/getProductItem/'+idPO,
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
                url: base_url+'/inbound/getProductByBarcode/'+idPO,
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
        var active = 1;
        if(typeof param == "undefined") {
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Data empty'
            });
            return;
        }else{
            var status = true;
            var line = $("input[name='new-line']:checked").length;
            if(typeof param.line != "undefined")
                line = param.line;

            $('.rowTbl').each(function(x,y){
                var cIdx = $(this).attr('data-attr');
                var kode = $('#material_id_'+cIdx).val();
                var qty = parseFloat($('#qty_'+cIdx).val());
                var activeRow = parseFloat($('#active'+cIdx).val());
                if(kode == param.material_id && line == 1) {
                    $('#active'+cIdx).val(0);
                    $('#qty_'+cIdx).prop('readonly', true);
                    $('#qty_'+cIdx).css("background-color", "#e1e1e1");;
                }               
                if(kode == param.material_id && activeRow == 1 && line == 0) {
                    $('#qty_'+cIdx).val(qty + 1);
                    $('#active'+cIdx).val(1);
                    checkProductStatus(cIdx)
                     status = false;
                    return;
                }
                   
            });
            if(!status) {
                return;
            }
        }
        var mat_name = param.material_name;
        if(param.barcode!=""){
            mat_name += "<br/>Barcode: "+param.barcode;
        }

        idx++; 
        var row = "<tr data-attr='"+idx+"' id='idx-"+idx+"' class='rowTbl'>" +
                    "<td>"+
                        param.material_code+
                        "<input type='hidden' name='active[]' id='active"+idx+"' data-attr='"+idx+"' value='"+active+"'/>" +
                        "<input type='hidden' name='purchase_order[]' id='purchase_order_"+idx+"' data-attr='"+idx+"' value='"+param.po_detail_id+"'/>" +
                        "<input type='hidden' name='material_price[]' id='material_price_"+idx+"' data-attr='"+idx+"' value='"+param.material_price+"'/>" +
                        "<input type='hidden' name='check[]' id='check_"+idx+"' data-attr='"+idx+"' value='1'/>" +
                        "<input type='hidden' name='material_id[]' id='material_id_"+idx+"' data-attr='"+idx+"' value='"+param.material_id+"'/>" +
                        "<input type='hidden' name='good[]' id='good_"+idx+"' data-attr='"+idx+"' value='0'/>" +
                        "<input type='hidden' name='not_good[]' id='not_good_"+idx+"' data-attr='"+idx+"' value='0'/>" +
                    "</td>" +
                    "<td>" + mat_name + "</td>" +
                    "<td style='text-align: center;'>" + 
                        "<input type='text' id='weight_"+idx+"' value='"+param.material_weight+"' style='width: 55px;' onkeypress='return CheckNumeric()' name='weight[]' required /> "+
                    "</td>" +
                    "<td>" +
                        "<input type='text' id='length_"+idx+"' value='"+param.material_length+"' style='width: 55px;' onkeypress='return CheckNumeric()' name='length[]' required />" + 
                    "</td>" +
                    "<td>" +
                        "<input type='text' id='width_"+idx+"' value='"+param.material_width+"' style='width: 55px;' onkeypress='return CheckNumeric()' name='width[]' required />" + 
                    "</td>" +
                    "<td>" +
                        "<input type='text' id='height_"+idx+"' value='"+param.material_height+"' style='width: 55px;' onkeypress='return CheckNumeric()' name='height[]' required />" + 
                    "</td>" +
                    "<td>" +
                        "<input type='text' style='width: 100%;' id='batch_"+idx+"' name='batch[]' required/>"+
                    "</td>" +
                    "<td style='text-align: center;'>" +
                        "<input type='text' class='datepicker_2' readonly='readonly' style='width: 100px;'  id='exp_"+idx+"' name='exp[]' required/>"+
                    "</td>" +
                    "<td style='text-align: center;'>" +
                        "<input type='text' id='qty_"+idx+"' style='width: 55px;' onkeypress='return CheckNumeric()' onkeyup='checkProductStatus("+idx+");' name='qty[]' value='"+param.qty+"' required />"+
                    "</td>" +
                    "<td style='text-align: center;'>" +
                        "<input type='checkbox' onclick='checkProductStatus("+idx+");' class='listCheckbox purchaseCheck' id='check_not_good_"+idx+"' name='check_not_good[]' value='1'/>"+
                    "</td>" +
                    "<td style='text-align: center;'>"+
                        "<a type='button' onclick='removeRow(\"idx-\","+idx+");' " + status + " ><span class='svg-icon svg-icon-danger svg-icon-md'><svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1'><g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'><rect x='0' y='0' width='24' height='24'></rect><circle fill='#000000' opacity='0.3' cx='12' cy='12' r='10'></circle><path d='M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z' fill='#000000'></path></g></svg></span></a>"+
                    "</td>" +
                  "</tr>";
        $('#grid-body').append(row);
        checkProductStatus(idx);
        $('#exp_'+idx).datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });
        
        $("#new-line").prop("checked", false);
    });

    $( "#btn-save" ).click(function() {
        var error = false;
        var msgError = "";
        var receive = $("#rec_by");

        // receive by
        if (receive.val().trim()=="") {
            error = true;
            var msg = "Receive by is required!";
            msgError += msg+"<br/>";
            receive.next().text(msg);
        } else {
            receive.next().text("");
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

            var batch_ = $('#batch_'+cIdx).val();
            if (batch_.trim()=="") {
                error = true;
                var msg = "Batch row "+no_+" not empty!";
                msgError += msg+"<br/>";
            }

            var exp_ = $('#exp_'+cIdx).val();
            if (exp_.trim()=="") {
                error = true;
                var msg = "Exp. Date row "+no_+" not empty!";
                msgError += msg+"<br/>";
            }
        });

        if (jQuery.isEmptyObject(dataDetail)) {
            error = true;
            var msg = "Detail product is not empty";
            msgError += msg+"<br/>";
        }

        if(!error) {
            var error2 = false;
            var varTab = "<table id='tbl-error'>"
            var header = true;
            $.each(dataProdReq, function( index, value ) {
                var errorDet = false;
                var real = 0;
                if(typeof dataDetail[value.id] == "undefined") {
                    error2 = true;
                    errorDet = true;
                } else {
                    if(value.qty!=dataDetail[value.id]) {
                        error2 = true;
                        errorDet = true;
                        real = dataDetail[value.id]
                    }
                }
                if (errorDet) {
                    if (header) {
                        varTab += "<tr>\
                                    <th>Material Code</th>\
                                    <th>Material Name</th>\
                                    <th>Qty Plan</th>\
                                    <th>Qty Realization</th>\
                                </tr>";
                        header = false;
                    }
                    varTab += "<tr>\
                                    <td>"+value.code+"</td>\
                                    <td>"+value.name+"</td>\
                                    <td>"+value.qty+"</td>\
                                    <td>"+real+"</td>\
                                </tr>";
                }
                
            });
            varTab += "</table>"
            if(!error2) {
                $( "#form-inbound" ).submit();
            } else {
                Swal.fire({
                    icon: 'question',
                    title: 'please check again, the data does not match the request!',
                    html: varTab,
                    width: 800,
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Check Again',
                    denyButtonText: `Keep Save`,
                    denyButtonColor: '#FFC017',
                }).then((result) => {
                    if (result.isConfirmed) {
                        swal.close();
                    } else if (result.isDenied) {
                        $( "#form-inbound" ).submit();
                    }
                });
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

function checkProductStatus(idx_){
    var is_not_good = $("#check_not_good_"+idx_+":checked").length;
    var qty = $("#qty_"+idx_).val();
    if (is_not_good==1) {
        $("#good_"+idx_).val(0);
        $("#not_good_"+idx_).val(qty);
    } else {
        $("#good_"+idx_).val(qty);
        $("#not_good_"+idx_).val(0);
    }
}