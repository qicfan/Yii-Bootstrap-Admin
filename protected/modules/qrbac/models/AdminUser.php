<?php

/**
 * This is the model class for table "p2_adminuser".
 *
 * The followings are the available columns in table 'p2_adminuser':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $last_ip
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $last_time
 * @property integer $role_id
 */
class AdminUser extends ActiveRecord
{
	
	public $password_repeat = '';
	public $noHashPassword = '';
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdminUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'admin_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username', 'required'),
			array('create_time, update_time, last_time, role_id', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>12),
			array('password', 'length', 'max'=>32, 'min'=>6),
			array('last_ip', 'length', 'max'=>15),
			array('username', 'unique', 'message'=>'该用户已经存在'),
			array('password_repeat, password, role_id', 'required', 'on'=>'create, update'),
			array('role_id', 'required', 'on'=>'update_role'),
			array('password', 'compare', 'compareAttribute'=>'password_repeat', 'operator'=>'=', 'message'=>'两次密码必须一致'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, last_ip, create_time, update_time, last_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'role' => array(self::HAS_ONE, 'AdminRole', array('id'=>'role_id')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => '用户名',
			'password' => '密码',
			'create_time' => '创建时间',
			'update_time' => '更新时间',
			'last_time' => '最后登录时间',
			'last_ip' => '最后登录IP',
			'password_repeat'=>'再次输入密码',
			'role_id'	=> '角色ID',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('username', $this->username, true);
		$criteria->compare('password', $this->password, true);
		$criteria->compare('create_time', $this->create_time, true);
		$criteria->compare('update_time', $this->update_time, true);
		$criteria->compare('last_time', $this->last_time, true);
		$criteria->compare('last_ip', $this->last_ip, true);

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
					'pagination' => array(
						'pageSize' => Yii::app()->request->getParam('perpage') ? Yii::app()->request->getParam('perpage') : 10,
						'pageVar' => 'page'
					)
				));
	}
	
	public function validatePassword($inputPassword)
	{
		if ($this->password == md5($inputPassword))
		{
			return true;
		}
		return false;
	}

	public static function getUserInfoByName($username)
	{
		$username = trim($username);
		$user = new AdminUser();
		$user = $user->find('username=:username', array(':username' => $username));
		if ($user !== null)
		{
			return $user;
		}
		else
			return false;
	}
	
	public function beforeSave()
	{
		parent::beforeSave();
		$this->password = md5($this->password);
		return true;
	}
}