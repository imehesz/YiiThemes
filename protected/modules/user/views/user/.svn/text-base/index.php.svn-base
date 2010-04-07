<?php
$this->breadcrumbs=array(
	Yii::t("UserModule.user", "Users"),
);
?>


<?php
$this->menu = array(
array('label'=>Yii::t('UserModule.user', 'Create User'), 'url'=>array('create')),
array('label'=>Yii::t('UserModule.user', 'Manage User'), 'url'=>array('admin')),
array('label'=>Yii::t('UserModule.user', 'Manage Role'), 'url'=>array('role/admin')),
array('label'=>Yii::t('UserModule.user', 'Manage profile Fields'), 'url'=>array('profileField/admin')),
);
?>

	<h1> <?php echo Yii::t('UserModule.user', 'Users: '); ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->username),array("user/profile","id"=>$data->id))',
		),
		array(
			'name' => 'createtime',
			'value' => 'date(UserModule::$dateFormat,$data->createtime)',
		),
		array(
			'name' => 'lastvisit',
			'value' => 'date(UserModule::$dateFormat,$data->lastvisit)',
		),
	),
)); ?>

<?php 
if(Yii::app()->controller->module->debug) 
{
	echo 'Powered by yii-user ' .  Yii::app()->controller->module->version;
}
?>
