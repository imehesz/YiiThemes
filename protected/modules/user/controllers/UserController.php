<?php

class UserController extends Controller
{
	const PAGE_SIZE=10;
	private $_model;

	public function beforeAction($action) 
	{
		$this->layout = Yii::app()->controller->module->layout;
		return true;
	}


	public function filters()
	{
		return array(
				'accessControl', 
				);
	}

	public function accessRules()
	{
		return array(
				array('allow',  
					'actions'=>array('index','view','registration',
						'captcha','login', 'recovery', 'activation'),
					'users'=>array('*'),
					),
				array('allow', 
					'actions'=>array('profile', 'edit', 'logout', 'changepassword'),
					'users'=>array('@'),
					),
				array('allow', 
					'actions'=>array('admin','delete','create','update', 'list', 'assign'),
					'users'=>User::getAdmins(),
					),
				array('deny',  // deny all other users
					'users'=>array('*'),
					),
				);
	}


	public function actions()
	{
		return array(
				'captcha'=>array(
					'class'=>'CCaptchaAction',
					'backColor'=>0xFFFFFF,
					),
				);
	}

	public function actionIndex()
	{
		if(Yii::app()->user->isGuest) 
			$this->actionLogin();
		else if(Yii::app()->user->isAdmin())
			$this->actionList();
		else 
			$this->actionProfile(); 
	}

	public function actionRegistration() 
	{
		$model = new RegistrationForm;
		$profile = new Profile;
		if (($uid = Yii::app()->user->id) === true) 
		{
			$this->redirect(Yii::app()->homeUrl);
		} 
		else 
		{
			if(isset($_POST['RegistrationForm'])) 
			{
				$model->attributes=$_POST['RegistrationForm'];
				//$profile->attributes=$_POST['Profile'];
				if($model->validate()&&$profile->validate())
				{
					$sourcePassword = $model->password;
					$model->password = Yii::app()->user->encrypt($model->password);
					$model->verifyPassword = Yii::app()->user->encrypt($model->verifyPassword);
					$model->activkey = Yii::app()->user->encrypt(microtime().$model->password);
					$model->createtime = time();
					$model->lastvisit = ((Yii::app()->user->autoLogin && Yii::app()->user->loginNotActive) ? time() : 0);
					$model->superuser = 0;
					$model->status = 0;

					if ($model->save()) 
					{
						$profile->user_id = $model->id;
						$profile->save();
						$headers="From: ".Yii::app()->params['adminEmail']."\r\nReply-To: ".Yii::app()->params['adminEmail'];
						$activation_url = 'http://' .
							$_SERVER['HTTP_HOST'] .
							$this->createUrl('user/activation',array(
										"activkey" => $model->activkey, "email" => $model->email)
									);
						mail($model->email,"You registered from " . Yii::app()->name,"Please activate your account go to $activation_url.",$headers);
						if (Yii::app()->user->loginNotActive) 
						{
							if (Yii::app()->user->autoLogin) 
							{
								$identity = new UserIdentity($model->username,$sourcePassword);
								$identity->authenticate();
								Yii::app()->user->login($identity, 0);
								$this->redirect(Yii::app()->user->returnUrl);
							} 
							else 
							{
								Yii::app()->user->setFlash('registration',Yii::t("user",
											"Thank you for your registration. Please check your email or login."));
								$this->refresh();
							}
						} 
						else 
						{
							Yii::app()->user->setFlash('registration',Yii::t("user",
										"Thank you for your registration. Please check your email."));
							$this->refresh();
						}
					}
				}
			}
			$this->render('/user/registration',array('form'=>$model,'profile'=>$profile));
		}
	}


