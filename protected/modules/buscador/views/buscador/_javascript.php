<!-- This file containts the javascript code for the confirmation of the search and for the ajax link to actually get the content -->

<script>
$(".height_results").children().hide();
$(".weight_results").children().hide();
$(".gen_results").children().hide();
$(".type_results").children().hide();
$(".inmunity_results").children().hide();
$(".color_results").children().hide();
$(".move_results").children().hide();
$(".egg_results").children().hide();
$(".move_results").children().hide();
$(".ability_results").children().hide();
$(".stats_results").children().hide();

//Variables
var gen_calculate 		= new Array(false, false, false, false, false, false);
var stats_calculate 	= new Array(-1, -1, -1, -1, -1, -1, -1);
var stats_ev 			= new Array(-1, -1, -1, -1, -1, -1, -1);
var stats_iv 			= new Array(-1, -1, -1, -1, -1, -1, -1);
var moves 				= new Array(-1, -1, -1, -1);
stat_level_calculate 	=  1;
min_height_calculate 	= -1;
max_height_calculate 	= -1;
min_weight_calculate 	= -1;
max_weight_calculate 	= -1;
type_1_calculate 		= -1;
type_2_calculate 		= -1;
inmunity_calculate		= -1;
color_calculate 		= -1;
egg_calculate         	= -1;
move_1_calculate		= -1;
move_2_calculate		= -1;
move_3_calculate		= -1;
move_4_calculate		= -1;
ability_calculate 		= -1;

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

//Start of MOVES
function actualizarMovimientos(moves){
	console.log(moves);
	$(".move_results").children().hide();
	$("#move_results").html(" ");
	for (var i = 0; i < 4 ; i++) {
		if(moves[i] != -1){
			$("#move_results").append('<li>'+moves[i]+'</li>');
			$(".move_results").children().show();
		}
	}
}

$(".move_remove").click(function(){
	$("#s2id_moves_1").select2("val", "");
	$("#s2id_moves_2").select2("val", "");
	$("#s2id_moves_3").select2("val", "");
	$("#s2id_moves_4").select2("val", "");
	$(".move_results").children().hide();
	$("#move_results").html(" ");
	moves[0] = moves[1] = moves[2] = moves[3] = -1;
	move_1_calculate = move_2_calculate = move_3_calculate = move_4_calculate = -1;
});

$('#moves_1').on("change", function(e) {
	if($('#moves_1').select2('data')){
		move_1_calculate = $('#moves_1').select2('data').id
		moves[0] 		 = $('#moves_1').select2('data').text;
	}
	else{
		move_1_calculate = -1;
		moves[0] 		 = -1;
	}
	actualizarMovimientos(moves);
});

$('#moves_2').on("change", function(e) {
	if($('#moves_2').select2('data')){
		move_2_calculate = $('#moves_2').select2('data').id
		moves[1] 		 = $('#moves_2').select2('data').text;
	}
	else{
		move_2_calculate = -1;
		moves[1] 		 = -1;
	}
	actualizarMovimientos(moves);
});

$('#moves_3').on("change", function(e) {
	if($('#moves_3').select2('data')){
		move_3_calculate = $('#moves_3').select2('data').id
		moves[2] 		 = $('#moves_3').select2('data').text;
	}
	else{
		move_3_calculate = -1;
		moves[2] 		 = -1;
	}
	actualizarMovimientos(moves);
});

$('#moves_4').on("change", function(e) {
	if($('#moves_4').select2('data')){
		move_4_calculate = $('#moves_4').select2('data').id
		moves[3] 		 = $('#moves_4').select2('data').text;
	}
	else{
		move_4_calculate = -1;
		moves[3] 		 = -1;
	}
	actualizarMovimientos(moves);
});
//end of moves

//Start of abilities
$('#ability').on("change", function(e) {
	if($('#ability').select2('data')){
		ability_calculate = $('#ability').select2('data').id
		$(".ability_results").children().show();
		$("#ability_results").html( $('#ability').select2('data').text );
	}else{
		$("#ability_results").html(" ");
		ability_calculate = -1;
	}
});

$(".ability_remove").click(function(){
	$(".ability_results").children().hide();
	$("#ability_results").html('');
	ability_calculate = -1;
	$("#s2id_ability").select2("val", "");
});
//end of abilities

//Start of stats 

/** 
 *	@return boolean true in case the user did input something on the stats fields.
 */
function areThereSelectedStats(){
	return !( "" == ($("#stats_hp").val() || $("#stats_atk").val() || $("#stats_def").val() || $("#stats_spa").val() || $("#stats_spd").val() || $("#stats_spe").val() ))
}

