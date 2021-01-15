<h1>Albums</h1>
<div class="container-fluid row albums">
   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 album addAlbum">
      <div class="inner">
         <div class="add">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
            <h2>Add</h2>
         </div>
      </div>
   </div>

   <?php
      foreach ($albums as $album) {
         $dir = 'public/img/albums/'.$album['id'];
         $files = scandir($dir, 0);
         echo $files[2];
         echo <<<HTML
         <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 album">
            <div class="inner">
               <div class="photo" style="background-image:url(/public/img/albums/$album[id]/)"></div>
               <p class="name">
                  $album[rus_title]
               </p>
            </div>
         </div>
HTML;
      }
   ?>

</div>
<h1 data-name="add">Add album</h1>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<script>
   $(function () {
      $(".add").click(function(e){
         e.preventDefault()
         var target = $('[data-name=add]')
         $('html, body').animate({scrollTop: target.offset().top-60}, 1000)
      })
   })
</script>
