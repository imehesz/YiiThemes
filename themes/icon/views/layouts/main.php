<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="<?php Yii::app()->request->baseUrl;?>/images/favicon.ico" type="image/x-icon">
  <meta property="og:title" content="<?php echo CHtml::encode( $this->pageTitle ); ?>">
  <meta property="og:site_name" content="Yii Themes">

  <title>Icon Theme Factory - <?php echo $this->pageTitle; ?></title>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/reset.css"/>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.min.css"/>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootswatch.css"/>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.min.css"/>
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/app.css"/>

  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.min.js"></script>
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
        <!-- <a class="brand" href="/">YT 3.0</a> -->
        <div class="nav-collapse" id="main-menu">
          <ul class="nav" id="main-menu-left">

            <?php if ( Yii::app()->params['tffamily'] && sizeof( Yii::app()->params['tffamily'] ) > 0 ) : ?>
              <li class="dropdown" title="Check out other Theme Factories">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Family <b class="caret"></b></a>
                <ul class="dropdown-menu" id="swatch-menu">
                  <?php foreach( Yii::app()->params['tffamily'] as $member ) : ?>
                    <li title="Check out the <?php echo $member[0]; ?> Theme Factory"><a href="<?php echo $member[1]; ?>"><?php echo $member[0]; ?></a></li>
                  <?php endforeach; ?>
                  <!-- <li class="divider"></li> -->
                </ul>
              </li>
            <?php endif; ?>

            <li><a href="<?php echo $this->createUrl('/site/index'); ?>">Home</a></li>
            <li><a href="<?php echo $this->createUrl('/theme/index'); ?>">Theme Browser</a></li>
          </ul>
          <ul class="nav pull-right" id="main-menu-right">
            <li>
              <?php if ( ! Yii::app()->user->isGuest ) : ?>
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/theme/mythemes">Admin</a>
              <?php endif; ?>
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
                <a  href="<?php echo Yii::app()->request->baseUrl; ?>/user/user/logout"><?php echo Yii::app()->user->name; ?> - Logout</a>
              <?php endif; ?>
            </li>
          </ul>
        </div>
      </div> <!-- .container -->
    </div> <!-- .navbar-inner -->
  </div> <!-- .navbar .navbar-fixed-top -->

  <div class="container">
    <?php echo $content; ?>
    <hr>

    <footer id="footer">
      <p>
        <div class="label pull-right">v 3.0.<span id='VERSION_ID'>2013.0411.2105</span></div>
      </p>
      <div class="links">
        <a href="<?php echo $this->createUrl('/site/index'); ?>">Home</a>
        <a href="<?php echo $this->createUrl('/theme/index'); ?>">Themes</a>
      </div>
      <div>
        <small>All Themes: <strong><?php echo number_format( $this->modelClass->count() ); ?></strong>
        Themes Viewed: <strong><?php echo number_format( $this->modelClass->sumView()->find()->sumviews ); ?></strong>
        Themes Downloaded: <strong><?php echo number_format( $this->modelClass->sumDownload()->find()->sumdownloads ); ?></small></strong>
      </div>

    </footer>

  </div> <!-- .container -->

  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/app.js"></script>
  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>
  <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootswatch.js"></script>

  <script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-38672655-1']);
    _gaq.push(['_setDomainName', 'themefactory.net']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
  </script>
</body>
</html>
