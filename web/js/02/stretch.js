$(document).ready(function(){

    $("#click-me").click(function() {
        alert("Clicked!");
    });

    $("#change-color").click(function() {
        var newColor = $("#color-string").val();
        $("#div-1").css("background-color", newColor);
    });

    $("#fade").click(function() {
        $("#div-3").fadeToggle("slow", "linear");
    });

});