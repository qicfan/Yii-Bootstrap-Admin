<?php

/**
 * This is the model class for table "admin_actions".
 *
 * The followings are the available columns in table 'admin_actions':
 * @property integer $id
 * @property string $title
 * @property integer $parent_id
 * @property string $action
 */
class AdminActions extends ActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdminActions the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'admin_actions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, parent_id, action', 'required'),
			array('parent_id', 'numerical', 'integerOnly' => true),
			array('title, action', 'length', 'max' => 20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, parent_id, action', 'safe', 'on' => 'search'),
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
			'id'		 => 'ID',
			'title'		 => '动作名称',
			'parent_id'	 => '父级ID',
			'action'	 => '动作标识',
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
		$criteria->compare('title', $this->title, true);
		$criteria->compare('parent_id', $this->parent_id);
		$criteria->compare('action', $this->action, true);

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
				));
	}

	/**
	 * 得到所有动作列表的一个树形结构
	 * 返回值结构：array(
	 * 
	 * @param type $id 当前ID
	 */
	public static function getAllActions($selectId=-1, $selectTag='')
	{
		$actions = self::model()->findAll();
		if (empty($actions))
		{
			return array();
		}
		$return = array();
		// 先找出所有的父级
		foreach ($actions as $k=>$action)
		{
			$return[] = array(
				'id'=>$action->id, 
				'name'=>$action->title, 
				'action'=>$action->action, 
				'parent_id'=>$action->parent_id,
				'selected'=>$selectId==-1 ? false : $action->id==$selectId ? $selectTag : false,
			);
		}
		return $return;
	}

}