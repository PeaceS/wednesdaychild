$(document).ready(function(){
    setup_default();
    setup_eventHandle();
});

function setup_default(){
}

function setup_eventHandle(){
    $("#message a label").click(function(){
        event_send_mail();
    });
}

// private function

function event_send_mail(){
    var data = {
        "name" : $("#message #name").val(),
        "email" : $("#message #email").val(),
        "message" : $("#message #body").val()
    };
    $.post("/contacts/send", data, function(result){
        if (result === true){
            show_popup("Thank you for your information");
        }
    });
}