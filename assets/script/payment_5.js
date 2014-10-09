$(document).ready(function(){
    setup_default();
    setup_eventHandle();
});

function setup_default(){
    window.confirm = false;
}

function setup_eventHandle(){
    $(window).on("beforeunload", function(){
        if (!window.confirm)
            return "This should create a pop-up";
    });
    $("#bankwire .next").click(function(){
        window.confirm = true;
        $.post("/buy/bankwire/confirm", function(result){
            if (!result)
                window.location = "/buy/1";
            else
                window.location = "/collection";
        });
    });
}