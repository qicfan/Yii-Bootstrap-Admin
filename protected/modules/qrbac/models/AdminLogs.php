<?php

/**
 * This is the model class for table "admin_logs".
 *
 * The followings are the available columns in table 'admin_logs':
 * @property integer $id
 * @property string $model
 * @property integer $model_id
 * @property integer $admin_id
 * @property integer $admin_name
 * @property string $create_time
 * @property string $result
 * @property string $ip
 */
class AdminLogs extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdminLogs the static model class
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
		return 'admin_logs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('model, model_id, admin_id, admin_name, create_time, result, ip', 'required'),
			array('model_id, admin_id, admin_name', 'numerical', 'integerOnly'=>true),
			array('model', 'length', 'max'=>10),
			array('result', 'length', 'max'=>500),
			array('ip', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, model, model_id, admin_id, admin_name, create_time, result, ip', 'safe', 'on'=>'search'),
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
			'model' => 'Model',
			'model_id' => 'Model',
			'admin_id' => 'Admin',
			'admin_name' => 'Admin Name',
			'create_time' => 'Create Time',
			'result' => 'Result',
			'ip' => 'Ip',
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
		$criteria->compare('model',$this->model,true);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('admin_name',$this->admin_name);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('result',$this->result,true);
		$criteria->compare('ip',$this->ip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}