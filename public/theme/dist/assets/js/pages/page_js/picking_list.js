function initBtnCompletePicking(e) {
var idPO = $(e).data("id_po");
Swal.fire({
    icon: 'question',
    title: 'Are you sure this picking is complete?',
    html: "Request Number :<br/><b style='font-size: 40px;'>"+idPO+"</b>",
    // width: 800,
    // showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: 'Completed',
}).then((result) => {
    if (result.isConfirmed) {
        var formData    = new FormData();
        formData.append("po_id", idPO);
        $.ajax({
            type: "POST",
            url: base_url + "/picking/completed",
            dataType:'json',
            data: formData,
            async : false,
            success: function(result){
                if(result.code == '204') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: result.msg
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
            },
            cache:false,
            contentType: false,
            processData: false
        });
    }
});
}