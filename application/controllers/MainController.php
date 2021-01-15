<?php

namespace application\controllers;

use application\core\Controller;
use application\core\View;
use application\lib\Db;

class MainController extends Controller{

   //$this->view->layout = 'other/dir'

   public function indexAction() {
      $mostPopular = $this->model->loadPopularDishes(4);
      $vars = [
         'mostPopular' => $mostPopular 
      ];
      $this->view->render('Всё готово! Доставка еды по Одессе', $vars);
   }


   public function menuAction() {
      if(empty($this->route['category']) || $this->route['category'] == null){
         exit(header("Location: /menu/pizza"));
      }
      $error = '';
      $category = $this->route['category'];
      $categories = require 'application/config/categories.php';

      for($i=0; $i < count($categories); $i++) {
         if($categories[$i] == $category){
            $category_route = true;
            break;
         }
         else $category_route = false;
      }

      if(!$category_route) View::errorCode(404);
      else $products = $this->model->getProducts($category);
      //exit(debug($this->route));
      if(empty($products)){
         $vars = [
            'category' => $category,
            'error' => "1",
            'products' => $products,

         ];
      }else{
         $vars = [
            'category' => $category,
            'products' => $products,
         ];
      }

      $this->view->render('Наше меню', $vars);
   }

   public function productAction() {
      $product_id = $this->route['id'];
      $res = $this->model->loadProduct($product_id);
      if($res === "404") View::errorCode(404);
      $vars = [
         'product' => $res,
      ];
      $this->view->render($res['title']." - Всё готово! Достава еды по Одессе", $vars);
   }


   public function promoAction() {
       $promos = $this->model->getAllPromos();
       //exit(debug($this->route));
       if(empty($promos)){
           $vars = [
               'error' => "1",
               'promos'=> ""
           ];
       }else{
           $vars = [
               'promos' => $promos,
           ];
       }

       $this->view->render('Акции', $vars);
   }

   public function promoOneAction() {
       $promo_id = $this->route['id'];
       $res = $this->model->loadPromo($promo_id);
       if($res === "404") View::errorCode(404);
       $vars = [
           'promo' => $res,
       ];
       $this->view->render($res['title'], $vars);
   }



   public function getCartAction() {
      if(!$_POST) View::errorCode(403);
      $result = $this->model->getCart($_POST['str']);
      exit(json_encode($result));
   }

   public function checkoutAction() {
      if(!empty($_POST)){
         $_POST['cart'] = $_COOKIE['cart'];
         $_SESSION['paymentPost'] = $_POST;
         header("Location: /payment/");
      }
      if(isset($_COOKIE['cart']) && !empty($_COOKIE['cart'])){
         $products = $this->model->getCart($_COOKIE['cart']);

         $cart = explode(";", $_COOKIE['cart']);
         for($i = 0; $i < count($cart)-1; $i++){

            $id = explode(":",$cart[$i])[0];
            $count = explode(":",$cart[$i])[1];
            $key = array_search($id, array_column($products, 'id'));
            $products[$key]['count'] = $count;
         }

         $vars = [
            'products_arr' => $products
         ];
      }else{
         $vars = [
            'error' => "Корзина пуста"
         ];
      }

      $this->view->render("Оформление заказа", $vars);
   }

   public function resultAction() {
      $this->view->render('Спасибо за заказ');
   }

   // public function reviewsAction() {
   //    if($_POST){
   //       $this->model->addReview($_POST['name'], $_POST['email'], $_POST['message']);
   //    }
   //    $reviews = $this->model->getReviews();
   //    $tours = $this->model->getTours("all");
   //    $vars = [
   //       'reviews' => $reviews,
   //       'tours' => $tours
   //    ];
   //
   //    $this->view->render('TITLE_REVIEW', $vars);
   // }

   public function deliveryAction() {
      $this->view->render('Доставка');
   }

   public function contactsAction() {
      $this->view->render('Контакты');
   }

   public function about_usAction() {
      $this->view->render('О нас');
   }

   public function public_ofertaAction() {
      $this->view->render('Публичный договор (оферта)');
   }


   // public function searchAction() {
   //    $query = $this->route['query'];
   //    $this->model->ajaxSearch($query);
   // }

}
