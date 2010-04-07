<?php

class UserIdentity extends CUserIdentity
{
	private $id;
	const ERROR_EMAIL_INVALID=3;
	const ERROR_STATUS_NOTACTIVE=4;
	const ERROR_STATUS_BANNED=5;

	public function authenticate()
	{
		$loginType = Yii::app()->controller->module->loginType; 

		if ($loginType == 0) // Only check for username
		{
			$user = User::model()->findByAttributes(array('username'=>$this->username));
		}
		else if ($loginType == 1) // Only check for E-Mail address
		{
			$user = User::model()->findByAttributes(array('email'=>$this->username));
		}
		else if ($loginType == 2) // Check for E-Mail address or username
		{
			$user=User::model()->findByAttributes(array('username'=>$this->username));
			if(!is_object($user)) 
				$user=User::model()->findByAttributes(array('email'=>$this->username));
		}

		if($user===null)
			if ($logintype == 1) 
			{
				$this->errorCode=self::ERROR_EMAIL_INVALID;
			}
			else 
			{
				$this->errorCode=self::ERROR_USERNAME_INVALID;
			}
		else if(User::encrypt($this->password)!==$user->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else if($user->status == 0 && Yii::app()->user->loginNotActive==false)
			$this->errorCode=self::ERROR_STATUS_NOTACTIVE;
		else if($user->status==-1)
			$this->errorCode=self::ERROR_STATUS_BANNED;
		else {
			$this->id=$user->id;
			$this->setState('id', $user->id);
			$this->username=$user->username;
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->id;
	}

	public function getRoles() {
		return $this->Role;
	}

}
