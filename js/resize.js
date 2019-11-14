$(".mobilebar").on('click', function() {
  $(".button.mobile").css("visibility", "hidden");
  $(".sidebar").css("visibility", "visible").css("width", "100px");
  $(".button.bmenu").css("color", "black").css("width", "100px");
    setTimeout(function(){
      $(".button.mobile").css("visibility", "visible");
      $(".sidebar").css("visibility", "hidden");
      $(".button.bmenu").css("width", '');
    }, 5000);
});
