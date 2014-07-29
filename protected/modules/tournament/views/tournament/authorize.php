<?php $this->setPageTitle('Pokéapp - Sección de administrador'); ?>

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

