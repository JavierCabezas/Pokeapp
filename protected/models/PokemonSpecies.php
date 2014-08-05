<?php

/**
 * This is the model class for table "pokemon_species".
 *
 * The followings are the available columns in table 'pokemon_species':
 * @property integer $id
 * @property string $identifier
 * @property integer $generation_id
 * @property integer $evolves_from_species_id
 * @property integer $evolution_chain_id
 * @property integer $color_id
 * @property integer $shape_id
 * @property integer $habitat_id
 * @property integer $gender_rate
 * @property integer $capture_rate
 * @property integer $base_happiness
 * @property integer $is_baby
 * @property integer $hatch_counter
 * @property integer $has_gender_differences
 * @property integer $growth_rate_id
 * @property integer $forms_switchable
 * @property integer $orden
 *
 * The followings are the available model relations:
 * @property Pokemon[] $pokemons
 * @property Generations $generation
 * @property PokemonSpecies $evolvesFromSpecies
 * @property PokemonSpecies[] $pokemonSpecies
 * @property EvolutionChains $evolutionChain
 * @property PokemonColor $color
 * @property PokemonShapes $shape
 * @property PokemonHabitats $habitat
 * @property ExperienceCurve $growthRate
 */
class PokemonSpecies extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pokemon_species';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('identifier, generation_id, evolution_chain_id, color_id, shape_id, gender_rate, capture_rate, base_happiness, is_baby, hatch_counter, has_gender_differences, growth_rate_id, forms_switchable, orden', 'required'),
			array('generation_id, evolves_from_species_id, evolution_chain_id, color_id, shape_id, habitat_id, gender_rate, capture_rate, base_happiness, is_baby, hatch_counter, has_gender_differences, growth_rate_id, forms_switchable, orden', 'numerical', 'integerOnly'=>true),
			array('identifier', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, identifier, generation_id, evolves_from_species_id, evolution_chain_id, color_id, shape_id, habitat_id, gender_rate, capture_rate, base_happiness, is_baby, hatch_counter, has_gender_differences, growth_rate_id, forms_switchable, orden', 'safe', 'on'=>'search'),
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
			'pokemons' => array(self::HAS_MANY, 'Pokemon', 'species_id'),
			'generation' => array(self::BELONGS_TO, 'Generations', 'generation_id'),
			'evolvesFromSpecies' => array(self::BELONGS_TO, 'PokemonSpecies', 'evolves_from_species_id'),
			'pokemonSpecies' => array(self::HAS_MANY, 'PokemonSpecies', 'evolves_from_species_id'),
			'evolutionChain' => array(self::BELONGS_TO, 'EvolutionChains', 'evolution_chain_id'),
			'color' => array(self::BELONGS_TO, 'PokemonColor', 'color_id'),
			'shape' => array(self::BELONGS_TO, 'PokemonShapes', 'shape_id'),
			'habitat' => array(self::BELONGS_TO, 'PokemonHabitats', 'habitat_id'),
			'growthRate' => array(self::BELONGS_TO, 'ExperienceCurve', 'growth_rate_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'identifier' => 'Identifier',
			'generation_id' => 'Generation',
			'evolves_from_species_id' => 'Evolves From Species',
			'evolution_chain_id' => 'Evolution Chain',
			'color_id' => 'Color',
			'shape_id' => 'Shape',
			'habitat_id' => 'Habitat',
			'gender_rate' => 'Gender Rate',
			'capture_rate' => 'Capture Rate',
			'base_happiness' => 'Base Happiness',
			'is_baby' => 'Is Baby',
			'hatch_counter' => 'Hatch Counter',
			'has_gender_differences' => 'Has Gender Differences',
			'growth_rate_id' => 'Growth Rate',
			'forms_switchable' => 'Forms Switchable',
			'orden' => 'Orden',
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
		$criteria->compare('generation_id',$this->generation_id);
		$criteria->compare('evolves_from_species_id',$this->evolves_from_species_id);
		$criteria->compare('evolution_chain_id',$this->evolution_chain_id);
		$criteria->compare('color_id',$this->color_id);
		$criteria->compare('shape_id',$this->shape_id);
		$criteria->compare('habitat_id',$this->habitat_id);
		$criteria->compare('gender_rate',$this->gender_rate);
		$criteria->compare('capture_rate',$this->capture_rate);
		$criteria->compare('base_happiness',$this->base_happiness);
		$criteria->compare('is_baby',$this->is_baby);
		$criteria->compare('hatch_counter',$this->hatch_counter);
		$criteria->compare('has_gender_differences',$this->has_gender_differences);
		$criteria->compare('growth_rate_id',$this->growth_rate_id);
		$criteria->compare('forms_switchable',$this->forms_switchable);
		$criteria->compare('orden',$this->orden);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PokemonSpecies the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	*	Returns the name of the pokémon with the correct capitalization. (Example: Gardevoir instead of gardevoir)
	*	@return string the name of the pokémon.
	*/
	public function getPokemonName()
	{
		return beautify($this->identifier);
	}

	/**
	 * Checks if the pokémon can evolve. Useful for eviolite.
	 * @param integer id_pokemon the identifier of the pokémon that you are going to check for evolutions.
	 * @return bool true if the pokémon evolves and false otherwise.
	 */
	public function getCanPokemonEvolve(){
		$evolution = PokemonSpecies::model()->findByAttributes(array('evolves_from_species_id' => $this->id));
		if(isset($evolution->id))
			return true;
		else
			return false;
	}

	/** 
	 *	Returns the pokémon list intended for a dropdown 
	 *	@return array of the listdata of the Pokémon model.
	 */
	public function dropdownPokemon()
	{
	    $criteria = new CDbCriteria;
        $criteria->addCondition("id < 5000");
        $model = PokemonSpecies::model()->findAll($criteria);
        return CHtml::listData($model, 'id', 'pokemonName');	
	}  

	/**
	 *	Returns the html code for inserting an image for the specific pokémon.
	 *	@param string $type can be "static" (the default value) or "moving" (depending if we want the gif of the png)
	 *	@return string the image html code
	 */
	public function Image($type = 'static'){
		if($type == 'static'){
			$pic = $this->pokemonName.'_XY.png';
			return CHtml::image(Yii::app()->baseUrl.'/images/sprites_png/'.$pic);
		}elseif($type == 'moving'){
			$pic = $this->identifier.'.gif';
			return CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.$pic);
		}
	}
}
