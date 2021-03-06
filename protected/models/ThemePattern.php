<?php

// we create this class so we can store the themes in different DB tables
class ThemePattern extends Theme {
  
  public $externalZipSupport;

  public static function model( $className=__CLASS__ ) {
    return parent::model( $className );
  }

  public function tableName() {
    return 'themes_pattern';
  }
}
