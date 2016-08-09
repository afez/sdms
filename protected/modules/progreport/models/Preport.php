<?php

/**
 * This is the model class for table "progreport".
 *
 * The followings are the available columns in table 'progreport':
 * @property integer $id
 * @property string $name
 * @property string $report
 * @property string $description
 * @property string $uploader
 */
class Preport extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Preport the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'progreport';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, report, description', 'required'),
            array('name', 'length', 'max' => 50),
            array('report', 'length', 'max' => 100),
            array('uploader', 'length', 'max' => 40),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, report, description, uploader', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
              'uploadby'=>array(self::HAS_ONE,'User','','foreignKey'=>array('id'=>'uploader'))
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'report' => 'Report',
            'description' => 'Description',
            'uploader' => 'Uploader',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('report', $this->report, true);
        $criteria->compare('description', $this->description, true);
  

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function upload() {

        $doc = time() . '.' . $this->report->getExtensionName();
        if ($this->report->saveAs(Yii::getPathOfAlias('webroot.report') . '/' . $doc)) {
            $this->report = $doc;
            return TRUE;
        }
        return FALSE;
    }

  public function beforeSave() {
        if (parent::beforeSave()) {
            $this->uploader = User::loggedUser()->id;
            return TRUE;
        }
    }
}
