$(document).ready(function() {
    $('#scan-barcode').focus();

    $('#scan-barcode').keypress(function(e){
        var keycode = (e.keyCode ? e.keyCode : e.which);
        var value = e.currentTarget.value;
        if(keycode == '13' && value != ""){           
            $.ajax({
                type: 'POST',
                url: base_url+'/packing/getPickingNo',
                data: '&barcode='+value,
                dataType:'json',
                success: function(result){
                    $('#scan-barcode').focus();
                    if(result.code=='200') {
                        var dataRes = result.data;
                        window.location.replace(base_url+'/packing/addedit/'+dataRes.po_outbound_id);
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
});