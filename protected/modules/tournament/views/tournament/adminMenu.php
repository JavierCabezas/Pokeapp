<?php $this->setPageTitle('Pokéapp - Sección de administrador'); ?>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>

<h2> Menú de administración </h2>

<p> Opciones </p>

<p> 
	Para el <?php echo $tournament_name ?> existen <b><?php echo $finished_players.'/'.$total_players ?></b> jugadores que han terminado su trámite. 
</p>

<ul>
	<li> <?php echo CHtml::link('Autorizar fotos de folio de jugadores', array('/torneo/vistaAutorizar')) ?> </li>
	<li> <?php echo CHtml::link('Ver equipo de jugadores', array('/torneo/verEquipoJugador')) ?> </li>
</ul>
