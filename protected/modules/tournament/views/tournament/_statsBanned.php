<!-- inicio accordeon -->
<div class="accordion-group">
	<div class="accordion-heading">
		<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#banned_stuff">
		        <p> Haz click aquí para ver en detalle las restricciones del torneo. </p>
		</a>
	</div>

	<div id="banned_stuff" class="accordion-body collapse">
	    <div class="accordion-inner">
		   	<div class="container">
		   		<div class="column-center">
					<h4> Pokémon prohibidos </h4>
					<?php if(!empty($banned_pokemon)): ?>
						<ul>
						<?php foreach($banned_pokemon as $pokemon): ?>
							<li> <?php echo $pokemon->idPokemon->pokemonName ?> </li>
						<?php endforeach ?>
						</ul>
					<?php else: ?>
						<p> No hay pokémon prohibidos según las reglas del torneo. </p>
					<?php endif; ?>
		   		</div>
			   	<div class="column-left">
			   		<h4> Items prohibidos </h4>
					<?php if(!empty($banned_items)): ?>
						<ul>
						<?php foreach($banned_items as $item): ?>
							<li> <?php echo $item->idItem->itemName ?> </li>
						<?php endforeach ?>
						</ul>
					<?php else: ?>
						<p> No hay objetos prohibidos según las reglas del torneo. </p>
					<?php endif; ?>
			   	</div>
			   	<div class="column-right">
			   		<h4> Movimientos prohibidos </h4>
					<?php if(!empty($banned_moves)): ?>
						<ul>
						<?php foreach($banned_moves as $move): ?>
							<li> <?php echo $move->idMove->moveName ?> </li>
						<?php endforeach ?>
						</ul>
					<?php else: ?>
						<p> No hay movimientos prohibidos según las reglas del torneo. </p>
					<?php endif; ?>
			   	</div>
			</div>
	    </div>
	</div>
</div><!-- fin accordeon -->