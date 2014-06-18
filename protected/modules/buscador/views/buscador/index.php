<!-- START OF SEARCH CRITERIA -->
<h1> Buscador de pokémon por criterios interesantes </h1>

<div class='search_criteria'>
	<h3> Quiero un pokémon que... </h3>
	
	<div class='height'>
		<h4> Tamaño: </h4>
		<label> Desde: </label>
		<input type="number" class='height_form' name="height_min" id='height_min' min="1" max="145">
		<label> Hasta: </label>
		<input type="number" class='height_form' name="height_max" id='height_max' min="1" max="145">
	</div> 	<!-- end of height -->

	<div class='weight'>
		<h4> Peso (Kilogramos) : </h4>
		<label> Desde: </label>
		<input type="number" class='weigth_form' name="weight_min" id='weight_min' min="0.1" max="398" step='0.1'>
		<label> Hasta: </label>
		<input type="number" class='weigth_form' name="weight_max" id='weight_max' min="0.1" max="398" step='0.1'>
	</div> 	<!-- end of weight -->

	<div class='type'>
		<h4> Tipo(s) </h4>
		<label> Tipo 1: </label>
		<?php echo CHtml::dropDownList('type_1', null, $array_types, array('empty' => '(Ingresar tipo 1)', 'class' => 'type_dropdown'));  ?>
		<label> Tipo 2: </label>
		<?php echo CHtml::dropDownList('type_2', null, $array_types, array('empty' => '(Ingresar tipo 2)', 'class' => 'type_dropdown'));  ?>
	</div>	<!-- end of type -->

	<div class='gen'>
		<h4> Generaciones </h4>
			<input type="checkbox" class="gen_checkbox" id='gen_checkbox_1' value="1"> Primera <br>
			<input type="checkbox" class="gen_checkbox" id='gen_checkbox_2' value="2"> Segunda <br>
			<input type="checkbox" class="gen_checkbox" id='gen_checkbox_3' value="3"> Tercera <br>
			<input type="checkbox" class="gen_checkbox" id='gen_checkbox_4' value="4"> Cuarta <br>
			<input type="checkbox" class="gen_checkbox" id='gen_checkbox_5' value="5"> Quinta <br>
			<input type="checkbox" class="gen_checkbox" id='gen_checkbox_6' value="6"> Sexta  <br>
	</div> 	<!-- end of gen -->

	<div class='color'>
		<h4> Color: </h4>
		<?php echo CHtml::dropDownList('color', '', $array_colors, array('empty' => '(Seleccionar color)')); ?>
	</div>

	<div class='egg'>
		<h4> Grupo huevo: </h4>
		<?php echo CHtml::dropDownList('egg', '', $array_egg_groups, array('empty' => '(Seleccionar grupo)')); ?>
	</div>

	<div class='shape'>
		<h4> Forma: </h4>
		<?php echo CHtml::dropDownList('shape', '', $array_shapes, array('empty' => '(Seleccionar forma)')); ?>
	</div>
</div> 

<!-- END OF SEARCH CRITERIA -->


<!-- START OF RESULTS -->
<div class='search_results'>
	<h3> Criterios de búsqueda agregados </h3>

	<div class='height_results'>
		<p> Desde <span class='height' id='height_from'> </span> [m] hasta <span class='height' id='height_to'> </span> [m] </p>
		<div class='height_remove'>  <img src='<?php echo imageDir()?>/buscador/remove.png' alt='sacar' /></div>		
	</div> <!-- end of height results -->

	<div class='weight_results'>
		<p> Desde <span class='weight' id='weight_from'> </span> [kg] hasta <span class='weight' id='weight_to'> </span> [kg] </p>
		<div class='weight_remove'>  <img src='<?php echo imageDir()?>/buscador/remove.png' alt='sacar' /></div>
	</div> <!-- end of weight results -->

	<div class='gen_results'>
		<p> Se mostrarán pokémon de las generaciones... </p>
		<ul>
			<li id='gen_result_1'> Primera </li>
			<li id='gen_result_2'> Segunda </li>
			<li id='gen_result_3'> Tercera </li>
			<li id='gen_result_4'> Cuarta </li>
			<li id='gen_result_5'> Quinta </li>
			<li id='gen_result_6'> Sexta </li>
		</ul>
	</div>

	<div class='color_results'>

	</div>
</div>
<!-- END OF RESULTS -->

<!-- START OF JAVASCRIPT -->
<script type='text/javascript'>
	$(".height_results").children().hide();
	$(".gen_results").children().hide();

	//Height
	$(".height_form").change(function(){
		min = parseInt($('#height_min').val());
		max = parseInt($('#height_max').val());

		if((min + 0 == min)) { //This is what happends when you program without internet. ¿How was the function to see if it was a number called...?
			$(".height_results").children().show();
			if(min <= max){	
				$('#height_from').html(min);
				$('#height_to').html(max);
			}else{
				$('#height_from').html(max);
				$('#height_to').html(min);
			}
		}else{
			$(".height_results").children().hide();
		}
	});

	$(".height_remove").click(function(){
		$(".height_results").children().hide();
		$("#height_min").val('');
		$("#height_max").val('');
	});
	//End of Height

	//Weight
	$(".weigth_form").change(function(){
		min = parseInt($('#weight_min').val());
		max = parseInt($('#weight_max').val());

		if((min + 0 == min)) {
			$(".weight_results").children().show();
			if(min <= max){	
				$('#weight_from').html(min);
				$('#weight_to').html(max);
			}else{
				$('#weight_from').html(max);
				$('#weight_to').html(min);
			}
		}else{
			$(".weight_results").children().hide();
		}
	});

	$(".weight_remove").click(function(){
		$(".weight_results").children().hide();
		$("#weight_min").val('');
		$("#weight_max").val('');
	});
	//End of Weight

	//Generation checkboxes
	$('.gen_checkbox').change(function() {

		is_something_ticked =  	($('#gen_checkbox_1')).is(":checked")||($('#gen_checkbox_2')).is(":checked")||($('#gen_checkbox_3')).is(":checked")||
								($('#gen_checkbox_4')).is(":checked")||($('#gen_checkbox_5')).is(":checked")||($('#gen_checkbox_6')).is(":checked"); 

		if(!is_something_ticked)
			$(".gen_results").children().hide();
		else
			$(".gen_results").children().show();

		for(i = 1 ; i < 7 ; i++){
			if( ($('#gen_checkbox_'+i)).is(":checked") )
				($('#gen_result_'+i)).show()
			else
				($('#gen_result_'+i)).hide()
		}		
	});
	//End of generation checkboxes

	//Start of type dropdowns
	$('#type_1').change(function() {
		if( ('#type_1').val == '')
			alert("empty");
		else
			alert(('#type_1').val);
	});
	

	//end of type dropdowns


</script>
<!-- END OF JAVASCRIPT -->


 <!--- CRITERIOS A CONSIDERAR:
 Experiencia base
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

