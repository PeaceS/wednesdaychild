
function show_popup(wording){
    $("#blur section span").text(wording);
    $("#blur").fadeIn(3000, function(){
    	$("#blur").fadeOut(2000);
    });
}