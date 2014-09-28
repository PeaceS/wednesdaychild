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
function event_check_stock(product){
    var url = "/wednesdaychild/stock/" + product;
    
    $.post(url, function(result){
        if (result)
            alert("OK Check");
    });
}