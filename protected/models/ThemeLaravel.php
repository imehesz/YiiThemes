<?php

// we create this class so we can store the themes in different DB tables
class ThemeLaravel extends Theme {

  public static function model( $className=__CLASS__ ) {
    return parent::model( $className );
  }

  public function tableName() {
    return 'themes_laravel';
  }
}
