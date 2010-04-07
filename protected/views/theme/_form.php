<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'theme-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<?php
    /*
	<div class="row">
		<?php echo $form->labelEx($model,'userID'); ?>
		<?php echo $form->textField($model,'userID'); ?>
		<?php echo $form->error($model,'userID'); ?>
	</div>
    */ ?>
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'short_desc'); ?>
		<?php echo $form->textArea($model,'short_desc', array( 'cols' => 50 ) ); ?>
		<?php echo $form->error($model,'short_desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'long_desc'); ?>
		<?php echo $form->textArea($model,'long_desc', array( 'cols' => 50, 'rows' => 10 ) ); ?>
		<?php echo $form->error($model,'long_desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'preview1'); ?>
		<?php echo $form->textField($model,'preview1',array('size'=>30,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'preview1'); ?>
		<p class="hint">classic image files like jpg, png or gif</p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'preview2'); ?>
		<?php echo $form->textField($model,'preview2',array('size'=>30,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'preview2'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'file'); ?>
		<?php echo $form->textField($model,'file',array('size'=>30,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'file'); ?>
		<p class="hint">only zip files</p>
	</div>	
<?php /*
	<div class="row">
		<?php echo $form->labelEx($model,'score'); ?>
		<?php echo $form->textField($model,'score'); ?>
		<?php echo $form->error($model,'score'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updated'); ?>
		<?php echo $form->textField($model,'updated'); ?>
		<?php echo $form->error($model,'updated'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deleted'); ?>
		<?php echo CHtml::activeDropDownList($model,'deleted', array( 'yes','no' ) ); ?>
		<?php echo $form->error($model,'deleted'); ?>
	</div>
*/ ?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
