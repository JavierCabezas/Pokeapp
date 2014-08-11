<h1> Buscador de Pokémon por criterios interesantes </h1>

<div id="column1-wrap">
    <div id="column1">
	    <!-- START OF SEARCH CRITERIA -->
    	<div class='search_criteria'>
			<h3> Quiero un Pokémon que... </h3>
	    	<div class="accordion-group">
				<div class='height'>
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc_height">	
							<h4> Tamaño (metros) </h4>
						</a>
					</div>
					<div id="acc_height" class="accordion-body collapse">
						<div class="accordion-inner">
							<p> Mínimo: 0.1[m] - Máximo: 14.5[m] </p>
							<label> Desde: </label>
							<input type="number" class='height_form' name="height_min" id='height_min' min="0.1" max="14.5" step="0.1" >
							<label> Hasta: </label>
							<input type="number" class='height_form' name="height_max" id='height_max' min="0.1" max="14.5" step="0.1">
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
							<p> Mínimo: 0.1[kg] - Máximo: 950[kg] </p>
							<label> Desde: </label>
							<input type="number" class='weigth_form' name="weight_min" id='weight_min' min="0.1" max="950" step='0.1'>
							<label> Hasta: </label>
							<input type="number" class='weigth_form' name="weight_max" id='weight_max' min="0.1" max="950" step='0.1'>
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
							<h4> Color </h4>
						</a>
					</div>
					<div id="acc_color" class="accordion-body collapse">
						<div class="accordion-inner">
							<?php echo CHtml::dropDownList('color_dropdown', '', $array_colors, array('empty' => '(Seleccionar color)')); ?>
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
							<?php echo CHtml::dropDownList('eggie_dropdown', '', $array_egg_groups, array('empty' => '(Seleccionar grupo)')); ?>
						</div>
					</div>
				</div> <!-- End of eggs (hehe) -->

				<div class='shape'>
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc_form">				
							<h4> Forma </h4>
						</a>
					</div>
					<div id="acc_form" class="accordion-body collapse">
						<div class="accordion-inner">
							<?php echo CHtml::dropDownList('shape', '', $array_shapes, array('empty' => '(Seleccionar forma)')); ?>
						</div>
					</div>
				</div> <!-- end of shape -->

				<div class='ability'>
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc_ability">
							<h4> Habilidad </h4>
						</a>
					</div>
					<div id="acc_ability" class="accordion-body collapse">
						<div class="accordion-inner">
							<?php echo CHtml::dropDownList('ability', '', $array_ability, array('empty' => '(Seleccionar habilidad)')); ?>
						</div>
					</div>
				</div> <!-- end of ability -->

				<div class='moves'>
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc_moves">
							<h4> Movimientos </h4>
						</a>
					</div>
					<div id="acc_moves" class="accordion-body collapse">
						<div class="accordion-inner">
							<p>
								<label for='moves_1'> Movimiento 1 </label>
								<?php
									$this->widget('bootstrap.widgets.TbSelect2',
										array(
											'name' => 'moves_1',
											'data' => $array_moves,
											'htmlOptions' => array( 'multiple' => false),
										)
									);
								?>
							</p>
							<p>
								<label for='moves_2'> Movimiento 2 </label>
								<?php
									$this->widget('bootstrap.widgets.TbSelect2',
										array(
											'name' => 'moves_2',
											'data' => $array_moves,
											'htmlOptions' => array( 'multiple' => false,  'allowClear' => true ),
										)
									);
								?>
							</p>
							<p>
								<label for='moves_3'> Movimiento 3 </label>
								<?php
									$this->widget('bootstrap.widgets.TbSelect2',
										array(
											'name' => 'moves_3',
											'data' => $array_moves,
											'htmlOptions' => array( 'multiple' => false),
										)
									);
								?>

							</p>
							<p>
								<label for='moves_4'> Movimiento 4 </label>
								<?php
									$this->widget('bootstrap.widgets.TbSelect2',
										array(
											'name' => 'moves_4',
											'data' => $array_moves,
											'htmlOptions' => array( 'multiple' => false),
										)
									);
								?>
							</p>
						</div>
					</div>
				</div> <!-- end of ability -->

			</div> <!-- end of accordeon -->
		
			<div style="width:40%; margin-right:auto; margin-left:auto">
				<input id="search-data" type="submit" value="Mostrar resultados!" />
			</div> <!-- End of search button -->
		
		</div> <!-- END OF SEARCH CRITERIA -->
    </div> <!-- end of column1 -->
