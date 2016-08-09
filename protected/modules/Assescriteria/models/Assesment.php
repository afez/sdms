<?php

/**
 * This is the model class for table "assescriteria".
 *
 * The followings are the available columns in table 'assescriteria':
 * @property integer $id
 * @property integer $coverag
 * @property integer $originality
 * @property integer $Contribut
 * @property integer $academic_discipline
 * @property integer $specialize
 * @property integer $presentation
 * @property integer $overall_quality
 * @property varchar $assedby Description
 */
class Assesment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Assesment the static model class
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
		return 'assescriteria';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('originality, Contribut,remark, academic_discipline, specialize, presentation, overall_quality', 'required'),
			array('coverag, originality, Contribut, academic_discipline, specialize, presentation, overall_quality', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, assedby,remark, coverag, originality, Contribut, academic_discipline, specialize, presentation, overall_quality', 'safe', 'on'=>'search'),
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
                 
                       'reviewer'=>array(self::HAS_ONE,'User','','foreignKey'=>array('id'=>'assedby')),
                      'publication'=>array(self::HAS_ONE,'Publication','','foreignKey'=>array('id'=>'publication_id')),
                   
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'coverag' => 'Coverag',
			'originality' => 'Originality',
			'Contribut' => 'Contribut',
			'academic_discipline' => 'Academic Discipline',
			'specialize' => 'Specialize',
			'presentation' => 'Presentation',
			'overall_quality' => 'Overall Quality',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
         public function beforeSave() {
        if (parent::beforeSave()) {
            $this->assedby = User::loggedUser()->id;
            return TRUE;
        }
    }
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('coverag',$this->coverag);
		$criteria->compare('originality',$this->originality);
		$criteria->compare('Contribut',$this->Contribut);
		$criteria->compare('academic_discipline',$this->academic_discipline);
		$criteria->compare('specialize',$this->specialize);
		$criteria->compare('presentation',$this->presentation);
		$criteria->compare('overall_quality',$this->overall_quality);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}