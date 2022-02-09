$(document).ready(function() {
    if(typeof creditList !== "undefined"){
        var dataTable = $('#credit-debit-list').DataTable({
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
                url : creditList,
                type: "GET",
                dataType:'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: function (d) {   
                                 
                },
            },
            fnDrawCallback : function() {
                $('#match-list #kv-toggle-demo').bootstrapToggle({
                    width : '100%'
                });
            },
            columns: [
                {data: 'created_at', sortable: false},
                {data: 'debit_coin'},
                {data: 'credit_coin'},
                {data: 'net_points'},
                {data: 'from_to'}                
            ]           
        });       
    }
});