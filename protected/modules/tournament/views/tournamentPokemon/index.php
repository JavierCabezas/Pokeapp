<?php
$this->breadcrumbs=array(
	'Tournament Pokemons',
);

$this->menu=array(
array('label'=>'Create TournamentPokemon','url'=>array('create')),
array('label'=>'Manage TournamentPokemon','url'=>array('admin')),
);
?>

<h1>Tournament Pokemons</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
