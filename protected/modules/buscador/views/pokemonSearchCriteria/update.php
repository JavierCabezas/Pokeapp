<?php
$this->breadcrumbs=array(
	'Pokemon Search Criterias'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List PokemonSearchCriteria','url'=>array('index')),
	array('label'=>'Create PokemonSearchCriteria','url'=>array('create')),
	array('label'=>'View PokemonSearchCriteria','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage PokemonSearchCriteria','url'=>array('admin')),
	);
	?>

	<h1>Update PokemonSearchCriteria <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>