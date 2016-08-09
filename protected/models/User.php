<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 */
class User extends CActiveRecord {

    public $old_password;
    public $new_password;
    public $repeat_password;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function getReport() {
        return array(
        );
    }

    public function tableName() {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {

        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, password, role_id ', 'required'),
            array('id', 'numerical', 'integerOnly' => true),
            array('username, password', 'length', 'max' => 100),
            array('old_password, new_password, repeat_password', 'required', 'on' => 'changePwd'),
            array('old_password', 'findPasswords', 'on' => 'changePwd'),
            array('repeat_password', 'compare', 'compareAttribute' => 'new_password', 'on' => 'changePwd'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, username, password', 'safe', 'on' => 'search'),
//            array('username', 'email'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function findPasswords($attribute, $params) {
        $user = User::model()->findByPk(Yii::app()->user->username);
        if ($user->password != md5($this->old_password))
            $this->addError($attribute, 'Old password is incorrect.');
    }

    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'role' => array(self::BELONGS_TO, 'Role', 'role_id'),
            'staff' => array(self::HAS_ONE, 'Staff', 'user_id'),
            'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
            'reviewer' => array(self::HAS_ONE, 'Exreview', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public static function getStatusOptions() {
        return array(
            'active' => 'Active',
            'inactive' => 'Inactive',
        );
    }

    public static function loggedUser() {

        return User::model()->findByAttributes(array("username" => Yii::app()->user->id));
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
        );
    }

    public static function getRole() {
        $criteria = new CDbCriteria;
        $criteria->select = 'id,name';  // only select the name columns              
        $roles = Role::model()->findAll($criteria);

        foreach ($roles as $g) {
            $d[$g->id] = $g->name;
        }
        return $d;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;


        $criteria->compare('username', $this->username, true);


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
