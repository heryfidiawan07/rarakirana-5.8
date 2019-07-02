$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name_edit="csrf-token"]').attr('content'),
        }
    });
    
    function formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    $('#btn-edit-address').attr('disabled',true);
    $('#name_edit').keyup(function(){
        $('#name_edit').css('border-color','red');
        if ($('#name_edit').val().length > 3) {
            $('#name_edit').css('border-color','unset');
            if ($('#name_edit').val().length > 3 && $('#penerima_edit').val().length > 3 && $('#address_edit').val().length > 3 && $('#phone_edit').val().length > 3 && $('#prov_id_edit').val() > 0 && $('#kab_id_edit').val() > 0) {
                $('#btn-edit-address').attr('disabled',false);
            }
        }
        if ($('#name_edit').val().length < 3) {
            $('#btn-edit-address').attr('disabled',true);
        }
    });

    $('#penerima_edit').keyup(function(){
        $('#penerima_edit').css('border-color','red');
        if ($('#penerima_edit').val().length > 3) {
            $('#penerima_edit').css('border-color','unset');
            if ($('#name_edit').val().length > 3 && $('#penerima_edit').val().length > 3 && $('#address_edit').val().length > 3 && $('#phone_edit').val().length > 3 && $('#prov_id_edit').val() > 0 && $('#kab_id_edit').val() > 0) {
                $('#btn-edit-address').attr('disabled',false);
            }
        }
        if ($('#penerima_edit').val().length < 3) {
            $('#btn-edit-address').attr('disabled',true);
        }
    });

    $('#address_edit').keyup(function(){
        $('#address_edit').css('border-color','red');
        if ($('#address_edit').val().length > 3) {
            $('#address_edit').css('border-color','unset');
            if ($('#name_edit').val().length > 3 && $('#penerima_edit').val().length > 3 && $('#address_edit').val().length > 3 && $('#phone_edit').val().length > 3 && $('#prov_id_edit').val() > 0 && $('#kab_id_edit').val() > 0) {
                $('#btn-edit-address').attr('disabled',false);
            }
        }
        if ($('#address_edit').val().length < 3) {
            $('#btn-edit-address').attr('disabled',true);
        }
    });

    $('#phone_edit').keyup(function(){
        $('#phone_edit').css('border-color','red');
        if ($('#phone_edit').val().length > 3) {
            $('#phone_edit').css('border-color','unset');
            if ($('#name_edit').val().length > 3 && $('#penerima_edit').val().length > 3 && $('#address_edit').val().length > 3 && $('#phone_edit').val().length > 3 && $('#prov_id_edit').val() > 0 && $('#kab_id_edit').val() > 0) {
                $('#btn-edit-address').attr('disabled',false);
            }
        }
        if ($('#phone_edit').val().length < 3) {
            $('#btn-edit-address').attr('disabled',true);
        }
    });

    if ($('#prov_id_edit').val() == 0) {
        $('#btn-edit-address').attr('disabled',true);
    }
    $('#prov_id_edit').change(function(){
        if ($('#prov_id_edit').val() == 0) {
            $('#btn-edit-address').attr('disabled',true);
        }
        if ($('#prov_id_edit').val() > 0) {
            if ($('#name_edit').val().length > 3 && $('#penerima_edit').val().length > 3 && $('#address_edit').val().length > 3 && $('#phone_edit').val().length > 3 && $('#prov_id_edit').val() > 0 && $('#kab_id_edit').val() > 0) {
                $('#btn-edit-address').attr('disabled',false);
            }
            $('#provinsi_edit').val($('select#prov_id_edit').find(':selected').text());
            $.ajax({
                type: 'GET',
                url : '/address/get-city/by-province/'+$('#prov_id_edit').val(),
                success : function(data){
                    for (var i = 0; i < data.length; i++) {
                        $('#kab_id_edit').append('<option class="option_kabupaten_edit" value="'+data[i].city_id+'">'+data[i].city_name+' ('+data[i].type+')'+'</option>');
                    }
                    $('#prov_id_edit').change(function(){
                        $('.option_kabupaten_edit').remove();
                    });
                },error: function(data){
                    console.log('error');
                }
            });
        }
    });

    $('#kab_id_edit').change(function(){
        $('#kabupaten_edit').val($('select#kab_id_edit').find(':selected').text());
        if ($('#kab_id_edit').val() == 0) {
            $('#btn-edit-address').attr('disabled',true);
        }
        if ($('#kab_id_edit').val() > 0) {
            if ($('#name_edit').val().length > 3 && $('#penerima_edit').val().length > 3 && $('#address_edit').val().length > 3 && $('#prov_id_edit').val() > 0 && $('#kab_id_edit').val() > 0) {
                $('#btn-edit-address').attr('disabled',false);
            }
        }
    });

});