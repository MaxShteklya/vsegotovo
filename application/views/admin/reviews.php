<h1>Відгуки</h1>
<div class="instructions">
   <div class="activate"><i class="fa fa-check" aria-hidden="true"></i> &#8212; затвердити відгук</div>
   <div class="disactivate"><i class="fa fa-minus" aria-hidden="true"></i> &#8212; вернути відгук на модерацію</div>
   <div class="delete"><i class="fa fa-times" aria-hidden="true"></i> &#8212; видалити відгук</div>
</div>

<h2>Відгуки на модерацію</h2>
<div class="table-responsive">
   <table class="table table-striped">
      <thead>
         <tr>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col">Ім'я</th>
            <th scope="col">Відгук</th>
            <th scope="col">Email</th>
            <th scope="col">Дата</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach($notCheckedReviews as $review) :?>
            <tr>
               <td class="activate">
                  <a href="/admin/activatereview/<?=$review['id']?>">
                     <i class="fa fa-check" aria-hidden="true"></i>
                  </a>
               </td>
               <td class="delete">
                  <a href="/admin/delreview/<?=$review['id']?>">
                     <i class="fa fa-times" aria-hidden="true"></i>
                  </a>
               </td>
               <td><?=$review['name']?></td>
               <td><?=htmlspecialchars($review['content'])?></td>
               <td><?=$review['email']?></td>
               <td><?=$review['date']?></td>
            </tr>
         <?php endforeach;?>
      </tbody>
   </table>
</div>

<h2>Перевірені відгуки</h2>
<div class="table-responsive">
   <table class="table table-striped">
      <thead>
         <tr>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col">Ім'я</th>
            <th scope="col">Відгук</th>
            <th scope="col">Email</th>
            <th scope="col">Дата</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach($checkedReviews as $review) :?>
            <tr>
               <td class="disactivate">
                  <a href="/admin/disactivatereview/<?=$review['id']?>">
                     <i class="fa fa-minus" aria-hidden="true"></i>
                  </a>
               </td>
               <td class="delete">
                  <a href="/admin/delreview/<?=$review['id']?>">
                     <i class="fa fa-times" aria-hidden="true"></i>
                  </a>
               </td>
               <td><?=$review['name']?></td>
               <td><?=htmlspecialchars($review['content'])?></td>
               <td><?=$review['email']?></td>
               <td><?=$review['date']?></td>
            </tr>
         <?php endforeach;?>
      </tbody>
   </table>
</div>

<script>
   $(function () {
      $(".delete a").click(function (event) {
         event.preventDefault();
         var confirmAct = confirm("Ви впевнені, що хочете видалити цей відгук?")
         if(confirmAct){
            window.location.href = $(this).attr('href')
         }
      })
   })
</script>
