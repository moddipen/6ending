$(document).ready(function() {
    $(document).on('click', '.place-bet', function(e){
        if (confirm("Do you want to place this bet?") == true) {
            var current_div = $(this);
            var bet_amount = $(this).closest("div").find('input[name=bet_coin]').val();  
            var eventtype_id = $(this).closest("div").find('input[name=eventtype_id]').val();        
            var match_id = $(this).closest("div").find('input[name=match_id]').val();   
            var result = $(this).closest("div").find('.result').val();        
            $.ajax({
                type:'POST',
                url: bet_url,
                data: {
                    "_token"     : $('meta[name="csrf-token"]').attr('content'),
                    "bet_coin" : bet_amount,
                    "eventtype_id" : eventtype_id,
                    "match_id"   : match_id,
                    'result' : result
                },            
                success:function(data) {
                    current_div.closest("div").next().find('.spot-count').text(parseInt(current_div.closest("div").next().find('.spot-count').text()) + parseInt(1));
                    current_div.closest("div").find('.mx-sm-3').html('<h5 class="success text-success">Bet Placed!</h5>');   
                    current_div.closest("div").find('.mx-sm-3').next('a').remove();
                    current_div.closest("div").find('input[name=bet_coin]').val("");   
                    current_div.closest("div").find('input[name=bet_coin]').next('div .invalid-feedback').css("display","none");                   
                },
                error:function (data) {
                    if(data.responseJSON.errors.bet_coin){
                        current_div.closest("div").find('input[name=bet_coin]').next('div .invalid-feedback').text(data.responseJSON.errors.bet_coin);
                        current_div.closest("div").find('input[name=bet_coin]').next('div .invalid-feedback').css("display","block");
                    }else if(data.responseJSON.errors.result){
                        current_div.closest("div").find('input[name=bet_coin]').next('div .invalid-feedback').text(data.responseJSON.errors.result);
                        current_div.closest("div").find('input[name=bet_coin]').next('div .invalid-feedback').css("display","block");
                    }else{
                        current_div.closest("div").find('input[name=bet_coin]').next('div .invalid-feedback').css("display","none");
                    }              
                } 
            });
        }      
    });
});