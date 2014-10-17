<?php $this->setPageTitle('Pokéapp - Calculadora de stats'); ?>

<h1 class="stats"> Calculadora de stats </h1>

<div class="infosec">
	<p>En este módulo puedes hacer una simulación de stats de algún Pokémon y compararlo con otro.
	Puedes usar esta calculadora para hacer estimaciones de los stats de tus Pokémon antes de entrenarlos o estimar cuantos EV necesitarás entregarle a tu Pokémon. </p>
	<p>La validación de EV se omitió intencionalmente para no limitar los resultados. ¡Ten en cuenta eso al hacer el cálculo! </p>
</div>

<!-- Render the two forms partials -->

<div id="pokemon_info">
	<div class='pokemon_1'>
		<h3>Pokémon 1</h3>
		<?php $this->renderPartial('_form', array('n'=> 1));?>
	</div> <!-- end of form 1 -->

	<div class='pokemon_2'>
		<h3>Pokémon 2</h3>
		<?php $this->renderPartial('_form', array('n' => 2));?>
	</div> <!-- end of form 2 -->
</div>

<div id="results_info">
	<div class='result_1'>
		<?php $this->renderPartial('_showResults', array(
			'n'		 => 1,
			'pokemon' => null
		)); ?>
	</div> <!-- end of results 1 -->

	<div class='result_2'>
		<?php $this->renderPartial('_showResults', array(
			'n'		 => 2,
			'pokemon' => null
		)); ?>
	</div> <!-- end of results 2 -->
</div>