<?php

/**
 * This is the model class for table "person".
 *
 * The followings are the available columns in table 'person':
 * @property integer $id
 * @property string $title
 * @property string $image_url
 * @property string $create_time
 * @property integer $hits
 * @property string $last_hit
 * @property string $description
 */
class Person extends ActiveRecord
{
	public $encryptId;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Person the static model class
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
		return 'person';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, image_url', 'required'),
			array('title', 'unique', 'message'=>'名称已经存在'),
			array('hits', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>20),
			array('image_url', 'length', 'max'=>200),
			array('description', 'length', 'max'=>100),
			array('last_hit', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, image_url, create_time, hits, last_hit, description', 'safe', 'on'=>'search'),
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
			'title' => '名称',
			'image_url' => '头像',
			'create_time' => '添加时间',
			'hits' => '得票数',
			'last_hit' => '最后投票时间',
			'description' => '描述',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('image_url',$this->image_url,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('hits',$this->hits);
		$criteria->compare('last_hit',$this->last_hit,true);
		$criteria->compare('description',$this->description,true);
		$criteria->order="id DESC";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getAllRandom()
	{
		$key = "all_person";
		$persons = Yii::app()->cache->get($key);
		if (empty($persons))
		{
			$persons = self::model()->findAll();
			foreach ($persons as $item)
			{
				$item->encryptId = Des::encrypt($item->id);
			}
			Yii::app()->cache->set($key, $persons, 3600);
		}
		$dataprovider = new CActiveDataProvider(self::model(), array());
		$dataprovider->setData($persons);
		return $dataprovider;
	}
}