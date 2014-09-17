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
    $("#collection").scroll(function(){
        event_move_tear();
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
    $("#collection").animate({
        marginLeft:"5%",
        marginTop:"2.5%",
        width:"90%",
        height:"90%",
        opacity:0
    }, 500, function(){
        if ($(this).hasClass("gridView"))
            $(this).removeClass("gridView");
        else
            $(this).addClass("gridView");
        $(this).animate({
            marginLeft:"0%",
            marginTop:"0%",
            width:"102.5%",
            height:"100%",
            opacity:1
        }, 750);
    });
}
function event_move_tear(){
    var percentScrolled = $("#collection").scrollTop() / ($("#collection")[0].scrollHeight - $("#collection").height());
    var nextPosition = $("#tear1").offset().top -  ($("#tear1").offset().top * percentScrolled);
    
    $("#tear1").offset({top : nextPosition, left : $("#tear1").offset().left});
}