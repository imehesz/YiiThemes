<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo Yii::app()->name; ?> - Admin</title>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/reset.css"/>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.min.css"/>
  <!-- <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootswatch.css"/> -->
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/app.css"/>
</head>
<body>
  <div class="navbar <?php echo Yii::app()->theme->name == 'html' ? "navbar-inverse" : ""; // getho, but what you gonna do ?> navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a class="brand" href="/"><?php echo Yii::app()->name; ?></a>
        <div class="nav-collapse" id="main-menu">
          <ul class="nav" id="main-menu-left">
          </ul>
          <ul class="nav pull-right" id="main-menu-right">
            <?php if ( ! Yii::app()->user->isGuest ) : ?>
              <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/theme/mythemes" title="List all my themes">Admin</a></li>
              <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/theme/create" title="Create a new theme">Create</a></li>
            <?php endif; ?>
            <li><a href="<?php echo $this->createUrl( '/site/contact' ); ?>">Contact</a></li>
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
