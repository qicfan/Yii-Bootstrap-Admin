<?php

$main_conf = require(dirname(__FILE__) . '/main.php');
unset($main_conf['components']['db']);
return CMap::mergeArray(
	$main_conf, array(
		'components' => array(
			'db' => array(
				'class'					 => 'CDbConnection',
				'connectionString'		 => 'mysql:host=127.0.0.1;dbname=act',
				'emulatePrepare'		 => true,
				'username'				 => 'root',
				'password'				 => '123123',
				'charset'				 => 'utf8',
				'enableProfiling'		 => true,
				'enableParamLogging'	 => true,
				'schemaCachingDuration'	 => 3600,
				'autoConnect'			 => false,
			),
		),
		'params' => array(
			'WM_DOMAIN' => 'http://ftest.womaiapp.com',
		),
	)
);
