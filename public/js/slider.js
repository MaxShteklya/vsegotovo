$(function () {
   var count = 3, active = 1;
   var photos = ["intro31_1.JPG"];
   for (var i = 1; i <= photos.length; i++) {
      $(".slider .visible").append("<div class='slide' data-id='"+i+"' style='background-image: url(/public/img/"+photos[i-1]+")'></div>")

      $(".slider .navs").append("<div class='slider_nav' data-id='"+i+"'></div>")
      if(i == 1) $(".slider_nav").addClass("slider_nav_active")
   }

   $(".slider .slide_text").children().each(function () {
      $(this).animate({top: 0, opacity: 1}, 1000)
   })

   interval = setInterval(function () {
      $(".slider .arrow_r").click();
   }, 5000)

   $(".slider .arrow_r").click(function () {
      clearInterval(interval);
      interval = setInterval(function () {
         $(".slider .arrow_r").click();
      }, 5000)
      w = $(".slider").width();
      if(active >= photos.length) active = 0
      $(".visible").animate({marginLeft: -w*active});
      active++;
      $(".slider_nav_active").removeClass("slider_nav_active");
      $(".slider_nav[data-id="+active+"]").addClass("slider_nav_active")
   })

   $(".slider .arrow_l").click(function () {
      clearInterval(interval);
      interval = setInterval(function () {
         $(".slider .arrow_r").click();
      }, 5000)
      w = $(".slider").width();
      active--;
      if(active <= 0) active = photos.length
      $(".visible").animate({marginLeft: -w*(active-1)});
      $(".slider_nav_active").removeClass("slider_nav_active");
      $(".slider_nav[data-id="+active+"]").addClass("slider_nav_active")
   })

   $(".slider_nav").click(function () {
      w = $(".slider").width();
      id = $(this).attr("data-id");
      active = id;
      $(".visible").animate({marginLeft: -w*(active-1)});
      $(".slider_nav_active").removeClass("slider_nav_active");
      $(".slider_nav[data-id="+active+"]").addClass("slider_nav_active")
   })


})
