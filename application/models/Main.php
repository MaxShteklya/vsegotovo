<?php

namespace application\models;

use application\core\Model;
use \RedBeanPHP\R as R;

class Main extends Model{

   public function loadMenu() {
      $result = R::getAll('SELECT * FROM menu WHERE status=? ORDER BY id DESC', array(1));
      return $result;
   }

   public function getProducts($category) {
      if($category == 'all') $result = R::getAll('SELECT * FROM menu WHERE status=? ORDER BY id DESC', array(1));
      else $result = R::getAll('SELECT * FROM menu WHERE category=? AND status=? ORDER BY id DESC', array($category, 1));

      return $result;
   }

   public function loadProduct($id) {
      $result = R::findOne('menu', ' id = ? AND status = ?', array($id, 1));

      if($result){
         return $result;
      }
      else return "404";
   }

   public function getAllPromos() {
       $result = R::getAll('SELECT * FROM promo WHERE status=? ORDER BY id DESC', array(1));

       return $result;
   }

   public function loadPromo($id) {
      $result = R::findOne('promo', ' id = ? AND status = ?', array($id, 1));

      if($result){
         return $result;
      }
      else return "404";
   }

   public function loadPopularDishes($count) {
      $result = R::getAll('SELECT * FROM menu WHERE status=? ORDER BY orders DESC LIMIT 4', array(1));

      return $result;
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

   public function getOrderInfo($id) {
      $order = R::findOne('orders', ' id = ?', array($id));
      return $order;
   }

   public function loadAlbum($id) {
      $result = R::findOne('albums', ' id=?', array($id));
      return $result;
   }

   public function getReviews() {
      $result = R::getAll('SELECT * FROM reviews WHERE status=1 ORDER BY id desc');
      return $result;
   }

   public function addReview($name, $email, $message) {
      $addReview = R::dispense('reviews');
      $addReview->name = $name;
      $addReview->email = $email;
      $addReview->content = $message;
      $addReview->date = date("H:i d/m/y");
      $addReview = R::store($addReview);

      $adminEmails = implode(", ", $this->GetAdminEmails());
      $subject = "Новий відгук на сайті TourUkr.com";

      $msg = '
         <p>
            Новий відгук на сайті. Перевірте його та опублікуйте. <a href="'.$_SERVER['SERVER_NAME'].'/admin/reviews">Перейти</a>
         </p>
         <p>
            Ім`я: <b>'.$name.'</b><br>
            Email: <b>'.$email.'</b>
         </p>
         <p>
            Відгук: <br>
            <div style="background-color:#d9f2ff;padding:15px">'.$message.'</div>
         </p>';

      $this->SendEmail($adminEmails, $subject, $msg);

   }

   public function ajaxSearch($post) {
      if(!empty($post)){ //Принимаем данные
          $query = trim(strip_tags(stripcslashes(htmlspecialchars(urldecode($post)))));
          $lang = $this->getLang();

          $tours = R::getAll('SELECT * FROM '.$lang.' WHERE title LIKE ? AND active = ?',['%'.$query.'%', 1]);
          if($lang == "rustours"){
             $getLang['MORE'] = "Больше";
             if(count($tours) == 0){
               echo "<p class='nthNotFounded'>Ничего не найдено</p>";
            }
          }else{
             $getLang['MORE'] = "Read more";
             if(count($tours) == 0){
               echo "<p class='nthNotFounded'>Nothing not founded</p>";
            }
          }
          include "application/views/main/tour_ajax.php";
      }
   }

   public function sendPosterRequest($url, $type = 'get', $params = [], $json = false)
	{
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

}
