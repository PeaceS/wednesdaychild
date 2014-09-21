$(document).ready(function(){
    setup_default();
    setup_eventHandle();
});

function setup_default(){
    default_change_scrollWidthMinusPaddingScrollbar();
}

function setup_eventHandle(){
    $("#product .image.normal span").mousemove(function(event){
        event_zoom_productImage(this, event);
    });
    $("#menu #up").click(function(){
        event_slide_related(0);
    });
    $("#menu #down").click(function(){
        event_slide_related(1);
    });
}

// private function

function default_change_scrollWidthMinusPaddingScrollbar(){
    $("#relate #scroll div").width($("#relate #scroll div").width() - 15);
}
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
function event_slide_related(direction){
    var currentScrollPosition = $("#relate #scroll div").scrollTop();
    var maximumScroll = $("#relate #scroll div").height();
    var nextScrollPosition = currentScrollPosition;
    
    if ($("#relate #scroll div").hasClass("scrolling")) return false;
    if (direction === 0)
        nextScrollPosition -= maximumScroll * 0.8;
    else
        nextScrollPosition += maximumScroll * 0.8;
    
    $("#relate #scroll div").addClass("scrolling");
    $("#relate #scroll div").animate({ scrollTop : nextScrollPosition }, 1000, function(){
        $("#relate #scroll div").removeClass("scrolling");
    });
}