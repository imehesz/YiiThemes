<?php $this->pageTitle=Yii::app()->name . ' - '.
Yii::t("UserModule.user", "Profile");

$this->breadcrumbs=array(
	Yii::t("UserModule.user", "Profile")=>array('profile'),
	Yii::t("UserModule.user", "Edit"),
);
?><h2><?php echo Yii::t("UserModule.user", 'Edit profile'); ?></h2>

<?php
$this->menu = array(
		array(
			'label'=>Yii::t('UserModule.user', 'Manage User'), 
			'url'=>array('admin'),
			'visible' => Yii::app()->user->isAdmin()
			), 
		array(
			'label'=> Yii::t('UserModule.user', 'List User'),
			'url'=>array('list'),
			'visible' => !Yii::app()->user->isAdmin()
			), 
		array(
			'label'=> Yii::t('UserModule.user', 'Profile'),
			'url'=>array('profile')
			),
		array(
			'label' => Yii::t('UserModule.user', 'Edit'),
			'url'=>array('edit')
			), 
		array (
			'label' => Yii::t('UserModule.user', 'Change password'),
			'url'=>array('changepassword')
			),
		array (
				'label' => Yii::t('UserModule.user', 'Logout'),
				'url'=>array('logout'))
		);
		?>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
<div class="form">

<?php echo CHtml::beginForm(); ?>

<p class="note">
<?php echo Yii::t("UserModule.user", 
'Fields with <span class="required">*</span> are required.'); ?></p>

<?php echo CHtml::errorSummary($model);
		  echo CHtml::errorSummary($profile); ?>

<?php 
		$profileFields=ProfileField::model()->forOwner()->sort()->findAll();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
	<div class="row">
		<?php echo CHtml::activeLabelEx($profile,$field->varname);
		if ($field->field_type=="TEXT") {
			echo CHtml::activeTextArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			echo CHtml::activeTextField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		echo CHtml::error($profile,$field->varname); ?>
	</div>	
			<?php
			}
		}
?>
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'username'); ?>
		<?php echo CHtml::activeTextField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo CHtml::error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'email'); ?>
		<?php echo CHtml::activeTextField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo CHtml::error($model,'email'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t("UserModule.user", 'Create') : Yii::t("UserModule.user", 'Save')); ?>
	</div>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->