	public function actionLogin()
	{
		$model=new UserLogin;
		// collect user input data
		if(isset($_POST['UserLogin']))
		{
			$model->attributes=$_POST['UserLogin'];
			// validate user input and redirect to previous page if valid
			if($model->validate()) 
			{
				$lastVisit = User::model()->findByPk(Yii::app()->user->id);
				$lastVisit->lastvisit = time();
				$lastVisit->save();
				$this->redirect(Yii::app()->User->returnUrl);
			}
		}
		// display the login form
		$this->render('/user/login',array('model'=>$model,));
	}

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->user->returnLogoutUrl);

	}

	/**
	 * Activation of an user account
	 */
	public function actionActivation () 
	{
		$email = $_GET['email'];
		$activkey = $_GET['activkey'];
		if ($email&&$activkey) {
			$find = User::model()->findByAttributes(array('email'=>$email));
			if ($find->status) 
			{
				$this->render('/user/message',array('title'=>Yii::t("user", "User activation"),'content'=>Yii::t("user", "Your account has been activated.")));
			} 
			elseif($find->activkey==$activkey) 
			{
				$find->activkey = Yii::app()->user->encrypt(microtime());
				$find->status = 1;
				$find->save();
				$this->render('/user/message',array('title'=>Yii::t("user", "User activation"),'content'=>Yii::t("user", "Your account has been activated.")));
			}
			else 
			{
				$this->render('/user/message',array('title'=>Yii::t("user", "User activation"),'content'=>Yii::t("user", "Incorrect activation URL.")));
			}
		}
		else 
		{
			$this->render('/user/message',array('title'=>Yii::t("user", "User activation"),'content'=>Yii::t("user", "Incorrect activation URL.")));
		}

	}

	/**
	 * Change password
	 */
	public function actionChangepassword() {
		$form = new UserChangePassword;
		if (($uid = Yii::app()->user->id) === true) 
		{
			if(isset($_POST['UserChangePassword'])) 
			{
				$form->attributes=$_POST['UserChangePassword'];
				if($form->validate()) 
				{
					$new_password = User::model()->findByPk(Yii::app()->user->id);
					$new_password->password = Yii::app()->user->encrypt($form->password);
					$new_password->activkey=Yii::app()->user->encrypt(microtime().$form->password);
					$new_password->save();
					Yii::app()->user->setFlash('profileMessage',Yii::t("user", "Your new password has been saved."));
					$this->redirect(array("user/profile"));
				}
			} 
			$this->render('/user/changepassword',array('form'=>$form));
		}

	}


	/**
	 * Recover password
	 */
	public function actionRecovery () {
		$form = new UserRecoveryForm;
		if (($uid = Yii::app()->user->id) === true) 
		{
			$this->redirect(Yii::app()->user->returnUrl);
		} 
		else 
		{
			if (isset($_GET['email']) && isset($_GET['activkey'])) {
				$email = $_GET['email'];
				$activkey = $_GET['activkey'];
				$form2 = new UserChangePassword;
				$find = User::model()->findByAttributes(array('email'=>$email));
				if($find->activkey==$activkey) 
				{
					if(isset($_POST['UserChangePassword'])) 
					{
						$form2->attributes=$_POST['UserChangePassword'];
						if($form2->validate()) 
						{
							$find->password = Yii::app()->user->encrypt($form2->password);
							$find->activkey=Yii::app()->user->encrypt(microtime().$form2->password);
							$find->save();
							Yii::app()->user->setFlash('loginMessage',Yii::t("user", "Your new password has been saved."));
							$this->redirect(array("user/login"));
						}
					} 
					$this->render('/user/changepassword',array('form'=>$form2));
				}
				else
				{
					Yii::app()->user->setFlash('recoveryMessage',Yii::t("user", "Incorrect recovery link."));
					$this->redirect('http://' . $_SERVER['HTTP_HOST'].$this->createUrl('user/recovery'));
				}
			}
			else
			{
				if(isset($_POST['UserRecoveryForm'])) 
				{
					$form->attributes=$_POST['UserRecoveryForm'];
					if($form->validate()) 
					{
						$user = User::model()->findbyPk($form->user_id);
						$headers="From: ".Yii::app()->params['adminEmail']."\r\nReply-To: ".Yii::app()->params['adminEmail'];
						$activation_url = 'http://' . $_SERVER['HTTP_HOST'].$this->createUrl('user/recovery',array("activkey" => $user->activkey, "email" => $user->email));
						mail($user->email,"You have requested to be reset. To receive a new password, go to $activation_url.",$headers);
						Yii::app()->user->setFlash('resetPwMessage',Yii::t("user", "Instructions have been sent to you. Please check your eMail."));
						$this->refresh();
					}
				}
				$this->render('/user/recovery',array('form'=>$form));
			}
		}
	}

	public function actionAssign() 
	{
		Relation::handleAjaxRequest($_POST);
	}


	public function actionProfile()
	{
		// Display my own profile:
		if(!isset($_GET['id'])) 
		{
			if (Yii::app()->user->id) 
			{
				$model = $this->loadUser(Yii::app()->user->id);
				$this->render('/user/myprofile',array(
							'model'=>$model,
							'profile'=>$model->profile,
							));
			}
		} 
		else 
		{ // Display a foreign profile:
			$model = $this->loadUser($uid = $_GET['id']);
			$this->render('/user/foreignprofile',array(
						'model'=>$model,
						'profile'=>$model->profile,
						));
		}

	}

	/**
	 * Edits a User.
	 */
	public function actionEdit()
	{
		$model=User::model()->findByPk(Yii::app()->user->id);
		if(!$profile=$model->profile)
			$profile = new Profile();

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$profile->attributes=$_POST['Profile'];

			if($model->validate()&&$profile->validate()) {
				$model->save();
				$profile->save();
				Yii::app()->user->setFlash('profileMessage',Yii::t("user", "Changes are saved."));
				$this->redirect(array('profile','id'=>$model->id));
			}
		}

		$this->render('/user/profile-edit',array(
					'model'=>$model,
					'profile'=>$profile,
					));

	}

	/**
	 * Displays a User
	 */
	public function actionView()
	{
		$model = $this->loadUser();
		$this->render('/user/view',array(
					'model'=>$model,
					));
	}

	/**
	 * Creates a new User.
	 */
	public function actionCreate()
	{
		$model=new User;
		$profile=new Profile;
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->roles = $_POST['User']['Role'];
			$model->activkey=Yii::app()->user->encrypt(microtime().$model->password);
			$model->createtime=time();
			$model->lastvisit=time();

			if( isset($_POST['Profile']) ) 
				$profile->attributes=$_POST['Profile'];
			$profile->user_id = 0;
			if($model->validate() && $profile->validate()) {
				$model->password=Yii::app()->user->encrypt($model->password);
				if($model->save()) 
				{
					$profile->user_id=$model->id;
					$profile->save();
				}
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('/user/create',array(
					'model'=>$model,
					'profile'=>$profile,
					));

	}

	public function actionUpdate()
	{
		$model = $this->loadUser();

		if(($profile=$model->profile) === false) 
			$profile = new Profile();

		if(isset($_POST['User']))
		{
			$model->attributes = $_POST['User'];
			$model->roles = $_POST['User']['Role'];

			if(isset($_POST['Profile'])) 
				$profile->attributes = $_POST['Profile'];

			if($model->validate() && $profile->validate()) 
			{
				$old_password = User::model()->findByPk($model->id);
				if ($old_password->password!=$model->password) 
				{
					$model->password = Yii::app()->user->encrypt($model->password);
					$model->activkey = Yii::app()->user->encrypt(microtime().$model->password);
				}
				$model->save();
				$profile->save();
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('/user/update',array(
					'model'=>$model,
					'profile'=>$profile,
					));
	}


	/**
	 * Deletes a User
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$model = $this->loadUser();
			$model->delete();
			if(!isset($_POST['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');

	}

	public function actionList()
	{
		$dataProvider=new CActiveDataProvider('User', array(
			'pagination'=>array(
					'pageSize'=>self::PAGE_SIZE,
					),
		));

		$this->render('/user/index',array(
					'dataProvider'=>$dataProvider,
					));
	}

	public function actionAdmin()
	{
		$dataProvider=new CActiveDataProvider('User', array(
					'pagination'=>array(
						'pageSize'=>self::PAGE_SIZE,
						),
					));

		$this->render('/user/admin',array(
					'dataProvider'=>$dataProvider,
					));

	}

	/**
	 * Loads the User Object instance
	 */
	public function loadUser($uid = 0)
	{
		if($this->_model === null)
		{
			if($uid != 0)
				$this->_model = User::model()->findByPk($uid);
			elseif(isset($_GET['id']))
				$this->_model = User::model()->findByPk($_GET['id']);
			if($this->_model === null)
				throw new CHttpException(404,'The requested User does not exist.');
		}
		return $this->_model;
	}

}
