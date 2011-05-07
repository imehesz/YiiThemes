<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- saved from url=(0037)http://tds-dev.tampadigital.com/beta/ -->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr" class="js">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="http://tds-dev.tampadigital.com/beta/misc/favicon.ico" type="image/x-icon">
<meta property="og:title" content="Demo 2010">
<meta property="og:site_name" content="Yii Themes (beta)">
<meta property="og:image" content="http://tds-dev.tampadigital.com/beta/sites/default/files/screenshots/demo_2010.jpg">
  <title>Home | Yii Themes (beta)</title>
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
                  <a href="" title="Home" rel="home" id="logo"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/yiithemes_logo.png" alt="Home"></a>
            </div> <!-- /logo-title -->

            <div id="navigation" class="menu withprimary ">
                <div id="primary" class="clear-block">
                    <?php $this->widget('zii.widgets.CMenu',array(
                        'htmlOptions'   => array( 'class' => 'links primary-links' ),
                        'items'=>array(
                            array('label'=>'Home', 'url'=>array('/')),
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
            <?php /*
            <div id="block-views-front-block_1" class="block block-views">
                <div class="content">
                    <div class="view view-front view-id-front view-display-id-block_1 view-dom-id-1"> 
                        <div class="view-content">
                            <div class="views-row views-row-1 views-row-odd views-row-first views-row-last">
                                <div id="node-57" class="node node-video">
                                    <div id="video-57" class="flowplayer">
                                        <img src="./Home   Yii Themes (beta)_files/demo_2010.jpg" alt="Demo 2010" title="" class="imagecache imagecache-thumb_large" width="640" height="360"> 
                                        <div class="play-button">Play</div>
                                    </div>
                                    <h2 class="teaser-title"><a href="http://tds-dev.tampadigital.com/beta/videos/td-demo-2010">Demo 2010&nbsp;&nbsp;<span class="client">Yii Themes</span></a></h2><div class="social-links clear-block">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /block-views-front-block_1 -->

            <div id="block-views-front-block_2" class="block block-views">
                <div class="content">
                    <div class="view view-front view-id-front view-display-id-block_2 view-dom-id-2">
                        <div class="view-content">
                            <table class="views-view-grid">
                                <tbody>
                                    <tr class="row-1 row-first">
                                        <td class="col-1">
                                            <div id="node-78" class="node node-video">
                                                <a href="http://tds-dev.tampadigital.com/beta/videos/2006-addy-awards-intuitive-mind" class="imagecache imagecache-thumb_med imagecache-linked imagecache-thumb_med_linked"><img src="./Home   Yii Themes (beta)_files/intuitive.jpg" alt="" title="" class="imagecache imagecache-thumb_med" width="310" height="174"></a>
                                                <h3 class="teaser-title">
                                                    <a href="http://tds-dev.tampadigital.com/beta/videos/2006-addy-awards-intuitive-mind">2006 ADDY Awards - The Intuitive Mind</a>
                                                </h3>
                                                <div class="client">
                                                    <a href="http://tds-dev.tampadigital.com/beta/videos/2006-addy-awards-intuitive-mind">American Advertising Federation</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-2">
                                            <div id="node-91" class="node node-video">
                                                <a href="http://tds-dev.tampadigital.com/beta/videos/experience-dali" class="imagecache imagecache-thumb_med imagecache-linked imagecache-thumb_med_linked"><img src="./Home   Yii Themes (beta)_files/dali.jpg" alt="" title="" class="imagecache imagecache-thumb_med" width="310" height="174"></a>
                                                <h3 class="teaser-title">
                                                    <a href="http://tds-dev.tampadigital.com/beta/videos/experience-dali">Experience Dali</a>
                                                </h3>
                                                <div class="client">
                                                    <a href="http://tds-dev.tampadigital.com/beta/videos/experience-dali">The Salvador Dalí Museum</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr> <!-- end of first row -->
                                    <tr class="row-2 row-last">
                                        <td class="col-1">
                                            <div id="node-99" class="node node-video">
                                                <a href="http://tds-dev.tampadigital.com/beta/videos/bikes" class="imagecache imagecache-thumb_med imagecache-linked imagecache-thumb_med_linked">
                                                    <img src="./Home   Yii Themes (beta)_files/lff-bikes.jpg" alt="" title="" class="imagecache imagecache-thumb_med" width="310" height="174">
                                                </a>
                                                <h3 class="teaser-title">
                                                    <a href="http://tds-dev.tampadigital.com/beta/videos/bikes">Bikes</a>
                                                </h3>
                                                <div class="client">
                                                    <a href="http://tds-dev.tampadigital.com/beta/videos/bikes">Schifino Lee</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-2">
                                            <div id="node-80" class="node node-video">
                                                <a href="http://tds-dev.tampadigital.com/beta/videos/2008-addy-awards-pride" class="imagecache imagecache-thumb_med imagecache-linked imagecache-thumb_med_linked">
                                                    <img src="./Home   Yii Themes (beta)_files/addyopener.jpg" alt="" title="" class="imagecache imagecache-thumb_med" width="310" height="174">
                                                </a>
                                                <h3 class="teaser-title">
                                                    <a href="http://tds-dev.tampadigital.com/beta/videos/2008-addy-awards-pride">2008 ADDY Awards - Pride</a>
                                                </h3>
                                                <div class="client">
                                                    <a href="http://tds-dev.tampadigital.com/beta/videos/2008-addy-awards-pride">American Advertising Federation</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- /view-content -->
                    </div> <!-- /view view-front ... -->
                </div> <!-- /content -->
            </div> <!-- /block-view-front-block_2 -->
            */ ?>
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
          &copy; <?php echo date( 'Y', time() ); ?> - Yii Themes. All Rights Reserved. Development by <?php echo CHtml::link( 'mehesz.net', 'http://mehesz.net', array( 'target' => '_blank' ) ); ?>. Design by <?php echo CHtml::link( 'Matt K', 'http://mattkelliher.com', array( 'target' => '_blank' ) ); ?>.</div>
    </div> <!-- /footer-wrapper -->
  </div> <!-- /page -->



</body><lock name="comparo"></lock></html>
