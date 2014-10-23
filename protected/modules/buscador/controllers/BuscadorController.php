<?php

class BuscadorController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionView($id)
	{
		$pokemon = Pokemon::model()->findByPk($id);
		if(!$pokemon)
			$this->redirect(array('index'));

		$this->render('view', array(
			'pokemon' 		=> $pokemon,
			'types'	  		=> PokemonTypes::model()->findAllByAttributes(array('pokemon_id' => $id)),
			'resistances'	=> Types::model()->resistances($pokemon->id),
			'eggies'		=> PokemonEggGroups::model()->findAllByAttributes(array('species_id' => $pokemon->species->id)),
			'abilities'		=> pokemonAbilities::model()->findAllByAttributes(array('pokemon_id' => $id)),
		));
	}

	/**
	 * 	Recieves the ajax call from the index view to render the pokémon to show after using the filters.
	 *	The value "-1" is used as a "non selected" option. This means that for each one of the filters it first checks if the value is -1, in that case it igores the filter and checks the next one.
	 * 	Right now it has the following filters:
	 *	 - Height: From min value to max value, both of them optional.
	 *	 - Weight: Similar to height
	 *	 - Types: It checks just one type or both of them.
	 *	 - Generations : Self explanatory.
	 *   - Ability: Also SE.
	 *	 - Inmunities: Checks if the pokémon is imune to certain type. It can be inmune because of typing (like dark its inmune to psychic) or by ability (like how volt absorb grants electric inmunity).
	 *   - Stats: Checks if the pokémon can reach X on a certain stat at a Y level.
	 * 	 
	 *	@todo: Egg group
	 *	@todo: Shape
	 */
	public function actionSearchPokemon()
	{
		$criteria = new CDbCriteria;
		$params = array();
		$criteria->with = array(
			'pokemonTypes',
			'species',
			'pokemonAbilities',
			'pokemonStats',
		);
		$criteria->together = true;


		//START OF STATS
		/*
		$params['stat_hp']  = PokemonStats::HP;
		$params['stat_atk'] = PokemonStats::ATK;
		$params['stat_def'] = PokemonStats::DEF;
		$params['stat_spa'] = PokemonStats::SPA;
		$params['stat_spd'] = PokemonStats::SPD;
		$params['stat_spe'] = PokemonStats::SPE;
		$params['hp_min']   = 1;
		$params['atk_min']  = 1;
		$params['def_min']  = 1;
		$params['spa_min']  = 1;
		$params['spd_min']  = 1;
		$params['spe_min']  = 1;

		$id_nature = intval($_POST['stat_nat']);
		$level     = intval($_POST['stat_level']) == 0?1:intval($_POST['stat_level']);
		if($_POST['hp'] != -1){
			$hp 	= intval($_POST['hp']);
			$ev_hp  = intval($_POST['ev_hp']);
			$iv_hp  = intval($_POST['iv_hp']); 
			$params['hp_min']  = PokemonStats::model()->howMuchBaseINeed($hp, PokemonStats::HP, $level, $ev_hp, $iv_hp, $id_nature);
		}

		if($_POST['atk'] != -1){
			$atk 	= intval($_POST['atk']);
			$ev_atk = intval($_POST['ev_atk']);
			$iv_atk = intval($_POST['iv_atk']); 
			$params['atk_min']  = PokemonStats::model()->howMuchBaseINeed($atk, PokemonStats::ATK, $level, $ev_atk, $iv_atk, $id_nature);
		}

		if($_POST['def'] != -1){
			$def 	= intval($_POST['def']);
			$ev_def = intval($_POST['ev_def']);
			$iv_def = intval($_POST['iv_def']); 
			$params['def_min']  = PokemonStats::model()->howMuchBaseINeed($def, PokemonStats::DEF, $level, $ev_def, $iv_def, $id_nature);
		}

		if($_POST['spa'] != -1){
			$spa 	= intval($_POST['spa']);
			$ev_spa = intval($_POST['ev_spa']);
			$iv_spa = intval($_POST['iv_spa']); 
			$params['spa_min']  = PokemonStats::model()->howMuchBaseINeed($spa, PokemonStats::SPA, $level, $ev_spa, $iv_spa, $id_nature);
		}

		if($_POST['spd'] != -1){
			$spd 	= intval($_POST['spd']);
			$ev_spd = intval($_POST['ev_spd']);
			$iv_spd = intval($_POST['iv_spd']); 
			$params['spd_min']  = PokemonStats::model()->howMuchBaseINeed($spd, PokemonStats::SPD, $level, $ev_spd, $iv_spd, $id_nature);
		}

		if($_POST['spe'] != -1){
			$spe 	= intval($_POST['spe']);
			$ev_spe = intval($_POST['ev_spe']);
			$iv_spe = intval($_POST['iv_spe']); 
			$params['spe_min']  = PokemonStats::model()->howMuchBaseINeed($spe, PokemonStats::SPE, $level, $ev_spe, $iv_spe, $id_nature);
		}
*/
        
        $criteria->join ='join pokemonStats as B on pokemon_id = B.pokemon_id';
        $criteria->join ='join pokemonStats as C on pokemon_id = C.pokemon_id';
        //$criteria->join ='inner join pokemon_stats as D on pokemon_id = D.pokemon_id';
        //$criteria->join ='inner join pokemon_stats as E on pokemon_id = E.pokemon_id';
       	//$criteria->join ='inner join pokemon_stats as F on pokemon_id = F.pokemon_id';
        
        //$criteria->condition = 'col_a.stat_id = 1 and col_a.base_stat >= 10';
        $criteria->condition = 'B.stat_id = 2 and B.base_stat >= 100';
        $criteria->condition = 'C.stat_id = 3 and C.base_stat >= 100';
        //$criteria->condition = 'D.stat_id = 4 and D.base_stat >= 40';
        //$criteria->condition = 'E.stat_id = 5 and E.base_stat >= 50';
        //$criteria->condition = 'F.stat_id = 6 and F.base_stat >= 60';

/**
 * 	//$criteria->addCondition('pokemonStats.stat_id = :stat_atk and base_stat >= :atk_min');
 * SELECT  DISTINCT  A.pokemon_id
 * from pokemon_stats as A 
 * inner join pokemon_stats as B on A.pokemon_id = B.pokemon_id
 * inner join pokemon_stats as C on A.pokemon_id = C.pokemon_id
 * inner join pokemon_stats as D on A.pokemon_id = D.pokemon_id
 * inner join pokemon_stats as E on A.pokemon_id = E.pokemon_id
 * inner join pokemon_stats as F on A.pokemon_id = F.pokemon_id
 * inner join pokemon_stats as G on A.pokemon_id = G.pokemon_id
 * 
 * where A.stat_id = 1 and A.base_stat > 0
 * and B.stat_id = 2 and B.base_stat > 0
 * and C.stat_id = 3 and C.base_stat > 0
 * and D.stat_id = 4 and D.base_stat > 0
 * and F.stat_id = 5 and D.base_stat > 0
 * and G.stat_id = 6 and G.base_stat > 0
**/
		//END OF STATS

		//HEIGHT
		if($_POST['min_height'] != -1 ){
			$criteria->addCondition('height >= :min_height');
			$params['min_height'] =  intval($_POST['min_height']);
		}
		if($_POST['max_height'] != -1 ){
			$criteria->addCondition('height <= :max_height');
			$params['max_height'] =  intval($_POST['max_height']);
		}
		//END OF HEIGHT

		//WEIGHT
		if($_POST['min_weight'] != -1 ){
			$criteria->addCondition('weight > :min_weight');
			$params['min_weight'] =  intval($_POST['min_weight']);
		}
		if($_POST['max_weight'] != -1 ){
			$criteria->addCondition('weight < :max_weight');
			$params['max_weight'] =  intval($_POST['max_weight']);
		}
		//END OF WEIGHT

		//TYPES. Note to self: addCondition its the "WHERE" clause.
		if( ($_POST['type_1'] != -1) && ($_POST['type_2'] != -1) ) {
			$criteria->addCondition('
				t.id IN (SELECT A.pokemon_id FROM (SELECT pokemon_id FROM `pokemon_types` WHERE type_id=:type_1) as A, (SELECT pokemon_id FROM `pokemon_types` WHERE type_id=:type_2) as B WHERE A.pokemon_id = B.pokemon_id) ');
			$params['type_1'] = intval($_POST['type_1']);
			$params['type_2'] = intval($_POST['type_2']);
		}
		if( ($_POST['type_1'] != -1) && ($_POST['type_2'] == -1) ){
			$criteria->addCondition('pokemonTypes.type_id = :type_1');
			$params['type_1'] = intval($_POST['type_1']);
		}
		if( ($_POST['type_1'] == -1) && ($_POST['type_2'] != -1) ){
			$criteria->addCondition('pokemonTypes.type_id = :type_2');
			$params['type_2'] = intval($_POST['type_2']);
		}
		//END OF TYPES

		//INMUNITY
		if($_POST['inmunity'] != -1){
			$inmunity = intval($_POST['inmunity']);
			$type = Types::model()->arrayTypes();
			
			//Normal and fighting -> Ghosts are inmune to both of them.
			if(($inmunity == $type['normal'])||($inmunity == $type['fighting'])){
				$types = Types::model()->arrayTypes();
				$criteria->addCondition('pokemonTypes.type_id = :type');
				$params['type'] = $type['ghost'];
			}
			//Poison -> steel is inmune.
			else if($inmunity == $type['steel']){
				$criteria->addCondition('pokemonTypes.type_id = :type');
				$params['type'] = $type['steel'];
			}
			//Ground -> Flying and pokémon with levitate are inmune to ground.
			else if($inmunity == $type['ground']){
				$criteria->addCondition('pokemonTypes.type_id = :flying or pokemonAbilities.ability_id = :levitate');
				$params['flying'] 	=  $type['flying'];
				$params['levitate'] =  Abilities::model()->findByAttributes(array('identifier' => 'levitate'))->id;
			}
			//Ghost -> Normal are inmune.
			else if($inmunity == $type['ghost']){
				$criteria->addCondition('pokemonTypes.type_id = :type');
				$params['type'] = $type['normal'];
			}
			//Fire -> Pokémon with the flash fire ability are inmune.
			else if($inmunity == $type['fire']){
				$criteria->addCondition('pokemonAbilities.ability_id = :flashfire');
				$params['flashfire'] =  Abilities::model()->findByAttributes(array('identifier' => 'flash-fire'))->id;
			}
			//Water -> Pokémon with storm drain, water absorb or dry skin are inmune.
			else if($inmunity == $type['water']){
				$criteria->addCondition('pokemonAbilities.ability_id = :stormdrain or pokemonAbilities.ability_id = :waterabsorb or pokemonAbilities.ability_id = :dryskin');
				$params['stormdrain'] 	=  Abilities::model()->findByAttributes(array('identifier' => 'storm-drain'))->id;
				$params['waterabsorb'] 	=  Abilities::model()->findByAttributes(array('identifier' => 'water-absorb'))->id;
				$params['dryskin'] 		=  Abilities::model()->findByAttributes(array('identifier' => 'dry-skin'))->id;
			}
			//Grass -> Pokémon with sap sipper are inmune.
			else if($inmunity == $type['grass']){
				$criteria->addCondition('pokemonAbilities.ability_id = :sapsipper');
				$params['sapsipper'] =  Abilities::model()->findByAttributes(array('identifier' => 'sap-sipper'))->id;
			}
			//Electric -> Ground pokémon or with ligthining rod, motor drive and volt absorb are inmune.
			else if($inmunity == $type['electric']){
				$criteria->addCondition('pokemonAbilities.ability_id = :lightningrod or pokemonAbilities.ability_id = :motordrive or pokemonAbilities.ability_id = :voltabsorb or pokemonTypes.type_id = :type');
				$params['lightningrod'] 	=  Abilities::model()->findByAttributes(array('identifier' => 'lightningrod'))->id;
				$params['motordrive'] 		=  Abilities::model()->findByAttributes(array('identifier' => 'motor-drive'))->id;
				$params['voltabsorb'] 		=  Abilities::model()->findByAttributes(array('identifier' => 'volt-absorb'))->id;
				$params['type'] = $type['ground'];
			}
			//Psychic -> Dark type pokémon don't give a shit about psychic
			else if($inmunity == $type['psychic']){
				$criteria->addCondition('pokemonTypes.type_id = :type');
				$params['type'] = $type['dark'];
			}
			else if($inmunity == $type['dragon']){
				$criteria->addCondition('pokemonTypes.type_id = :type');
				$params['type'] = $type['fairy'];
			}
		}
		//END OF INMUNITY

		//COLOR
		if($_POST['color'] != -1){
			$criteria->addCondition('species.color_id = :color');
			$params['color'] =  intval($_POST['color']);
		}
		//END OF COLOR  (that sounds sooo emo)

		//EGG
		if($_POST['eggie'] != -1){
			echo $_POST['eggie'];
		}
		//END OF EGG

		//MOVES
		$moves = array();
		if($_POST['move1'] != -1)array_push($moves, intval($_POST['move1']));
		if($_POST['move2'] != -1)array_push($moves, intval($_POST['move2']));
		if($_POST['move3'] != -1)array_push($moves, intval($_POST['move3']));
		if($_POST['move4'] != -1)array_push($moves, intval($_POST['move4']));
		
		if(!empty($moves)){
			foreach($moves as $move){
				$criteria->addCondition('t.id IN (SELECT DISTINCT  pokemon_id FROM `pokemon_moves` WHERE move_id='.$move.')');
			}
		}
		//END OF MOVES

		//ABILITIES
		if($_POST['ability'] != -1){
			$criteria->addCondition('pokemonAbilities.ability_id = :abi');
			$params['abi'] =  intval($_POST['ability']);
		}
		//END OF ABILITIES

		$criteria->params = $params; //Im calling the params here, before the generations, because of a Yii bug.

		//GENERATIONS
		$gen = array('1' => filter_var($_POST['gen_1'], FILTER_VALIDATE_BOOLEAN), '2' => filter_var($_POST['gen_2'], FILTER_VALIDATE_BOOLEAN), 
					 '3' => filter_var($_POST['gen_3'], FILTER_VALIDATE_BOOLEAN), '4' => filter_var($_POST['gen_4'], FILTER_VALIDATE_BOOLEAN),
					 '5' => filter_var($_POST['gen_5'], FILTER_VALIDATE_BOOLEAN), '6' => filter_var($_POST['gen_6'], FILTER_VALIDATE_BOOLEAN));
		if($gen[1]||$gen[2]||$gen[3]||$gen[4]||$gen[5]||$gen[6]){ // Just use the filter is the user actually clicked a generation.
			$n = 1;
			$gens_to_search = array();
			foreach($gen as $g){
				if($g){ array_push($gens_to_search, $n); }
				$n += 1;
			}
			$criteria->addInCondition('species.generation_id', $gens_to_search);
		}
		//END OF GENERATIONS

		$gridColumns = array(
			array(
				'name' => 'id_pokemon',
				'header' => 'Pokémon',
				'value' => '$data->pokemonName',
			),
			array(
			  'type' => 'raw',
			  'value' => '$data->species->image("moving")'
			),
			array(
				'type'  => 'html',
				'value' => 'CHtml::link("Más detalles de ".$data->pokemonName, array("/buscador/verDetalle", "id" => $data->id))'
			),
			/*array(
				'header' => 'Holi',
				'type' 	 => 'raw',
				'value'  => '$data->pokemonTypeList'
			)*/
		);

		$dataProvider = new CActiveDataProvider('Pokemon', array(
		   'criteria' => $criteria
		));

		//GERMAN HIZO ESTO RECORDAR VER QUE DIABLOS PASA :P
	   $dataProvider->setPagination(false);
	   
		$this->widget(
			'bootstrap.widgets.TbGridView',
			 array(
				'type' => 'striped',
				'dataProvider' => $dataProvider,
				'template' => "{items}",
				'columns' => $gridColumns,
			)
		);
	}
}