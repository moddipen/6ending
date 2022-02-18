$(document).ready(function() {
    $(document).on("focus", ".amount-customization", function () {    
        $(this).next(".invalid-feedback").next(".input-group-append").css("display","block");
    });

    $(document).on("focus", ".select-winner", function () {    
        $(this).next(".invalid-feedback").next(".input-group-append").css("display","block");
    });

    $(document).on("click", ".input-group-append", function () { 
        var temp_element = $(this);
        if($(this).prev().prev('.amount-customization').val() == ""){
            $(this).prev('.invalid-feedback').css("display","block");
        }else{
            $.ajax({
                type:'POST',
                url: routeMatcheventResultUpdate,
                data : {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "id": $(this).attr("data-id"),
                    "result" : $(this).prev().prev('.amount-customization').val()
                },
                success:function(data) {
                    location.reload();
                }
            }); 
        }      
    });
   
    $(document).on("change", "input[type='checkbox']", function (e) { 
        var current = $(this);
        if($(this).val() == 0){
            $.ajax({
                type:'POST',
                url: routeTypeUpdate,
                data : {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "id": $(this).attr("data-id"),
                    "status" : 0
                },
                success:function() {
                    current.val('1');    
                }
            }); 
        }else{
            $.ajax({
                type:'POST',
                url: routeTypeUpdate,
                data : {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "id": $(this).attr("data-id"),
                    "status" : 1
                },
                success:function() {
                    current.val('0');   
                }
            }); 
        } 
    });       
});

function validate_form(){
    if (confirm("Do you want to make settlements?") == true) {
        $("#validate-form").submit();    
    }    
}