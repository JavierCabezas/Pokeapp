<h1 class="jugadores">Jugadores</h1>

<nav>
	<ul>
		<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/pj_nav/n_pj_01.png" width="210" height="100" />',  Yii::app()->createurl('jugadores/jugadores/create'))?> </li>
		<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/pj_nav/n_pj_02.png" width="210" height="100" />',  Yii::app()->createurl('jugadores/jugadores/buscador'))?> </li>
		<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/pj_nav/n_pj_03.png" width="210" height="100" />',  Yii::app()->createurl('jugadores/jugadores/resetearClave'))?> </li>
		<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/pj_nav/n_pj_04.png" width="210" height="100" />',  Yii::app()->createurl('jugadores/jugadores/updateForm'))?> </li>
	</ul>
</nav>

<div class="infosec">
	<p>Esta sección fue pensada para poder crear tu perfil con tus intereses de juego y además el poder buscar el de otros jugadores. Puedes buscar jugadores bajo los siguientes parámetros:</p>
	
	<div class="param">
		<?php echo CHtml::link("<img src='".imageDir()."/jugadores_info/jug_001.png' />", array('safari')) ?>
		<div class="info">
			<?php echo CHtml::link('<h4>Pokémon Safari</h4>', array('safari'))?>
			<p>Tipo y especie de Pokémon que da el usuario por medio de su Friend Code.</p>
		</div>
	</div>
	<div class="param">
		<?php echo CHtml::link("<img src='".imageDir()."/jugadores_info/jug_002.png' />", array('tsv')) ?>
		<div class="info">
			<?php echo CHtml::link('<h4>Trainer Shiny Value</h4>', array('tsv')) ?>
			<p>Busca jugadores que te puedan asegurar huevos shiny por medio del TSV (Trainer shiny value).</p>
		</div>
	</div>
	<div class="param">
		<?php echo CHtml::link("<img src='".imageDir()."/jugadores_info/jug_003.png' />", array('duelos')) ?>
		<div class="info">
			<?php echo CHtml::link('<h4>Interés en duelos</h4>', array('duelos'))?>
			<p>Busca jugadores no sólo por preferencia de tipo de duelo (single, doble, triple o rotación) sino que también por Tiers.</p>
		</div>
	</div>

	<p style="clear:both"> Para ver más información acerca de cualquiera de estas temáticas haz click en la imagen destacada de esta. </p>
</div>