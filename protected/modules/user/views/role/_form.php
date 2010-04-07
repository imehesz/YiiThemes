<div class="form">

<?php echo CHtml::beginForm(); ?>

	<p class="note"><?php echo Yii::t("UserModule.user", 'Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo CHtml::errorSummary($model); ?>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'title'); ?>
		<?php echo CHtml::activeTextField($model,'title',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo CHtml::error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'description'); ?>
	        <?php echo CHtml::activeTextArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo CHtml::error($model,'description'); ?>
	</div>	

<p> <?php echo Yii::t('UserModule.user', 'This users have been assigned to this Role:'); ?> </p>

<?php 
		$this->widget('application.modules.user.components.Relation',
			array('model' => $model,
			'relation' => 'users',
//			'style' => 'checkbox',
			'fields' => 'username',
			'hideAddButton' => true
		));  ?>



<div class="row buttons">
<?php echo CHtml::submitButton($model->isNewRecord 
		? Yii::t('UserModule.user', 'Create') 
		: Yii::t('UserModule.user', 'Save')); ?>
		</div>

		<?php echo CHtml::endForm(); ?>

		</div><!-- form -->
