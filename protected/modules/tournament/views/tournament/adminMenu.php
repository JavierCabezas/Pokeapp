<?php $this->setPageTitle('Pokéapp - Sección de administrador'); ?>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>

<h2> Menú de administración </h2>

<p> Opciones </p>

<p> 
	Para el <?php echo $tournament_name ?> existen <b><?php echo $finished_players + $almost_finished_players.'/'.$total_players ?></b> jugadores que han agregado pokémon. 
	De esos <?php echo $finished_players ?> tienen su team entero y <?php echo $almost_finished_players ?> tienen elegidos pokémon pero no a los 6.
</p>

<ul>
	<li> <?php echo CHtml::link('Autorizar fotos de folio de jugadores', array('/torneo/vistaAutorizar')) ?> </li>
	<li> <?php echo CHtml::link('Ver equipo de jugadores', array('/torneo/verEquipoJugador')) ?> </li>
	<li> <?php echo CHtml::link('Ver resumen de estado de jugadores', array('/torneo/resumenTorneo')) ?> </li>
</ul>
