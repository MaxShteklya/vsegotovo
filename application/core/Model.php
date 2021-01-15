<?php

namespace application\core;
use \RedBeanPHP\R as R;

abstract class Model {
   function __construct() {
      $this->dbConnection();
   }

   private function dbConnection()
   {
       $config = require 'application/config/db.php';
       R::setup( 'mysql:host=vgotovo.mysql.tools;dbname=vgotovo_db;',
           'vgotovo_db',
           'vgotovo_pass'
       );

       if (!R::testConnection()) exit('Нет соединения с базой данных');
   }

   public function rememberMeAdmin() {
        if(isset($_COOKIE["password_cookie_token"]) && !empty($_COOKIE["password_cookie_token"])) {
            $select_user_data = R::findOne(
                'admin',
                'password_cookie_token = ?',
                array($_COOKIE["password_cookie_token"])
            );

            if($select_user_data){
                $_SESSION['admin']['id'] = $select_user_data->id;
                $_SESSION['admin']['password'] = $select_user_data->password;
            }
        }
   }

   // public function SendEmail($to, $subject, $message) {
   //    $message_layout = '
   //          <html>
   //             <body style="background-color:#f1f3f4;color:#505050;font-size:16px;padding:30px;">
   //                <div style="padding:10px 20px;background-color:white">
   //                   '.$message.'
   //                </div>
   //             </body>
   //          </html>';
   //
   //    $headers  = "Content-type: text/html; charset=utf-8 \r\n";
   //    $headers .= "From: TourUkr.com\r\n";
   //
   //    mail($to, $subject, $message_layout, $headers);
   // }
   //
   // public function GetAdminEmails() {
   //    $emails = R::getCol('SELECT email FROM admin');
   //    return $emails;
   // }

}
