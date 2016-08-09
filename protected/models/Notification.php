<?php

/**
 * This is the model class for table "notification".
 *
 * The followings are the available columns in table 'notification':
 * @property integer $id
 * @property string $type
 * @property string $content
 * @property integer $staff_id
 */
class Notification extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Notification the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'notification';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('staff_id', 'required'),
            array('staff_id', 'numerical', 'integerOnly' => true),
            array('type', 'length', 'max' => 45),
            array('content', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, type, content, staff_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'type' => 'Type',
            'content' => 'Content',
            'staff_id' => 'Staff',
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
        $criteria->compare('type', $this->type, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('staff_id', $this->staff_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function collect() {
        self::overstayed();
        return [
            'overstay' => self::fetch()
        ];
    }

    public static function fetch() {
        $cr = new CDbCriteria();
        $cr->condition = 'status=1';
        $ns = self::model()->findAll($cr);
        $ar = [];
        foreach ($ns as $n) {
            $ar[] = ["name" => $n->content, "overdue" => "20"];
            $mod = self::model()->find("id=" . $n->id);
            $mod->attributes = array(
                "status" => 1);
            $mod->unsetAttributes();
            $mod->setIsNewRecord(true);
            $mod->save();
        }
        return $ar;
    }

    public static function overstayed() {
        $cr = new CDbCriteria();
        $cr->select = '*, DATEDIFF(CURDATE(),start_date) overdue';
        $cr->condition = "DATEDIFF(CURDATE(),start_date) >= 100";
        $ov = Staff::model()->findAll($cr);
        foreach ($ov as $v) {
            if (!self::model()->exists("staff_id=" . $v->id . " AND type='OVERSTAYED'")) {
                $conetnt =$v->title . ' ' . $v->first_name . ' ' . $v->middle_name . ' ' . $v->last_name . " has overstayed";
                $type = "OVERSTAYED";
                //insert into db
                $model = self::model();
                $model->unsetAttributes();
                $model->attributes = array(
                    'type' => $type,
                    'content' => $conetnt,
                    'phone'=>$v->phone,
                    'staff_id' => $v->id
                );
                $model->setIsNewRecord(true);
                $model->save();
            }
        }
    }
    
    
    
    public static function getOverstay() {
        $cr = new CDbCriteria();
        $cr->select = '*, DATEDIFF(CURDATE(),start_date) overdue';
        $cr->condition = "DATEDIFF(CURDATE(),start_date) >= 500";
        $ov = Staff::model()->findAll($cr);
        return $ov;
    }

}
