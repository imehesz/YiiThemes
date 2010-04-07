<?php

class RoleController extends Controller
{
	private $_model;

	public function beforeAction($action) 
	{
		$this->layout = Yii::app()->controller->module->layout;
		return true;
	}


	public function actionView()
	{
		$model = $this->loadModel();
		$this->render('view',array('model'=>$model));
	}

	public function actionCreate() 
	{

		$model = new Role();
		$this->performAjaxValidation($model);
		if(isset($_POST['Role'])) {
			$model->attributes = $_POST['Role'];
			if($model->save())
				$this->redirect(array('admin'));

		}
		$this->render('create', array('model' => $model));
	}

	public function actionUpdate()
	{
		$model = $this->loadModel();

	 $this->performAjaxValidation($model);

		if(isset($_POST['Role']))
		{
			$model->title = $_POST['Role']['title'];
			$model->description = $_POST['Role']['description'];
			if(isset($_POST['Role']['User'])) 
				$model->users = $_POST['Role']['User'];

		if($model->validate() && $model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionAdmin() 
	{
		$dataProvider=new CActiveDataProvider('Role', array(
			'pagination'=>array(
				'pageSize'=>20,
			),
		));

		$this->render('admin',array(
			'dataProvider'=>$dataProvider,
		));

	}

	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$this->loadModel()->delete();

			if(!isset($_POST['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex()
	{
		$this->actionAdmin();
	}


	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Role::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,Yii::t('App', 'The requested page does not exist.'));
		}
		return $this->_model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='role-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
