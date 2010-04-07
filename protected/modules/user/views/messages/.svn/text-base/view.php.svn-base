<?php
$this->breadcrumbs=array(
		'Messages'=>array('index'),
		$model->title,
		);

$this->menu=array(
		array('label'=>Yii::t('UserModule.user', 'Compose new Message'), 'url'=>array('compose')),
		array('label'=>Yii::t('UserModule.user', 'Delete Message'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('App', 'Are you sure to delete this item?'))),
		array('label'=>Yii::t('UserModule.user', 'Reply to Message'), 'url'=>array('compose', 'to_user_id' => $model->from_user_id)),
		array('label'=>Yii::t('UserModule.user', 'Back to Inbox'), 'url'=>array('index')),
		array('label'=>Yii::t('UserModule.user', 'Back to profile'), 'url'=>array('user/profile')),

		);
?>

<h2> <?php echo Yii::t('UserModule.user', 'Message from ') . 
'<em>' . $model->from_user->username . '</em>';
echo ': ' . $model->title; ?> 
</h2>

<?php echo $model->message; ?>

