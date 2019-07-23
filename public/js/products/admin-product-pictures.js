$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    $('.btn-trash-pict').on('click', function(){
        $('#select-picture').attr('src','/products/thumb/'+$(this).attr('data-img'));
        $('#btn-delete-pict').attr('data-url','/admin/product/picture/ajax/delete/'+$(this).attr('data-id'));
    });

    $('#btn-delete-pict').on('click',function(e){
        e.preventDefault();
        $.ajax({
            type: 'GET',
            url : $('#btn-delete-pict').attr('data-url'),
            success : function(data){
                $('.product-image-'+data.id).remove();
            },error: function(data){
            }
        });
    });

});