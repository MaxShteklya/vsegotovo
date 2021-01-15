<div class="container mt-5 pt-3 mb-5">
   <div class="row">
      <div class="col-sm-12 col-md-6">
         <div class="photo">
            <div class="photo__wrapper">
               <div class="photo__content">
                  <img src="/<?=$product['image']?>" alt="">
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-12 col-md-6 product_descr">
         <h1 class="text-center text-md-left">
            <?=$product['title']?>
         </h1>
         <p class="size text-center text-md-left">
			<?php 
				if($product['category'] == 'drinks') $val = "л";
				else $val = "г";
			?>
            <?=$product['size']?><?=$val?>
         </p>
		 
         <div class="order">
            <div class="row p-0 m-0">
               <div class="col-6 col-md-4 price">
                  <?=$product['price']?><br>
                  грн
               </div>
               <div class="col-6 col-md-8">
                  <div class="quantity-block">
                     <button class="quantity-arrow-minus"> - </button>
                     <input class="quantity-num" type="number" value="1" />
                     <button class="quantity-arrow-plus"> + </button>
                  </div>
               </div>
            </div>
            <a href="" class="order_now" 
					data-id="<?=$product['id']?>"
					data-price="<?=$product['price']?>"
					data-category="<?=$product['category']?>">Заказать</a>
         </div>
         <div class="descr">
            <p>
               <b>Состав:</b> <?=$product['descr']?>
            </p>
         </div>

      </div>
   </div>
</div>

<script>
  fbq('track', 'ViewContent', {
    value: <?=$product['price']?>,
    currency: 'UAH',
    content_ids: '<?=$product['id']?>',
    content_type: '<?=$product['category']?>',
  });
</script>