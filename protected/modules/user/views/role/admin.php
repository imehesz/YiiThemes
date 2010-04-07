<?php
$this->breadcrumbs=array(
	Yii::t("UserModule.user", 'Roles')=>array('index'),
	Yii::t("UserModule.user", 'Manage'),
);
?>
	<h1><?php echo Yii::t('UserModule.user', 'Manage Roles'); ?></h1>

<?php
$this->menu = array(
array('label'=>Yii::t('UserModule.user', 'Create Role'), 'url'=>array('create')),
array('label'=>Yii::t('UserModule.user', 'List Roles'), 'url'=>array('index')),
array('label'=>Yii::t('UserModule.user', 'Manage Users'), 'url'=>array('user/admin')),
);
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name' => 'id',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->id),
				array("role/update","id"=>$data->id))',
		),
		array(
			'name' => 'title',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->title),
				array("role/view","id"=>$data->id))',
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
