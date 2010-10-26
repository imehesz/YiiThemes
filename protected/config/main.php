<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Yii Themes - a collection of designs for the Yii (PHP) framework',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.user.models.*',
		'application.mehesz.*',
		'application.extensions.*',
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			// turn on the new user management module
			'class' => 'application.modules.user.components.WebUser',
			'loginUrl' => array( 'user/user/login' ),
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName' => false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:protected/data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => MEHESZ_DB_CONNECTION_STRING,
			'emulatePrepare' => true,
			'username' => MEHESZ_DB_USER,
			'password' => MEHESZ_DB_PASSWORD,
			'charset' => 'utf8',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

		'image' => array(
			'class'		=> 'ext.imageapi.CImage',
			'presets'	=> array(
				'125x90'	=> array(
					'cacheIn'	=> 'webroot.files.imagecache.100x75',
					'actions'	=> array(
							'scale'	=> array( 'width' => 125, 'height' => 90 ),
					),
				),
				'250x175'	=> array(
					'cacheIn'	=> 'webroot.files.imagecache.250x175',
					'actions'	=> array(
							'scaleAndCrop'	=> array( 'width' => 250, 'height' => 175 ),
					),
				),

			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
	/** 
	 * additional Yii modules ...
	 */
	'modules' => array(
		'user' => array(
			'debug'=>false,
		),
	),
);
