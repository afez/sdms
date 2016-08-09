<?php

/**
 * This is the model class for table "publication".
 *
 * The followings are the available columns in table 'publication':
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $docupload
 * @property string $cvupload
 * @property string $status
 * @property string $description
 * @property integer $uploadedby
 */
class Publication extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Publication the static model class
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
		return 'publication';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uploadedby, name, type, docupload, description', 'required'),
			array('name', 'length', 'max'=>50),
			array('type', 'length', 'max'=>20),
			array('docupload, cvupload', 'length', 'max'=>100),
			array('status', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, type, docupload, cvupload, status, description', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'type' => 'Type',
			'docupload' => 'Docupload',
			'cvupload' => 'Cvupload',
			'status' => 'Status',
			'description' => 'Description',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('docupload',$this->docupload,true);
		$criteria->compare('cvupload',$this->cvupload,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        public function beforeSave() {
            if(parent::beforeSave()){
                $this->uploadedby = User::loggedUser()->id;
                return TRUE;
            }
        }
        
        public function upload() {

        $doc = time() . '.' . $this->docupload->getExtensionName();
        if ($this->docupload->saveAs(Yii::getPathOfAlias('webroot.publication').'/' . $doc)) {
            $this->docupload= $doc;
            return TRUE;
        }
        return FALSE;
    }
}