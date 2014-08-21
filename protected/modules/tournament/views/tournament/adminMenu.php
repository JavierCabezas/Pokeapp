<?php $this->setPageTitle('Pokéapp - Sección de administrador'); ?>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>

<h2> Menú de administración </h2>

<p> Opciones </p>

<p> 
	Para el <?php echo $tournament_name ?> existen: 
	<ul>
		<li> <b><?php echo $registered_players.'/'.$total_players ?></b> jugadores que han confirmado su folio. </li>
		<li> <b><?php echo $finished_players + $between_one_and_four + $exactly_four + $other.'/'.$total_players ?></b> jugadores que han agregado pokémon. </li>
		<li> <b><?php echo $zero ?></b> tienen folio aprobado y no han agregado pokémon. </li>
		<li> <b><?php echo $between_one_and_four ?></b> tienen elegidos entre 1 y 4 pokémon. </li>
		<li> <b><?php echo $finished_players ?></b> tienen su team entero. </li>
		<li> <b><?php echo $exactly_four ?></b> tienen elegidos exactamente a 4 pokémon. </li>
	</ul>
</p>

<ul>
	<li> <?php echo CHtml::link('Autorizar fotos de folio de jugadores', array('/torneo/vistaAutorizar')) ?> </li>
	<li> <?php echo CHtml::link('Ver equipo de jugadores', array('/torneo/verEquipoJugador')) ?> </li>
	<li> <?php echo CHtml::link('Ver resumen de estado de jugadores', array('/torneo/resumenTorneo')) ?> </li>
</ul>
