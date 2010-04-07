<?php
$this->breadcrumbs=array(
	Yii::t("UserModule.user", 'Roles')=>array('index'),
	Yii::t("UserModule.user", 'Update'),
);

$this->menu = array(
		array(
			'label' => Yii::t("UserModule.user", 'List Roles'), 
			'url' =>array('index')
			),
		array(
			'label' => Yii::t("UserModule.user", 'Manage Roles'), 
			'url' =>array('admin')
			),
		array(
			'label' => Yii::t("UserModule.user", 'Manage Users'), 
			'url' =>array('user/admin')
			),

		);

?>
<h1><?php echo Yii::t("UserModule.user", "Update Role"); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>