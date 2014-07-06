<h1 class="jugadores">Jugadores</h1>

<nav>
	<ul>
		<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/pj_nav/n_pj_01.png" width="210" height="100" />',  Yii::app()->createurl('jugadores/jugadores/create'))?> </li>
		<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/pj_nav/n_pj_02.png" width="210" height="100" />',  Yii::app()->createurl('jugadores/jugadores/buscador'))?> </li>
		<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/pj_nav/n_pj_03.png" width="210" height="100" />',  Yii::app()->createurl('jugadores/jugadores/nuevo_codigo'))?> </li>
		<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/pj_nav/n_pj_04.png" width="210" height="100" />',  Yii::app()->createurl('jugadores/jugadores/updateForm'))?> </li>
	</ul>
</nav>

<div class="infosec">
	<p>En esta sección pueden buscar a otros jugadores del juego con intereses similares, con un pokémon en específico del Friend Safari (Safari Amigo) o simplemente conocer gente nueva.</p>
	<p>Los parámetros actuales que se están guardando en el módulo hasta la fecha son:</p>
	<div class="param">
		<?php echo CHtml::link("<img src='".imageDir()."/jugadores_info/jug_001.png' />", array('')) ?>
		<?php echo CHtml::link('<h4>Pokémon Safari</h4>', array(''))?>
		<p>Tipo y especie de Pokémon que da el usuario por medio de su Friend Code.</p>
	</div>
	<div class="param">
		<?php echo CHtml::link("<img src='".imageDir()."/jugadores_info/jug_002.png' />", array('')) ?>
		<?php echo CHtml::link('<h4>Trainer Shiny Value</h4>', array('')) ?>
		<p> Busca jugadores que te puedan asegurar huevos shiny por medio del TSV (Trainer shiny value).</p>
	</div>
	<div class="param">
		<?php echo CHtml::link("<img src='".imageDir()."/jugadores_info/jug_003.png' />", array('')) ?>
		<?php echo CHtml::link('<h4>Interés en duelos</h4>', array(''))?>
		<p>Puedes buscar jugadores no solo por tipo de duelo (single, doble, triple o rotación) sino que también por Tiers.</p>
	</div>

	<p> Para ver más información acerca de cualquiera de estas temáticas haz click en la imagen destacada de esta. </p>
</div>