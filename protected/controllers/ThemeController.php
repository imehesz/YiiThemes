<?php

class ThemeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to 'column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='main';

    /**
     * hmmm
     **/
    public $pretty_theme_name;

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','download', 'layoutgen'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','trash','ajaxDelete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','ajaxDelete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
        // we add +1 to the view column ...
        $model = $this->loadModel();
        $model->setAttribute( 'viewed', $model->viewed+1 );
        $model->skipUpdated = true;
        
        $model->save();

        $this->pageTitle = 'Yii Themes - ' . $model->name;

        // we need to find the NEXT and the PREVIOUS theme
		// so we can create cool links ...
		$next_theme = Theme::model()->find( 'id>' . $model->id . ' ORDER BY id' );
		$prev_theme = Theme::model()->find( 'id<' . $model->id . ' ORDER BY id DESC' );

		$this->render('view',array(
			'model'			=> $model,
			'wikiext' 		=> new wikiext(),
			'next_theme'	=> $next_theme,
			'prev_theme'	=> $prev_theme
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Theme;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Theme']))
		{
			$model->attributes=$_POST['Theme'];
			
			// TODO make this prettier here
			// we're gonna create 3 random names for the files ...
			
            if( $model->validate() )
            {
                $model->handleFiles( $model );
    
                if( $model->save() )
                {
                    $this->redirect(array('view','id'=>$model->id));
                }
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		//Yii::app()-user->isAdmin(); 
        if( $model->userID != Yii::app()->user->id )
        {
            throw new CHttpException(301,'You do not have permission to update this theme.');
        }

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Theme']))
		{
			$model->attributes=$_POST['Theme'];

            if( $model->validate() )
            {
                $model->handleFiles( $model );

                if($model->save())
                    $this->redirect(array('view','id'=>$model->id));
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

    /**
     *
     */
    public function actionTrash()
    {
        $model = $this->loadModel();

        if( $model && $model->userID == Yii::app()->user-id )
        {
            $model->setAttribute( 'deleted', 1 );
            if( $model -> save() )
            {
                $this->redirect( array('theme/index', array( 'uid' => Yii::app()->user->id ) ) );
            }
        }
        else
        {
            throw new CHttpException( 301, 'Oops. You do not have permission to do this!' );
        }
        Yii::app()->end();
    }

    /**
     * deletion of a theme, via ajax ... we die no matter what ...
     */
    public function actionAjaxDelete()
    {
        $model = $this->loadModel();

        if( $model && $model->userID == Yii::app()->user->id )
        {
            $model->setAttribute( 'deleted', 1 );
            if( $model -> save() )
            {
                die('success');
            }
        }

        die('fail');
    }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$page_size = 12;

                $uid = Yii::app()->request->getParam( 'uid' );

                if(
                        ! Yii::app()->user->isGuest &&
                        $uid == Yii::app()->user->id
                )
                {
                    $dataProvider=new CActiveDataProvider(
												'Theme', 
												array( 
													'criteria' => array( 'condition' => 'deleted=0 AND userID='.(int)$uid, 'order' => 'created DESC' ) ,
													'pagination' => array( 'pageSize' => $page_size ) 
												));
                }
                else
                {
                    $dataProvider=new CActiveDataProvider(
												'Theme', 
												array( 
													'criteria' => array( 'condition' => 'deleted=0', 'order' => 'created DESC' ), 
													'pagination' => array( 'pageSize' => $page_size ) 
												) );
                }

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Theme('search');
		if(isset($_GET['Theme']))
			$model->attributes=$_GET['Theme'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

    public function actionDownload()
    {
        $model=$this->loadModel();

        if( $model )
        {
            if( file_exists( MEHESZ_FILES_FOLDER . $model->file ) )
            {
                $model->setAttribute( 'downloaded', $model->downloaded+1 );
                $model->skipUpdated = true;
                $model->save();

                $file = MEHESZ_FILES_FOLDER . $model->file;
                //die( $file );

                header("Expires: Mon, 26 Jul 1997 05:00:00 GMT\n");
                header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
                header("Content-type: application/zip;\n"); //or yours?
                header("Content-Transfer-Encoding: binary");
                $len = filesize($filename);
                header("Content-Length: $len;\n");
                $outname= "yiitheme" . $model->id . ".zip";
                header("Content-Disposition: attachment; filename=\"$outname\";\n\n");

                readfile( $file );
            }
        }

        die( 'white death' );
    }

    /**
     * @param $url string
     * 
	 * !!! no longer supported !!!
	 * use Controller::makeMePretty instead!
	 *
     * return beautified string
     **/
    public function makeMePretty_old( $string )
    {
		return;
        $retval = strtolower( $string );
        // $this->url=strtr($this->url, "áéíóöőúüű", "aeiooouuu");
        $retval = trim(preg_replace(array('/[^a-z0-9-]/', '/-+/'), array('-','-'), $retval), '-');
        
        return $retval;
    }

    /**
     * actionLayoutgen 
     * 
     * @access public
     * @return void
     */
    public function actionLayoutgen()
    {
        $this->render( 'layoutgen' );
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Theme::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}

        $this->pretty_theme_name = $this->makeMePretty( $this->_model->name );

		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='theme-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
