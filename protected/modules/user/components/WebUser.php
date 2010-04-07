<?php

class WebUser extends CWebUser
{
	public $loginUrl=array('/user/user/login');

	public $behaviors = array(
			'User' => array(
				'class' => 'application.modules.user.models.User'));
}
?>
