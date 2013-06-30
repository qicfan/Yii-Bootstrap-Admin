<?php

/**
 * This is the model class for table "awards".
 *
 * The followings are the available columns in table 'awards':
 * @property integer $id
 * @property string $uuid
 * @property integer $create_time
 * @property integer $receive_time
 * @property integer $status
 * @property string $wm_username
 * @property string $mobile
 * @property integer $award_type
 * @property string $cardbatch
 * @property integer $wm_status
 */
class PersonAwards extends ActiveRecord
{
	
	public static $awardTypeNameMap = array(
		0=>'我买网虚拟奖品',
		1=>'第三方虚拟奖品',
		2=>'我买网实物奖品',
		3=>'第三方实物奖品',
	);
	
	/**
	 *
	 * @var type 
	 */
	public static $wmStatusNameMap = array(
		0=>'验证通过',
		101=>'uni不存在',
		102=>'uni与批次号不匹配',
		103=>'领奖时效已过期',
		104=>'已经领过奖',
		105=>'奖品已发完',
		106=>'sec不合法',
	);
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PersonAwards the static model class
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
		return 'person_awards';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uuid, create_time', 'required'),
			array('create_time, receive_time, status, award_type, wm_status', 'numerical', 'integerOnly'=>true),
			array('uuid', 'length', 'max'=>64),
			array('wm_username', 'length', 'max'=>50),
			array('mobile', 'length', 'max'=>14),
			array('cardbatch', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uuid, create_time, receive_time, status, wm_username, mobile, award_type, cardbatch, wm_status', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'uuid' => '用户标识',
			'create_time' => '获奖时间',
			'receive_time' => '领奖时间',
			'status' => '领奖状态',
			'wm_username' => '用户名',
			'mobile' => '电话',
			'award_type' => '奖品类型',
			'cardbatch' => '奖品批次号',
			'wm_status' => '我买网领奖状态',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('uuid',$this->uuid,true);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('receive_time',$this->receive_time);
		$criteria->compare('status',$this->status);
		$criteria->compare('wm_username',$this->wm_username,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('award_type',$this->award_type);
		$criteria->compare('cardbatch',$this->cardbatch,true);
		$criteria->compare('wm_status',$this->wm_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getStateName()
	{
		switch($this->status)
		{
			case 1:
				return "已领奖";
			case 0:
				return "未领奖";
			default:
				return "未知";
		}
	}
	
	public function getAwardTypeName()
	{
		if (isset(self::$awardTypeNameMap[$this->award_type]))
		{
			return self::$awardTypeNameMap[$this->award_type];
		}
		return "未知";
	}
	
	public function getWmStatusName()
	{
		if (isset(self::$wmStatusNameMap[$this->wm_status]))
		{
			return self::$wmStatusNameMap[$this->wm_status];
		}
		return "未知";
	}
}