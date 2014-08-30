<?php

class BuscadorController extends Controller
{
	public function actionIndex()
	{
		$array_generations 	= array('1' => 'Primera', '2' => 'Segunda', '3' => 'Tercera', '4' => 'Cuarta', '5' => 'Quinta', '6' => 'Sexta');
		
		$this->render('index', array(
			'array_generations' => $array_generations,
		));
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
			'eggies'		=> PokemonEggGroups::model()->findAllByAttributes(array('species_id' => $pokemon->species->id))
		));
	}

	/**
	 * 	Recieves the ajax call from the index view to render the pokémon to show after using the filters.
	 *	The value "-1" is used as a "non selected" option. This means that for each one of the filters it first checks if the value is -1, in that case it igores the filter and checks the next one.
	 * 	Right now it has the following filters:
	 *	 - Height (from min value to max value, both of them optional.)
	 *	 - Weight (similar to height)
	 *	 - Types (It checks just one type or both of them)
	 *	 - Inmunity to (another type)
	 *	 - Generations
	 * 	 
	 *	@todo: resistant
	 *	@todo: Egg group
	 *	@todo: Ability
	 *	@todo: moves
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
		);
		$criteria->together = true;

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
			//Electric -> Pokémon with ligthining rod, motor drive and volt absorb are inmune.
			else if($inmunity == $type['electric']){
				$criteria->addCondition('pokemonAbilities.ability_id = :lightningrod or pokemonAbilities.ability_id = :motordrive or pokemonAbilities.ability_id = :voltabsorb');
				$params['lightningrod'] 	=  Abilities::model()->findByAttributes(array('identifier' => 'lightningrod'))->id;
				$params['motordrive'] 	=  Abilities::model()->findByAttributes(array('identifier' => 'motor-drive'))->id;
				$params['voltabsorb'] 		=  Abilities::model()->findByAttributes(array('identifier' => 'volt-absorb'))->id;
			}
			//Psychic -> Dark type pokémon don't give a shit about psychic
			else if($inmunity == $type['psychic']){
				$criteria->addCondition('pokemonTypes.type_id = :type');
				$params['type'] = $type['dark'];
			}
		}
		//END OF INMUNITY

		//RESISTANT TO
		if($_POST['resistant'] != -1){
			//@todo
		}
		//END OF RESISTANT TO

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

		
		$criteria->params = $params; //Im calling the params here, before the generations, because of a Yii bug.

		//GENERATIONS
		$gen = array('1' => filter_var($_POST['gen_1'], FILTER_VALIDATE_BOOLEAN), '2' => filter_var($_POST['gen_2'], FILTER_VALIDATE_BOOLEAN), 
					 '3' => filter_var($_POST['gen_3'], FILTER_VALIDATE_BOOLEAN), '4' => filter_var($_POST['gen_4'], FILTER_VALIDATE_BOOLEAN),
					 '5' => filter_var($_POST['gen_5'], FILTER_VALIDATE_BOOLEAN), '6' => filter_var($_POST['gen_6'], FILTER_VALIDATE_BOOLEAN));
		if($gen[1]||$gen[2]||$gen[3]||$gen[4]||$gen[5]||$gen[6]){ // Just use the filter is the user actually clicked a generation.
			$n = 1;
			$gens_to_search = array();
			foreach($gen as $g){
				if($g){
					array_push($gens_to_search, $n);
				}
				$n = $n+1;
			}
			$criteria->addInCondition('species.generation_id', $gens_to_search);
		}
		//END OF GENERATIONS

		//MOVES
		$moves = array();
		if($_POST['move1'] != -1)array_push($moves, intval($_POST['move1']));
		if($_POST['move2'] != -1)array_push($moves, intval($_POST['move2']));
		if($_POST['move3'] != -1)array_push($moves, intval($_POST['move3']));
		if($_POST['move4'] != -1)array_push($moves, intval($_POST['move4']));
		
		if(!empty($moves)){
			foreach($moves as $move){
				
			}
		}
		//END OF MOVES

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