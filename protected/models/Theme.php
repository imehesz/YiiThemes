<?php

class Theme extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'themes':
	 * @var integer $id
	 * @var integer $userID
	 * @var string $name
	 * @var string $preview1
	 * @var string $preview2
	 * @var integer $score
	 * @var integer $created
	 * @var integer $updated
	 * @var integer $deleted
	 */

    /**
     *
     */
    public $realPreview1;
    
    /**
     *
     */
    public $realPreview2;
    
    /**
     *
     */
    public $realFile;
	
	public $skipUpdated = false;

    public $sumviews;
    public $sumdownloads;

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'themes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, short_desc', 'required'),
			array('userID, score, created, updated, deleted', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('long_desc','length','max' => 1000),
			//array('preview1, preview2, file', 'length', 'max'=>100), 
//			array( 'preview1,preview2','file', 'types' => 'jpg, gif, png', 'allowEmpty' => true ),
			array( 'realPreview1,realPreview2','file', 'types' => 'jpg, gif, png', 'allowEmpty' => true, 'maxSize' => 1024*1024 ), // 1M
//			array( 'preview1', 'allowEmpty' => true ),
//			array( 'file','file', 'types' => 'zip', 'allowEmpty' => true ),			
			array( 'realFile','file', 'types' => 'zip', 'allowEmpty' => true, 'maxSize' => 6144*1024 ), // 6M
      array("file", "length", "max" => 100, "on" => "externalZipInsert" ),
      array("file", "url", "on" => "externalZipInsert", "validSchemes" => array("http","https","ftp") ),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, score, created, updated, short_desc', 'safe', 'on'=>'search'),
		);
	}

  public function defaultScope() {
    return array(
      'condition' => 'deleted=0'
    );
  }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user'      => array(self::BELONGS_TO, 'User', 'userID'),
		);
	}

    /**
     *
     */
    public function scopes()
    {
        return array(
            'sumView'   => array(
                            'select'    => 'sum(viewed) as sumviews',
            ),

            'sumDownload'   => array(
                            'select'    => 'sum(downloaded) as sumdownloads',
            ),
        );
    }

	/*
	public function behaviors()
	{
		return array(
			'commentable' => array(
				'class'	=> 'ext.comment-module.behaviors.CommentableBehavior',
				'mapTable'	=> 'themes_comments_nm',
				'mapRelatedColumn'	=> 'themeId'
			)
		);
	}
	*/

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'userID' => 'User',
			'name' => 'Name',
			'short_desc' => 'Short Description',
			'long_desc' => 'Long Description',
			'preview1' => 'Preview image',
			'preview2' => 'Preview image 2',
			'score' => 'Score',
			'file'  => 'File',
			'created' => 'Created',
			'updated' => 'Updated',
			'deleted' => 'Active', // it might be confusing but on the form we call this field active
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('userID',$this->userID);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('preview1',$this->preview1,true);

		$criteria->compare('preview2',$this->preview2,true);

		$criteria->compare('score',$this->score);

		$criteria->compare('created',$this->created);

		$criteria->compare('updated',$this->updated);

		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider('Theme', array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave()
	{
	    $now = time();
	    
	    if( $this->isNewRecord )
	    {
	        $this->setAttribute( 'userID', Yii::app()->user->id );
	        $this->setAttribute( 'created', $now );
        }
        
		if( ! $this->skipUpdated )
		{
			$this->setAttribute( 'updated', $now );
		}
        
        // let's take care of some data sanitation 
        $this->setAttribute( 'name', strip_tags( $this->name ) );
        $this->setAttribute( 'short_desc', strip_tags( $this->short_desc ) );
        $this->setAttribute( 'long_desc', strip_tags( $this->long_desc ) );
        
	    return parent::beforeSave();	    
	}

	/**
	 * @param $model
	 *
	 * @return 
	 */
	public function handleFiles( $model )
	{
		$model->realPreview1=CUploadedFile::getInstance($model,'realPreview1');
		if($model->realPreview1)
		{
			$file_name = '1' . time(). '' . rand( 0, time() ).'.jpg';
			$model->setAttribute( 'preview1', $file_name );
			$model->realPreview1->saveAs( MEHESZ_FILES_FOLDER . 'screenshots/'.$file_name );
		}

		$model->realPreview2=CUploadedFile::getInstance($model,'realPreview2');
		if( $model->realPreview2)
		{
			$file_name = '2' . time(). '' . rand( 0, time() ).'.jpg';
			$model->setAttribute( 'preview2', $file_name );
			$model->realPreview2->saveAs( MEHESZ_FILES_FOLDER . 'screenshots/'.$file_name );
		}

		$model->realFile=CUploadedFile::getInstance($model,'realFile');
		if( $model->realFile )
		{
			$file_name = 'f' . time(). '' . rand( 0, time() ).'.zip';
			$model->setAttribute( 'file', $file_name );
			$model->realFile->saveAs( MEHESZ_FILES_FOLDER . $file_name );
		}
	}

  public function isZipExternal($val=null) {
    return ! empty($val) ? 
      in_array(substr($val,0,3), array("htt","ftp")) ? true : false:
      in_array(substr($this->file,0,3), array("htt","ftp")) ? true : false;
  }
}
