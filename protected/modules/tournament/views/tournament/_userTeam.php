<?php if($pokeymans): //Si tiene pokémon en el equipo desplegarlos ?>
     <p> Equipo con <?php echo count($pokeymans) ?> pokémon registrados </p>
    </br>
    </br>
     <?php foreach($pokeymans as $pokeyman): ?>
        <h1>     
            <img src="<?php echo Yii::app()->params['dominio'];?>/images/animated_sprite/no_shiny/<?php echo sprintf('%03d',$pokeyman->id_pokemon)?>.gif">  
            <?php echo beautify($poke_name) ?>
        </h1>
        
        <?php $this->widget('bootstrap.widgets.TbDetailView',array(
        'data'=>$pokeyman,
        'attributes'=>array(
            array(
                'name' => 'nickname',
                'value' => $pokeyman->nickname?$pokeyman->nickname:"Ninguno",
            ),
            array(
                'name' => 'id_hability',
                'header' => 'Habilidad',
                'value' => ucfirst($pokeyman->idAbility->identifier),
            ),
            array(
                'name' => 'id_nature',
                'value' => ucfirst($pokeyman->idNature->identifier),
            ),
            array(
                'name' => 'id_item',
                'value' => $pokeyman->idItem?ucfirst($pokeyman->idItem->identifier):"Ninguno",
            ),
            'nivel',
            array(
                'name' => 'id_move1',
                'value' => ucfirst($pokeyman->idMove1->identifier),
            ),
            array(
                'name' => 'id_move2',
                'value' => $pokeyman->idMove2?ucfirst($pokeyman->idMove2->identifier):"Ninguno",
            ),
            array(
                'name' => 'id_move3',
                'value' => $pokeyman->idMove3?ucfirst($pokeyman->idMove3->identifier):"Ninguno",
            ),
            array(
                'name' => 'id_move4',
                'value' => $pokeyman->idMove4?ucfirst($pokeyman->idMove4->identifier):"Ninguno",
            ),
            'hp',
            'atk',
            'def',
            'spa',
            'spd',
            'spe',
        ),
        )); ?>
     <?php endforeach; ?>
<?php else: // Caso sin pokémons en equipos ?>

    <p><b> El jugador no tiene pokémon registrados en su equipo </b> </p>
<?php endif; ?>