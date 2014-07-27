<?php
$this->breadcrumbs=array(
	'Pokemon Search Criterias',
);

$this->menu=array(
array('label'=>'Create PokemonSearchCriteria','url'=>array('create')),
array('label'=>'Manage PokemonSearchCriteria','url'=>array('admin')),
);
?>

<h1>Pokemon Search Criterias</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>


<?php PokemonSearchCriteria::model()->ini(); ?>