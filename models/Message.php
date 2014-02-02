<?php

class Message extends CActiveRecord
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
        return Yii::app()->messages->translatedMessageTable;
    }

    public function __toString()
    {
        return $this->title;
    }

    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('dbt', 'message.id'),
            'language' => Yii::t('dbt', 'message.language'),
            'translation' => Yii::t('dbt', 'message.translation')
        );
    }

    public function relations()
    {
        return array(
            'relSourceMessage'=>array(self::BELONGS_TO, 'SourceMessage', 'id')
        );
    }

    public function rules()
    {
        return array(
            array('language', 'required'),
            array('translation', 'filter', 'filter' => 'trim'),
        );
    }

    /**
     * @return CActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria();
        foreach ($this->getAttributes() AS $key => $value) {
            if ($key == 'default')
                continue;
            $criteria->compare($key, $this->$key, true);
        }
        return new CActiveDataProvider('Language', array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.id ASC',
            ),
            'pagination' => array(
                'pageSize' => 20
            )
        ));
    }

}
