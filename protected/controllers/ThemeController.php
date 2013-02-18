<?php

class ThemeController extends ERestController
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

    public $nestedModels = false;

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	public function beforeAction( $action )
	{

		return parent::beforeAction( $action );

		// TODO fix this, maybe update Yii to a newer version?
		$id = Yii::app()->request->getParam( 'id', null );

		if( $id ) { $model = $this->loadModel(); }
		else { $model = new Theme; }

		Controller::$RIGHT_SIDEBAR = $this->renderPartial( 'application.components.views._right_sidebar_main', array( 'model' => $model ), true );
		return parent::beforeAction( $action );
	}

	/**
	 * @return array action filters
	 */
	public function _filters()
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
	public function _accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array( 'index','view','download', 'layoutgen' ),
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
		$page_size 	= 12;
		$uid 		= Yii::app()->request->getParam( 'uid' );
		$addsort 	= '';
		$artist 	= Yii::app()->request->getParam( 'artist' );
		$artist_obj	= null;
		$criteria	= new CDbCriteria;

		if( Yii::app()->request->getParam('sort') )
		{
			$addsort = Yii::app()->request->getParam( 'sort' ) . ' DESC,';
		}

		if( $artist )
		{
			$artist_obj = User::model()->findByAttributes( array( 'username' => $artist ) );
			if( $artist_obj )
			{
				$criteria->addCondition( 'userID=:artist_id' );
				$criteria->params[':artist_id'] = $artist_obj->id;
			}
		}

		$criteria->order = $addsort . 'created DESC';

	// it's late, can't think anymore ...
	// TODO clean this up!

	/*
		if(
			! Yii::app()->user->isGuest &&
			$uid == Yii::app()->user->id
		)
		{
			$dataProvider=new CActiveDataProvider(
				'Theme', 
						array( 
							'criteria' => array( 'condition' => 'deleted=0 AND userID='.(int)$uid, 'order' => $addsort . 'created DESC' ) ,
							'pagination' => array( 'pageSize' => $page_size ) 
						));
		}
		else
	*/
		{
			$dataProvider=new CActiveDataProvider(
				'Theme', 
						array( 
							'criteria' 		=> $criteria,
							'pagination' 	=> array( 'pageSize' => $page_size ) 
						) );
		}

		$this->render('index',array(
			'dataProvider'	=> $dataProvider,
			'artist'		=> $artist_obj
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

  ///////////////////////
  // Custom REST stuff //
  ///////////////////////

  // TODO quick hack for now, so we can have user info
  // constantly the same way ...
  public function doCustomRestGetUserinfo() {
    $this->outputHelper( 'Userinfo', null, 0 );
  }

  public function doRestDelete($id) {
    $this->renderJson( array("message" => "Not supported action!") );
  }

  public function doRestUpdate($id, $data) {
    $this->renderJson( array("message" => "Not supported action!") );
  }

  /**
   * TODO there is a bug where if the user id is 1, filter returns 
   * every author with  ID containing the number 1. ie: 1, 11, 121, 541 etc
   */
  public function doRestList() {
    // first let's get the models

    // if we have a filter, we might wanna look for 
    // the author, so we need to change some things.
    if ($this->restFilter ) {
      $filters = CJSON::decode( $this->restFilter );
      $new_filters = array();
      foreach ( $filters as $filter ) {
        if ( isset( $filter['property'] ) && $filter['property'] == 'author' ) {
          // we got an author, let's deal with it ...
          $author = $filter['value'];
          if ( $author ) {
            $user = User::model()->findByAttributes(array('username' => $author ));
            if ( $user ) {
              $new_filters[] = array( 'property' => 'userId', 'value' => $user->id );
            }
          }
        } elseif ( isset( $filter['property'] ) && $filter['value'] ) {
          $new_filters[] = $filter;
        }
      }
      $this->restFilter = CJSON::encode( $new_filters );
    }

    $models = $this->getModel()->filter($this->restFilter)->orderBy($this->restSort)->limit($this->restLimit)->offset($this->restOffset)->findAll();

    foreach ( $models as $model ) {
      $jsonTheme = new StdClass();
      $jsonTheme->id        = $model->id;
      $jsonTheme->name      = $model->name;
      $jsonTheme->artist    = $model->user->username;
      $jsonTheme->image     = $model->preview1;
      $jsonTheme->created   = $model->created;
      $jsonTheme->updated   = $model->updated;
      $jsonTheme->short_desc= $model->short_desc;
      $retarr[] = $jsonTheme;
    }

    $count = $this->getModel()->filter( $this->restFilter )->count();
    $this->outputHelper( 'Themes found', $retarr, $count );
  }

  public function doRestView( $id ) {
    $theme = Theme::model()->with('user')->findByPk( $id );

    if ( $theme ) {
      $md = new CMarkdown;
      $md->cssFile = false;

      $jsonTheme = new StdClass();
      $jsonTheme->id        = $theme->id;
      $jsonTheme->name      = $theme->name;
      $jsonTheme->artist    = $theme->user->username;
      $jsonTheme->view_cnt      = $theme->viewed;
      $jsonTheme->download_cnt  = $theme->downloaded;
      $jsonTheme->image     = $theme->preview1;
      $jsonTheme->created   = $theme->created;
      $jsonTheme->updated   = $theme->updated;
      $jsonTheme->short_desc= $theme->short_desc;
      $jsonTheme->long_desc = $md->transform( $theme->long_desc );
      $jsonTheme->downloadable = ThemeUser::model()->canDownloadByIp( $id );

      $this->outputHelper( 'Theme found', $jsonTheme, 1 );
    }
  }

  public function doCustomRestGetRandomfive() {
		$themes = Theme::model()->findAllByAttributes( array('deleted'=>0  ), array( 'order'=> 'rand()', 'limit'=>5 ) ); 
    $retarr = array();

    if ( ! empty( $themes ) ) {
      foreach ( $themes as $theme ) {
        $jsonTheme          = new StdClass();
        $jsonTheme->id      = $theme->id;
        $jsonTheme->name    = $theme->name;
        $jsonTheme->short_desc    = $theme->short_desc;
        $jsonTheme->view_cnt      = $theme->viewed;
        $jsonTheme->download_cnt  = $theme->downloaded;
        $jsonTheme->image         = $theme->preview1;
        $jsonTheme->created       = $theme->created;
        $jsonTheme->updated       = $theme->updated;
        $jsonTheme->artist        = $theme->user->username;
        $retarr[] = $jsonTheme;
      }
    }

    $this->outputHelper( 'Random five themes', $retarr, sizeof( $retarr ) );
  }

	public function outputHelper($message, $results, $totalCount=0, $model=null)
	{
		if(is_null($model)) {
			$model = lcfirst(get_class($model));
    }
		else {
			$model = lcfirst($model);
    }

    // let's see if we know anything about the current user ...
    $user_info = new StdClass();
    $user_info->is_guest = Yii::app()->user->isGuest;
    if ( ! $user_info->is_guest ) {
      $user_info->name = Yii::app()->user->name;
    }
		
		$this->renderJson(array(
			'success'=>true, 
      'user_info' => $user_info,
			'message'=>$message, 
			'data'=>array(
				'totalCount'=>$totalCount, 
				'themes'=>$results
			)
		));
	}
}
