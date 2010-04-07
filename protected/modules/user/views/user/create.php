<?php
$this->breadcrumbs=array(
	Yii::t("UserModule.user", 'Users')=>array('index'),
	Yii::t("UserModule.user", 'Create'),
);

$this->menu = array(
		array(
			'label' => Yii::t("UserModule.user", 'List User'), 
			'url' =>array('index')
			),
		array(
			'label' => Yii::t("UserModule.user", 'Manage User'), 
			'url' =>array('admin')
			),
		array(
			'label' => Yii::t("UserModule.user", 'Manage Profile Field'), 
			'url' =>array('profileField/admin')
			),


		);

?>
<h1><?php echo Yii::t("UserModule.user", "Create User"); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'profile'=>$profile)); ?>