</div> <!-- end of comlumn1-wrap -->

<div id="column2">
	<!-- START OF RESULTS -->
	<div class='search_results'>
		<h3> Criterios de búsqueda agregados </h3>

		<div class='height_results'>
			<h4> Tamaño: </h4>
			<p id='height_from'> - Desde <span class='height'> </span> [m] </p> 
			<p id='height_to'> - Hasta <span class='height'> </span> [m] </p>
			<div class='height_remove'>  <img src='<?php echo imageDir()?>/buscador/remove.png' alt='sacar' /></div>		
		</div> <!-- end of height results -->

		<div class='weight_results'>
			<h4> Peso: </h4>
			<p id='weight_from'> - Desde <span class='weight'> </span> [kg] </p> 
			<p id='weight_to'> - Hasta <span class='weight'> </span> [kg] </p>
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
			<p> Se mostrarán Pokémon de las generaciones... </p>
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
			<div class='div_color'>
				<p> Color: <span class='color' id='color_result'> </span> </p>
				<div class='color_remove'>  <img src='<?php echo imageDir()?>/buscador/remove.png' alt='sacar' /></div>
			</div>
		</div>

		<div class='egg_results'>
			<div class='div_egg'>
				<p> Grupo Huevo: <span class='egg' id='egg_results'> </span> </p>
				<div class='egg_remove'> <img src='<?php echo imageDir()?>/buscador/remove.png' alt='sacar'> </div> 
			</div>
		</div>
	</div>
	<!-- END OF RESULTS -->
</div>
<div id="clear"></div>

<div class="div_show_results">
	<!-- The results will be shown here -->
</div> <!-- end of div_show_results-->




<script>
$(".height_results").children().hide();
$(".weight_results").children().hide();
$(".gen_results").children().hide();
$(".type_results").children().hide();
$(".color_results").children().hide();
$(".move_results").children().hide();
$(".egg_results").children().hide();

//Variables
var gen_calculate = new Array(false, false, false, false, false, false);
min_height_calculate 	= -1;
max_height_calculate 	= -1;
min_weight_calculate 	= -1;
max_weight_calculate 	= -1;
type_1_calculate 		= -1;
type_2_calculate 		= -1;
color_calculate 		= -1;
egg_calculate         	= -1;

//Height
$(".height_form").change(function(){
	min = parseFloat($('#height_min').val());
	max = parseFloat($('#height_max').val());
	is_min_number = (min + 0 == min)  //This is what happends when you program without internet. ¿How was the function to see if it was a number called...?
	is_max_number = (max + 0 == max)

	if(is_min_number||is_max_number)
		$(".height_results").children().show();
	else
		$(".height_results").children().hide();

	if(is_min_number){
		min_height_calculate = 10*min;
		$('#height_from').html(' - Desde ' + min + ' [m]');
		$('#height_from').show();
	}
	else{
		min_height_calculate = -1;
		$('#height_from').hide();
	}
	
	if(is_max_number){
		max_height_calculate = 10*max;		
		$('#height_to').html(' - Hasta ' + max + ' [m]');
		$('#height_to').show();
	}
	else{
		max_height_calculate = -1;
		$('#height_to').hide();
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
	is_min_number = (min + 0 == min) //I don't copypaste code, I swear!
	is_max_number = (max + 0 == max)

	if(is_min_number||is_max_number)
		$(".weight_results").children().show();
	else
		$(".weight_results").children().hide();

	if(is_min_number){
		min_weight_calculate = 10*min;
		$('#weight_from').html(' - Desde ' + min + ' [kg]');
		$('#weight_from').show();
	}
	else{
		min_weight_calculate = -1;
		$('#weight_from').hide();
	}
	
	if(is_max_number){
		max_weight_calculate = 10*max;		
		$('#weight_to').html(' - Hasta ' + max + ' [kg]');
		$('#weight_to').show();
	}
	else{
		max_weight_calculate = -1;
		$('#weight_to').hide();
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
			gen_calculate[i-1] = false;
		}
		else{
			($('#gen_result_'+i)).hide()
			gen_calculate[i-1] = true;
		}
	}
});
//End of generation checkboxes

