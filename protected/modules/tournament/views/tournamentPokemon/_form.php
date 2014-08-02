<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tournament-pokemon-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Campos con<span class="required">*</span> son requeridos.</p>

<p> 
	El que la información que entregues en este formulario sea verídica y que cumpla las reglas del torneo es de tu total responsabilidad.
	Aún así se eliminó algunos de los pokémon que están prohibidos según las reglas del torneo. 
</p>
<p>
	Además ten en cuenta que hay movimientos que, si bien son legales <b> {[PATO, NECEISTO EJEMPLOS ACÁ ]} </b>
</p>

<?php echo $form->errorSummary($model); ?>
<div id="column1-wrap">
    <div id="column1_50">
		<label class="required" for="TournamentPokemon_id_pokemon_species"> Pokémon <span class="required">*</span> </label>
		<?php
			$this->widget(
				'bootstrap.widgets.TbSelect2',
				array(
					'name' => 'TournamentPokemon[id_pokemon_species]',
					'data' => $array_pokemon,
				)
			);
		?>

		<label class="required" for="TournamentPokemon_id_ability"> Habilidad <span class="required">*</span> </label>
		<?php
			$this->widget(
				'bootstrap.widgets.TbSelect2',
				array(
					'name' => 'TournamentPokemon[id_ability]',
					'data' => $array_ability,
				)
			);
		?>


		<label class="required" for="TournamentPokemon_id_nature"> Naturaleza <span class="required">*</span> </label>
		<?php
			$this->widget(
				'bootstrap.widgets.TbSelect2',
				array(
					'name' => 'TournamentPokemon[id_nature]',
					'data' => $array_nature,
				)
			);
		?>


		<label class="required" for="TournamentPokemon_id_item"> Item </label>
		<?php
			$this->widget(
				'bootstrap.widgets.TbSelect2',
				array(
					'name' => 'TournamentPokemon[id_item]',
					'data' => $array_item,
					'options' => array(
						'allowClear'=>true,
						'placeholder' => 'Elige un objeto'
					),
				)
			);
		?>

		<label class="required" for="TournamentPokemon_id_move1"> Movimiento 1 <span class="required">*</span> </label>
		<?php
			$this->widget(
				'bootstrap.widgets.TbSelect2',
				array(
					'name' => 'TournamentPokemon[id_move1]',
					'data' => $array_moves,
				)
			);
		?>

		<label class="required" for="TournamentPokemon_id_move2"> Movimiento 2 </label>
		<?php
			$this->widget(
				'bootstrap.widgets.TbSelect2',
				array(
					'name' 			=> 'TournamentPokemon[id_move2]',
					'data' 			=> $array_moves,
					'options' 		=> array(
						'allowClear'=>true,
						'placeholder' => 'Elige un movimiento'
					),
				)
			);
		?>

		<label class="required" for="TournamentPokemon_id_move3"> Movimiento 3  </label>
		<?php
			$this->widget(
				'bootstrap.widgets.TbSelect2',
				array(
					'name' => 'TournamentPokemon[id_move3]',
					'data' => $array_moves,
					'options' => array(
						'allowClear'=>true,
						'placeholder' => 'Elige un movimiento'
					),
				)
			);
		?>

		<label class="required" for="TournamentPokemon_id_move4"> Movimiento 4  </label>
		<?php
			$this->widget(
				'bootstrap.widgets.TbSelect2',
				array(
					'name' 			=> 'TournamentPokemon[id_move4]',
					'data' 			=> $array_moves,
					'options' => array(
						'allowClear'=>true,
						'placeholder' => 'Elige un movimiento'
					),
				)
			);
		?>
		<?php if($model->isNewRecord): //Just show the tournament inscription if the pokémon is a new one. ?>
			<label class="required" for="torneo"> Inscribir al pokémon en un torneo? </label>
			<?php echo CHtml::dropDownList('torneo', '' , $array_tournament, array('class' => 'span5')); ?>
		<?php endif; ?>
	
	</div>
</div>

<div id="column2_50">
	<?php echo $form->textFieldRow($model,'nickname',array('class'=>'span5','maxlength'=>12)); ?>

	<?php echo $form->numberFieldRow($model,'level',array('class'=>'span5', 'min' => 1, 'max' => 100)); ?>

	<?php echo $form->numberFieldRow($model,'hp',array('class'=>'span5', 'min' => 1)); ?>

	<?php echo $form->numberFieldRow($model,'atk',array('class'=>'span5', 'min' => 1)); ?>

	<?php echo $form->numberFieldRow($model,'def',array('class'=>'span5', 'min' => 1)); ?>

	<?php echo $form->numberFieldRow($model,'spa',array('class'=>'span5', 'min' => 1)); ?>

	<?php echo $form->numberFieldRow($model,'spd',array('class'=>'span5', 'min' => 1)); ?>

	<?php echo $form->numberFieldRow($model,'spe',array('class'=>'span5', 'min' => 1)); ?>
</div>
<div class='clear'> </div>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
</div>

<?php $this->endWidget(); ?>