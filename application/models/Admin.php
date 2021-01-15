<?php

namespace application\models;

use application\core\Model;
use \RedBeanPHP\R as R;

class Admin extends Model{

   public function loginValidate($post) {

      $user = R::findOne('admin', 'login = ?', array($post['login']));
      if($user){
         if(password_verify($post['password'], $user->password)){
            if(isset($post["remember"])){
               $password_cookie_token = md5($user->id.$user->password.time());

               $save_me_find = R::findOne('admin', 'login = ?', array($post['login']));
               $save_me_load = R::load('admin', $save_me_find->id);
               $save_me_load->password_cookie_token = $password_cookie_token;
               R::store($save_me_load);

               setcookie("password_cookie_token", $password_cookie_token, time() + (1000 * 60 * 60 * 24 * 30), '/');
            }else{
               if(isset($_COOKIE["password_cookie_token"])){

                  $save_me_find = R::findOne('admin', 'login = ?', array($post['login']));
                  $save_me_load = R::load('admin', $save_me_find->id);
                  $save_me_load->password_cookie_token = '';
                  R::store($save_me_load);

                  setcookie("password_cookie_token", "", time() - 3600, '/');
               }
            }
            $_SESSION['admin']['id'] = $user->id;
            return true;
         }
         else return false;
      }
      else return false;
   }

   public function logOut() {
      if(isset($_COOKIE["password_cookie_token"])){
         $admin_id = $_SESSION['admin']['id'];

         setcookie("password_cookie_token", "", time()-3600, '/');

      }
      unset($_SESSION['admin']['id']);
      unset($_SESSION['admin']['password']);
      session_destroy();
      header('Location: ./login');
   }

   public function getProducts($category) {
      if($category == 'all') $result = R::getAll('SELECT * FROM menu ORDER BY id DESC');
      else $result = R::getAll('SELECT * FROM menu WHERE category=? ORDER BY id DESC', array($category));
      return $result;
   }
   public function getPromos() {
      $result = R::getAll('SELECT * FROM promo ORDER BY id DESC');
      return $result;
   }

   public function getProduct($id) {
      $result = R::findOne('menu', 'id=?', array($id));
      return $result;
   }
   public function getPromo($id) {
      $result = R::findOne('promo', 'id=?', array($id));
      return $result;
   }

   public function addProduct(){
      $errors = array();
      $complete = false;
      $product_id = "error_id";
      if($this->validateProduct()){

         $upload = $this->uploadPhoto("public/img/menu/");

         if($upload['complete']){
            $date = date("d-m-Y H:i:s");

            $add_product = R::dispense("menu");

            $add_product->title = $_POST['title'];
            $add_product->descr = $_POST['content'];
			$add_product->size = $_POST['size'];
            $add_product->category = $_POST['category'];
			$add_product->poster_id = $_POST['poster_id'];
            $add_product->price = $_POST['price'];
			$add_product->image = $upload['image'];
            $add_product->date = $date;
            $add_product->status = 1;

            $product_id = R::store($add_product);

            $complete = true;
			
			setcookie("price","",time()-3600);
			setcookie("title","",time()-3600);
			setcookie("size","",time()-3600);
			setcookie("content","",time()-3600);
			
         }else{
            foreach($upload['errors'] as $error){
               array_push($errors, $error);
            }
         }
      }else{
         array_push($errors, "Заполните все данные.");
      }

      return array('id' => $product_id, 'complete' => $complete, 'errors' => $errors);
   }

