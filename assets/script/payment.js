$(document).ready(function(){
    setup_default();
    setup_eventHandle();
});

function setup_default(){
    default_set_price();
}

function setup_eventHandle(){
    $("#bag table input#select_qty").change(function(){
        event_set_price($(this).parents("tr"));
    });
    $("#bag table .remove").click(function(){
        event_remove_row($(this).parents("tr"));
    });
    $("#bag #menu .update").click(function(){
        event_update_bag();
    });
}

// private function

function default_set_price(){
    $.each($("#bag table .item"), function(){
        event_set_price($(this));
    });
}
function event_set_price(row){
    var qty = row.find("input#select_qty").val();
    var price = parseFloat(row.find("#price").attr("price"));
    
    if (qty > row.find("input#select_qty").attr("max") || qty < row.find("input#select_qty").attr("min")) return false;
    row.find("#price").text((price * qty).toLocaleString());
}
function event_remove_row(row){
    row.addClass("remove");
}
function event_update_bag(){
    var data = new Array();
    $.each($("#bag table .item").not(".remove"), function(){
        data.push({"product" : $(this).attr("product"), "qty" : $(this).find("input#select_qty").val()});
    });
    
    $.post("/wednesdaychild/update", {"products" : data}, function(result){
        if (!isNaN(result)){
            alert("Update!");
            $("#menu_mybag amount").text(result);
        }
    });
}