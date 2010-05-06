<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="<?php Yii::app()->request->baseUrl;?>/images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" media="screen, projection" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
</head>
<body>
<div id="topPan">
	<?php /*<a href="index.html"><img src="images/105750.JPG" alt="Education Zone" width="245" height="37" border="0"  class="logo" title="Education Zone"/></a> */ ?>
	<?php $images = Array('105750.JPG', 'fashion_mini_1.jpg', 'fashion_mini_2.gif', 'fashion_mini_3.jpg' );?>
	<a href="http://en.wikipedia.org/wiki/Fashion" target="_blank"><img src="<?php Yii::app()->request->baseUrl;?>/images/<?php echo $images[rand(0,sizeof($images)-1)];?>" alt="Education Zone" border="0"  class="logo" title="Education Zone"/></a>
    <a href="/"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/yiithemes_logo.png" style="float:left;" border="0"/></a>
	<p><span style="font-style:italic;">"your first step to be ridiculously good looking</span>"</p>
		
  <div id="topContactPan">
  </div>
	<div id="topMenuPan">
	  <div id="topMenuLeftPan"></div>
	  
	  <div id="topMenuMiddlePan">
		<?php /*$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/user/user/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); */ ?>
		<ul>
			<li class="home"><?php print CHtml::link( 'Home', $this->createUrl( '/site/index' ) ); ?></li>
			<li><?php print Yii::app()->user->isGuest?CHtml::link( 'Themes', $this->createUrl( 'theme/index' ) ):CHtml::link( 'My Themes', $this->createUrl('theme/index', array('uid' => Yii::app()->user->id) ) ); ?></li>
			<li><?php print Yii::app()->user->isGuest?CHtml::link( 'Login', $this->createUrl( '/user/user/login' ) ) : CHtml::link( 'Logout', $this->createUrl( '/user/user/logout' ) ); ?></li>
            <li><a href="javascript:void(0);" onclick="javascript:alert( 'imehesz [at] mehesz.net' );">Contact</a> </li>
		</ul>
		<?php /*<ul>
			<li class="home">Home</li>
			<li><a href="#">About us</a></li>
			<li><a href="#">Support</a></li>
			<li><a href="#">books</a></li>
			<li><a href="#">university</a></li>
			<li><a href="#">Blog</a></li>
			<li><a href="#">ideas</a></li>
			<li class="contact"><a href="#" class="contact">Contact</a></li>
		</ul>*/ ?>
	  </div>
	  <div id="topMenuRightPan"></div>
	</div>
</div>

<div id="bodyPan">
    <?php /*
  <?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->
	*/ 
	?>
  <div id="bodyLeftPan">
  
	<div id="main_content">
		<?php print $content; ?>
	</div>

<?php /*
  	<h2><span>why</span> education zone</h2>
	<p>Education Zone is a free, tableless, W3C-compliant web design layout by <span>Template World</span>. This template has been tested and proven compatible with all major browser environments and operating systems. You are free to modify the design to suit your tastes in any way you like.</p>
	<p>We only ask you to not remove "Design by Template World" and the link <span>http://www.templateworld.com</span> from the footer of the template.</p>
	<p>If you are interested in seeing more of our free web template designs feel free to visit our website, Template World. We intend to add at least 25 new <span>free templates</span> in the coming month.</p>
	<ul>
		<li><a href="#">Ndui et fermentum ullamcorper, purus orci sagittis leo,ac</a> </li>
		<li><a href="#">Ndui et fermentum ullamcorper, purus orci sagittis leo,ac </a></li>
	</ul>
	<p class="more"><a href="#">more</a></p>
	<h3><span>new</span> books</h3>
	
    <div id="bookcatagories">
	  <div id="namePan">Name</div>
	  <div id="pricePan">price</div> 
      <div id="discountPan">discount</div>
	  
      <div id="nameonePan">
	  	<ul>
			<li>lorem ipsum dolor</li>
			<li>Amet,conseAdipiscin</li>
			<li>Elit Donec mol</li>
			<li>Bibendum nunc.Lorem</li>
			<li>Lpsum dolor</li>
			<li>Sit amet,Consectetuer</li>
			<li>Adipiscinrt.Integer</li>
			<li>Enim vel mi.Vivamus</li>
			<li>Atmi.Ut</li>
		</ul>
	  </div>
		
      <div id="priceonePan">
	  	<ul>
			<li>$20</li>
			<li>$20</li>
			<li>$25</li>
			<li>$20</li>
			<li>$35</li>
			<li>$30</li>
			<li>$29</li>
			<li>$40</li>
			<li>$25</li>
		</ul>
	  </div>
	  
      <div id="discountonePan">
	  	<ul>
			<li>10%</li>
			<li>10%</li>
			<li>10%</li>
			<li>10%</li>
			<li>15%</li>
			<li>15%</li>
			<li>20%</li>
			<li>20%</li>
			<li>20%</li>
		</ul>
	  </div>
    </div>
	<div id="bodyLeftNextPan">
	<p class="next"><a href="#">next</a></p>
	</div>
  </div>
  */?>
  
 <?php /* 
  <div id="bodyRightPan">
  	<h2><span>few</span> tips</h2>
	<ul>
		<li><a href="#">lorem ipsum dolor sit</a> </li>
		<li><a href="#">Amet, consectetuer</a> </li>
		<li><a href="#">Amet, consectetuer</a> </li>
		<li><a href="#">Bibendum nunc. Lorem</a> </li>
		<li><a href="#">Ipsum dolor sit amet, </a> </li>
		<li><a href="#">Consectetuer adipiscinrt.</a> </li>
		<li><a href="#">Integer porta enim vel mi.</a> </li>
		<li><a href="#">Vivamus at mi.Ut</a> </li>
	</ul>
		<h3><span>latest</span> updates</h3>
		<p class="boldtext">on 03rd october 2006</p>
		<p>lorem ipsum dolor sit Ametert, consectetue Adipiscingelitedo mol Bibendum</p>
	<p class="more"><a href="#">more</a></p>
	
		<p class="boldtext">on 03rd october 2006</p>
		<p>lorem ipsum dolor sit Ametert, consectetue Adipiscingelitedo mol Bibendum</p>
		<p class="more"><a href="#">more</a></p>
  </div>
  */ ?>
</div>

<div id="footermainPan">
  <div id="footerPan">
  	<ul>
		<li><a href="/">Home</a>| </li>
                <li><a href="javascript:void(0);" onclick="javascript:alert( 'imehesz [at] mehesz.net' );">Contact</a> </li>
	</ul>
        <p class="copyright">&copy; Yii Themes</p>
	<ul class="templateworld">
  	<li>design by:</li>
	<li><a href="http://www.templateworld.com" target="_blank">Template World</a></li>
  </ul>
<?php /*  <div id="footerPanhtml"><a href="http://validator.w3.org/check?uri=referer" target="_blank">HTML</a></div>
    <div id="footerPancss"><a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank">css</a></div>
	*/ ?>
  </div>
</div>
	<div style="text-align:center;margin:20px;">
	  	<a href="http://mehesz.net" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/mehesz.net.png" /></a>
  		<a href="http://yiiframework.com" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/yii_power_lightgrey_white.gif" /></a>
	</div>
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
