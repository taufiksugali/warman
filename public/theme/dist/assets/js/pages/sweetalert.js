$(document).on('click', '#delete', function () {
    var id = $(this).attr('data-id');
    // console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true,
        custom_class: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then((result) => {
        // console.log(result);
        if (result.isConfirmed == true) {
            deletedata(id);
        } else if (result.dismiss === 'cancel') {
            Swal.fire(
                'Cancelled',
                'Your data is safe in our servers',
                'error'
            )
        }
    });
})

function deletedata(id) {
    var protocol = $(location).attr('protocol');
    var host = $(location).attr('host');
    var url = $(location).attr('href').split('/');
    var value = url[3].split('?');
    // console.log(id);
    $.ajax({
        method: 'GET',
        url: value[0] +'/delete?id=' + id
    }).done(function (data) {
        Swal.fire(
            'Deleted!',
            'Your data is deleted from the servers',
            'success'
        ).then(result => {
            location.reload();
        });
    });
}

$(document).on('click', '#delete_inbound', function () {
    var id = $(this).attr('data-id');
    // console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true,
        custom_class: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then((result) => {
        // console.log(result);
        if (result.isConfirmed == true) {
            deleteinbound(id);
        } else if (result.dismiss === 'cancel') {
            Swal.fire(
                'Cancelled',
                'Your data is safe in our servers',
                'error'
            )
        }
    });
})

function deleteinbound(id) {
    // console.log(id);
    $.ajax({
        method: 'GET',
        url: 'inbound/delete?id=' + id
    }).done(function (data) {
        Swal.fire(
            'Deleted!',
            'Your data is deleted from the servers',
            'success'
        ).then(result => {
            location.reload();
        });
    });
}

$(document).on('click', '#delete_outbound', function () {
    var id = $(this).attr('data-id');
    // console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true,
        custom_class: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then((result) => {
        // console.log(result);
        if (result.isConfirmed == true) {
            deleteoutbound(id);
        } else if (result.dismiss === 'cancel') {
            Swal.fire(
                'Cancelled',
                'Your data is safe in our servers',
                'error'
            )
        }
    });
})

function deleteoutbound(id) {
    // console.log(id);
    $.ajax({
        method: 'GET',
        url: 'outbound/delete?id=' + id
    }).done(function (data) {
        Swal.fire(
            'Deleted!',
            'Your data is deleted from the servers',
            'success'
        ).then(result => {
            location.reload();
        });
    });
}

$(document).on('click', '#approve_topup', function () {
    var id = $(this).attr('data-id');
    // console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Approve it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true,
        custom_class: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then((result) => {
        // console.log(result);
        if (result.isConfirmed == true) {
            approvedata(id);
        } else if (result.dismiss === 'cancel') {
            Swal.fire(
                'Cancelled',
                'Your data is safe in our servers',
                'error'
            )
        }
    });
})

$(document).on('click', '#delete_outboundpo', function () {
    var id = $(this).attr('data-id');
    // console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true,
        custom_class: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then((result) => {
        // console.log(result);
        if (result.isConfirmed == true) {
            deleteoutboundpo(id);
        } else if (result.dismiss === 'cancel') {
            Swal.fire(
                'Cancelled',
                'Your data is safe in our servers',
                'error'
            )
        }
    });
})

function deleteoutboundpo(id) {
    // console.log(id);
    $.ajax({
        method: 'GET',
        url: 'outboundpo/delete?id=' + id
    }).done(function (data) {
        Swal.fire(
            'Deleted!',
            'Your data is deleted from the servers',
            'success'
        ).then(result => {
            location.reload();
        });
    });
}

$(document).on('click', '#approve_topup', function () {
    var id = $(this).attr('data-id');
    // console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Approve it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true,
        custom_class: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then((result) => {
        // console.log(result);
        if (result.isConfirmed == true) {
            approvedata(id);
        } else if (result.dismiss === 'cancel') {
            Swal.fire(
                'Cancelled',
                'Your data is safe in our servers',
                'error'
            )
        }
    });
})

function approvedata(id) {
    var protocol = $(location).attr('protocol');
    var host = $(location).attr('host');
    var url = $(location).attr('href').split('/');
    var value = url[3].split('?');
    // console.log(id);
    $.ajax({
        method: 'GET',
        url: value[0] +'/approve?topup_id=' + id
    }).done(function (data) {
        Swal.fire(
            'Approved!',
            'Top up has been approved!',
            'success'
        ).then(result => {
            location.reload();
        });
    });
}

