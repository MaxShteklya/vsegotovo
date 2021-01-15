<h1></h1>
<?php
   if(isset($errors)){
      echo "<div class='well'>";
      foreach($errors as $error){
         echo "<h3 class='error'>".$error."</h3>";
      }
      echo "</div>";
   }
?>
<form action="/admin/edit/<?php echo $product['id']?>" method="post" enctype="multipart/form-data">
   <div class="block">
      <h2>Выбрать другое фото:</h2>
      <input type="file" name="fileToUpload" id="fileToUpload" class="inputfile" />
      <label class="filelabel" for="fileToUpload"><span>Выбрать файл</span></label>
   </div>

   <div class="block">
   <h2>Категория:</h2>
      <div class="checkboxes">
	     <select name="category">
         <?php
			$product_category = $product['category'];
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
			   $selected = '';
               if($category == 'all') continue;
               else{
				  if($category == $product_category) $selected = 'selected';
				  echo '<option value="'.$category.'" '.$selected.'>'.$categories_ukr[$i].'</option>';
               }
			   $i++;
            }
         ?>
		 </select>
      </div>
   </div>
   
   <div class="block">
      <h2>ID в Poster:</h2>
      <input class="price_input" type="text" name="poster_id" placeholder="ID в Poster" value="<?=$product['poster_id']?>">
      <h6>(только цыфры)</h6>
   </div>
   
   <div class="block">
      <h2>Цена:</h2>
      <input class="price_input" type="text" name="price" placeholder="Цена" value="<?=$product['price']?>">
      <h6>(только цыфры)</h6>
   </div>

	 <div class="block">
		<h2>Название:</h2>
		<input class="title_input" type="text" name="title" placeholder="Название" value="<?=$product['title']?>">
	 </div>
	 
	 <div class="block">
		<h2>Размер:</h2>
		<input class="title_input" type="text" name="size" placeholder="Размер" value="<?=$product['size']?>">
	 </div>

	 <div class="block">
		<h2>Описание:</h2>
		<textarea name="content" rows="10" cols="80"><?=$product['descr']?></textarea>
	 </div>

   <button class="submit-btn" type="submit">
      Сохранить
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
      $(".submit-btn").click(function (event) {
         event.preventDefault()
         var del = confirm("Ви впевнені, що хочете зберегти зміни в цьому турі?")
         if(del) $("form").submit();
      })
   })
</script>
