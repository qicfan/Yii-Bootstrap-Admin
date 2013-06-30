<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{

	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout = '//layouts/admin';

	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = array();

	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs = array();
	
	public $uuid;

	//进入控制器是执行，判断是否登录
	public function init()
	{
		Yii::app()->bootstrap->register();
		$this->getUuid();
	}
	
	protected function checkAccess($operation, $return = false)
	{
		if (Yii::app()->user->isGuest)
		{
			return false;
		}
		$rs = Yii::app()->user->checkAccess($operation);
		if ($rs)
		{
			return true;
		}
		if ($return == false)
		{
			throw new CHttpException(403, '您没有权限进行该操作');
		}
		return false;
	}
	
	protected function getIp()
	{
		if (isset($_SERVER['HTTP_X_REAL_IP']))
		{
			return $_SERVER['HTTP_X_REAL_IP'];
		}
		elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			return Yii::app()->request->getUserHostAddress();
		}
	}
	
	/**
	 * 返回COOKIE中得UUID，如果没有则生成一个并写入COOKIE中
	 * @author zeroq
	 * @return type
	 */
	protected function getUuid() {
		if (isset($_COOKIE['uuid']))
		{
			$uuid = $_COOKIE['uuid'];
		}
		else
		{
			$uuid = CommonHelper::guid();
			$domain = '.' . CommonHelper::getDomain();
			setcookie('uuid', $uuid, time() + 63072000, '/', $domain);
		}
		$this->uuid = $uuid;
		return $uuid;
	}
	
	/**
	 * 输出json数据
	 * @param stirng $json
	 */
	protected function printJson($json)
	{
		header('Content-type: application/json');
		if (is_array($json) || is_object($json))
		{
			$json = json_encode($json);
		}
		echo $json;
		Yii::app()->end();
	}

}
