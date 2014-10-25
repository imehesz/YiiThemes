<?php

// we create this class so we can store the themes in different DB tables
class ThemeWear extends Theme {
  
  public $externalZipSupport;

  public static function model( $className=__CLASS__ ) {
    return parent::model( $className );
  }

  public function rules() {
 		return array(
			array('name, short_desc', 'required'),
			array('userID, score, created, updated, deleted', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('long_desc','length','max' => 1000),
			array( 'realPreview1,realPreview2','file', 'types' => 'jpg, gif, png', 'allowEmpty' => true, 'maxSize' => 1024*1024 ),
			array( 'realFile','file', 'types' => 'zip,face', 'allowEmpty' => true, 'maxSize' => 6144*1024 ), // 6M
      array("file", "length", "max" => 100, "on" => "externalZipInsert" ),
      array("file", "url", "on" => "externalZipInsert", "validSchemes" => array("http","https","ftp") ),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, score, created, updated, short_desc', 'safe', 'on'=>'search'),
		);
  }

  public function tableName() {
    return 'themes_wear';
  }
}