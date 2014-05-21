<?php

class PokeballController extends Controller
{
    public function actionIndex()
    {
        $array_pokeymans = CHtml::listData(PokemonSpecies::model()->findAll(), 'id', 'nombrePokemon');
        $array_pokeballs = CHtml::listData(Pokeball::model()->findAll(), 'id', 'nombrePokeball');
        $array_turnos    = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17',
        						'18','19','20','21','22','23','24','25','26','27','28','29','30','30+');
        
        array_unshift($array_pokeymans, 'Pokémon al azar');
        $this->render('index', array(
            'array_pokeymans' => $array_pokeymans,
            'array_pokeballs' => $array_pokeballs,
            'array_turnos' => $array_turnos
        ));
    }
    
    public function actionCalculateProbability()
    {
        if (isset($_POST['pokemon_to_capture'], $_POST['pokeball_to_use'], $_POST['gen'], $_POST['hp_percentage'], 
        		  $_POST['select_diveball'], $_POST['select_nestball'], $_POST['select_repeatball'], $_POST['select_timerball'], 
        		  $_POST['select_duskball'], $_POST['select_quickball'], $_POST['select_levelball_nivel_oponente'], 
        		  $_POST['select_levelball_nivel_jugador'], $_POST['select_lureball'], $_POST['select_loveball'], 
        		  $_POST['select_grass'], $_POST['select_numpokemon'], $_POST['select_entralink'])) {
            
            //Get (and cast) the $_POST data.
            ($_POST['pokemon_to_capture'] == 0)?$id_pokeyman = rand(1, 719):$id_pokeyman=(int)$_POST['pokemon_to_capture'];
        	$id_pokeball       = (int)     $_POST['pokeball_to_use'];
            $gen               = (int)     $_POST['gen'];
            $status            = (string)  $_POST['status'];
            $hp_percentage     = (int)     $_POST['hp_percentage'];

            //Get the models.
            $pokeyman = PokemonSpecies::model()->findByPk($id_pokeyman);
            $pokeball = Pokeball::model()->findByPk($id_pokeball);

            //Get the text to show at the showResults partial.
            if($gen == 1) $gentext = 'primera'; elseif($gen == 2) $gentext = 'segunda'; elseif($gen == 3) $gentext = 'tercera'; 
            elseif($gen == 4) $gentext = 'cuarta';  elseif($gen == 5) $gentext = 'quinta';  elseif($gen == 6) $gentext = 'sexta'; 
            if($status == 'Normal') $statustext = 'sin problemas de salud'; elseif($status == 'Sleep') $statustext = 'durmiendo';
            elseif($status =='Freeze') $statustext = 'congelado/a'; elseif($status == 'Burn') $statustext = 'quemado/a';
            elseif($status == 'Poison') $statustext = 'envenenado/a'; else $statustext = 'Paralizado/a';

            $this->renderPartial('_showResults', array(
                'pokemon_to_catch' => ucfirst($pokeyman->identifier),
                'gen'              => $gentext,
                'pokeball_en'      => $pokeball->name_pokeball, 
                'pokeball_es'      => $pokeball->name_es_pokeball,
                'hp_percentage'    => $hp_percentage,
                'status_text'      => $statustext,
            )); 
        }
    }
}