$(document).on('click', '#reject_topup', function () {
    var id = $(this).attr('data-id');
    // console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Reject it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true,
        custom_class: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then((result) => {
        // console.log(result);
        if (result.isConfirmed == true) {
            rejectdata(id);
        } else if (result.dismiss === 'cancel') {
            Swal.fire(
                'Cancelled',
                'Your data is safe in our servers',
                'error'
            )
        }
    });
})

function rejectdata(id) {
    var protocol = $(location).attr('protocol');
    var host = $(location).attr('host');
    var url = $(location).attr('href').split('/');
    var value = url[3].split('?');
    // console.log(id);
    $.ajax({
        method: 'GET',
        url: value[0] +'/reject?topup_id=' + id
    }).done(function (data) {
        Swal.fire(
            'Approved!',
            'Top up has been Rejected!',
            'success'
        ).then(result => {
            location.reload();
        });
    });
}

$(document).on('click', '#finish_po', function () {
    var id = $(this).attr('data-id');
    // console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: "By Clicking Yes button, this request will be done.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true,
        custom_class: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then((result) => {
        // console.log(result);
        if (result.isConfirmed == true) {
            finishPO(id);
        } else if (result.dismiss === 'cancel') {
            Swal.fire(
                'Cancelled',
                'Your data is safe in our servers',
                'error'
            )
        }
    });
})

function finishPO(id) {
    var protocol = $(location).attr('protocol');
    var host = $(location).attr('host');
    var url = $(location).attr('href').split('/');
    var value = url[3].split('?');
    // console.log(id);
    $.ajax({
        method: 'GET',
        url: value[0] +'/finish_po?po_outbound_id=' + id
    }).done(function (data) {
        Swal.fire(
            'Updated!',
            'Request status changed to Finished!',
            'success'
        ).then(result => {
            location.reload();
            // console.log(result.data);
        });
    });
}

$(document).on('click', '#reject_request', function () {
    var id = $(this).attr('data-id');
    // console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Reject it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true,
        custom_class: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then((result) => {
        // console.log(result);
        if (result.isConfirmed == true) {
            rejectpodata(id);
        } else if (result.dismiss === 'cancel') {
            Swal.fire(
                'Cancelled',
                'Your data is safe in our servers',
                'error'
            )
        }
    });
})

function rejectpodata(id) {
    var protocol = $(location).attr('protocol');
    var host = $(location).attr('host');
    var url = $(location).attr('href').split('/');
    var value = url[3].split('?');
    // console.log(id);
    $.ajax({
        method: 'GET',
        url: value[0] +'/reject?id=' + id
    }).done(function (data) {
        Swal.fire(
            'Approved!',
            'Request has been Rejected!',
            'success'
        ).then(result => {
            location.reload();
        });
    });
}

$(document).on('click', '#approve_invoice', function () {
    var id = $(this).attr('data-id');
    // console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: "By Clicking Yes button, this invoice will be approved.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true,
        custom_class: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then((result) => {
        // console.log(result);
        if (result.isConfirmed == true) {
            approveInvoice(id);
        } else if (result.dismiss === 'cancel') {
            Swal.fire(
                'Cancelled',
                'Your data is safe in our servers',
                'error'
            )
        }
    });
})

function approveInvoice(id) {
    var protocol = $(location).attr('protocol');
    var host = $(location).attr('host');
    var url = $(location).attr('href').split('/');
    var value = url[3].split('?');
    var back = url[0] + '//' + url[2] + '/' + url[3];
    // console.log(back);
    // window.location.replace(back);
    $.ajax({
        method: 'GET',
        url: value[0] +'/accept_invoice?bill_id=' + id
    }).done(function (data) {
        Swal.fire(
            'Approved!',
            'Invoice has been approved!',
            'success'
        ).then(result => {
            window.location.replace(back);
        });
    });
}

$(document).on('click', '#reject_invoice', function () {
    var id = $(this).attr('data-id');
    // console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: "By Clicking Yes button, this invoice will be rejected.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true,
        custom_class: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then((result) => {
        // console.log(result);
        if (result.isConfirmed == true) {
            rejectInvoice(id);
        } else if (result.dismiss === 'cancel') {
            Swal.fire(
                'Cancelled',
                'Your data is safe in our servers',
                'error'
            )
        }
    });
})

function rejectInvoice(id) {
    var protocol = $(location).attr('protocol');
    var host = $(location).attr('host');
    var url = $(location).attr('href').split('/');
    var value = url[3].split('?');
    var back = url[0] + '//' + url[2] + '/' + url[3];
    // console.log(back);
    // window.location.replace(back);
    $.ajax({
        method: 'GET',
        url: value[0] +'/reject_invoice?bill_id=' + id
    }).done(function (data) {
        Swal.fire(
            'Rejected!',
            'Invoice has been rejected!',
            'success'
        ).then(result => {
            window.location.replace(back);
        });
    });
}

