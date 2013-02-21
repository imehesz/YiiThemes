<!doctype html>
<html lang="en" ng-app="myApp">
<head>
  <meta charset="utf-8">
  <title>Yii Theme Factory - Admin</title>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/reset.css"/>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.min.css"/>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootswatch.css"/>
</head>
<body>
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
              <?php if ( ! Yii::app()->user->isGuest ) : ?>
                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/theme/mythemes" title="List all my themes">My Themes</a></li>
                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/theme/create" title="Create a new theme">Create</a></li>
            <?php endif; ?>
          </ul>
          <ul class="nav pull-right" id="main-menu-right">
            <li><a href="/#/contact">Contact</a></li>
            <?php if ( Yii::app()->user->isGuest ) : ?>
              <li>
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/user/user/registration">Register</a>
              </li>
            <?php endif ?>
            <li>
              <?php if ( Yii::app()->user->isGuest ) : ?>
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/user/user/login">Login</a>
              <?php else: ?>
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/user/user/logout"><?php echo Yii::app()->user->name ;?> - Logout</a>
              <?php endif; ?>
            </li>
          </ul>
        </div>
      </div> <!-- .container -->
    </div> <!-- .navbar-inner -->
  </div> <!-- .navbar .navbar-fixed-top -->

  <div class="container">
    <?php echo $content; ?>
  </div> <!-- .container -->

</body>
</html>
