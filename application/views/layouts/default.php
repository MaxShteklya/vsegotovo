<!DOCTYPE html>
<html lang="ru" dir="ltr">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>
         <?=$title?>
      </title>

      <link rel="shortcut icon" href="/public/img/favicon.png" type="image/png">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="/public/css/font-awesome.min.css">
      <link rel="stylesheet" href="/public/css/style.css?v=<?=rand(0,9999)?>">
      <link rel="stylesheet" href="/public/css/<?=$styles?>.css">
      <link rel="stylesheet" href="/public/css/snow.css">
	  <link rel="canonical" href="https://vsegotovo.od.ua"/>

	  <meta name="description" content="Сайт доставки еды по Одессе. Самая вкусная еда и быстрая доставка. Досталвяем по всей Одессе! (073) 0-777-001 (099) 1-377-001">
	  <meta name="keywords" content="все готово одесса, доставка еды, заказ еды на дом, еда в офис, пицца, бургеры, бургермания, закуски, лапша wok, рис wok" />
	  <meta name="robots" content="index,follow" />
      <meta property="og:image" content="http://vsegotovo.od.ua/public/img/menu/1605295539.jpg">

      <!-- SCRIPTS -->
      <script src="/public/js/jquery.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <script src="/public/js/jquery.cookie.js"></script>
      <?php if($this->route['action'] != "menu" && $this->route['action'] != "checkout"){ ?>
       <script src="/public/js/shop.js?v=<?=rand(0,9999)?>"></script>
       <?php } ?>
	  <!-- Facebook Pixel Code -->
	<script>
	  !function(f,b,e,v,n,t,s)
	  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	  n.queue=[];t=b.createElement(e);t.async=!0;
	  t.src=v;s=b.getElementsByTagName(e)[0];
	  s.parentNode.insertBefore(t,s)}(window, document,'script',
	  'https://connect.facebook.net/en_US/fbevents.js');
	  fbq('init', '853952315420636');
	  fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=853952315420636&ev=PageView&noscript=1" /></noscript>
	<!-- End Facebook Pixel Code -->
   </head>
   <body>
      <div class="snowflakes" aria-hidden="true">
           <div class="snowflake">❅</div>
           <div class="snowflake">❅</div>
           <div class="snowflake">❆</div>
           <div class="snowflake">❄</div>
           <div class="snowflake">❅</div>
           <div class="snowflake">❆</div>
           <div class="snowflake">❄</div>
           <div class="snowflake">❅</div>
           <div class="snowflake">❆</div>
           <div class="snowflake">❄</div>
       </div>
      <div class="top_navbar_container"></div>
      <div class="top_navbar">
         <div class="container">
            <div class="row">
               <div class="col-10">
                  <div class="top_contacts d-none d-sm-inline-block">
                     <p>
                        Наш инстаграм:<br>
                        <span><a target="_blank" href="https://www.instagram.com/vsegotovo.od/" rel="noopener">vsegotovo.od</a></span>
                     </p>
                  </div>
                  <div class="top_contacts">
                     <p>
                        Позвонить нам:<br>
                        <span>
                           <a href="tel:0730777001">(073)0-777-001</a><br>
                        </span>
                     </p>
                  </div>
                   <div class="top_contacts">
                       <p>
                           <br>
                           <span>
                           <a class="d-none d-lg-inline-block" href="tel:0991377001">(099)1-377-001</a><br>
                        </span>
                       </p>
                   </div>
				  <div class="top_contacts">
                     <p>
                        График работы:<br>
                        <span>
                           <a href="#">Ежедневно, 11:00-22:30</a><br>
                        </span>
                     </p>
                  </div>
               </div>
               <div class="col-2">
                  <div class="pull-right">
                     <a class="cart" href="/" data-toggle="modal" data-target="#exampleModalCenter">
                        <span class="icon"><i class="fa fa-shopping-basket"></i></span>
                        <div class="count">0</div>
                     </a>
                  </div>
                  <div class="pull-left float-sm-right">
                     <!-- <div class="search-box">
                        <span class="icon"><i class="fa fa-search"></i></span>
                        <input type="search" id="search" placeholder="Поиск..." />
                     </div> -->
                  </div>
               </div>
            </div>

         </div>
      </div>
      <header>

         <div class="navbox">
            <nav class="container navbar navbar-expand-md">
               <a class="navbar-brand" href="/">
                 <img src="/public/img/logo1.png" alt="Домой" class="logo">
                 <img src="/public/img/hat.png" alt="" class="hat">
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
             </button>

              <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="mr-auto"></ul>
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="/menu">Меню</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/promo">Акции</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/delivery">Доставка</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/about_us">О нас</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/contacts">Контакты</a>
                  </li>
                </ul>
             </div>
            </nav>
         </div>
      </header>
      <main>
         <section class="banner banner-header" style="z-index: 3;">
            <img src="/public/img/wave_top_or.png" alt="">
         </section>
         <?=$content?>
      </main>
      <footer class="page-footer font-small pt-4">
         <div class="container text-center text-md-left">
            <div class="row">
               <div class="col-md-3 mt-md-0 mt-3">
                  <a href="/"><img class="bottom_logo" src="/public/img/logo2.png" alt=""></a>
                  <p>ДОСТАВЛЯЕМ В УДОВОЛЬСТВИЕ!</p>
               </div>
               <hr class="clearfix w-100 d-md-none pb-3">
               <div class="col-md-3 mb-md-0 mb-3">
                  <ul class="list-unstyled">
                     <li>
                        <a href="/menu">Меню</a>
                     </li>
                     <li>
                        <a href="/delivery">Доставка</a>
                     </li>
                     <li>
                        <a href="/about_us">О нас</a>
                     </li>
                  </ul>
               </div>
               <div class="col-md-3 mb-md-0 mb-3">
                  <ul class="list-unstyled">
                     <li>
                       <a href="/promo">Акции</a>
                     </li>
                     <li>
                        <a href="/contacts">Контакты</a>
                     </li>
                     <li>
                        <a href="/public_oferta">Публичный договор<br>(оферта)</a>
                     </li>
                  </ul>
               </div>
               <div class="col-md-3 mb-md-0 mb-3 contacts">
                  <ul class="list-unstyled">
                     <li>
                        <a target="_blank" href="https://www.instagram.com/vsegotovo.od/" rel="noopener">
                           <i class="fa fa-instagram"></i> vsegotovo.od
                        </a>
                     </li>
                     <li>
                        <a href="tel:0730777001">
                           <i class="fa fa-phone"></i> (073) 0-777-001
                        </a>
                        <a href="tel:0991377001" style="margin-left:35px">(099) 1-377-001</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="footer-copyright text-center py-3">
            Made by <a href="https://www.instagram.com/max_shteklya/" rel="noopener">Max Shteklya</a>
            <br>© 2020 Copyright
         </div>
      </footer>
      <!-- Modal -->
      <div class="modal fade" id="exampleModalCenter" role="dialog">
         <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Корзина</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <div class="modal_titles d-none d-sm-flex row p-0 m-0">
                     <div class="col-sm-3">
                        Фото:
                     </div>
                     <div class="col-sm-3 col-lg-4">
                        Название:
                     </div>
                     <div class="col-sm-4 col-lg-3 title_count">
                        Кол-во:
                     </div>
                     <div class="col-sm-1">Всего:</div>
                     <div class="col-sm-1"></div>
                  </div>
               </div>
               <div class="modal-footer total_bl">
                  <div class="col-md-3 offset-9 text-right">
                      Всего: <span id="total" style="font-weight: bold">500</span> грн
                  </div>
               </div>
               <div class="modal-footer">
                  <a href="/checkout" class="to_checkout">Оформить</a>
               </div>
            </div>
         </div>
      </div>
		<button id="scroller" title="Go to top"><i class="fa fa-angle-up" aria-hidden="true"></i></button>
		<script>
			$(function(){
				$(window).scroll(function () {
					if ($(this).scrollTop() > 0) $('#scroller').fadeIn();
					else $('#scroller').fadeOut();

				});
				$('#scroller').click(function () {
					$('body,html').animate({
						scrollTop: 0
					}, 400);
					return false;
				});
			})
		</script>
		<!--<script type="text/javascript">
		  (function(d, w, s) {
			var widgetHash = 'a0z78usydmxf5z4a4iwm', gcw = d.createElement(s); gcw.type = 'text/javascript'; gcw.async = true;
			gcw.src = '//widgets.binotel.com/getcall/widgets/'+ widgetHash +'.js';
			var sn = d.getElementsByTagName(s)[0]; sn.parentNode.insertBefore(gcw, sn);
		  })(document, window, 'script');
		</script>-->
      <div class="modal fade bd-example-modal-lg" id="advertModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <img src="/public/img/advert_<?=rand(1,3)?>.png" style="width: 100%">
            <span class="advertClose" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
             </span>
          </div>
        </div>
      </div>

      <script>
         $(function () {
            // if($.cookie("advert_1") == null){
            //    $("#advertModal").modal()
            //    $.cookie("advert_1", "true", { path: '/' })
            // }
         })
      </script>
      <script>
          $(function (){
              $(window).on("resize", function () {
                  $(".top_navbar_container").height($(".top_navbar").height()+15)
              }).trigger("resize")
          })
      </script>
   </body>
</html>
