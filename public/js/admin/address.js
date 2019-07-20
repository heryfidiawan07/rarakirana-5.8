$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    $('#prov_id').change(function(){
        if ($('#prov_id').val() > 0) {
            $('#provinsi').val($('select#prov_id').find(':selected').text());
            $.ajax({
                type: 'GET',
                url : '/address/get-city/by-province/'+$('#prov_id').val(),
                success : function(data){
                    for (var i = 0; i < data.length; i++) {
                        $('#kab_id').append('<option class="option_kabupaten" value="'+data[i].city_id+'">'+data[i].city_name+' ('+data[i].type+')'+'</option>');
                    }
                    $('#prov_id').change(function(){
                        $('.option_kabupaten').remove();
                    });
                },error: function(data){
                    console.log('error');
                }
            });
        }
    });

    $('#kab_id').change(function(){
        $('#kabupaten').val($('select#kab_id').find(':selected').text());
    });

});