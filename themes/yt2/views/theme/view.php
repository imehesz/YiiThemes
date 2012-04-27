<?php $image_magic_path = str_replace( 'index.php', 'image.php', $_SERVER['PHP_SELF'] ); ?>
<h1 class="ucase"><?php echo $model->name; ?></h1>
<div class="date-on-theme">by <strong><?php echo User::model()->findByPk($model->userID)->username; ?></strong> on <?php echo date( 'F d, Y', $model->updated ) ; ?></div>
<div style="float:right;text-align:right;">
    <?php if( $model->score>=1000) : ?>
        <?php echo CHtml::link( 'LIVE Preview', 'http://yiidressingroom.mehesz.net/?themeid=' . $model->id ); ?> - 
    <?php endif; ?>
	<?php 
		// previous theme
		echo 
			$prev_theme ? 
				CHtml::link( 'Prev Theme', $this->createUrl('theme/view', array( 'id' => $prev_theme->id, 'title' => $this->makeMePretty( $prev_theme->name ) ) ), array( 'title' => 'Previous Theme: ' . $prev_theme->name ) ) : 
				'Prev Theme' ; 
	?> - 

	<?php 
		// next theme
		echo 
			$next_theme ? 
				CHtml::link( 'Next Theme', $this->createUrl('theme/view', array( 'id' => $next_theme->id, 'title' => $this->makeMePretty( $next_theme->name ) ) ), array( 'title' => 'Next Theme: ' . $next_theme->name ) ) : 
				'Next Theme' ; 
	?>
	<?php /*
<?php if( $model->userID == Yii::app()->user->id ) : ?>
	<div>
    <a href="<?php print $this->createUrl('theme/update', array( 'id' => $model->id ) );?>"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/update.png" alt="update" title="update"></a>
    <a href="javascript:void(0);" onclick="javascript:deleteTheme('<?php print $this->createUrl('theme/trash', array( 'id' => $model->id ) );?>');"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/delete.png" alt="delete" title="delete"></a>
	</div>
<?php endif; ?>
*/ ?>
</div>
<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo $this->createUrl( '/theme/view', array( 'id' => $model->id, 'title' => $this->makeMePretty( $model->name ) ) ) ;?>&amp;layout=button_count&amp;show_faces=false&amp;width=200&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:21px;" allowTransparency="true"></iframe>
<div style="clear:both;"></div>
<?php $image = '/files/screenshots/' . $model->preview1; ?>
		<?php echo CHtml::link( CHtml::image( $image_magic_path . '?width=640&height=360&cropratio=640:360&image=' . $image, null, array( 'width' => '640', 'height' => '360', 'title' => $model->name ) ), Yii::app()->controller->createUrl( 'theme/view', array( 'id' => $model->id ) ) ); ?>

<div style="text-align:center;margin-top:15px;">
	<script type="text/javascript"><!--
		google_ad_client = "pub-1319358860215477";
		/* ads for yii themes */
		google_ad_slot = "2805546600";
		google_ad_width = 468;
		google_ad_height = 60;
		//-->
	</script>
	<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
</div>

<div style="margin-top:15px;border-bottom:1px solid #999;width:640px;">
<?php
    //$tabs = array( 'Short Description' => $wikiext->parse($model->short_desc));
    $created_nice = date( 'F d, Y', $model->created );
    $updated_nice = date( 'F d, Y', $model->updated );
    $viewed_nice  = number_format( $model->viewed );
    $downloaded_nice = number_format( $model->downloaded );

    $tabs['Stats'] = <<<STATS
<div class="info-row">Author: <span>{$model->user->username}</span></div>
<p></p>
<div class="info-row">Theme created: <span>{$created_nice}</span></div>
<div class="info-row">Last updated: <span>{$updated_nice}</span></div>
<p></p>
<div class="info-row">Viewed: <span>{$viewed_nice}</span></div>
<div class="info-row">Downloaded: <span>{$downloaded_nice}</span></div>
STATS;

	if( $model->file && ThemeUser::model()->canDownloadByIp( $model->id ) )
	{
		// TODO yeah ... we should make this nicer
		$tabs['Download'] = 
		CHtml::openTag( 'div', array( 'style' => 'margin-top:10px;' ) ) .
		CHtml::closeTag( 'div' ) . 
		CHtml::link( 'Click here to download (zip)', $this->createUrl('theme/download', array( 'id' => $model->id ) ), array( 'style' => 'color:#c00;', 'target' => '_blank' ) ) .

		CHtml::openTag( 'div', array( 'style' => 'margin-top:10px;' ) ) .
		CHtml::link( 'Problems?', 'javascript:void(0);', array( 'style' => 'color:#aaa;', 'onclick' => 'javascript:jQuery("#toggleme").toggle();' ) ) .
		CHtml::closeTag( 'div' ) .

		CHtml::openTag( 'span', array( 'style' => 'display:none;', 'id' => 'toggleme' ) ) .
		CHtml::link( 'Please try this direct link.', Yii::app()->request->baseUrl . '/files/' . $model->file ) .
		CHtml::closeTag( 'span' );
	}

    $tabs['Short Description'] = $model->short_desc;
    
    if( strlen( $model->long_desc ) )
    {
        //$tabs['Long Description'] = $wikiext->parse($model->long_desc); 
		$md = new CMarkdown;
        $tabs['Long Description'] = $md->transform( $model->long_desc ); 
    }

