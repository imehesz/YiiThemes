<?php $image_magic_path = str_replace( 'index.php', 'image.php', $_SERVER['PHP_SELF'] ); ?>
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

<table border="0">
<?php 
	$themes = $dataProvider->getData();
	if( sizeof( $themes ) ) : ?>
		<?php $cur_col = 1; $cur_theme = 0; foreach( $themes as $theme ): ?>
			<?php
				$image = '/files/screenshots/' . $theme->preview1;
			   
				if( ! $theme->preview1 )
				{
					$image = Yii::app()->request->baseUrl.'/images/nocamera_mini.png';
				}
			?>

			<?php if( $cur_col == 1 ) : ?>
				<tr>
			<?php endif; ?>
				<td id="theme_id_<?php echo $theme->id?>" style="text-align:center;">
					<div class="theme-grid-box">
						<div class="theme-preview">
							<a href="<?php echo $this->createUrl( 'theme/view', array( 'id' => $theme->id, 'title' => $this->makeMePretty( $theme->name ) ) ); ?>" alt="<?php echo $theme->name;?>" title="<?php echo $theme->name; ?>" >
								<?php echo CHtml::link( CHtml::image( $image_magic_path . '?width=310&height=174&cropratio=310:174&image=' . $image , null, array( 'width' => '310', 'height' => '174', 'title' => $theme->name ) ), Yii::app()->controller->createUrl( 'theme/view', array( 'id' => $theme->id ) ) ); ?>
							</a>
						</div>
						<div class="theme-text">
							<?php echo CHtml::link( $theme->name, $this->createUrl( 'theme/view', array( 'id' => $theme->id, 'title' => $this->makeMePretty( $theme->name ) ) ) ); ?> <span style="font-style:italic;">by <?php echo $theme->user->username; ?></span>
						</div>
					</div>
				</td>
			<?php if( 2 == $cur_col ) : ?>
				</tr>
			<?php $cur_col=0; endif; ?>
			<?php if( $cur_theme == 3 || $cur_theme == 7 ) : ?>
				<tr>
					<td colspan="2" align="center" style="padding:10px;">
						<script type="text/javascript"><!--
							google_ad_client = "pub-1319358860215477";
							/* ads for yii themes */
							google_ad_slot = "2805546600";
							google_ad_width = 468;
							google_ad_height = 60;
							//-->
							</script> 
							<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script> 
					</td>
				</tr>
			<?php endif; ?>
		<?php $cur_col++; $cur_theme++; endforeach; ?>
	<?php endif; ?>
<?php
	/*
	$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); */
?>
</table>

<div style="width:100%;text-align:right;margin-top:15px;">
	<?php $this->widget('CLinkPager',array('pages'=>$dataProvider->pagination, 'cssFile' => Yii::app()->theme->baseUrl . '/css/pager.css' )); ?>
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
