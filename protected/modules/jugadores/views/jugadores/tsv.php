<?php
$this->breadcrumbs=array(
	'Jugadores'=>array('/jugadores'),
	'Información TSV',
);
?>

<h2> TSV (Trainer shiny value) </h2>

<?php echo "<img src='".imageDir()."/jugadores_info/jug_002.png' style='float: left; padding: 3px 3px 0px 3px'/>" ?>

<p>
El TSV  es un concepto nuevo en sexta generación que permite la crianza de pokémon shiny con un 100% de certeza. Esto es válido única y exclusivamente en 
pokémon nacidos de huevo y no otros obtenidos por cualquier otro método. 
</p>

<p> Ok, eso suena demasiado bueno como para ser verdad, ¿Cómo funciona? </p>

<p> 
Cada entrenador tiene un número único y no modificable de 4 cifras, estas entre 0 y <u class ="dotted"><span title="2 a la doceava potencia =)">4096</span></u>, llamado Trainer Shiny value 
(algo así como el valor shiny de entrenador). Además cada huevo que es creado en el juego tiene OTRO número (Egg shiny value o ESV), también entre 0 y 4096. Es importante mencionar que el 
ESV se genera al azar al momento de ser creado cada huevo, es decir, por cada huevo que se genere se generará un número de estos. 
La gracia de estos números es que <b>si el número de huevo y el número de entrenador coinciden el pokémon será shiny con un 100% de probabilidad</b>.
</p>

<p>
Para poder obtener más información al respecto (incluyendo el como obtener el ESV y TSV) puede ser encontrada en <?php echo CHtml::link('reddit', 'http://www.reddit.com/r/SVExchange/wiki/index#btn') ?>. Ojo que el 
contenido está en inglés pero próximamente escribiré una traducción de los textos en este sitio. Además, prometo darme el tiempo de probar alguna de las herramientas disponibles y 
de hacer un review en <?php echo CHtml::link('Pokédaisuki', 'http://www.pokedaisuki.cl') ?>.
</p>

<?php echo CHtml::link('Volver al módulo de jugadores', array('index')) ?>.