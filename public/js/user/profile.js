$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    $('#btn-user-desc-edit').click(function(){
        $('#text-user-description').hide();
        $('#textarea-user-description').show();
        $('#btn-user-desc-edit').hide();
        $('#btn-user-desc-save').show();
        $('#btn-user-desc-cancel').show();
        $('#btn-user-desc-cancel').click(function(e){
            e.preventDefault();
            $('#textarea-user-description').hide();
            $('#text-user-description').show();
            $('#btn-user-desc-edit').show();
            $('#btn-user-desc-save').hide();
            $('#btn-user-desc-cancel').hide();
        });
    });

    $('#btn-user-name-edit').click(function(e){
        e.preventDefault();
        $('#text-name').hide();
        $('#input-name').show();
        $('#btn-user-name-edit').hide();
        $('#btn-user-name-cancel').show();
        $('#btn-user-name-save').show();
        $('#btn-user-name-cancel').click(function(e){
            e.preventDefault();
            $('#input-name').hide();
            $('#text-name').show();
            $('#btn-user-name-cancel').hide();
            $('#btn-user-name-save').hide();
            $('#btn-user-name-edit').show();
        });
    });
});