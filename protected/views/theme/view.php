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
<p style="margin-top:15px;"></p>
<div style="border-bottom:1px solid #999;width:675px;">
<?php
    $tabs = array( 'Short Description' => nl2br($model->short_desc) );
    
    if( strlen( $model->long_desc ) )
    {
        $tabs['Long Description'] = nl2br($model->long_desc); 
    }
    
    $this->widget('zii.widgets.jui.CJuiTabs', array( 'tabs'=> $tabs ) );
?>
</div>
<p style="margin-top:15px;"></p>
<h2>Screenshots</h2>
<div class="theme-screenshots">
    <div style="float:left;margin-right:20px;">
        <a class="grouped_elements" rel="group1" href="<?php echo Yii::app()->request->baseUrl . '/files/screenshots/'.$model->preview1;?>"><img src="<?php echo Yii::app()->request->baseUrl . '/files/screenshots/'.$model->preview1;?>" width="250px" height="150px" /></a>
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
    <?php echo CHtml::link( $model->file, '/files/'.$model->file ) ?>
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
