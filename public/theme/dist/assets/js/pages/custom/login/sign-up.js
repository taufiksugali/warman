$(document).on('change', '#fullname', function () {
    var fullname = $("#fullname").val();
    $('#get_fullname').html(fullname);
})

$(document).on('change', '#email', function () {
    var email = $("#email").val();
    $('#get_email').html(email);
})

$(document).on('change', '#signup_phone', function () {
    var phone = $("#signup_phone").val();
    $('#get_phone').html(phone);
})

$(document).on('change', '#owners_name', function () {
    var phone = $("#owners_name").val();
    $('#get_owners_name').html(phone);
})

$(document).on('change', '#owners_address', function () {
    var phone = $("#owners_address").val();
    $('#get_owners_address').html(phone);
})

$('#password, #repassword').on('keyup', function () {
    if ($('#password').val() == $('#repassword').val()) {
        if($('#password').val() !== null && $('#repassword').val() !== null){
            $('#message_confirm').html('Matching').css('color', 'green');
        }
    } else 
        $('#message_confirm').html('Not Matching').css('color', 'red');
    }
);

function getProvince(sel) {
    let province = sel.options[sel.selectedIndex].text;
    $('#get_owners_state').html(province);
}

function getCity(sel) {
    let city = sel.options[sel.selectedIndex].text;
    $('#get_owners_city').html(city);
}

function getDistrict(sel) {
    let district = sel.options[sel.selectedIndex].text;
    $('#get_owners_district').html(district);
}

function getSubDistrict(sel) {
    let sub_district = sel.options[sel.selectedIndex].text;
    var element = document.getElementById('sdistrict_id');
    var zip_code = element.options[ element.selectedIndex ].getAttribute('data-id');
    $('#get_owners_sub_district').html(sub_district);
    $('#get_zip_code').html(zip_code);
}

window.onload = function() {
    var fullname = $("#fullname").val();
    $('#get_fullname').html(fullname);
    var email = $("#email").val();
    $('#get_email').html(email);
    var phone = $("#signup_phone").val();
    $('#get_phone').html(phone);
    var phone = $("#owners_name").val();
    $('#get_owners_name').html(phone);
    var phone = $("#owners_address").val();
    $('#get_owners_address').html(phone);

    var sel_prov = document.getElementById('state_id');
    let province = sel_prov.options[sel_prov.selectedIndex].text;
    $('#get_owners_state').html(province);

    var sel_city = document.getElementById('city_id');
    let city = sel_city.options[sel_city.selectedIndex].text;
    $('#get_owners_city').html(city);

    var sel_dist = document.getElementById('district_id');
    let district = sel_dist.options[sel_dist.selectedIndex].text;
    $('#get_owners_district').html(district);

    var sel = document.getElementById('sdistrict_id');
    let sub_district = sel.options[sel.selectedIndex].text;
    var zip_code = sel.options[ sel.selectedIndex ].getAttribute('data-id');
    $('#get_owners_sub_district').html(sub_district);
    $('#get_zip_code').html(zip_code);
    
    if($('.agreement').is(":checked")){
        document.getElementById("agreement").value = 1; 
        document.getElementById("kt_login_signup_form_submit_button").disabled = false;
    }else {
        document.getElementById("agreement").value = 0; 
        document.getElementById("kt_login_signup_form_submit_button").disabled = true;
    }
};