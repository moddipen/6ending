$(document).ready(function() {
    var dataTable = $('#user-list').DataTable({
        processing: true,
        serverSide: true,
        pageLength : 10,
        language: {
            paginate: {
                previous: "<i class='fas fa-angle-left'>",
                next: "<i class='fas fa-angle-right'>"
            }
        },     
        ajax : {
            url : userList,
            type: "POST",
            dataType:'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: function (d) {                
                
            }        
        },
        columns : [
            {data:"action"},
            {data:"user_roles"},
            {data:"name"},
            {data:"updated_at"},
            {data:"status"},    
            {data:"data"},                                    
        ]
    });
});