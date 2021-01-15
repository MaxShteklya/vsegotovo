$(function() {
   var cart;

   // PAGE
   pageLoad();

   // CART

   reloadCart();
   //showAlert("Warning!", "red")


   function pageLoad() {
      if(isNotCartEmpty()){
         $(".cart .count").text($.cookie("cart").split(";").length-1)
      }
	  
	  if( !Number.isInteger(parseInt(location.href.split("/").pop())) ){
         // Задержка для ajax'a
         setTimeout(function () {
            if( $(".product").length ){
               $(".product .quantity-arrow-plus").click(function () {
                  var val = $(this).siblings("input").val();
                  $(this).siblings("input").val(++val);
               })

               $(".product .quantity-arrow-minus").click(function () {
                  var val = $(this).siblings("input").val();
                  if (val > 1) {
                     $(this).siblings("input").val(--val);
                  }
               })

               $(".product .order_now").click(function (event) {
                  event.preventDefault();
                  var id = $(this).attr("data-id");
                  var count = $(this).parent().find(".quantity-num").val()
                  if(isNotCartEmpty()){
                     cart = $.cookie('cart');
                     cart_arr = cart.split(";");
                     for (var i = 0; i < cart_arr.length; i++) {
                        var curr_id = cart_arr[i].split(":")[0];
                        if(curr_id == id) {
                           var index = cart_arr.indexOf(cart_arr[i]);
                           if (index !== -1) {
                               sum = parseFloat(cart_arr[i].split(":")[1]) + parseFloat(count)
                               cart_arr[index] = curr_id+":"+sum;
                               $.cookie("cart", cart_arr.join(";"), { path: '/' })
                              break
                           }
                        }else{
                           $.cookie("cart", cart+id+":"+count+";", { path: '/' })
                        }
                     }
                  }else{
                     $.cookie("cart", id+":"+count+";", { path: '/' })
                  }
                  $(".cart .count").text($.cookie("cart").split(";").length-1)
                  reloadCart()
                  showAlert("Товар добавлен в корзину", "green")
               })
            }else{
               pageLoad()
            }
         }, 500)
	  }
	  
	  $(".order .quantity-arrow-plus").click(function () {
		   var val = $(this).siblings("input").val();
		   $(this).siblings("input").val(++val);
		})

		$(".order .quantity-arrow-minus").click(function () {
		   var val = $(this).siblings("input").val();
		   if (val > 1) {
			  $(this).siblings("input").val(--val);
		   }
		})
      $(".order .order_now").click(function (event) {
         event.preventDefault();
          var id = $(this).attr("data-id");
		  var price = $(this).attr("data-price");
		  var category = $(this).attr("data-category");
		  var count = $(this).parent().find(".quantity-num").val()
         if($.cookie('cart') != null && $.cookie('cart') != "undefined"){
            cart = $.cookie('cart');
            cart_arr = cart.split(";");
            for (var i = 0; i < cart_arr.length; i++) {
               var curr_id = cart_arr[i].split(":")[0];
               if(curr_id == id) {
                  var index = cart_arr.indexOf(cart_arr[i]);
                  if (index !== -1) {
                      sum = parseFloat(cart_arr[i].split(":")[1]) + parseFloat(count)
                      cart_arr[index] = curr_id+":"+sum;
                      $.cookie("cart", cart_arr.join(";"), { path: '/' })
                     break
                  }
               }else{
                  $.cookie("cart", cart+id+":"+count+";", { path: '/' })
               }
            }
         }else{
            $.cookie("cart", id+":"+count+";", { path: '/' })
         }
         $(".cart .count").text($.cookie("cart").split(";").length-1)
         reloadCart()
         showAlert("Товар добавлен в корзину", "green")
		 
		  fbq('track', 'AddToCart', {
			value: price,
			currency: 'UAH',
			content_ids: id,
			content_type: category, 
		  });
      })
   }
   function reloadCart() {
      if(isNotCartEmpty()){
         var ajax = $.ajax({
            url: '/getCart',
            type: "POST",
            data: "str="+$.cookie('cart'),
            success: function(response){
               var response = JSON.parse(response)
               var html = '';
               var cart = $.cookie("cart").split(";")
               var id_ammount = {};

               for (var i = 0; i < cart.length-1; i++) {
                  var splitted = cart[i].split(":");
                  var id = splitted[0];
                  var ammount = splitted[1];

                  id_ammount[id] = ammount
               }
               total = 0;
               $(".modal-body").html(" ");
               for (var i = 0; i < response.length; i++) {
                  total += response[i]['price']*id_ammount[response[i]['id']];
                  html += `
                     <div class="product_line row pt-3 p-0 m-0">
                        <div class="col-6 col-sm-3 modal_img">
                           <a href="/menu/`+response[i]['id']+`" target="_blank"><img src="/`+response[i]['image']+`" alt=""></a>
                        </div>
                        <div class="col-6 col-sm-3 col-lg-4 modal_title">
                           <p><a href="/menu/`+response[i]['id']+`">`+response[i]['title']+`</a></p>
                        </div>
                        <div class="col-7 col-sm-4 col-lg-3 modal_count">
                           <div class="quantity-block">
                              <button class="quantity-arrow-minus"> - </button>
                              <input class="quantity-num" type="number" value="`+id_ammount[response[i]['id']]+`" disabled />
                              <button class="quantity-arrow-plus"> + </button>
                              <input type="hidden" name="id" value="`+response[i]['id']+`">
                              <input type="hidden" name="price" value="`+response[i]['price']+`">
                           </div>
                        </div>
                        <div class="col-3 col-sm-1 modal_total">
                           <p class="price">`+response[i]['price']*id_ammount[response[i]['id']]+`<br>грн</p>

                        </div>
                        <div class="col-2 col-sm-1 modal_remove" data-id="`+response[i]['id']+`">
                           <span>&times;</span>
                        </div>
                     </div>
                  `
               }

               $(".total_bl").show();
               $("#total").text(total);
               $(".modal-body").html(html);
               $(".modal .quantity-arrow-plus").click(function () {
                  plusBtn($(this))
               })

               $(".modal .quantity-arrow-minus").click(function () {
                  minusBtn($(this))
               })

               $('.modal_remove').click(function () {
                  var id = $(this).attr('data-id');
                  cart = $.cookie('cart');
                  cart_arr = cart.split(";");

                  var pr_total = $(this).parent().find(".price").html().split("<br>")[0];
                  var total = parseInt($("#total").text())
                  $("#total").text(total-pr_total)

                  for (var i = 0; i < cart_arr.length; i++) {
                     var curr_id = cart_arr[i].split(":")[0];
                     if(curr_id == id) {
                        var index = cart_arr.indexOf(cart_arr[i]);
                        if (index !== -1) {
                           var clearedCart = cart.replace(cart_arr[index]+";", '')
                           $.cookie("cart", clearedCart, { path: '/' })
                           $(this).parent().fadeOut()
                           if($.cookie('cart').length < 1) $(".modal-body").html("<p align='center'>Корзина пуста</p>")
                           $(".top_navbar .count").html($(".top_navbar .count").html()-1)
                           break
                        }
                     }
                  }
               })
            }
         });
      }else{
         $(".modal-body").html("<p align='center'>Корзина пуста</p>");
      }
   }
   function cartLog() {
      console.log($.cookie('cart'));
   }
   function isNotCartEmpty() {
      if($.cookie('cart') != null && $.cookie('cart') != "undefined" && $.cookie('cart').length > 0) return true;
      else return false;
   }
   function minusBtn($this) {
      var val = $this.siblings(".quantity-num").val();
      var price = $this.siblings("input[name='price']").val();
      var id = $this.siblings("input[name='id']").val();

      if (val > 1) {
         $this.siblings(".quantity-num").val(--val);
         var total = $("#total").text();
         total -= price
         $("#total").text(total)
      }

      $this.parent().parent().parent().find(".price").html(val*price+"<br>грн")

      cart = $.cookie('cart');
      cart_arr = cart.split(";");

      for (var i = 0; i < cart_arr.length; i++) {
         var curr_id = cart_arr[i].split(":")[0];
         if(curr_id == id) {
            var index = cart_arr.indexOf(cart_arr[i]);
            if (index !== -1) {
                cart_arr[index] = curr_id+":"+val;
                $.cookie("cart", cart_arr.join(";"), { path: '/' })
               break
            }
         }else{
            $.cookie("cart", cart+id+":"+val+";", { path: '/' })
         }
      }
   }
   function plusBtn($this) {
      var val = $this.siblings(".quantity-num").val();
      var price = $this.siblings("input[name='price']").val();
      var id = $this.siblings("input[name='id']").val();

      var total = parseFloat($("#total").text());
      total += parseFloat(price)
      $("#total").text(total)

      $this.siblings(".quantity-num").val(++val);
      $this.parent().parent().parent().find(".price").html(val*price+"<br>грн")

      cart = $.cookie('cart');
      cart_arr = cart.split(";");

      for (var i = 0; i < cart_arr.length; i++) {
         var curr_id = cart_arr[i].split(":")[0];
         if(curr_id == id) {
            var index = cart_arr.indexOf(cart_arr[i]);
            if (index !== -1) {
                cart_arr[index] = curr_id+":"+val;
                $.cookie("cart", cart_arr.join(";"), { path: '/' })
               break
            }
         }else{
            $.cookie("cart", cart+id+":"+val+";", { path: '/' })
         }
      }
   }

   function showAlert(text, color) {
      colors = {
         'green': 'success',
         "red": "danger",
         "yellow": "warning"
      }
      $("main").append('<div class="alert alert-'+colors[color]+'" role="alert">'+text+'</div>');

      $(".alert").animate({
         opacity: 1,
         top: 80
      }, 500)
      setTimeout(function () {
         $(".alert").animate({
            opacity: 0,
            top: 0
         }, 500, function () {
            $(this).hide()
         })
      }, 5000)

   }
});
