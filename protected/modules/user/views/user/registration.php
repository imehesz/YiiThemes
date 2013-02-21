<?php $this->pageTitle=Yii::app()->name . ' - '.Yii::t("user", "Registration");
$this->breadcrumbs=array(
	Yii::t("UserModule.user", "Registration"),
);
?>

<div class="span12">
  <h1><?php echo Yii::t("UserModule.user", "Registration"); ?></h1>

  <?php if(Yii::app()->user->hasFlash('registration')): ?>
  <div class="success">
  <?php echo Yii::app()->user->getFlash('registration'); ?>
  </div>
  <?php else: ?>

    <p class="alert alert-info"><?php echo Yii::t("UserModule.user", 'Fields with <span class="required">*</span> are required.'); ?></p>

  <div class="form form-horizontal well">
  <?php echo CHtml::beginForm(); ?>
    

    <?php if ( $form->hasErrors() || $profile->hasErrors() ) : ?>
      <div class="alert alert-error">
        <?php echo CHtml::errorSummary($form); ?>
        <?php echo CHtml::errorSummary($profile); ?>
      </div>
    <?php endif; ?>
    
    <div class="control-group">
      <div class="control-label"><?php echo CHtml::activeLabelEx($form,'username'); ?></div>
      <div class="controls"><?php echo CHtml::activeTextField($form,'username'); ?></div>
    </div>
    
    <div class="control-group">
      <div class="control-label"><?php echo CHtml::activeLabelEx($form,'password'); ?></div>
      <div class="controls"><?php echo CHtml::activePasswordField($form,'password'); ?></div>
      <p class="hint controls">
        <?php echo Yii::t("UserModule.user", "Minimal password length 4 symbols."); ?>
      </p>
    </div>
    
    <div class="control-group">
      <div class="control-label"><?php echo CHtml::activeLabelEx($form,'verifyPassword'); ?></div>
      <div class="controls"><?php echo CHtml::activePasswordField($form,'verifyPassword'); ?></div>
    </div>
    
    <div class="control-group">
      <div class="control-label"><?php echo CHtml::activeLabelEx($form,'email'); ?></div>
      <div class="controls"><?php echo CHtml::activeTextField($form,'email'); ?></div>
    </div>
    
  <?php 
      $profileFields=ProfileField::model()->forRegistration()->sort()->findAll();
      if ($profileFields) {
        foreach($profileFields as $field) {
        ?>
    <div class="control-group">
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
    <?php if(extension_loaded('gd')): ?>
    <div class="control-group">
      <div class="control-label"><?php echo CHtml::activeLabelEx($form,'verifyCode'); ?></div>
      <div class="controls">
        <?php $this->widget('CCaptcha'); ?>
        <?php echo CHtml::activeTextField($form,'verifyCode'); ?>
      </div>
      <p class="hint controls"><?php echo Yii::t("UserModule.user","Please enter the letters as they are shown in the image above."); ?>
      <br/><?php echo Yii::t("UserModule.user","Letters are not case-sensitive."); ?></p>
    </div>
    <?php endif; ?>
    
    <div class="control-group submit">
      <div class="controls">
        <?php echo CHtml::submitButton(Yii::t("UserModule.user", "Register"), array( 'class' => 'btn btn-warning' ) ); ?>
      </div>
    </div>

  <?php echo CHtml::endForm(); ?>
  </div><!-- form -->
  <?php endif; ?>
</div>