    public function addPromo(){
        $errors = array();
        $complete = false;
        $promo_id = "error_id";
        if($this->validatePromo()){

            $upload = $this->uploadPhoto("public/img/promo/");

            if($upload['complete']){
                $date = date("d-m-Y H:i:s");

                $add_promo = R::dispense("promo");

                $add_promo->title = $_POST['title'];
                $add_promo->descr = $_POST['content'];
                $add_promo->image = $upload['image'];
                $add_promo->date = $date;
                $add_promo->status = 1;

                $promo_id = R::store($add_promo);

                $complete = true;

                setcookie("title","",time()-3600);
                setcookie("content","",time()-3600);

            }else{
                foreach($upload['errors'] as $error){
                    array_push($errors, $error);
                }
            }
        }else{
            array_push($errors, "Заполните все данные.");
        }

        return array('id' => $promo_id, 'complete' => $complete, 'errors' => $errors);
    }

   public function editProduct($post, $id){
      $errors = array();
      $complete = false;
      $product_id = "error_id";
      if($this->validateProduct()){
         if(file_exists($_FILES['fileToUpload']['tmp_name']) && is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
            $img = R::load('menu', $id);
            $img = explode('/', $img->image);

            $FilePath = 'public/img/menu/';
            $FileName = $img[count($img)-1];
            chdir($FilePath); // Comment this out if you are on the same folder
            //chown($FileName,465);
            unlink($FileName);
            $upload = $this->uploadPhoto("../../../public/img/menu/");

            if($upload['complete']){
               $path = 'public/img/menu/';
               $imgName = explode('/', $upload['image']);
               $imgName = $imgName[count($imgName)-1];

               $edit_product = R::load('menu', $id);
               $edit_product->image = $path.$imgName;
               $product_id = R::store($edit_product);
            }else{
               foreach($upload['errors'] as $error){
                  array_push($errors, $error);
               }
            }
         }

         $edit_product = R::load('menu', $id);

         $edit_product->title = $_POST['title'];
		 $edit_product->descr = $_POST['content'];
		 $edit_product->size = $_POST['size'];
		 $edit_product->category = $_POST['category'];
		 $edit_product->poster_id = $_POST['poster_id'];
		 $edit_product->price = $_POST['price'];

         $product_id = R::store($edit_product);

         $complete = true;
      }else{
         array_push($errors, "Заполните все данные.");
      }

      return array('id' => $product_id, 'complete' => $complete, 'errors' => $errors);
   }

    public function editPromo($post, $id){
        $errors = array();
        $complete = false;
        $promo_id = "error_id";
        if($this->validatePromo()){
            if(file_exists($_FILES['fileToUpload']['tmp_name']) && is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
                $img = R::load('promo', $id);
                $img = explode('/', $img->image);

                $FilePath = 'public/img/promo/';
                $FileName = $img[count($img)-1];
                chdir($FilePath); // Comment this out if you are on the same folder
                //chown($FileName,465);
                unlink($FileName);
                $upload = $this->uploadPhoto("../../../public/img/promo/");

                if($upload['complete']){
                    $path = 'public/img/promo/';
                    $imgName = explode('/', $upload['image']);
                    $imgName = $imgName[count($imgName)-1];

                    $edit_promo = R::load('promo', $id);
                    $edit_promo->image = $path.$imgName;
                    $promo_id = R::store($edit_promo);
                }else{
                    foreach($upload['errors'] as $error){
                        array_push($errors, $error);
                    }
                }
            }

            $edit_promo = R::load('promo', $id);

            $edit_promo->title = $_POST['title'];
            $edit_promo->descr = $_POST['content'];

            $promo_id = R::store($edit_promo);

            $complete = true;
        }else{
            array_push($errors, "Заполните все данные.");
        }

        return array('id' => $promo_id, 'complete' => $complete, 'errors' => $errors);
    }

   public function delProduct($id) {
	  $imgLink = R::load('menu', $id);
	  unlink($imgLink->image);
      $del = R::load('menu', $id);
      R::trash($del);
   }
   public function delPromo($id) {
	  $imgLink = R::load('promo', $id);
	  unlink($imgLink->image);
      $del = R::load('promo', $id);
      R::trash($del);
   }

