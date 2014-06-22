<h1 class="jugadores">Jugadores</h1>

<nav>
	<ul>
		<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/pj_nav/n_pj_01.png" width="210" height="100" />',  Yii::app()->createurl('jugadores/create'))?> </li>
		<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/pj_nav/n_pj_02.png" width="210" height="100" />',  Yii::app()->createurl('jugadores/buscador'))?> </li>
		<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/pj_nav/n_pj_03.png" width="210" height="100" />',  Yii::app()->createurl('jugadores/nuevoCodigo'))?> </li>
		<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/pj_nav/n_pj_04.png" width="210" height="100" />',  Yii::app()->createurl('jugadores/updateForm'))?> </li>
	</ul>
</nav>

<div class="infosec">
	<p>En esta sección pueden buscar a otros jugadores del juego con intereses similares, con un pokémon en específico del Friend Safari (Safari Amigo) o simplemente conocer gente nueva.</p>
	<p>Los parámetros actuales que se están guardando en el módulo hasta la fecha son:</p>
	<div class="param">
		<img src='<?php echo imageDir()?>/articulos/003.png' />
		<h4>Pokémon Safari</h4>
		<p>Explicación bonita de pokémon safari</p>
	</div>
	<div class="param">
		<img src='<?php echo imageDir()?>/articulos/003.png' />
		<h4>TSV</h4>
		<p>Explicación bonita de TSV</p>
	</div>
	<div class="param">
		<img src='<?php echo imageDir()?>/articulos/003.png' />
		<h4>Interés en duelos</h4>
		<p>(separados por tipo de duelo y tier).</p>
	</div>
</div>