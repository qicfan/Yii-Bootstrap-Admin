<?php

$yii = dirname(__FILE__) . '/../framework/yii.php';
$config_dir = dirname(__FILE__) . '/../protected/config';
// mode.conf文件中存有一个字符串，用来标明当前是哪一种环境，当该文件不存在时，将使用main配置文件，即生产环境。
// mode.conf option:local,develop,test,performance,mirror
$mode_file = $config_dir . '/mode.conf';

if (file_exists($mode_file))
{
	$mode = trim(file_get_contents($mode_file));
	$config = $config_dir . '/' . $mode . '.php';

	if (!preg_match("/^\w+$/", $mode))
		die('mode error!');
	if (!file_exists($config))
		die('Mode config file is not exists.');

	if (in_array($mode, array('local')))
	{
		defined('YII_DEBUG') or define('YII_DEBUG', true);
		// specify how many levels of call stack should be shown in each log message
		defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
	}
}
else
{
	$config = $config_dir . '/main.php';
}

if (extension_loaded('apc'))
	$yii = dirname(__FILE__) . '/../framework/yiilite.php';

require_once ($yii);

Yii::createWebApplication($config)->run();