   public function changeStatusTour($id, $act) {
      if($act == 1 ) $act = 0;
      else if($act == 0) $act = 1;

      $status = R::load('menu', $id);
      $status->status = $act;
      R::store($status);
   }
   public function changePromoStatus($id, $act) {
      if($act == 1 ) $act = 0;
      else if($act == 0) $act = 1;

      $status = R::load('promo', $id);
      $status->status = $act;
      R::store($status);
   }

   public function validateProduct() {
      $category = $_POST['category'];
      $title = $_POST['title'];
	  $size = $_POST['size'];
      $content = $_POST['content'];
	  $price = $_POST['price'];

      if(!empty($category) &&!empty($title) && !empty($content) && !empty($price) && !empty($size)) return true;
      else return false;
   }
   public function validatePromo() {
      $title = $_POST['title'];
      $content = $_POST['content'];

      if(!empty($title) && !empty($content)) return true;
      else return false;
   }

   public function uploadPhoto($target_dir) {
      $errors = [];
      $image = '';
      $complete = false;
      $type_file = explode(".", basename($_FILES["fileToUpload"]["name"]));
      $type_file = ".".$type_file[count($type_file)-1];

      $target_file = $target_dir .time().$type_file;
	  
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      // Check if image file is a actual image or fake image
      if(isset($_POST["submit"])) {
         $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
         if($check !== false) {
            $uploadOk = 1;
         } else {
            array_push($errors, "Файл - не изображение.");
            $uploadOk = 0;
         }
      }
      // Check if file already exists
      if (file_exists($target_file)) {
         array_push($errors, "Данное название уже существует.");
         $uploadOk = 0;
      }
	  
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
         array_push($errors, "Лише файли з роширенням JPG, JPEG, PNG та GIF допускаються.");
         $uploadOk = 0;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
         array_push($errors, "Помилка в завантаженні фото на сервер.");
         // if everything is ok, try to upload file
      } else {
         if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			
            $complete = true;
            $image = $target_file;
			$this->resizeImg($target_file, 800, 800);
         } else {
            array_push($errors, "Помилка в завантаженні фото на сервер.");
         }
      }
      return array('complete'=>$complete, 'errors'=>$errors, 'image'=>$image);
   }
   
   public function resizeImg($filename, $width, $height){

	define('SOURCE', $filename); // исходный файл
	define('TARGET', $filename); // имя файла для "превьюшки"
	define('NEWX', $width); // ширина "превьюшки"
	define('NEWY', $height); // высота "превьюшки"
	 
	// Определяем размер изображения с помощью функции getimagesize:
	$size = getimagesize(SOURCE);
	if ($size === false) die ('Bad image file!');
	 
	// Читаем в память JPEG-файл с помощью функции imagecreatefromjpeg:
	$source = imagecreatefromjpeg(SOURCE)
	or die('Cannot load original JPEG');
	 
	// Создаем новое изображение
	$target = imagecreatetruecolor(NEWX, NEWY);
	 
	// Копируем существующее изображение в новое с изменением размера:
	imagecopyresampled(
	$target, // Идентификатор нового изображения
	$source, // Идентификатор исходного изображения
	0,0, // Координаты (x,y) верхнего левого угла
	// в новом изображении
	0,0, // Координаты (x,y) верхнего левого угла копируемого
	// блока существующего изображения
	NEWX, // Новая ширина копируемого блока
	NEWY, // Новая высота копируемого блока
	$size[0], // Ширина исходного копируемого блока
	$size[1] // Высота исходного копируемого блока
	);
	imagejpeg($target, TARGET, 100);
	 
	// Как всегда, не забываем:
	imagedestroy($target);
	imagedestroy($source);
   }

   public function loadCheckouts($case) {
      if($case === 'error') $status = '2';
      if($case === 'success') $status = '1';
      if($case === 'canceled') $status = '0';
      $result = R::find('orders', 'status=? ORDER BY id DESC', array($status));
      return $result;
   }

   public function delCheckout($id) {
      $del = R::load('orders', $id);
      R::trash($del);
   }
}
