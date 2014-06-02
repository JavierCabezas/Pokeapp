<?php
/**
 * This is the main form for the stats module. It contains the pokémon, the item, IV, EV, etc. 
 * Its called by the index view two times (once per pokémon).
 */
?>

	<?php echo CHtml::beginForm(array('calculateStats')); ?>

	<label>Pokémon: </label>
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

	<label>Item: </label>
	<?php 
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

	<label>Naturaleza:</label>
	<?php
		$this->widget(
			'bootstrap.widgets.TbSelect2',
			array(
				'name' => 'nature_'.$n,
				'data' => $array_nature,
				'htmlOptions' => array(
					'multiple' => false,
				),
			)
		);
	?>

	<label>Nivel:</label>
	<input type="number" id="level_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="50" min="1" max="100" />
	<?php
	$this->widget('zii.widgets.jui.CJuiSliderInput', array(
	    'name'=>'level_'.$n,
	    'value'=>50,
	    'event'=>'change',
	    'options'=>array(
	        'min'=>1, 
	        'max'=>100, 
	        'animate'=>true,
	        'range'=>'max',
	        'slide'=>'js:function(event,ui){$("#level_text_'.$n.'").val(ui.value);}',
	    ),
	    'htmlOptions'=>array(
	        'style'=>'width:200px;background-color:red;'
	    ),
	));
	?>


	<!-- IV Zone -->
	<label>IV Puntos de impacto:</label>
	<input type="number" id="iv_hp_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="31" min="1" max="31" />
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
	<input type="number" id="iv_atk_text<?php echo $n ?>" style="border:0; font-weight:bold;" value="31" min="1" max="31" />
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
	<input type="number" id="iv_def_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="31" min="1" max="31" />
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
	<input type="number" id="iv_spa_text<?php echo $n ?>" style="border:0; font-weight:bold;" value="31" min="1" max="31" />
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
	<input type="number" id="iv_def_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="31" min="1" max="31" />
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
	<input type="number" id="iv_spe_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="31" min="1" max="31" />
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
	<!-- End of IV -->

	<!-- EV zone -->
	<label for="amt">EV Puntos de impacto:</label>
	<input type="number" id="ev_hp_text<?php echo $n ?>" style="border:0; font-weight:bold;" value="0" min="1" max="252" />
	<?php
	$this->widget('zii.widgets.jui.CJuiSliderInput', array(
	    'name'=>'ev_hp'.$n,
	    'value'=>0,
	    'event'=>'change',
	    'options'=>array(
	        'min'=>0, 
	        'max'=>252, 
	        'animate'=>true,
	        'range'=>'max',
	        'slide'=>'js:function(event,ui){$("#ev_hp_text'.$n.'").val(ui.value);}',
	    ),
	    'htmlOptions'=>array(
	        'style'=>'width:200px;background-color:red;'
	    ),
	));
	?>

	<label for="amt">EV Ataque:</label>
	<input type="number" id="ev_atk_text<?php echo $n ?>" style="border:0; font-weight:bold;" value="0" min="1" max="252" />
	<?php
	$this->widget('zii.widgets.jui.CJuiSliderInput', array(
	    'name'=>'ev_atk'.$n,
	    'value'=>0,
	    'event'=>'change',
	    'options'=>array(
	        'min'=>0, 
	        'max'=>252, 
	        'animate'=>true,
	        'range'=>'max',
	        'slide'=>'js:function(event,ui){$("#ev_atk_text'.$n.'").val(ui.value);}',
	    ),
	    'htmlOptions'=>array(
	        'style'=>'width:200px;background-color:red;'
	    ),
	));
	?>

	<label for="amt">EV Defensa:</label>
	<input type="number" id="ev_def_text<?php echo $n ?>" style="border:0; font-weight:bold;" value="0" min="1" max="252" />
	<?php
	$this->widget('zii.widgets.jui.CJuiSliderInput', array(
	    'name'=>'ev_def'.$n,
	    'value'=>0,
	    'event'=>'change',
	    'options'=>array(
	        'min'=>0, 
	        'max'=>252, 
	        'animate'=>true,
	        'range'=>'max',
	        'slide'=>'js:function(event,ui){$("#ev_def_text'.$n.'").val(ui.value);}',
	    ),
	    'htmlOptions'=>array(
	        'style'=>'width:200px;background-color:red;'
	    ),
	));
	?>

	<label for="amt">EV Ataque especial:</label>
	<input type="number" id="ev_spa_<?php echo $n ?>" style="border:0; font-weight:bold;" value="0" min="1" max="252" />
	<?php
	$this->widget('zii.widgets.jui.CJuiSliderInput', array(
	    'name'=>'ev_spa'.$n,
	    'value'=>0,
	    'event'=>'change',
	    'options'=>array(
	        'min'=>0, 
	        'max'=>252, 
	        'animate'=>true,
	        'range'=>'max',
	        'slide'=>'js:function(event,ui){$("#ev_spa_'.$n.'").val(ui.value);}',
	    ),
	    'htmlOptions'=>array(
	        'style'=>'width:200px;background-color:red;'
	    ),
	));
	?>

	<label for="amt">EV Defensa especial:</label>
	<input type="number" id="ev_spd_<?php echo $n ?>" style="border:0; font-weight:bold;" value="0" min="1" max="252" />
	<?php
	$this->widget('zii.widgets.jui.CJuiSliderInput', array(
	    'name'=>'ev_spd'.$n,
	    'value'=>0,
	    'event'=>'change',
	    'options'=>array(
	        'min'=>0, 
	        'max'=>252, 
	        'animate'=>true,
	        'range'=>'max',
	        'slide'=>'js:function(event,ui){$("#ev_spd_'.$n.'").val(ui.value);}',
	    ),
	    'htmlOptions'=>array(
	        'style'=>'width:200px;background-color:red;'
	    ),
	));
	?>

	<label for="amt">EV Velocidad:</label>
	<input type="number" id="ev_spe_<?php echo $n ?>" style="border:0; font-weight:bold;" value="0" min="1" max="252" />
	<?php
	$this->widget('zii.widgets.jui.CJuiSliderInput', array(
	    'name'=>'ev_spe'.$n,
	    'value'=>0,
	    'event'=>'change',
	    'options'=>array(
	        'min'=>0, 
	        'max'=>252, 
	        'animate'=>true,
	        'range'=>'max',
	        'slide'=>'js:function(event,ui){$("#ev_spe_'.$n.'").val(ui.value);}',
	    ),
	    'htmlOptions'=>array(
	        'style'=>'width:200px;background-color:red;'
	    ),
	));
	?>
	<!-- End of EV -->

	<!-- Stat changes -->
	<label for="amt">Cambios de estado ataque:</label>
	<input type="number" id="stat_change_atk_<?php echo $n ?>" style="border:0; font-weight:bold;" value="0" min="-6" max="6" />
	<?php
	$this->widget('zii.widgets.jui.CJuiSliderInput', array(
	    'name'=>'stat_change_atk'.$n,
	    'value'=>0,
	    'event'=>'change',
	    'options'=>array(
	        'min'=>-6, 
	        'max'=>6, 
	        'animate'=>true,
	        'range'=>'max',
	        'slide'=>'js:function(event,ui){$("#stat_change_atk_'.$n.'").val(ui.value);}',
	    ),
	    'htmlOptions'=>array(
	        'style'=>'width:200px;background-color:red;'
	    ),
	));
	?>

	<label for="amt">Cambios de estado defensa:</label>
	<input type="number" id="stat_change_def_<?php echo $n ?>" style="border:0; font-weight:bold;" value="0" min="-6" max="6" />
	<?php
	$this->widget('zii.widgets.jui.CJuiSliderInput', array(
	    'name'=>'stat_change_def'.$n,
	    'value'=>0,
	    'event'=>'change',
	    'options'=>array(
	        'min'=>-6, 
	        'max'=>6, 
	        'animate'=>true,
	        'range'=>'max',
	        'slide'=>'js:function(event,ui){$("#stat_change_def_'.$n.'").val(ui.value);}',
	    ),
	    'htmlOptions'=>array(
	        'style'=>'width:200px;background-color:red;'
	    ),
	));
	?>

	<label for="amt">Cambios de estado ataque especial:</label>
	<input type="number" id="stat_change_spa_<?php echo $n ?>" style="border:0; font-weight:bold;" value="0" min="-6" max="6" />
	<?php
	$this->widget('zii.widgets.jui.CJuiSliderInput', array(
	    'name'=>'stat_change_spa'.$n,
	    'value'=>0,
	    'event'=>'change',
	    'options'=>array(
	        'min'=>-6, 
	        'max'=>6, 
	        'animate'=>true,
	        'range'=>'max',
	        'slide'=>'js:function(event,ui){$("#stat_change_spa_'.$n.'").val(ui.value);}',
	    ),
	    'htmlOptions'=>array(
	        'style'=>'width:200px;background-color:red;'
	    ),
	));
	?>

	<label for="amt">Cambios de estado defensa especial:</label>
	<input type="number" id="stat_change_spd_<?php echo $n ?>" style="border:0; font-weight:bold;" value="0" min="-6" max="6" />
	<?php
	$this->widget('zii.widgets.jui.CJuiSliderInput', array(
	    'name'=>'stat_change_spd'.$n,
	    'value'=>0,
	    'event'=>'change',
	    'options'=>array(
	        'min'=>-6, 
	        'max'=>6, 
	        'animate'=>true,
	        'range'=>'max',
	        'slide'=>'js:function(event,ui){$("#stat_change_spd_'.$n.'").val(ui.value);}',
	    ),
	    'htmlOptions'=>array(
	        'style'=>'width:200px;background-color:red;'
	    ),
	));
	?>

	<label for="amt">Cambios de estado velocidad:</label>
	<input type="number" id="stat_change_spe_<?php echo $n ?>" style="border:0; font-weight:bold;" value="0" min="-6" max="6" />
	<?php
	$this->widget('zii.widgets.jui.CJuiSliderInput', array(
	    'name'=>'stat_change_spe'.$n,
	    'value'=>0,
	    'event'=>'change',
	    'options'=>array(
	        'min'=>-6, 
	        'max'=>6, 
	        'animate'=>true,
	        'range'=>'max',
	        'slide'=>'js:function(event,ui){$("#stat_change_spe_'.$n.'").val(ui.value);}',
	    ),
	    'htmlOptions'=>array(
	        'style'=>'width:200px;background-color:red;'
	    ),
	));
	?>

	<?php echo CHtml::ajaxButton('Realizar cálculo pokémon'.$n,
		CController::createUrl('CalculateStats', array('id' => $n)),
			array('update' => '.result_'.$n, 'type' => "POST")
		); ?>
	<?php echo CHtml::endForm(); ?>