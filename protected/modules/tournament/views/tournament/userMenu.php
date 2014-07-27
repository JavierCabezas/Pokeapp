<?php $this->setPageTitle('Pokéapp - Inscripción de pokémon para torneos'); ?>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>

<h1> Menú de usuario </h1>

<p> Aquí puedes organizar a tu equipo pokémon para algún torneo en específico. </p>
<p> &nbsp; </p>

<div id="column1-wrap">
    <div id="column1">
		<?php if(!is_null($next_tournament)): ?>
			<h2> Mis pokémon para el <?php echo $next_tournament ?> </h2>

			<?php $this->renderPartial('_userTeam', array(
				'pokeymans' => $user_tournament_pokemon
			)); ?>

		<?php endif; ?>

		<!-- Aquí podría ir un separador o algo así -->
		<div class='clear'> &nbsp; </div>
		<?php if(!is_null($next_tournament)): ?>
			<h2> Todos mis pokémon </h2>

			<?php $this->renderPartial('_userTeam', array(
				'pokeymans' => $user_pokemon
			)); ?>

		<?php endif; ?>
	</div>
</div>

<div id="column2">
	<h2> Acciones de usuario </h2>

	<p> <?php echo CHtml::link('Agregar un pokémon al equipo', array('/torneo/agregarPokemon')) ?>. </p>
	<p> <?php echo CHtml::link('Agregar o quitar pokémon para un torneo en específico', array('/torneo/pokemonTorneo')) ?>. </p>
	<p> <?php echo CHtml::link('Borrar o modificar pokémon', array('/torneo/modificarPokemon')) ?>. </p>
</div>
