$(document).ready(function(){
    setup_variable();
    setup_default();
    setup_eventHandle();
});

function setup_variable(){
    
}

function setup_default(){
    
}

function setup_eventHandle(){
    $("#menu #up").click(function(){
        event_slide_collection(0);
    });
    $("#menu #down").click(function(){
        event_slide_collection(1);
    });
    $("#menu #mode").click(function(){
        event_changeMode_collection();
    });
}

// private function

function event_slide_collection(direction){
    var currentScrollPosition = $("#collection").scrollTop();
    var maximumScroll = $("#collection").height();
    var nextScrollPosition = currentScrollPosition;
    if (direction === 0)
        nextScrollPosition -= maximumScroll * 0.8;
    else
        nextScrollPosition += maximumScroll * 0.8;
    
    $("#collection").animate({ scrollTop : nextScrollPosition }, 1000);
}
function event_changeMode_collection(){
    
}