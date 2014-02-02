<h1><?php echo Yii::t('dbt', 'Übersetzung') ?></h1>

<div class="panel panel-default">
    <div class="panel-heading">Quelle</div>
    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>ID</dt>
            <dd><?php echo $sourceMessage->id ?></dd>
            <dt>Kategorie</dt>
            <dd><?php echo $sourceMessage->category ?></dd>
            <dt>Schlüssel</dt>
            <dd><?php echo $sourceMessage->message ?></dd>
        </dl>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Übersetzungen</div>
    <table class="table">
    <?php foreach($messages as $i=>$message): ?>
        <tr>
            <td width="15%"><?php echo strtoupper($message->language) ?></td>
            <td><?php echo $message->translation ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>

<p><?php echo CHtml::link('Zurück', array('index'), array('class' => 'btn btn-link')) ?>