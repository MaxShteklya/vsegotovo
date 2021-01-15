<?php
   if(!empty($error)){
      if($error){
         echo '<div class="col-md-12"><p align="center">Ничего не найдено</p></div>';
      }
   }
?>
<div class="row-flex m-0">
   <?php foreach($products as $product): ?>
      <div class="col-12 col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 p-0 m-0 product_outer">
         <div class="product">
            <div class="image">
               <a href="/menu/<?=$product['id']?>"><img src="/<?=$product['image']?>" alt="<?=$product['title']?>"/></a>
            </div>
            <h4 class="title">
               <a href="/menu/<?=$product['id']?>"><?=$product['title']?></a>
            </h4>
            <div class="body">
               <p class="sm_descr">
                  <?=strip_tags($product['descr'])?>
               </p>
            </div>
            <div class="vab">
               <div class="row p-0 m-0">
                  <div class="col-4 col-md-3">
                     <span class="price"><?=$product['price']?> <br><span class="valute">грн</span></span>
                  </div>
                  <div class="col-8 col-md-9">
                     <div class="quantity-block">
                        <button class="quantity-arrow-minus"> - </button>
                        <input class="quantity-num" type="number" value="1" />
                        <button class="quantity-arrow-plus"> + </button>
                     </div>
                  </div>
               </div>
               <a href="/" class="order_now" 
					data-id="<?=$product['id']?>"
					data-price="<?=$product['price']?>"
					data-category="<?=$product['category']?>">Заказать</a>
            </div>
         </div>
      </div>
   <?php endforeach; ?>

</div>
