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
    $("#menu #up").click(function(){
        event_slide_related(0);
    });
    $("#menu #down").click(function(){
        event_slide_related(1);
    });
    $("#product_image div").click(function(){
        event_change_image(this);
    });
    $(".product_select select").change(function(){
        event_change_product($(this).val());
    });
    $(".product_action label").click(function(){
        var amount = $(".product_select.qty input").val();
        event_buy_product($("#product").attr("no"), amount);
    });
    $("#buy_product").mouseover(function(){
        event_show_select();
    });
    $("#detail").mouseover(function(){
        event_hide_select();
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
function event_change_image(element){
    var image = $(element).css("background-image");
    var zoom = $(element).attr("zoom");
    var title = $(element).attr("title");
    
    $(element).css("background-image", $(".image.normal span").css("background-image"));
    $(element).attr("title", $(".image.normal span").attr("title"));
    $(element).attr("zoom", $(".image.zoom span").css("background-image"));
    $(".image.normal span").attr("title", title);
    $(".image.normal span").css("background-image", image);
    $(".image.zoom span").css("background-image", zoom);
}
function event_change_product(product){
    var url = "/product/" + product;
    window.location = url;
}
function event_buy_product(product, amount){
    var data = {"product" : product, "qty" : amount};
    
    $.post("/buy", data, function(result){
        if (!isNaN(result)){
            show_popup("the item has added to cart");
            $("#menu_mybag amount").text(result);
        }
    });
}
function event_show_select(){
    $("#buy_product").addClass("hide");
    $("#select").slideToggle(500, function(){
        $("#detail").addClass("hideScroll");
    });
}
function event_hide_select(){
    $("#select").slideUp(350, function(){
        $("#detail").removeClass("hideScroll");
        $("#buy_product").removeClass("hide");
    });
}
