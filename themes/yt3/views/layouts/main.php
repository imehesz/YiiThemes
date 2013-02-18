<!doctype html>
<html lang="en" ng-app="myApp">
<head>
  <meta charset="utf-8">
  <title ng-bind-template="Yii Themes {{'- ' + pageTitle || ''}}"></title>
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
        <a class="brand" href="#">YT 3.0</a>
        <div class="nav-collapse" id="main-menu">
          <ul class="nav" id="main-menu-left">
            <li><a href="#/home">home</a></li>
            <li><a href="#/themes">themes</a></li>
            <li><a href="#/layouts">layouts</a></li>
          </ul>
          <ul class="nav pull-right" id="main-menu-right">
            <li><a href="#/contact">contact</a></li>
            <li>
              <a ng-show="userInfo.is_guest" href="<?php echo Yii::app()->request->baseUrl; ?>/user/user/login">login</a>
              <a ng-hide="userInfo.is_guest" href="<?php echo Yii::app()->request->baseUrl; ?>/user/user/logout">{{userInfo.name}} - logout</a>
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
        <?php /* <a href="#top">Back to top</a> */ ?>
        <span class="label">v<span app-version></span></span>
      </p>
      <div class="links">
        <a href="#/home">home</a>
        <a href="#/themes">themes</a>
        <a href="#/layouts">layouts</a>
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

<!-- becasue sharing is good :) -->
<div class="addthis_toolbox addthis_peekaboo_style addthis_default_style addthis_label_style addthis_32x32_style">
        <a class="addthis_button_more">Share</a>
        <ul>
                <li><a class="addthis_button_preferred_1"></a></li>
                <li><a class="addthis_button_preferred_2"></a></li>
                <li><a class="addthis_button_preferred_3"></a></li>
        </ul>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4dc48dcc77246178"></script>
<!-- END of sharing ... -->

</body>
</html>
