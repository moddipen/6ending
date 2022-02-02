$(document).ready(function() {
    $(document).on('click', '.place-bet', function(e){
        if (confirm("Do you want to place this bet?") == true) {
            var current_div = $(this);
            var bet_amount = $(this).closest("div").find('input[name=bet_coin]').val();  
            var match_event_id = $(this).closest("div").find('input[name=match_event_id]').val();        
            var result = $(this).closest("div").find('.result').val();  
            var type = 0;  
            if($(this).closest("div").find('.result_low').length > 0 && $(this).closest("div").find('.result_high').length > 0){
                var result_low = $(this).closest("div").find('.result_low').val();
                var result_high = $(this).closest("div").find('.result_high').val();
                result = result_low+"|"+result_high;
            }  
            if($(this).closest("div").find('.type').length > 0){
                if($(this).closest("div").find('.type').val() == "One day Khada – 61 runs"){
                    var type = "61";
                }else{
                    var type = "31";
                }   
            }
            
            $.ajax({
                type:'POST',
                url: bet_url,
                data: {
                    "_token"     : $('meta[name="csrf-token"]').attr('content'),
                    "bet_coin" : bet_amount,
                    "match_event_id" : match_event_id,
                    'result' : result,
                    'type' : type
                },            
                success:function(data) {
                    current_div.closest("div").next().find('.spot-count').text(parseInt(current_div.closest("div").next().find('.spot-count').text()) + parseInt(1));
                    if(current_div.closest("div").find('.success').length > 0){
                        current_div.closest("div").find('.success').remove();
                    }
                    current_div.closest("div").find('.mx-sm-3').append('<h5 class="success text-success">Bet Placed!</h5>');   
                    // current_div.closest("div").find('.mx-sm-3').next('a').remove();
                    current_div.closest("div").find('input[name=bet_coin]').val("");   
                    current_div.closest("div").find('input[name=bet_coin]').next('div .invalid-feedback').css("display","none");                   
                },
                error:function (data) {
                    if(data.responseJSON.errors.bet_coin){
                        current_div.closest("div").find('input[name=bet_coin]').next('div .invalid-feedback').text(data.responseJSON.errors.bet_coin);
                        current_div.closest("div").find('input[name=bet_coin]').next('div .invalid-feedback').css("display","block");
                        current_div.closest("div").find('.success').remove();
                    }else if(data.responseJSON.errors.result){
                        current_div.closest("div").find('input[name=bet_coin]').next('div .invalid-feedback').text(data.responseJSON.errors.result);
                        current_div.closest("div").find('input[name=bet_coin]').next('div .invalid-feedback').css("display","block");
                        current_div.closest("div").find('.success').remove();
                    }else{
                        current_div.closest("div").find('input[name=bet_coin]').next('div .invalid-feedback').css("display","none");
                        current_div.closest("div").find('.success').remove();
                    }              
                } 
            });
        }      
    });

    $(document).on('click', '.bet-placed', function(e){
        $.ajax({
            type:'GET',
            url: placed_bet,
            data: {
                "_token"     : $('meta[name="csrf-token"]').attr('content')               
            },            
            success:function(data) {
               $(".bet-placed-list").html(data);                   
            },
            error:function (data) {
                          
            } 
        });
    });
});