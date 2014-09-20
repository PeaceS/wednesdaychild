$(document).ready(function(){
    setup_default();
    setup_eventHandle();
});

function setup_default(){
    
}

function setup_eventHandle(){
    $("#home_banner").mousemove(function(event){
        event_slide_homeBanner(this, event);
    });
}

// private function

function event_slide_homeBanner(element, e){
    var slidePosition = $(element).attr("class");
    var x = e.clientX - $(element).offset().left;
    x = (x * 10) / $(element).width();
    x = Math.floor(x);
    x = x > 0 ? x : 0;
    x = x < 10 ? x : 10;
    
    var cursorPosition = "path" + x;
    if (slidePosition !== cursorPosition){
        $(element).addClass(cursorPosition);
        $(element).removeClass(slidePosition);
    }
}