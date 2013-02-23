<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Yii Theme Factory - <?php echo $this->pageTitle; ?></title>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/reset.css"/>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.min.css"/>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootswatch.css"/>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/app.css"/>
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
            <li><a href="<?php echo $this->createUrl('/site/index'); ?>">Home</a></li>
            <li><a href="<?php echo $this->createUrl('/theme/index'); ?>">Themes</a></li>
            <li><a href="<?php echo $this->createUrl('/theme/layoutgen'); ?>">Layouts</a></li>
          </ul>
          <ul class="nav pull-right" id="main-menu-right">
            <li>
              <a href="<?php echo Yii::app()->request->baseUrl; ?>/theme/mythemes">Admin</a>
            </li>
            <li><a href="<?php echo $this->createUrl( '/site/contact' ); ?>">Contact</a></li>
            <li>
              <?php if ( Yii::app()->user->isGuest ) : ?>
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/user/user/registration">Register</a>
              <?php endif; ?>
            </li>
            <li>
              <?php if ( Yii::app()->user->isGuest ) : ?>
                <a  href="<?php echo Yii::app()->request->baseUrl; ?>/user/user/login">Login</a>
              <?php else: ?>
                <a  href="<?php echo Yii::app()->request->baseUrl; ?>/user/user/logout"><?php echo Yii::app()->user->username; ?> - Logout</a>
              <?php endif; ?>
            </li>
          </ul>
        </div>
      </div> <!-- .container -->
    </div> <!-- .navbar-inner -->
  </div> <!-- .navbar .navbar-fixed-top -->

  <div class="container">
    <div id="content"><?php echo $content; ?></div>
    <hr>

    <footer id="footer">
      <p class="pull-right">
        <span class="label">v 3.0</span>
      </p>
      <div class="links">
        <a href="<?php echo $this->createUrl('/site/index'); ?>">Home</a>
        <a href="<?php echo $this->createUrl('/theme/index'); ?>">Themes</a>
        <a href="<?php echo $this->createUrl('/theme/layoutgen'); ?>">Layouts</a>
      </div>
      <div>
        <small>All Themes: <strong><?php echo number_format( Theme::model()->count() ); ?></strong>
        Themes Viewed: <strong><?php echo number_format( Theme::model()->sumView()->find()->sumviews ); ?></strong>
        Themes Downloaded: <strong><?php echo number_format( Theme::model()->sumDownload()->find()->sumdownloads ); ?></small></strong>
      </div>

    </footer>

  </div> <!-- .container -->

  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.min.js"></script>
  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/app.js"></script>
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
