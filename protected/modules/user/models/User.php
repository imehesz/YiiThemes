<?php

class User extends CActiveRecord implements IBehavior
{
	const STATUS_NOTACTIVE=0;
	const STATUS_ACTIVE=1;
	const STATUS_BANNED=-1;
	
	public static $hash='md5';

	public $username;
	public $password;
	public $email;
	public $sendActivationMail=true;
	public $loginNotActive=false;
	public $autoLogin=true;
	public $registrationUrl = array("user/registration");
	public $recoveryUrl = array("user/recovery");
	public $loginUrl = array("user/login");
	public $returnUrl = array("user/profile");
	public $returnLogoutUrl = array("user/login");
	
	// IBehavior
	private $_enabled;
	private $_owner;
	
	public function attach($owner)
	{
		$this->_owner=$owner;
	}
	
	public function detach($owner)
	{
		$this->_owner=null;
	}
	
	public function getEnabled()
	{
		return $this->_enabled;
	}

	public function setEnabled($value)
	{
		$this->_enabled=$value;
	}
	// IBehavior end
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function behaviors() {
		return array( 'CAdvancedArBehavior' => array(
			'class' => 'application.modules.user.components.CAdvancedArBehavior'));
	}


	public function tableName()
	{
		return isset(Yii::app()->controller->module->usersTable)
			? Yii::app()->controller->module->usersTable
			: 'users';
	}

	public function rules()
	{
		return array(
			array('username', 'length', 'max'=>20, 'min' => 3,'message' => Yii::t("UserModule.user", "Incorrect username (length between 3 and 20 characters).")),
			array('password', 'length', 'max'=>128, 'min' => 4,'message' => Yii::t("UserModule.user", "Incorrect password (minimal length 4 symbols).")),
			array('email', 'email'),
			array('username', 'unique', 'message' => Yii::t("UserModule.user", "This user's name already exists.")),
			array('email', 'unique', 'message' => Yii::t("UserModule.user", "This user's email adress already exists.")),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => Yii::t("UserModule.user", "Incorrect symbol's. (A-z0-9)")),
			array('status', 'in', 'range'=>array(0,1,-1)),
			array('superuser', 'in', 'range'=>array(0,1)),
			array('username, password, email, createtime, lastvisit, superuser, status', 'required'),
			array('createtime, lastvisit, superuser, status', 'numerical', 'integerOnly'=>true),
		);
	}

	public function relations()
	{
		return array(
			'profile'=>array(self::HAS_ONE, 'Profile', 'user_id'),
			'roles'=>array(self::MANY_MANY, 'Role', 'user_has_role(user_id, role_id)'),
		);
	}

	public static function hasRole($role)
	{
		if(!is_array($role))
			$role = array ($role);

		$user = CActiveRecord::model('User')->findByPk(Yii::app()->user->getId());
		if(isset($user->roles)) 
			foreach($user->roles as $roleobj) 
			{
				if(in_array($roleobj->title, $role) ||
				  in_array($roleobj->id, $role))
					return true;
			}
		return false;
	}


	public function attributeLabels()
	{
		return array(
			'username'=>Yii::t("UserModule.user", "username"),
			'password'=>Yii::t("UserModule.user", "password"),
			'verifyPassword'=>Yii::t("UserModule.user", "Retype Password"),
			'email'=>Yii::t("UserModule.user", "E-mail"),
			'verifyCode'=>Yii::t("UserModule.user", "Verification Code"),
			'id' => 'Id',
			'activkey' => Yii::t("UserModule.user", "activation key"),
			'createtime' => Yii::t("UserModule.user", "Registration date"),
			'lastvisit' => Yii::t("UserModule.user", "Last visit"),
			'superuser' => Yii::t("UserModule.user", "Superuser"),
			'status' => Yii::t("UserModule.user", "Status"),
		);
	}
	
	/**
	 * @return hash string.
	 */
	public static function encrypt($string="")
	{
		$hash = self::$hash;
		if ($hash=="md5")
			return md5($string);
		if ($hash=="sha1")
			return sha1($string);
		else
			return hash($hash,$string);
	}
	
	public function scopes()
    	{
		return array(
	            'active'=>array(
	                'condition'=>'status='.self::STATUS_ACTIVE,
       		     ),
	            'notactive'=>array(
	                'condition'=>'status='.self::STATUS_NOTACTIVE,
	            ),
	            'banned'=>array(
	                'condition'=>'status='.self::STATUS_BANNED,
	            ),
	            'superuser'=>array(
	                'condition'=>'superuser=1',
    		     ),
	        );
    	}
	
	public static function itemAlias($type,$code=NULL) {
		$_items = array(
			'UserStatus' => array(
				'0' => Yii::t("UserModule.user", 'Not active'),
				'1' => Yii::t("UserModule.user", 'Active'),
				'-1'=> Yii::t("UserModule.user", 'Banned'),
			),
			'AdminStatus' => array(
				'0' => Yii::t("UserModule.user", 'No'),
				'1' => Yii::t("UserModule.user", 'Yes'),
			),
		);
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
	}

	/**
	 * Return admins.
	 * @return array syperusers names
	 */	
	public static function getAdmins() {
		$admins = User::model()->active()->superuser()->findAll();
		$return_name = array();
		foreach ($admins as $admin)
			array_push($return_name,$admin->username);
		return $return_name;
	}
	
	/**
	 * Return admin status.
	 * @return boolean
	 */
	public static function isAdmin() {
		if(Yii::app()->user->isGuest)
			return false;
		else {
			if(User::model()->active()->superuser()->findbyPk(Yii::app()->user->id))
				return true;
			else
				return false;
		}
	}
}
