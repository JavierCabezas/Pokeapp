<?php

/**
 * This is the model class for table "tournament_player_pokemon".
 *
 * The followings are the available columns in table 'tournament_player_pokemon':
 * @property integer $id
 * @property integer $id_tournament
 * @property integer $id_tournament_pokemon
 * @property integer $id_tournament_player
 *
 * The followings are the available model relations:
 * @property Users $idTournamentPlayer
 * @property Tournament $idTournament
 * @property TournamentPokemon $idTournamentPokemon
 */
class TournamentPlayerPokemon extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tournament_player_pokemon';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_tournament, id_tournament_pokemon, id_tournament_player', 'required'),
			array('id_tournament, id_tournament_pokemon, id_tournament_player', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_tournament, id_tournament_pokemon, id_tournament_player', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idTournament' => array(self::BELONGS_TO, 'Tournament', 'id_tournament'),
			'idTournamentPokemon' => array(self::BELONGS_TO, 'TournamentPokemon', 'id_tournament_pokemon'),
			'idTournamentPlayer' => array(self::BELONGS_TO, 'Users', 'id_tournament_player'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_tournament' => 'Id Tournament',
			'id_tournament_pokemon' => 'Id Tournament Pokemon',
			'id_tournament_player' => 'Id Tournament Player',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_tournament',$this->id_tournament);
		$criteria->compare('id_tournament_pokemon',$this->id_tournament_pokemon);
		$criteria->compare('id_tournament_player',$this->id_tournament_player);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TournamentPlayerPokemon the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 *	Returns the number of the pokemon that a specific player has for an specific team in a specific tournament.
	 *	@param integer id_tournament the identifier of the tournament that the team belongs to.
	 *	@param integer id_player the identifier of the player that has the team
	 *	@return integer the number of pokémon in the team.
	 */
	public function pokemonInTeam($id_tournament, $id_player){
		return count(TournamentPlayerPokemon::model()->findAllByAttributes(array(
			'id_tournament_player'  => $id_player, 
			'id_tournament' 		=> $id_tournament
		)));
	}

	/**
	 *	Returns the number of pokémon that a specific of an specific tournament in an array.
	 *	@return array of each pokémon in the format array[pokemon_number] => number_of_times_it_was_selected.
	 */
	public function mostPopularPokemon($id_tournament){
		$pokeymans = TournamentPlayerPokemon::model()->findAllByAttributes(array(
			'id_tournament' => $id_tournament
		));

		$out = array();
		foreach($pokeymans as $pokeyman){
			if(array_key_exists($pokeyman->idTournamentPokemon->idPokemonSpecies->id, $out))
				$out[$pokeyman->idTournamentPokemon->idPokemonSpecies->id] = $out[$pokeyman->idTournamentPokemon->idPokemonSpecies->id] + 1;
			else{
				$out[$pokeyman->idTournamentPokemon->idPokemonSpecies->id] = 1;
			}
		}
		arsort($out);
		return $out;
	}

	/**
	 *	Returns an array in where the id of every item is the key and the frecuency of use is the value,
	 *	@param $id_tournament the identifier of where to get the pokémons from.
	 *	@return array in the format array('id_item_1' => times_that_the_item_was_used, 'id_item_2' => times_it_was_used, .... )
	 */
	public function mostPopularItems($id_tournament){
		$pokeymans = TournamentPlayerPokemon::model()->findAllByAttributes(array(
			'id_tournament' => $id_tournament
		));

		$out = array();
		foreach($pokeymans as $pokeyman){
			if(!is_null($pokeyman->idTournamentPokemon->id_item)){
				if(array_key_exists($pokeyman->idTournamentPokemon->id_item, $out))
					$out[$pokeyman->idTournamentPokemon->id_item] = $out[$pokeyman->idTournamentPokemon->id_item] + 1;
				else{
					$out[$pokeyman->idTournamentPokemon->id_item] = 1;
				}
			}
		}
		arsort($out);
		return $out;
	}

	/**
	 *	Returns an array with silly stats from the tournament.
	 *	@param $id_tournament the identifier of where to get the stats from.
	 *	@return array in the format:
	 *		out['number']   			=> The number of pokémon registered for the tournament.
	 *		out['nickname_number'] 		=> The number of nicknamed pokémon in the event.
	 *		out['nicnkame_percent']	    => The percentage of nicknamed pokémon in the event.
	 *		out['level']				=> The average level of the pokémon.
	 *		out['move_n']				=> The number of Pokémon with n moves (n in [1, 3])		
	 *		out['types']				=> array in the format array('type_id' => number of pokémon with that type)
	 *		out['types_percent']		=> array in the format array('type_id' => percentage of this type)
	 */
	public function silly($id_tournament){
		$pokeymans = TournamentPlayerPokemon::model()->findAllByAttributes(array(
			'id_tournament' => $id_tournament
		));

		$out 		 = array();
		$total 	 	 = count($pokeymans);
		$nicknamed   = 0;
		$level 	 	 = 0;
		$move1 		 = 0;
		$move2 		 = 0;
		$move3 		 = 0;
		$types_total = 0;
		$types_out 	 = array('1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '10' => 0, '11' => 0, '12' => 0, '13' => 0, '14' => 0, '15' => 0, '16' => 0, '17' => 0, '18' => 0);
		$types_per 	 = array('1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '10' => 0, '11' => 0, '12' => 0, '13' => 0, '14' => 0, '15' => 0, '16' => 0, '17' => 0, '18' => 0);

		foreach($pokeymans as $pokeyman){
			$level = $level + $pokeyman->idTournamentPokemon->level;
			if($pokeyman->idTournamentPokemon->nickname != '')
				$nicknamed = $nicknamed + 1;
			if(is_null($pokeyman->idTournamentPokemon->id_move2))
				$move1 = $move1 + 1;
			if(is_null($pokeyman->idTournamentPokemon->id_move3))
				$move2 = $move2 + 1;
			if(is_null($pokeyman->idTournamentPokemon->id_move4))
				$move3 = $move3 + 1;
			$types = PokemonTypes::model()->findAllByAttributes(array('pokemon_id' => $pokeyman->idTournamentPokemon->idPokemonSpecies->id));
			foreach($types as $type){
				$types_out[$type->type_id] = $types_out[$type->type_id]+1;
				$types_total = $types_total + 1;
			}
		}

		foreach($types_out as $type_id => $type){
			$types_per[$type_id] = round($type  *100/$types_total, 1);
		}
	
		$out['number'] 				= $total;
		$out['nickname_number']		= $nicknamed;
		$out['nickname_percent']	= round($nicknamed*100/$total, 1);
		$out['level']				= round($level/$total, 1);
		$out['move1']				= $move1;
		$out['move2']				= $move2;
		$out['move3']				= $move3;
		$out['types']				= $types_out;
        $out['types_per']           = $types_per;
        $out['doubles']				= array();

		return $out;
	}
}
