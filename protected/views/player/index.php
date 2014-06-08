<?php
$this->breadcrumbs=array(
	'Players',
);
?>

<h1>Jugadores</h1>

<?php 
$this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
