$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    
    function formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    $('#btn-save-adress').attr('disabled',true);
    $('#name').keyup(function(){
        $('#name').css('border-color','red');
        if ($('#name').val().length > 3) {
            $('#name').css('border-color','unset');
            if ($('#name').val().length > 3 && $('#penerima').val().length > 3 && $('#address').val().length > 3 && $('#phone').val().length > 3 && $('#prov_id').val() > 0 && $('#kab_id').val() > 0) {
                $('#btn-save-adress').attr('disabled',false);
            }
        }
        if ($('#name').val().length < 3) {
            $('#btn-save-adress').attr('disabled',true);
        }
    });

    $('#penerima').keyup(function(){
        $('#penerima').css('border-color','red');
        if ($('#penerima').val().length > 3) {
            $('#penerima').css('border-color','unset');
            if ($('#name').val().length > 3 && $('#penerima').val().length > 3 && $('#address').val().length > 3 && $('#phone').val().length > 3 && $('#prov_id').val() > 0 && $('#kab_id').val() > 0) {
                $('#btn-save-adress').attr('disabled',false);
            }
        }
        if ($('#penerima').val().length < 3) {
            $('#btn-save-adress').attr('disabled',true);
        }
    });

    $('#address').keyup(function(){
        $('#address').css('border-color','red');
        if ($('#address').val().length > 3) {
            $('#address').css('border-color','unset');
            if ($('#name').val().length > 3 && $('#penerima').val().length > 3 && $('#address').val().length > 3 && $('#phone').val().length > 3 && $('#prov_id').val() > 0 && $('#kab_id').val() > 0) {
                $('#btn-save-adress').attr('disabled',false);
            }
        }
        if ($('#address').val().length < 3) {
            $('#btn-save-adress').attr('disabled',true);
        }
    });

    $('#phone').keyup(function(){
        $('#phone').css('border-color','red');
        if ($('#phone').val().length > 3) {
            $('#phone').css('border-color','unset');
            if ($('#name').val().length > 3 && $('#penerima').val().length > 3 && $('#address').val().length > 3 && $('#phone').val().length > 3 && $('#prov_id').val() > 0 && $('#kab_id').val() > 0) {
                $('#btn-save-adress').attr('disabled',false);
            }
        }
        if ($('#phone').val().length < 3) {
            $('#btn-save-adress').attr('disabled',true);
        }
    });

    if ($('#prov_id').val() == 0) {
        $('#btn-save-adress').attr('disabled',true);
    }
    $('#prov_id').change(function(){
        if ($('#prov_id').val() == 0) {
            $('#btn-save-adress').attr('disabled',true);
        }
        if ($('#prov_id').val() > 0) {
            if ($('#name').val().length > 3 && $('#penerima').val().length > 3 && $('#address').val().length > 3 && $('#phone').val().length > 3 && $('#prov_id').val() > 0 && $('#kab_id').val() > 0) {
                $('#btn-save-adress').attr('disabled',false);
            }
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
        if ($('#kab_id').val() == 0) {
            $('#btn-save-adress').attr('disabled',true);
        }
        if ($('#kab_id').val() > 0) {
            if ($('#name').val().length > 3 && $('#penerima').val().length > 3 && $('#address').val().length > 3 && $('#prov_id').val() > 0 && $('#kab_id').val() > 0) {
                $('#btn-save-adress').attr('disabled',false);
            }
        }
    });
    
    $('.radioSelect').click(function(){
        var addressId = $(this).val()
        if($('.radioSelect').is(':checked')){
            $('#kurir').attr('disabled',false);
            $('#kurir').change(function(){
                if ($('#kurir').val() != 0) {
                    $('#services').attr('disabled',false);
                    $.ajax({
                        type: 'GET',
                        url : '/cart/cost/'+addressId+'/'+$('#kurir').val(),
                        success : function(data){
                            for (var i = 0; i < data['costs'].length; i++) {
                                $('#services').append('<option class="option_services" data-value="'+data['costs'][i]['cost'][0]['value']+'" value="'+i+'">'+$('#kurir').find(':selected').text()+'-'+data['costs'][i]['service']+'= Rp '+formatNumber(data['costs'][i]['cost'][0]['value'])+' - '+data['costs'][0]['cost'][0]['etd']+' hari.</option>');
                            }
                            var subTotal = $('#subTotal').attr('data-value');
                            var ongkir = $('#ongkir').text(formatNumber($('select#services').find(':selected').attr('data-value')));
                            var totalPrice = Number(subTotal)+Number($('select#services').find(':selected').attr('data-value'));
                            $('#totalPrice').text(formatNumber(totalPrice));
                            $('#kurir').change(function(){
                                $('.option_services').remove();
                            });
                            $('#services').change(function(){
                                var ongkir = $('#ongkir').text(formatNumber($('select#services').find(':selected').attr('data-value')));
                                var totalPrice = Number(subTotal)+Number($('select#services').find(':selected').attr('data-value'));
                                $('#totalPrice').text(formatNumber(totalPrice));
                            });
                            if ($('#services').val() != ''){
                                $('#btn-checkout').attr('disabled',false);
                            }
                        },error: function(data){
                            console.log('error');
                        }
                    });
                }
            });
        }
    });
    
    if ($('#kurir').val()==0 || $('.address-select').prop("checked")) {
        $('#services').attr('disabled',true);
    }else{
        $('#services').attr('disabled',false);
    }

    $('#kurir').change(function(){
        if ($('#kurir').val()==0) {
            $('#services').attr('disabled',true);
        }else{
            $('#services').attr('disabled',false);
        }
    });

    $('.plus').click(function(){
        $(this).prev().val(+$(this).prev().val() + 1);
        var slug = $(this).attr('data-slug');
        $('.total_qty_'+slug).text($(this).prev().val());
        var originPrice = $('.cart-product-price-'+slug).attr('data-value');
        if ($(this).prev().val() > 0) {
            $.ajax({
                type: 'POST',
                url : '/add-plus-qty-cart/'+slug,
                success : function(data){
                    $('.cart-product-price-'+slug).text(formatNumber(data.price));
                    $('#subTotal').text(formatNumber(data.totalPrice));
                },error: function(data){
                    console.log('error');
                }
            });
        }
    });

    $('.min').click(function(){
        var slug = $(this).attr('data-slug');
        var originPrice = $('.cart-product-price-'+slug).attr('data-value');
        if ($(this).next().val() > 1){
            $(this).next().val(+$(this).next().val() - 1);
            $('.total_qty_'+slug).text($(this).next().val());
            $.ajax({
                type: 'POST',
                url : '/add-min-qty-cart/'+slug,
                success : function(data){
                    $('.cart-product-price-'+slug).text(formatNumber(data.price));
                    $('#subTotal').text(formatNumber(data.totalPrice));
                },error: function(data){
                    console.log('error');
                }
            });
        }
    });

    $('.address-select').click(function(){
        $('#address_id').val($(this).val());
        $('.kurir').remove();
        $('#kurir').append('<option class="kurir" value="0">Kurir</option><option class="kurir" value="jne">JNE</option><option class="kurir" value="tiki">TIKI</option><option value="pos">POS</option>');
        $('#services').attr('disabled',true);
        $('.option_services').remove();
        $('#btn-checkout').attr('disabled',true);
    });

});