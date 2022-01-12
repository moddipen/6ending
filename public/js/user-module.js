$(document).ready(function() {
    var datatable = $('#datatable').DataTable({
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
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    
    $(document).on('click', '.debit-points', function(e){
        $(".applyPause #children_id").val($(this).attr('data-id'));
    });
});