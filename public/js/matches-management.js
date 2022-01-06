$(document).ready(function() {
    if(typeof matchList !== "undefined"){
        var dataTable = $('#match-list').DataTable({
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
                url : matchList,
                type: "POST",
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
                {data: 'matchType'},
                {data: 'team_1'},
                {data: 'team_2'},
                {data: 'status'}
            ]           
        });
    
        // $(document).on("click", ".input-group-append", function () { 
        //     if($(this).prev().prev('.amount-customization').val() == ""){
        //         $(this).prev('.invalid-feedback').css("display","block");
        //     }else{
        //         $.ajax({
        //             type:'POST',
        //             url: routeWinCoinUpdate,
        //             data : {
        //                 "_token": $('meta[name="csrf-token"]').attr('content'),
        //                 "id": $(this).attr("data-id"),
        //                 "win_coin" : $(this).prev().prev('.amount-customization').val()
        //             },
        //             success:function() {
        //                 dataTable.draw();          
        //             }
        //         }); 
        //     }      
        // });
    
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