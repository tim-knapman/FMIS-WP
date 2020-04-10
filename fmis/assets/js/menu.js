$(document).ready(function(){
  $("#menu-btn").click(function(event){
    // alert("Clicked");
    $("#menu-btn").toggleClass("active");
    $(".desktop").toggleClass("active");
  });
});
