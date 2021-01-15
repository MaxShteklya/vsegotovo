<div class="container row centered">
   <div class="col-md-12 row order_result">
      <?php if($res == 1): ?>
         <h2><?=$getLang['PAYMENT_SUCCESS']?></h2>
         <p><?=$getLang['PAYMENT_SUCCESS_TEXT']?></p>
         <p><a href='/tour/<?php echo $_SESSION['payment']['tour_id'];?>'><?=$getLang['GO_BACK']?></a></p>

      <?php elseif($res == 2): ?>
         <h2><?=$getLang['PAYMENT_ERROR']?></h2>
         <p><?=$getLang['PAYMENT_NOT_FULL_AMMOUNT_TEXT']?></p>
         <p><a href='/tour/<?php echo $_SESSION['payment']['tour_id'];?>'><?=$getLang['GO_BACK']?></a></p>
      <?php else: ?>
         <h2><?=$getLang['PAYMENT_ERROR']?></h2>
         <p><?=$getLang['PAYMENT_ERROR_TEXT']?></p>
         <p><a href='/tour/<?php echo $_SESSION['payment']['tour_id'];?>'><?=$getLang['GO_BACK']?></a></p>
      <?php endif; ?>
   </div>
</div>
