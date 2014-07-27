<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

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
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
