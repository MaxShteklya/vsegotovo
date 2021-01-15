<?php

return [

   //MAIN
   '' => [
      'controller' => 'main',
      'action' => 'index'
   ],

   'menu' => [
      'controller' => 'main',
      'action' => 'menu'
   ],

   'menu/{id:\d+}' => [
      'controller' => 'main',
      'action' => 'product'
   ],

   'menu/{category:.+}' => [
      'controller' => 'main',
      'action' => 'menu'
   ],

   'promo' => [
       'controller' => 'main',
       'action' => 'promo'
   ],

   'promo/{id:\d+}' => [
       'controller' => 'main',
       'action' => 'promoOne'
   ],

   'getCart' => [
      'controller' => 'main',
      'action' => 'getCart'
   ],

   'checkout' => [
      'controller' => 'main',
      'action' => 'checkout'
   ],

   'reviews' => [
      'controller' => 'main',
      'action' => 'reviews'
   ],

   'delivery' => [
      'controller' => 'main',
      'action' => 'delivery'
   ],

   'contacts' => [
      'controller' => 'main',
      'action' => 'contacts'
   ],

   'about_us' => [
      'controller' => 'main',
      'action' => 'about_us'
   ],

   'public_oferta' => [
      'controller' => 'main',
      'action' => 'public_oferta'
   ],
   //MAIN

   //PAY
   'payment' => [
      'controller' => 'payment',
      'action' => 'index'
   ],

   'payment/form' => [
      'controller' => 'payment',
      'action' => 'form'
   ],

   'payment/process' => [
      'controller' => 'payment',
      'action' => 'process'
   ],

   'payment/result' => [
      'controller' => 'main',
      'action' => 'result'
   ],

   'payment/wait' => [
      'controller' => 'payment',
      'action' => 'form'
   ],
   //PAY

   //SEAECH
   'search/{query:.+}' => [
      'controller' => 'main',
      'action' => 'search'
   ],
   //SEARCH

   //ADMIN
   'admin' => [
      'controller' => 'admin',
      'action' => 'index'
   ],

   'admin/login' => [
      'controller' => 'admin',
      'action' => 'login'
   ],
   'admin/logout' => [
      'controller' => 'admin',
      'action' => 'logout'
   ],

   'admin/addproduct' => [
      'controller' => 'admin',
      'action' => 'addproduct'
   ],
   'admin/editproduct/{category:.+}' => [
      'controller' => 'admin',
      'action' => 'editproduct'
   ],
   'admin/edit/{id:\d+}' => [
      'controller' => 'admin',
      'action' => 'edit'
   ],
   'admin/delete/{id:\d+}' => [
      'controller' => 'admin',
      'action' => 'delete'
   ],
   'admin/changestatus/{id:.+}' => [
      'controller' => 'admin',
      'action' => 'changeStatus'
   ],

   'admin/addpromo' => [
      'controller' => 'admin',
      'action' => 'addpromo'
   ],
   'admin/editpromo' => [
      'controller' => 'admin',
      'action' => 'editpromo'
   ],
   'admin/editpromo/{id:\d+}' => [
      'controller' => 'admin',
      'action' => 'editpromoOne'
   ],
   'admin/deletepromo/{id:\d+}' => [
      'controller' => 'admin',
      'action' => 'deletePromo'
   ],
   'admin/changepromostatus/{id:.+}' => [
      'controller' => 'admin',
      'action' => 'changePromoStatus'
   ],

   'admin/checkouts' => [
      'controller' => 'admin',
      'action' => 'checkouts'
   ],
   'admin/delcheckout/{id:\d+}' => [
      'controller' => 'admin',
      'action' => 'delCheckout'
   ],
   'admin/gallery' => [
      'controller' => 'admin',
      'action' => 'gallery'
   ],
   'admin/reviews' => [
      'controller' => 'admin',
      'action' => 'reviews'
   ],
   'admin/activatereview/{id:\d+}' => [
      'controller' => 'admin',
      'action' => 'activateReview'
   ],
   'admin/disactivatereview/{id:\d+}' => [
      'controller' => 'admin',
      'action' => 'disactivateReview'
   ],
   'admin/delreview/{id:\d+}' => [
      'controller' => 'admin',
      'action' => 'delReview'
   ],
   //ADMIN

];
