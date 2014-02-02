<?php

class DbtModule extends CWebModule
{

    /**
     * @var array|string
     */
    public $import;

    /**
     * @var string
     */
    public $languageModel;

    /**
     * @var array
     */
    public $accessRules;

    /**
     * Pre-Initialiser (setting defaults)
     */
    public function preinit()
    {
        $this->accessRules = array(
            array('allow',
                'roles' => array('admin')
            ),
            array('deny',
                'users' => array('*')
            )
        );
    }

    /**
     * Initialiser
     */
    public function init()
    {
        $import = array_merge(
            array(
            'dbt.models.*'
            ), is_array($this->import) ? $this->import : array($this->import)
        );
        $this->setImport($import);
    }

    /**
     * Missing Translation Handler
     *
     * @param CMissingTranslationEvent $event
     */
    public function missingTranslationHandler($event)
    {
        $tableName = Yii::app()->messages->sourceMessageTable;
        $row = Yii::app()->db->createCommand()
            ->select('*')
            ->from($tableName)
            ->where('category=:category AND message=:message', array(
                ':category' => $event->category,
                ':message' => $event->message
            ))
            ->queryRow();

        if (empty($row)) {
            Yii::app()->db->createCommand()->insert($tableName, array(
                'category' => $event->category,
                'message' => $event->message,
            ));
        }
    }

    /**
     * @param string $message
     * @param string $category
     * @return string
     */
    public static function t($message, $params = array(), $source = null, $language = null)
    {
        return Yii::t('dbt', $message, $params, $source, $language);
    }

}
