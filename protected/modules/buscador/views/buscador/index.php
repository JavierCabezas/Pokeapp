<h1> Buscador de pokémon por criterios interesantes </h1>

<div id="column1-wrap">
    <div id="column1">
	    <!-- START OF SEARCH CRITERIA -->
    	<div class='search_criteria'>
			<h3> Quiero un pokémon que... </h3>
	    	<div class="accordion-group">
				<div class='height'>
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc_height">	
							<h4> Tamaño (metros) </h4>
						</a>
					</div>
					<div id="acc_height" class="accordion-body collapse">
						<div class="accordion-inner">
							<label> Desde: </label>
							<input type="number" class='height_form' name="height_min" id='height_min' min="1" max="145">
							<label> Hasta: </label>
							<input type="number" class='height_form' name="height_max" id='height_max' min="1" max="145">
						</div>
					</div>
				</div> <!-- end of height -->

				<div class='weight'>
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc_weight">				
							<h4> Peso (Kilogramos) </h4>
						</a>
					</div>
					<div id="acc_weight" class="accordion-body collapse">
						<div class="accordion-inner">
							<label> Desde: </label>
							<input type="number" class='weigth_form' name="weight_min" id='weight_min' min="0.1" max="398" step='0.1'>
							<label> Hasta: </label>
							<input type="number" class='weigth_form' name="weight_max" id='weight_max' min="0.1" max="398" step='0.1'>
						</div>
					</div>
				</div> 	<!-- end of weight -->

				<div class='type'>
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc_type">				
							<h4> Tipo(s) </h4>
						</a>
					</div>
					<div id="acc_type" class="accordion-body collapse">
						<div class="accordion-inner">
							<label> Tipo 1: </label>
							<?php echo CHtml::dropDownList('type_1', null, $array_types, array('empty' => '(Ingresar tipo 1)', 'class' => 'type_dropdown'));  ?>
							<label> Tipo 2: </label>
							<?php echo CHtml::dropDownList('type_2', null, $array_types, array('empty' => '(Ingresar tipo 2)', 'class' => 'type_dropdown'));  ?>
						</div>
					</div>				
				</div>	<!-- end of type -->
			
				<div class='gen'>
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc_gen">				
								<h4> Generaciones </h4>
						</a>
					</div>
					<div id="acc_gen" class="accordion-body collapse">
						<div class="accordion-inner">
							<input type="checkbox" class="gen_checkbox" id='gen_checkbox_1' value="1"> Primera <br>
							<input type="checkbox" class="gen_checkbox" id='gen_checkbox_2' value="2"> Segunda <br>
							<input type="checkbox" class="gen_checkbox" id='gen_checkbox_3' value="3"> Tercera <br>
							<input type="checkbox" class="gen_checkbox" id='gen_checkbox_4' value="4"> Cuarta <br>
							<input type="checkbox" class="gen_checkbox" id='gen_checkbox_5' value="5"> Quinta <br>
							<input type="checkbox" class="gen_checkbox" id='gen_checkbox_6' value="6"> Sexta  <br>
						</div>
					</div>
				</div> 	<!-- end of gen -->

				<div class='color'>
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc_color">				
							<h4> Color: </h4>
						</a>
					</div>
					<div id="acc_color" class="accordion-body collapse">
						<div class="accordion-inner">
							<?php echo CHtml::dropDownList('color', '', $array_colors, array('empty' => '(Seleccionar color)')); ?>
						</div>
					</div>
				</div> <!-- end of color -->

				<div class='egg'>
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc_egg">				
							<h4> Grupo huevo </h4>
						</a>
					</div>
					<div id="acc_egg" class="accordion-body collapse">
						<div class="accordion-inner">
							<?php echo CHtml::dropDownList('egg', '', $array_egg_groups, array('empty' => '(Seleccionar grupo)')); ?>
						</div>
					</div>
				</div> <!-- End of eggs (hehe) -->

				<div class='shape'>
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc_form">				
							<h4> Forma: </h4>
						</a>
					</div>
					<div id="acc_form" class="accordion-body collapse">
						<div class="accordion-inner">
							<?php echo CHtml::dropDownList('shape', '', $array_shapes, array('empty' => '(Seleccionar forma)')); ?>
						</div>
					</div>
				</div> <!-- end of shape -->
			</div> <!-- end of accordeon -->
		</div> <!-- END OF SEARCH CRITERIA -->
		
    </div>
