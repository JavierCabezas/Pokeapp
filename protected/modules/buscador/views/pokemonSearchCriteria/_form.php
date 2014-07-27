<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'pokemon-search-criteria-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'id_pokemon',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'haircut',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'clothes',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'weird_sex',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'object',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'cute',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'animal',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'myth',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'moustache',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'hurr',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'rough',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fluffy',array('class'=>'span5')); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
