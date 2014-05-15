<?php 
  if( Yii::app()->params["about"] ) {
    echo str_replace("{{ABOUTNOTES}}", Yii::app()->params["aboutnotes"] ? Yii::app()->params["aboutnotes"] : "" ,Yii::app()->params["about"]);
  }