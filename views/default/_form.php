<div class="panel panel-default">

    <table class="table">
        <tbody>
            <tr>
                <td width="15%">ID</td>
                <td><?php echo $sourceMessage->id ?></td>
            </tr>
            <tr>
                <td>Kategorie</td>
                <td><?php echo $sourceMessage->category ?></td>
            </tr>
            <tr>
                <td>Schlüssel</td>
                <td><?php echo $sourceMessage->message ?></td>
            </tr>
        </tbody>
    </table>
</div>


<?php echo CHtml::beginForm(); ?>

<?php foreach($messages as $i=>$message): ?>
    <?php echo CHtml::errorSummary($message); ?>
    <div class="form-group">
        <label for="message-<?php echo $i ?>" class="control-label"><?php echo strtoupper($message->language) ?></label>
        <?php echo CHtml::activeTextArea($message,"[$i]translation", array('id' => 'message-'.$i, 'class' => 'form-control')); ?>
    </div>
    <?php endforeach; ?>

    <div class="form-group">
        <?php echo CHtml::submitButton('Speichern', array('class' => 'btn btn-primary')); ?>
    </div>
<?php echo CHtml::endForm(); ?>

