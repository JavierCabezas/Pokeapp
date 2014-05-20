<?php

class PokeballController extends Controller
{
    public function actionIndex()
    {
    	$array_pokeymans = CHtml::listData(PokemonSpecies::model()->findAll(), 'id', 'nombrePokemon'); 
        $array_pokeballs = CHtml::listData(Pokeball::model()->findAll(), 'id', 'nombrePokeball'); 
		$array_turnos 	 = array('1','2','3','4','5','6','7','8','9', '10', '11', '12', '13', '14', '15', '16', '17', 
								'18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '30+');

		array_unshift($array_pokeymans, 'Elige un pokémon');
        $this->render('index', array(
            'array_pokeymans' => $array_pokeymans,
            'array_pokeballs' => $array_pokeballs,
            'array_turnos' => $array_turnos,
        ));
    }
}