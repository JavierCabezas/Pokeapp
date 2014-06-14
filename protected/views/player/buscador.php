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
	'type' => 'striped',
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
		array(
			'name' => 'search_tsv',
			'value' => '$data->tsv'
		),
		array(
			'name' => 'search_duel_single',
			'value' => '($data->duel_single == 0)?"No":"Sí";'
		),
		array(
			'name' => 'search_duel_doble',
			'value' => '($data->duel_doble == 0)?"No":"Sí";'
		),
		array(
			'name' => 'search_duel_triple',
			'value' => '($data->duel_triple == 0)?"No":"Sí";'
		),
		array(
			'name' => 'search_duel_rotation',
			'value' => '($data->duel_rotation == 0)?"No":"Sí";'
		),
		array(
			'class'=>'zii.widgets.grid.ButtonColumn',
			'template'=>'{view}',
			'evaluateID'=>true,
			'viewButtonUrl'=>null,
			'buttons' => array(
				'view' => array(
                	'options'=>array(
                		'id'	=> '$data->id',
                		'class' => 'view_button',
            		),
				),
			),
		),
	),
)); 
?>

<div id="result">
	
</div>


<script type='text/javascript'>
	jQuery('.view_button').live('click',function(event) {
		id = event.currentTarget.id;
		$.ajax({
               'type':'POST', 
               'url' : "<?php echo Yii::app()->createUrl('Player/showPlayerInfo') ?>",
                       'dataType': 'html',
                        data:  {id: id },
                'success': function(data){
                    $('#result').html(data);
                }
        });
	});
</script>