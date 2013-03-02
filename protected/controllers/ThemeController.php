<?php

class ThemeController extends Controller {
	/**
	 * @var string the default layout for the views. Defaults to 'column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='main';

    /**
     * hmmm
     **/
    public $pretty_theme_name;

    public $nestedModels = false;

    public $modelClass = null;

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	public function beforeAction( $action )
	{
    if ( isset( Yii::app()->params['themeModel'] ) ) {
      switch( Yii::app()->params['themeModel'] ) {
        case "ThemeBootstrap": 
          $this->modelClass = ThemeBootstrap::model();
          break;
      }
    }

    if ( ! $this->modelClass ) {
      $this->modelClass = Theme::model();
    }

		return parent::beforeAction( $action );
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'allowIp + download'
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
				'actions'=>array( 'index','view','download', 'layoutgen' ),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','trash','getdelete', 'mythemes' ),
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

	public function filterAllowIp( $filterChain )
	{
		$theme_id = Yii::app()->request->getParam( 'id' );
		if( $theme_id )
		{
			if( ThemeUser::model()->canDownloadByIp( $theme_id ) )
			{
				$filterChain->run();
			}
		}

		throw new CHttpException( '403', 'Oops, it seems like you reached your daily limit to download this theme. Please try again later ;)' );
	}

  public function actionView() {
    // we add +1 to the view column ...
    $model = $this->loadModel();
    $model->setAttribute( 'viewed', $model->viewed+1 );
    $model->skipUpdated = true;

    $model->save();

    $this->pageTitle = $model->name;

    $this->render('view',array( 'model' => $model ));
  }

  public function actionMythemes() {
    Yii::app()->theme = 'yt3admin';

    $criteria = new CDbCriteria;
    $criteria->condition = "userID=:id";
    $criteria->params = array( ':id' => Yii::app()->user->id );
    $criteria->order = "updated DESC";

    $this->render( 'mythemes', array(
      'themes' => new CActiveDataProvider( 
        get_class( $this->modelClass ), 
        array( 
          'criteria' => $criteria, 
          'pagination' => array( 'pageSize' => 15 )
        ) 
      ) 
    ) );
  }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
    Yii::app()->theme = 'yt3admin';
		$model=new $this->modelClass;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST[get_class( $this->modelClass )]))
		{
			$model->attributes=$_POST[ get_class( $this->modelClass ) ];
			
			// TODO make this prettier here
			// we're gonna create 3 random names for the files ...
			
            if( $model->validate() )
            {
                $model->handleFiles( $model );
    
                if( $model->save() )
                {
                    $this->redirect( $this->createUrl( '/theme/view' , array( 'id' => $model->id, 'title' => $this->makeMePretty( $model->name ) ) ) );
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
    Yii::app()->theme = 'yt3admin';
		$model=$this->loadModel();

		//Yii::app()-user->isAdmin(); 
        if( $model->userID != Yii::app()->user->id )
        {
            throw new CHttpException(301,'You do not have permission to update this theme.');
        }

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST[ get_class( $this->modelClass ) ]))
		{
			$model->attributes=$_POST[ get_class( $this->modelClass ) ];

            if( $model->validate() )
            {
                $model->handleFiles( $model );

                if($model->save()) {
                    $this->redirect( $this->createUrl( '/theme/view' , array( 'id' => $model->id, 'title' => $this->makeMePretty( $model->name ) ) ) );
                }
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

        if( $model && $model->userID == Yii::app()->user->id )
        {
            $model->setAttribute( 'deleted', 1 );
            if( $model->save() )
            {
                $this->redirect( array('theme/index' ) );
            }
        }
        else
        {
            throw new CHttpException( 301, 'Oops. You do not have permission to do this!' );
        }
        Yii::app()->end();
    }

    public function actionGetdelete() {
      Yii::app()->theme = 'yt3admin';

      $model = $this->loadModel();
      if( $model && $model->userID == Yii::app()->user->id )
      {
          $model->setAttribute( 'deleted', 1 );
          if( ! $model -> save() ) {
            throw new CHttpException( 301, 'Oops, something unexpected happen :/' );
          }
      }

      $this->redirect( '/theme/mythemes' );
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
		$page_size 	= 11;

    $ad_randomizer = range( 1, $page_size-1 );
    shuffle( $ad_randomizer );
    $ad_slots = array( $ad_randomizer[0], $ad_randomizer[1], $ad_randomizer[2] );

		$uid 		= Yii::app()->request->getParam( 'uid' );
		$addsort 	= '';
		$artist 	= Yii::app()->request->getParam( 'artist' );
		$artist_obj	= null;
		$criteria	= new CDbCriteria;
    $sort = new CSort;
    $sort->defaultOrder = 'created DESC';
    $sort->attributes = array( 'created', 'downloaded', 'viewed' );

		if( $artist )
		{
			$artist_obj = User::model()->findByAttributes( array( 'username' => $artist ) );
			if( $artist_obj )
			{
				$criteria->addCondition( 'userID=:artist_id' );
				$criteria->params[':artist_id'] = $artist_obj->id;
			}
		}

    $sort->applyOrder( $criteria );

    $dataProvider=new CActiveDataProvider(
        get_class( $this->modelClass ), 
        array( 
          'criteria' 		=> $criteria,
          'pagination' 	=> array( 'pageSize' => $page_size ),
    ));

		$this->render('index',array(
			'dataProvider'	=> $dataProvider,
			'artist'		=> $artist_obj,
      'ad_slots'    => $ad_slots,
		));
	}

	/**
	 * Manages all models.
	 */
   /*
	public function actionAdmin()
	{
		$model=new Theme('search');
		if(isset($_GET['Theme']))
			$model->attributes=$_GET['Theme'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
  */

    public function actionDownload()
    {
        $model=$this->loadModel();

        if( $model )
        {
            if( file_exists( MEHESZ_FILES_FOLDER . $model->file ) )
            {
				// at this point we mark this theme as downloaded and we track the IP
				$theme_user = new ThemeUser;
				$theme_user->user_id = (int)Yii::app()->user->id;
				$theme_user->theme_id = $model->id;
				$theme_user->save();

                $model->setAttribute( 'downloaded', $model->downloaded+1 );
                $model->skipUpdated = true;
                $model->save();

                $file = MEHESZ_FILES_FOLDER . $model->file;
                //die( $file );

                if( file_exists( $file ) )
                {
                        $outname= "yiitheme" . $model->id . ".zip";

                        header('Content-Description: File Transfer');
                        header('Content-Type: application/octet-stream');
                        header('Content-Disposition: attachment; filename='. $outname );
                        header('Content-Transfer-Encoding: binary');
                        header('Expires: 0');
                        header('Cache-Control: must-revalidate');
                        header('Pragma: public');
                        header('Content-Length: ' . filesize($file));
                        ob_clean();
                        flush();
                        readfile($file);
                        exit;
                }
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
				$this->_model = $this->modelClass->findbyPk($_GET['id']);
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
