<?php
/**
 * This is the main form for the stats module. It contains the pokémon, the item, IV, EV, etc. 
 * Its called by the index view two times (once per pokémon).
 */
?>

	<?php echo CHtml::beginForm(array('calculateStats')); ?>

	<div class="basic">
		<h4>Datos básicos</h4>
		<div>
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
		</div>
		<div>
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
		</div>
		<div>
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
		</div>

		<div>
			<label>Nivel:</label>
			<input type="number" id="level_<?php echo $n?>" name="level_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="50" min="1" max="100" />
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
			        'slide'=>'js:function(event,ui){$("#level_'.$n.'").val(ui.value);}',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'width:200px;background-color:red;'
			    ),
			));
			?>
		</div>
	</div>

	<!-- IV Zone -->
	<div class="iv">
		<h4>IVs</h4>
		<div>
			<label>IV Puntos de impacto:</label>
			<input type="number" id="iv_hp_<?php echo $n ?>" name="iv_hp_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="31" min="1" max="31" />
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
			        'slide'=>'js:function(event,ui){$("#iv_hp_'.$n.'").val(ui.value);}',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'width:200px;background-color:red;'
			    ),
			));
			?>
		</div>
		<div>
			<label>IV Ataque:</label>
			<input type="number" id="iv_atk_<?php echo $n ?>"name="iv_atk_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="31" min="1" max="31" />
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
			        'slide'=>'js:function(event,ui){$("#iv_atk_'.$n.'").val(ui.value);}',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'width:200px;background-color:red;'
			    ),
			));
			?>
		</div>
		<div>
			<label>IV Defensa:</label>
			<input type="number" id="iv_def_<?php echo $n ?>"name="iv_def_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="31" min="1" max="31" />
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
			        'slide'=>'js:function(event,ui){$("#iv_def_'.$n.'").val(ui.value);}',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'width:200px;background-color:red;'
			    ),
			));
			?>
		</div>
		<div>
			<label for="amt">IV Ataque especial:</label>
			<input type="number" id="iv_spa_<?php echo $n ?>"name="iv_spa_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="31" min="1" max="31" />
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
			        'slide'=>'js:function(event,ui){$("#iv_spa_'.$n.'").val(ui.value);}',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'width:200px;background-color:red;'
			    ),
			));
			?>
		</div>
		<div>
			<label for="amt">IV Defensa especial:</label>
			<input type="number" id="iv_spd_<?php echo $n ?>"name="iv_spd_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="31" min="1" max="31" />
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
			        'slide'=>'js:function(event,ui){$("#iv_spd_'.$n.'").val(ui.value);}',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'width:200px;background-color:red;'
			    ),
			));
			?>
		</div>
		<div>
			<label for="amt">IV Velocidad:</label>
			<input type="number" id="iv_spe_<?php echo $n ?>"name="iv_spe_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="31" min="1" max="31" />
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
			        'slide'=>'js:function(event,ui){$("#iv_spe_'.$n.'").val(ui.value);}',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'width:200px;background-color:red;'
			    ),
			));
			?>
		</div>
	</div>
	<!-- End of IV -->

	<!-- EV zone -->
	<div class="ev">
		<h4>EVs</h4>
		<div>
			<label for="amt">EV Puntos de impacto:</label>
			<input type="number" id="ev_hp<?php echo $n ?>" name="ev_hp_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="0" min="1" max="252" />
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
			        'slide'=>'js:function(event,ui){$("#ev_hp'.$n.'").val(ui.value);}',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'width:200px;background-color:red;'
			    ),
			));
			?>
		</div>
		<div>
			<label for="amt">EV Ataque:</label>
			<input type="number" id="ev_atk<?php echo $n ?>" name="ev_atk_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="0" min="1" max="252" />
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
			        'slide'=>'js:function(event,ui){$("#ev_atk'.$n.'").val(ui.value);}',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'width:200px;background-color:red;'
			    ),
			));
			?>
		</div>
		<div>
			<label for="amt">EV Defensa:</label>
			<input type="number" id="ev_def<?php echo $n ?>" name="ev_def_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="0" min="1" max="252" />
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
			        'slide'=>'js:function(event,ui){$("#ev_def'.$n.'").val(ui.value);}',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'width:200px;background-color:red;'
			    ),
			));
			?>
		</div>
		<div>
			<label for="amt">EV Ataque especial:</label>
			<input type="number" id="ev_spa<?php echo $n ?>" name="ev_spa_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="0" min="1" max="252" />
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
			        'slide'=>'js:function(event,ui){$("#ev_spa'.$n.'").val(ui.value);}',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'width:200px;background-color:red;'
			    ),
			));
			?>
		</div>
		<div>
			<label for="amt">EV Defensa especial:</label>
			<input type="number" id="ev_spd<?php echo $n ?>" name="ev_spd_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="0" min="1" max="252" />
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
			        'slide'=>'js:function(event,ui){$("#ev_spd'.$n.'").val(ui.value);}',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'width:200px;background-color:red;'
			    ),
			));
			?>
		</div>
		<div>
			<label for="amt">EV Velocidad:</label>
			<input type="number" id="ev_spe<?php echo $n ?>" name="ev_spe_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="0" min="1" max="252" />
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
			        'slide'=>'js:function(event,ui){$("#ev_spe'.$n.'").val(ui.value);}',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'width:200px;background-color:red;'
			    ),
			));
			?>
		</div>
	</div>
	<!-- End of EV -->

	<!-- Stat changes -->
	<div class="stat">
		<h4>Cambios de Stats</h4>
		<div>
			<label for="amt">Cambios de estado ataque:</label>
			<input type="number" id="stat_change_atk<?php echo $n ?>" name="stat_change_atk_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="0" min="-6" max="6" />
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
			        'slide'=>'js:function(event,ui){$("#stat_change_atk'.$n.'").val(ui.value);}',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'width:200px;background-color:red;'
			    ),
			));
			?>
		</div>
		<div>
			<label for="amt">Cambios de estado defensa:</label>
			<input type="number" id="stat_change_def<?php echo $n ?>"  name="stat_change_def_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="0" min="-6" max="6" />
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
			        'slide'=>'js:function(event,ui){$("#stat_change_def'.$n.'").val(ui.value);}',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'width:200px;background-color:red;'
			    ),
			));
			?>
		</div>
		<div>
			<label for="amt">Cambios de estado ataque especial:</label>
			<input type="number" id="stat_change_spa<?php echo $n ?>"  name="stat_change_spa_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="0" min="-6" max="6" />
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
			        'slide'=>'js:function(event,ui){$("#stat_change_spa'.$n.'").val(ui.value);}',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'width:200px;background-color:red;'
			    ),
			));
			?>
		</div>
		<div>
			<label for="amt">Cambios de estado defensa especial:</label>
			<input type="number" id="stat_change_spd<?php echo $n ?>" name="stat_change_spd_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="0" min="-6" max="6" />
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
			        'slide'=>'js:function(event,ui){$("#stat_change_spd'.$n.'").val(ui.value);}',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'width:200px;background-color:red;'
			    ),
			));
			?>
		</div>
		<div>
			<label for="amt">Cambios de estado velocidad:</label>
			<input type="number" id="stat_change_spe<?php echo $n ?>" name="stat_change_spe_text_<?php echo $n ?>" style="border:0; font-weight:bold;" value="0" min="-6" max="6" />
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
			        'slide'=>'js:function(event,ui){$("#stat_change_spe'.$n.'").val(ui.value);}',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'width:200px;background-color:red;'
			    ),
			));
			?>
		</div>
	</div>

	<?php echo CHtml::ajaxButton('Realizar cálculo pokémon'.$n,
		CController::createUrl('CalculateStats', array('id' => $n)),
			array('update' => '.result_'.$n, 'type' => "POST")
		); ?>
	<?php echo CHtml::endForm(); ?>