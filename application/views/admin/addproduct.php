<?php
   if($added){
      echo "<div class='well'>";
      if($complete){
         //header("Location: /tour/$id");
         echo "<h2 class='success'>Товар номер $id успешно добавлено! <a href='/menu/$id' target='_blank'>Просмтотреть его</a></h2><p><b>Не обновляйте страницу, иначе товар добавиться повторно!</b></p>";
      }else{
         foreach($errors as $error){
            echo "<h3 class='error'>".$error."</h3>";
         }
      }
      echo "</div>";
   }
?>
<h1>Добавить товар</h1>
<div class="wel"></div>
<form action="/admin/addproduct" method="post" enctype="multipart/form-data">
   <div class="block">
      <h2>Фото:</h2>
      <input type="file" name="fileToUpload" id="fileToUpload" class="inputfile" />
      <label class="filelabel" for="fileToUpload"><span>Выбрать файл</span></label>
   </div>

   <div class="block">
   <h2>Категория:</h2>
      <div class="checkboxes">
	     <select name="category">
         <?php
            $categories = require 'application/config/categories.php';
            $categories_ukr = [
               'Всё',
               'Пицца',
               'Бургеры',
               'Лапша и рис WOK',
               'Паста',
               'Суши',
               'Закуски',
               'Боулы',
               'Супы',
               'Салаты',
               'Сладкое',
               'Напитки'
            ];

            $i = 1;
            foreach ($categories as $category) {
               if($category == 'all') continue;
               else echo '
               <option value="'.$category.'"/>'.$categories_ukr[$i].'</option>';
               $i++;
            }
         ?>
		 </select>
      </div>
   </div>
   
   <div class="block">
      <h2>ID в Poster:</h2>
      <input class="price_input" type="text" name="poster_id" placeholder="ID в Poster">
      <h6>(только цыфры)</h6>
   </div>

   <div class="block">
      <h2>Цена:</h2>
      <input class="price_input" type="text" name="price" placeholder="Цена">
      <h6>(только цыфры)</h6>
   </div>

 <div class="block">
	<h2>Название:</h2>
	<input class="title_input" type="text" name="title" placeholder="Название">
 </div>
 
 <div class="block">
	<h2>Размер:</h2>
	<input class="title_input" type="text" name="size" placeholder="Размер">
 </div>

 <div class="block">
	<h2>Описание:</h2>
	<textarea name="content" rows="10" cols="80"></textarea>
 </div>
     
   <button class="submit-btn" type="submit">
      Добавить
   </button>
</form>
<script src="/public/js/jquery.cookie.js"></script>
<script>
   var inputs = document.querySelectorAll('.inputfile');
   Array.prototype.forEach.call(inputs, function(input){
      var label	 = input.nextElementSibling,
          labelVal = label.innerHTML;
      input.addEventListener('change', function(e){
      var fileName = '';
      if( this.files )
         fileName = e.target.value.split( '\\' ).pop();
         if( fileName )
         label.querySelector( 'span' ).innerHTML = fileName;
      else
         label.innerHTML = labelVal;
      });
   });
</script>
<script>
   $(function () {
      $(".submit-btn").click(function () {

         var price = $("[name=price]").val();
         $.cookie("price", price, {expires : 1});

         var title = $("[name=title]").val();
         $.cookie("title", title, {expires : 1});
		 
		 var size = $("[name=size]").val();
         $.cookie("size", size, {expires : 1});

         var rus_title_content = $("[name=content]").val();
         $.cookie("content", rus_title_content, {expires : 1});

      })

      if ($.cookie('price')!=="undefined") $('[name=price]').val($.cookie('price'));
      if ($.cookie('title')!=="undefined")$('[name=title]').val($.cookie('title'));
	  if ($.cookie('size')!=="undefined")$('[name=size]').val($.cookie('size'));
      if ($.cookie('content')!=="undefined") $('[name=content]').val($.cookie('content'));
   })
</script>
