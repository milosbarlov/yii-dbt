
<h1><?php echo Yii::t('dbt', 'Übersetzungen') ?></h1>
<div class="text-left"><?php echo CHtml::link('Hinzufügen', array('create'), array('class' => 'btn btn-default')) ?></div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'cssFile' => false,
    'itemsCssClass' => 'table table-striped',
    'dataProvider' => $model->search(),
    'columns' => array(
        'id',
        'category',
        'message',
        array(
            'value' => '$data->translatedMessages()',
        ),
        array(
            'class' => 'CButtonColumn'
        )
    ),
    'filter' => $model,
    'pagerCssClass' => 'pagination',
    #'pager' => array('header' => '', 'htmlOptions'=>array('class'=>'pagination', 'cssFile' => false))
));

?>