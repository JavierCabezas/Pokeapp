<div class="page-header">
	<h1> <?php echo $tournament->name ?> <small> <?php echo $tournament->location ?>, <?php echo $date?> </h1>
</div>

<p> En el <?php echo $tournament->name ?> participaron <b class='participants'> <?php echo $tournament->numberPlayers ?></b> jugadores. </p>

<p> El torneo usó reglas modalidad <b class='size_15'> <?php echo $tournament->idRuleset->name ?></b>.  Según las reglas del torneo se tenía prohibidos: </p>

<?php echo $this->renderPartial('_banned', array(
		'banned_pokemon' => $banned_pokemon,
		'banned_items'	 => $banned_items, 
		'banned_moves'	 => $banned_moves,	
	)); 
?>

<h3> Pokémon más populares </h3>

<p> No fue sorpresivo saber que <b class='size_15'><?php echo $most_popular ?></b> fue la elección más popular entre los participantes. </p>

<?php echo $this->renderPartial('_top10pokemon', array('pokemon' => $pokemon)); ?>