<?php

// session超时时间设定
session_cache_expire(60 * 60); // 页面存活期 分
ini_set('session.gc-maxlifetime', 24 * 60 * 60); // 过期回收时间，秒
Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');
Yii::setPathOfAlias('qrbac', dirname(__FILE__) . '/../modules/qrbac');
return array(
	'basePath'			 => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name'				 => '后台',
	'charset'			 => 'UTF-8',
	//默认控制器
	'defaultController'	 => 'site',
	//设置时区及语言
	'timeZone'			 => 'Asia/Shanghai',
	'language'			 => 'zh_cn',
	//预加载log组件
	'preload'			 => array('log'),
	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.components.*',
		'application.components.widgets.*',
		'application.helpers.*',
		'qrbac.models.*',
		'qrbac.components.*',
		'qrbac.helpers.*',
		'qrbac.components.widgets.*'
	),
	'modules' => array(
		'qrbac' => array(
		)
	),
	// application components
	'components' => array(
		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => array(
				'gii/<controller:\w+>/<action:\w+>' => 'gii/<controller>/<action>',
				'qrbac/<controller:\w+>/<action:\w+>' => 'qrbac/<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		),
		'authManager' => array(
			'class'		 => 'QDbAuthManager',
		),
		'bootstrap'	 => array(
			'class'	 => 'bootstrap.components.Bootstrap',
		),
		'db'	 => array(
			'class'					 => 'CDbConnection',
			'connectionString'		 => 'mysql:host=127.0.0.1;dbname=testadmin',
			'emulatePrepare'		 => true,
			'username'				 => 'root',
			'password'				 => '123123',
			'charset'				 => 'utf8',
			'enableProfiling'		 => true,
			'enableParamLogging'	 => true,
			'schemaCachingDuration'	 => 3600,
			'autoConnect'			 => false,
		),
		//用户组件
		'user'					 => array(
			'class'			 => 'CWebUser',
			'allowAutoLogin' => true,
			'loginUrl'		 => array('qrbac/site/login'),
		),
		// cookie验证
		'request' => array(
			'enableCookieValidation' => true,
		),
		'errorHandler'			 => array(
			// use 'site/error' action to display errors
			'errorAction'	 => '/site/error',
		),
		'log'			 => array(
			'class'	 => 'CLogRouter',
			'routes' => array(
				array(
					'class'	 => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
			),
		),
		// 文件缓存
		'cache'	 => array(
			'class'	 => 'CFileCache',
		),
	// memcache
//		'cache'=>array(
//			'class'=>'ext.cache.ZlibMemCache',
//			'keyPrefix'=>'p2_',//cache key 前缀
//			'useMemcached'=>false,
//			'servers'=>array(
//				array('host'=>'127.0.0.1','port'=>11211),
//			),
//		),
	),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => array(
		// this is used in contact page
		'adminEmail'	 => 'qicfan@gmail.com',
	),
);