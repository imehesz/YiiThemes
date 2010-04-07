<?php
$this->breadcrumbs=array(
	Yii::t("UserModule.user", 'Users')=>array('index'),
	Yii::t("UserModule.user", 'Manage'),
);
?>
	<h1><?php echo Yii::t('UserModule.user', 'Manage Users'); ?></h1>

<?php
$this->menu = array(
array('label'=>Yii::t('UserModule.user', 'List User'), 'url'=>array('index')),
array('label'=>Yii::t('UserModule.user', 'Create User'), 'url'=>array('create')),
array('label'=>Yii::t('UserModule.user', 'Manage Roles'), 'url'=>array('role/admin')),
array('label'=>Yii::t('UserModule.user', 'Manage profile Fields'), 'url'=>array('profileField/admin')),
);
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name' => 'id',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->id),array("user/update","id"=>$data->id))',
		),
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->username),array("user/view","id"=>$data->id))',
		),
		array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'CHtml::link(CHtml::encode($data->email), "mailto:".$data->email)',
		),
		array(
			'name' => 'createtime',
			'value' => 'date(UserModule::$dateFormat,$data->createtime)',
		),
		array(
			'name' => 'lastvisit',
			'value' => 'date(UserModule::$dateFormat,$data->lastvisit)',
		),
		array(
			'name'=>'status',
			'value'=>'User::itemAlias("UserStatus",$data->status)',
		),
		array(
			'name'=>'superuser',
			'value'=>'User::itemAlias("AdminStatus",$data->superuser)',
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
