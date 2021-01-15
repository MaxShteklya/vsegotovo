<h1>Редактировать товары</h1>
<div class="tours container-fluid centered row">
   <?php $i = 0; ?>

   <?php foreach($products as $product): ?>
      <?php
         $procuct_active = "";
         if($product['status'] == 0) $procuct_active = "disactived";
      ?>
      <div class="col-12 col-md-6 col-lg-4 <?=$procuct_active?>">
         <div class="inner-tour">
            <a href="/menu/<?php echo $product['id']; ?>">
               <div class="preview" style="background-image: url('/<?php echo $product['image']?>')"></div>
            </a>
            <div class="inner-text">
               <a href="/menu/<?php echo $product['id']; ?>"><h3><?php echo $product['title']; ?></h3></a>
               <p class="tour_way"><?php echo $product['descr']; ?></p>
               <p class="price"><?php echo $product['price']; ?>грн</p>
               <table class="edit">
                  <tr>
                     <td class="edit-btn">
                        <a class="btn-more-y div_a" href="/admin/edit/<?php echo $product['id']; ?>">Редактировать</a>
                     </td>
                     <td class="del-btn">
                        <a class="btn-del div_a" href="/admin/delete/<?php echo $product['id']; ?>">
                           <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                     </td>
                  </tr>
                  <tr>
                     <td class="disactive-btn" colspan="2">
                        <a class="btn-more-y div_a" href="/admin/changestatus/<?php echo $product['id']."_".$product['status']; ?>">
                           <?php
                              if($product['status'] == 0) echo "Активировать";
                              else echo "Деактивировать";
                           ?>
                        </a>
                     </td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
      <?php $i++; ?>
   <?php endforeach; ?>
   <?php
      if($i==0){
         echo "Товаров пока нет. <a href='/admin/addproduct'>Добавить</a>";
      }
   ?>
</div>
<script>
   $(function () {
      $(".btn-del").click(function (event) {
         event.preventDefault()
         var del = confirm("Вы уверены в том, что хотите удалить этот товар?")
         if(del) window.location.href = $(this).attr("href");
      })
   })
</script>
