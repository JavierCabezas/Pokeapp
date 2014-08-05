<?php if($pokeymans): //If the player has pokémon on the team then show them ?>
    <p> <?php echo count($pokeymans) ?>/6 pokémon. Para ver más detalles, editar o borrar de cualquiera de tus pokémon haz click sobre su nombre. </p>
    </br>
     <?php foreach($pokeymans as $pokeyman): ?>
     <?php isset($pokeyman->idTournamentPokemon)?$pokeyman = $pokeyman->idTournamentPokemon:''; ?>

        <!-- inicio accordeon -->
<div class="accordion-group">
<div class="accordion-heading">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#<?php echo $pokeyman->id ?>">
        <h2>
            <?php echo $pokeyman->idPokemonSpecies->image('moving'); ?>
            <?php echo beautify($pokeyman->pokemonName) ?>
        </h2>
</a>
</div>
<div id="<?php echo $pokeyman->id ?>" class="accordion-body collapse">
    <div class="accordion-inner">

        <p> <?php echo CHtml::link('Haz click aquí para modificar/borrar a '.$pokeyman->pokemonName, array('/torneo/verPokemon/', 'id' =>$pokeyman->id)); ?> </p>
       <?php $this->widget('bootstrap.widgets.TbDetailView',array(
        'data'=>$pokeyman->idPokemonSpecies,
        'attributes'=>array(
            array(
                'name' => 'nickname',
                'value' => $pokeyman->nickname?$pokeyman->nickname:"Ninguno",
            ),
            array(
                'name' => 'Habilidad',
                'value' => beautify($pokeyman->idAbility->abilityName),
            ),
            array(
                'name' => 'Naturaleza',
                'value' => beautify($pokeyman->idNature->natureName),
            ),
            array(
                'name' => 'Item',
                'value' => $pokeyman->idItem?ucfirst($pokeyman->idItem->itemName):"Ninguno",
            ),
            array(
                'name' => 'Nivel',
                'value' => $pokeyman->level,
            ),
            array(
                'name' => 'Movimiento 1',
                'value' => beautify($pokeyman->idMove1->moveName),
            ),
            array(
                'name' => 'Movimiento 2',
                'value' => $pokeyman->idMove2?ucfirst($pokeyman->idMove2->moveName):"Ninguno",
            ),
            array(
                'name' => 'Movimiento 3',
                'value' => $pokeyman->idMove3?ucfirst($pokeyman->idMove3->moveName):"Ninguno",
            ),
            array(
                'name' => 'Movimiento 4',
                'value' => $pokeyman->idMove4?ucfirst($pokeyman->idMove4->moveName):"Ninguno",
            ),
            array(
                'name' => 'Hit points ',
                'value' => $pokeyman->hp,
            ),
            array(
                'name' => 'Attack ',
                'value' => $pokeyman->atk,
            ),
            array(
                'name' => 'Defense ',
                'value' => $pokeyman->def,
            ),
            array(
                'name' => 'Special Attack ',
                'value' => $pokeyman->spa,
            ),
            array(
                'name' => 'Special Defense ',
                'value' => $pokeyman->spd,
            ),
            array(
                'name' => 'Speed ',
                'value' => $pokeyman->spe,
            ),
        ),
        )); ?>
        </div>
    </div>
</div><!-- fin accordeon -->

        
     <?php endforeach; ?>
<?php else: // Caso sin pokémons en equipos ?>
    <p><b> No tienes pokémon registrados en tu equipo</b>. </p>
<?php endif; ?>