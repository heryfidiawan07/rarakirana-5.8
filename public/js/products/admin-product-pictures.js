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

    $(document).on('click','#btn-delete-pict',function(e){
        e.preventDefault();
        $.ajax({
            type: 'GET',
            url : $('#btn-delete-pict').attr('data-url'),
            success : function(data){
                $('.product-image-'+data.id).remove();
                $('.modal').modal('hide');
            },error: function(data){
                $('.modal').modal('hide');
            }
        });
    });

});