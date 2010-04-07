<?php
$this->breadcrumbs=array(
	Yii::t("UserModule.user", 'Roles')=>array('index'),
	Yii::t("UserModule.user", 'View'),
);
?>

<?php
$this->menu = array(
array('label'=>Yii::t('UserModule.user', 'Manage Roles'), 'url'=>array('admin')),
array('label'=>Yii::t('UserModule.user', 'Manage Users'), 'url'=>array('user/admin')),
array('label'=>Yii::t('UserModule.user', 'Create Role'), 'url'=>array('create')),
);
?>


<h2> <?php echo $model->title; ?> </h2>
<?php echo $model->description; ?>

<hr />

<?php echo Yii::t('UserModule.User', 'This users belong to this Role : '); ?>

<?php 
if($model->users) {
	foreach($model->users as $user) {
		printf("<li>%s</li>", CHtml::link($user->username, array('user/view', 'id' => $user->id)));

	}
}
else 
{
	echo '<p> None </p>';
}

?>