</div>
<div id="column2">
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

		<div class='type_results'>
			<div id='div_type_1_result'>
				<p> Tipo 1: <span class='type' id='type_1_result'> </span> </p>
				<div class='type_remove' id='1'>  <img src='<?php echo imageDir()?>/buscador/remove.png' alt='sacar' /></div>
			</div>
			<div id='div_type_2_result'>
				<p> Tipo 2: <span class='type' id='type_2_result'> </span> </p>
				<div class='type_remove' id='2'>  <img src='<?php echo imageDir()?>/buscador/remove.png' alt='sacar' /></div>
			</div>
		</div> <!-- end of type results -->

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
</div>
<div id="clear"></div>

<script>
$(".height_results").children().hide();
$(".weight_results").children().hide();
$(".gen_results").children().hide();
$(".type_results").children().hide();

//Variables
min_height_calculate = -1;
max_height_calculate = -1;
min_weight_calculate = -1;
max_weight_calculate = -1;
gen_1_calculate = 0;
gen_2_calculate = 0;
gen_3_calculate = 0;
gen_4_calculate = 0;
gen_5_calculate = 0;
gen_6_calculate = 0;
type_1_calculate = -1;
type_2_calculate = -1;

//Height
$(".height_form").change(function(){
	min = parseInt($('#height_min').val());
	max = parseInt($('#height_max').val());

	if((min + 0 == min)) { //This is what happends when you program without internet. ¿How was the function to see if it was a number called...?
		$(".height_results").children().show();
		if(min <= max){	
			$('#height_from').html(min);
			$('#height_to').html(max);
			min_height_calculate = min;
			max_height_calculate = max;
		}else{
			$('#height_from').html(max);
			$('#height_to').html(min);
			min_height_calculate = max;
			max_height_calculate = min;
		}
	}else{
		$(".height_results").children().hide();
	}
});

$(".height_remove").click(function(){
	$(".height_results").children().hide();
	$("#height_min").val('');
	$("#height_max").val('');
	min_height_calculate = -1;
	max_height_calculate = -1;
});
//End of height_max

//Weight
$(".weigth_form").change(function(){
	min = parseInt($('#weight_min').val());
	max = parseInt($('#weight_max').val());

	if((min + 0 == min)) {
		$(".weight_results").children().show();
		if(min <= max){	
			$('#weight_from').html(min);
			$('#weight_to').html(max);
			min_weight_calculate = min;
			max_weight_calculate = max;			
		}else{
			$('#weight_from').html(max);
			$('#weight_to').html(min);
			min_weight_calculate = max;
			max_weight_calculate = min;
		}
	}else{
		$(".weight_results").children().hide();
	}
});

$(".weight_remove").click(function(){
	$(".weight_results").children().hide();
	$("#weight_min").val('');
	$("#weight_max").val('');
	min_weight_calculate = -1;
	max_weight_calculate = -1;
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
		if( ($('#gen_checkbox_'+i)).is(":checked") ){
			($('#gen_result_'+i)).show()
			gen_1_calculate = 0;
		}
		else{
			($('#gen_result_'+i)).hide()
		}
	}
});
//End of generation checkboxes

//Start of type dropdowns
$(".type_dropdown").change(function() {
	type1 = $("#type_1").val();
	type2 = $("#type_2").val();
	type1_selected = (type1 != '');
	type2_selected = (type2 != '');
	if( type1_selected || type2_selected ){
		$(".type_results").children().show();
		if(type1_selected){
			$("#div_type_1_result").hide();
			type_1_calculate = type_1;
		}else{
			type_1_calculate = -1;
		}
		if(type2_selected){
			$("#div_type_1_result").hide();
			type_2_calculate = type_2;
		}else{
			type_1_calculate = -1;
		}
		type1_text = $("#type_1").children("option").filter(":selected").text();
		type2_text = $("#type_2").children("option").filter(":selected").text();

	}else{
		$(".type_results").children().hide();
	}
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

