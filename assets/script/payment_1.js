$(document).ready(function(){
    setup_default();
    setup_eventHandle();
});

function setup_default(){
    default_set_price();
}

function setup_eventHandle(){
    $("#bag table .qty input").change(function(){
        event_set_price($(this).parents("tr"));
    });
    $("#bag table .size select").change(function(){
        event_change_product($(this));
    });
    $("#bag table .remove").click(function(){
        event_remove_row($(this).parents("tr"));
    });
    $("#bag #menu .update, #bag #menu .next").click(function(){
        event_update_bag($(this).hasClass("next"));
    });
}

// private function

function default_set_price(){
    $.each($("#bag table .item"), function(){
        event_set_price($(this));
    });
}
function event_set_price(row){
    var qty = row.find(".qty input").val();
    var price = parseFloat(row.find(".price").attr("price"));
    
    if (qty > row.find(".qty input").attr("max") || qty < row.find(".qty input").attr("min")) return false;
    row.find(".price").text((price * qty).toLocaleString());
}
function event_change_product(element){
    var product = element.attr("product") ? element.attr("product") : element.val();
    
    element.parents("tr").attr("product", product);
}
function event_remove_row(row){
    row.addClass("remove");
}
function event_update_bag(next){
    var data = new Array();
    $.each($("#bag table .item").not(".remove, .preremove"), function(){
        var qty = $(this).find(".qty input").val();
        if (qty > $(this).find(".qty input").attr("max") || qty < $(this).find(".qty input").attr("min")) return false;
        data.push({"product" : $(this).attr("product"), "qty" : $(this).find(".qty input").val()});
    });
    
    $.post("/wednesdaychild/update/bag", {"products" : data}, function(result){
        if (!isNaN(result)){
            if (!next){
                alert("Update!");
                window.location = "/buy/1";
            }else
                window.location = "/buy/3";
        }
    });
}