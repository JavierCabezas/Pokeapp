<h1> Calculadora de probabilidad de captura </h1>

<p>Este módulo calcula la probabilidad de capturar un pokémon bajo distintos parámetros.
En vez de limitar la calculadora para no poder hacer casos imposibles (Ej: Captura de un Gardevoir en pokémon red) se da la posibilidad de hacer el cálculo teórico como si se pudiese hacer la captura.</p>
<p>Si te interesa conocer a fondo el algoritmo detrás de la calculadora te invito a leer <a href="http://www.pokedaisuki.cl/bajo-el-camion-del-s-s-anne-n5-formulas-de-captura-parte-1/">mi artículo al respecto</a>.</p>


<div class="form">
	<?php echo CHtml::beginForm(array('calculateProbability')); ?>

	<table border="1">
		<tr><!-- Pokémon -->
			<td> <h4> Pokémon a capturar </h4> </td>
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
			<td> <div id="pokemon_elegido"> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sugimori/104px-Sugimori_000.png'); ?>  </div></td>
		</tr>
		<tr><!-- Pokéball -->
			<td> <h4> Pokéball a utilizar </h4> </td>
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
			<td> <h4> Generación </h4> </td>
			<td> <select id="gen" name="gen">
	   				<option value="2">Segunda (GS-C)</option>
	     			<option value="3">Tercera (RS-E-FRLG)</option>
	  				<option value="4">Cuarta (DP-Pl-HGSS)</option>
	   				<option value="5">Quinta (BW-BW2)</option>
	   				<!-- <option value="6">Sexta (XY-&alpha;S &beta;R)</option> I don't know the catch rate mechanics for sixth generation yet! -->
				</select>
			</td> 
			<td> <div id="foto_gen" class="pball_container" style="height:100px"> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/pokeball/gen2.png'); ?> </div> </td> 
		</tr>
		<tr> <!-- Status aligment -->
			<td> <h4> Status ailment </h4> </td>
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
			<td> <u class ="dotted"> <span title="Número entero entre 1 y 100 "> <h4>Porcentaje HP </h4> </span> </td>
			<td>
				<input type="number" name="hp_percentage" id='hp_percentage' value='100' min="1" max="100">
			</td>
			<td> <div id="hp_percentage_photo"> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/pokeball/hp10.png'); ?>   </div> </td>
		</tr>
	</table>

	<div class="clear"> &nbsp; </div>

	<!-- Área divs por pokéball -->
	<table class='pball_especial' id="dive_ball">
		<tr>
			<td colspan='3'>
				<h3> Factores exclusivo de Dive Ball (Buceo Ball) </h3>
			</td>
		</tr>
		<tr>
			<td colspan='2'>
				¿El encuentro ocurrió pescando/surfeando/bajo el agua? 
			</td>
			<td>
				<select id="select_diveball" name="select_diveball">
			  		<option value="1"> Sí </option>
			   		<option value="0"> No </option>
				</select>
			</td>
		</tr>
	</table>

	<table class='pball_especial' id="nest_ball">
		<tr>
			<td colspan='3'>
				<h3> Factor exclusivo de Nest Ball (Nido Ball) </h3>
			</td>
		</tr>
		<tr>
			<td colspan='2'>
				¿Cuál es el nivel del pokémon que quieres capturar? 
			</td>
			<td>
				<input type="number" name="select_nestball" id='select_nestball' value='100' min="1" max="100">
			</td>
		</tr>
	</table>

	<table class='pball_especial' id="repeat_ball">
		<tr>
			<td colspan='3'>
				<h3> Factor exclusivo de Repeat Ball <u class ="dotted"><span title="Acopio ball?! ¿Por qué hay jugadores que siguen en español?">(Acopio Ball) </span> </u> </h3>
			</td>
		</tr>
		<tr>
			<td colspan='2'>
				¿El pokémon fue capturado previamente?
			</td>
			<td>
				<select id="select_repeatball" name="select_repeatball">
		  			<option value="1"> Sí </option>
		   			<option value="0"> No </option>
				</select>
			</td>
		</tr>
	</table>

	<table class='pball_especial' id="timer_ball">
		<tr>
			<td colspan='3'> 
				<h3> Factor exclusivo de Timer Ball (Turno ball) </h3>
			</td>
		</tr>
		<tr>
			<td colspan='2'>
				¿Cuántos turnos han transcurrido en la pelea? 
			</td>
			<td>
				<?php echo CHtml::dropDownList('select_timerball', '',  $array_turnos); ?> 
			</td>
		</tr>
	</table>

	<table  class='pball_especial' id="dusk_ball">
		<tr>
			<td colspan='3'>
				<h3> Factor exclusivo Dusk Ball (Ocaso Ball) </h3>
			</td> 
		</tr>
		<tr>
			<td colspan='2'>
				¿Se el pokémon salvaje está en una cueva o es de noche?
			</td>
			<td>
				<select id="select_duskball" name="select_duskball">
		  			<option value="1"> Sí </option>
		   			<option value="0"> No </option>
				</select>
			</td>
		</tr>
	</table>

	<table class='pball_especial' id="quick_ball">
		<tr>
			<td colspan='3'>
				<h3> Factor único de Quick Ball (Veloz Ball) </h3>
			</td>
		</tr>
		<tr> 
			<td colspan='2'>
				¿Se usó la Quick Ball en el primer turno de la batalla? 
			</td>
			<td>
				<select id="select_quickball" name="select_quickball">
		  			<option value="1"> Sí </option>
		   			<option value="0"> No </option>
				</select>
			</td> 
		</tr>
	</table>

	<table class='pball_especial'  id="level_ball">
		<tr>
			<td colspan='3'>
				<h3> Factores únicos de Level Ball (Nivel Ball) </h3>
			</td>
		</tr>
		<tr>
			<td colspan='2'>
				Nivel del oponente
			</td>
			<td>
				<input type="number" name="select_levelball_nivel_oponente" id='select_levelball_nivel_oponente' value='100' min="1" max="100"> 
			</td>
		</tr>
		<tr>
			<td colspan='2'>
				Nivel de tu pokémon activo
			</td>
			<td>
				<input type="number" name="select_levelball_nivel_jugador" id='hp_percentage' value='100' min="1" max="100">
			</td>
		</tr>		
	</table>

	<table class='pball_especial' id="lure_ball">
		<tr>
			<td colspan='3'>
				<h3> Factor único por Lure Ball (Cebo Ball) </h3>
			</td>
		</tr>
		<tr>
			<td colspan='2'> 
				¿El pokémon a capturar fue encontrado pescando?
			</td>
			<td>
				<select id="select_lureball" name="select_lureball">
					<option value="1"> Sí </option>
		   			<option value="0"> No </option>
			 	</select>
			 </td>
		</tr>
	</table>

	<table class='pball_especial' id="love_ball">
		<tr>
			<td colspan='3'>
				<h3> Factor único de Love Ball (Amor Ball) </h3>
			</td>
		</tr>
		<tr>
			<td colspan='2'>
				¿Es el pokémon oponente de la misma especie (es decir, el MISMO pokémon) y género contrario? 
			</td>
			<td>	
				<select id="select_loveball" name="select_loveball">
		  			<option value="1"> Sí </option>
		   			<option value="0"> No </option>
				</select>
			</td>
		</tr>
	</table>
	<!-- Fin divs por pokéball -->

	<!-- Área Quinta generación -->
	<h3 class='fifthgen'> Factores exclusivos de quinta generación </h3>
	<table class='fifthgen'>
		<tr>
			<td colspan='2'>
				<u class ="dotted"><span title="La hierva alta es donde hay probabilidad de tener encuentro con dos pokémon al unísono."> ¿Estás en hierva alta (high grass)? </span> </u>
			</td>
			<td>
				<select id="select_grass" name="select_grass">
					 		<option value="0"> No </option>
					 		<option value="1"> Sí </option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan='2'>
				<u class ="dotted"><span title="Si, les prometo que esto es un factor =P"> ¿Cuántos pokémon tienes como <b>capturados</b> según tu pokédex? </span> </u>
			</td>
			<td>
				<select id="select_numpokemon" name="select_numpokemon">
		  			<option value="3"> 1-30 </option>
		   			<option value="5"> 31-150 </option>
		   			<option value="7"> 151-300 </option>
		   			<option value="8"> 301-450 </option>
		   			<option value="9"> 451-600 </option>
		   			<option value="10">600-649 </option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan='2'> ¿Está activado algún poder de entralink? </td>
			<td> 
				<select id="select_entralink" name="select_entralink">
		  			<option value="10"> Ninguno </option>
		  			<option value="11"> Power ↑ </option>
		  			<option value="12"> Power ↑↑ </option>
		  			<option value="13"> Power ↑↑↑ </option>
		  			<option value="13"> Power S </option>
		  			<option value="13"> Power MAX </option>
				</select>
			</td>
		</tr>
	</table>
	<!-- Fin Quinta generación -->

	 <?php echo CHtml::ajaxButton("Realizar cálculo",
		CController::createUrl('calculateProbability'),
		array('update' => '#result', 'type' => "POST" )); ?>
	<?php echo CHtml::endForm(); ?>
