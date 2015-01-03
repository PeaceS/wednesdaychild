
function show_popup(wording){
    $("#blur").removeClass();
    $("#blur").addClass("show");
    $("#blur section span").text(wording);
    setTimeout(function(){
    	$("#blur").addClass("hide");
    }, 3000);
}