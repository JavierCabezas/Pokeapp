<?php
$this->breadcrumbs=array(
	'Tournament Players',
);

$this->menu=array(
array('label'=>'Create TournamentPlayer','url'=>array('create')),
array('label'=>'Manage TournamentPlayer','url'=>array('admin')),
);
?>

<h1>Tournament Players</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
