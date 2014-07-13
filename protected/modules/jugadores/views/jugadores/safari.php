<nav>
	<ul>
		<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/pj_nav/n_pj_01.png" width="210" height="100" />',  Yii::app()->createurl('jugadores/jugadores/create'))?> </li>
		<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/pj_nav/n_pj_02.png" width="210" height="100" />',  Yii::app()->createurl('jugadores/jugadores/buscador'))?> </li>
		<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/pj_nav/n_pj_03.png" width="210" height="100" />',  Yii::app()->createurl('jugadores/jugadores/nuevo_codigo'))?> </li>
		<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/pj_nav/n_pj_04.png" width="210" height="100" />',  Yii::app()->createurl('jugadores/jugadores/updateForm'))?> </li>
	</ul>
</nav>

<h2> Friend Safai (Safari amigo) </h2>

<?php echo "<img src='".imageDir()."/jugadores_info/jug_001.png' style='float: left; padding: 3px 3px 0px 3px'/>" ?>

<p>
El safari amigo es una característica nueva de sexta generación que permite, una vez finalizada la liga pokémon, la captura de diversos pokémon salvajes de nivel 30. 
La gracia del lugar es que los pokémon que aquí aparecen tienen al menos 2 IVs en 31 y tienen la posibilidad de tener habilidad oculta.
</p>

<p> 
Funciona de la siguiente manera: al tener a otros jugadores agregados (de forma mutua) como amigos en tu 3DS puedes tener acceso al Safari de esta persona, siendo un safari un 
conjunto de tres pokémon distintos del mismo tipo disponibles para capturar. El tipo de cada uno de los safaris y los pokémon que salen en cada uno de ellos son elegidos al azar
desde un conjunto fijo de pokémon. Además estos pokémon están separados en tres ranuras con opciones fijas de pokémon. Por ejemplo la primera ranura del 
tipo hada tiene los pokémon Togepi, Snubull, Kirlia y Dendenne. Esto quiere decir que alguien que tenga tipo Fairy está obligado a tener uno, y sólo uno, 
de estos 4 pokémon en la primera ranura de su safari.
</p>


Para ver más información de que pokémon hay por cada ranura haz click en el tipo en la lista de más abajo:

<div class="accordion-group">
	<?php foreach($types as $type): ?>
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#<?php echo $type->identifier ?>">
				<p> <?php echo $type->typeName ?> </p>
			</a>
		</div>
		<div id="<?php echo $type->identifier ?>" class="accordion-body collapse">
			<div class="accordion-inner">
				<?php 
				    $this->widget('bootstrap.widgets.TbExtendedGridView', array(
				    	'sortableRows'=>false,
				    	'type'=>'striped bordered',
				    	'dataProvider' => $data_providers[$type->identifier],
				    	'template' => "{items}",
				   		'columns' => $gridColumns,
				    ));
				?>
			</div>
		</div>
	<?php endforeach; ?>
</div>



<p>
Para esto mismo el <?php echo CHtml::link('buscador de jugadores', array('buscador')) ?> puede ser bastante útil
</p>

<?php echo CHtml::link('Volver al módulo de jugadores', array('index')) ?>.