$(document).ready(function() {
    var protocol = $(location).attr("protocol");
    var host = $(location).attr("host");
    var url = $(location).attr("href").split("/");
    var value = url[3].split("?");
    
    $.getJSON( protocol + "//" + host + "/" + value[0] + "/getColumns", function (column) {
        var table = $('#data-table-server-side-scrollx-custom').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            order: [[ 0, "desc" ]],
            text: 'Export',
            buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5'
            ],
            lengthMenu: [[ 10, 25, 50, 1000, -1 ],[ '10 rows', '25 rows', '50 rows', '1000 rows', 'Show all' ]],
            ajax: {
                type: "POST",
                url: protocol + "//" + host + "/" + value[0] + "/getDataByOwner",
                dataType: "json",
                data: function (d) {
                    d.filter_wh = ($('#filter_wh').val()) ? $('#filter_wh').val() : "";
                }
            },
            columns: column,
            initComplete: function(settings, json) {
                var html = '<option value="">All Warehouse</option>';
                for (var i = 0; i < warehouse_list.length; i++) {
                    html += '<option value="'+warehouse_list[i].warehouse_id+'">'+warehouse_list[i].wh_name+'</option>';
                };

                $("#data-table-server-side-scrollx-custom_filter").append(`<label style="padding-left: 10px;">
                        <select class="form-select form-control" id="filter_wh" form-control-sm" aria-controls="data-table-server-side-scrollx" aria-label="Warehouse">
                            `+html+`
                        </select>
                    </label>`);
                initSelect();
            }
        });

        $('#export_copy').on('click', function(e) {
            e.preventDefault();
            table.button(0).trigger();
        });
    
        $('#export_excel').on('click', function(e) {
            e.preventDefault();
            table.button(1).trigger();
        });
    
        $('#export_csv').on('click', function(e) {
            e.preventDefault();
            table.button(2).trigger();
        });
        }
    );
});

function initSelect() {
    $('#filter_wh').on('change', function (e) {
        var table = $('#data-table-server-side-scrollx-custom').DataTable();
        table.ajax.reload();
    });
}