<?php
$this->breadcrumbs=array(
	'Jugadores'=>array('/jugadores'),
	'Información de duelos',
);
?>

<div class='well'>
	<h1> Duelos Pokémon </h1>

	<?php echo "<img src='".imageDir()."/jugadores_info/jug_003.png' style='float: left; padding: 3px 3px 0px 3px'/>" ?>

	<p>
	Una de las cosas que más mueven al juego Pokémon, al menos en mi opinión, es la posibilidad de hacer duelos con otros jugadores. Dada la variedad que tiene Pokémon 
	(sobre todo con los Pokémon que se han ido introduciendo en las últimas generaciones) se pueden de realizar una cantidad increíble de equipos bastante entretenidos
	para realizar distintas estrategias. 
	</p>

	<p>
	Dado que los Pokémon distintos tienen distintas capacidades, teniendo unos mejores stats que otros (<?php echo CHtml::link('lo cual no es una opinión', 'http://bulbapedia.bulbagarden.net/wiki/List_of_fully_evolved_Pokémon_by_base_stats') ?>).
	Por esto mismo existe una organización de jugadores, llamada Smogon, que junta a los Pokémon en grupos y pone reglamentos en el juego con el fin de que los duelos estén relativamente balanceados, de tal forma
	de que no se tenga peleando a un Mega Mewtwo contra un Delibird. Pueden encontrar una lista de las tiers que se están usando <?php echo CHtml::link('en la pokédex oficial de smogon', 'http://www.smogon.com/dex/xy/pokemon/') ?>.
	</p>

	<p>
	En el buscador de jugadores es posible especificar el interés de los tipos de duelos existentes en Pokémon (singles, dobles, triples o rotación) y también se da la
	posibilidad de poner (de forma opcional) una tier para especificar mejor la información. En caso de que quieras detallar aún más puedes hacerlo en la sección de "otros".
	</p>
</div>
<?php echo CHtml::link('Volver al módulo de jugadores', array('index')) ?>.