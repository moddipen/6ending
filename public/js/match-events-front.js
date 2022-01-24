$(document).ready(function() {
    $(document).on('click', '.place-bet', function(e){
        alert("dadsd");
        $.ajax({
            type:'POST',
            url: url,
            data: {
                "_token"     : $('meta[name="csrf-token"]').attr('content'),
                "type" : $(".credit-point input[name='type']").val(),
                "user_id" : $(".credit-point input[name='user_id']").val(),
                "points"   : $(".credit-point input[name='points']").val()
            },            
            success:function(data) {
                $('.credit-point input[name="points"]').next('div .invalid-feedback').css("display","none");
                $('#credit-point').modal('hide');
                $('.modal-backdrop').remove();
                $('.credit-point input[name="points"]').val("");
                dataTable.draw();
            },
            error:function (data) {
                if(data.responseJSON.errors.points){
                    $('.credit-point input[name="points"]').next('div .invalid-feedback').text(data.responseJSON.errors.points);
                    $('.credit-point input[name="points"]').next('div .invalid-feedback').css("display","block");
                }else{
                    $('.credit-point input[name="points"]').next('div .invalid-feedback').css("display","none");
                }              
            } 
        });
    });
});