/*
	$absolute_url = Yii::app()->controller->createAbsoluteUrl( '/theme/view', array( 'id' => $model->id ) );
    $tabs['Comments'] = <<<COMMENTS
<a name='facebook-comments'></a> 

<div id='fb-root'></div> 
<script type='text/javascript'> 
window.fbAsyncInit = function() {
    FB.init({
appId: '104628982944096',
status: true,
cookie: true,
xfbml: true
});
};

(function() {
 var e = document.createElement('script'); e.async = true;
 e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
 document.getElementById('fb-root').appendChild(e);
 }());
</script> 

<div id='fbComments' style='margin: 20px 0;'> 
<fb:comments xid='4FxbiawkaTsfdcn_post4' numposts='10' width='590' simple='' publish_feed='1' reverse='' css='' send_notification_uid='' title='{$model->name}' url='{$absolute_url}'></fb:comments> 
</div> 
COMMENTS;
*/
	$tabs['Share'] = <<<SHARING
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4dc48dcc77246178"></script>
<!-- AddThis Button END -->
SHARING;

	if( $model->getCommentCount() > 0 )
	{
		$tabs['Comments' . ' (' . $model->getCommentCount() . ')'] = $this->renderPartial('comment.views.comment.commentList', array( 'model'=>$model), true ); 
	}
	else
	{
		$tabs['Comments'] = $this->renderPartial('comment.views.comment.commentList', array( 'model'=>$model), true ); 
	}

    $this->widget('zii.widgets.jui.CJuiTabs', array( 'tabs'=> $tabs ) );
?>
</div>

<script>
    var deleteTheme = function( urlDel )
    {
        conf = confirm( 'Are you sure?' );

        if( conf )
        {
            window.location = urlDel;
        }
        return false;
    }
</script>

<?php return; ?>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.fancybox-1.3.1.css" />
<script src="<?php echo Yii::app()->request->baseUrl;?>/js/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
<script language="javascript">
    $(document).ready(function() {
        $("a.grouped_elements").fancybox();
    });
</script>
<?php
$this->breadcrumbs=array(
	'Themes'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Theme', 'url'=>array('index')),
	array('label'=>'Create Theme', 'url'=>array('create')),
	array('label'=>'Update Theme', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Theme', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure to delete this item?')),
	array('label'=>'Manage Theme', 'url'=>array('admin')),
);
?>

<h1 class="ucase"><?php echo $model->name; ?></h1>
<div class="date-on-theme">by <strong><?php echo User::model()->findByPk($model->userID)->username; ?></strong> on <?php echo date( 'F d, Y', $model->updated ) ; ?></div>
<div style="float:right;text-align:right;">
    <?php if( $model->score>=1000) : ?>
        <?php echo CHtml::link( 'Try it', 'http://yiidressingroom.mehesz.net/?themeid=' . $model->id ); ?> - 
    <?php endif; ?>
	<?php 
		// previous theme
		echo 
			$prev_theme ? 
				CHtml::link( 'Prev Theme', $this->createUrl('theme/view', array( 'id' => $prev_theme->id, 'title' => $this->makeMePretty( $prev_theme->name ) ) ), array( 'title' => 'Previous Theme: ' . $prev_theme->name ) ) : 
				'Prev Theme' ; 
	?> - 

	<?php 
		// next theme
		echo 
			$next_theme ? 
				CHtml::link( 'Next Theme', $this->createUrl('theme/view', array( 'id' => $next_theme->id, 'title' => $this->makeMePretty( $next_theme->name ) ) ), array( 'title' => 'Next Theme: ' . $next_theme->name ) ) : 
				'Next Theme' ; 
	?>
<?php if( $model->userID == Yii::app()->user->id ) : ?>
	<div>
    <a href="<?php print $this->createUrl('theme/update', array( 'id' => $model->id ) );?>"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/update.png" alt="update" title="update"></a>
    <a href="javascript:void(0);" onclick="javascript:deleteTheme('<?php print $this->createUrl('theme/trash', array( 'id' => $model->id ) );?>');"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/delete.png" alt="delete" title="delete"></a>
	</div>
