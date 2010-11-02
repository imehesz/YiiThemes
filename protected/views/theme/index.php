<?php
$this->breadcrumbs=array(
	'Themes',
);

$this->menu=array(
	array('label'=>'Create Theme', 'url'=>array('create')),
	array('label'=>'Manage Theme', 'url'=>array('admin')),
);
?>

<h1>Themes</h1>
<?php if( ! Yii::app()->user->isGuest ) : ?>
    <div style="float:right;">
        <?php echo CHtml::link( 'Add a theme', $this->createUrl('theme/create' ) ); ?>
        <?php /* <img style="" src="<?php print Yii::app()->request->baseUrl;?>/images/icon_mini_add.png" /> */ ?>
    </div>
<?php endif; ?>
<div style="clear:both;"></div>
<div class="form">
    <div class="errorSummary" style="display:none;"><p>Oops. Something happened, please try again.</p></div>
    <div class="successSummary" style="display:none;"><p>You succefully deleted a theme.</p></div>
</div>
<style type="text/css">
	td:hover { background-color: #eee; }
</style>

<?php $this->widget('CLinkPager',array('pages'=>$dataProvider->pagination)); ?>

<table border="0">
<?php 
	$themes = $dataProvider->getData();
	if( sizeof( $themes ) ) : ?>
		<?php $cur_col = 1; foreach( $themes as $theme ): ?>
			<?php
				$prev_image_mini = MEHESZ_FILES_FOLDER . 'screenshots/' . $theme->preview1;
			   
				if( ! $theme->preview1 )
				{
					$prev_image_mini = Yii::app()->request->baseUrl.'/images/nocamera_mini.png';
				}
			?>

			<?php if( $cur_col == 1 ) : ?>
				<tr>
			<?php endif; ?>
				<td id="theme_id_<?php echo $theme->id?>" style="text-align:center;">
					<div class="theme-grid-box">
						<div class="theme-preview">
							<?php /* <a href="<?php echo $this->createUrl( 'theme/view', array( 'id' => $theme->id ) ); ?>" alt="<?php echo $theme->name;?>" title="<?php echo $theme->name; ?>" ><img src="<?php echo $prev_image_mini; ?>" width="125px" height="90px" border="0" /></a> */ ?>
								<?php $imagecache = Yii::app()->image->createUrl( '125x90', $prev_image_mini ); ?>
							<a href="<?php echo $this->createUrl( 'theme/view', array( 'id' => $theme->id ) ); ?>" alt="<?php echo $theme->name;?>" title="<?php echo $theme->name; ?>" >
								<img src="<?php echo $imagecache ? str_ireplace('index.php/','',$imagecache) : $prev_image_mini; ?>" border="0" />
							</a>
						</div>
						<div class="theme-text">
							<?php echo CHtml::link( $theme->name, $this->createUrl( 'theme/view', array( 'id' => $theme->id ) ) ); ?> <span style="font-style:italic;">by <?php echo $theme->user->username; ?></span><br /><?php echo $theme->short_desc;?>
						</div>
					</div>
				</td>
			<?php if( 3 == $cur_col ) : ?>
				</tr>
			<?php $cur_col=0; endif; ?>
		<?php $cur_col++; endforeach; ?>
	<?php endif; ?>

	<tr>
		<td style="text-align:center;">
			<script type="text/javascript"><!--
			google_ad_client = "pub-1319358860215477";
			/* small blocks on Yii Themes */
			google_ad_slot = "1454830931";
			google_ad_width = 200;
			google_ad_height = 200;
			//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
		</td>
		<td style="text-align:center;">
			<script type="text/javascript"><!--
			google_ad_client = "pub-1319358860215477";
			/* small blocks on Yii Themes (2) */
			google_ad_slot = "1194376593";
			google_ad_width = 200;
			google_ad_height = 200;
			//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
		</td>
		<td style="text-align:center;">
			<script type="text/javascript"><!--
			google_ad_client = "pub-1319358860215477";
			/* small blocks on Yii Themes */
			google_ad_slot = "1454830931";
			google_ad_width = 200;
			google_ad_height = 200;
			//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
		</td>
	</tr>
<?php

	/*
	$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); */
?>
</table>

<div style="width:100%;text-align:right;">
<?php $this->widget('CLinkPager',array('pages'=>$dataProvider->pagination)); ?>
</div>

<script>
    var deleteTheme = function( id, urlDel )
    {
        conf = confirm( 'Are you sure?' );

        if( conf )
        {
            $.ajax({
              url: urlDel,
              success: function(data) {
                // $('.result').html(data);
                if( data != 'fail' )
                {
                    // alert('Theme deleted successfully!');
                    $('#theme_row_'+id).hide();
                    $('.successSummary').show();
                    return true;
                }
                else
                {
                    //alert( 'Oops... Please try again!' );
                    $('.errorSummary').show();
                }
              }
            });            
        }
        return false;
    }

</script>
