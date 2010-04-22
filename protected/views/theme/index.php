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

<table border="1">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</table>

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