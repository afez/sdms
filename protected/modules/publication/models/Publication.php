<?php

/**
 * This is the model class for table "publication".
 *
 * The followings are the available columns in table 'publication':
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $docupload
*  @property integer $staff_id

 * @property integer $year
 

 * @property integer $uplooadedby
 */
class Publication extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Publication the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'publication';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, type,staff_id, year,docupload', 'required'),
            array('uplooadedby', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 50),
            array('type', 'length', 'max' => 800),
            array('docupload', 'length', 'max' => 100),
           
            array('docupload','file', 'types'=>'pdf'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, type, staff_id, year,college,docupload,  uplooadedby', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
         return array(
            'staff'=>array(self::HAS_ONE,'Staff','','foreignKey'=>array('id'=>'staff_id')),
              'reviewer' => array(self::MANY_MANY, 'Staff', 'reviewer(publication_id, staff_id'),
            
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'docupload' => 'Docupload',
          
            
            'description' => 'Description',
            'uplooadedby' => 'Uplooadedby',
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
        $criteria->compare('type', $this->type, true);
        $criteria->compare('docupload', $this->docupload, true);
        $criteria->compare('cvupload', $this->cvupload, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('uplooadedby', $this->uplooadedby);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function getType(){
        return array(
            'Journal Paper'=>'Journal Paper',
            'Conference Papers'=>'Conference Papers',
            'Book & Books Chapters'=>'Book & Books Chapters',
            'Consultancy Reports'=>'Consultancy Reports',
            
        );
    }

    public function beforeSave() {
        if (parent::beforeSave()) {
            $this->uplooadedby = User::loggedUser()->id;
            return TRUE;
        }
    }

    

    public function upload() {
        $doc = time() . '.' . $this->docupload->getExtensionName();
        if ($this->docupload->saveAs(Yii::getPathOfAlias('webroot.publication') . '/' . $doc)) {
            $this->docupload = $doc;
            return TRUE;
        }
        return FALSE;
    }
 public static function getStaff() {
       $criteria = new CDbCriteria;
       $criteria->select = 'id,title,first_name, middle_name, last_name';  // only select the name columns              
        $staffs= Staff::model()->findAll($criteria);
       
       foreach ($staffs as $g){
            $d[$g->id] = ($g->title.' '.$g->first_name.''.$g->middle_name.''.$g->last_name);
       }
       return $d;
 }
}
