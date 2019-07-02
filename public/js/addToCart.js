$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    $('.btn-addToCart').click(function(e){
        e.preventDefault();
        $.ajax({
            type: 'GET',
            url : $(this).attr('href'),
            success : function(data){
                //alert('Item berhasil dimasukan ke keranjang.');
                $('.cart-success').append('<div class="alert alert-success alert-cart animated fadeOutUp delay-2s">Produk di tambahkan ke keranjang.</div>');
                $('.itemCart').text(data);
                setTimeout(function(){
                  $('.alert-cart').remove();
                }, 3000);
            },error: function(data){
                console.log('error');
            }
        });
    });
});