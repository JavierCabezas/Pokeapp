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

<h1>Buscador de jugadores</h1>

<p> 
	Puedes buscar jugadores bajo distintos parámetros filtrándolos. Para ello ingresa el filtro que estés buscando en los cuadritos de más abajo y luego presiona la tecla enter. 
</p>

<p>	
	Luego, para ver la información de algún jugador que te llame la atención puedes hacer click en el símbolo del ojo y verás más detalles.
</p>

<?php 
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'player-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' 	=> 'search_nickname',
			'value' => '$data->nickname',
		),
		array(
			'name' 	=> 'search_safari', 
			'value' => 'isset($data->id_safari_type)?$data->idSafariType->typeName:"No asignado"',
		),
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