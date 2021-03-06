<?php

/**
 * This is the model class for table "pokemon".
 *
 * The followings are the available columns in table 'pokemon':
 * @property integer $id
 * @property string $identifier
 * @property integer $species_id
 * @property double $height
 * @property double $weight
 * @property integer $base_experience
 * @property integer $orden
 * @property integer $is_default
 *
 * The followings are the available model relations:
 * @property Player[] $players
 * @property Player[] $players1
 * @property Player[] $players2
 * @property PokemonSpecies $species
 * @property PokemonAbilities[] $pokemonAbilities
 * @property PokemonForms[] $pokemonForms
 * @property PokemonFriendSafari[] $pokemonFriendSafaris
 * @property PokemonMoves[] $pokemonMoves
 * @property PokemonSearchCriteria[] $pokemonSearchCriterias
 * @property PokemonStats[] $pokemonStats
 * @property PokemonTypes[] $pokemonTypes
 */
class Pokemon extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pokemon';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('identifier, species_id, height, weight, base_experience, orden, is_default', 'required'),
			array('species_id, base_experience, orden, is_default', 'numerical', 'integerOnly'=>true),
			array('height, weight', 'numerical'),
			array('identifier', 'length', 'max'=>14),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, identifier, species_id, height, weight, base_experience, orden, is_default', 'safe', 'on'=>'search'),
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
			'players' => array(self::HAS_MANY, 'Player', 'safari_slot_1'),
			'players1' => array(self::HAS_MANY, 'Player', 'safari_slot_2'),
			'players2' => array(self::HAS_MANY, 'Player', 'safari_slot_3'),
			'species' => array(self::BELONGS_TO, 'PokemonSpecies', 'species_id'),
			'pokemonAbilities' => array(self::HAS_MANY, 'PokemonAbilities', 'pokemon_id'),
			'pokemonForms' => array(self::HAS_MANY, 'PokemonForms', 'pokemon_id'),
			'pokemonFriendSafaris' => array(self::HAS_MANY, 'PokemonFriendSafari', 'id_pokemon'),
			'pokemonMoves' => array(self::HAS_MANY, 'PokemonMoves', 'pokemon_id'),
			'pokemonSearchCriterias' => array(self::HAS_MANY, 'PokemonSearchCriteria', 'id_pokemon'),
			'pokemonStats' => array(self::HAS_MANY, 'PokemonStats', 'pokemon_id'),
			'pokemonTypes' => array(self::HAS_MANY, 'PokemonTypes', 'pokemon_id'),
			'countPokemonTypes' => array(self::STAT, 'PokemonTypes', 'pokemon_id') //STAT uses count.
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'identifier' => 'Identifier',
			'species_id' => 'Species',
			'height' => 'Height',
			'weight' => 'Weight',
			'base_experience' => 'Base Experience',
			'orden' => 'Orden',
			'is_default' => 'Is Default',
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
		$criteria->compare('identifier',$this->identifier,true);
		$criteria->compare('species_id',$this->species_id);
		$criteria->compare('height',$this->height);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('base_experience',$this->base_experience);
		$criteria->compare('orden',$this->orden);
		$criteria->compare('is_default',$this->is_default);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	*	Returns the name of the pokémon with the correct capitalization and spacing. (Example: Gardevoir mega instead of gardevoir-mega)
	*	@return string the name of the pokémon.
	*/
	public function getPokemonName()
	{
		return beautify($this->identifier);
	}

	/**
	 *	Returns the type(s) of this pokémon in html.
	 *	@return string the type(s) of the pokémon. 
	 */
	public function getPokemonTypeList()
	{
		$retVal = '';
		if($this->countPokemonTypes > 0){ //this should always be true
			foreach($this->pokemonTypes as $index => $pokemonType){
				if($index == $this->countPokemonTypes)
					$retVal.= '<span>'.$pokemonType->type->identifier.'</span>';
				else					
					$retVal.= '<span>'.$pokemonType->type->identifier.'</span><br/>';
			}
			return $retVal;
		}else{
			return 'No Asignado';
		}
	}

	/**
	 *	Returns the generation for the specified pokémon.
	 *	@return integer the generation (between 1 and 6)
	 */
	public function getGeneration()
	{
		if(its_in_between($this->id, 1, 151))
			return 1;
		elseif(its_in_between($this->id, 152, 251))
			return 2;
		elseif(its_in_between($this->id, 252, 386))
			return 3;
		elseif(its_in_between($this->id, 387, 493))
			return 4;
		elseif(its_in_between($this->id, 494, 649))
			return 5;
		else 
			return 6;
	}
}
