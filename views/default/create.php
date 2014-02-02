<h1>Übersetzung hinzufügen</h1>

<div class="xform">

<?php $form=$this->beginWidget('CActiveForm'); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo CHtml::errorSummary($model); ?>

    <div class="form-group">
		<?php echo $form->labelEx($model,'category'); ?>
		<?php echo $form->textField($model,'category',array('class' => 'form-control', 'size'=>80,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'category'); ?>
	</div>

    <div class="form-group">
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textField($model,'message',array('class' => 'form-control', 'size'=>80,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'message'); ?>
	</div>

	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->