<?php
$this->breadcrumbs=array(
	Yii::t("UserModule.user", 'Profile Fields')=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t("UserModule.user", 'Update'),
);
?>

<h1><?php echo Yii::t("UserModule.user", 'Update ProfileField ').$model->id; ?></h1>

<ul class="actions">
	<li><?php echo CHtml::link(Yii::t("UserModule.user", 'Manage User'),array('user/admin')); ?></li>
	<li><?php echo CHtml::link(Yii::t("UserModule.user", 'Create Profile Field'),array('create')); ?></li>
	<li><?php echo CHtml::link(Yii::t("UserModule.user", 'View Profile Field'),array('view','id'=>$model->id)); ?></li>
	<li><?php echo CHtml::link(Yii::t("UserModule.user", 'Manage Profile Field'),array('admin')); ?></li>
</ul><!-- actions -->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
