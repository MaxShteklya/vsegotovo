<div class="container mt-5 pt-3 mb-5">
   <form action="/checkout" method="POST">
      <div class="box">
         <h1>Оформление заказа</h1>
         <h2>Корзина</h2>
         <div class="row cart_list"></div>

         <div id="order_details" class="row order_details">
            <div class="col-sm-6 checkout_details mb-3">
               <div class="form-group">
                  <input name="name" type="text" class="form-control" placeholder="Имя">
                  <span class="required">*</span>
               </div>
               <div class="form-group">
                  <input name="phone" type="tel" class="form-control" placeholder="Номер">
                  <span class="required">*</span>
               </div>
               <div class="form-group">
                  <select name="district" class="form-control">
                     <option disabled selected>Выберите район</option>
                     <option value="0" data-price="50" data-min="400">Центр</option>
                     <option value="1" data-price="50" data-min="200">Таирово</option>
                     <option value="2" data-price="50" data-min="300">Совиньон</option>
                     <option value="3" data-price="50" data-min="300">Черемушки</option>
                     <option value="4" data-price="50" data-min="300">Фонтан (Аркадия)</option>
                  </select>
                  <span class="min_delivery_error"></span>
                  <span class="required">*</span>
               </div>
               <div class="form-row form-group">
                  <div class="col-6">
                     <input name="street" type="text" class="form-control" placeholder="Улица">
                     <span class="required required-sm">*</span>
                  </div>
                  <div class="col">
                     <input name="house" type="text" class="form-control" placeholder="Дом">
                     <span class="required required-sm">*</span>
                  </div>
                  <div class="col">
                     <input name="corpus" type="text" class="form-control" placeholder="Корпус">
                  </div>
               </div>
               <div class="form-row form-group">
                  <div class="col">
                     <input name="entrance" type="text" class="form-control" placeholder="Подъезд">
                  </div>
                  <div class="col">
                     <input name="floor" type="text" class="form-control" placeholder="Этаж">
                  </div>
                  <div class="col">
                     <input name="flat" type="text" class="form-control" placeholder="Квартира">
                  </div>
               </div>
               <div class="form-group">
                  <textarea name="comment" rows="5" class="form-control" placeholder="Коментарий к заказу"></textarea>
                  <small class="form-text text-muted">Поля, отмеченные звёздочкой обязательны к заполнению.</small>
               </div>
               <!--<div class="form-group">
                   <input name="promo" type="text" class="form-control" placeholder="Промокод">
               </div>-->
            </div>
            <div class="col-sm-6">
               <div class="checout_prices mb-3">
                  <table class="table prices">
                     <tr>
                        <th>Доставка: </th>
                        <td><span id="delivery_sum">Бесплатно</span></td>
                     </tr>
                     <tr>
                        <th>Заказ на сумму: </th>
                        <td><span id="order_sum">0</span> грн</td>
                     </tr>
                     <tr>
                        <th>К оплате: </th>
                        <td>
							      <p class="sale">
								      <span id="total_sum">0</span> грн
							      </p>
   						   	<p>
   							   	<span id="saled">0</span> грн
   						   	</p>
                           <!-- <p>
   							   	<span id="total_sum">0</span> грн
   						   	</p> -->
						      </td>
                     </tr>
                  </table>
                  <!--<p class="text-right">* С 11:00 до 16:00 действует скидка -20%</p>-->
                   <p class="text-right">*на все заказы действует акция -31%</p>
               </div>

               <div class="checout_paymethod mb-3">
                  <table class="table">
                     <tr>
                        <th>
                           <div class="form-check">
                              <input class="form-check-input" type="radio" name="delivery_method" id="payNow" value="1" checked>
                              <label class="form-check-label" for="payNow">
                                 Оплата курьеру наличными
                              </label>
                           </div>
                           <div class="form-check">
                              <input class="form-check-input" type="radio" name="delivery_method" id="payLater" value="2">
                              <label class="form-check-label" for="payLater">
                                 Оплата картой
                              </label>
                           </div>
                           <div class="form-check">
                              <input class="form-check-input" type="radio" name="delivery_method" id="payLaterCard" value="3">
                              <label class="form-check-label" for="payLaterCard">
                                 Оплата курьеру картой
                              </label>
                           </div>
                        </th>
                     </tr>
                  </table>
               </div>
               <input type="submit" class="btn-orange send_order" value="Отправить заказ">
            </div>
         </div>
      </div>
   </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.9/jquery.inputmask.bundle.min.js" integrity="sha512-VpQwrlvKqJHKtIvpL8Zv6819FkTJyE1DoVNH0L2RLn8hUPjRjkS/bCYurZs0DX9Ybwu9oHRHdBZR9fESaq8Z8A==" crossorigin="anonymous"></script>
