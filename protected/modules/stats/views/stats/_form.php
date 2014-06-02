<?php
/**
 * This is the main form for the stats module. It contains the pokémon, the item, IV, EV, etc. 
 * Its called by the index view two times (once per pokémon).
 */
?>

	<?php echo CHtml::beginForm(array('calculateStats')); ?>

	<?php //Pokémon form
		$this->widget(
			'bootstrap.widgets.TbSelect2',
			array(
				'name' => 'pokemon_'.$n,
				'data' => $array_pokeymans,
				'htmlOptions' => array(
					'multiple' => false,
				),
			)
		);
	?>

	<?php //Item  form
		$this->widget(
			'bootstrap.widgets.TbSelect2',
			array(
				'name' => 'item_'.$n,
				'data' => $array_items,
				'htmlOptions' => array(
					'multiple' => false,
				),
			)
		);
	?>

	<!-- IV Zone -->
	<label>IV Puntos de impacto:</label>
	<input type="number" id="iv_hp_text_<?php echo $n ?>" style="border:0; color:#f6931f; font-weight:bold;" value="31" min="1" max="31" />
	<?php
	$this->widget('zii.widgets.jui.CJuiSliderInput', array(
	    'name'=>'iv_hp_'.$n,
	    'value'=>31,
	    'event'=>'change',
	    'options'=>array(
	        'min'=>0, 
	        'max'=>31, 
	        'animate'=>true,
	        'range'=>'max',
	        'slide'=>'js:function(event,ui){$("#iv_hp_text_'.$n.'").val(ui.value);}',
	    ),
	    'htmlOptions'=>array(
	        'style'=>'width:200px;background-color:red;'
	    ),
	));
	?>

	<label>IV Ataque:</label>
	<input type="number" id="iv_atk_text<?php echo $n ?>" style="border:0; color:#f6931f; font-weight:bold;" value="31" min="1" max="31" />
	<?php
	$this->widget('zii.widgets.jui.CJuiSliderInput', array(
	    'name'=>'iv_atk_'.$n,
	    'value'=>31,
	    'event'=>'change',
	    'options'=>array(
	        'min'=>0, 
	        'max'=>31, 
	        'animate'=>true,
	        'range'=>'max',
	        'slide'=>'js:function(event,ui){$("#iv_atk_text'.$n.'").val(ui.value);}',
	    ),
	    'htmlOptions'=>array(
	        'style'=>'width:200px;background-color:red;'
	    ),
	));
	?>

	<label>IV Defensa:</label>
	<input type="number" id="iv_def_text_<?php echo $n ?>" style="border:0; color:#f6931f; font-weight:bold;" value="31" min="1" max="31" />
	<?php
	$this->widget('zii.widgets.jui.CJuiSliderInput', array(
	    'name'=>'iv_def_'.$n,
	    'value'=>31,
	    'event'=>'change',
	    'options'=>array(
	        'min'=>0, 
	        'max'=>31, 
	        'animate'=>true,
	        'range'=>'max',
	        'slide'=>'js:function(event,ui){$("#iv_def_text_'.$n.'").val(ui.value);}',
	    ),
	    'htmlOptions'=>array(
	        'style'=>'width:200px;background-color:red;'
	    ),
	));
	?>

	<label for="amt">IV Ataque especial:</label>
	<input type="number" id="iv_spa_text<?php echo $n ?>" style="border:0; color:#f6931f; font-weight:bold;" value="31" min="1" max="31" />
	<?php
	$this->widget('zii.widgets.jui.CJuiSliderInput', array(
	    'name'=>'iv_spa_'.$n,
	    'value'=>31,
	    'event'=>'change',
	    'options'=>array(
	        'min'=>0, 
	        'max'=>31, 
	        'animate'=>true,
	        'range'=>'max',
	        'slide'=>'js:function(event,ui){$("#iv_spa_text'.$n.'").val(ui.value);}',
	    ),
	    'htmlOptions'=>array(
	        'style'=>'width:200px;background-color:red;'
	    ),
	));
	?>

	<label for="amt">IV Defensa especial:</label>
	<input type="number" id="iv_def_text_<?php echo $n ?>" style="border:0; color:#f6931f; font-weight:bold;" value="31" min="1" max="31" />
	<?php
	$this->widget('zii.widgets.jui.CJuiSliderInput', array(
	    'name'=>'iv_spd_'.$n,
	    'value'=>31,
	    'event'=>'change',
	    'options'=>array(
	        'min'=>0, 
	        'max'=>31, 
	        'animate'=>true,
	        'range'=>'max',
	        'slide'=>'js:function(event,ui){$("#iv_def_text_'.$n.'").val(ui.value);}',
	    ),
	    'htmlOptions'=>array(
	        'style'=>'width:200px;background-color:red;'
	    ),
	));
	?>

	<label for="amt">IV Velocidad:</label>
	<input type="number" id="iv_spe_text_<?php echo $n ?>" style="border:0; color:#f6931f; font-weight:bold;" value="31" min="1" max="31" />
	<?php
	$this->widget('zii.widgets.jui.CJuiSliderInput', array(
	    'name'=>'iv_spe_'.$n,
	    'value'=>31,
	    'event'=>'change',
	    'options'=>array(
	        'min'=>0, 
	        'max'=>31, 
	        'animate'=>true,
	        'range'=>'max',
	        'slide'=>'js:function(event,ui){$("#iv_spe_text_'.$n.'").val(ui.value);}',
	    ),
	    'htmlOptions'=>array(
	        'style'=>'width:200px;background-color:red;'
	    ),
	));
	?>

	<?php echo CHtml::ajaxButton('Realizar cálculo pokémon'.$n,
		CController::createUrl('CalculateStats'),
		array('update' => '.result_'.$n, 'type' => "POST")); ?>
	<?php echo CHtml::endForm(); ?>