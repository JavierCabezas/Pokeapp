<?php
$this->breadcrumbs=array(
	'Jugadores'=>array('/jugadores'),
	'Información TSV',
);
?>

<h2> TSV (Trainer shiny value) </h2>

<?php echo "<img src='".imageDir()."/jugadores_info/jug_002.png' style='float: left; padding: 3px 3px 0px 3px'/>" ?>

<p>
El TSV  es un concepto nuevo en sexta generación que permite la crianza de pokémon shiny con un 100% de certeza. Hago énfasis en que esto es válido única y exclusivamente en 
pokémon nacidos de huevo y no otros obtenidos por cualquier otro método. 
</p>

<p> Ok, eso suena demasiado bueno como para ser verdad, ¿Cómo funciona? </p>

<p> 
Cada entrenador tiene un número único y no modificable de 4 cifras, entre 0 y <u class ="dotted"><span title="2 elevado a 12">4096</span></u>, llamado Trainer Shiny value (algo así como el valor shiny de entrenador). Además cada huevo 
que es creado en el juego tiene un número (Egg shiny value o ESV), también invariante entre 0 y 4096. Es importante mencionar que el ESV se genera al azar al momento de ser creado cada huevo
, es decir, es bastante poco probable que dos huevos tengan el mismo ESV. La gracia de estos números es que <b>si el número de huevo y el número de entrenador coinciden el pokémon 
será shiny con un 100% de probabilidad</b>.
</p>

<p>
Para poder obtener más información al respecto (incluyendo el como obtener el ESV y TSV) puede ser encontrada en <?php echo CHtml::link('reddit', 'http://www.reddit.com/r/SVExchange/wiki/index#btn') ?>. Ojo que el 
contenido está en inglés pero próximamente escribiré una traducción de los textos en este sitio.
</p>

<?php echo CHtml::link('Volver al módulo de jugadores', array('index')) ?>.