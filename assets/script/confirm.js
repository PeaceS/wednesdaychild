$(document).ready(function(){
    setup_eventHandle();
});

function setup_eventHandle(){
    $("#confirm form a label").click(function(){
	    $("form").submit();
    });
}
