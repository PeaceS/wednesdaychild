$(document).ready(function(){
    setup_default();
    setup_eventHandle();
});

function setup_default(){
    
}

function setup_eventHandle(){
    $("#menu #up").click(function(){
        event_slide_collection("up");
    });
    $("#menu #down").click(function(){
        event_slide_collection("down");
    });
    $("#menu #mode").click(function(){
        event_changeMode_collection();
    });
    $("#collection").scroll(function(){
        event_move_tear();
    });
}

// private function

function event_slide_collection(direction){
    var currentScrollPosition = $("#collection").scrollTop();
    var maximumScroll = $("#collection").height();
    var nextScrollPosition = currentScrollPosition;
    
    if ($("#collection").hasClass("scrolling")) return false;
    if (direction === "up")
        nextScrollPosition -= maximumScroll * 0.8;
    else
        nextScrollPosition += maximumScroll * 0.8;
    
    $("#collection").addClass("scrolling");
    $("#collection").animate({ scrollTop : nextScrollPosition }, 1000, function(){
        $("#collection").removeClass("scrolling");
    });
}
function event_changeMode_collection(){
    $("#collection").animate({
        margin:"50px 100px",
        width:"1000px",
        height:"300px",
        opacity:0
    }, 500, function(){
        if ($(this).hasClass("gridView"))
            $(this).removeClass("gridView");
        else
            $(this).addClass("gridView");
        $(this).animate({
            margin:"0",
            width:"1200px",
            height:"400px",
            opacity:1
        }, 750);
    });
}
function event_move_tear(){
    var percentScrolled = $("#collection").scrollTop() / ($("#collection")[0].scrollHeight - $("#collection").height());
    var nextPosition = $("#tear1").offset().top -  ($("#tear1").offset().top * percentScrolled);
    
    $("#tear1").offset({top : nextPosition, left : $("#tear1").offset().left});
}