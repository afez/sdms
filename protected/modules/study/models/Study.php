<?php

/**
 * This is the model class for table "study".
 *
 * The followings are the available columns in table 'study':
 * @property integer $id
 * @property string $level
 * @property integer $staff_id
 * @property string $university
 * @property string $status
 * @property integer $year_of_study
 */
class Study extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Study the static model class
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
		return 'study';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' staff_id, university, status, year_of_study', 'required'),
			array('id, staff_id, year_of_study', 'numerical', 'integerOnly'=>true),
			array('level', 'length', 'max'=>45),
			array('university', 'length', 'max'=>200),
			array('status', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, level, staff_id, university, status, year_of_study', 'safe', 'on'=>'search'),
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
                     'staff'=>array(self::HAS_ONE,'Staff','','foreignKey'=>array('id'=>'staff_id'))
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'level' => 'Level',
			'staff_id' => 'Staff',
			'university' => 'University',
			'status' => 'Status',
			'year_of_study' => 'Year Of Study',
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
		$criteria->compare('level',$this->level,true);
		$criteria->compare('staff_id',$this->staff_id);
		$criteria->compare('university',$this->university,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('year_of_study',$this->year_of_study);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}