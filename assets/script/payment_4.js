$(document).ready(function(){
    setup_default();
    setup_eventHandle();
});

function setup_default(){
    
}

function setup_eventHandle(){
    $("#payment_method table td#bankwire").click(function(){
        event_choose_bankwire();
    });
    $("#payment_method table td#paypal").click(function(){
        event_choose_paypal();
    });
}

// private function

function event_choose_bankwire(){
    alert("bankwire");
}
function event_choose_paypal(){
    alert("paypal");
}