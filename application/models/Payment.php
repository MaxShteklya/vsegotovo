<?php

namespace application\models;

use application\core\Model;
use \RedBeanPHP\R as R;
use application\lib\LiqPay;

class Payment extends Model{

   private $data;

   public function pay($post) {
      $data = [
         'name' => '',
         'phone' => '',
         'street' => '',
         'house' => '',
         'corpus' => '',
         'entrance' => '',
         'floor' => '',
         'flat' => '',
         'comment' => '',
         'cart' => ''
      ];

      $data = $this->load($data, $post);
      $order_id = $this->savePayment('orders', $data);
      $this->setPaymentData($order_id, $data);

      if($post['delivery_method'] == 1 || $post['delivery_method'] == 3){
         $this->setPaymentData($order_id, $data);
         $this->createPosterOrder($data);
         $this->sendOrderEmail($data);

         header("Location: /payment/result");
      }
      if($post['delivery_method'] == 2) header("Location: /payment/form");
   }


   public function setPaymentData($order_id, $data) {
      if(isset($_SESSION['payment'])) unset($_SESSION['payment']);

      $_SESSION['payment']['id'] = $order_id;;
      $_SESSION['payment']['price'] = $data['total'];
   }

    public function load($data, $post) {
      foreach ($post as $key => $v) {
         if(array_key_exists($key, $data)){
            $data[$key] = $v;
         }
      }
      $district = [
         '0' => ['Центр', '0', '400'],
         '1' => ['Таирово', '0', '200'],
         '2' => ['Совиньен', '0', '300'],
         '3' => ['Черемушки', '0', '300'],
         '4' => ['Фонтан (Аркадия)', '0', '300']
      ];
      $data['district'] = $district[$post['district']][0];

      $prices = $this->getProductPrices($post['cart']);

      $total = 0;
      foreach ($prices as $value) {
         $total += $value['price']*$value['count'];
      }

      if($total <= $district[$post['district']][2]) $total += $district[$post['district']][1];
      $data['total'] = $total;

        $data['saled'] = 'false';
//        $promo = mb_strtolower($post['promo']);
//        if( $promo == "домашний" ||
//            $promo == 'все готово' ||
//            $promo == 'всё готово' ||
//            $promo == 'амнезия' ||
//            $promo == 'белка' ||
//            $promo == 'anuta' ||
//            $promo == 'фортуна'){
//            $data['saled'] = 'true';
//        }


      $pay_method = "";
      $hour = date("H");
      $week = date("w");

      /*if(($hour >= 11 && $hour <= 15 && $week != 6 && $week != 0) || $data['saled'] == 'true'){
         $data['total'] -= $total*0.2;
         $pay_method .= "Заказано со скидкой -20%. ";
      }*/

        $data['total'] -= $total*0.31;

      $poster_ids = $this->getPosterIDs($post['cart']);
      $data['poster_ids'] = $poster_ids;
      if($post['delivery_method'] == 1) $pay_method .= "Оплата наличными. ";
      if($post['delivery_method'] == 2) $pay_method .= "Оплачено картой. ";
      if($post['delivery_method'] == 3) $pay_method .= "Оплата курьеру картой. ";

      $sale = "Заказ со скидкой -31%. Клиент должен оплатить: ". $data['total'].". " ;

      $data['comment'] = $pay_method.$sale.$data['comment'];

      return $data;
   }

   public function updateOrdersCount($str) {
      $exploded = explode(";", $str);

	  $ids = [];
      for ($i=0; $i < count($exploded)-1; $i++) {
         $val = explode(":", $exploded[$i]);
		 $update = R::load('menu', $val[0]);
	     $update->orders++;
	     R::store($update);
      }
   }

