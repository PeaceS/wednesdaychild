
function show_popup(wording){
    $("#blur section span").text(wording);
    $("#blur").fadeIn(1500, function(){
    	$("#blur").fadeOut(1000);
    });
}