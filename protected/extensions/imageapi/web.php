<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$config = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'AutoMotoOcasion',
    'language'=>'es',
	'theme'=>'basic',
	
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.components.helpers.*',
		'application.components.widgets.*',
		'ext.user.*',
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'hwangar@gmail.com',
	),

    // application components
	'components'=>array(
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CWebLogRoute',
                    'showInFireBug' => true,
					//'levels'=>'error, warning',
				),
			),
		),
        'session'=>array(
            'class'=>'CHttpSession',
            // 'sessionId'=>false, //(isset($_POST['PHPSESSID']) ? $_POST['PHPSESSID'] : null),
            'useTransparentSessionID'   =>($_POST['PHPSESSID']) ? true : false,
            'cookieMode'                =>($_POST['PHPSESSID']) ? 'none' : 'allow',
        ),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			//'caseSensitive'=>false,
			'rules'=>array(
				'user/register/*'=>'user/create',
				'user/profile/*'=>'user/show',
//				'user/settings/*'=>'user/update',
			),
		),
        'clientScript'=>array(
             'scriptMap'=>array(
                  //'jquery.form.js'=>false, // funciona! usarlo para optimizacion...
             ),
        ),
		// database configuration
		'db'=>array(
            'class'=>'CDbConnection',
			'connectionString'=>'mysql:host=localhost;dbname=yii_automoto',
            'username'=>'root',
            'password'=>'Jaula.12',
            'charset'=>'utf8',
		),
        'authManager'=>array(
            'class'=>'CDbAuthManager',
            'connectionID'=>'db',
            'defaultRoles'=>array('authenticated', 'guest'),
        ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
            'loginUrl'=>array('user/login'),
		),

    
        'image'=>array(
            'class'=>'ext.imageapi.CImage',
            'presets'=>array(
                '640x480'=>array(
                    'cacheIn'=>'webroot.repository.640x480',
                    'actions'=>array(
                        'scaleAndCrop'=>array('width'=>640, 'height'=>480),
                        'watermark'=>array('pngWatermark'=>'webroot.images.watermark.png', 'x'=>590,'y'=>430),
                    ),
                ),
                '100x75'=>array(
                    'cacheIn'=>'webroot.repository.100x75',
                    'actions'=>array(
                        'scaleAndCrop'=>array('width'=>100, 'height'=>75),
                        'watermark'=>array('pngWatermark'=>'/images/watermark.png', 'x'=>50,'y'=>25),
                    ),
                ),
                '40x30'=>array(
                    'cacheIn'=>'webroot.repository.40x30',
                    'actions'=>array( 'scaleAndCrop'=>array('width'=>40, 'height'=>30) ),
                ),
                '27x20'=>array(
                    'cacheIn'=>'webroot.repository.27x20',
                    'actions'=>array( 'scaleAndCrop'=>array('width'=>27, 'height'=>20) ),
                ),
          ),
        ),
	),
);

//if (isset($_POST['PHPSESSID'])) $config['components']['session']['sessionId']=$_POST['PHPSESSID'];
return $config;