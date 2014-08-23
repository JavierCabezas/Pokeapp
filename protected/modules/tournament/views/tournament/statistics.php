<div class="page-header">
	<h1> <?php echo $tournament->name ?> <small> <?php echo $tournament->location ?>, <?php echo $date?> </h1>
</div>

<p> En el <?php echo $tournament->name ?> participaron <b> <?php echo $tournament->numberPlayers ?> </b> personas. </p>

<h2> Pokémon más populares </h2>

<?php echo $this->renderPartial('_top10pokemon', array('pokemon' => $pokemon)); ?>