<?php
$this->breadcrumbs=array(
	'Tournament Pokemons'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List TournamentPokemon','url'=>array('index')),
	array('label'=>'Create TournamentPokemon','url'=>array('create')),
	array('label'=>'View TournamentPokemon','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage TournamentPokemon','url'=>array('admin')),
	);
	?>

	<h1>Update TournamentPokemon <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>