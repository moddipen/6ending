// const { data } = require("jquery");

$(document).ready(function() {
    $(document).on("focus", ".amount-customization", function () {    
        $(this).next(".invalid-feedback").next(".input-group-append").css("display","block");
    });

    if(typeof get_event_type_ajax !== "undefined"){
        $(document).on("change", "#matchtype_id", function (e) { 
            $.ajax({
                type:'POST',
                url: get_event_type_ajax,
                data : {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "match_id": $(this).val(),
                    "status" : 0
                },
                success:function(data) {
                    var html = "";
                    if(data.sucess == "success")
                    {
                        $.each( data.data, function( key, value ) {
                            html += "<option value='"+key+"'>"+value+"</option>";
                        }); 
                    }else{
                        html += "<option value=''>No data found</option>";
                    }  
                    $("#eventtype_id").html(html);  
                }
            }); 
        });
    }    

    if(typeof eventList !== "undefined"){
        var dataTable = $('#event-list').DataTable({
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
                url : eventList,
                type: "POST",
                dataType:'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: function (d) {   
                                 
                },
            },
            fnDrawCallback : function() {
                $('#event-list #kv-toggle-demo').bootstrapToggle({
                    width : '100%'
                });
            },
            columns: [
                {data: 'matchType', name: 'matchType'},
                {data: 'eventType', name: 'eventType'},
                {data: 'bet_coin', name: 'bet_coin'},
                {data: 'win_coin', name: 'win_coin'},            
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]           
        });
    
        $(document).on("click", ".input-group-append", function () { 
            if($(this).prev().prev('.amount-customization').val() == ""){
                $(this).prev('.invalid-feedback').css("display","block");
            }else{
                $.ajax({
                    type:'POST',
                    url: routeWinCoinUpdate,
                    data : {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        "id": $(this).attr("data-id"),
                        "win_coin" : $(this).prev().prev('.amount-customization').val()
                    },
                    success:function() {
                        dataTable.draw();          
                    }
                }); 
            }      
        });
    
        $(document).on("change", "input[type='checkbox']", function (e) { 
            if($(this).val() == 0){
                $.ajax({
                    type:'POST',
                    url: routeStatusUpdate,
                    data : {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        "id": $(this).attr("data-id"),
                        "status" : 1
                    },
                    success:function() {
                        dataTable.draw();          
                    }
                }); 
            }else{
                $.ajax({
                    type:'POST',
                    url: routeStatusUpdate,
                    data : {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        "id": $(this).attr("data-id"),
                        "status" : 0
                    },
                    success:function() {
                        dataTable.draw();          
                    }
                }); 
            } 
        });
    }    
});

