<?php $this->setPageTitle('Pokéapp - Ver equipo del jugador'); ?>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>

<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Menú administradores'=>array('/torneo/adminMenu'),
	'Ver equipo de jugador',
);
?>

<h1> Ver equipo de jugador </h1>

