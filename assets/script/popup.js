$(document).ready(function(){
    setup_default();
});

function setup_default(){
	default_show_blur();
    default_set_redirect();
}

// private function

function default_show_blur(){
	$("#blur").show();
}
function default_set_redirect(){
    setTimeout(function(){
        if ($("#blur section span").hasClass("confirm"))
            window.location = "/shop";
        else
            window.location = "/contacts";
    }, 5000);
}