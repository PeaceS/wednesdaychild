$(document).ready(function(){
    setup_default();
});

function setup_default(){
    default_set_redirect();
}

// private function

function default_set_redirect(){
    setTimeout(function(){
        if ($("#popup").hasClass("sent"))
            window.location = "/shop";
        else
            window.location = "/contacts";
    }, 5000);
}