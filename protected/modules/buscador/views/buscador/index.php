<h1> Buscador de Pokémon por criterios interesantes </h1>

<div id="column1-wrap">
    <div id="column1">
    	<?php $this->renderPartial('_criteria') ?>
    </div> <!-- end of column1 -->
</div> <!-- end of comlumn1-wrap -->

<div id="column2">
	<?php $this->renderPartial('_results') ?>
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
$(".inmunity_results").children().hide();
$(".resistant_results").children().hide();
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
inmunity_calculate		= -1;
resistant_calculate		= -1;
color_calculate 		= -1;
egg_calculate         	= -1;
move_1_calculate		= -1;
move_2_calculate		= -1;
move_3_calculate		= -1;
move_4_calculate		= -1;

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
		$("#div_type_1_result").children().show();
		$("#div_type_2_result").children().show();
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

$("#type_remove_1").click(function(){
	$("#div_type_1_result").children().hide();
});
$("#type_remove_2").click(function(){
	$("#div_type_2_result").children().hide();
});
//end of type dropdowns

//Start of inmunity 
$(".inmunity_dropdown").change(function() {
	type_inmunity = $('#type_inmunity').val();
	inmunity_text = $("#type_inmunity").children("option").filter(":selected").text();
	inmunity_selected = (type_inmunity != '');
	if(inmunity_selected){
		inmunity_calculate = type_inmunity;
		$(".inmunity_results").children().show();
		$("#inmunity_result").html(inmunity_text);
	}else{
		inmunity_calculate		= -1;
		$(".inmunity_results").children().hide();
		$("#inmunity_result").html("");
	}
});

$(".inmunity_remove").click(function(){
	inmunity_calculate		= -1;
	$(".inmunity_results").children().hide();
});
//End of inmunity 

//Start of resistant 
$(".resistant_dropdown").change(function() {
	type_resistant = $('#type_resistant').val();
	resistant_text = $("#type_resistant").children("option").filter(":selected").text();
	resistant_selected = (type_resistant != '');
	if(resistant_selected){
		resistant_calculate = type_resistant;
		$(".resistant_results").children().show();
		$("#resistant_result").html(resistant_text);
	}else{
		resistant_calculate		= -1;
		$(".resistant_results").children().hide();
		$("#resistant_result").html("");
	}
});

$(".resistant_remove").click(function(){
	resistant_calculate		= -1;
	$(".resistant_results").children().hide();
});
//End of resistant


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

//start of moves
$('#moves_1').on("change", function(e) {
	if($('#moves_1').select2('data'))
		move_1_calculate = $('#moves_1').select2('data').id
	else
		move_1_calculate = -1;
});

$('#moves_2').on("change", function(e) {
	if($('#moves_2').select2('data'))
		move_2_calculate = $('#moves_2').select2('data').id
	else
		move_2_calculate = -1;
});

$('#moves_3').on("change", function(e) {
	if($('#moves_3').select2('data'))
		move_3_calculate = $('#moves_3').select2('data').id
	else
		move_3_calculate = -1;
});

$('#moves_4').on("change", function(e) {
	if($('#moves_4').select2('data'))
		move_4_calculate = $('#moves_4').select2('data').id
	else
		move_4_calculate = -1;
});
//end of moves

//Ajax link.
$('#search-data').click(function() {
	$.ajax({
    	url: '<?php echo $this->createAbsoluteUrl("searchPokemon") ?>',
    	type: 'POST',
    	data: { min_height: min_height_calculate,
    			max_height: max_height_calculate,
    			min_weight: min_weight_calculate,
				max_weight: max_weight_calculate,
				gen_1: 		!gen_calculate[0],
				gen_2: 		!gen_calculate[1],
				gen_3: 		!gen_calculate[2],
				gen_4: 		!gen_calculate[3],
				gen_5: 		!gen_calculate[4],
				gen_6: 		!gen_calculate[5],
                type_1: 	type_1_calculate,
                type_2: 	type_2_calculate,
                inmunity: 	inmunity_calculate,
                resistant:  resistant_calculate,
                color: 		color_calculate,
                eggie: 		egg_calculate,
                move1: 		move_1_calculate,
                move2: 		move_2_calculate,
                move3: 		move_3_calculate,
                move4: 		move_4_calculate,
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

