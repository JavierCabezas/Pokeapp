<?php $this->setPageTitle('Pokéapp - Sección de administrador'); ?>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>

<h2> Menú de administración </h2>

<p> Opciones </p>

<ul>
	<li> <?php echo CHtml::link('Autorizar fotos de folio de jugadores', array('/torneo/autorizar')) ?> </li>
	<li> <?php echo CHtml::link('Ver equipo de jugadores', array('/torneo/verEquipoJugador')) ?> </li>
</ul>