$(document).on('click', '#delete_bankAccount', function () {
    var id = $(this).attr('data-id');
    // console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true,
        custom_class: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then((result) => {
        // console.log(result);
        if (result.isConfirmed == true) {
            deletebankaccount(id);
        } else if (result.dismiss === 'cancel') {
            Swal.fire(
                'Cancelled',
                'Your data is safe in our servers',
                'error'
            )
        }
    });
})

function deletebankaccount(id) {
    // console.log(id);
    $.ajax({
        method: 'GET',
        url: 'owners/deleteOwnersBank?id=' + id
    }).done(function (data) {
        Swal.fire(
            'Deleted!',
            'Your data is deleted from the servers',
            'success'
        ).then(result => {
            location.reload();
        });
    });
}

$(document).on('click', '#delete_market', function () {
    var id = $(this).attr('data-id');
    // console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true,
        custom_class: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then((result) => {
        // console.log(result);
        if (result.isConfirmed == true) {
            deleteMarket(id);
        } else if (result.dismiss === 'cancel') {
            Swal.fire(
                'Cancelled',
                'Your data is safe in our servers',
                'error'
            )
        }
    });
})

function deleteMarket(id) {
    // console.log(id);
    $.ajax({
        method: 'GET',
        url: 'owners/delete_marketplace?id=' + id
    }).done(function (data) {
        Swal.fire(
            'Deleted!',
            'Your data is deleted from the servers',
            'success'
        ).then(result => {
            location.reload();
        });
    });
}

$(document).on('click', '#delete_agreement', function () {
    var id = $(this).attr('data-id');
    // console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true,
        custom_class: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then((result) => {
        // console.log(result);
        if (result.isConfirmed == true) {
            deleteAgreement(id);
        } else if (result.dismiss === 'cancel') {
            Swal.fire(
                'Cancelled',
                'Your data is safe in our servers',
                'error'
            )
        }
    });
})

function deleteAgreement(id) {
    // console.log(id);
    $.ajax({
        method: 'GET',
        url: 'owners/delete_agreement?id=' + id
    }).done(function (data) {
        Swal.fire(
            'Deleted!',
            'Your data is deleted from the servers',
            'success'
        ).then(result => {
            location.reload();
        });
    });
}

// -- start of material approval function 
$(document).on('click', '#material_approve', function () {
    var id = $(this).attr('data-id');
    // console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: "By Clicking Yes button, this product will be approved.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true,
        custom_class: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then((result) => {
        // console.log(result);
        if (result.isConfirmed == true) {
            approveMaterial(id);
        } else if (result.dismiss === 'cancel') {
            Swal.fire(
                'Cancelled',
                'Your data is safe in our servers',
                'error'
            )
        }
    });
})

function approveMaterial(id) {
    var protocol = $(location).attr('protocol');
    var host = $(location).attr('host');
    var url = $(location).attr('href').split('/');
    var value = url[3].split('?');
    // console.log(id);
    $.ajax({
        method: 'POST',
        url: value[0] +'/approve',
        data: {
            id : id,
        },
    }).done(function (data) {
        Swal.fire(
            'Approved!',
            'Product has been approved!',
            'success'
        ).then(result => {
            location.reload();
            // console.log(result.data);
        });
    });
}

$(document).on('click', '#material_reject', function () {
    var id = $(this).attr('data-id');
    // console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: "By Clicking Yes button, this product will be rejected.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true,
        custom_class: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then((result) => {
        // console.log(result);
        if (result.isConfirmed == true) {
            rejectMaterial(id);
        } else if (result.dismiss === 'cancel') {
            Swal.fire(
                'Cancelled',
                'Your data is safe in our servers',
                'error'
            )
        }
    });
})

function rejectMaterial(id) {
    var protocol = $(location).attr('protocol');
    var host = $(location).attr('host');
    var url = $(location).attr('href').split('/');
    var value = url[3].split('?');
    // console.log(id);
    $.ajax({
        method: 'POST',
        url: value[0] +'/reject',
        data: {
            id : id,
        },
    }).done(function (data) {
        Swal.fire(
            'Rejected!',
            'Product has been rejected!',
            'success'
        ).then(result => {
            location.reload();
            // console.log(result.data);
        });
    });
}
// -- end of material approval function 