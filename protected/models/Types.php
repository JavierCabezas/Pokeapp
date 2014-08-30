<?php

/**
 * This is the model class for table "types".
 *
 * The followings are the available columns in table 'types':
 * @property integer $id
 * @property string $identifier
 * @property string $name_es
 * @property integer $gen
 * @property integer $damage_class
 *
 * The followings are the available model relations:
 * @property Moves[] $moves
 * @property Player[] $players
 * @property PokemonFriendSafari[] $pokemonFriendSafaris
 * @property PokemonTypes[] $pokemonTypes
 * @property TypeEfficacy[] $typeEfficacies
 * @property TypeEfficacy[] $typeEfficacies1
 * @property Generations $gen0
 * @property MoveDamageClasses $damageClass
 */
class Types extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'types';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, identifier, gen', 'required'),
			array('id, gen, damage_class', 'numerical', 'integerOnly'=>true),
			array('identifier', 'length', 'max'=>12),
			array('name_es', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, identifier, name_es, gen, damage_class', 'safe', 'on'=>'search'),
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
			'moves' => array(self::HAS_MANY, 'Moves', 'type_id'),
			'players' => array(self::HAS_MANY, 'Player', 'id_safari_type'),
			'pokemonFriendSafaris' => array(self::HAS_MANY, 'PokemonFriendSafari', 'id_type'),
			'pokemonTypes' => array(self::HAS_MANY, 'PokemonTypes', 'type_id'),
			'typeEfficacies' => array(self::HAS_MANY, 'TypeEfficacy', 'target_type_id'),
			'typeEfficacies1' => array(self::HAS_MANY, 'TypeEfficacy', 'damage_type_id'),
			'gen0' => array(self::BELONGS_TO, 'Generations', 'gen'),
			'damageClass' => array(self::BELONGS_TO, 'MoveDamageClasses', 'damage_class'),
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
			'name_es' => 'Name Es',
			'gen' => 'Gen',
			'damage_class' => 'Damage Class',
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
		$criteria->compare('name_es',$this->name_es,true);
		$criteria->compare('gen',$this->gen);
		$criteria->compare('damage_class',$this->damage_class);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Types the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	*	Returns the type name in the format English name ( spanish name) Ex: Fire (fuego)
	*	@return string the type name in both languages.
	*/
	public function getTypeName()
	{
		return ucfirst($this->identifier) . ' (' . ucfirst($this->name_es) . ') ' ;
	}

	/** 
	 *	Returns the type list intended for a dropdown.
	 *	@param boolean inmunity (default to false) to filter all the types that you can't be inmune to. 
	 *	This means that we will be showing types such as ground (since both flying type and levitate pokémon are inmune) and ghosts (that can't hit normal)
	 *	but it will hide types such as flying or fairy (since fairy and flying can hit every other type). 
	 *	@return array of the listdata of the Types model.
	 */
	public function dropdownTypes($inmunity = false)
	{
		$criteria = new CDbCriteria;
		$criteria->addCondition("id != 10001"); //Exclude unkown type
		$criteria->addCondition("id != 10002"); //Exlude shadow type
		if($inmunity){
			$criteria->addCondition("id != 3");  //Flying
			$criteria->addCondition("id != 6");  //Rock
			$criteria->addCondition("id != 7");  //Bug
			$criteria->addCondition("id != 9");  //Steel
			$criteria->addCondition("id != 15"); //Ice
			$criteria->addCondition("id != 17"); //Dark
			$criteria->addCondition("id != 18"); //Fairy
		}
		$criteria->order = 'identifier';

        $model = Types::model()->findAll($criteria);
        return CHtml::listData($model, 'id', 'typeName');
    }

    /**
     *	Returns an array of every type.
     *	@return array of all the types in the format array('type_name' => type_id)
     */	
    public function arrayTypes()
    {
    	$out = array();
    	$types = Types::model()->findAll();
    	foreach($types as $type){
    		$out[$type->identifier] = $type->id;
    	}
    	return $out;
    }

	/**
	 *	Returns the html code for inserting an image for the specific pokémon.
	 *	@param string $type can be "static" (the default value) or "moving" (depending if we want the gif of the png)
	 *	@return string the image html code
	 */
	public function Image(){
		$pic = $this->id.'.png';
		return CHtml::image(Yii::app()->baseUrl.'/images/types/'.$pic);
	}

	/**
	 *	Returns an array of every type efficacy against this pokémon.
	 *	@param integer pokemon_id the identifier of the pokémon
	 *	@return array in the format array['id_type']['number'] the multiplier (such as 0.25 or 0.5) and array['id_type']['name'] the name of the type (Ej: Ground(tierra))
	 */
	public function resistances($pokemon_id)
	{
		$type_criteria = new CDbCriteria;
		$type_criteria->addCondition("id != 10001"); //Exclude unkown type
		$type_criteria->addCondition("id != 10002"); //Exlude shadow type

		$poke 					      = Pokemon::model()->findByPk($pokemon_id);
		$pokemon_types 				  = PokemonTypes::model()->findAllByAttributes(array('pokemon_id' => $pokemon_id)); 
		$types 						  = Types::model()->findAll($type_criteria);
		$result						  = array();
	
		//Inicialize the array in x1 for every type.
		foreach($types as $type){
			$result[$type->id]['number'] = 1;
			$result[$type->id]['name']	 = '';
		}

		foreach($types as $type){ 
			foreach($pokemon_types as $poke_type){
				//Check every type for every pokémon
				$result[$type->id]['number']  =  $result[$type->id]['number'] * (1/100) * TypeEfficacy::model()->findByAttributes(array(
					'damage_type_id' => $type->id,
					'target_type_id' => $poke_type->type_id
				))->damage_factor;
				$result[$type->id]['name']	  = $type->typeName;
			}
		}
		
		return $result;
	}
}
