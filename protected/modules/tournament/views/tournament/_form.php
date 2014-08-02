<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tournament-player-form', 'htmlOptions' => array('enctype' => 'multipart/form-data'),
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Campos con <span class="required">*</span> son obligatorios.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>80)); ?>

	<?php echo $form->textFieldRow($model,'mail',array('class'=>'span5','maxlength'=>100)); ?>
	
	<label class="required" for="folio"> Foto de tu entrada (con folio visible) <span class="required">*</span> </label>
	<?php echo $form->fileField($model,'folio'); ?>
	<?php echo $form->error($model,'folio'); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear usuario' : 'Guardar',
		)); ?>
</div>

<?php $this->endWidget(); ?>
