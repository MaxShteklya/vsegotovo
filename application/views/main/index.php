
<section class="slider">
   <div class="arrow arrow_l"><i class="fa fa-chevron-left"></i></div>
   <div class="visible"></div>
   <div class="arrow arrow_r"><i class="fa fa-chevron-right"></i></div>
   <div class="navs"></div>
   <div class="slide_text container">
<!--      <h1>-->
<!--         Доставляем в удовольствие!<br>-->
<!--         <small>С 11:00 до 16:00 действует скидка -20%</small>-->
<!--      </h1>-->
      <!-- <p>Дорогие друзья, дальнейшее развитие различных форм деятельности позволяет оценить значение форм воздействия. С другой стороны консультация с профессионалами из IT влечет за собой процесс внедрения и модернизации дальнейших направлений развитая системы массового участия.</p> -->
   </div>
</section>
<section class="banner banner-bottom rotate-180">
   <img src="/public/img/wave_top_or.png" alt="">
</section>

<section class="section_1">
    <div class="container">
      <div class="row">
         <div class="col-md-12"><h2>Самое популярное</h2><div class="line"></div></div>
      </div>
      <div class="row">
         <?php foreach ($mostPopular as $dish) {  ?>
		   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 pb-5">
			  <div class="menu_card product">
				 <a href="/menu/<?=$dish['id']?>">
					<div class="image">
					   <img src="/<?=$dish['image']?>"  alt=""/>
					</div>
				 </a>
				 <h4>
					<a href="/menu/<?=$dish['id']?>">
					   <?=$dish['title']?>
					</a>
				 </h4>

				 <p class="sm_desr">
					<?=strip_tags($dish['descr'])?>
				 </p>
				 <div class="vab">
					<div class="row p-0 m-0">
					   <div class="col-4 col-md-3">
						  <span class="price"><?=$dish['price']?> <br><span class="valute">грн</span></span>
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
					data-id="<?=$dish['id']?>"
					data-price="<?=$dish['price']?>"
					data-category="<?=$dish['category']?>">Заказать</a>
				 </div>
			  </div>
		   </div>
         <?php } ?>
         <div class="col-md-12">
            <a href="/menu" class="see_all">Посмотреть всё меню...</a>
         </div>
      </div>

    </div>
</section>
<section class="banner banner-bottom">
   <img src="/public/img/wave.png" alt="">
</section>


<script src="/public/js/slider.js?v=<?=rand(0,999)?>"></script>
