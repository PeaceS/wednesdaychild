$(document).ready(function(){
    setup_default();
    setup_eventHandle();
});

function setup_default(){
    default_set_fixWidthTextarea();
}

function setup_eventHandle(){
    $("#message a label").click(function(){
        event_send_mail();
    });
}

// private function

function default_set_fixWidthTextarea(){
    var textarea = $("#contact #message textarea");
    
    textarea.css({
        "height": $("#message").height()/1.5,
        "min-width": textarea.innerWidth(),
        "max-width": textarea.innerWidth(),
        "min-height": $("#message").height()/1.5,
        "max-height": $("#message").height()/1.5
    });
}
function event_send_mail(){
    var data = {
        "name" : $("#message #name").val(),
        "email" : $("#message #email").val(),
        "message" : $("#message #body").val()
    };
    $.post("/contacts/send", data, function(result){
        if (result === true){
            alert("Sent!");
            //pop up
        }
    });
}