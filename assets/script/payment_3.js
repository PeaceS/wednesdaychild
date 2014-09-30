$(document).ready(function(){
    setup_default();
    setup_eventHandle();
});

function setup_default(){
    
}

function setup_eventHandle(){
    $("ul#menu #up").click(function(){
        event_slide_summary(0);
    });
    $("ul#menu #down").click(function(){
        event_slide_summary(1);
    });
}

// private function

function event_slide_summary(direction){
    var currentScrollPosition = $("#summary #scroll #sub_scroll").scrollTop();
    var maximumScroll = $("#summary #scroll #sub_scroll").height();
    var nextScrollPosition = currentScrollPosition;
    
    if ($("#summary #scroll #sub_scroll").hasClass("scrolling")) return false;
    if (direction === 0)
        nextScrollPosition -= maximumScroll * 0.8;
    else
        nextScrollPosition += maximumScroll * 0.8;
    
    $("#summary #scroll #sub_scroll").addClass("scrolling");
    $("#summary #scroll #sub_scroll").animate({ scrollTop : nextScrollPosition }, 1000, function(){
        $("#summary #scroll #sub_scroll").removeClass("scrolling");
    });
}