<?php

class PokeballController extends Controller
{
    public function actionIndex()
	{
		//Register G-raphael for the pie chart.
		$baseUrl = Yii::app()->baseUrl; 
		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile($baseUrl.'/js/raphael.js');
		$cs->registerScriptFile($baseUrl.'/js/g.raphael-min.js');
		$cs->registerScriptFile($baseUrl.'/js/g.pie-min.js');

        $array_pokeymans = CHtml::listData(PokemonSpecies::model()->findAll(), 'id', 'pokemonName');
        $array_pokeballs = CHtml::listData(Pokeball::model()->findAll(), 'id', 'pokeballName');
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
            
            $pokemon_name = beautify($pokeyman->identifier);
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
           
            //Getting the first variable: The pokéball multiplier.
            switch ($id_pokeball) {
                case 6: //Net ball
                	$water=11;
					$bug=7;
                    $is_water_pokemon = PokemonTypes::model()->findByAttributes(array('pokemon_id' => $id_pokeyman,'type_id' => $water));
                    $is_bug_pokemon   = PokemonTypes::model()->findByAttributes(array('pokemon_id' => $id_pokeyman,'type_id' => $bug));
                    if(is_null($is_water_pokemon)&&is_null($is_bug_pokemon)){
                        $pball_multiplier 	= 1;
                        $text_pokeball 	= 'Dado que se usó una Net Ball y el pokémon a atrapar ('.$pokemon_name.') no es tipo agua ni bicho no hay modificadores adicionales para la captura';
                    } else {
                        $pball_multiplier = 3;
                        $text_pokeball = 'Dado que se usó una Net Ball y el pokémon a capturar ('.$pokemon_name.') es tipo bicho o agua se tiene una modificación de x3';
                   }break;
                case 7: //Dive ball
                    if (0 == (int) $_POST["select_diveball"]) {
                        $text_pokeball 	= "Dado que se usó una Dive Ball y el encuentro no ocurrió bajo el agua, al pescar o al surfear no hay ningún modificador especial por esta pokéball.";
                        $pball_multiplier 	= 1;
                    } else {
                        $text_pokeball 	= "Dado que se usó una Dive Ball y el encuentro ocurrió pescando, bajo el agua o surfeando se aplica un modificador de x3";
                        $pball_multiplier 	= 3;
                    }break;
                case 8: //Nest ball
                    $nestball_level = (int) $_POST["select_nestball"];
                    if(($gen == 5)||($gen == 6)){
						$pball_multiplier = max(1, (41 - $nestball_level) / 10); // ((41 - Pokémon's level) ÷ 10)×, minimum 1×
                    }
                    else{
						$pball_multiplier = max(1, (40 - $nestball_level) / 10); // ((40 - Pokémon's level) ÷ 10)×, minimum 1× 
                    }
					$text_pokeball = "Dado que se usó NestBall en ".$gentext." generación y el pokémon a capturar es de nivel ".$nestball_level." se tiene un multiplicador de  x".$pball_multiplier.".";
                    break;
                case 9: //Repeat ball
                    if (0 == (int) $_POST["select_repeatball"]) {
                        $text_pokeball	= 'Dado que se usó una Repeat Ball y el pokémon a capturar no ha sido atrapado anteriormente no hay modificación por este aspecto';
                        $pball_multiplier 	= 1;
                    } else {
                        $text_pokeball	= 'Dado que se usó una Repeat Ball y el pokémon a capturar fue capturado anteriormente se aplica un modificador de x3';
                        $pball_multiplier 	= 3;
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
					    $pball_multiplier = min(4, 1 + 0.3 * $turnos);
					}
					else{
					    $pball_multiplier = min(4, ($turnos + 10) / 10);
					}
					$text_pokeball = "Dado que se usó Timer Ball en ".$gentext." generación y $turnos_text se tiene un multiplicador de  x".$pball_multiplier.".";
					break;
                case 13: //Dusk ball
                    if (0 == (int) $_POST["select_duskball"]) {
                        $text_pokeball	= 'Dado que la captura fue con Dusk Ball y no ocurrió de noche o en una cueva no se tienen modificadores adicionales por esta pokéball';
                        $pball_multiplier 	= 1;
                    } else {
                        $text_pokeball	= 'Dado que la captura fue con Dusk Ball y ocurrió de noche o en una cueva se tiene un modificador adicional de x3,5';
                        $pball_multiplier 	= 3.5;
                    } break;
                case 15: //Quick ball
                    if (0 == (int) $_POST["select_quickball"]){
                        $pball_multiplier = 1;
                    	$text_pokeball = 'Dado que se usó Quick Ball y no era el primer turno de la pelea no se obtiene modificador adicional por este medio.';
                    } else {
                        if (($gen == 5)||($gen == 6)){
                            $pball_multiplier = 5;
                        }
                        else{
                            $pball_multiplier = 4;
                        }
                        $text_pokeball = 'Dado que se usó Quick Ball en '.$gentext.' generación y se usó la pokéball al primer turno de la pelea se tiene un multiplicador de x'.$pball_multiplier.'.';
                    } break;
                case 17: //Fast Ball
                    if ($gen == 2) {
                    	$tangela 	= 114;
                    	$grimer 	= 88;
                    	$magnemite 	= 81;
                        if (($id_pokeyman == $magnemite) || ($id_pokeyman == $tangela) || ($id_pokeyman == $grimer)) { //For some reason in second generation it works this way...
                            $pball_multiplier = 4;
                            $text_pokeball = "Dado que se usó Fast Ball en segunda generación y el pokémon a capturar es magnemite, grimer o tangela en segunda generación se tiene un modificador de x4";
                        }else{
                     		$pball_multiplier = 1;
                     		$text_pokeball = "Dado que se usó Fast Ball en segunda generación y el pokémon a capturar no es magnemite, grimer o tangela en segunda generación se tiene un modificador de x1";
                        }
                    } else {
                    	$speed = 6;
                    	$pokemon_speed = PokemonStats::model()->findByAttributes(array('pokemon_id' => $id_pokeyman, 'stat_id' => $speed))->base_stat;
                        if ($pokemon_speed > 99) {
                            $pball_multiplier = 4;
                        }else{
                        	$pball_multiplier = 1;
                        }
                        $text_pokeball = "Dado que se usó Fast Ball en ".$gentext." generación y el pokémon a capturar tiene ".$pokemon_speed." de velocidad base se tiene un modificador de x".$pball_multiplier;
                    }  break;
                case 18: //Level Ball
                    $oponent_level = (int) $_POST["select_levelball_nivel_oponente"];
                    $player_level  = (int) $_POST["select_levelball_nivel_jugador"];
                    if (($oponent_level < $player_level) && ((4 * $oponent_level) < $player_level)) {
                        $pball_multiplier = 4;
                    } elseif (($oponent_level < $player_level) && ((2 * $oponent_level) < $player_level)) {
                        $pball_multiplier = 2;
                    } elseif ($oponent_level >= $player_level) {
                        $pball_multiplier = 1;
                    } else{
                        $pball_multiplier = 8;
                    }
                    $text_pokeball = 'Dado que se usó una Level Ball, el nivel oponente es '.$oponent_level.' y el del pokémon a la defensa es '.$player_level.' se tiene un multiplicador de x'.$pball_multiplier;
                    break;
                case 19: //Lure ball
                    $lure_ball_bool = (int) $_POST["select_lureball"];
                    if ($lure_ball_bool == "0") {
                        $text_pokeball 	= 'Dado que se usó Lure Ball y el pokémon no fue encontrado pescando no se tiene bonificador por este medio';
                        $pball_multiplier 	= 1;
                    } else {
                        $text_pokeball 	= 'Dado que se usó Lure Ball y el encuentro fue pescando se tiene modificador de x3';
                        $pball_multiplier = 3;
                    } break;
                case 21: //Love ball
                    if (0 == (int) $_POST["select_loveball"]) {
                    	if($gen == 2){
							$pball_multiplier = 8;
						}else{
							$pball_multiplier = 1;
						}
						$text_pokeball = 'Dado que se usó Love ball y que los pokémon son de género opuesto y el encuentro fue en '.$gentext.' generación se tiene un modificador de x'.$pball_multiplier;
                    } else {
                    	if($gen != 2){
                        	$pball_multiplier = 8;
                    	}else{
                    		$pball_multiplier = 1;
                    	}
						$text_pokeball = 'Dado que se usó Love ball y que los pokémon son del mismo género y el encuentro fue en '.$gentext.' generación se tiene un modificador de x'.$pball_multiplier;
                    }
                    break;
                case 23: //Moon ball
                    $array_pokemon_moonball = array('29','30','31','32','33','34','35','36','39','40','300','301','517','518');
                    if (in_array($id_pokeyman, $array_pokemon_moonball)) {
                        $pball_multiplier = 4;
                        $text_pokeball = 'Dado que se usó Moon Ball y '.$pokemon_name.' es un pokémon relacionado con la roca lunar se tiene un modiifcador de x4';
                    } else {
                        $pball_multiplier = 1;
                        $text_pokeball = 'Dado que se usó Moon Ball y '.$pokemon_name.' es un pokémon que no está relacionado con la roca lunar no se tiene modificación extra por este medio';
                    } break;
                default: //Fixed rate pokéball
                    $pball_multiplier 	= $pokeball->catch_rate_pokeball;
                    $text_pokeball = 'Se usó '.$pokeball->name_pokeball.', que tiene un modificador fijo de x'.$pball_multiplier;
                    break;
            } //End switch to get the pokéball multiplier

            //Getting the second variable:
            $H 			= (int) $_POST['hp_percentage'];
            $catch_rate = $pokeyman->capture_rate;
			$text_gen = '';
			$out = array();
			switch($gen){
				case 2: //// http://www.dragonflycave.com/gen2capture.aspx ^\text{Probabilidad captura segunda generaci\'{o}n}=\frac{\left( max\left\{ \255, \left \left [ \left(1-\dfrac{H}{100}  \right ) \cdot P \cdot C  +S \right ]\right\} +1 \right)}{256}
				    if ($status == "Normal")
                        $S = 0;
                    else if (($status == "Sleep")||($status == "Freeze"))
                        $S = 10;
                    else if (($status == "Paralysis")||($status == "Burn")||($status == "Poison"))
                        $S = 0; //It should be 5 but the game is bugged :P
                    $x = max( ((1-(2/3*$H/100)) * $pball_multiplier * $catch_rate), 1) + $S; //X = max(((M - H) * C) / M, 1) + S
                    $x = intval(min ($x, 255)); // x can't be greater than 255.
                    $out['prob_win'] = 100*round( (max(0, min(1, ($x+1)/256))), 4); //the chance to capture the Pokémon is (X + 1)/256).
                    if ($x <= 1) $y = 63; elseif ($x == 2) $y = 75; elseif ($x == 3) $y = 84; elseif ($x == 5) $y = 95; elseif (its_in_between($x, 6, 7)) $y=103;
                    elseif (its_in_between($x, 8, 10))      $y=113; elseif (its_in_between($x, 11, 15))     $y=126; elseif (its_in_between($x, 16, 20)) $y=134;
                    elseif (its_in_between($x, 21, 30))     $y=149; elseif (its_in_between($x, 31, 40))     $y=160; elseif (its_in_between($x, 41, 50)) $y=169;
                    elseif (its_in_between($x, 51, 60))     $y=177; elseif (its_in_between($x, 61, 80))     $y=191; elseif (its_in_between($x, 81, 100)) $y=201;
                    elseif (its_in_between($x, 101, 120))   $y=211; elseif (its_in_between($x, 121, 140))   $y=220; elseif (its_in_between($x, 141, 160)) $y=227;
                    elseif (its_in_between($x, 161, 180))   $y=234; elseif (its_in_between($x, 181, 200))   $y=240; elseif (its_in_between($x, 201, 220)) $y=246;
                    elseif (its_in_between($x, 221, 240))   $y=251; elseif (its_in_between($x, 241, 254))   $y=253; else $y=255;
                    $out['prob_fail']      = 100-$out['prob_win'];
                    $wobble_chance         = (256-$y)/256;
                    $wobble_fail_chance    = $y/256;
                    $out['prob_0_wobble']  = round( $wobble_fail_chance, 4); //If the first generated number is over y then the pokéball won't wobble.
                    $out['prob_1_wobble']  = round( $wobble_chance * $wobble_fail_chance, 4); //Y is greater than the first number but it fails at the second one.
                    $out['prob_2_wobble']  = round( $wobble_chance * $wobble_chance * $wobble_fail_chance, 4); //The first two numbers generated are smaller than Y but it fails on the third one.
                    $out['prob_3_wobble']  = round( $wobble_chance * $wobble_chance * $wobble_chance, 4); //The 3 numbers are greater than Y.
				break; //End of second generation.
				case 3:
				case 4: //Third and fourth generations use the same formula.
					if ($status == "Normal")
		            	$S = 1;
		           	else if (($status == "Sleep")||($status == "Freeze"))
		               	$S = 2;
					else
		                $S = 1.5;

					$x = intval( (1-(2/3*$H/100))*$catch_rate*$pball_multiplier*$S);
					$y = intval(min(65535, 65535/(sqrt(sqrt(255/$x)))));

                    $pokemon_stays_in_pball = $y/65535;
                    $pokemon_breaks_out = 1-($y/65535);
					$out['prob_win'] = round(100*$pokemon_stays_in_pball*$pokemon_stays_in_pball*$pokemon_stays_in_pball*$pokemon_stays_in_pball ,3); //100*$y/65535;
                    if($out['prob_win'] > 99.99) $out['prob_win'] = 100; //skip the formula for masterball.
					$out['prob_fail'] = 100-$out['prob_win'];
					$out['prob_0_wobble'] = round(100 * $pokemon_breaks_out ,2);
					$out['prob_1_wobble'] = round(100 * $pokemon_stays_in_pball * $pokemon_breaks_out,2);
					$out['prob_2_wobble'] = round(100 * $pokemon_stays_in_pball * $pokemon_stays_in_pball * $pokemon_breaks_out,2);
					$out['prob_3_wobble'] = round(100 * $pokemon_stays_in_pball * $pokemon_stays_in_pball * $pokemon_stays_in_pball * $pokemon_breaks_out, 2);
				break; //End of third and fourth generation.
                case 5:/*
                    $grass = $_POST['select_grass'];
                    $mod_grass = $_POST['select_numpokemon'];
                    $entralink = $_POST['select_entralink'];
                    if ($status == "Normal")
                        $S = 1;
                    else if (($status == "Sleep")||($status == "Freeze"))
                        $S = 2;
                    else if (($status == "Paralysis")||($status == "Burn")||($status == "Poison"))
                        $S = 1.5;
                    $E= $entralink/10;
                    if($grass){ 
                        $G = $mod_grass/10;
                    }else{
                        $G=1;
                    }
                    $x = min(65535, (1-(2/3)*($H/100))*$catch_rate*$pball_multiplier*$S*$G*$E);
                    $Y = min(65536, floor(65536 / sqrt(sqrt(255 / $x))));
                    if($mod_grass == 10) $cc_dex = 2.5; elseif($mod_grass == 9) $cc_dex = 2; elseif($mod_grass == 8) $cc_dex = 1.5; elseif($mod_grass == 7) $cc_dex = 1; 
                    elseif($mod_grass == 5) $cc_dex = 0.5; else $cc_dex = 0;
                    $CC = floor( (min(255, $x) * $cc_dex) / 6);
                    $prob_captura_sincc = round( 100*pow(($Y / 65536),3) ,2);
                    $prob_win = $Y/65536;
                    $prob_fail = 1-$prob_win;
                    $prob_0_wobble = round(100*$prob_fail,2);
                    $prob_1_wobble = round(100*$prob_win*$prob_fail,2);
                    $prob_1_wobble = round(100*$prob_win*$prob_fail,2);
                    $prob_2_wobble = 0;
                    $prob_3_wobble = round(100*$prob_win*$prob_win*$prob_fail,2);
                    $prob_CC = round(100*$CC/256, 2);
                    $prob_captura_concc = round(100*(($CC/256)*($Y/65536)+(1-$CC/256)*pow(($Y / 65536),3)),2);
                */
                break;

			}//End switch generation.
            
            $this->renderPartial('_showResults', array(
                'pokemon_to_catch'	=> $pokemon_name,
                'gen'				=> $gentext,
                'pokeball_en'		=> $pokeball->name_pokeball,
                'pokeball_es'		=> $pokeball->name_es_pokeball,
                'hp_percentage'		=> $hp_percentage,
                'status_text'		=> $statustext,
                'text_pokeball' 	=> $text_pokeball,
                'pball_multiplier'	=> $pball_multiplier,
                'text_gen' 			=> $text_gen,
                'out'				=> $out,
            ));
        }
    }
}