$(document).ready(function(){
    setup_default();
    setup_eventHandle();
});

function setup_default(){
    default_set_fixWidthTextarea();
}

function setup_eventHandle(){
    $("#shipping #menu .back, #shipping #menu .next").click(function(){
        event_update_address($(this));
    });
}

// private function

function default_set_fixWidthTextarea(){
    var textarea = $("#shipping table textarea");
    
    textarea.css({
        "min-width": textarea.innerWidth(),
        "min-height": textarea.height(),
        "max-height": textarea.height()
    });
}
function event_update_address(element){
    var data = new Object();
    var validation = true;
    $.each($("#shipping table tr"), function(){
        var item = $(this).attr("type");
        var value = $(this).find("input").val() !== undefined ? $(this).find("input").val() : $(this).find("textarea").val();
        
        data[item] = value;
        
        $(this).removeClass("validate_fail");
        if (!validateData(value, $(this).find("input, textarea").attr("validate"))){
            validation = false;
            $(this).addClass("validate_fail");
        }
    });
    
    $.post("/update/address", {"shippingAddress" : data}, function(){
        if (element.hasClass("back") || validation)
            window.location = element.hasClass("next") ? "/buy/3" : "/buy/1";
    });
    
    
    function validateData(value, type){
        if (value === '' || value === null || value === undefined) return false;
        switch(type){
            case "alphabet":
                var regexLetter = /[a-zA-z]/;
                if (!regexLetter.test(value)) return false;
                break;
            case "number":
                var regexNum = /\d/;
                if (!regexNum.test(value)) return false;
                break;
            case "email":
                var at_index = value.indexOf("@");
                var dot_index = value.lastIndexOf(".");
                if (at_index < 1 || dot_index < at_index + 2 || dot_index + 2 >= value.length) return false;
                break;
        }
        
        return true;
    }
}