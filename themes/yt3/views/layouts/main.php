<!doctype html>
<html lang="en" ng-app="myApp">
<head>
  <meta charset="utf-8">
  <title ng-bind-template="Yii Theme Factory {{'- ' + pageTitle || ''}}"></title>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/reset.css"/>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.min.css"/>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootswatch.css"/>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/app.css"/>
</head>
<body>
  <div class="loader" ng-show="showLoader">loading ...</div>
  <div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a class="brand" href="/">YT 3.0</a>
        <div class="nav-collapse" id="main-menu">
          <ul class="nav" id="main-menu-left">
            <li><a href="#/home">Home</a></li>
            <li><a href="#/themes">Themes</a></li>
            <li><a href="#/layouts">Layouts</a></li>
          </ul>
          <ul class="nav pull-right" id="main-menu-right">
            <li>
              <a ng-hide="userInfo.is_guest" href="<?php echo Yii::app()->request->baseUrl; ?>/theme/mythemes">Admin</a>
            </li>
            <li><a href="/#/contact">Contact</a></li>
            <li>
              <a ng-show="userInfo.is_guest" href="<?php echo Yii::app()->request->baseUrl; ?>/user/user/registration">Register</a>
            </li>
            <li>
              <a ng-show="userInfo.is_guest" href="<?php echo Yii::app()->request->baseUrl; ?>/user/user/login">Login</a>
              <a ng-hide="userInfo.is_guest" href="<?php echo Yii::app()->request->baseUrl; ?>/user/user/logout">{{userInfo.name}} - Logout</a>
            </li>
          </ul>
        </div>
      </div> <!-- .container -->
    </div> <!-- .navbar-inner -->
  </div> <!-- .navbar .navbar-fixed-top -->

  <div class="container">
    <div ng-view>loading ...</div>
    <hr>

    <footer id="footer">
      <p class="pull-right">
        <span class="label">v<span app-version></span></span>
      </p>
      <div class="links">
        <a href="#/home">home</a>
        <a href="#/themes">themes</a>
        <a href="#/layouts">layouts</a>
      </div>
      <div>
        <small>All Themes: <strong><?php echo number_format( Theme::model()->count() ); ?></strong>
        Themes Viewed: <strong><?php echo number_format( Theme::model()->sumView()->find()->sumviews ); ?></strong>
        Themes Downloaded: <strong><?php echo number_format( Theme::model()->sumDownload()->find()->sumdownloads ); ?></small></strong>
      </div>

    </footer>

  </div> <!-- .container -->

  <!-- In production use:
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.0.4/angular.min.js"></script>
  -->

  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.min.js"></script>
  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/lib/angular/angular.js"></script>
  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/app.js"></script>
  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/services.js"></script>
  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/controllers.js"></script>
  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/filters.js"></script>
  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/directives.js"></script>
  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>
<?php 
  $themeUrl = Yii::app()->theme->baseUrl;
  $baseUrl = Yii::app()->request->baseUrl;
  Yii::app()->clientScript->registerScript('script', <<<JS
  YT_CONFIG = { themeUrl: "${themeUrl}", apiUrl: "${baseUrl}/api", debug: true, jsonRestHeaders: {"Accept": "application/json", "X_REST_USERNAME": "admin@restuser", "X_REST_PASSWORD": "admin@Access"} };
JS
, CClientScript::POS_HEAD);?>
</body>
</html>
