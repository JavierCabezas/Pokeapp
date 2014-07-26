<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'id_tournament_player',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'id_pokemon_species',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'nickname',array('class'=>'span5','maxlength'=>12)); ?>

		<?php echo $form->textFieldRow($model,'id_ability',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'id_nature',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'id_item',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'id_move1',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'id_move2',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'id_move3',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'id_move4',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'level',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'hp',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'atk',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'def',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'spa',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'spd',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'spe',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
