<nav>
	<ul>
		<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/pj_nav/n_pj_01.png" width="210" height="100" />',  Yii::app()->createurl('jugadores/jugadores/create'))?> </li>
		<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/pj_nav/n_pj_02.png" width="210" height="100" />',  Yii::app()->createurl('jugadores/jugadores/buscador'))?> </li>
		<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/pj_nav/n_pj_03.png" width="210" height="100" />',  Yii::app()->createurl('jugadores/jugadores/nuevo_codigo'))?> </li>
		<li><?php echo CHtml::link('<img src="'.Yii::app()->request->baseUrl.'/images/pj_nav/n_pj_04.png" width="210" height="100" />',  Yii::app()->createurl('jugadores/jugadores/updateForm'))?> </li>
	</ul>
</nav>

<h2> Duelos pokémon </h2>

<?php echo "<img src='".imageDir()."/jugadores_info/jug_003.png' style='float: left; padding: 3px 3px 0px 3px'/>" ?>

<p>
Una de las cosas que más mueven al juego pokémon, al menos en mi opinión, es la posibilidad de hacer duelos con otros jugadores. Dada la variedad que tiene pokémon 
(sobre todo con los pokémon que se han ido introduciendo en las últimas generaciones) se pueden de realizar una cantidad increíble de equipos bastante entretenidos
para realizar distintas estrategias. 
</p>

<p>
Dado que los pokémon distintos tienen distintas capacidades, teniendo unos mejores stats que otros (<?php echo CHtml::link('lo cual no es una opinión', 'http://bulbapedia.bulbagarden.net/wiki/List_of_fully_evolved_Pokémon_by_base_stats') ?>).
Por esto mismo existe una organización de jugadores, llamada Smogon, que junta a los pokémon en grupos y pone reglamentos en el juego con el fin de que los duelos estén relativamente balanceados, de tal forma
de que no se tenga peleando a un Mega Mewtwo contra un Delibird. Pueden encontrar una lista de las tiers que se están usando <?php echo CHtml::link('en la pokédex oficial de smogon', 'http://www.smogon.com/dex/xy/pokemon/') ?>.
</p>

<p>
En el buscador de jugadores es posible especificar el interés de los tipos de duelos existentes en pokémon (singles, dobles, triples o rotación) y también se da la
posibilidad de poner (de forma opcional) una tier para especificar mejor la información. En caso de que quieras detallar aún más puedes hacerlo en la sección de "otros".
</p>

<?php echo CHtml::link('Volver al módulo de jugadores', array('index')) ?>.