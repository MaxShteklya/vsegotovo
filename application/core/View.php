<?php

namespace application\core;

class View {

   public $path;
   public $route;
   public $layout = 'default';

   public function __construct($route) {
      $this->route = $route;
      $this->path = $route['controller'].'/'.$route['action'];
   }

   public function render($title, $vars = []) {
      extract($vars);
      $this->varsChange(); //for ajax request
      if( file_exists('application/views/'.$this->path.'.php') ){
         $styles = explode("/", $this->path)[1];
         ob_start();
         require 'application/views/'.$this->path.'.php';
         $content = ob_get_clean();
         require 'application/views/layouts/'.$this->layout.'.php';
      }
   }


   public static function errorCode($code){
      http_response_code($code);
      $path = 'application/views/errors/'.$code.'.php';
      if(file_exists($path)){
         require $path;
      }
      exit;
   }

    private function varsChange()
    {

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            $this->path = str_replace('menu', 'products_ajax', $this->path);
            $this->layout = 'ajax';
        }
    }
}
