<?php

/**
 * This is the model class for table "comment".
 *
 * The followings are the available columns in table 'comment':
 * @property integer $comment_id
 * @property string $publication_quality
 * @property string $merit_promotion
 * @property string $other_comment
 */
class Comment extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Comment the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public static function getOption() {
        return array(
            'Yes' => 'Yes',
            'Not quite' => 'Not Quite',
            'No' => 'No',
        );
    }

    public function tableName() {
        return 'comment';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
        return array(
            array('publication_quality, merit_promotion, other_comment', 'required'),
            array('publication_quality, merit_promotion', 'length', 'max' => 200),
            // The following rule is used by search().
// Please remove those attributes that should not be searched.
            array('comment_id, publication_quality, merit_promotion, other_comment', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'comment_id' => 'Comment',
            'publication_quality' => 'Publication Quality',
            'merit_promotion' => 'Merit Promotion',
            'other_comment' => 'Other Comment',
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

        $criteria->compare('comment_id', $this->comment_id);
        $criteria->compare('publication_quality', $this->publication_quality, true);
        $criteria->compare('merit_promotion', $this->merit_promotion, true);
        $criteria->compare('other_comment', $this->other_comment, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
