<?php
$this->breadcrumbs=array(
		Yii::t('UserModule.user', 'Messages')=>array('index'),
		Yii::t('UserModule.user', 'My Inbox'),
		);

$this->menu=array(
		array(
			'label'=>Yii::t('UserModule.user', 'Compose new Message'),
			'url'=>array('compose')
			),
		array(
			'label'=>Yii::t('UserModule.user', 'Back to profile'),
			'url'=>array('user/profile')
			)

		);
?>

<h1> <?php echo Yii::t('UserModule.user', 'My Inbox');?> </h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'messages-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'type' => 'raw',
			'name' => Yii::t('UserModule.user', 'from'),
			'value' => 'CHtml::link($data->from_user->username, array("user/profile", "id" => $data->from_user_id))'
		),
		array(
			'type' => 'raw',
			'name' => Yii::t('UserModule.user', 'title'),
			'value' => '$data->getTitle()',
		),
		array(
			'class'=>'CButtonColumn',
			'template' => '{view}{delete}',
		),
	),
)); ?>
