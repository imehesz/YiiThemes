<div class="form">

<?php echo CHtml::beginForm(); ?>

	<p class="note"><?php echo Yii::t("UserModule.user", 'Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo CHtml::errorSummary($model);
		  echo CHtml::errorSummary($profile); ?>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'username'); ?>
		<?php echo CHtml::activeTextField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo CHtml::error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'password'); ?>
		<?php echo CHtml::activePasswordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo CHtml::error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'email'); ?>
		<?php echo CHtml::activeTextField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo CHtml::error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'superuser'); ?>
		<?php echo CHtml::activeDropDownList($model,'superuser',User::itemAlias('AdminStatus')); ?>
		<?php echo CHtml::error($model,'superuser'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'status'); ?>
		<?php echo CHtml::activeDropDownList($model,'status',User::itemAlias('UserStatus')); ?>
		<?php echo CHtml::error($model,'status'); ?>
	</div>
<?php 
		$profileFields=ProfileField::model()->forOwner()->sort()->findAll();
if ($profileFields) 
{
	foreach($profileFields as $field) 
	{
			?>
	<div class="row">
		<?php echo CHtml::activeLabelEx($profile,$field->varname); ?>
		<?php 
		if ($field->field_type=="TEXT") {
			echo CHtml::activeTextArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			echo CHtml::activeTextField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		 ?>
		<?php echo CHtml::error($profile,$field->varname); ?>
	</div>	
			<?php
			}
		}
?>

<div class="row">
<p> <?php echo Yii::t('UserModule.user', 'User belongs to Roles'); ?>: </p>

<?php 
		$this->widget('application.modules.user.components.Relation',
			array('model' => $model,
			'relation' => 'roles',
//			'style' => 'checkbox',
			'fields' => 'title',
			'hideAddButton' => true
		));  ?>

</div>


<div class="row buttons">
<?php echo CHtml::submitButton($model->isNewRecord 
		? Yii::t('UserModule.user', 'Create') 
		: Yii::t('UserModule.user', 'Save')); ?>
		</div>

		<?php echo CHtml::endForm(); ?>

		</div><!-- form -->
