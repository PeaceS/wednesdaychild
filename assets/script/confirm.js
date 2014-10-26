$(document).ready(function(){
    setup_eventHandle();
});

function setup_eventHandle(){
    $("#confirm form a label").click(function(){
        event_send_confirm();
    });
}

// private function

function event_send_confirm(){
    alert("WTF");
    $("form").submit();
}