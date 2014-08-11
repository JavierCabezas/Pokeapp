<?php $this->setPageTitle('Pokéapp - Inscripción de Pokémon para torneos'); ?>

<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Menú de usuario',
);
?>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>

<h1 class="usuario"> Menú de usuario </h1>

<div id="column1-wrap">
    <div id="column1">
		<?php if(!is_null($next_tournament)): ?>
			<h2> Mis Pokémon para el <?php echo $next_tournament ?> </h2>

			<?php $this->renderPartial('_userTeam', array(
				'pokeymans' => $user_tournament_pokemon
			)); ?>

		<?php endif; ?>

		<!-- Aquí podría ir un separador o algo así -->
		 <div class='clear'> &nbsp; </div> 
		<?php if(!is_null($next_tournament)&&(false)): //TODO: Check later?>
			<h2> Todos mis Pokémon </h2>

			<?php $this->renderPartial('_userTeam', array(
				'pokeymans' => $user_pokemon
			)); ?>

		<?php endif; ?>
	</div>
</div>

<div id="column2">
	<h2> Acciones de usuario </h2>

	<h4> Equipo Pokémon </h4>
	<p> <?php echo CHtml::link('Agregar un Pokémon al equipo', array('/torneo/agregarPokemon')) ?> </p>
	<!-- TODO: Check later <p> <?php //echo CHtml::link('Agregar o quitar Pokémon para un torneo en específico', array('/torneo/pokemonTorneo')) ?>. </p> -->
	<p> <?php echo CHtml::link('Borrar o modificar Pokémon', array('/torneo/modificarPokemon')) ?> </p>

	<h4> Torneo </h4>
	<p> <?php echo CHtml::link('Ver estado de mi inscripción online', array('/torneo/estadoInscripcion')); ?> </p>
</div>
