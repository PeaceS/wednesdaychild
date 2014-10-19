$(document).ready(function(){
    setup_default();
    setup_eventHandle();
});

function setup_default(){
    default_set_fixWidthTextarea();
}

function setup_eventHandle(){
    $("#message form label").click(function(){
        $("#message form").submit();
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