<?php

class PokeballController extends Controller
{
    public function actionIndex()
	{
        $array_pokeymans = CHtml::listData(PokemonSpecies::model()->findAll(), 'id', 'nombrePokemon');
        $array_pokeballs = CHtml::listData(Pokeball::model()->findAll(), 'id', 'nombrePokeball');
        $array_turnos    = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','30+');
        array_unshift($array_pokeymans, 'Pokémon al azar');
        $this->render('index', array(
            'array_pokeymans' => $array_pokeymans,
            'array_pokeballs' => $array_pokeballs,
            'array_turnos' => $array_turnos
        ));
    }
    
    public function actionCalculateProbability()
    {
        if (isset($_POST['pokemon_to_capture'], $_POST['pokeball_to_use'], $_POST['gen'], $_POST['hp_percentage'], $_POST['select_diveball'], $_POST['select_nestball'], $_POST['select_repeatball'], $_POST['select_timerball'], $_POST['select_duskball'], $_POST['select_quickball'], $_POST['select_levelball_nivel_oponente'], $_POST['select_levelball_nivel_jugador'], $_POST['select_lureball'], $_POST['select_loveball'], $_POST['select_grass'], $_POST['select_numpokemon'], $_POST['select_entralink'])) {
            
            //Get (and cast) the $_POST data.
            ($_POST['pokemon_to_capture'] == 0) ? $id_pokeyman = rand(1, 719) : $id_pokeyman = (int) $_POST['pokemon_to_capture'];
            $id_pokeball   = (int) $_POST['pokeball_to_use'];
            $gen           = (int) $_POST['gen'];
            $status        = (string) $_POST['status'];
            $hp_percentage = (int) $_POST['hp_percentage'];
            
            //Get the models.
            $pokeyman = PokemonSpecies::model()->findByPk($id_pokeyman);
            $pokeball = Pokeball::model()->findByPk($id_pokeball);
            
            $pokemon_name = ucfirst($pokeyman->identifier);
            //Get the text to show at the showResults partial.
            if ($gen == 1) $gentext = 'primera'; elseif ($gen == 2) $gentext = 'segunda';
            elseif ($gen == 3) $gentext = 'tercera'; elseif ($gen == 4) $gentext = 'cuarta';
            elseif ($gen == 5) $gentext = 'quinta'; elseif ($gen == 6) $gentext = 'sexta';
            if ($status == 'Normal')
                $statustext = 'sin problemas de salud';
            elseif ($status == 'Sleep')
                $statustext = 'durmiendo';
            elseif ($status == 'Freeze')
                $statustext = 'congelado/a';
            elseif ($status == 'Burn')
                $statustext = 'quemado/a';
            elseif ($status == 'Poison')
                $statustext = 'envenenado/a';
            else
                $statustext = 'Paralizado/a';
            
            
            //Now we actually do the calculation.
            switch ($id_pokeball) {
                case 6: //Net ball
                	$water=11;
					$bug=7;
                    $is_water_pokemon = PokemonTypes::model()->findByAttributes(array('pokemon_id' => $id_pokeyman,'type_id' => $water));
                    $is_bug_pokemon   = PokemonTypes::model()->findByAttributes(array('pokemon_id' => $id_pokeyman,'type_id' => $bug));
                    if(is_null($is_water_pokemon)&&is_null($is_bug_pokemon)){
                        $multiplier 	= 1;
                        $text_pokeball 	= 'Dado que se usó una Net Ball y el pokémon a atrapar ('.$pokemon_name.') no es tipo agua ni bicho no hay modificadores adicionales para la captura';
                    } else {
                        $multiplier = 3;
                        $text_pokeball = 'Dado que se usó una Net Ball y el pokémon a capturar ('.$pokemon_name.') es tipo bicho o agua se tiene una modificación de x3';
                   }break;
                case 7: //Dive ball
                    if (0 == (int) $_POST["select_diveball"]) {
                        $text_pokeball 	= "Dado que se usó una Dive Ball y el encuentro no ocurrió bajo el agua, al pescar o al surfear no hay ningún modificador especial por esta pokéball.";
                        $multiplier 	= 1;
                    } else {
                        $text_pokeball 	= "Dado que se usó una Dive Ball y el encuentro ocurrió pescando, bajo el agua o surfeando se aplica un modificador de x3";
                        $multiplier 	= 3;
                    }break;
                case 8: //Nest ball
                    $nestball_level = (int) $_POST["select_nestball"];
                    if(($gen == 5)||($gen == 6)){
						$multiplier = max(1, (41 - $nestball_level) / 10); // ((41 - Pokémon's level) ÷ 10)×, minimum 1×
                    }
                    else{
						$multiplier = max(1, (40 - $nestball_level) / 10); // ((40 - Pokémon's level) ÷ 10)×, minimum 1× 
                    }
					$text_pokeball = "Dado que se usó NestBall en ".$gentext." generación y el pokémon a capturar es de nivel ".$nestball_level." se tiene un multiplicador de  x".$multiplier.". Para ver más detalles del algoritmo pueden revisar ".Yii::app()->params["pokeball_math_page"];
                    break;
                case 9: //Repeat ball
                    if (0 == (int) $_POST["select_repeatball"]) {
                        $text_pokeball	= 'Dado que se usó una Repeat Ball y el pokémon a capturar no ha sido atrapado anteriormente no hay modificación por este aspecto';
                        $multiplier 	= 1;
                    } else {
                        $text_pokeball	= 'Dado que se usó una Repeat Ball y el pokémon a capturar fue capturado anteriormente se aplica un modificador de x3';
                        $multiplier 	= 3;
                    }
                    break;
                case 10: //Timer ball
					$turnos = (int) $_POST["select_timerball"] + 1;
					if($turnos == 31)
						$turnos_text = "han pasado 31 o más turnos";
					elseif($turnos == 1)
						$turnos_text = "ha pasado 1 turno";
					else
						$turnos_text = 'han pasado '.$turnos.' turnos';
					if (($gen == 5)||($gen == 6)){
					    $multiplier = min(4, 1 + 0.3 * $turnos);
					}
					else{
					    $multiplier = min(4, ($turnos + 10) / 10);
					}
					$text_pokeball = "Dado que se usó Timer Ball en ".$gentext." generación y $turnos_text se tiene un multiplicador de  x".$multiplier.". Para ver más detalles del algoritmo pueden revisar ".Yii::app()->params["pokeball_math_page"];
					break;
                case 13: //Dusk ball
                    if (0 == (int) $_POST["select_duskball"]) {
                        $text_pokeball	= 'Dado que la captura fue con Dusk Ball y no ocurrió de noche o en una cueva no se tienen modificadores adicionales por esta pokéball';
                        $multiplier 	= 1;
                    } else {
                        $text_pokeball	= 'Dado que la captura fue con Dusk Ball y ocurrió de noche o en una cueva se tiene un modificador adicional de x3,5';
                        $multiplier 	= 3.5;
                    } break;
                case 15: //Quick ball
                    if (0 == (int) $_POST["select_quickball"]){
                        $multiplier = 1;
                    	$text_pokeball = 'Dado que se usó Quick Ball y no era el primer turno de la pelea no se obtiene modificador adicional por este medio.';
                    } else {
                        if (($gen == 5)||($gen == 6)){
                            $multiplier = 5;
                        }
                        else{
                            $multiplier = 4;
                        }
                        $text_pokeball = 'Dado que se usó Quick Ball en '.$gentext.' generación y se usó la pokéball al primer turno de la pelea se tiene un multiplicador de x'.$multiplier.'. Para ver más detalles del algoritmo pueden revisar '.Yii::app()->params["pokeball_math_page"];
                    } break;
                case 17: //Fast Ball
                    if ($gen == 2) {
                    	$tangela 	= 114;
                    	$grimer 	= 88;
                    	$magnemite 	= 81;
                        if (($id_pokeyman == $magnemite) || ($id_pokeyman == $tangela) || ($id_pokeyman == $grimer)) { //For some reason in second generation it works this way...
                            $multiplier = 4;
                            $text_pokeball = "Dado que se usó Fast Ball en segunda generación y el pokémon a capturar es magnemite, grimer o tangela en segunda generación se tiene un modificador de x4";
                        }else{
                     		$multiplier = 1;
                     		$text_pokeball = "Dado que se usó Fast Ball en segunda generación y el pokémon a capturar no es magnemite, grimer o tangela en segunda generación se tiene un modificador de x1";
                        }
                    } else {
                    	$speed = 6;
                    	$pokemon_speed = PokemonStats::model()->findByAttributes(array('pokemon_id' => $id_pokeyman, 'stat_id' => $speed))->base_stat;
                        if ($pokemon_speed > 99) {
                            $multiplier = 4;
                        }else{
                        	$multiplier = 1;
                        }
                        $text_pokeball = "Dado que se usó Fast Ball en ".$gentext." generación y el pokémon a capturar tiene ".$pokemon_speed." de velocidad base se tiene un modificador de x".$multiplier;
                    }  break;
                case 18: //Level Ball
                    $oponent_level = (int) $_POST["select_levelball_nivel_oponente"];
                    $player_level  = (int) $_POST["select_levelball_nivel_jugador"];
                    if (($oponent_level < $player_level) && ((4 * $oponent_level) < $player_level)) {
                        $multiplier = 4;
                    } elseif (($oponent_level < $player_level) && ((2 * $oponent_level) < $player_level)) {
                        $multiplier = 2;
                    } elseif ($oponent_level >= $player_level) {
                        $multiplier = 1;
                    } else{
                        $multiplier = 8;
                    }
                    $text_pokeball = 'Dado que se usó una Level Ball, el nivel oponente es '.$oponent_level.' y el del pokémon a la defensa es '.$player_level.' se tiene un multiplicador de x'.$multiplier;
                    break;
                case 19: //Lure ball
                    $lure_ball_bool = (int) $_POST["select_lureball"];
                    if ($lure_ball_bool == "0") {
                        $text_pokeball 	= 'Dado que se usó Lure Ball y el pokémon no fue encontrado pescando no se tiene bonificador por este medio';
                        $multiplier 	= 1;
                    } else {
                        $text_pokeball 	= 'Dado que se usó Lure Ball y el encuentro fue pescando se tiene modificador de x3';
                        $multiplier = 3;
                    } break;
                case 21: //Love ball
                    if (0 == (int) $_POST["select_loveball"]) {
                    	if($gen == 2){
							$multiplier = 8;
						}else{
							$multiplier = 1;
						}
						$text_pokeball = 'Dado que se usó Love ball y que los pokémon son de género opuesto y el encuentro fue en '.$gentext.' generación se tiene un modificador de x'.$multiplier;
                    } else {
                    	if($gen != 2){
                        	$multiplier = 8;
                    	}else{
                    		$multiplier = 1;
                    	}
						$text_pokeball = 'Dado que se usó Love ball y que los pokémon son del mismo género y el encuentro fue en '.$gentext.' generación se tiene un modificador de x'.$multiplier;
                    }
                    break;
                case 23: //Moon ball
                    $array_pokemon_moonball = array('29','30','31','32','33','34','35','36','39','40','300','301','517','518');
                    if (in_array($id_pokeyman, $array_pokemon_moonball)) {
                        $multiplier = 4;
                        $text_pokeball = 'Dado que se usó Moon Ball y '.$pokemon_name.' es un pokémon relacionado con la roca lunar se tiene un modiifcador de x4';
                    } else {
                        $multiplier = 1;
                        $text_pokeball = 'Dado que se usó Moon Ball y '.$pokemon_name.' es un pokémon que no está relacionado con la roca lunar no se tiene modificación extra por este medio';
                    } break;
                default: //Fixed rate pokéball
                    $multiplier 	= $pokeball->catch_rate_pokeball;
                    $text_pokeball = 'Se usó '.$pokeball->name_pokeball.', que tiene un modificador fijo de x'.$multiplier;
                    break;
            }
            
            $this->renderPartial('_showResults', array(
                'pokemon_to_catch'	=> $pokemon_name,
                'gen'				=> $gentext,
                'pokeball_en'		=> $pokeball->name_pokeball,
                'pokeball_es'		=> $pokeball->name_es_pokeball,
                'hp_percentage'		=> $hp_percentage,
                'status_text'		=> $statustext,
                'text_pokeball' 	=> $text_pokeball,
                'multiplier'		=> $multiplier,
            ));
        }
    }
}