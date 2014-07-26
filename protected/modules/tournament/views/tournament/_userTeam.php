<?php if($pokeymans): //Si tiene pokémon en el equipo desplegarlos ?>
    <p> <?php echo count($pokeymans) ?> pokémon. Para ver más detalle de cualquiera de tus pokémon haz click sobre su nombre. </p>
    </br>
     <?php foreach($pokeymans as $pokeyman): ?>


        <!-- inicio accordeon -->
<div class="accordion-group">
<div class="accordion-heading">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#<?php echo $pokeyman->id ?>">
        <h2>
            <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.$pokeyman->idTournamentPokemon->idPokemonSpecies->identifier.'.gif'); ?>
            <?php echo beautify($pokeyman->idTournamentPokemon->idPokemonSpecies->identifier) ?>
            <?php echo $pokeyman->idTournamentPokemon->nickname? '('.$pokeyman->idTournamentPokemon->nickname.')': '' ?>
        </h2>
</a>
</div>
<div id="<?php echo $pokeyman->id ?>" class="accordion-body collapse">
    <div class="accordion-inner">
       <?php $this->widget('bootstrap.widgets.TbDetailView',array(
        'data'=>$pokeyman->idTournamentPokemon->idPokemonSpecies,
        'attributes'=>array(
            array(
                'name' => 'nickname',
                'value' => $pokeyman->idTournamentPokemon->nickname?$pokeyman->idTournamentPokemon->nickname:"Ninguno",
            ),
            array(
                'name' => 'Habilidad',
                'value' => beautify($pokeyman->idTournamentPokemon->idAbility->abilityName),
            ),
            array(
                'name' => 'Naturaleza',
                'value' => beautify($pokeyman->idTournamentPokemon->idNature->natureName),
            ),
            array(
                'name' => 'Item',
                'value' => $pokeyman->idTournamentPokemon->idItem?ucfirst($pokeyman->idTournamentPokemon->idItem->itemName):"Ninguno",
            ),
            array(
                'name' => 'Nivel',
                'value' => $pokeyman->idTournamentPokemon->level,
            ),
            array(
                'name' => 'Movimiento 1',
                'value' => beautify($pokeyman->idTournamentPokemon->idMove1->moveName),
            ),
            array(
                'name' => 'Movimiento 2',
                'value' => $pokeyman->idTournamentPokemon->idMove2?ucfirst($pokeyman->idTournamentPokemon->idMove2->moveName):"Ninguno",
            ),
            array(
                'name' => 'Movimiento 3',
                'value' => $pokeyman->idTournamentPokemon->idMove3?ucfirst($pokeyman->idTournamentPokemon->idMove3->moveName):"Ninguno",
            ),
            array(
                'name' => 'Movimiento 4',
                'value' => $pokeyman->idTournamentPokemon->idMove4?ucfirst($pokeyman->idTournamentPokemon->idMove4->moveName):"Ninguno",
            ),
            array(
                'name' => 'Hit points ',
                'value' => $pokeyman->idTournamentPokemon->hp,
            ),
            array(
                'name' => 'Attack ',
                'value' => $pokeyman->idTournamentPokemon->atk,
            ),
            array(
                'name' => 'Defense ',
                'value' => $pokeyman->idTournamentPokemon->def,
            ),
            array(
                'name' => 'Special Attack ',
                'value' => $pokeyman->idTournamentPokemon->spa,
            ),
            array(
                'name' => 'Special Defense ',
                'value' => $pokeyman->idTournamentPokemon->spd,
            ),
            array(
                'name' => 'Speed ',
                'value' => $pokeyman->idTournamentPokemon->spe,
            ),
        ),
        )); ?>
        </div>
    </div>
</div><!-- fin accordeon -->

        
     <?php endforeach; ?>
<?php else: // Caso sin pokémons en equipos ?>

    <p><b> El jugador no tiene pokémon registrados en su equipo </b>. </p>
<?php endif; ?>