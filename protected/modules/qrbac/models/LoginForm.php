<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;
	public $verifyCode;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		if(Yii::app()->params['is_verify'])
		{
			return array(
				// username and password are required
				array('username, password,verifyCode', 'required'),
				// rememberMe needs to be a boolean
//				array('rememberMe', 'boolean'),
				// password needs to be authenticated
				array('password', 'authenticate'),
				array('verifyCode', 'captcha')
				);
		}else{
			return array(
				// username and password are required
				array('username, password', 'required'),
				// rememberMe needs to be a boolean
//				array('rememberMe', 'boolean'),
				// password needs to be authenticated
//				array('password', 'authenticate')
			);
		}
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new QUserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','Incorrect username or password.');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new QUserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===QUserIdentity::ERROR_NONE)
		{
			$duration=86400;
			$rs = Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
