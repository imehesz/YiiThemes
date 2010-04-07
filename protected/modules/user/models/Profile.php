<?php

class Profile extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return Yii::app()->controller->module->profileTable;
	}

	public function rules()
	{
		$required = array();
		$numerical = array();           
		$rules = array();


		$model=ProfileField::model()->forOwner()->findAll();

		foreach ($model as $field) 
		{
			$field_rule = array();
			if ($field->required==1)
				array_push($required,$field->varname);
			if ($field->field_type=='int'||$field->field_type=='FLOAT'||$field->field_type=='INTEGER')
				array_push($numerical,$field->varname);
			if ($field->field_type=='VARCHAR'||$field->field_type=='TEXT') 
			{
				$field_rule = array($field->varname, 'length', 'max'=>$field->field_size, 'min' => $field->field_size_min);
				if ($field->error_message) $field_rule['message'] = Yii::t("UserModule.user", $field->error_message);
				array_push($rules,$field_rule);
			}
			if ($field->field_type=='DATE') 
			{
				$field_rule = array($field->varname, 'type', 'type' => 'date', 'dateFormat' => 'yyyy-mm-dd');
				if ($field->error_message) $field_rule['message'] = Yii::t("UserModule.user", $field->error_message);
				array_push($rules,$field_rule);
			}
			if ($field->match) 
			{
				$field_rule = array($field->varname, 'match', 'pattern' => $field->match);
				if ($field->error_message) $field_rule['message'] = Yii::t("UserModule.user", $field->error_message);
				array_push($rules,$field_rule);
			}
			if ($field->range) 
			{
				$field_rule = array($field->varname, 'in', 'range' => explode(';'.$field->range));
				if ($field->error_message) $field_rule['message'] = Yii::t("UserModule.user", $field->error_message);
				array_push($rules,$field_rule);
			}
			if ($field->other_validator) 
			{
				$field_rule = array($field->varname, $field->other_validator);
				if ($field->error_message) $field_rule['message'] = Yii::t("UserModule.user", $field->error_message);
				array_push($rules,$field_rule);
			}

		}

		array_push($rules,array(implode(',',$required), 'required'));
		array_push($rules,array(implode(',',$numerical), 'numerical', 'integerOnly'=>true));
		return $rules;
	}

	public function relations()
	{
		return array(
				'user' => array(self::BELONGS_TO, 'User', 'user_id')
				);
	}

	public function attributeLabels()
	{
		$labels = array(
				'user_id' => Yii::t("UserModule.user", 'User ID'),
				'profile_id' => Yii::t("UserModule.user", 'Profile ID'),
				);
		$model=ProfileField::model()->forOwner()->findAll();

		foreach ($model as $field)
			$labels[$field->varname] = Yii::t("UserModule.user", $field->title);

		return $labels;
	}


}

