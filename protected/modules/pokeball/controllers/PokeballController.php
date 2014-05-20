<?php

class PokeballController extends Controller
{
    public function actionIndex()
    {
    	$array_pokeymans = CHtml::listData(PokemonSpecies::model()->findAll(), 'id', 'nombrePokemon'); 
        $array_pokeballs = CHtml::listData(Pokeball::model()->findAll(), 'id', 'nombrePokeball'); 

        for ($i = 1; $i < 30; $i++)
            $array_turnos[$i] = $i;
        $array_turnos['30'] = "30+";
        
        $this->render('index', array(
            'array_pokeymans' => $array_pokeymans,
            'array_pokeballs' => $array_pokeballs,
            'array_turnos' => $array_turnos
        ));
    }
}