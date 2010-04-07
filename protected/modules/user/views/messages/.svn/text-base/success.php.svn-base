<?php 
$this->breadcrumbs=array(
		Yii::t('UserModule.user', 'Messages')=>array('index'),
		Yii::t('UserModule.user', 'Success'),
		);


$this->menu = array(
		array(
			'label'=>Yii::t('UserModule.user', 'Write another Message'),
			'url'=>array('compose')),
		array(
			'label'=>Yii::t('UserModule.user', 'Back to Inbox'),
			'url'=>array('index')),
		);
?>

<p> <?php echo Yii::t('UserModule.User', 'Your Message has been sent.'); ?> </p>

<p> <?php echo CHtml::link(Yii::t('UserModule.user', 'Back to Inbox'), 
array('index')); ?> </p>

<p> <?php echo CHtml::link(Yii::t('UserModule.user', 'Write another Message'), 
array('compose')); ?> </p>
