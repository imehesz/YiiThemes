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
<?php if( $model->userID == Yii::app()->user->id ) : ?>
<div style="float:right;">
    <a href="<?php print $this->createUrl('theme/update', array( 'id' => $model->id ) );?>"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/update.png" alt="update" title="update"></a>
    <?php /* <img src="<?php echo Yii::app()->request->baseUrl;?>/images/delete.png" alt="delete" title="delete"> */ ?>
</div>
<?php endif; ?>
<p style="margin-top:15px;"></p>
<div style="border-bottom:1px solid #999;width:675px;">
<?php
    $tabs = array( 'Short Description' => nl2br($model->short_desc) );
    
    if( strlen( $model->long_desc ) )
    {
        $tabs['Long Description'] = nl2br($model->long_desc); 
    }

    $created_nice = date( 'F d, Y', $model->created );
    $updated_nice = date( 'F d, Y', $model->updated );
    $viewed_nice  = number_format( $model->viewed );
    $downloaded_nice = number_format( $model->downloaded );

    $tabs['Stats'] = <<<STATS
<div class="info-row">Theme created: <span>{$created_nice}</span></div>
<div class="info-row">Last updated: <span>{$updated_nice}</span></div>
<p></p>
<div class="info-row">Viewed: <span>{$viewed_nice}</span></div>
<div class="info-row">Downloaded: <span>{$downloaded_nice}</span></div>
STATS;
    
    $this->widget('zii.widgets.jui.CJuiTabs', array( 'tabs'=> $tabs ) );
?>
</div>
<p style="margin-top:15px;"></p>
<h2>Screenshots</h2>
<div class="theme-screenshots">
    <div style="float:left;margin-right:20px;">
        <?php if( $model->preview1 ) : ?>
            <a class="grouped_elements" rel="group1" href="<?php echo Yii::app()->request->baseUrl . '/files/screenshots/'.$model->preview1;?>"><img src="<?php echo Yii::app()->request->baseUrl . '/files/screenshots/'.$model->preview1;?>" width="250px" height="150px" /></a>
        <?php endif; ?>
    </div>
    <div style="">
        <?php if( $model->preview2 ) : ?>
            <a class="grouped_elements" rel="group1" href="<?php echo Yii::app()->request->baseUrl . '/files/screenshots/'.$model->preview2;?>"><img src="<?php echo Yii::app()->request->baseUrl . '/files/screenshots/'.$model->preview2;?>" width="250px" height="150px" /></a>
        <?php endif; ?>
    </div>
    <div style="clear:both;"></div>
</div>
</div>

<h2>Download Theme</h2>
<div>
    <?php echo CHtml::link( 'Click here to download (zip)', $this->createUrl('theme/download', array( 'id' => $model->id ) ) ) ?>
</div>

<?php /* $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'userID',
		'name',
		'preview1',
		'preview2',
		'score',
		'created',
		'updated',
		'deleted',
	),
)); */ ?>
