$(document).ready(function() {
    var dataTable = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: true,
        responsive: true,
        ajax : {
            url :  userList,
            type: "POST",                
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: function (d) {  
              
            }        
        },        
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'status', name: 'status'},
            {data: 'user_roles', name: 'user_roles'},
            {data: 'points', name: 'points'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    
    $(document).on('click', '.credit-points', function(e){
        $(".credit-point #user_id").val($(this).attr('data-id'));
    });

    $(document).on('click', '.debit-points', function(e){
        $(".debit-point #user_id").val($(this).attr('data-id'));
    });

    $("#credit-points-update").submit(function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
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

    $("#debit-points-update").submit(function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        $.ajax({
            type:'POST',
            url: url,
            data: {
                "_token"     : $('meta[name="csrf-token"]').attr('content'),
                "type" : $(".debit-point input[name='type']").val(),
                "user_id" : $(".debit-point input[name='user_id']").val(),
                "points"   : $(".debit-point input[name='points']").val()
            },            
            success:function(data) {
                $('.debit-point input[name="points"]').next('div .invalid-feedback').css("display","none");
                $('#debit-point').modal('hide');
                $('.modal-backdrop').remove();
                $('.debit-point input[name="points"]').val("");
                dataTable.draw();
            },
            error:function (data) {
                if(data.responseJSON.errors.points){
                    $('.debit-point input[name="points"]').next('div .invalid-feedback').text(data.responseJSON.errors.points);
                    $('.debit-point input[name="points"]').next('div .invalid-feedback').css("display","block");
                }else{
                    $('.debit-point input[name="points"]').next('div .invalid-feedback').css("display","none");
                }              
            } 
        });
    });
});