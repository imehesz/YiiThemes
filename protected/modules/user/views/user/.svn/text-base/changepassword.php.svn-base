<?php $this->pageTitle=Yii::app()->name . ' - '.Yii::t("UserModule.user", "Change Password");
$this->breadcrumbs=array(
	Yii::t("UserModule.user", "Profile") => array('/user/profile'),
	Yii::t("UserModule.user", "Change Password"),
	);
?>

<?php
$this->menu = array(
		array(
			'label' => Yii::t('UserModule.user', 'Back to profile'),
			'url' => array('profile')
			)
		);

?>

<h1><?php echo Yii::t("UserModule.user", "Change Password"); ?></h1>


<div class="form">
<?php echo CHtml::beginForm(); ?>

	<p class="note"><?php echo Yii::t("UserModule.user", 'Fields with <span class="required">*</span> are required.'); ?></p>
	<?php echo CHtml::errorSummary($form); ?>
	
	<div class="row">
	<?php echo CHtml::activeLabelEx($form,'password'); ?>
	<?php echo CHtml::activePasswordField($form,'password'); ?>
	<p class="hint">
	<?php echo Yii::t("UserModule.user", "Minimal password length 4 symbols."); ?>
	</p>
	</div>
	
	<div class="row">
	<?php echo CHtml::activeLabelEx($form,'verifyPassword'); ?>
	<?php echo CHtml::activePasswordField($form,'verifyPassword'); ?>
	</div>
	
	
	<div class="row submit">
	<?php echo CHtml::submitButton(Yii::t("UserModule.user", "Save")); ?>
	</div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->
