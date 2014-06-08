<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'nickname',array('class'=>'span5','maxlength'=>30)); ?>

		<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>80)); ?>

		<?php echo $form->textFieldRow($model,'friendcode_1',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'friendcode_2',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'friendcode_3',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'id_safari_type',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'tsv',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'skype',array('class'=>'span5','maxlength'=>30)); ?>

		<?php echo $form->textFieldRow($model,'whatsapp',array('class'=>'span5','maxlength'=>30)); ?>

		<?php echo $form->textFieldRow($model,'facebook',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'mail',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'others',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'comment',array('class'=>'span5','maxlength'=>999)); ?>

		<?php echo $form->textFieldRow($model,'auth',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