</div><!--- form -->

<div id="result"><!-- Entrega de resultados -->
	<?php $this->renderPartial('_showResults', array(
		'pokemon_to_catch' => null
	)); ?>
</div>


<script type="text/javascript">
	function preloadImg(src) {
    	$('<img/>')[0].src = src;
	}
	function pad(a, b){
  		return (1e15 + a + "" ).slice(-b)
	}


	$(document).ready(function() {
		//Hide everything
		$('.pball_especial').hide();
		$('.fifthgen').hide();

		//Preload images
		var domain = '<?php echo Yii::app()->request->baseUrl ?>';

		//Generation functions
	    $('#gen').change(function() {
    		var genno = parseInt($('#gen').val());
    		$('#foto_gen').html("<img src='/pokeapp/images/pokeball/gen"+genno+".png'>");

    		if(genno==5)
    			$('.fifthgen').show();
    		else
    			$('.fifthgen').hide();
    	});

    	//Pokéball functions
		$('#pokeball_to_use').change(function() {

			var pokeball = parseInt($('#pokeball_to_use').val());
			preloadImg( domain + '/images/pokeball/pball'+pokeball+'.png');

			$('.pball_especial').hide();
			switch(pokeball) {
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
			$('#foto_pokeball').html("<img src='/pokeapp/images/pokeball/pball"+pokeball+".png'>");
    	});

		//Update the HP bar.
    	$('#hp_percentage').change(function() {
    		var hp =  parseInt((parseInt($('#hp_percentage').val()))/10);
    		preloadImg( domain + '/images/pokeball/hp'+hp+'.png');
    		setTimeout(function(){ $('#hp_percentage_photo').html("<img src='/pokeapp/images/pokeball/hp"+hp+".png'>") } , 400);
    	});

    	//Update status
    	$('#status').change(function() {
    		var status = $('#status').val();
			preloadImg( domain + '/images/pokeball/status'+status+'.png');
			setTimeout(function(){ $('#foto_status').html("<img src='/pokeapp/images/pokeball/status"+status+".png'>") }, 800);
    	});

		$('#pokemon_to_capture').change(function() {
			var pokemon_id = $('#pokemon_to_capture').val();
			pokemon_id = pad(pokemon_id, 3); 
			preloadImg( domain + '/images/sugimori/104px-Sugimori_'+pokemon_id+'.png');
			setTimeout(function(){ $('#pokemon_elegido').html("<img src='/pokeapp/images/sugimori/104px-Sugimori_"+pokemon_id+".png'>") }, 800);
		});

	});
</script>