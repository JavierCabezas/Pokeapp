<?php $this->setPageTitle('Pokéapp - Buscador de pokémon.'); ?>

<h1 class="buscarpkmn"> Buscador Pokémon </h1>

<div id="column1-wrap">
    <div id="column1">
    	<div class='well'>
	    	<?php $this->renderPartial('_criteria') ?>
	    </div>
    </div> <!-- end of column1 -->
</div> <!-- end of comlumn1-wrap -->

<div id="column2">
	<div class='well'>
		<?php $this->renderPartial('_results') ?>
	</div>
</div>

<div id="clear"></div>

<div class='well'>
	<div class="div_show_results">
		<!-- The results will be shown here -->
	</div> <!-- end of div_show_results-->
</div>

<?php $this->renderPartial('_javascript') ?>

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

