<!DOCTYPE html>
<html lang="ru" dir="ltr">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?=$title?></title>

      <link rel="stylesheet" href="/public/css/bootstrap.min.css">
      <link rel="stylesheet" href="/public/css/font-awesome.min.css">
      <link rel="stylesheet" href="/public/css/adminlogin.css">
      <link rel="stylesheet" href="/public/css/util.css">

   </head>
   <body>
      <?=$content?>

      <script src="/public/js/jquery.js"></script>
      <script src="/public/js/bootstrap.min.js"></script>
      <script>
      $(function(){
         $('[data-toggle="tooltip"]').tooltip();
         $(".side-nav .collapse").on("hide.bs.collapse", function() {
              $(this).prev().find(".fa").eq(1).removeClass("fa-angle-right").addClass("fa-angle-down");
         });
         $('.side-nav .collapse').on("show.bs.collapse", function() {
              $(this).prev().find(".fa").eq(1).removeClass("fa-angle-down").addClass("fa-angle-right");
         });
      })
      </script>
   </body>
</html>
