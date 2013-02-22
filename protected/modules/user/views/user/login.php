<?php
if(!isset($model)) 
	$model = new UserLogin();

$this->pageTitle=Yii::app()->name . ' - '.Yii::t("UserModule.user", "Login");
$this->breadcrumbs=array(
	Yii::t("UserModule.user", "Login"),
);
?>

<h1><?php echo Yii::t("UserModule.user", "Login"); ?></h1>

<div class="row">
  <div class="span6">

    <?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

    <div class="success">
      <?php echo Yii::app()->user->getFlash('loginMessage'); ?>
    </div>

    <?php endif; ?>

    <p class="alert alert-info"><?php echo Yii::t("UserModule.user", "Please fill out the following form with your login credentials:"); ?></p>

    <div class="form form-horizontal well">
    <?php echo CHtml::beginForm( '','post',array('id'=>'loginform') ); ?>
      <p class="note"><?php //echo Yii::t("UserModule.user", 'Fields with <span class="required">*</span> are required.'); ?></p>

        <?php if ( $model->hasErrors() ) : ?>
          <div class="alert alert-error">
            <?php echo CHtml::errorSummary($model); ?>
          </div>
        <?php endif; ?>

        <?php 
            // ===========> TODO we need to fix this ASAP! <===============
            // for some reason the error messages are
            // hidden from the user. this is only a
            // quick patch/fix!!!!
        ?>
        <?php if( $model->getError( 'status' ) ): ?>
          <div class="alert alert-error">
              Oops, something is up with your status! Sorry, please try again, or contact us.
          </div>
        <?php endif; ?>

      <div class="control-group">
        <div class="control-label"><?php echo CHtml::activeLabelEx($model,'username'); ?></div>
        <div class="controls"><?php echo CHtml::activeTextField($model,'username') ?></div>
      </div>
      
      <div class="control-group">
        <div class="control-label"><?php echo CHtml::activeLabelEx($model,'password'); ?></div>
        <div class="controls"><?php echo CHtml::activePasswordField($model,'password') ?></div>
      </div>
      
      <div class="control-group">
        <p class="controls">
        <?php echo CHtml::link(Yii::t("UserModule.user", "Registration"),Yii::app()->user->registrationUrl); ?> | <?php echo CHtml::link(Yii::t("UserModule.user", "Lost Password?"),Yii::app()->user->recoveryUrl); ?>
        </p>
      </div>
      
      <div class="control-group rememberMe">
        <div class="control-label"><?php echo CHtml::activeLabelEx($model,'rememberMe'); ?></div>
        <div class="controls"><?php echo CHtml::activeCheckBox($model,'rememberMe'); ?></div>
      </div>

      <div class="control-group submit">
        <div class="controls">
        <?php echo CHtml::submitButton(Yii::t("UserModule.user", "Login"), array( 'class' => 'btn btn-warning' ) ); ?>
        </div>
      </div>
      
    <?php echo CHtml::endForm(); ?>
    </div><!-- form -->


    <?php
    $form = new CForm(array(
        'elements'=>array(
            'username'=>array(
                'type'=>'text',
                'maxlength'=>32,
            ),
            'password'=>array(
                'type'=>'password',
                'maxlength'=>32,
            ),
            'rememberMe'=>array(
                'type'=>'checkbox',
            )
        ),

        'buttons'=>array(
            'login'=>array(
                'type'=>'submit',
                'label'=>'Login',
            ),
        ),
    ), $model);
    ?>
  </div>
  <div class="span6 ad-content">
    <script type="text/javascript"><!--
    google_ad_client = "ca-pub-1319358860215477";
    /* Theme Factory - Login/Register */
    google_ad_slot = "8682381570";
    google_ad_width = 336;
    google_ad_height = 280;
    //-->
    </script>
    <script type="text/javascript"
    src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
    </script>
  </div>

</div>
