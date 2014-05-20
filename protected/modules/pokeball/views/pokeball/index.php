<h1> Calculadora de probabilidad de captura </h1>

<p>Este módulo calcula la probabilidad de capturar un pokémon bajo distintos parámetros.
En vez de limitar la calculadora para no poder hacer casos imposibles (Ej: Captura de un Gardevoir en pokémon red) se da la posibilidad de hacer el cálculo teórico como si se pudiese hacer la captura.</p>
<p>Si te interesa conocer a fondo el algoritmo detrás de la calculadora te invito a leer <a href="http://www.pokedaisuki.cl/bajo-el-camion-del-s-s-anne-n5-formulas-de-captura-parte-1/">mi artículo al respecto</a>.</p>


<div class="form">
	<?php echo CHtml::beginForm(array('calcularProba')); ?>

	<table border="1">
		<tr><!-- Pokémon -->
			<td> Pokémon a capturar </td>
			<td>
				<?php
					$this->widget(
						'bootstrap.widgets.TbSelect2',
						array(
							'name' => 'pokemon_to_capture',
							'data' => $array_pokeymans,
							'htmlOptions' => array(
								'multiple' => false,
							),
						)
					);
				?>			
			</td>
			<td> <div id="pokemon_elegido"> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites/0.png'); ?>  </div></td>
		</tr>
		<tr><!-- Pokéball -->
			<td> Pokéball a usar </td>
			<td>
				<?php
					$this->widget(
						'bootstrap.widgets.TbSelect2',
						array(
							'name' => 'pokeball_to_use',
							'data' => $array_pokeballs,
							'htmlOptions' => array(
								'multiple' => false,
							),
						)
					);
				?>
			</td>
			<td> <div id="foto_pokeball" style="height:100px"> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/pokeball/pball1.png'); ?> </div> </td>
		</tr>
		<tr> <!-- Generación -->
			<td> Generación </td>
			<td> <select id="gen" name="gen">
	   				<option value="2">Second (GS-C)</option>
	     			<option value="3">Third (RS-E-FRLG)</option>
	  				<option value="4">Fourth (DP-Pl-HGSS)</option>
	   				<option value="5">Fifth (BW-BW2)</option>
				</select>
			</td> 
			<td> <div id="foto_gen" class="pball_container" style="height:100px"> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/pokeball/gen2.png'); ?> </div> </td> 
		</tr>
		<tr> <!-- Status aligment -->
			<td> Status ailment </td>
			<td>
				<select id="status" name="status">
	  				<option value="Normal">Normal</option>
	   				<option value="Sleep">Sleep (Dormido) </option>
	     			<option value="Freeze">Freeze (Congelado) </option>
	  				<option value="Paralysis">Paralysis (Parálisis) </option>
	   				<option value="Burn">Burn (Quemadura) </option>
	    			<option value="Poison">Poison (Veneno) </option>
				</select> 
			</td>
			<td> <div id="foto_status" class="pball_container" style="height:70px"> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/pokeball/statusNormal.png'); ?> </td>
		</tr>
		<tr>
			<td> Porcentaje HP (número entero entre 1 y 100) </td>
			<td>
				<input type="number" name="hp_percentage" id='hp_percentage' value='100' min="1" max="100">
			</td>
			<td> <div id="hp_percentage_photo"> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/pokeball/hp10.png'); ?>   </div> </td>
		</tr>

	</table>

	<div class="clear"> &nbsp; </div>

	<!-- Área divs por pokéball -->
	<div class='pball_especial' id="dive_ball">
		<p>	¿El encuentro ocurrió pescando/surfeando/bajo el agua? </p>
		<select id="select_diveball" name="select_diveball">
	  		<option value="1"> Sí </option>
	   		<option value="0"> No </option>
		</select>
	</div>

	<div class='pball_especial' id="nest_ball">
		<p> <input type="number" name="select_nestball" id='select_nestball' value='100' min="1" max="100"> </p>
	</div>

	<div class='pball_especial' id="repeat_ball">
		<p>	¿El pokémon fue capturado previamente? </p>
		<select id="select_repeatball" name="select_repeatball">
	  			<option value="1"> Sí </option>
	   			<option value="0"> No </option>
			</select>
	</div>

	<div class='pball_especial' id="timer_ball">
		<p> ¿Cuántos turnos han transcurrido en la pelea? </p>
			<?php echo CHtml::dropDownList('select_timerball', '',  $array_turnos); ?> 
	</div>

	<div class='pball_especial' id="dusk_ball">
			<p> ¿Se el pokémon salvaje está en una cueva o es de noche? </p>
			<select id="select_duskball" name="select_duskball">
	  			<option value="1"> Sí </option>
	   			<option value="0"> No </option>
			</select>
	</div>

	<div class='pball_especial' id="quick_ball">
		<p> ¿Se usó la Quick Ball en el primer turno de la batalla? </p>
		<p>	<select id="select_quickball" name="select_quickball">
	  			<option value="1"> Sí </option>
	   			<option value="0"> No </option>
			</select> 
		</p>
	</div>

	<div class='pball_especial'  id="level_ball">
		<p> <input type="number" name="select_levelball_nivel_oponente" id='select_levelball_nivel_oponente' value='100' min="1" max="100"> </p>
		<p> <input type="number" name="select_levelball_nivel_jugador" id='hp_percentage' value='100' min="1" max="100"> </p>
	</div>

	<div class='pball_especial' id="lure_ball">
		<p> ¿El pokémon a capturar fue encontrado por medio de pesca?"
			<select id="select_lureball" name="select_lureball">
				<option value="1"> Sí </option>
	   			<option value="0"> No </option>
		 	</select>
		</p>
	</div>

	<div class='pball_especial' id="love_ball">
		<p> ¿Es el pokémon oponente de la misma especie (es decir, el MISMO pokémon) y género contrario? </p>
		<p>	<select id="select_loveball" name="select_loveball">
	  			<option value="1"> Sí </option>
	   			<option value="0"> No </option>
			</select>
		</p>
	</div>
	<!-- Fin divs por pokéball -->

	<!-- Área Quinta generación -->
	<div class='fifthgen'  id="quinta_grass">
		<p> ¿Estás en hierva alta (high grass, donde hay probabilidad de encuentros con dos pokémon al unísono)? </p>
		<p>	<select id="select_grass" name="select_grass">
	  			<option value="0"> No </option>
	  			<option value="1"> Sí </option>
			</select>
		</p>
	</div>

	<div class='fifthgen' id="quinta_numpokemon">
		<p> ¿Cuántos pokémon tienes como <b>capturados</b> en la pokédex? (Si, es un factor =P)</p>
		<p>	<select id="select_numpokemon" name="select_numpokemon">
	  			<option value="3"> 1-30 </option>
	   			<option value="5"> 31-150 </option>
	   			<option value="7"> 151-300 </option>
	   			<option value="8"> 301-450 </option>
	   			<option value="9"> 451-600 </option>
	   			<option value="10">600-649 </option>
			</select>
		</p>
	</div>

	<div class='fifthgen' id="quinta_entralink">
		<p> ¿Está activado algún poder de entralink? </p>
		<p>	<select id="select_entralink" name="select_entralink">
	  			<option value="10"> Ninguno </option>
	  			<option value="11"> Power ↑ </option>
	  			<option value="12"> Power ↑↑ </option>
	  			<option value="13"> Power ↑↑↑ </option>
	  			<option value="13"> Power S </option>
	  			<option value="13"> Power MAX </option>
			</select>
		</p>
	</div>
	<!-- Fin Quinta generación -->

	 <?php echo CHtml::ajaxButton("Calcular probabilidad",
            CController::createUrl('CalcularProba'),
            array('update' => '#result', 'type' => "POST" )); ?>
	<?php echo CHtml::endForm(); ?>
