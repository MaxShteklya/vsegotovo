<!DOCTYPE html>
<html lang="ru" dir="ltr">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?=$title?></title>

      <link rel="stylesheet" href="/public/css/bootstrap.min.css">
      <link rel="stylesheet" href="/public/css/font-awesome.min.css">
      <link rel="stylesheet" href="/public/css/admin.css">

      <script src="/public/js/jquery.js"></script>
      <script src="/public/js/bootstrap.min.js"></script>
      <script src="/public/js/ckeditor/ckeditor.js"></script>

   </head>
   <body>
      <div id="throbber" style="display:none; min-height:120px;"></div>
      <div id="noty-holder"></div>
      <div id="wrapper">
          <!-- Navigation -->
          <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="/">
                      <?=$_SERVER['SERVER_NAME']?>
                  </a>
              </div>
              <!-- Top Menu Items -->
              <ul class="nav navbar-right top-nav">
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Привет, Admin <b class="fa fa-angle-down"></b></a>
                      <ul class="dropdown-menu">
                          <li><a href="#"><i class="fa fa-fw fa-cog"></i> Изменить пароль</a></li>
                          <li class="divider"></li>
                          <li><a href="/admin/logout"><i class="fa fa-fw fa-power-off"></i> Выход</a></li>
                      </ul>
                  </li>
              </ul>
              <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
              <div class="collapse navbar-collapse navbar-ex1-collapse menu">
                  <ul class="nav navbar-nav side-nav">
                      <li>
                          <a data-toggle="collapse" aria-expanded="true" data-target="#submenu-1"><i class="fa fa-map" aria-hidden="true"></i> МЕНЮ <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                          <ul id="submenu-1" class="collapse">
                              <li><a href="/admin/addproduct"><i class="fa fa-plus-circle" aria-hidden="true"></i> Добавить товар</a></li>
                              <li><a href="/admin/editproduct/all"><i class="fa fa-pencil" aria-hidden="true"></i> Редактировать товар</a></li>
                          </ul>
                      </li>
                      <li>
                          <a data-toggle="collapse" aria-expanded="true" data-target="#submenu-2"><i class="fa fa-percent" aria-hidden="true"></i> АКЦИИ <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                          <ul id="submenu-2" class="collapse">
                              <li><a href="/admin/addpromo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Добавить акцию</a></li>
                              <li><a href="/admin/editpromo"><i class="fa fa-pencil" aria-hidden="true"></i> Редактировать акции</a></li>
                          </ul>
                      </li>
                      <li>
                          <a href="/admin/checkouts"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>  ЗАКАЗЫ </a>
                      </li>

                  </ul>
              </div>
              <!-- /.navbar-collapse -->
          </nav>

          <div id="page-wrapper">
              <div class="container-fluid">
                  <!-- Page Heading -->
                  <div class="row" id="main" >
                      <div class="col-sm-12 col-md-12" id="content">
                        <?=$content?>
                      </div>
                  </div>
                  <!-- /.row -->
              </div>
              <!-- /.container-fluid -->
          </div>
          <!-- /#page-wrapper -->
      </div><!-- /#wrapper -->
      <script>
      $(function(){
         $('[data-toggle="tooltip"]').tooltip();
         $(".side-nav .collapse").on("hide.bs.collapse", function() {
              $(this).prev().find(".fa").eq(1).removeClass("fa-angle-right").addClass("fa-angle-down");
         });
         $('.side-nav .collapse').on("show.bs.collapse", function() {
              $(this).prev().find(".fa").eq(1).removeClass("fa-angle-down").addClass("fa-angle-right");
         });
      });
      </script>
   </body>
</html>
