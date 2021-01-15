$(function(){

$('.inner-search input').bind("change keyup input", function() {
   if(this.value.length >= 2){
      $(".searchResults").show();
      $(".allTours").hide();
      $('.searchResults').html("<i class='fa fa-circle-o-notch loader' aria-hidden='true'></i>");
      var $request;
      if ($request != null){
          $request.abort();
          $request = null;
      }
      value = $(this).val();
      $request = $.get('/search/'+value).done(function(data){
         $(".searchResults").html(data).show();
      });

   }
   if(this.value.length == 0){
      $(".searchResults").hide();
      $(".allTours").show();
   }
})
$(".category").click(function () {
   $(".searchResults").hide();
   $(".allTours").show();
})
})
