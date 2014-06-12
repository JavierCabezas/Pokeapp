<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('player-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Buscar jugadores</h1>

<?php 
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'player-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'nickname',
		'name',
		'id_safari_type',
		'tsv',
		'duel_single',
		'duel_doble',
		'duel_triple',
		'duel_rotation',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view}',
		),
	),
)); 
?>
