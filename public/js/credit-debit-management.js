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
                    var start_date = $("input[name='schedule']").val();
                    var end_date = $("input[name='schedule-1']").val();

                    d.start_date = start_date;
                    d.end_date = end_date;
                },
            },
            fnDrawCallback : function() {
                $('#match-list #kv-toggle-demo').bootstrapToggle({
                    width : '100%'
                });
            },
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "visible": false,
                    "searchable": false
                }
            ],
            order: [[ 0, 'DESC' ]],
            columns: [
                {data: 'id'},
                {data: 'created_at'},
                {data: 'debit_coin'},
                {data: 'credit_coin'},
                {data: 'net_points'},
                {data: 'from_to'}                
            ]           
        });            
    }

    $(document).on('click', '.search', function(e){
        dataTable.draw();    
    }); 
    

    $('.datetime_from').datetimepicker({
        format: "YYYY-MM-DD",
        pickTime: false,
        icons: {
            time: 'far fa-clock',
            date: 'far fa-calendar-alt',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right',
            today: 'far fa-calendar-check',
            clear: 'far fa-trash-alt',
            close: 'fas fa-times'
        }
    });

    $('.datetime_to').datetimepicker({
        format: "YYYY-MM-DD",
        pickTime: false,
        icons: {
            time: 'far fa-clock',
            date: 'far fa-calendar-alt',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right',
            today: 'far fa-calendar-check',
            clear: 'far fa-trash-alt',
            close: 'fas fa-times'
        }
    });
});