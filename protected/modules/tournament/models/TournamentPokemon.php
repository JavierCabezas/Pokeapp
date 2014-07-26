<?php

/**
 * This is the model class for table "tournament_pokemon".
 *
 * The followings are the available columns in table 'tournament_pokemon':
 * @property integer $id
 * @property integer $id_tournament_player
 * @property integer $id_pokemon_species
 * @property string $nickname
 * @property integer $id_ability
 * @property integer $id_nature
 * @property integer $id_item
 * @property integer $id_move1
 * @property integer $id_move2
 * @property integer $id_move3
 * @property integer $id_move4
 * @property integer $level
 * @property integer $hp
 * @property integer $atk
 * @property integer $def
 * @property integer $spa
 * @property integer $spd
 * @property integer $spe
 *
 * The followings are the available model relations:
 * @property TournamentPlayerPokemon[] $tournamentPlayerPokemons
 * @property PokemonMoves $idMove4
 * @property TournamentPlayer $idTournamentPlayer
 * @property PokemonSpecies $idPokemonSpecies
 * @property Abilities $idAbility
 * @property Nature $idNature
 * @property Moves $idMove1
 * @property Moves $idMove2
 * @property Moves $idMove3
 */
class TournamentPokemon extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tournament_pokemon';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_tournament_player, id_pokemon_species, id_ability, id_nature, id_move1, level, hp, atk, def, spa, spd, spe', 'required'),
			array('id_tournament_player, id_pokemon_species, id_ability, id_nature, id_item, id_move1, id_move2, id_move3, id_move4, level, hp, atk, def, spa, spd, spe', 'numerical', 'integerOnly'=>true),
			array('nickname', 'length', 'max'=>12),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_tournament_player, id_pokemon_species, nickname, id_ability, id_nature, id_item, id_move1, id_move2, id_move3, id_move4, level, hp, atk, def, spa, spd, spe', 'safe', 'on'=>'search'),
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
			'tournamentPlayerPokemons' => array(self::HAS_MANY, 'TournamentPlayerPokemon', 'id_tournament_pokemon'),
			'idMove4' => array(self::BELONGS_TO, 'PokemonMoves', 'id_move4'),
			'idTournamentPlayer' => array(self::BELONGS_TO, 'TournamentPlayer', 'id_tournament_player'),
			'idPokemonSpecies' => array(self::BELONGS_TO, 'PokemonSpecies', 'id_pokemon_species'),
			'idAbility' => array(self::BELONGS_TO, 'Abilities', 'id_ability'),
			'idNature' => array(self::BELONGS_TO, 'Nature', 'id_nature'),
			'idMove1' => array(self::BELONGS_TO, 'Moves', 'id_move1'),
			'idMove2' => array(self::BELONGS_TO, 'Moves', 'id_move2'),
			'idMove3' => array(self::BELONGS_TO, 'Moves', 'id_move3'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_tournament_player' => 'Id Tournament Player',
			'id_pokemon_species' => 'Id Pokemon Species',
			'nickname' => 'Nickname',
			'id_ability' => 'Id Ability',
			'id_nature' => 'Id Nature',
			'id_item' => 'Id Item',
			'id_move1' => 'Id Move1',
			'id_move2' => 'Id Move2',
			'id_move3' => 'Id Move3',
			'id_move4' => 'Id Move4',
			'level' => 'Level',
			'hp' => 'Hp',
			'atk' => 'Atk',
			'def' => 'Def',
			'spa' => 'Spa',
			'spd' => 'Spd',
			'spe' => 'Spe',
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
		$criteria->compare('id_tournament_player',$this->id_tournament_player);
		$criteria->compare('id_pokemon_species',$this->id_pokemon_species);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('id_ability',$this->id_ability);
		$criteria->compare('id_nature',$this->id_nature);
		$criteria->compare('id_item',$this->id_item);
		$criteria->compare('id_move1',$this->id_move1);
		$criteria->compare('id_move2',$this->id_move2);
		$criteria->compare('id_move3',$this->id_move3);
		$criteria->compare('id_move4',$this->id_move4);
		$criteria->compare('level',$this->level);
		$criteria->compare('hp',$this->hp);
		$criteria->compare('atk',$this->atk);
		$criteria->compare('def',$this->def);
		$criteria->compare('spa',$this->spa);
		$criteria->compare('spd',$this->spd);
		$criteria->compare('spe',$this->spe);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TournamentPokemon the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
