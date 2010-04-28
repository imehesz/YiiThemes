<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/slideshow.css" />

<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php // Yii::app()->clientScript->registerCoreScript('jqueryui'); ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.5.3/jquery-ui.min.js" ></script>

<script language="javascript">
	$(document).ready(function(){
		$("#featured > ul").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
	    //$("#featured").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true); 	
	});
</script>

<?php
 /*
<div class="form">
    <div class="successSummary" style="text-align:center;">
        <p>
            <strong>Message:</strong> blah blah blah
        </p>
    </div>
</div>
 *
 */
?>

<h1>Welcome to Yii Themes</h1>

<p>
    As you can probably tell, this site was designed by a <i>developer</i> for <i>designers</i> in the <strong>Yii</strong> community
    who are willing to share their art work for the masses.
</p>

<p>
    There are (currently) <strong>NO restictions</strong>, <strong>NO hidden fees</strong>, <strong>NO rules</strong>,
    the site itself is completely <strong>FREE for everybody</strong>, but for obvious reasons, if you would like to share your work you need to
    <a href="">sign up</a> for an account. We will NOT share your information to a third party, but won't take ANY responsibilities of the content of the site.
    We can
</p>
<div class="boxes-wrapper">
    <div class="box" style="margin-right:10px;">
        <p>You can</p>
        <a href="<?php echo $this->createUrl( '/theme' );?>"><img src="<?php print Yii::app()->request->baseUrl;?>/images/browse.png" border="0" /></a>
        <p>
            or <strong>not</strong>
        </p>
    </div>
    <div class="box">
        <p>Create an account below</p>
        <a href="<?php echo $this->createUrl( '/user/user/registration' ); ?>"><img src="<?php print Yii::app()->request->baseUrl;?>/images/signup.png" border="0" /></a>
        <p>
            or <?php echo CHtml::link( 'login', $this->createUrl( '/user/user/login' ) ); ?>
        </p>
    </div>
    <div style="clear:both;"></div>    
</div>
<?php $themes = Theme::model()->findAllByAttributes( array('deleted'=>0, 'score' => 1000 ), array( 'order'=> 'rand()', 'limit'=>4 ) ); ?>

<div id="featured" style="margin:0 auto;">
	<ul class="ui-tabs-nav">
	    <?php $cnt=0; foreach( $themes as $theme ) : ?>
            <?php 
                $prev_image_mini = Yii::app()->request->baseUrl.'/files/screenshots/' . $theme->preview1;
                if( ! $theme -> preview1 )
                {
                    $prev_image_mini = Yii::app()->request->baseUrl.'/images/nocamera_mini.png';
                }
            ?>	    
            <li class="ui-tabs-nav-item ui-tabs-selected" id="nav-fragment-<?php echo $cnt;?>">
                <a href="#fragment-<?php echo $cnt;?>">
                    <img src="<?php echo $prev_image_mini; ?>" alt="" width="80" height="50" />
                    <span><?php echo $theme->name ?></span>
                </a>
            </li>
	    <?php $cnt++; endforeach; ?>
	</ul>
	
	<?php $cnt=0; foreach( $themes as $theme ) : ?>
        <div id="fragment-<?php print $cnt;?>" class="ui-tabs-panel" style="">
            <?php 
                $prev_image = Yii::app()->request->baseUrl.'/files/screenshots/' . $theme->preview1;
                if( ! $theme->preview1 )
                {
                    $prev_image = Yii::app()->request->baseUrl.'/images/nocamera.png';
                }
            ?>
	        <img src="<?php echo $prev_image; ?>" alt="" width="400" height="250"/>
	        <div class="info" >
	        <h2><?php echo CHtml::link($theme->name, $this->createUrl('theme/view', array('id' => $theme->id) ) ); ?></h2>
	        <p><?php echo $theme->short_desc; ?></p>
	        </div>
        </div>            
    <?php $cnt++; endforeach; ?>
</div>
