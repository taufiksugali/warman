
window.onload = function(){
    
    updateInboundLastWeek();
    // setInterval(function(){
    // 	updateInboundChart()
    // }, 5000);
    
    updateOutboundLastWeek();
    
    updateInboundChart();
    // setInterval(function(){
    // 	updateInboundChart()
    // }, 5000);
   
    updateShippingChart();
}

//-- inisialisasi chart
const ibd_lw = document.getElementById('inbound_last_week').getContext("2d");
const obd_lw = document.getElementById('outbound_last_week').getContext("2d");
const ibd = document.getElementById('myChart').getContext("2d");
const obd = document.getElementById('myChart2').getContext("2d");
let config = {
    type: 'line',
    data: null
};

let inbound_LastWeekChart = new Chart(ibd_lw, config);
let outbound_LastWeekChart = new Chart(obd_lw, config); // data shipping
let inbound = new Chart(ibd, config);
let outbound = new Chart(obd, config);

//-- end of inisialisasi chart

var updateInboundLastWeek = function() {
    var owners_id = $('#f_dash_owner').val();
    // if($('#f_dash_owner').val() != null && $('#f_dash_owner').val() != ""){
    //     var owners_id = $('#f_dash_owner').val();
    // } else {
    //     var owners_id = $('#f_dash_owner').val();
    // }
    $.getJSON(base_url_new + '/dashboard/get_inboundLastWeek?owners_id='+owners_id, function (data) {
        var out = JSON.parse(JSON.stringify(data));
        
        var dataset = {
            labels:  out.labels,
            datasets: [{
                label: 'Inbound per day',
                data: out.datasets,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        };
        removeData(inbound_LastWeekChart);
        addData(inbound_LastWeekChart, dataset);
    // console.log('eek');
    });
}

var updateOutboundLastWeek = function() {
    var owners_id = $('#f_dash_owner').val();
    $.getJSON(base_url_new + '/dashboard/get_outboundLastWeek?owners_id='+owners_id, function (data) {
        var out = JSON.parse(JSON.stringify(data));
        
        var dataset_obd_lw = {
            labels:  out.labels,
            datasets: [{
                label: 'Outbound per day',
                data: out.datasets,
                fill: false,
                borderColor: 'rgb(255, 99, 71)',
                tension: 0.1
            }]
        };
        removeData(outbound_LastWeekChart);
        addData(outbound_LastWeekChart, dataset_obd_lw);
    });
}

var updateInboundChart = function() {
    var owners_id = $('#f_dash_owner').val();
    $.getJSON(base_url_new + '/dashboard/get_inboundChartData?owners_id='+owners_id, function (data) {
        var out = JSON.parse(JSON.stringify(data));
        
        var dataset_ibd = {
            labels:  out.labels,
            datasets: [{
                label: 'Inbound per day',
                data: out.datasets,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        };
        removeData(inbound);
        addData(inbound, dataset_ibd);
    });
} 

var updateShippingChart = function() {
    var owners_id = $('#f_dash_owner').val();
    $.getJSON(base_url_new + '/dashboard/get_shippingChartData?owners_id='+owners_id, function (data) {
        var out = JSON.parse(JSON.stringify(data));
        
        var dataset_obd = {
            labels:  out.labels,
            datasets: [{
                label: 'Outbound per day',
                data: out.datasets,
                fill: false,
                borderColor: 'rgb(255, 99, 71)',
                tension: 0.1
            }]
        };
        removeData(outbound);
        addData(outbound, dataset_obd);

    });
}

function addData(chart, data) {
    chart.data = data;
    chart.update();
}

function removeData(chart) {
    chart.data.labels.pop();
    chart.data.datasets.forEach((dataset) => {
        dataset.data.pop();
    });
    chart.update();
}

function updateStok(){
    var owners_id = $('#f_dash_owner').val();
    var btn_filter = document.getElementById("btn_filter_dash");
    btn_filter.classList.add("spinner");
    btn_filter.classList.add("spinner-white");
    btn_filter.classList.add("spinner-right");
    // console.log(area_id);
    $.ajax({
        method: 'POST',
        url: base_url_new + "/dashboard/update_stok_dashboard",
        beforeSend: function () {
        },
        dataType: "json",
        data: {
            owners_id : owners_id,
        },
        success: function (result) {
            // console.log(result);
            document.getElementById('dash_stok_ok').innerHTML = result.stock_ok;
            document.getElementById('dash_stok_nok').innerHTML = result.stock_nok;
            document.getElementById('ibd_today').innerHTML = result.inbound_today;
            document.getElementById('obd_today').innerHTML = result.outbound_today;
            $("#tbl_dash_good").html("");
            $("#tbl_dash_notgood").html("");
            $('#tbl_dash_good').append(result.stok_good_data);
            $('#tbl_dash_notgood').append(result.stok_notgood_data);
            btn_filter.classList.remove("spinner");
            btn_filter.classList.remove("spinner-white");
            btn_filter.classList.remove("spinner-right");
        }
    });
}

function refreshDashboard(){
    updateInboundLastWeek();
    
    updateOutboundLastWeek();
    
    updateInboundChart();
   
    updateShippingChart();

    reloadTable();

    updateStok();
}

