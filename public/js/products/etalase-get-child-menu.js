$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    $('#menu-parent').on('change',function(){
        $.ajax({
            type: 'GET',
            url : $('select#menu-parent').find(':selected').attr('data-url'),
            success : function(data){
                for (var i = 0; i < data.count; i++) {
                    if (data.childs[i].parent_id == 0) {
                        //console.log(data.childs[i].name);
                        $('#default-parent-etalase').append(
                            '<option value="'+data.childs[i].id+'" class="from-control etalase-parents">'+data.childs[i].name+'</option>'
                        );
                    }
                }
                if ($('select#menu-parent').find(':selected').val()>0) {
                    $('#btn-etalase-create').attr('disabled',false);
                }
                $('#menu-parent').on('change',function(){
                    $('.etalase-parents').remove();
                });
            },error: function(data){
                //console.log(data);
            }
        });
        if ($('select#menu-parent').find(':selected').val()==0) {
            $('#btn-etalase-create').attr('disabled',true);
        }
    });
    
});