</div><!--- form -->


<script type="text/javascript">
	function preloadImg(src) {
    	$('<img/>')[0].src = src;
	}

	$(document).ready(function() {
		//Hide everything
		$('.pball_especial').hide();
		$('.fifthgen').hide();

		//Preload images
		var domain = '<?php echo Yii::app()->request->baseUrl ?>';
		preloadImg( domain + '/images/pokeball/gen1.png');
		preloadImg( domain + '/images/pokeball/gen2.png');
		preloadImg( domain + '/images/pokeball/gen3.png');
		preloadImg( domain + '/images/pokeball/gen4.png');
		preloadImg( domain + '/images/pokeball/gen5.png');
		preloadImg( domain + '/images/pokeball/hp0.png');
		preloadImg( domain + '/images/pokeball/hp1.png');
		preloadImg( domain + '/images/pokeball/hp2.png');
		preloadImg( domain + '/images/pokeball/hp3.png');
		preloadImg( domain + '/images/pokeball/hp4.png');
		preloadImg( domain + '/images/pokeball/hp5.png');
		preloadImg( domain + '/images/pokeball/hp6.png');
		preloadImg( domain + '/images/pokeball/hp7.png');
		preloadImg( domain + '/images/pokeball/hp8.png');
		preloadImg( domain + '/images/pokeball/hp9.png');
		preloadImg( domain + '/images/pokeball/hp10.png');
		
		//Generation functions
	    $('#gen').change(function() {
    		var genno = parseInt($('#gen').val());
    		$('#foto_gen').html("<img src='/pokeapp/images/pokeball/gen"+genno+".png'>");

    		if(gen==5)
    			$('.fifthgen').show();
    		else
    			$('.fifthgen').hide();

    	});

    	//Pokéball functions
		$('#pokeball_a_usar').change(function() {
			$('.pball_especial').hide();
			var id_pokeball = parseInt($('#pokeball_a_usar').val());
			switch(id_pokeball) {
				case 7:	 $('#dive_ball').show();	break;
				case 8:  $('#nest_ball').show();	break;
				case 9:  $('#repeat_ball').show();	break;
				case 10: $('#timer_ball').show();	break;
				case 13: $('#dusk_ball').show();	break;
 				case 15: $('#quick_ball').show();	break;
				case 18: $('#level_ball').show();	break;
				case 19: $('#lure_ball').show();	break;
				case 21: $('#love_ball').show();	break;
			}
    	});

		//Update the HP bar.
    	$('#hp_percentage').change(function() {
    		var hp =  parseInt((parseInt($('#hp_percentage').val()))/10);
    		$('#hp_percentage_photo').html("<img src='/pokeapp/images/pokeball/hp"+hp+".png'>");
    	});

	});
</script>