<script>
    $(function () {
        $(".modal").remove()
        $('form').submit(function (e) {
            var errors = 0;

            if($('input[name=name]').val().length < 2){
                wrongField($('input[name=name]'))
                errors++
            }

            if($('input[name=phone]').val().length < 6){
                wrongField($('input[name=phone]'))
                errors++
            }

            if($('select[name=district]').find("option:selected").attr("disabled") == "disabled"){
                wrongField($('select[name=district]'))
                errors++
            }

            if($('input[name=street]').val().length < 3){
                wrongField($('input[name=street]'))
                errors++
            }

            if($('input[name=house]').val().length < 1){
                wrongField($('input[name=house]'))
                errors++
            }

            if(errors > 0 || !send_order) e.preventDefault()
            else $(".send_order").attr("value", "Отправка...").css("opacity", "0.4")
        })

        setTimeout(function(){
            var total = $(".total_sum").text();

            fbq('track', 'InitiateCheckout', {
                value: total,
                currency: 'UAH',
            });
        }, 1000)
    })
    $(".cart").hide();

    var count_triggers = 0;
    var send_order = false;
    $("select[name=district]").change(function () {
        var order_sum = 0;
        //var del_price = $(this).find("option:selected").attr("data-price")
        var del_min = $(this).find("option:selected").attr("data-min")

        $(".product_line").each(function () {
            //var count = $(this).find(".quantity-num").val();
            var price = parseFloat($(this).find(".price").html().split("<br>")[0]);
            order_sum += price
        })
        if(order_sum*0.69 > del_min) {
            send_order = true;
            $(".min_delivery_error").html("");
        }
        else{
            send_order = false;
            if(typeof del_min !== "undefined") $(".min_delivery_error").html("Минимальная сума заказа для этого района <b>"+del_min+" грн</b>");
        }
        updateSum()
    })

    if($.cookie('cart') != null && $.cookie('cart') != "undefined" && $.cookie('cart').length > 0){
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

                $(".cart_list").html(" ");
                for (var i = 0; i < response.length; i++) {
                    html += `
               <div class="product_line row pt-3 p-0 m-0">
                  <div class="col-6 col-sm-3 modal_img">
                     <a href="/menu/`+response[i]['id']+`" target="_blank"><img src="/`+response[i]['image']+`" alt=""></a>
                  </div>
                  <div class="col-6 col-sm-3 col-lg-4 modal_title">
                     <p><a href="/menu/`+response[i]['id']+`" target="_blank">`+response[i]['title']+`</a></p>
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


                $(".cart_list").html(html);
                updateSum()
                $("#order_details").removeClass("order_details")
                $(".cart_list .quantity-arrow-plus").click(function (event) {
                    event.preventDefault()
                    plusBtn($(this))
                })

                $(".cart_list .quantity-arrow-minus").click(function () {
                    event.preventDefault()
                    minusBtn($(this))
                })

                $('.modal_remove').click(function () {
                    var id = $(this).attr('data-id');
                    cart = $.cookie('cart');
                    cart_arr = cart.split(";");

                    for (var i = 0; i < cart_arr.length; i++) {
                        var curr_id = cart_arr[i].split(":")[0];
                        if(curr_id == id) {
                            var index = cart_arr.indexOf(cart_arr[i]);
                            if (index !== -1) {
                                var clearedCart = cart.replace(cart_arr[index]+";", '')
                                $.cookie("cart", clearedCart, { path: '/' })
                                $(this).parent().fadeOut().remove()
                                if($.cookie('cart').length < 1) {
                                    $("#order_details").addClass("order_details")
                                    $(".cart_list").html("<p class='error'>Корзина пуста</p>")
                                }
                                updateSum()
                                break
                            }
                        }
                    }
                })
            }
        });
    }else{
        $(".cart_list").html("<p class='error'>Корзина пуста</p>");
        $("#order_details").addClass("order_details")
    }
    function wrongField($this) {
        $this.addClass("wrong_field").css({ backgroundColor: '#ffa1a1' });
        setTimeout(function () {
            $this.css({ backgroundColor: '#fff' });
        }, 500)

    }
    function minusBtn($this) {
        var val = $this.siblings(".quantity-num").val();
        var price = $this.siblings("input[name='price']").val();
        var id = $this.siblings("input[name='id']").val();

        if (val > 1) {
            $this.siblings(".quantity-num").val(--val);
            updateSum()
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

        $this.siblings(".quantity-num").val(++val);
        $this.parent().parent().parent().find(".price").html(val*price+"<br>грн")
        updateSum()

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
    function updateSum() {
        setTimeout(function () {
            var order_sum = 0;
            $(".product_line").each(function () {
                var price = parseFloat($(this).find(".price").html().split("<br>")[0]);
                order_sum += price
            })
            $("#order_sum").text(order_sum)

            var total_sum = order_sum
            $("#total_sum").text(total_sum)
            $("#saled").text((total_sum*0.69).toFixed(2))

            $("select[name=district]").trigger("change")
        }, 100)
    }
</script>
