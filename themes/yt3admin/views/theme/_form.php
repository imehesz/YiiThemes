<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'theme-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array( 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal well'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

  <?php if ( $model->hasErrors() ) : ?>
    <div class="alert alert-error">
      <?php echo $form->errorSummary($model); ?>
    </div>
  <?php endif; ?>
	<div class="control-group">
		<div class="control-label"><?php echo $form->labelEx($model,'name'); ?></div>
    <div class="controls">
  		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
	  	<span class="label label-important"><?php echo $form->error($model,'name'); ?></span>
    </div>
	</div>

	<div class="control-group">
		<div class="control-label"><?php echo $form->labelEx($model,'short_desc'); ?></div>
    <div class="controls">
      <?php echo $form->textArea($model,'short_desc', array( 'cols' => 50 ) ); ?>
      <span class="label label-important"><?php echo $form->error($model,'short_desc'); ?></span>
    </div>
	</div>

	<div class="control-group">
		<div class="control-label"><?php echo $form->labelEx($model,'long_desc'); ?></div>
    <div class="controls">
      <?php echo $form->textArea($model,'long_desc', array( 'cols' => 50, 'rows' => 5 ) ); ?>
      <div>
        <small>
          <strong>**bold**</strong>, <em>_italic_</em>, [LINK](http://to-site.com)
        </small>
      </div>
    </div>
	</div>

	<div class="control-group">
		<div class="control-label"><?php echo $form->labelEx($model,'preview1'); ?></div>
    <div class="controls">
      <?php echo $form->fileField($model,'realPreview1' ); ?>
      <?php echo $form->error($model,'realPreview1'); ?>
      <p class="hint">classic image files like jpg, png or gif (<256K)</p>
      <?php if( $model->preview1 ) : ?>
          <div><img src="<?php echo Yii::app()->request->baseUrl . '/files/screenshots/'.$model->preview1;?>" width="80px" height="50px" /></div>
      <?php endif; ?>
    </div>
	</div>


	<div class="control-group">
    <div class="normal-zip-support">
  		<div class="control-label"><?php echo $form->labelEx($model,'file'); ?></div>
      <div class="controls">
        <?php echo $form->fileField($model,'realFile'); ?>
        <?php echo $form->error($model,'realFile'); ?>
        <p class="hint">only zip files (<1M)</p>
        <?php if( $model->file ) : ?>
            <div><img src="<?php echo Yii::app()->request->baseUrl . '/images/icon_zip.gif'?>" alt="this theme has a ZIP file" title="this theme has a ZIP file"/></div>
        <?php endif; ?>
      </div>
    </div>
      <?php if ( property_exists($model, "externalZipSupport" ) ) : ?>
        <div class="external-zip-support-wrapper">
          <div class="controls external-zip-support-help"><a href="javascript:void(0);">Click if file is over 1MB</a></div>
          <div class="external-zip-support-form-field">
            <div class="control-label">File</div>
            <div class="controls">
              <?php echo $form->textField($model, "file", array("class"=>"input-xlarge"));?> <a class="cancel-external-zip" href="javascript:void(0);">Cancel</a>
        	  	<span class="label label-important"><?php echo $form->error($model,'file'); ?></span>
              <p class="hint">
                If your file is larger than 1MB, you can use <br/>an external source and paste the link above
              </p>
            </div>
          </div>
        </div>
        <?php
          Yii::app()->clientScript->registerScript("externalZipSupport", '
            var externalZip = ' . ($model->isZipExternal() ? 'true': 'false') . ';
            var hideExternalZipSupport = function(){
              $(".external-zip-support-form-field").hide();
              $(".external-zip-support-help").show();
              $(".normal-zip-support").show();
              $("#ThemePattern_externalZip").val("");
            };

            var hideNormalZipSupport = function(){
              $(".normal-zip-support").hide();
              $(".external-zip-support-help").hide();
              $(".external-zip-support-form-field").show();
            }

            $(".external-zip-support-help").click(function(){
              hideNormalZipSupport();
            });

            $(".cancel-external-zip").click(function(){
              hideExternalZipSupport();
            });

            if(externalZip) {
              hideNormalZipSupport();
            }
            else {
              hideExternalZipSupport();
            }
');
        ?>
      <?php endif; ?>
	</div>

	<div class="control-group buttons">
		<div class="controls"><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => "btn btn-warning" )); ?></div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

