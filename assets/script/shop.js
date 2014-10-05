$(document).ready(function(){
    setup_default();
    setup_eventHandle();
});

function setup_default(){
    
}

function setup_eventHandle(){
    $("#menu #up").click(function(){
        event_slide_collection(0);
    });
    $("#menu #down").click(function(){
        event_slide_collection(1);
    });
}

// private function

function event_slide_collection(direction){
    var currentScrollPosition = $("#scroll").scrollTop();
    var maximumScroll = $("#scroll").height();
    var nextScrollPosition = currentScrollPosition;
    
    if ($("#scroll").hasClass("scrolling")) return false;
    if (direction === 0)
        nextScrollPosition -= maximumScroll * 0.8;
    else
        nextScrollPosition += maximumScroll * 0.8;
    
    $("#scroll").addClass("scrolling");
    $("#scroll").animate({ scrollTop : nextScrollPosition }, 1000, function(){
        $("#scroll").removeClass("scrolling");
    });
}