//Start of type dropdowns
$(".type_dropdown").change(function() {
	type1 = $('#type_1').val();
	type2 = $('#type_2').val();
	type1_selected = (type1 != '');
	type2_selected = (type2 != '');
	if( type1_selected || type2_selected ){
        type1_text = $("#type_1").children("option").filter(":selected").text();
		type2_text = $("#type_2").children("option").filter(":selected").text();
		$(".type_results").children().show();
		if(type1_selected){
			$("#div_type_1_result").show();
			$("#type_1_result").html(type1_text);
			type_1_calculate = type1;
		}else{
			type_1_calculate = -1;
            $("#div_type_1_result").hide();
		}
		if(type2_selected){
			$("#div_type_2_result").show();
			$("#type_2_result").html(type2_text);
			type_2_calculate = type2;
		}else{
            $("#div_type_2_result").hide();
			type_2_calculate = -1;
		}
	}else{
		$(".type_results").children().hide();
		type_1_calculate = -1;
		type_2_calculate = -1;
	}
});
//end of type dropdowns

//Start of color
$("#color_dropdown").change(function() {
	color = $('#color_dropdown').val();
	color_selected = (color != '');
	if(color_selected){		
		color_text = $("#color_dropdown").children("option").filter(":selected").text();
		$(".div_color").show();
		$("#color_result").html(color_text);
		color_calculate = color;
	}else{
		color_calculate = -1;
        $(".div_color").hide();
	}
});

$(".color_remove").click(function(){
	$(".color_results").children().hide();
	$("#color").val('');
	color_calculate = -1;
});
//end of color

//Start of egg group
$("#eggie_dropdown").change(function() {
	eggie = $('#eggie_dropdown').val();
	eggie_selected = (eggie != '');
	if(eggie_selected){		
		eggie_text = $("#eggie_dropdown").children("option").filter(":selected").text();
		$(".egg_color").show();
		$("#egg_result").html(eggie_text);
		egg_calculate = eggie;
	}else{
		egg_calculate = -1;
        $(".div_egg").hide();
	}
});

$(".egg_remove").click(function(){
	$(".egg_results").children().hide();
	$("#eggr").val('');
	egg_calculate = -1;
});
//end of egg group

//Ajax link.
$('#search-data').click(function() {
	$.ajax({
    	url: '<?php echo $this->createAbsoluteUrl("searchPokemon") ?>',
    	type: 'POST',
    	data: { min_height: min_height_calculate,
    			max_height: max_height_calculate,
    			min_weight: min_weight_calculate,
				max_weight: max_weight_calculate,
				gen_1: !gen_calculate[0],
				gen_2: !gen_calculate[1],
				gen_3: !gen_calculate[2],
				gen_4: !gen_calculate[3],
				gen_5: !gen_calculate[4],
				gen_6: !gen_calculate[5],
                type_1: type_1_calculate,
                type_2: type_2_calculate,
                color: color_calculate,
                eggie: egg_calculate,
    	} ,
    	'success': function(data) {
      		$('.div_show_results').html(data);
    	}
	});
});

</script>
<!-- END OF JAVASCRIPT -->


 <!--- CRITERIOS A CONSIDERAR:
 Experiencia base
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

