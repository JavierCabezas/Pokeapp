<?php  if(!is_null($pokemon_to_catch)): ?>


<h3> Calculando la probabilidad de... </h3>
<ul>
	<li> Atrapar a <b><?php echo $pokemon_to_catch; ?></b>. </li>
	<li> <?php echo $status_text ?>. </li>
	<li> Con <b><?php echo $hp_percentage?>%</b> de vida. </li>
	<li> <b><?php echo $pokeball_en ?></b> (<?php echo $pokeball_es?>). </li> 
	<li> En <?php echo $gen ?> generación.</li>
</ul>

	<h3> Análisis de éxito de captura</h3>
   	<div id="pie_chart_div_simple"></div>

   	<!-- Expected value -->
   	<p> Con <?php echo $out['prob_win'].'%' ?> de probabilidad de éxito necesitas, en promedio, unas <b> <?php echo $expected_value . " " . $pokeball_en ?></b> para capturar a <?php echo $pokemon_to_catch ?>. </p>
   	<p> &nbsp; </p>

   	<h3> Veces que se agita la pokéball. </h3>

   	<?php if($gen = 'segunda'): //For second generation the wobble mechanics are different than in the other gens ?>
   		<p> Esta información se calcula, en segunda generación, <b> en caso de que la captura haya fracasado </b>. En caso de que la captura haya sido exitosa la pokéball se agita tres veces y finalmente se cierra. </p>
   	<?php else: //All generations but second.?>
   		<p> Las veces que se agita la pokéball, desde tercera generación en adelante, representa a un intento del pokémon de salir fuera de la pokéball. El pokémon hace 4 intentos de escaparse y si falla en todos ellos la captura es exitosa. El siguiente gráfico se calcula suponiendo que la captura falló.</p>
   	<?php endif; ?>
   	
   	<?php if($out['prob_win'] != 100): //Just show the wobble graph if the probability of catching isn't a 100% ?>
   		<div id="pie_chart_div_detailed"></div>	
   	<?php else: ?>
   		<p> Dado que la probabilidad de captura es del 100% no se necesita este análisis. </p>
   	<?php endif; ?>

   	<p> &nbsp; </p>

   	<h3> Más información ... </h3>

   	<p> Si quieres encontrar más información acerca del algoritmo que se usa para el cálculo de las probabilidades puedes revisar mi artículo al 
   		respecto ( <?php echo CHtml::link('Parte 1', 'http://www.pokedaisuki.cl/?p=1898') ?> | <?php echo CHtml::link('Parte 2', 'http://www.pokedaisuki.cl/bajo-el-camion-del-s-s-anne-n5-formulas-de-captura-parte-2/') ?> ).
		Para escribirlos adapté de los artículos de probabilidad de captura que hizo la autora de <?php echo CHtml::link('The Cave of the Dragonflies', 'http://www.dragonflycave.com/') ?>.
	</p>

	<p> 
		Si les interesa pegarles una leida (son bien buenos, la autora es súper seca) pueden hacerlo en los siguientes links: <?php echo CHtml::link('Generación 2', 'http://www.dragonflycave.com/gen2capture.aspx') ?>, 
   		<?php echo CHtml::link('generaciones 3 y 4', 'http://www.dragonflycave.com/capture.aspx') ?> (estas dos comparten el mismo algoritmo) y 
		<?php echo CHtml::link('generación 5', 'http://www.dragonflycave.com/gen5capture.aspx') ?>. Ojo que estos están en inglés.
	</p>

	<p> Aún no he hecho la calculadora para sexta generación dado que desconozco el algoritmo. Estoy seguro que algún grupo de ñoños lo lanzará eventualmente y, cuando lo hagan,
		actualizaré la calculadora con la información respectiva. La verdad tengo ene ganas de ver como funciona esa cuestión!
	</p>

	<p> 
		Y por último en todos estos análisis no incluí a la Heavy Ball. Esto es totalmente intencional y es dado que esta funciona con un algoritmo súper especial que me requerirá más tiempo en
		programar. Estoy seguro que en una versión futura de esta aplicación lo iré agregando.
	</p>

	<p> &nbsp; </p>
<!-- inicio accordeon -->
<div class="accordion-group">
	<div class="accordion-heading">
		<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
			Click aquí para ver más detalles de como se realizó el cálculo de la probabilidad de más arriba.
		</a>
	</div>
<div id="collapseTwo" class="accordion-body collapse">
	<div class="accordion-inner">
		<?php if($gen = 'segunda'): //For second generation  ?>
   		
			<?php echo $text_pokeball ?>.
	
			<p> Se calcularon las siguientes variables: </p>
			<?php echo $math_details ?>
			
			<?php endif;?>
	
	</div>
</div><!-- fin accordeon -->

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
