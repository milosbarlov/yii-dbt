<?php

class DefaultController extends CController
{

    public function filters()
    {
        return array(
            'accessControl'
        );
    }

    public function accessRules()
    {
        return $this->getModule()->accessRules;
    }

    public function actionIndex()
    {
        $model = new SourceMessage('search');

        $model->unsetAttributes();
        if (isset($_GET['SourceMessage'])) {
            $model->attributes = $_GET['SourceMessage'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new SourceMessage;
        if (isset($_POST['SourceMessage'])) {
            $model->attributes = $_POST['SourceMessage'];
            if ($model->save())
                $this->redirect(array('update', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $sourceMessage = SourceMessage::model()->findByPk($id);
        if (is_null($sourceMessage)) {
            throw new CHttpException(400, 'Page not found.');
        }

        $messages = $this->getMessagesToUpdate($sourceMessage);
        if (isset($_POST['Message'])) {
            $valid = true;
            foreach ($messages as $i => $message) {
                if (isset($_POST['Message'][$i]))
                    $message->attributes = $_POST['Message'][$i];
                $valid = $message->validate() && $valid;
            }
            if ($valid) {
                foreach ($messages as $i => $message) {
                    $message->id = $id;
                    $message->save(false);
                }
                $this->redirect(array('index'));
            }
        }

        $this->render('update', array(
            'sourceMessage' => $sourceMessage,
            'messages' => $messages
        ));
    }

    public function actionView($id)
    {
        $sourceMessage = SourceMessage::model()->findByPk($id);
        if (is_null($sourceMessage)) {
            throw new CHttpException(400, 'Page not found.');
        }
        $messages = $this->getMessagesToUpdate($sourceMessage);
        $this->render('view', array(
            'sourceMessage' => $sourceMessage,
            'messages' => $messages
        ));
    }

    public function actionDelete($id)
    {
        $sourceMessage = SourceMessage::model()->findByPk($id);
        if (is_null($sourceMessage)) {
            throw new CHttpException(400, 'Page not found.');
        }

        $sourceMessage->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(array('index'));
    }

    protected function getMessagesToUpdate($sourceMessage)
    {
        $tmpMessages = $sourceMessage->relMessages();
        $messages = array();

        $className = $this->getModule()->languageModel;
        $languages = $className::model()->findAll();

        foreach ($languages AS $language) {
            $found = false;
            foreach ($tmpMessages AS $message) {
                if ($message->language == $language->language) {
                    $messages[] = $message;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $message = new Message();
                $message->language = $language->language;
                $messages[] = $message;
            }
        }

        return $messages;
    }

}