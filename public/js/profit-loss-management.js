$(document).ready(function() {
    if(typeof profitlossList !== "undefined"){
        var dataTable = $('#betting-history-list').DataTable({
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
                url : profitlossList,
                type: "POST",
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
            columns: [
                {data: 'match'},
                {data: 'created_at'},
                {data: 'settlement_time'},
                {data: 'p&l'},
                {data: 'action'},
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

    $(document).on('click', '.detail-bet', function(e){
        e.preventDefault(); 
        $.ajax({
            type:'GET',
            url: $(this).attr('href'),
            dataType: 'json',
            success:function(data) {
                // var data = JSON.parse(data);
                var html = "";                   
                $.each(data.events, function (i){
                    
                    $.each(data.events[i].bet, function (j){
                        
                        html += "<tr>";
                        html += "<td>"+data.events[i].bet[j].id+"</td>";
                        html += "<td>"+data.events[i].bet[j].result+"</td>";
                        html += "<td>"+new Date(data.events[i].bet[j].created_at).toLocaleString()+"</td>";
                        if(data.events[i].bet[j].status == "win"){  
                            html += "<td>"+net_point_calculation_winner(data.events[i].matchtypeevent.bet_coin, data.events[i].matchtypeevent.win_coin, data.events[i].bet[j].bet_coins)+"</td>";
                        }else if(data.events[i].bet[j].status == "loss"){
                            html += "<td class='text-danger'>-"+data.events[i].bet[j].bet_coins+"</td>";
                        }
                        html += "<td></td>";
                        html += "</tr>";
                    });                        
                });               
                $("#detail-bet table tbody").html(html);
            }
        });   
    });
});

function net_point_calculation_winner( actual_bet_coin, actual_win_coin, bet_placed_by_user){
    // alert(bet_placed_by_user*actual_win_coin);
    return Math.round(bet_placed_by_user*actual_win_coin/actual_bet_coin);
}





