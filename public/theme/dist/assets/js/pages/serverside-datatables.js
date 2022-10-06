var handleDataTableServerSide = function () {
  "use strict";

  if ($("#data-table-server-side").length !== 0) {
    var protocol = $(location).attr("protocol");
    var host = $(location).attr("host");
    var url = $(location).attr("href").split("/");
    var value = url[3].split("?");

    $.getJSON(
      protocol + "//" + host + "/" + value[0] + "/getColumns",
      function (column) {
        $("#data-table-server-side").DataTable({
          processing: true,
          serverSide: true,
          lengthMenu: [
              [ 10, 25, 50, 1000, -1 ],
              [ '10 rows', '25 rows', '50 rows', '1000 rows', 'Show all' ]
          ],
          ajax: {
            type: "POST",
            url: protocol + "//" + host + "/" + value[0] + "/getData",
            dataType: "json",
          },
          columns: column,
        });
      }
    );
  }
};

var TableManageServerSide = (function () {
  "use strict";
  return {
    //main function
    init: function () {
      handleDataTableServerSide();
    },
  };
})();

$(document).ready(function () {
  TableManageServerSide.init();
});

//
var handleDataTableServerSideScrollX = function () {
  "use strict";

  if ($("#data-table-server-side-scrollx").length !== 0) {
    var protocol = $(location).attr("protocol");
    var host = $(location).attr("host");
    var url = $(location).attr("href").split("/");
    var value = url[3].split("?");
    
    $.getJSON( protocol + "//" + host + "/" + value[0] + "/getColumns", function (column) {
      var table = $('#data-table-server-side-scrollx').DataTable({
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
            url: protocol + "//" + host + "/" + value[0] + "/getData",
            dataType: "json",
            data: function (d) {
              // Service Rates
              // filter di report.
              d.filter_start = ($('#filter_start').val()) ? $('#filter_start').val() : ""; 
              d.filter_end = ($('#filter_end').val()) ? $('#filter_end').val() : "";
              d.filter_wh = ($('#filter_wh').val()) ? $('#filter_wh').val() : "";
              //-- end of filter di report
              
              // -- filter di dashboard
              d.f_dash_owner = ($('#f_dash_owner').val()) ? $('#f_dash_owner').val() : "";

              // -- end of filter di dashboard
            }
          },
          columns: column,
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
  }
};

function reloadTable() {
	var table = $('#data-table-server-side-scrollx').DataTable();
  table.ajax.reload();
}

var TableManageServerSideScrollX = (function () {
  "use strict";
  return {
    //main function
    init: function () {
      handleDataTableServerSideScrollX();
    },
  };
})();

$(document).ready(function () {
  TableManageServerSideScrollX.init();
});
