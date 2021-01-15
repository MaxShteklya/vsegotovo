<?php

namespace application\controllers;

use application\core\Controller;
use application\core\View;
use application\lib\Db;
use application\lib\LiqPay;

class PaymentController extends Controller{

   public function indexAction() {
      $this->model->pay($_SESSION['paymentPost']);
   }

   public function formAction() {
      //exit();
      $public_key = "i63518351598";
      $private_key = "xNwgV1GauQaG2CxOWXRGs0m8B2guQfygAkwPOENb";

      $liqpay = new LiqPay($public_key, $private_key);
      $html = $liqpay->cnb_form(array(
         'action'         => 'pay',
         'amount'         => $_SESSION['payment']['price'],
         'currency'       => 'UAH',
         'description'    => '',
         'order_id'       => $_SESSION['payment']['id'],
         'version'        => '3',
         'server_url'     => 'http://www.vsegotovo.od.ua/payment/process',
         'result_url'     => 'http://www.vsegotovo.od.ua/payment/result'
      ));


      if(!empty($_SESSION["payment"])){
         echo '<body onload="document.forms[0].submit()">
         '.$html.'
         </body>';
      }

   }

   public function processAction() {
      // $_POST['signature'] = "qJrV9niwl27t1qZvlkoo\/lVx10Q=";
      // $_POST['data'] = "eyJwYXltZW50X2lkIjoxNDkzMzQ4Mzc1LCJhY3Rpb24iOiJwYXkiLCJzdGF0dXMiOiJzdWNjZXNzIiwidmVyc2lvbiI6MywidHlwZSI6ImJ1eSIsInBheXR5cGUiOiJjYXJkIiwicHVibGljX2tleSI6InNhbmRib3hfaTYwMjA2NTIwODA2IiwiYWNxX2lkIjo0MTQ5NjMsIm9yZGVyX2lkIjoiNDIxIiwibGlxcGF5X29yZGVyX2lkIjoiTlY2UUJHTjMxNjA2Nzc4NTc3OTUzOTU5IiwiZGVzY3JpcHRpb24iOiJMSVFQQVkiLCJzZW5kZXJfY2FyZF9tYXNrMiI6IjQyNDI0Mio0MiIsInNlbmRlcl9jYXJkX2JhbmsiOiJUZXN0Iiwic2VuZGVyX2NhcmRfdHlwZSI6InZpc2EiLCJzZW5kZXJfY2FyZF9jb3VudHJ5Ijo4MDQsImlwIjoiNS41OC4zNy4yMDMiLCJhbW91bnQiOjI1OC4wLCJjdXJyZW5jeSI6IlVBSCIsInNlbmRlcl9jb21taXNzaW9uIjowLjAsInJlY2VpdmVyX2NvbW1pc3Npb24iOjcuMSwiYWdlbnRfY29tbWlzc2lvbiI6MC4wLCJhbW91bnRfZGViaXQiOjI1OC4wLCJhbW91bnRfY3JlZGl0IjoyNTguMCwiY29tbWlzc2lvbl9kZWJpdCI6MC4wLCJjb21taXNzaW9uX2NyZWRpdCI6Ny4xLCJjdXJyZW5jeV9kZWJpdCI6IlVBSCIsImN1cnJlbmN5X2NyZWRpdCI6IlVBSCIsInNlbmRlcl9ib251cyI6MC4wLCJhbW91bnRfYm9udXMiOjAuMCwibXBpX2VjaSI6IjciLCJpc18zZHMiOmZhbHNlLCJsYW5ndWFnZSI6InJ1IiwiY3JlYXRlX2RhdGUiOjE2MDY3Nzg1Nzc5NTcsImVuZF9kYXRlIjoxNjA2Nzc4NTc4MDEwLCJ0cmFuc2FjdGlvbl9pZCI6MTQ5MzM0ODM3NX0=";

      if(empty($_POST)){
         die;
      }
      // $fd = fopen("log.txt", 'w') or die("не удалось создать файл");
      // $str = json_encode($_POST);
      // fwrite($fd, $str);
      // fclose($fd);

      $this->model->paymentProcess($_POST);
   }

}
