<?php
/**
 * 权限验证类
 *
 * @author qicfan
 */
class QDbAuthManager extends CDbAuthManager
{
	/**
	 * @var string the name of the table storing authorization items. Defaults to 'AuthItem'.
	 */
	public $itemTable='admin_actions';
	
	/**
	 * Performs access check for the specified user.
	 * @param string $itemName the name of the operation that need access check
	 * @param mixed $userId the user ID. This should can be either an integer and a string representing
	 * the unique identifier of a user. See {@link IWebUser::getId}.
	 * @param array $params name-value pairs that would be passed to biz rules associated
	 * with the tasks and roles assigned to the user.
	 * @return boolean whether the operations can be performed by the user.
	 */
	public function checkAccess($itemName,$userId,$params=array())
	{
		$assignments=$this->getAuthAssignments($userId);
		if ($assignments == '*')
		{
			// 超级管理员，拥有所有权限
			return true;
		}
		return $this->checkAccessRecursive($itemName,$userId,$params,$assignments);
	}
	
	protected function checkAccessRecursive($itemName,$userId,$params,$assignments)
	{
		if(($item=$this->getAuthItem($itemName))===false)
			return false;
		Yii::trace('Checking permission "'.$item.'"','QDbAuthManager');
		if (in_array($itemName, $assignments))
		{
			return true;
		}
		return false;
	}
	
	/**
	 * 取用户被授权的所有动作
	 * @param type $userId
	 */
	public function getAuthAssignments($userId)
	{
		if (empty($userId))
		{
			return false;
		}
		$admin = AdminUser::model()->findByPk($userId);
		$actions = $admin->role->actions;
		
		if ($actions == '*')
		{
			return '*';
		}
		return explode(',', $actions);
	}
	
	/**
	 * Returns the authorization item with the specified name.
	 * @param string $name the name of the item
	 * @return CAuthItem the authorization item. Null if the item cannot be found.
	 */
	public function getAuthItem($name)
	{
		$row=$this->db->createCommand()
			->select()
			->from($this->itemTable)
			->where('action=:name', array(':name'=>$name))
			->queryRow();

		if($row!==false)
		{
			return $row['title'];
		}
		else
			return false;
	}
	
}