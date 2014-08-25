<div class="page-header">
	<h1> Estadísticas <?php echo $tournament->name ?> <small> <?php echo $tournament->location ?>, <?php echo $date?> </h1>
</div>

<h2> 1. -  Del torneo mismo </h2>
<p> En el <?php echo $tournament->name ?> participaron <b class='participants'> <?php echo $tournament->numberPlayers ?></b> jugadores. </p>

<p> El torneo usó reglas modalidad <b class='size_15'> <?php echo $tournament->idRuleset->name ?></b>.  Según las reglas del torneo se tenía prohibidos: </p>

<?php echo $this->renderPartial('_statsBanned', array(
		'banned_pokemon' => $banned_pokemon,
		'banned_items'	 => $banned_items, 
		'banned_moves'	 => $banned_moves,	
	)); 
?>

<h2> 2. -  Sobre los pokémon  </h2>

<p> Partamos con algunas estadísticas inútiles pero entretenidas: 

<ul>
	<li> Fueron inscritos un total de <b class='size_15'><?php echo $silly['number'] ?> Pokémon</b> en el evento. </li>
	<li> De estos <b class='size_15'><?php echo $silly['nickname_number'] ?></b> (un <?php echo $silly['nickname_percent'] ?>%) tenían sobrenombres (o motes). ¡Esperaba un 100%! El ponerles nombres es la parte más entretenida. Lo perdono porque habían un par de nombres muy chistosos.</li>
	<li> El nivel promedio de los Pokémon inscritos fue de <b class='size_15'><?php echo $silly['level'] ?></b>. </li>
	<li> <b class='size_15'><?php echo $silly['move1'] ?></b> Pokémon tenían un único movimiento registrado (solo se me ocurre ditto como excusa). </li>
	<li> <b class='size_15'><?php echo $silly['move2'] ?></b> Pokémon sólo dos movimientos registrados. </li>
	<li> <b class='size_15'><?php echo $silly['move3'] ?></b> Pokémon tenían exactamentre tres movimientos. </li>
	<li> (El resto, obviamente, tenía 4 movimientos registrados). </li>
</ul>


<p> Ahora, si vamos a hablar sobre la popularidad de los Pokémon inscritos, no fue sorpresivo saber que <b class='size_15'><?php echo $most_popular ?></b> fue la elección más popular entre los participantes. </p>

<?php echo $this->renderPartial('_statsTopPokemon', array('pokemon' => $pokemon)); ?>


<p> Estos pokémon tenían la siguiente distribución de tipos: </p>
<?php $this->renderPartial('_statsTypes', array(
		    'types'     => $silly['types'],
	        'types_per' => $silly['types_per']
      ));
?>


<h2> 3. - Sobre los objetos  </h2>

<?php echo $this->renderPartial('_statsTopItems', array('items' => $items)); ?>