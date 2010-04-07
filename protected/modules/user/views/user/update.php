<?php
$this->breadcrumbs=array(
	(Yii::t("UserModule.user", 'Users'))=>array('index'),
	$model->username=>array('view','id'=>$model->id),
	(Yii::t("UserModule.user", 'Update')),
);
$this->menu = array(
		array(
			'label' => Yii::t("UserModule.user", 'List User'), 
			'url' =>array('index')
			),
		array(
			'label' => Yii::t("UserModule.user", 'Create User'), 
			'url' =>array('create')
			),
		array(
			'label' => Yii::t("UserModule.user", 'Manage User'), 
			'url' =>array('admin')
			),
		array(
			'label' => Yii::t("UserModule.user", 'Manage Roles'), 
			'url' =>array('role/admin')
			),
		array(
			'label' => Yii::t("UserModule.user", 'View User'), 
			'url' =>array('view', 'id' => $model->id)
			),
		array(
			'label' => Yii::t("UserModule.user", 'Manage Profile Field'), 
			'url' =>array('profileField/admin')
			),


		);


?>

<h1><?php echo Yii::t("UserModule.user", 'Update User')." ".$model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'profile'=>$profile)); ?>
