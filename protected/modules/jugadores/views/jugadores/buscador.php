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

<?php $this->setPageTitle('Pokéapp - Buscador de jugadores.'); ?>

<h1 class="buscarpj">Buscar jugadores</h1>

<div class="infosec">
	<p>En esta sección puedes buscar jugadores según los parámetros que se especifican más abajo. Para ello escribe lo que estés buscando en los cuadritos de más abajo y luego presiona la tecla enter o busca en los menús desplegables. 
	Una vez que encontraste a alguien que te llame la atención puedes hacer click en el símbolo de la lupa y verás más detalles.</p>
	<p>Si estás buscando un Pokémon de safari en específico puedes ver a <?php echo CHtml::link('nuestro artículo de Pokémon safari', array('safari')) ?> para ver en que slot se guarda cada uno de ellos.</p>
</div>

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
			'value' => 'isset($data->id_safari_type)?$data->idSafariType->typeName:"-"',
		),
		array(
			'name' 	=> 'search_poke_1', 
			'value' => 'isset($data->id_safari_type)?$data->safariSlot1->pokemonName:"-"',
		),
		array(
			'name' 	=> 'search_poke_2', 
			'value' => 'isset($data->id_safari_type)?$data->safariSlot2->pokemonName:"-"',
		),
		array(
			'name' 	=> 'search_poke_3', 
			'value' => 'isset($data->id_safari_type)?$data->safariSlot3->pokemonName:"-"',
		),
		//array('name' => 'search_tsv','value' => '$data->tsv?$data->tsv:"-"'),
		array(
			'name' => 'search_duel_single',
			'filter'	=> array(0 => 'No', 1 => 'Sí'),
			'value' => '($data->duel_single == 0)?"No":"Sí";'
		),
		array(
			'name' => 'search_duel_doble',
			'filter'	=> array(0 => 'No', 1 => 'Sí'),
			'value' => '($data->duel_doble == 0)?"No":"Sí";'
		),
		array(
			'name' => 'search_duel_triple',
			'filter'	=> array(0 => 'No', 1 => 'Sí'),
			'value' => '($data->duel_triple == 0)?"No":"Sí";'
		),
		array(
			'name' => 'search_duel_rotation',
			'filter'	=> array(0 => 'No', 1 => 'Sí'),
			'value' => '($data->duel_rotation == 0)?"No":"Sí";'
		),
		array(
			'class'=>'zii.widgets.grid.ButtonColumn',
			'template'=>'{view}',
			'evaluateID'=>true,
			'buttons' => array(
				'view' => array(
					'url' => null,
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
		event.preventDefault();
		id = event.currentTarget.id;
		$.ajax({
               'type':'POST', 
               'url' : "<?php echo Yii::app()->createUrl('jugadores/jugadores/showPlayerInfo') ?>",
                       'dataType': 'html',
                        data:  {id: id },
                'success': function(data){
                    $('#result').html(data);
                }
        });
		$( "#result" ).scroll();
	});


</script>