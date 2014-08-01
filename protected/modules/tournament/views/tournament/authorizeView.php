<?php $this->setPageTitle('Pokéapp - Autorizar jugador'); ?>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>

<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Menú administradores'=>array('/torneo/adminMenu'),
	'Autorizar jugadores',
);
?>

<h2> Autorización de jugadores </h2>

<?php
    $this->widget('bootstrap.widgets.TbGridView',
    array(
    	'type'=>'striped bordered condensed',
	    'dataProvider' => $pendingPlayers,
	    'columns' => $pendingPlayersCol,
    	)
    );
?>

