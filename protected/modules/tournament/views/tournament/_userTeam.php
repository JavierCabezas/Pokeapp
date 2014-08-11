<?php if($pokeymans): //If the player has Pokémon on the team then show them ?>
    <p> <?php echo count($pokeymans) ?>/6 Pokémon. Para ver más detalles sobre algún Pokémon en específico haz click sobre su nombre. </p>
    </br>
     <?php foreach($pokeymans as $pokeyman): ?>
     <?php isset($pokeyman->idTournamentPokemon)?$pokeyman = $pokeyman->idTournamentPokemon:''; ?>

        <!-- inicio accordeon -->
<div class="accordion-group">
<div class="accordion-heading">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#<?php echo $pokeyman->id ?>">
        <h2>
            <div class="pkmnimg"><?php echo $pokeyman->idPokemonSpecies->image('moving'); ?></div>
            <p> <?php echo beautify($pokeyman->pokemonName) ?> </p>
        </h2>
</a>
</div>
<div id="<?php echo $pokeyman->id ?>" class="accordion-body collapse">
    <div class="accordion-inner">
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
                    'name' => 'Nivel',
                    'value' => $pokeyman->level,
                ),
            ),
        )); ?>

        <p> &nbsp; </p>
        <p class="click"> <?php echo CHtml::link('Detalles de '.$pokeyman->pokemonName, array('/torneo/verPokemon/', 'id' =>$pokeyman->id)); ?> </p>

        </div>
    </div>
</div><!-- fin accordeon -->

        
     <?php endforeach; ?>
<?php else: // Caso sin Pokémons en equipos ?>
    <p><b> No tienes Pokémon registrados en tu equipo</b>. </p>
<?php endif; ?>