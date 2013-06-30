<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class QUserIdentity extends CUserIdentity
{
	
	private $user_id;
	
	private $user_name;
	
	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		
		// 获取用户信息
		$user = AdminUser::getUserInfoByName($this->username);
		if ($user === false)
		{
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}
		elseif (!$user->validatePassword($this->password))
		{
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		}
		else
		{
			$this->user_id = $user->id;
			$this->user_name = $user->username;
			Yii::app()->user->setState( 'user_id' , $this->user_id );
			Yii::app()->user->setState( 'user_name' , $this->user_name );
			// 更新用户最后登陆时间
			AdminUser::model()->updateByPk($user->id, array(
				'last_time' => time(),
				'last_ip' => Yii::app()->request->userHostAddress
			));
		}
		return $this->errorCode = self::ERROR_NONE;
	}
	
	public function getId()
	{
		return $this->user_id;
	}

	public function getName()
	{
		return $this->user_name;
	}
	
	public function getPersistentStates()
	{
		return array('user_id'=>$this->user_id, 'user_name'=>$this->user_name,);
	}

}
