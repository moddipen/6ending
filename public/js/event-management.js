$(document).ready(function() {
    $(document).on('click', '#matchtype_id', function(e){
        $.ajax({
            type:'POST',
            url: get_event_type_ajax,
            data : {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "match_id" : $("#matchtype_id").val()                                 
            },
            success:function(data) {
                var html = "";
                if(data.sucess){
                    // alert(data.data.length);
                    // if(data.data.length > 0){
                        $.each(data.data, function(key, value) {
                            html += "<option value='"+key+"'>"+value+"</option>";    
                        });
                    // }                    
                }else{
                    html = "<option value=''>No record found</option>"
                }
                $("#eventtype_id").html(html);
            }
        });  
    });
});