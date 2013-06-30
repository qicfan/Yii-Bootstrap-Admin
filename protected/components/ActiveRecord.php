<?php
/**
 * Description of ActiveRecored
 *
 * @author qicfan
 */
class ActiveRecord extends CActiveRecord
{
	/**
	 * 记录日志
	 * @param type $result
	 */
	public function log($result, $modelId=0)
	{
		$log = new AdminLogs();
		$log->admin_id = Yii::app()->user->user_id;
		$log->admin_name = Yii::app()->user->user_name;
		$log->ip = Yii::app()->request->userHostAddress;
		$log->model_id = $modelId == 0 ? $this->attributes[$this->primaryKey] : $modelId;
		$log->result = $result;
		$log->model = strtolower(get_class($this));
		$log->save();
	}
}