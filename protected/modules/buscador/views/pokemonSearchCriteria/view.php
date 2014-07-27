<?php
$this->breadcrumbs=array(
	'Pokemon Search Criterias'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List PokemonSearchCriteria','url'=>array('index')),
array('label'=>'Create PokemonSearchCriteria','url'=>array('create')),
array('label'=>'Update PokemonSearchCriteria','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete PokemonSearchCriteria','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage PokemonSearchCriteria','url'=>array('admin')),
);
?>

<h1>View PokemonSearchCriteria #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'id_pokemon',
		'haircut',
		'clothes',
		'weird_sex',
		'object',
		'cute',
		'animal',
		'myth',
		'moustache',
		'hurr',
		'rough',
		'fluffy',
),
)); ?>
