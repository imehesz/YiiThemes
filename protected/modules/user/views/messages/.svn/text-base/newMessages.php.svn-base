<?php 

$newMessages = Messages::model()->findAll('to_user_id = :to and message_read = 0',
		array( ':to' => Yii::app()->user->id)
		);

if($newMessages) {
	echo '<div class="success">';

	echo Yii::t('UserModule.user', 'You have new Messages !');

	echo '<ul>';
	foreach($newMessages as $message) {
		printf("<li>%s</li>", CHtml::link($message->title, array('messages/view', 'id' => $message->id)));
	}
	echo '</ul>';
	echo '</div>';
} 

?>
