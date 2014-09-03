<div class="page-header">
	<h1> Estadísticas <?php echo $tournament->name ?> <small> <?php echo $tournament->location ?>, <?php echo $date?> </h1>
</div>

<div class="infosec">
	<h2 class="info_torneo"> 1. -  Del torneo mismo </h2>
	<p> En el <?php echo $tournament->name ?> participaron <b class='participants'> <?php echo $tournament->numberPlayers ?></b> jugadores. </p>

	<p> El torneo usó reglas modalidad <b class='size_15'> <?php echo $tournament->idRuleset->name ?></b>.  Según las reglas del torneo se tenía prohibidos: </p>

	<?php echo $this->renderPartial('_statsBanned', array(
			'banned_pokemon' => $banned_pokemon,
			'banned_items'	 => $banned_items, 
			'banned_moves'	 => $banned_moves,	
		)); 
	?>

	<h2 class="info_pkmn"> 2. -  Sobre los pokémon  </h2>

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

	<p>Estos pokémon tenían la siguiente distribución de tipos: </p>
	<?php $this->renderPartial('_statsTypes', array(
			    'types'     => $silly['types'],
		        'types_per' => $silly['types_per']
	    ));
	?>

	<h2 class="info_pkmn"> 3. - Sobre los objetos  </h2>
	<div id="items">
		<?php echo $this->renderPartial('_statsTopItems', array('items' => $items)); ?>
	</div>


	<h2> 4. - Pokémon del TOP17  </h2>

	<table>
		<tr>
			<td> <b class='size_15'> 1. </b> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'ditto.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'charizard.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'raichu.gif') ?>  </td>
		</tr>
		<tr>
			<td> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'sylveon.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'hydreigon.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'staraptor.gif') ?>  </td>
		</tr>

		<tr>
			<td> <b class='size_15'> 2.  </b> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'garchomp.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'hydreigon.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'mawile.gif') ?>  </td>
		</tr>
		<tr>
			<td> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'chesnaught.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'lapras.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'rotom.gif') ?>  </td>
		</tr>

		<tr>
			<td> <b class='size_15'> 3. </b>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'aegislash.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'rotom.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'chandelure.gif') ?>  </td>
		</tr>
		<tr>
			<td> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'garchomp.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'kangaskhan.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'azumarill.gif') ?>  </td>
		</tr>

		<tr>
			<td> <b class='size_15'> 4. </b>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'raichu.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'lucario.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'amoonguss.gif') ?>  </td>
		</tr>
		<tr>
			<td> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'tyranitar.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'delphox.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'gyarados.gif') ?>  </td>
		</tr>

		<tr>
			<td> <b class='size_15'> 5.  </b> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'rotom.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'chandelure.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'mawile.gif') ?>  </td>
		</tr>
		<tr>
			<td> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'staraptor.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'scrafty.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'gothitelle.gif') ?>  </td>
		</tr>

		<tr>
			<td> <b class='size_15'> 6.  </b> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'garchomp.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'kangaskhan.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'rotom.gif') ?>  </td>
		</tr>
		<tr>
			<td> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'talonflame.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'charizard.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'smeargle.gif') ?>  </td>
		</tr>

		<tr>
			<td> <b class='size_15'> 7.  </b> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'talonflame.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'garchomp.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'lapras.gif') ?>  </td>
		</tr>
		<tr>
			<td> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'tyranitar.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'manectric.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'aegislash.gif') ?>  </td>
		</tr>

		<tr>
			<td> <b class='size_15'> 8.  </b> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'venusaur.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'conkeldurr.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'dragonite.gif') ?>  </td>
		</tr>
		<tr>
			<td> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'nidoking.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'gyarados.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'magnezone.gif') ?>  </td>
		</tr>

		<tr>
			<td> <b class='size_15'> 9.  </b> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'aegislash.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'hippowdon.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'ferrothorn.gif') ?>  </td>
		</tr>
		<tr>
			<td> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'hydreigon.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'rotom.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'aerodactyl.gif') ?>  </td>
		</tr>

		<tr>
			<td> <b class='size_15'> 10.  </b> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'talonflame.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'hydreigon.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'throh.gif') ?>  </td>
		</tr>
		<tr>
			<td> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'kangaskhan.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'charizard.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'gengar.gif') ?>  </td>
		</tr>

		<tr>
			<td> <b class='size_15'> 11. </b>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'blastoise.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'kangaskhan.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'chandelure.gif') ?>  </td>
		</tr>
		<tr>
			<td> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'nidoqueen.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'reuniclus.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'gyarados.gif') ?>  </td>
		</tr>

		<tr>
			<td> <b class='size_15'> 12.  </b> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'scrafty.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'scolipede.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'venusaur.gif') ?>  </td>
		</tr>
		<tr>
			<td> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'azumarill.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'blastoise.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'rotom.gif') ?>  </td>
		</tr>

		<tr>
			<td> <b class='size_15'> 13. </b>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'sableye.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'greninja.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'sawk.gif') ?>  </td>
		</tr>
		<tr>
			<td> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'manectric.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'gourgeist.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'dragonite.gif') ?>  </td>
		</tr>

		<tr>
			<td> <b class='size_15'> 14. </b>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'aegislash.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'talonflame.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'politoed.gif') ?>  </td>
		</tr>
		<tr>
			<td> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'mawile.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'ludicolo.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'hydreigon.gif') ?>  </td>
		</tr>

		<tr>
			<td> <b class='size_15'> 15.  </b> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'mawile.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'venusaur.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'garchomp.gif') ?>  </td>
		</tr>
		<tr>
			<td> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'raichu.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'talonflame.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'rotom.gif') ?>  </td>
		</tr>

		<tr>
			<td> <b class='size_15'> 16.  </b> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'garchomp.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'staraptor.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'gyarados.gif') ?>  </td>
		</tr>
		<tr>
			<td> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'meowstic.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'manectric.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'aegislash.gif') ?>  </td>
		</tr>

		<tr>
			<td> <b class='size_15'> 17.  </b> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'charizard.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'mienshao.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'scizor.gif') ?>  </td>
		</tr>
		<tr>
			<td> </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'sableye.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'manectric.gif') ?>  </td>
			<td> <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.'lapras.gif') ?>  </td>
		</tr>
	</table>

</div>