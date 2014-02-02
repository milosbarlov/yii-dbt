<?php

class SourceMessage extends CActiveRecord
{

    /**
     * @return CActiveRecord
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string
     */
    public function tableName()
    {
        return Yii::app()->messages->sourceMessageTable;
    }

    public function __toString()
    {
        return $this->message;
    }

    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('dbt', 'sourcemessage.id'),
            'category' => Yii::t('dbt', 'sourcemessage.category'),
            'message' => Yii::t('dbt', 'sourcemessage.message')
        );
    }

    public function relations()
    {
        return array(
            'relMessages'=>array(self::HAS_MANY, 'Message', 'id')
        );
    }

    /**
     * @return array
     */
    public function rules() {
        $fields = implode(',', array_keys($this->getAttributes()));
        return array(
            array('category', 'required'),
            array('message', 'required'),
            array($fields, 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return CActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria();
        foreach ($this->getAttributes() AS $key => $value) {
            $criteria->compare($key, $this->$key, true);
        }
        return new CActiveDataProvider('SourceMessage', array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.id ASC',
            ),
            'pagination' => array(
                'pageSize' => 20
            )
        ));
    }

    public function getTranslatedMessages()
    {
        $langs = array();
        foreach($this->relMessages AS $message) {
            if(!empty($message->translation)) {
                $langs[] = $message->language;
            }
        }
        return $langs;
    }

    public function translatedMessages()
    {
        return implode(', ', $this->getTranslatedMessages());
    }

}