$(".stat").change(function(e) {
	//Hide or show the results depending on the user selection.
	if(areThereSelectedStats()){
		$(".stats_results").children().show();
	}
	else{
		$(".stats_results").children().hide();
	}

	hp  				 = $("#stats_hp").val();
	atk 				 = $("#stats_atk").val()
	def 				 = $("#stats_def").val()
	spa 				 = $("#stats_spa").val()
	spd 				 = $("#stats_spd").val()
	spe 				 = $("#stats_spe").val()
	ev_hp 				 = $("#ev_hp").val()
	ev_atk 				 = $("#ev_atk").val()
	ev_def 				 = $("#ev_def").val()
	ev_spa 				 = $("#ev_spa").val()
	ev_spd 				 = $("#ev_spd").val()
	ev_spe 				 = $("#ev_spe").val()
	iv_hp 				 = $("#iv_hp").val()
	iv_atk 				 = $("#iv_atk").val()
	iv_def 				 = $("#iv_def").val()
	iv_spa 				 = $("#iv_spa").val()
	iv_spd 				 = $("#iv_spd").val()
	iv_spe 				 = $("#iv_spe").val()
	stat_nat 			 = $("#stats_nature").val()
	stat_nat_t			 = $("#stats_nature option:selected").text();
	stat_level_calculate = $("#stats_nivel").val();

	$(".stat_nivel").html($("#stats_nivel").val());
	$(".stat_nature").html(stat_nat_t)

	//Hide or show any individual stat depending on the user selection.
	if (hp){
		$(".stats_hp").html('Con '+ev_hp+' EV y '+iv_hp+' IV, <b>' + hp + ' Hit points </b> (puntos de impacto)');
		$(".stats_hp").show();
		stats_calculate[0] = hp;
	}
	else{
		$(".stats_hp").hide();
		stats_calculate[0] = -1;
	}

	if (atk){
		$(".stats_atk").html('Con '+ev_atk+' EV y '+iv_atk+' IV, <b>' + atk + ' En Attack </b> (ataque)');
		$(".stats_atk").show();
		stats_calculate[1] = atk;
	}
	else{
		$(".stats_atk").hide();
		stats_calculate[1] = -1;
	}

	if (def){
		$(".stats_def").html('Con '+ev_def+' EV y '+iv_def+' IV, <b>' + def + ' En Defence </b> (defensa)');
		$(".stats_def").show();
		stats_calculate[2] = def;
	}
	else{
		$(".stats_def").hide();
		stats_calculate[2] = -1;
	}

	if (spa){
		$(".stats_spa").html('Con '+ev_spa+' EV y '+iv_spa+' IV, <b>' + spa + ' En Special Attack </b> (ataque especial)');
		$(".stats_spa").show();
		stats_calculate[3] = spa;
	}
	else{
		$(".stats_spa").hide();
		stats_calculate[3] = -1;
	}

	if (spd){
		$(".stats_spd").html('Con '+ev_spd+' EV y '+iv_spd+' IV, <b>' + spd + ' En Special Defence </b> (defensa especial)');
		$(".stats_spd").show();
		stats_calculate[4] = spd;
	}
	else{
		$(".stats_spd").hide();
		stats_calculate[4] = -1;
	}

	if (spe){
		$(".stats_spe").html('Con '+ev_spe+' EV y '+iv_spe+' IV, <b>' + spe + ' En Speed </b> (velocidad)');
		$(".stats_spe").show();
		stats_calculate[5] = spe;
	}
	else{
		$(".stats_spe").hide();
		stats_calculate[5] = -1;
	}
});
//End of stats


//Ajax link.
$('#search-data').click(function() {
	$.ajax({
 		url: '<?php echo $this->createAbsoluteUrl("searchPokemon") ?>',
 		type: 'POST',
 		data: 
 			{ 
 				min_height: min_height_calculate,
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
				color: 		color_calculate,
				eggie: 		egg_calculate,
				move1: 		move_1_calculate,
				move2: 		move_2_calculate,
				move3: 		move_3_calculate,
				move4: 		move_4_calculate,
				ability: 	ability_calculate,
				hp: 		stats_calculate[0],
				atk: 		stats_calculate[1],
				def: 		stats_calculate[2],
				spa: 		stats_calculate[3],
				spd: 		stats_calculate[4],
				spe: 		stats_calculate[5],
				stat_nat:   stat_nat,
				stat_level: stat_level_calculate,
				ev_hp: 		ev_hp,
				ev_atk: 	ev_atk,
				ev_def: 	ev_def,
				ev_spa: 	ev_spa,
				ev_spd: 	ev_spd,
				ev_spe: 	ev_spe,
				iv_hp: 		iv_hp,
				iv_atk: 	iv_atk,
				iv_def: 	iv_def,
				iv_spa: 	iv_spa,
				iv_spd: 	iv_spd,
				iv_spe: 	iv_spe,

    		} ,
    	'success': function(data) {
      		$('.div_show_results').html(data);
    	}
	});
});

</script>
<!-- END OF JAVASCRIPT -->
