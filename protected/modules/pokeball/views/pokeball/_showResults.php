

<?php  if(!is_null($pokemon_to_catch)): ?>


<h3> Calculando la probabilidad de... </h3>
<p> Atrapar a <b><?php echo $pokemon_to_catch; ?></b> <b> <?php echo $status_text ?></b> con <b><?php echo $hp_percentage?>%</b> de vida 
	con una <b><?php echo $pokeball_en ?></b> (<?php echo $pokeball_es?>) en <b><?php echo $gen ?> generación</b>.
</p>


<?php echo $text_pokeball ?>

<?php echo var_dump($out); ?>
<?php echo $out['prob_0_wobble']+$out['prob_1_wobble']+$out['prob_2_wobble']+$out['prob_3_wobble']?>

	<h3> Análisis simple de probabilidad de captura. </h3>
   	<div id="pie_chart_div_simple"></div>

   <h3> Análisis detallado de probabilidad de captura. </h3>
   <p> La cantidad de veces que se agita la pokéball se refiere a, en caso de que la captura haya fracasado, cuantas veces se agitó la pokéball antes de que el pokémon saliese de ella </p>
   <div id="pie_chart_div_detailed"></div>

<script type='text/javascript'>
	//For simple pie chart.
	var simple = Raphael("pie_chart_div_simple"),
	pie_simple = simple.piechart(200,200, 130, [
				<?php echo $out['prob_win'] ?>, 
				<?php echo $out['prob_fail'] ?>,
			], { legend: [
				"%%.%% - Captura exitosa", 
				"%%.%% - Captura sin éxito",
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

	//For the detailed pie chart.
	var detailed = Raphael("pie_chart_div_detailed"),
		pie_detailed = detailed.piechart(320, 240, 100, [
					<?php echo $out['prob_win'] ?>, 
					<?php echo $out['prob_0_wobble'] ?>,
					<?php echo $out['prob_1_wobble'] ?>,
					<?php echo $out['prob_2_wobble'] ?>,
					<?php echo $out['prob_3_wobble'] ?>,
				], { legend: [
					"%%.%% - Captura exitosa", 
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
</script>
<?php endif; //Endif of content?>
