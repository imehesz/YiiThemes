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

<h1>Welcome</h1>

<p>
    As you can probably tell, this site was designed by <i>developers</i> for <i>designers</i> in the <strong>Yii</strong> community 
    who are willing to share their art work for the masses.
</p>

<p>
    There are (currently) <strong>NO restictions</strong>, <strong>NO hidden fees</strong>, <strong>NO rules</strong>, the site itself is completely <strong>FREE for everybody</strong>, but for obvious reasons, if you would like to share your work you need to <a href="">sign up</a> for an account. We will NOT share your information to a third part, but won't take ANY responsibility of the content of the site.
</p>
<?php $themes = Theme::model()->findAll(); ?>

<div id="featured" >
	<ul class="ui-tabs-nav">
	    <?php $cnt=0; foreach( $themes as $theme ) : ?>
            <li class="ui-tabs-nav-item ui-tabs-selected" id="nav-fragment-<?php echo $cnt;?>"><a href="#fragment-<?php echo $cnt;?>"><img src="files/screenshots/<?php echo $theme->preview1; ?>" alt="" width="80" height="50" /><span><?php echo $theme->name ?></span></a></li>	        
	    <?php $cnt++; endforeach; ?>
	</ul>
	
	<?php $cnt=0; foreach( $themes as $theme ) : ?>
        <div id="fragment-<?php print $cnt;?>" class="ui-tabs-panel" style="">
	        <img src="files/screenshots/<?php echo $theme->preview1; ?>" alt="" width="400" height="250"/>
	        <div class="info" >
	        <h2><?php echo CHtml::link($theme->name, $this->createUrl('theme/view', array('id' => $theme->id) ) ); ?></h2>
	        <p><?php echo $theme->short_desc; ?></p>
	        </div>
        </div>            
    <?php $cnt++; endforeach; ?>
</div>
