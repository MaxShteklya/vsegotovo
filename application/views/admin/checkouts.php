<h1>Замовлення</h1>
<?php if(empty($invalidCheckouts) && empty($successCheckouts) && empty($canceledCheckouts)):?>
   <p>Замовлень поки що немає.</p>
<?php endif; ?>
<?php if(!empty($invalidCheckouts)):?>
<h3 class="warning">Недоплачене замовлення:</h3>
<p><b>!Важливо!</b><br>Якщо у Вас появилися недоплачені замовлення, то це означає, що клієнт оплатив не всю суму і потрібно глянути в системі скільки він заплатив, зв'язатися з ним та щоб він доплатив на карту, або любим іншим зручним способом.</p>
<div class="table-responsive">
   <table class="table table-striped">
      <thead>
         <tr>
            <th></th>
            <th>Продукт</th>
            <th>Ім'я</th>
            <th>Телефон</th>
            <th>Контакти</th>
            <th>Ціна</th>
            <th>К-сть</th>
            <th>Загалом</th>
            <th>Дата</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach ($invalidCheckouts as $checkout): ?>
            <tr>
               <td class="delete">
                  <a href="/admin/delcheckout/<?=$checkout['id']?>">
                     <i class="fa fa-times" aria-hidden="true"></i>
                  </a>
               </td>
               <td><a href="/tour/<?=$checkout['tour_id']?>" target="_blank"><?=$checkout['product']?></a></td>
               <td><?=$checkout['name']?></td>
               <td><?=$checkout['phone']?></td>
               <td><?=$checkout['email']?></td>
               <td>&euro;<?=$checkout['price']?></td>
               <td><?=$checkout['ammount']?></td>
               <td>&euro;<?=$checkout['ammount']*$checkout['price']?></td>
               <td><?=$checkout['date_at']?></td>
            </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</div>
<?php endif; ?>
<?php if(!empty($successCheckouts)):?>
<h3 class="success">Успішні замовлення:</h3>
<div class="table-responsive">
   <table class="table table-striped">
      <thead>
         <tr>
            <th></th>
            <th>Продукт</th>
            <th>Ім'я</th>
            <th>Телефон</th>
            <th>Контакти</th>
            <th>Ціна</th>
            <th>К-сть</th>
            <th>Загалом</th>
            <th>Дата</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach ($successCheckouts as $checkout): ?>
            <tr>
               <td class="delete">
                  <a href="/admin/delcheckout/<?=$checkout['id']?>">
                     <i class="fa fa-times" aria-hidden="true"></i>
                  </a>
               </td>
               <td><a href="/tour/<?=$checkout['tour_id']?>" target="_blank"><?=$checkout['product']?></a></td>
               <td><?=$checkout['name']?></td>
               <td><?=$checkout['phone']?></td>
               <td><?=$checkout['email']?></td>
               <td>&euro;<?=$checkout['price']?></td>
               <td><?=$checkout['ammount']?></td>
               <td>&euro;<?=$checkout['ammount']*$checkout['price']?></td>
               <td><?=$checkout['date_at']?></td>
            </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</div>
<?php endif; ?>

<?php if(!empty($canceledCheckouts)):?>
<h3 class="error">Скасовані замовлення:</h3>
<div class="table-responsive">
   <table class="table table-striped">
      <thead>
         <tr>
            <th></th>
            <th>Продукт</th>
            <th>Ім'я</th>
            <th>Телефон</th>
            <th>Контакти</th>
            <th>Ціна</th>
            <th>К-сть</th>
            <th>Загалом</th>
            <th>Дата</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach ($canceledCheckouts as $checkout): ?>
            <tr>
               <td class="delete">
                  <a href="/admin/delcheckout/<?=$checkout['id']?>">
                     <i class="fa fa-times" aria-hidden="true"></i>
                  </a>
               </td>
               <td><a href="/tour/<?=$checkout['tour_id']?>" target="_blank"><?=$checkout['product']?></a></td>
               <td><?=$checkout['name']?></td>
               <td><?=$checkout['phone']?></td>
               <td><?=$checkout['email']?></td>
               <td>&euro;<?=$checkout['price']?></td>
               <td><?=$checkout['ammount']?></td>
               <td>&euro;<?=$checkout['ammount']*$checkout['price']?></td>
               <td><?=$checkout['date_at']?></td>
            </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</div>
<?php endif; ?>

<script>
   $(function () {
      $(".delete a").click(function (event) {
         event.preventDefault();
         var confirmAct = confirm("Ви впевнені, що хочете видалити це замовлення?")
         if(confirmAct){
            window.location.href = $(this).attr('href')
         }
      })
   })
</script>
