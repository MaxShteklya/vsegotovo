<div class="container mt-5 pt-3 mb-5">
   <div class="box">
      <h1>Спасибо за заказ!</h1>
      <p>
		Наши операторы свяжутся с Вами для уточнения заказа.
	  </p>
   </div>
</div>
<script>
$(function(){
	fbq('track', 'Lead', {
		value: <?=$_SESSION['payment']['price']?>,
		currency: 'UAH',
	});
})
</script>
