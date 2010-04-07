<?php

class Messages extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return isset( Yii::app()->controller->module->messagesTable )
			? Yii::app()->controller->module->messagesTable
			: 'messages';
	}

	public function rules()
	{
		return array(
				array('from_user_id, to_user_id, title', 'required'),
				array('from_user_id, draft, message_read', 'numerical', 'integerOnly'=>true),
				array('title', 'length', 'max'=>45),
				array('message', 'safe'),
				);
	}

	public function getTitle()
	{
		if($this->message_read)
			return $this->title;
		else
			return '<strong>' . $this->title . '</strong>';
	}

	public function relations()
	{
		return array(
				'from_user' => array(self::BELONGS_TO, 'User', 'from_user_id'),
				'to_user' => array(self::BELONGS_TO, 'User', 'to_user_id'),
				);
	}

	public function attributeLabels()
	{
		return array(
				'id' => '#',
				'from_user_id' => Yii::t('UserModule.user', 'From'),
				'to_user_id' => Yii::t('UserModule.user', 'To'),
				'title' => Yii::t('UserModule.user', 'Title'),
				'message' => Yii::t('UserModule.user', 'Message'),
				);
	}

}