   public function getProductPrices($str) {
      $exploded = explode(";", $str);
      $cart = [];

      for ($i=0; $i < count($exploded)-1; $i++) {
         $val = explode(":", $exploded[$i]);
         $cart[$val[0]] = $val[1];
      }

      $id_arr = [];
      for ($i=0; $i < count($exploded)-1; $i++) {
         array_push($id_arr, explode(":", $exploded[$i])[0]);
      }
      $id_str = implode(',', $id_arr);
      $result = R::getAll("SELECT id, price FROM menu WHERE status=? AND id IN ($id_str)", array(1));

      foreach ($cart as $key => $value) {
         foreach ($result as $k => $res) {
            if($res['id'] == $key) $result[$k]['count'] = $value;
         }
      }
      $data = [];
      foreach ($result as $value) {
         $data[$value['id']] = [
            'price' => $value['price'],
            'count' => $value['count']
         ];
      }

      return $data;
   }

   public function getPosterIDs($str) {
      $exploded = explode(";", $str);
      $cart = [];

      for ($i=0; $i < count($exploded)-1; $i++) {
         $val = explode(":", $exploded[$i]);
         $cart[$val[0]] = $val[1];
      }

      $id_arr = [];
      for ($i=0; $i < count($exploded)-1; $i++) {
         array_push($id_arr, explode(":", $exploded[$i])[0]);
      }
      $id_str = implode(',', $id_arr);
      $result = R::getAll("SELECT id, poster_id FROM menu WHERE status=? AND id IN ($id_str)", array(1));

	  $ids = '';

      for ($i=0; $i < count($exploded)-1; $i++) {
         $val = explode(":", $exploded[$i]);
         foreach($result as $res){
			 if($val[0] == $res['id']) $ids .= $res['poster_id'].';';
		 }
      }
      return $ids;
   }



   public function savePayment($table, $data) {
      $tbl = R::dispense($table);
      foreach ($data as $key => $val) {
         $tbl->$key = $val;
      }
      return R::store($tbl);
   }

   public function paymentProcess($post) {
      $result = json_decode( base64_decode($_POST['data']));
      $order_id = $result->order_id;
      
      if($result->status == 'success' || $result->status == 'wait_accept'){

         $order = R::load('orders', $order_id);
         $order->status = 1;
         R::store($order);

         //exit(debug($order));

         $data = [
            'name' => $order->name,
            'phone' => $order->phone,
            'district' => $order->district,
            'street' => $order->street,
            'house' => $order->house,
            'corpus' => $order->corpus,
            'entrance' => $order->entrance,
            'floor' => $order->floor,
            'flat' => $order->flat,
            'comment' => $order->comment,
            'cart' => $order->cart,
            'poster_ids' => $order->poster_ids,
            'paid' => true
         ];
         $this->createPosterOrder($data);
         $this->updateOrdersCount($order->cart);
         $this->sendOrderEmail($data);

      }else{
         $order = R::load('orders', $order_id);
         $order->status = 2;
         R::store($order);
      }

   }

   public function createPosterOrder($data){

	  $token = '746521:33962919fd179f20b82852bdd9b66245';
	  $url = 'https://joinposter.com/api/incomingOrders.createIncomingOrder'.'?token='.$token;

	  $cart = explode(";", substr($data['cart'], 0, -1));
	  $poster_ids = explode(";", substr($data['poster_ids'], 0, -1));
	  for($i = 0; $i < count($cart); $i++){
		  $pr_arr = explode(":", $cart[$i]);
		  $product_count = $pr_arr[1];
		  $products[$i] = [
			  'product_id' => $poster_ids[$i],
			  'count' => $product_count
		  ];
	  }

	  $address = 'Район: '.$data['district'].'. Улица: '.$data['street'].' '.$data['house'];
	  if(!empty($data['corpus'])) $address .= ', корпус: '.$data['corpus'];
	  if(!empty($data['entrance'])) $address .= ', подъезд: '.$data['entrance'];
	  if(!empty($data['floor'])) $address .= ', етаж: '.$data['floor'];
	  if(!empty($data['flat'])) $address .= ', квартира: '.$data['flat'];

	  $incoming_order = [
		  'spot_id'   	 => 1,
		  'service_mode'=> 3,
		  'first_name'  => $data['name'],
		  'phone'       => $data['phone'],
		  'address'	 	 => $address.'. ',
		  'products'  	 => $products,
		  'comment'		 => $data['comment']
	  ];
     if(isset($data['paid'])){
        if($data['paid']){
           $prices = $this->getProductPrices($data['cart']);
           $total = 0;
           foreach ($prices as $value) {
              $total += $value['price']*$value['count'];
           }

           $incoming_order['payment']['type'] = 1;
           $incoming_order['payment']['sum'] = $total*100;
           $incoming_order['payment']['currency'] = 'UAH';
        }
     }

	  $create = $this->sendPosterRequest($url, 'post', $incoming_order);
	  if(!empty(json_decode($create)->error)) exit("Ошибка! Проверьте правильность Ваших данных или повторите попытку позже. Error: ".debug(json_decode($create)));
     unset($_COOKIE['cart']);
     setcookie('cart', null, -1, '/');
   }

