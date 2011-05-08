<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr" class="js">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="icon" href="<?php Yii::app()->request->baseUrl;?>/images/favicon.ico" type="image/x-icon">
<meta property="og:title" content="<?php echo CHtml::encode( $this->pageTitle ); ?>">
<meta property="og:site_name" content="Yii Themes">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
  <link type="text/css" rel="stylesheet" media="all" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/td-reset.css">
  <link type="text/css" rel="stylesheet" media="all" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/node.css">
  <link type="text/css" rel="stylesheet" media="all" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/defaults.css">
  <link type="text/css" rel="stylesheet" media="all" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/system.css">
  <link type="text/css" rel="stylesheet" media="all" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/system-menus.css">
  <link type="text/css" rel="stylesheet" media="all" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/user.css">
  <link type="text/css" rel="stylesheet" media="all" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/content-module.css">
  <link type="text/css" rel="stylesheet" media="all" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/filefield.css">
  <link type="text/css" rel="stylesheet" media="all" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/views.css">
  <link type="text/css" rel="stylesheet" media="all" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css">
  <link type="text/css" rel="stylesheet" media="all" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/widget57.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
</head>
<body class="front not-logged-in page-node node-type-page two-sidebars">
    <div id="page">
        <div id="header" class="clear-block">
            <div id="logo-title">
                  <a href="<?php echo Yii::app()->controller->createUrl('/site/index'); ?>" title="Yii Themes - because some things are better in color" rel="home" id="logo"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/yiithemes_logo_new.png" alt="Yii Themes - because some things are better in color"></a>
            </div> <!-- /logo-title -->

            <div id="navigation" class="menu withprimary ">
                <div id="primary" class="clear-block">
                    <?php $this->widget('zii.widgets.CMenu',array(
                        'htmlOptions'   => array( 'class' => 'links primary-links' ),
                        'items'=>array(
                            array('label'=>'Home', 'url'=> Yii::app()->controller->createUrl( '/site/index' )),
                            array('label'=>'Themes', 'url'=>array('/theme/index')),
                            array('label'=>'Layouts', 'url'=>array('/theme/layoutgen')),
                            array('label'=>'Contact', 'url'=>array('/site/contact')),
                            array('label'=>'Login', 'url'=>array('/user/user/login'), 'visible'=>Yii::app()->user->isGuest),
                            array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                        ),
                    )); ?>
                </div>
            </div> <!-- /navigation -->
        </div> <!-- /header -->

    <div id="container" class="clear-block">
        <div class="content-maj">
            <h1 class="title">Yii Theme</h1>
            <div class="block">
                <?php echo $content; ?>
            </div>
        </div> <!-- /content-maj -->
        <div class="content-min">
			<?php echo Controller::$RIGHT_SIDEBAR; ?>
		</div> <!-- /content-min -->
	  
    </div> <!-- /container -->

    <div id="footer-wrapper">
      <div id="footer" class="clear-block">
        <div id="block-tdhelp-contact" class="block block-tdhelp">
  <h2>Some stats</h2>

 	<div class="content">
		<div class="left">
			<strong>All Themes:</strong> <?php echo Theme::model()->count(); ?><br />
			<strong>Featured Themes:</strong> <?php echo Theme::model()->count( 'score>0' ); ?>
		</div>
		<div class="right">
				<strong>Themes Viewed:</strong> <?php echo number_format( Theme::model()->sumView()->find()->sumviews ); ?><br />
				<strong>Themes Downloaded:</strong> <?php echo number_format( Theme::model()->sumDownload()->find()->sumdownloads ); ?>
		</div>  
	</div>
</div>
<div id="block-tdhelp-follow" class="block block-tdhelp">
  <h2>Other Sites</h2>
  	<div class="content">
    	<ul class="follow-links">
    		<li><?php echo CHtml::link( 'Yii Radiio (PHP) podcast', 'http://yiiradiio.mehesz.net', array( 'target' => '_blank' ) );?></li>
    		<li><?php echo CHtml::link( 'IKMQ - online trivia game', 'http://ikmq.mehesz.net', array( 'target' => '_blank' ) );?></li>
    		<li><?php echo CHtml::link( 'StoredByU', 'http://storedbyu.mehesz.net', array( 'target' => '_blank' ) );?></li>
    		<li><?php echo CHtml::link( 'RoadFinger', 'http://roadfinger.mehesz.net', array( 'target' => '_blank' ) );?></li>
		</ul>  
	</div>
</div>
<div id="block-menu-primary-links" class="block block-menu">
  <h2>Site Links</h2>

    <div class="content">
        <ul class="menu">
            <li class="leaf first"><?php echo CHtml::link( 'Home', Yii::app()->controller->createUrl( '/' ) ); ?></li>
            <li class="leaf first"><?php echo CHtml::link( 'Themes', Yii::app()->controller->createUrl( '/themelist' ) ); ?></li>
            <li class="leaf first"><?php echo CHtml::link( 'Layouts', Yii::app()->controller->createUrl( '/theme/layoutgen' ) ); ?></li>
            <li class="leaf first"><?php echo CHtml::link( 'Contact', Yii::app()->controller->createUrl( '/site/contact' ) ); ?></li>
        </ul>  
    </div>
</div>
      </div> <!-- /footer -->
      	<div class="footer-message">
          &copy; <?php echo date( 'Y', time() ); ?> - Yii Themes. All Rights Reserved. Development by <?php echo CHtml::link( 'mehesz.net', 'http://mehesz.net', array( 'target' => '_blank' ) ); ?>. Design by <?php echo CHtml::link( 'Matt K', 'http://mattkelliher.com', array( 'target' => '_blank' ) ); ?>.
		</div>
		<div class="footer-message">
			<a href="<?php echo Yii::app()->controller->createUrl('/site/index'); ?>" title="Yii Themes - because some things are better in color" rel="home" id="logo"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/yiithemes_logo_new_small.png" alt="Yii Themes - because some things are better in color"></a>
		</div>
    </div> <!-- /footer-wrapper -->
  </div> <!-- /page -->



</body>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-5417349-5");
pageTracker._trackPageview();
} catch(err) {}</script>

</html>
