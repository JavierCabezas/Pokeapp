

<?php  if(!is_null($pokemon_to_catch)): ?>


<h3> Calculando la probabilidad de... </h3>
<p> Atrapar a <b><?php echo $pokemon_to_catch; ?></b> <b> <?php echo $status_text ?></b> con <b><?php echo $hp_percentage?>%</b> de vida 
	con una <b><?php echo $pokeball_en ?></b> (<?php echo $pokeball_es?>) en <b><?php echo $gen ?> generación</b>.
</p>


<?php echo $text_pokeball ?>

<?php echo var_dump($out); ?>
<?php echo $out['prob_0_wobble']+$out['prob_1_wobble']+$out['prob_2_wobble']+$out['prob_3_wobble']?>

	<h3> Análisis de éxito de captura</h3>
   	<div id="pie_chart_div_simple"></div>

   	<h3> Veces que se agita la pokéball. </h3>
   	<p> Esta información se calcula <b> en caso de que la captura haya fracasado </b>. En caso de que la captura haya sido exitosa la pokéball se agita tres veces y finalmente se cierra. </p>
   	<?php if($out['prob_win'] != 100): //Just show the wobble graph if the probability of catching isn't a 100% ?>
   		<div id="pie_chart_div_detailed"></div>	
   	<?php else: ?>
   		<p> Dado que la probabilidad de captura es del 100% no se necesita este análisis. </p>
   	<?php endif; ?>
<p>
	Para ver con mayor rigurosidad el análisis matemático detrás de estos números puedes revisar <?php Yii::app()->params["pokeball_math_page"] ?>
</p>

<script type='text/javascript'>
	//For simple pie chart.
	var simple = Raphael("pie_chart_div_simple"),
	pie_simple = simple.piechart(200,200, 130, [
				<?php if($out['prob_win'] != 0): ?> <?php echo $out['prob_win'] ?>,  <?php endif; ?> 
				<?php if($out['prob_fail'] != 0):?> <?php echo $out['prob_fail'] ?>, <?php endif; ?>
			], { legend: [
				<?php if($out['prob_win'] != 0):  ?> "%%.%% - Captura exitosa", <?php endif; ?> 
				<?php if($out['prob_fail'] != 0): ?> "%%.%% - Captura sin éxito", <?php endif; ?>
			], legendpos: "east"});
		
	pie_simple.hover(function () {
		this.sector.stop();
		this.sector.scale(1.1, 1.1, this.cx, this.cy);

		if (this.label) {
			this.label[0].stop();
			this.label[0].attr({ detailed: 7.5 });
			this.label[1].attr({ "font-weight": 800 });
		}
		}, function () {
			this.sector.animate({ transform: 's1 1 ' + this.cx + ' ' + this.cy }, 500, "bounce");

		if (this.label) {
			this.label[0].animate({ detailed: 5 }, 500, "bounce");
			this.label[1].attr({ "font-weight": 400 });
		}
	});

	<?php if($out['prob_win'] != 100): //Don't include the javascript of the second graph in case the catch chance is 100% ?>
	//For the detailed pie chart.
	var detailed = Raphael("pie_chart_div_detailed"),
		pie_detailed = detailed.piechart(320, 240, 100, [
					<?php echo $out['prob_0_wobble'] ?>,
					<?php echo $out['prob_1_wobble'] ?>,
					<?php echo $out['prob_2_wobble'] ?>,
					<?php echo $out['prob_3_wobble'] ?>,
				], { legend: [
					"%%.%% - La pokéball no se agita",
					"%%.%% - La pokéball se agita una vez", 
					"%%.%% - La pokéball se agita dos veces", 
					"%%.%% - La pokéball se agita tres veces",
					], legendpos: "east"});

	pie_detailed.hover(function () {
		this.sector.stop();
		this.sector.scale(1.1, 1.1, this.cx, this.cy);

		if (this.label) {
			this.label[0].stop();
			this.label[0].attr({ detailed: 7.5 });
			this.label[1].attr({ "font-weight": 800 });
		}
		}, function () {
			this.sector.animate({ transform: 's1 1 ' + this.cx + ' ' + this.cy }, 500, "bounce");

		if (this.label) {
			this.label[0].animate({ detailed: 5 }, 500, "bounce");
			this.label[1].attr({ "font-weight": 400 });
		}
	});
	<?php endif; 	//Endif for is prob_win != 100 ?>
	
</script>
<?php endif; //Endif of content?>