   public function sendPosterRequest($url, $type = 'get', $params = [], $json = false)	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

		if ($type == 'post' || $type == 'put') {
			curl_setopt($ch, CURLOPT_POST, true);

			if ($json) {
				$params = json_encode($params);

				curl_setopt($ch, CURLOPT_HTTPHEADER, [
					'Content-Type: application/json',
					'Content-Length: ' . strlen($params)
				]);

				curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
			} else {
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
			}
		}

		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Poster (http://joinposter.com)');

		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	}

	public function sendOrderEmail($data){
		$address = 'Район: '.$data['district'].'. Улица: '.$data['street'].' '.$data['house'];
		if(!empty($data['corpus'])) $address .= ', корпус: '.$data['corpus'];
		if(!empty($data['entrance'])) $address .= ', подъезд: '.$data['entrance'];
		if(!empty($data['floor'])) $address .= ', етаж: '.$data['floor'];
		if(!empty($data['flat'])) $address .= ', квартира: '.$data['flat'];

		$cookie_cart = explode(';', $data['cart']);

		for($i = 0; $i < count($cookie_cart) - 1; $i++){
			$arr = explode(":", $cookie_cart[$i]);
			$price_count[$arr[0]] = $arr[1];
		}

		$cart_data = $this->getCart($data['cart']);
		$total = 0;
		$cart_table = "<table>";
		$cart_table .= "<tr>
			<th>Название</th>
			<th>Цена</th>
			<th>Количество</th>
			<th>Всего</th>
		</tr>";

		foreach($cart_data as $product){
			foreach($price_count as $key => $count){
				if($product['id'] == $key) $product_count = $count;
			}
			$cart_table .= "<tr>
				<td>$product[title]</td>
				<td>$product[price]грн</td>
				<td>$product_count</td>
				<td>".$product['price']*$product_count."грн</td>
			</tr>";
			$total += $product['price']*$product_count;
		}
		$cart_table .= "</table>";

		$message = "Новый заказ!<br><br>
		Данные заказчика:<br>
		Имя: <b>$data[name]</b><br>
		Номер: <b>$data[phone]</b><br>
		Адресс: <b>$address</b><br>
		Коментарий: <b>$data[comment]</b><br><br>
		$cart_table<br>
		Всего: <b>$total грн</b>";
		$message = wordwrap($message, 70, "\r\n");
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: vsegotovo2020@gmail.com' . "\r\n" .
		'Reply-To: vsegotovo2020@gmail.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		mail('maks.shtieklia@gmail.com', 'Новый заказ', $message, $headers);
	}

	public function getCart($str) {
      $exploded = explode(";", $str);
      $id_arr = [];
      for ($i=0; $i < count($exploded)-1; $i++) {
         array_push($id_arr, explode(":", $exploded[$i])[0]);
      }
      $id_str = implode(',', $id_arr);
      $result = R::getAll("SELECT id, title, price, image FROM menu WHERE status=? AND id IN ($id_str)", array(1));

      return $result;
   }

   public function checkResult($id) {
      $order = R::load('orders', $id);
      return $order->status;
   }

}
