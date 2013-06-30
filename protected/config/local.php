<?php

$main_conf = require(dirname(__FILE__) . '/main.php');
unset($main_conf['components']['db']);
unset($main_conf['components']['log']);
return CMap::mergeArray(
	$main_conf, array(
		'import' => array(
			'application.extensions.yiidebugtb.*', //our extension'
		),
		'modules' => array(
			'gii' => array(
				'class'		 => 'system.gii.GiiModule',
				'password'	 => 'woshishei',
				'ipFilters'	 => array('127.0.0.1', '::1'),
				'generatorPaths'=>array(
					'bootstrap.gii',
				),
			),
		),
		'components' => array(
			'db' => array(
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
			'log'					 => array(
				'class'	 => 'CLogRouter',
				'routes' => array(
					array(
						'class'	 => 'CFileLogRoute',
						'levels' => 'error,warning,notice',
					),
//					array(// configuration for the toolbar
//						'class'		 => 'XWebDebugRouter',
//						'config'	 => 'alignLeft, opaque, runInDebug, fixedPos, collapsed, yamlStyle',
//						'levels'	 => 'error, warning, trace, profile, info',
//						'allowedIPs' => array('127.0.0.1', '::1', '192.168.1.54', '192\.168\.1[0-5]\.[0-9]{3}'),
//					),
				),
			),
		),
		'params' => array(
		),
	)
);