<?php endif; ?>
</div>
<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo $this->createUrl( 'theme/view', array( 'id' => $model->id, 'title' => $this->makeMePretty( $model->name ) ) ) ;?>&amp;layout=button_count&amp;show_faces=false&amp;width=200&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:21px;" allowTransparency="true"></iframe>
<p style="margin-top:35px;"></p>
<div style="border-bottom:1px solid #999;width:675px;">
<?php
    //$tabs = array( 'Short Description' => $wikiext->parse($model->short_desc));
    $tabs = array( 'Short Description' => $model->short_desc );
    
    if( strlen( $model->long_desc ) )
    {
        //$tabs['Long Description'] = $wikiext->parse($model->long_desc); 
        $tabs['Long Description'] = $model->long_desc; 
    }

    $created_nice = date( 'F d, Y', $model->created );
    $updated_nice = date( 'F d, Y', $model->updated );
    $viewed_nice  = number_format( $model->viewed );
    $downloaded_nice = number_format( $model->downloaded );

    $tabs['Stats'] = <<<STATS
<div class="info-row">Author: <span>{$model->user->username}</span></div>
<p></p>
<div class="info-row">Theme created: <span>{$created_nice}</span></div>
<div class="info-row">Last updated: <span>{$updated_nice}</span></div>
<p></p>
<div class="info-row">Viewed: <span>{$viewed_nice}</span></div>
<div class="info-row">Downloaded: <span>{$downloaded_nice}</span></div>
STATS;

    /*
    $tabs['Comments'] = <<<COMMENTS
<a name='facebook-comments'></a> 

<div id='fb-root'></div> 
<script type='text/javascript'> 
window.fbAsyncInit = function() {
    FB.init({
appId: '104628982944096',
status: true,
cookie: true,
xfbml: true
});
};

(function() {
 var e = document.createElement('script'); e.async = true;
 e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
 document.getElementById('fb-root').appendChild(e);
 }());
</script> 

<div id='fbComments' style='margin: 20px 0;'> 
<p style='margin-bottom: 15px; font-size: 140%; font-weight: bold; border-bottom: 2px solid #000; padding-bottom: 5px;'>Comments:</p> 
<fb:comments xid='4FxbiawkaTsfdcn_post4' numposts='10' width='590' simple='' publish_feed='1' reverse='' css='' send_notification_uid='' title='{$model->name}' url='http://localhost/p/wp/?p=4'></fb:comments> 
</div> 
COMMENTS;
    */
    $this->widget('zii.widgets.jui.CJuiTabs', array( 'tabs'=> $tabs ) );
?>
</div>
<?php /*
<p style="margin-top:15px;"></p>
<h2>Screenshots</h2>
<div class="theme-screenshots">
    <div style="float:left;margin-right:20px;">
        <?php if( $model->preview1 ) : ?>
			<?php $imagecache = Yii::app()->image->createUrl( '250x175', MEHESZ_FILES_FOLDER . 'screenshots/' . $model->preview1 ); ?>
            <a class="grouped_elements" rel="group1" href="<?php echo Yii::app()->request->baseUrl . '/files/screenshots/'.$model->preview1;?>"><img src="<?php echo str_ireplace( 'index.php', '', $imagecache ); ?>" /></a>
        <?php endif; ?>
    </div>
    <div style="">
        <?php if( $model->preview2 ) : ?>
			<?php $imagecache = Yii::app()->image->createUrl( '250x175', MEHESZ_FILES_FOLDER . 'screenshots/' . $model->preview2 ); ?>
            <a class="grouped_elements" rel="group1" href="<?php echo Yii::app()->request->baseUrl . '/files/screenshots/'.$model->preview2;?>"><img src="<?php echo str_ireplace( 'index.php', '', $imagecache ); ?>" /></a>
        <?php endif; ?>
    </div>
    <div style="clear:both;"></div>
</div>
*/ ?>
</div>

<div>
    <!-- AddThis Button BEGIN -->
    <a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4cf7d7190e31e605"><img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a>
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4cf7d7190e31e605"></script>
    <!-- AddThis Button END -->
</div>
<p></p>
<h2>Download Theme</h2>
<?php if( $model->file ) : ?>
    <div>
        <?php echo CHtml::link( 'Click here to download (zip)', $this->createUrl('theme/download', array( 'id' => $model->id ) ) ) ?>
    </div>
<?php else: ?>
    No file. Sorry :/
<?php endif;?>

<script>
    var deleteTheme = function( urlDel )
    {
        conf = confirm( 'Are you sure?' );

        if( conf )
        {
            window.location = urlDel;
        }
        return false;
    }

</script>
