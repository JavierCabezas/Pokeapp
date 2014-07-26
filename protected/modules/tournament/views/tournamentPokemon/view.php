<?php
$this->breadcrumbs=array(
	'Tournament Pokemons'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List TournamentPokemon','url'=>array('index')),
array('label'=>'Create TournamentPokemon','url'=>array('create')),
array('label'=>'Update TournamentPokemon','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete TournamentPokemon','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage TournamentPokemon','url'=>array('admin')),
);
?>

<h1>View TournamentPokemon #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'id_tournament_player',
		'id_pokemon_species',
		'nickname',
		'id_ability',
		'id_nature',
		'id_item',
		'id_move1',
		'id_move2',
		'id_move3',
		'id_move4',
		'level',
		'hp',
		'atk',
		'def',
		'spa',
		'spd',
		'spe',
),
)); ?>
