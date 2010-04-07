<?php 
$this->breadcrumbs=array(
		Yii::t('UserModule.user', 'Messages')=>array('index'),
		Yii::t('UserModule.user', 'Compose new Message'),
		);


$this->menu = array(
		array(
			'label'=>Yii::t('UserModule.user', 'Back to Inbox'),
			'url'=>array('index')),
		);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'messages-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note"><?php echo Yii::t("UserModule.user", 'Fields with');?> <span class="required">*</span> <?php echo Yii::t("UserModule.user", 'are required');?>.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo CHtml::activeHiddenField($model,'from_user_id',array('value' => Yii::app()->user->id)); ?>

	<div class="row">
		<p> <?php echo Yii::t('UserModule.user', 
		'Select multiple recipients by holding the CTRL key'); ?> </p>

<?php 
		echo CHtml::ListBox('Messages[to_user_id]', isset($_GET['to_user_id'])?$_GET['to_user_id']:"", CHtml::listData( 
		User::model()->active()->findAll(), 'id', 'username'),
			array('multiple' => 'multiple'));
		?>
		<?php echo $form->error($model,'to_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'message'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t("UserModule.user", 'Send') : Yii::t('UserModule.user', 'Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
