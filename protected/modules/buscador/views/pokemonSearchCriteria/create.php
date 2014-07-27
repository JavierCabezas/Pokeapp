<?php
$this->breadcrumbs=array(
	'Pokemon Search Criterias'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List PokemonSearchCriteria','url'=>array('index')),
array('label'=>'Manage PokemonSearchCriteria','url'=>array('admin')),
);
?>

<h1>Create PokemonSearchCriteria</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>