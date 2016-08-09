<?php

/**
 * This is the model class for table "staff".
 *
 * The followings are the available columns in table 'staff':
 * @property integer $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $start_date
 * @property integer $department_id
 * @property string $DOB
 * @property string $college
 * @property string $department
 * @property string $descrpt
 * @property integer $phone
 * @property string $email
 * @property string $imagepath
 * @property string $education
 * @property string $status
 * @property integer $phone2
 * @property string $email2
 * @property string $title
 * @property string $username
 */
class Staff extends CActiveRecord {

    public $overdue;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Staff the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'staff';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(' title, username,status,  DOB,imagepath, college_id,  department_id,phone, email,  phone2, email2', 'required', 'on' => 'insert'),
            array(' title, college_id, status, department_id,imagepath, DOB, college,  department,phone, email,  phone2, email2', 'required', 'on' => 'update'),
            array('department_id', 'numerical', 'integerOnly' => true),
            array('first_name, middle_name, last_name', 'length', 'max' => 45),
            array('college, department', 'length', 'max' => 200),
            array('email, imagepath, education, email2', 'length', 'max' => 100),
            array('start_date', 'safe'),
            array('email, email2', 'email'),
            array('imagepath', 'file', 'allowEmpty' => true, 'types' => 'jpeg, jpg, png'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id,username, status, title,first_name, middle_name, last_name, start_date, department_id, DOB, college, department,  phone, email, imagepath, education, phone2, email2', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
            'college' => array(self::BELONGS_TO, 'College', 'college_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'start_date' => 'Start Date',
            'DOB' => 'Dob',
            'college' => 'College',
            'department' => 'Department',
            'descrpt' => 'Descrpt',
            'phone' => 'Phone',
            'email' => 'Email',
            'imagepath' => 'Imagepath',
            'education' => 'Education',
            'exprience' => 'Exprience',
            'phone2' => 'Phone2',
            'email2' => 'Email2',
        );
    }

    public static function getTitle() {
        return array(
            'Mr.' => 'Mr.',
            'Ms.' => 'Ms.',
            'Dr.' => 'Dr.',
            'Prof.' => 'Prof.',
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
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('middle_name', $this->middle_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('start_date', $this->start_date, true);
        $criteria->compare('department_id', $this->department_id);
        $criteria->compare('DOB', $this->DOB, true);
        $criteria->compare('college', $this->college, true);
        $criteria->compare('department', $this->department, true);
        $criteria->compare('descrpt', $this->descrpt, true);
        $criteria->compare('phone', $this->phone);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('imagepath', $this->imagepath, true);
        $criteria->compare('education', $this->education, true);
        $criteria->compare('exprience', $this->exprience, true);
        $criteria->compare('phone2', $this->phone2);
        $criteria->compare('email2', $this->email2, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function getDepartment() {
        $criteria = new CDbCriteria;
        $criteria->select = 'id,name';  // only select the name columns              
        $colleges = Department::model()->findAll($criteria);

        foreach ($colleges as $g) {
            $d[$g->id] = $g->name;
        }
        return $d;
    }

    public static function getLevel() {
        return
                array(
                    'diploma' => 'diploma',
                    'degree' => 'degree',
                    'masters' => 'masters',
                    'PhD' => 'PhD',
        );
    }

    public static function getStatus() {
        return
                array(
                    'on work' => 'on work',
                    'on studies' => 'on studies',
        );
    }

    public function upload() {

        $doc = time() . '.' . $this->imagepath->getExtensionName();
        if ($this->imagepath->saveAs(Yii::getPathOfAlias('webroot.profile') . '/' . $doc)) {
            $this->imagepath = $doc;
            return TRUE;
        }
        return FALSE;
    }

}
