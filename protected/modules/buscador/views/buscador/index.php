<h1> Buscador de pokémon por criterios interesantes </h1>

<div class='search_criteria'>
<h3> Quiero un pokémon que... </h3>
	<div class='height'>
		<label> Tamaño: </label>
		
		Desde:
		<input type="number" name="height_min" id='height_min' min="1" max="145">

		Hasta:
		<input type="number" name="height_max" id='height_max' min="1" max="145">

		<div class ='button_height'>  <img src='<?php echo imageDir()?>/nav/arrow.png' alt='agregar' /> </div>
	</div>

	<div class='weight'>
		<label> Peso (Kilogramos) : </label>
		
		Desde:
		<input type="number" name="weight_min" id='weight_min' min="0.1" max="398" step='0.1'>

		Hasta:
		<input type="number" name="weight_max" id='weight_max' min="0.1" max="398" step='0.1'>

	</div>


	<div class='gen'>
		<label> Generación: </label>
		<?php echo CHtml::dropDownList('gen', '', $array_generations, array('empty' => '(Seleccionar generación)')); ?>

	</div>

	<div class='color'>
		<label> Color: </label>
		<?php echo CHtml::dropDownList('color', '', $array_colors, array('empty' => '(Seleccionar color)')); ?>
	</div>

	<div class='egg'>
		<label> Grupo huevo: </label>
		<?php echo CHtml::dropDownList('egg', '', $array_egg_groups, array('empty' => '(Seleccionar grupo)')); ?>
	</div>

	<div class='shape'>
		<label> Forma: </label>
		<?php echo CHtml::dropDownList('shape', '', $array_shapes, array('empty' => '(Seleccionar forma)')); ?>
	</div>
</div> <!-- End of search criteria -->

<div class='search_results'>
	<h3> Criterios de búsqueda agregados </h3>
	<div class='height_results'>
		<p visible='hidden'> Desde <span class='height_from'> </span> [kg] hasta <span class='height_to'> </span>
	</div>

	<div class='gen_results'>
		<label> Generaciones </label>
		<div class='result_gen'>
			<input type="radio" name="radio_gen" value="allow"> Permitir  <br>
			<input type="radio" name="radio_gen" value="deny" checked> Denegar <br>
		</div>
	</div>
</div>

<script type='text/javascript'>
	//Height
	$(".button_height").click(function(){

	});

	


</script>



 <!--- CRITERIOS A CONSIDERAR:
 Experiencia base
 tipos
 Abilidad
 Tamaño de nombre
 tiene forma si/no
 básico/evolucionado
 shapes
 habitat
 gender rate
 tiene diferencias de género
 ecuación de crecimiento
BOOL: Is_baby, evoluciona por roca, 
-->

