<?php
/**
 * this class handles the DB stuff for users who decideto download themes 
 */
class ThemeUser extends CActiveRecord
{
	public $max_downloads_allowed = 5;
	public $time_trap = 43200;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'theme_user';
	}

	public function rules()
	{
		return array(
			array( 'theme_id', 'required' ),
			array( 'ip_address', 'length', 'max' => 100 ),
			array( 'user_id, theme_id', 'numerical', 'integerOnly' => true ),
			array( 'created_at', 'numerical' ),
		);
	}

	public function relations()
	{
		return array(
			'theme' => array( self::BELONGS_TO, 'Theme', 'theme_id' ),
		);
	}

	public function beforeSave()
	{
		$this->ip_address = $_SERVER['REMOTE_ADDR'];
		$this->created_at = time();
		return parent::beforeSave();
	}

	public function canDownloadByIp( $theme_id, $ip = null )
	{
		if( empty( $ip ) )
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}

		// now let's get the latest X downloads from this IP for the this theme
		$criteria = new CDbCriteria;
		$criteria->condition 	= 'ip_address=:ip_address AND theme_id=:theme_id';
		$criteria->params		= array( ':ip_address' => $ip, ':theme_id' => $theme_id );
		$criteria->order 		= 'created_at DESC';

		$download = self::model()->find( $criteria );

		// if we haven't downloaded or the last time was a day ago ...
		if( empty( $download ) || ( !empty($download) && time()-$download->created_at > $this->time_trap ) )
		{
			return true;
		}

		return false;
	}
}
