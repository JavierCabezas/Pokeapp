<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'player-form', 'htmlOptions' => array('enctype' => 'multipart/form-data'),
	'enableAjaxValidation'=>true,
)); ?>

<p class="help-block">Campos con <span class="required">*</span> son obligatorios.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'nickname',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>80)); ?>

	<p class='note'>Avatar (formatos válidos png, jpg, gif. Máximo 1 megabyte) </p> 
	<?php echo $form->fileField($model,'avatar'); ?>
	<?php echo $form->error($model,'avatar'); ?>

	<?php echo $form->textFieldRow($model,'friendcode_1',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'friendcode_2',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'friendcode_3',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'mail',array('class'=>'span5','maxlength'=>100)); ?>

    <?php echo $form->labelEx($model,'public_mail'); ?> 
    <?php echo CHtml::dropDownList('Player[public_mail]', $model->public_mail, $array_auth_mail);   ?>

    <?php echo $form->labelEx($model,'id_safari_type'); ?> 
    <?php echo CHtml::dropDownList('Player[id_safari_type]', $model->id_safari_type, $array_types, array('empty' => 'Ingresar tipo de safari'));  ?>

    <div class='safari' id='safari_1'>
    </div>

    <div class='safari' id='safari_2'>
    </div>

    <div class='safari' id='safari_3'>
    </div>


	<?php echo $form->textFieldRow($model,'tsv',array('class'=>'span5')); ?>

	<?php echo $form->labelEx($model,'duel_single'); ?> 
	<?php echo $form->checkBox($model,'duel_single'); ?>

	<?php echo $form->labelEx($model,'tier_single'); ?> 
	<?php echo CHtml::dropDownList('Player[tier_single]', $model->tier_single, $array_tiers, array('empty' => 'Agregar Tier'));  ?>

	<?php echo $form->labelEx($model,'duel_doble'); ?> 
	<?php echo $form->checkBox($model,'duel_doble'); ?>

	<?php echo $form->labelEx($model,'tier_doble'); ?> 
	<?php echo CHtml::dropDownList('Player[tier_doble]', $model->tier_doble, $array_tiers, array('empty' => 'Agregar Tier'));  ?>

	<?php echo $form->labelEx($model,'duel_triple'); ?> 
	<?php echo $form->checkBox($model,'duel_triple'); ?>

	<?php echo $form->labelEx($model,'tier_triple'); ?> 
	<?php echo CHtml::dropDownList('Player[tier_triple]', $model->tier_triple, $array_tiers, array('empty' => 'Agregar Tier'));  ?>

	<?php echo $form->labelEx($model,'duel_rotation'); ?> 
	<?php echo $form->checkBox($model,'duel_rotation'); ?>

	<?php echo $form->labelEx($model,'tier_rotation'); ?> 
	<?php echo CHtml::dropDownList('Player[tier_rotation]', $model->tier_rotation, $array_tiers, array('empty' => 'Agregar Tier'));  ?>

	<?php echo $form->textFieldRow($model,'skype',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'whatsapp',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'facebook',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'others',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textAreaRow($model,'comment',array('class'=>'span5','maxlength'=>999)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Agregar',
		)); ?>
</div>

<?php $this->endWidget(); ?>

<script type='text/javascript'>
	$(document).ready(function () {
		$("#Player_tier_single").prop("disabled", true);
		$("#Player_tier_doble").prop("disabled", true);
		$("#Player_tier_triple").prop("disabled", true);
		$("#Player_tier_rotation").prop("disabled", true);

	    $('#Player_id_safari_type').change(function (event) {
	    	type = $('#Player_id_safari_type').val();
	    	if(type != ''){
	    	//Ajax call to get the first pokémon slot.
		    	$.ajax({
		            'type': 'POST',
		            'url': "<?php echo Yii::app()->createUrl('pokemonFriendSafari/getPokemon') ?>",
		            'dataType': 'html',
		            data: {
		                id_type: type,
		                slot: 1,
		            },
		            'success': function (data) {
		               $('#safari_1').html(data);
		            }
		        });

		    	//Second pokémon slot ...
		    	$.ajax({
		            'type': 'POST',
		            'url': "<?php echo Yii::app()->createUrl('pokemonFriendSafari/getPokemon') ?>",
		            'dataType': 'html',
		            data: {
		                id_type: type,
		                slot: 2,
		            },
		            'success': function (data) {
		               $('#safari_2').html(data);
		            }
		        });

		    	//Third pokémon slot ...
		    	$.ajax({
		            'type': 'POST',
		            'url': "<?php echo Yii::app()->createUrl('pokemonFriendSafari/getPokemon') ?>",
		            'dataType': 'html',
		            data: {
		                id_type: type,
		                slot: 3,
		            },
		            'success': function (data) {
		               $('#safari_3').html(data);
		            }
		        });
		    }else{ //if type equals ''
		    	$('#safari_1').html('');
		    	$('#safari_2').html('');
		    	$('#safari_3').html('');
		    }
	    });
	//Checkboxes
	$('#Player_duel_single').change(function() {
		if($(this).is(":checked")) {
			$("#Player_tier_single").prop("disabled", false);
		}else{
			$("#Player_tier_single").prop("disabled", true);
		}
	});

	$('#Player_duel_doble').change(function() {
		if($(this).is(":checked")) {
			$("#Player_tier_doble").prop("disabled", false);
		}else{
			$("#Player_tier_doble").prop("disabled", true);
		}
	});

	$('#Player_duel_triple').change(function() {
		if($(this).is(":checked")) {
			$("#Player_tier_triple").prop("disabled", false);
		}else{
			$("#Player_tier_triple").prop("disabled", true);
		}
	});

	$('#Player_duel_rotation').change(function() {
		if($(this).is(":checked")) {
			$("#Player_tier_rotation").prop("disabled", false);
		}else{
			$("#Player_tier_rotation").prop("disabled", true);
		}
	});

});
</script>
