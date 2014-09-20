$(document).ready(function(){
    setup_default();
    setup_eventHandle();
});

function setup_default(){
    
}

function setup_eventHandle(){
    $("#product .image.normal span").mousemove(function(event){
        event_zoom_productImage(this, event);
    });
}

// private function

function event_zoom_productImage(element, e){
    var x = e.clientX - $(element).offset().left;
    var y = e.clientY - $(element).offset().top;
    x = (x * 100) / $(element).width();
    y = (y * 100) / $(element).height();
    x = x.toFixed(1);
    y = y.toFixed(1);
    
    x = -x * 4;
    y = -y * 4;
    
    $("#product .image.zoom span").css({
       "top": y + "%",
       "left": x + "%"
    });
    
}