<?php

namespace application\controllers;

use application\core\Controller;
use application\core\View;
use application\lib\Db;

class AdminController extends Controller{

   //----------LOGIN----------

   public function indexAction() { header("Location: /admin/addproduct"); }

   public function loginAction() {
      $this->view->layout = 'adminlogin';
      $vars = ['errors' => ''];
      if($_POST){
         if($this->model->loginValidate($_POST)){
            header('Location: ./addproduct');
         }else{
            $vars = ['errors' => 'Wrong Login or password'];
         }
      }

      $this->view->render('Admin Login', $vars);
   }

   public function logoutAction() {
      $this->model->logOut();
   }

   //----------Products----------

   public function addproductAction() {
      $this->view->layout = 'admin';

      $added = false;
      $complete = false;
      $errors = [];
	  $add_product['id'] = '';
      if($_POST){
         $added = true;
         $add_product = $this->model->addProduct();
         if($add_product['complete']){
            $complete = true;
         }else{
            foreach($add_product['errors'] as $error){
               array_push($errors, $error);
            }
          }
      }
      $result = ['added' => $added, 'complete' => $complete, 'errors' => $errors, 'id' => $add_product['id']];
      $this->view->render('Добавить товар', $result);
   }

   public function editproductAction() {
      $this->view->layout = 'admin';

      $category = $this->route['category'];

      $result = [
         'products' => $this->model->getProducts($category)
      ];

      $this->view->render('Edit tour', $result);
   }

   public function editAction() {
      $this->view->layout = 'admin';

      $id = $this->route['id'];

      if($_POST){
         $this->model->editProduct($_POST, $id);
         if(!isset($errors)){
            header("Location: /menu/$id");
         }else{
            echo "<div class='well'>";
            foreach($errors as $error){
               echo "<h3 class='error'>".$error."</h3>";
            }
            echo "</div>";
         }
      }

      $result = [
         'product' => $this->model->getProduct($id)
      ];

      $this->view->render('Редактировать товар', $result);
   }

   public function changeStatusAction() {
      $route = explode("_", $this->route['id']);
      $id = $route[0];
      $status = $route[1];

      $this->model->changeStatusTour($id, $status);
      header("Location: /admin/editproduct/all");
   }

   public function deleteAction() {
      $id = $this->route['id'];
      $this->model->delProduct($id);
	  header("Location: /admin/editproduct/all");
   }

   //----------CHECKOUTS----------

   public function addpromoAction() {
        $this->view->layout = 'admin';

        $added = false;
        $complete = false;
        $errors = [];
        $add_promo['id'] = '';
        if($_POST){
            $added = true;
            $add_promo = $this->model->addPromo();
            if($add_promo['complete']){
                $complete = true;
            }else{
                foreach($add_promo['errors'] as $error){
                    array_push($errors, $error);
                }
            }
        }
        $result = ['added' => $added, 'complete' => $complete, 'errors' => $errors, 'id' => $add_promo['id']];
        $this->view->render('Добавить акцию.', $result);
    }

    public function editpromoAction() {
        $this->view->layout = 'admin';

        $result = [
            'promos' => $this->model->getPromos()
        ];

        $this->view->render('Редактировать акции', $result);
    }

    public function editpromoOneAction() {
        $this->view->layout = 'admin';

        $id = $this->route['id'];

        if($_POST){
            $this->model->editPromo($_POST, $id);
            if(!isset($errors)){
                header("Location: /promo/$id");
            }else{
                echo "<div class='well'>";
                foreach($errors as $error){
                    echo "<h3 class='error'>".$error."</h3>";
                }
                echo "</div>";
            }
        }

        $result = [
            'promo' => $this->model->getPromo($id)
        ];

        $this->view->render('Редактировать акцию', $result);
    }

   public function changePromoStatusAction() {
        $route = explode("_", $this->route['id']);
        $id = $route[0];
        $status = $route[1];

        $this->model->changePromoStatus($id, $status);
        header("Location: /admin/editpromo/");
   }

    public function deletePromoAction() {
        $id = $this->route['id'];
        $this->model->delPromo($id);
        header("Location: /admin/editpromo");
    }

   //----------CHECKOUTS----------

   public function checkoutsAction() {
      $this->view->layout = 'admin';
      $invalidCheckouts = $this->model->loadCheckouts('error');
      $canceledCheckouts = $this->model->loadCheckouts('canceled');
      $successCheckouts = $this->model->loadCheckouts('success');
      $res = [
         'invalidCheckouts' => $invalidCheckouts,
         'canceledCheckouts' => $canceledCheckouts,
         'successCheckouts' => $successCheckouts
      ];
      $this->view->render('Checkouts', $res);
   }

   public function delCheckoutAction() {
      $id = $this->route['id'];
      $this->model->delCheckout($id);
      header("Location: /admin/checkouts");
   }

}
