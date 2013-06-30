<?php
/**
 * 包含主配置文件
 * 当有差异的数组或要删除的数组的时候，才需要unset，否则如果重写结构一样的数组可以不必unset
 */
$config_dir = dirname(__FILE__) . '/mode.conf';
$mode = trim(file_get_contents($config_dir));
$main_conf = require(dirname(__FILE__).'/'.$mode.'.php');
// 注销掉main中的配置
unset($main_conf['components']['session']);
unset($main_conf['components']['sessionCache']);
unset($main_conf['defaultController']);
unset($main_conf['components']['coreMessages']);
unset($main_conf['components']['log']);
return CMap::mergeArray(
	$main_conf,
	array(
	// application components
	'components'=>array(
		'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
                array(
                    'class'=>'CEmailLogRoute',
                    'levels'=>'error, warning',
                    'emails'=>'qixiaopeng@55tuan.com',
					),
				),
			),
		),
	)
);
